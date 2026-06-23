<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CryptoInvestment;
use App\Models\StockInvestment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class LiveMarketController extends Controller
{
    public function index()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        return view('AdminDashboard.Adminlivemarket');
    }

    public function data(Request $request)
    {
        $stockInvestments = StockInvestment::with(['user', 'plan'])->latest()->get();
        $cryptoInvestments = CryptoInvestment::with(['user', 'plan'])->latest()->get();

        $records = $stockInvestments->map(function (StockInvestment $investment) {
            return $this->formatInvestmentRecord($investment, 'BUY', 'Stock');
        })->concat($cryptoInvestments->map(function (CryptoInvestment $investment) {
            return $this->formatInvestmentRecord($investment, 'SELL', 'Crypto');
        }))->sortByDesc('opened')->values();

        $totalToday = $stockInvestments->where('created_at', '>=', today())->count() + $cryptoInvestments->where('created_at', '>=', today())->count();
        $activeCount = $records->where('status', 'ACTIVE')->count();
        $closedCount = $records->where('status', 'CLOSED')->count();

        $summary = [
            'totalTradesToday' => $totalToday,
            'activeTrades' => $activeCount,
            'closedTrades' => $closedCount,
            'buys' => $stockInvestments->count(),
            'sells' => $cryptoInvestments->count(),
            'volume' => '$' . number_format($records->sum('amount'), 2),
            'profit' => '$' . number_format($records->reduce(function ($carry, $record) {
                return $carry + max(0, $record['pnl']);
            }, 0), 2),
            'loss' => '$' . number_format(abs($records->reduce(function ($carry, $record) {
                return $carry + min(0, $record['pnl']);
            }, 0)), 2),
        ];

        $topTraders = $records->groupBy('email')->map(function ($items, $email) {
            $name = $items->first()['user'];
            $profit = $items->sum('pnl');
            $count = $items->count();
            $winRate = min(99, max(20, intval(($profit / max(1, $count)) * 2)));
            $initial = collect(explode(' ', $name))->map(fn ($part) => strtoupper(substr($part, 0, 1)))->join('');

            return [
                'name' => $name,
                'count' => $count,
                'profit' => round($profit, 2),
                'winRate' => $winRate,
                'initial' => $initial ?: 'TR',
            ];
        })->sortByDesc('profit')->values()->take(6)->all();

        $totalRecordVolume = max(1, $records->sum('amount'));
        $mostTradedPairs = $records->groupBy('pair')->map(function ($items, $pair) use ($totalRecordVolume) {
            $count = $items->count();
            $volume = $items->sum('amount');
            $rate = min(99, max(5, intval(($volume / $totalRecordVolume) * 100)));

            return [
                'pair' => $pair,
                'count' => $count,
                'volume' => number_format($volume, 0),
                'rate' => $rate,
            ];
        })->sortByDesc('count')->values()->take(6)->all();

        $dailyLabels = [];
        $dailyProfits = [];
        $dailyLosses = [];

        for ($daysAgo = 6; $daysAgo >= 0; $daysAgo--) {
            $day = Carbon::today()->copy()->subDays($daysAgo);
            $dailyLabels[] = $day->format('D');

            $dayRecords = $records->filter(fn ($record) => Carbon::parse($record['opened'])->isSameDay($day));
            $dailyProfits[] = round($dayRecords->reduce(fn ($carry, $record) => $carry + max(0, $record['pnl']), 0), 2);
            $dailyLosses[] = round(abs($dayRecords->reduce(fn ($carry, $record) => $carry + min(0, $record['pnl']), 0)), 2);
        }

        $pairGroups = $records->groupBy('pair')->sortByDesc(fn ($items) => $items->sum('amount'))->take(6);
        $volumeLabels = $pairGroups->keys()->all();
        $volumeValues = $pairGroups->map(fn ($items) => round($items->sum('amount'), 2))->values()->all();

        $activityFeed = $records->take(10)->map(fn ($record) => sprintf(
            '%s placed a %s order for %s valued at $%s (%s).',
            $record['user'],
            $record['type'],
            $record['pair'],
            number_format($record['amount'], 2),
            $record['status']
        ))->all();

        return response()->json([
            'records' => $records,
            'summary' => $summary,
            'topTraders' => $topTraders,
            'mostTradedPairs' => $mostTradedPairs,
            'profitLossChart' => [
                'labels' => $dailyLabels,
                'profit' => $dailyProfits,
                'loss' => $dailyLosses,
            ],
            'pairsVolumeChart' => [
                'labels' => $volumeLabels,
                'data' => $volumeValues,
            ],
            'activityFeed' => $activityFeed,
        ]);
    }

    protected function formatInvestmentRecord($investment, string $defaultType, string $assetClass): array
    {
        $user = $investment->user;
        $plan = $investment->plan;
        $amount = (float) $investment->amount;
        $currentProfit = (float) $investment->current_profit;
        $entryPrice = max(0.01, round($amount / 10, 2));
        $currentPrice = max(0.01, round($entryPrice + ($currentProfit / 100), 2));
        $type = $defaultType;
        $pair = $plan?->name ? $plan->name . ' / USD' : $assetClass . ' Market';
        $asset = $plan?->tier ?: $assetClass;

        $pnl = $type === 'BUY'
            ? round((($currentPrice - $entryPrice) / $entryPrice) * $amount * floatval(str_replace('1:', '', $this->makeLeverage($investment->id))), 2)
            : round((($entryPrice - $currentPrice) / $entryPrice) * $amount * floatval(str_replace('1:', '', $this->makeLeverage($investment->id))), 2);

        $status = strtoupper($investment->status ?? 'RUNNING');
        if ($status === 'RUNNING') {
            $status = 'ACTIVE';
        } elseif (in_array($status, ['COMPLETED', 'CANCELLED'], true)) {
            $status = 'CLOSED';
        }

        return [
            'id' => 'TRD-' . str_pad($investment->id, 4, '0', STR_PAD_LEFT),
            'user' => $user?->name ?? 'Unknown Trader',
            'email' => $user?->email ?? 'unknown@nexuist.com',
            'pair' => $pair,
            'asset' => $asset,
            'type' => $type,
            'amount' => round($amount, 2),
            'leverage' => $this->makeLeverage($investment->id),
            'entryPrice' => $entryPrice,
            'currentPrice' => $currentPrice,
            'status' => $status,
            'opened' => $investment->created_at->format('Y-m-d H:i'),
            'pnl' => $pnl,
        ];
    }

    protected function makeLeverage(int $seed): string
    {
        $options = ['1:10', '1:20', '1:50', '1:100'];
        return $options[$seed % count($options)];
    }
}
