<?php

namespace App\Http\Controllers;

use App\Models\BotInvestment;
use App\Models\CryptoInvestment;
use App\Models\Deposit;
use App\Models\DemoTrade;
use App\Models\RealEstateInvestment;
use App\Models\StockInvestment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Authentication required.'], 401);
        }

        $demoTrades = DemoTrade::where('user_id', $user->id)->latest()->get();
        $stockInvestments = StockInvestment::with('plan')->where('user_id', $user->id)->get();
        $cryptoInvestments = CryptoInvestment::with('plan')->where('user_id', $user->id)->get();
        $botInvestments = BotInvestment::with('bot')->where('user_id', $user->id)->get();
        $realEstateInvestments = RealEstateInvestment::with('property')->where('user_id', $user->id)->get();

        $positions = collect();

        foreach ($demoTrades as $trade) {
            $positions->push([
                'id' => $trade->id,
                'type' => 'demo_trade',
                'title' => strtoupper($trade->asset) . ' ' . ucfirst(strtolower($trade->direction)),
                'status' => $trade->status,
                'quantity' => $trade->amount,
                'leverage' => $trade->leverage,
                'notional_value' => $trade->notional_value,
                'current_value' => $trade->status === 'OPEN' ? $trade->notional_value : $trade->amount + ($trade->pnl ?? 0),
                'profit' => $trade->pnl ?? 0,
                'result' => $trade->result,
                'opened_at' => $trade->opened_at?->toDateTimeString(),
                'closed_at' => $trade->closed_at?->toDateTimeString(),
                'closeable' => $trade->status === 'OPEN',
            ]);
        }

        foreach ($stockInvestments as $investment) {
            $positions->push([
                'id' => $investment->id,
                'type' => 'stock',
                'title' => $investment->plan?->name ?? 'Stock Investment',
                'status' => $investment->status,
                'quantity' => $investment->amount,
                'current_value' => $investment->current_balance ?? $investment->amount,
                'profit' => $investment->current_profit ?? 0,
                'opened_at' => $investment->created_at?->toDateTimeString(),
                'closeable' => false,
            ]);
        }

        foreach ($cryptoInvestments as $investment) {
            $investment->refreshEarnings();

            $positions->push([
                'id' => $investment->id,
                'type' => 'crypto',
                'title' => $investment->plan?->name ?? 'Crypto Investment',
                'status' => $investment->status,
                'quantity' => $investment->amount,
                'current_value' => $investment->current_balance ?? $investment->amount,
                'profit' => $investment->current_profit ?? 0,
                'opened_at' => $investment->created_at?->toDateTimeString(),
                'closeable' => false,
            ]);
        }

        $botInvestments->each(fn ($investment) => $investment->refreshEarnings());

        foreach ($botInvestments as $investment) {
            $positions->push([
                'id' => $investment->id,
                'type' => 'bot',
                'title' => $investment->bot?->bot_name ?? 'AI Bot Investment',
                'status' => $investment->status,
                'quantity' => $investment->investment_amount,
                'current_value' => $investment->current_balance ?? $investment->investment_amount,
                'profit' => $investment->current_profit ?? 0,
                'opened_at' => $investment->created_at?->toDateTimeString(),
                'closeable' => false,
            ]);
        }

        foreach ($realEstateInvestments as $investment) {
            $durationDays = $investment->investment_date ? now()->diffInDays($investment->investment_date) : 0;
            $dailyRate = ($investment->apy / 100) / 365;
            $accruedProfit = round($investment->investment_amount * $dailyRate * $durationDays, 2);
            $status = in_array($investment->investment_status, ['Active', 'OPEN', 'Running'], true)
                ? 'OPEN'
                : 'CLOSED';

            $positions->push([
                'id' => $investment->id,
                'type' => 'real_estate',
                'title' => $investment->property?->property_name ?? 'Real Estate Investment',
                'status' => $status,
                'quantity' => $investment->investment_amount,
                'current_value' => $investment->investment_amount + $accruedProfit,
                'profit' => $accruedProfit,
                'opened_at' => $investment->investment_date?->toDateTimeString() ?? $investment->created_at?->toDateTimeString(),
                'closeable' => false,
            ]);
        }

        $totalInvested = $stockInvestments->sum('amount')
            + $cryptoInvestments->sum('amount')
            + $botInvestments->sum('investment_amount')
            + $realEstateInvestments->sum('investment_amount')
            + $demoTrades->sum('amount');

        $currentPortfolioValue = $positions->sum('current_value');
        $openPositions = $positions->where('status', 'OPEN')->count();
        $closedPositions = $positions->where('status', 'CLOSED')->count();
        $totalProfit = $positions->sum('profit');

        return response()->json([
            'success' => true,
            'summary' => [
                'demo_balance' => $user->demo_balance ?? 0,
                'current_portfolio_value' => round($currentPortfolioValue, 2),
                'total_invested' => round($totalInvested, 2),
                'open_positions' => $openPositions,
                'closed_positions' => $closedPositions,
                'total_profit' => round($totalProfit, 2),
                'total_positions' => $positions->count(),
                'total_demo_trades' => $demoTrades->count(),
                'open_demo_trades' => $demoTrades->where('status', 'OPEN')->count(),
            ],
            'positions' => $positions->values(),
        ]);
    }

    public function adminIndex(Request $request)
    {
        $users = User::with([
            'demoTrades',
            'stockInvestments',
            'cryptoInvestments',
            'botInvestments',
            'realEstateInvestments',
        ])->get();

        $items = $users->map(function (User $user) {
            $totalInvested = $user->stockInvestments->sum('amount')
                + $user->cryptoInvestments->sum('amount')
                + $user->botInvestments->sum('investment_amount')
                + $user->realEstateInvestments->sum('investment_amount');

            $activeInvestments = $user->stockInvestments->where('status', 'Running')->count()
                + $user->cryptoInvestments->where('status', 'Running')->count()
                + $user->botInvestments->where('status', 'Running')->count()
                + $user->realEstateInvestments->where('investment_status', 'Active')->count();

            $profit = $user->stockInvestments->sum('current_profit')
                + $user->cryptoInvestments->sum('current_profit')
                + $user->botInvestments->sum('current_profit');

            $winCount = $user->demoTrades->where('result', 'WIN')->count();
            $totalTrades = $user->demoTrades->count();
            $winRate = $totalTrades > 0 ? round(($winCount / $totalTrades) * 100, 1) : 0;

            $pendingDepositAmount = Deposit::where('user_id', $user->id)
                ->where('status', 'Pending')
                ->sum('amount');

            $latestDeposit = Deposit::where('user_id', $user->id)
                ->latest()
                ->first();

            return [
                'id' => $user->id,
                'uid' => sprintf('#NEX-%05d', $user->id),
                'name' => $user->name,
                'email' => $user->email,
                'net_worth' => $this->formatCurrency($user->balance ?? 0),
                'pending_deposit' => $this->formatCurrency($pendingDepositAmount),
                'total_invested' => $this->formatCurrency($totalInvested),
                'roi' => $totalInvested > 0 ? round(($profit / max($totalInvested, 1)) * 100, 1) . '%' : '0.0%',
                'win_rate' => $winRate . '%',
                'profit_factor' => $totalInvested > 0 ? round(max(0, $profit / max($totalInvested, 1)), 2) : 0,
                'investment_pool' => $this->resolveInvestmentPoolLabel($user),
                    'pending_transaction' => [
                    'txid' => $latestDeposit?->txid ?? 'N/A',
                    'gateway' => $latestDeposit?->method ? ucfirst($latestDeposit->method) : 'N/A',
                    'amount' => $this->formatCurrency($latestDeposit?->amount ?? 0),
                    'date' => $latestDeposit?->created_at?->toDateTimeString() ?? now()->toDateTimeString(),
                    'status' => $latestDeposit?->status ?? 'Pending',
                ],
                'active_investments' => $activeInvestments,
                'open_demo_trades' => $user->demoTrades->where('status', 'OPEN')->count(),
                'total_trades' => $totalTrades,
            ];
        });

        return response()->json([
            'success' => true,
            'users' => $items,
        ]);
    }

    private function formatCurrency($value)
    {
        return '$' . number_format((float) $value, 2);
    }

    private function resolveInvestmentPoolLabel(User $user)
    {
        if ($user->botInvestments->isNotEmpty()) {
            return 'AI Bot Algorithm Pool';
        }

        if ($user->cryptoInvestments->isNotEmpty()) {
            return 'Crypto Yield Pool';
        }

        if ($user->stockInvestments->isNotEmpty()) {
            return 'Equity Market Allocation';
        }

        if ($user->realEstateInvestments->isNotEmpty()) {
            return 'Tokenized Real Estate Pool';
        }

        return 'Standard Investor Profile';
    }
}
