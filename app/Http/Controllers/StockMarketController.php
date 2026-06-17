<?php

namespace App\Http\Controllers;

use App\Models\StockPlan;
use App\Models\StockPost;
use App\Models\StockInvestment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockMarketController extends Controller
{
    public function index()
    {
        $stockPlans = StockPlan::orderBy('tier')->orderBy('minimum_investment')->get();
        $stockPosts = StockPost::latest()->take(3)->get();
        $userBalance = Auth::check() ? Auth::user()->balance : 0.00;

        if (Auth::check()) {
            $this->reconcileMaturedInvestments(Auth::user());
            $userBalance = Auth::user()->fresh()->balance;
        }

        return view('stockMarket', compact('stockPlans', 'stockPosts', 'userBalance'));
    }

    protected function reconcileMaturedInvestments($user)
    {
        $maturedInvestments = StockInvestment::where('user_id', $user->id)
            ->where('status', 'Running')
            ->whereDate('end_date', '<=', today())
            ->get();

        if ($maturedInvestments->isEmpty()) {
            return;
        }

        foreach ($maturedInvestments as $investment) {
            $profit = $investment->current_profit;
            if ($profit <= 0) {
                $profit = round($investment->amount * ($investment->profit_rate / 100), 2);
            }
            $investment->current_balance = $investment->amount + $profit;
            $investment->current_profit = $profit;
            $investment->status = 'Completed';
            $investment->save();
            $user->balance += $profit;
        }

        $user->save();
    }
}
