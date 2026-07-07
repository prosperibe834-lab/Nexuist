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

            DB::beginTransaction();
            try {
                // DEDUCT WALLET
                $userModel = \App\Models\User::findOrFail(Auth::id());
                $before = $userModel->balance;
                $userModel->balance = round($userModel->balance - $amount, 2);
                $userModel->save();

                // CREATE INVESTMENT
                $investment = BotInvestment::create([
                    'user_id'           => $user->id,
                    'bot_id'            => $bot->id,
                    'investment_amount' => $amount,
                    'current_profit'    => 0,
                    'current_balance'   => $amount,
                    'start_date'        => now(),
                    'end_date'          => now()->addDays(30),
                    'status'            => 'Running',
                ]);

                // Record transaction
                \App\Models\Transaction::create([
                    'user_id' => $userModel->id,
                    'type' => 'Investment',
                    'amount' => -1 * $amount,
                    'balance_before' => $before,
                    'balance_after' => $userModel->balance,
                    'related_id' => $investment->id,
                    'related_type' => BotInvestment::class,
                    'transaction_id' => \App\Models\Transaction::generateTransactionId(),
                    'meta' => ['bot_id' => $bot->id],
                    'status' => 'completed',
                ]);

                // UPDATE BOT STATS
                $bot->increment('total_subscribers');
                $bot->increment('total_investment', $amount);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return $this->jsonResponse(false, 'Error: ' . $e->getMessage());
            }

            return $this->jsonResponse(true, 'AI Bot Investment Activated Successfully', ['redirect' => '/deploybot']);

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

    /**
     * Accrue pending profits for a user's bot investments.
     *
     * This is used by PremiumSignalsController to ensure a user's active
     * bot investment state is refreshed before rendering premium signal data.
     */
    public static function accruePendingProfitsForUser($user)
    {
        try {
            $investments = BotInvestment::with('bot')
                ->where('user_id', $user->id)
                ->where('status', 'Running')
                ->get();

            foreach ($investments as $investment) {
                $investment->refreshEarnings();
            }
        } catch (\Exception $e) {
            // Prevent failure during signal page render.
        }

        return true;
    }

    public function dashboard()
    {
        $activeInvestments = BotInvestment::with('bot')
            ->where('user_id', Auth::id())
            ->latest()
            ->get()
            ->each(fn ($investment) => $investment->refreshEarnings());

        $cryptoInvestments = \App\Models\CryptoInvestment::with('plan')
            ->where('user_id', Auth::id())
            ->latest()
            ->get()
            ->each(fn ($investment) => $investment->refreshEarnings());

        $stockInvestments = StockInvestment::with('plan')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // Calculate totals including crypto
        $totalInvested = $activeInvestments->sum('investment_amount') + $cryptoInvestments->sum('amount') + $stockInvestments->sum('amount');
        $totalProfit = $activeInvestments->sum('current_profit') + $cryptoInvestments->sum('current_profit') + $stockInvestments->sum('current_profit');
        $currentBalance = $activeInvestments->sum('current_balance') + $cryptoInvestments->sum('current_balance') + $stockInvestments->sum('current_balance');
        $activeBotsCount = $activeInvestments->count();
        $primaryInvestment = $activeInvestments->first() ?? $cryptoInvestments->first() ?? $stockInvestments->first();

        return view('deploybot', compact(
            'activeInvestments',
            'cryptoInvestments',
            'stockInvestments',
            'primaryInvestment',
            'totalInvested',
            'totalProfit',
            'currentBalance',
            'activeBotsCount'
        ));
    }
}
