<?php

namespace App\Http\Controllers;

use App\Models\StockInvestment;
use App\Models\StockPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockInvestmentController extends Controller
{
    public function invest(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|integer|exists:stock_plans,id',
            'amount' => 'required|numeric|min:1',
            'term' => 'required|in:daily,monthly,yearly',
        ]);

        $user = Auth::user();

        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Please login to invest.'], 401);
            }
            return redirect()->route('login')->with('error', 'Please login to invest.');
        }

        $plan = StockPlan::findOrFail($request->plan_id);
        $amount = round($request->amount, 2);

        if ($amount < $plan->minimum_investment) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Investment amount is below the plan minimum.'], 400);
            }
            return back()->with('error', 'Investment amount is below the plan minimum.');
        }

        if ($amount > $plan->maximum_investment) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Investment amount is above the plan maximum.'], 400);
            }
            return back()->with('error', 'Investment amount is above the plan maximum.');
        }

        if ($user->balance < $amount) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Insufficient balance. Please deposit funds before investing.'], 400);
            }
            return back()->with('error', 'Insufficient balance. Please deposit funds before investing.');
        }

        $term = $request->term;
        $profitRate = $this->getRateForTerm($plan, $term);
        $durationDays = $this->getDurationForTerm($term);
        $profitAmount = round($amount * ($profitRate / 100), 2);

        $user->balance -= $amount;
        $user->save();

        StockInvestment::create([
            'user_id' => $user->id,
            'stock_plan_id' => $plan->id,
            'amount' => $amount,
            'term' => $term,
            'profit_rate' => $profitRate,
            'current_profit' => 0.00,
            'current_balance' => $amount,
            'start_date' => now(),
            'end_date' => now()->addDays($durationDays),
            'status' => 'Running',
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Stock market investment created successfully. Your balance has been updated.',
                'redirect' => url('/deploybot'),
            ]);
        }

        return back()->with('success', 'Stock market investment created successfully. Your balance has been updated.');
    }

    protected function getRateForTerm(StockPlan $plan, string $term): float
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
