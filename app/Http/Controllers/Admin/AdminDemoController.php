<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AiBot;
use App\Models\BotInvestment;
use App\Models\CryptoPlan;
use App\Models\DemoTrade;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

class AdminDemoController extends Controller
{
    public function index()
    {
        $totalUsers = Schema::hasTable('demo_trades') ? DemoTrade::distinct('user_id')->count('user_id') : 0;
        $activePositions = Schema::hasTable('demo_trades') ? DemoTrade::where('status', 'OPEN')->count() : 0;
        $demoVolume = Schema::hasTable('demo_trades') ? DemoTrade::sum('amount') : 0;
        $closedTradesCount = Schema::hasTable('demo_trades') ? DemoTrade::where('status', 'CLOSED')->count() : 0;
        $winCount = Schema::hasTable('demo_trades') ? DemoTrade::where('status', 'CLOSED')->where('result', 'WIN')->count() : 0;
        $demoWinRate = $closedTradesCount ? round(($winCount / $closedTradesCount) * 100, 1) : 0;

        $months = collect(range(6, 0))->map(fn ($i) => Carbon::now()->subMonths($i));
        $labels = $months->map(fn ($date) => $date->format('M'))->toArray();

        $revenueSeries = $months->map(fn ($date) => Schema::hasTable('demo_trades')
            ? DemoTrade::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('amount')
            : 0)
            ->toArray();

        $acquisitionSeries = $months->map(fn ($date) => Schema::hasTable('demo_trades')
            ? DemoTrade::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count()
            : 0)
            ->toArray();

        $withdrawalSeries = $months->map(fn ($date) => Schema::hasTable('demo_trades')
            ? DemoTrade::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->where('status', 'CLOSED')
                ->sum('amount')
            : 0)
            ->toArray();

        $botShare = Schema::hasTable('demo_trades')
            ? DemoTrade::select('asset', DB::raw('SUM(amount) as total'))
                ->groupBy('asset')
                ->orderByDesc('total')
                ->take(3)
                ->get()
                ->map(fn ($item) => [
                    'label' => $item->asset,
                    'value' => round((float) $item->total, 2),
                ])
                ->toArray()
            : [];

        if (empty($botShare)) {
            $botShare = [
                ['label' => 'BTC', 'value' => 55000],
                ['label' => 'ETH', 'value' => 32000],
                ['label' => 'AAPL', 'value' => 15000],
            ];
        }

        $activityLog = [];
        if (Schema::hasTable('demo_trades')) {
            $activityLog = DemoTrade::latest()->take(6)->get()->map(fn ($trade) => [
                'message' => sprintf(
                    '%s %s position (%s) at $%s',
                    $trade->direction,
                    $trade->asset,
                    strtolower($trade->status),
                    number_format($trade->amount, 2)
                ),
                'time' => $trade->updated_at?->diffForHumans() ?? '',
            ])->toArray();
        }

        $users = [];
        if (Schema::hasTable('demo_trades')) {
            $users = DemoTrade::with('user')
                ->latest()
                ->get()
                ->unique('user_id')
                ->take(10)
                ->map(fn ($trade) => [
                    'id' => $trade->user?->id ?? 0,
                    'name' => $trade->user?->name ?? 'Unknown',
                    'username' => $trade->user?->username ?? 'unknown',
                    'email' => $trade->user?->email ?? 'unknown@nexuist.com',
                    'country' => $trade->user?->country ?? 'Unknown',
                    'balance' => round((float) $trade->user?->demo_balance ?? 0, 2),
                    'status' => $trade->user?->is_bot_active ? 'active' : 'pending',
                    'tier' => $trade->user?->is_bot_active ? 'VIP' : 'STANDARD',
                    'joined' => $trade->user?->created_at?->toDateString() ?? '',
                ])
                ->toArray();
        }

        $deposits = [];
        $withdrawals = [];
        $openPositions = [];
        if (Schema::hasTable('demo_trades')) {
            $deposits = DemoTrade::with('user')->where('status', 'OPEN')->latest()->take(10)->get()->map(fn ($trade) => [
                'user' => $trade->user?->name ?? 'Unknown',
                'amount' => round((float) $trade->amount, 2),
                'method' => $trade->asset,
                'txid' => sprintf('DEMO-%s', $trade->id),
                'status' => ucfirst(strtolower($trade->status)),
            ])->toArray();

            $withdrawals = DemoTrade::with('user')->where('status', 'CLOSED')->latest()->take(10)->get()->map(fn ($trade) => [
                'user' => $trade->user?->name ?? 'Unknown',
                'amount' => round((float) $trade->amount, 2),
                'destination' => strtoupper($trade->result ?? 'N/A'),
                'status' => ucfirst(strtolower($trade->result ?? 'Closed')),
            ])->toArray();

            $openPositions = DemoTrade::with('user')->where('status', 'OPEN')->latest()->take(10)->get()->map(fn ($trade) => [
                'user' => $trade->user?->name ?? 'Unknown',
                'asset' => $trade->asset,
                'amount' => round((float) $trade->amount, 2),
                'direction' => strtoupper($trade->direction),
                'status' => $trade->status,
                'country' => $trade->user?->country ?? 'Unknown',
                'tier' => $trade->user?->is_bot_active ? 'VIP' : 'STANDARD',
                'opened_at' => $trade->created_at?->toDateString() ?? '',
            ])->toArray();
        }

        $plans = CryptoPlan::latest()->take(5)->get()->map(fn ($plan) => [
            'name' => $plan->name,
            'roi' => $plan->daily_roi ? sprintf('+%s%% Daily', $plan->daily_roi) : 'TBD',
            'duration' => $plan->duration_days ? sprintf('%s Days', $plan->duration_days) : 'N/A',
            'limits' => sprintf('Min: $%s / Max: $%s', number_format($plan->minimum_investment, 0), number_format($plan->maximum_investment, 0)),
            'risk' => strtoupper($plan->status),
        ])->toArray();

        $bots = AiBot::where('status', 'Active')->latest()->take(3)->get()->map(fn ($bot) => [
            'name' => $bot->bot_name,
            'accuracy' => round((float) $bot->accuracy_rate, 1),
            'status' => 'active',
        ])->toArray();

        $adminDemoData = [
            'stats' => [
                'totalUsers' => $totalUsers,
                'activePositions' => $activePositions,
                'totalDeposits' => round((float) $demoVolume, 2),
                'aiBotSubscribers' => $demoWinRate,
            ],
            'sparklineData' => [
                'sparkline-users' => $acquisitionSeries,
                'sparkline-active' => $months->map(fn ($date) => Schema::hasTable('demo_trades')
                    ? DemoTrade::whereYear('created_at', $date->year)
                        ->whereMonth('created_at', $date->month)
                        ->where('status', 'OPEN')
                        ->count()
                    : 0)->toArray(),
                'sparkline-deposits' => $revenueSeries,
                'sparkline-bots' => $botShare ? array_map(fn ($item) => $item['value'], $botShare) : [55, 30, 15],
            ],
            'revenueLabels' => $labels,
            'revenueSeries' => $revenueSeries,
            'acquisitionSeries' => $acquisitionSeries,
            'depositWithdrawSeries' => [
                'deposits' => $revenueSeries,
                'withdrawals' => $withdrawalSeries,
                'labels' => $labels,
            ],
            'botShare' => $botShare,
            'activityLog' => $activityLog,
            'users' => $users,
            'deposits' => $deposits,
            'withdrawals' => $withdrawals,
            'plans' => $plans,
            'bots' => $bots,
            'openPositions' => $openPositions,
            'winRate' => $demoWinRate,
        ];

        return view('AdminDashboard.AdminDemo', compact('adminDemoData'));
    }
}
