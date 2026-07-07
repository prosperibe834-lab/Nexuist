<?php

namespace App\Http\Controllers;

use App\Models\CryptoInvestment;
use App\Models\CryptoPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CryptoInvestmentController extends Controller
{
    public function invest(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|integer|exists:crypto_plans,id',
            'amount' => 'required|numeric|min:1',
            'term' => 'required|in:daily,monthly,yearly',
        ]);

        $user = Auth::user();
        if (! $user) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Please login to invest.'], 401);
            }
            return redirect()->route('login');
        }

        $plan = CryptoPlan::findOrFail($request->plan_id);
        $amount = round($request->amount, 2);

        if ($amount < $plan->minimum_investment) {
            return response()->json(['success' => false, 'message' => 'Investment amount is below the plan minimum.'], 400);
        }
        if ($amount > $plan->maximum_investment) {
            return response()->json(['success' => false, 'message' => 'Investment amount is above the plan maximum.'], 400);
        }
        if ($user->balance < $amount) {
            return response()->json(['success' => false, 'message' => 'Insufficient balance. Redirect to deposit.', 'redirect' => url('/depositfunds')], 400);
        }

        $term = $request->term;
        $profitRate = $this->getRateForTerm($plan, $term);
        $durationDays = $this->getDurationForTerm($term);

        DB::beginTransaction();
        try {
            $before = $user->balance;
            $user->balance = round($user->balance - $amount, 2);
            $user->save();

            $investment = CryptoInvestment::create([
                'user_id' => $user->id,
                'crypto_plan_id' => $plan->id,
                'amount' => $amount,
                'term' => $term,
                'profit_rate' => $profitRate,
                'current_profit' => 0.00,
                'current_balance' => $amount,
                'start_date' => now(),
                'end_date' => now()->addDays($durationDays),
                'status' => 'Running',
            ]);

            \App\Models\Transaction::create([
                'user_id' => $user->id,
                'type' => 'Investment',
                'amount' => -1 * $amount,
                'balance_before' => $before,
                'balance_after' => $user->balance,
                'related_id' => $investment->id,
                'related_type' => CryptoInvestment::class,
                'transaction_id' => \App\Models\Transaction::generateTransactionId(),
                'meta' => ['plan_id' => $plan->id, 'term' => $term],
                'status' => 'completed',
            ]);

            $investment->refreshEarnings();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Investment failed: ' . $e->getMessage()], 500);
        }

        return response()->json(['success' => true, 'message' => 'Crypto investment created.', 'investment' => $investment, 'redirect' => url('/deploybot')]);
    }

    protected function getRateForTerm(CryptoPlan $plan, string $term): float
    {
        return match ($term) {
            'daily' => (float) $plan->daily_roi,
            'monthly' => (float) ($plan->monthly_roi > 0 ? $plan->monthly_roi : round($plan->daily_roi * 30, 2)),
            'yearly' => (float) ($plan->yearly_roi > 0 ? $plan->yearly_roi : round($plan->daily_roi * 365, 2)),
            default => (float) $plan->daily_roi,
        };
    }

    protected function getDurationForTerm(string $term): int
    {
        return match ($term) {
            'daily' => 1,
            'monthly' => 30,
            'yearly' => 365,
            default => 30,
        };
    }
}
