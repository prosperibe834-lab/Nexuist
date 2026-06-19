<?php
namespace App\Http\Controllers;

use App\Models\AiBot;
use App\Models\BotInvestment;
use App\Models\StockInvestment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BotInvestmentController extends Controller
{
    public function invest(Request $request, $id)
    {
        try {
            $request->validate([
                'amount' => 'required|numeric|min:1',
            ]);

            $user = Auth::user();

            if (!$user) {
                return $this->jsonResponse(false, 'Please login first', null, 401);
            }

            $bot = AiBot::findOrFail($id);
            $amount = $request->amount;

            // CHECK MINIMUM
            if ($amount < $bot->minimum_investment) {
                return $this->jsonResponse(false, 'Amount below minimum investment of $' . $bot->minimum_investment);
            }

            // CHECK MAXIMUM
            if ($amount > $bot->maximum_investment) {
                return $this->jsonResponse(false, 'Amount exceeds maximum investment of $' . $bot->maximum_investment);
            }

            // CHECK WALLET - If insufficient, redirect to deposit
            if ($user->balance < $amount) {
                return $this->jsonResponse(false, 'Insufficient balance. Please deposit funds.', ['redirect' => '/deposit']);
            }

            DB::transaction(function () use ($user, $bot, $amount) {
                $user->decrement('balance', $amount);

                BotInvestment::create([
                    'user_id'           => $user->id,
                    'bot_id'            => $bot->id,
                    'investment_amount' => $amount,
                    'current_profit'    => 0,
                    'current_balance'   => $amount,
                    'start_date'        => now(),
                    'end_date'          => now()->addDays(30),
                    'status'            => 'Running',
                ]);

                $bot->increment('total_subscribers');
                $bot->increment('total_investment', $amount);
            });

            return $this->jsonResponse(true, 'AI Bot Investment Activated Successfully', ['redirect' => route('deploybot')]);

        } catch (\Exception $e) {
            return $this->jsonResponse(false, 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Helper method to return JSON responses
     */
    private function jsonResponse($success, $message, $data = null, $status = 200)
    {
        $response = [
            'success' => $success,
            'message' => $message,
        ];

        if ($data) {
            $response = array_merge($response, $data);
        }

        return response()->json($response, $status);
    }

    public static function accruePendingProfitsForUser($user)
    {
        $investments = BotInvestment::with('bot')
            ->where('user_id', $user->id)
            ->where('status', 'Running')
            ->get();

        $userNeedsSave = false;
        foreach ($investments as $investment) {
            if (!$investment->bot || !$investment->bot->monthly_return) {
                continue;
            }

            $startDate = \Illuminate\Support\Carbon::parse($investment->start_date);
            $endDate = \Illuminate\Support\Carbon::parse($investment->end_date);
            $today = now();

            $totalDays = max(1, $startDate->diffInDays($endDate));
            $elapsedDays = min($startDate->diffInDays($today), $totalDays);
            $elapsedDays = max(0, $elapsedDays);

            $dailyRate = ($investment->bot->monthly_return / 100) / 30;
            $targetProfit = round($investment->investment_amount * $dailyRate * $elapsedDays, 2);

            if ($targetProfit > $investment->current_profit) {
                $profitDifference = $targetProfit - $investment->current_profit;
                $investment->current_profit = $targetProfit;
                $investment->current_balance = round($investment->investment_amount + $targetProfit, 2);

                if ($today->greaterThanOrEqualTo($endDate)) {
                    $investment->status = 'Completed';
                }

                $investment->save();

                $user->balance = round(($user->balance ?? 0) + $profitDifference, 2);
                $userNeedsSave = true;
            }
        }

        if ($userNeedsSave) {
            $user->save();
        }
    }

    public function dashboard()
    {
        $activeInvestments = BotInvestment::with('bot')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $cryptoInvestments = \App\Models\CryptoInvestment::with('plan')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $stockInvestments = StockInvestment::with('plan')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // Combine bot, crypto and stock investments for dashboard-wide metrics
        $totalInvested = $activeInvestments->sum('investment_amount') + $cryptoInvestments->sum('amount') + $stockInvestments->sum('amount');
        $totalProfit = $activeInvestments->sum('current_profit') + $cryptoInvestments->sum('current_profit') + $stockInvestments->sum('current_profit');
        $currentBalance = $activeInvestments->sum('current_balance') + $cryptoInvestments->sum('current_balance') + $stockInvestments->sum('current_balance');
        $activeBotsCount = $activeInvestments->count();
        $primaryInvestment = $activeInvestments->first() ?? $cryptoInvestments->first() ?? $stockInvestments->first();

        return view('deploybot', compact(
            'activeInvestments',
            'primaryInvestment',
            'totalInvested',
            'totalProfit',
            'currentBalance',
            'activeBotsCount'
        ))->with([ 'cryptoInvestments' => $cryptoInvestments, 'stockInvestments' => $stockInvestments ]);
    }
}
