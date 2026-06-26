<?php

namespace App\Http\Controllers;

use App\Models\CryptoInvestment;
use App\Models\CryptoPlan;
use App\Models\StockInvestment;
use App\Models\StockPlan;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TradeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'symbol' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'type' => 'required|in:BUY,SELL',
        ]);

        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        if (! $user) {
            return response()->json(['success' => false, 'message' => 'Authentication required.'], 401);
        }

        $symbol = $request->symbol;
        $amount = round($request->amount, 2);
        $type = $request->type;

        // Decide asset class by symbol format
        $isCrypto = strpos($symbol, '/') !== false;

        try {
            DB::transaction(function () use ($user, $isCrypto, $amount, $symbol, $type, &$investment) {
                if ($user->balance < $amount) {
                    throw new \Exception('Insufficient balance');
                }

                if ($isCrypto) {
                    $plan = CryptoPlan::where('status', 'active')
                        ->where('minimum_investment', '<=', $amount)
                        ->where('maximum_investment', '>=', $amount)
                        ->first() ?? CryptoPlan::where('status', 'active')->first();

                    if (! $plan) {
                        throw new \Exception('No crypto plan available for this amount');
                    }

                    $user->decrement('balance', $amount);

                    $investment = CryptoInvestment::create([
                        'user_id' => $user->id,
                        'crypto_plan_id' => $plan->id,
                        'amount' => $amount,
                        'term' => 'daily',
                        'profit_rate' => $plan->daily_roi ?? 0,
                        'current_profit' => 0.00,
                        'current_balance' => $amount,
                        'start_date' => now(),
                        'end_date' => now()->addDays(30),
                        'status' => 'Running',
                    ]);
                } else {
                    $plan = StockPlan::where('status', 'active')
                        ->where('minimum_investment', '<=', $amount)
                        ->where('maximum_investment', '>=', $amount)
                        ->first() ?? StockPlan::where('status', 'active')->first();

                    if (! $plan) {
                        throw new \Exception('No stock plan available for this amount');
                    }

                    $user->decrement('balance', $amount);

                    $investment = StockInvestment::create([
                        'user_id' => $user->id,
                        'stock_plan_id' => $plan->id,
                        'amount' => $amount,
                        'term' => 'daily',
                        'profit_rate' => $plan->daily_roi ?? 0,
                        'current_profit' => 0.00,
                        'current_balance' => $amount,
                        'start_date' => now(),
                        'end_date' => now()->addDays(30),
                        'status' => 'Running',
                    ]);
                }
            });

            UserNotification::createForUser(
                $user,
                $isCrypto ? 'Crypto Trade' : 'Stock Trade',
                strtoupper($type) . ' trade executed for ' . $symbol . ' with amount $' . number_format($amount, 2) . '.'
            );

            return response()->json(['success' => true, 'message' => 'Trade executed successfully.']);
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            if ($msg === 'Insufficient balance') {
                return response()->json(['success' => false, 'message' => 'Insufficient balance.'], 400);
            }
            return response()->json(['success' => false, 'message' => $msg], 400);
        }
    }
}
