<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\StockInvestment;
use App\Models\StockPlan;
use App\Models\StockPost;
use Illuminate\Http\Request;

class StockMarketController extends Controller
{
    public function index()
    {
        $plans = StockPlan::withCount('investments')->orderBy('created_at', 'desc')->get();
        $investments = StockInvestment::with(['user', 'plan'])->latest()->get();
        $deposits = Deposit::with('user')->latest()->take(10)->get();
        $posts = StockPost::latest()->take(3)->get();

        $stats = [
            'planCount' => $plans->count(),
            'totalInvestors' => $investments->pluck('user_id')->unique()->count(),
            'activePlans' => $investments->where('status', 'Running')->count(),
            'capitalInvested' => $investments->sum('amount'),
            'yieldPaid' => $investments->sum('current_profit'),
            'withdrawals' => 0,
            'revenue' => round($investments->sum('amount') * 0.03, 2),
        ];

        return view('AdminDashboard.StockMarket', compact('plans', 'investments', 'deposits', 'posts', 'stats'));
    }

    public function storePlan(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tier' => 'required|string|max:100',
            'minimum_investment' => 'required|numeric|min:1',
            'maximum_investment' => 'required|numeric|gte:minimum_investment',
            'daily_roi' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
        ]);

        $plan = StockPlan::create([
            'name' => $request->input('name'),
            'tier' => $request->input('tier'),
            'description' => $request->input('description', 'Stock market structured plan'),
            'minimum_investment' => $request->input('minimum_investment'),
            'maximum_investment' => $request->input('maximum_investment'),
            'daily_roi' => $request->input('daily_roi'),
            'monthly_roi' => round($request->input('daily_roi') * 30, 2),
            'yearly_roi' => round($request->input('daily_roi') * 365, 2),
            'duration_days' => $request->input('duration_days'),
            'bonus' => $request->input('bonus', 0),
            'status' => $request->input('status', 'Active'),
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Equity plan created successfully.', 'plan' => $plan]);
        }

        return redirect()->route('admin.stockmarket')->with('success', 'Equity plan created successfully.');
    }

    public function toggleStatus($id)
    {
        $plan = StockPlan::findOrFail($id);
        $plan->status = $plan->status === 'Active' ? 'Inactive' : 'Active';
        $plan->save();

        return response()->json([
            'success' => true,
            'message' => 'Plan status updated successfully.',
            'plan' => $plan,
        ]);
    }
}
