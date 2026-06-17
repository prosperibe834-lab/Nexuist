<?php
namespace App\Http\Controllers;

use App\Models\AiBot;
use App\Models\BotInvestment;
use App\Models\StockInvestment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            // DEDUCT WALLET
            $userModel = \App\Models\User::findOrFail(Auth::id());
            $userModel->balance -= $amount;
            $userModel->save();

            // CREATE INVESTMENT
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

            // UPDATE BOT STATS
            $bot->increment('total_subscribers');
            $bot->increment('total_investment', $amount);

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
