<?php

namespace App\Http\Controllers;

use App\Models\AiBot;
use App\Models\BotInvestment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PremiumSignalsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            BotInvestmentController::accruePendingProfitsForUser($user);
        }

        $this->seedPremiumSignals();

        $signals = AiBot::where('premium', 1)
            ->where('status', 'Active')
            ->orderByDesc('total_investment')
            ->get();

        $balance = $user ? $user->balance : 0;
        $activeInvestments = $user ? BotInvestment::with('bot')->where('user_id', $user->id)->latest()->get() : collect();
        $signalCount = $signals->count();

        return view('premiumSignals', compact('signals', 'balance', 'user', 'activeInvestments', 'signalCount'));
    }

    protected function seedPremiumSignals()
    {
        if (AiBot::where('premium', 1)->count() >= 10) {
            return;
        }

        $samples = [
            [
                'bot_name' => 'Breakout Signals',
                'strategy_type' => 'Crypto',
                'description' => 'Precision breakout alerts for fast-moving crypto markets.',
                'monthly_return' => 12.50,
                'annual_return' => 150.00,
                'accuracy_rate' => 68.70,
                'drawdown' => 8.5,
                'risk_level' => 'Medium',
                'trading_style' => 'Short-Term',
                'minimum_investment' => 3000,
                'maximum_investment' => 15000,
                'total_subscribers' => 0,
                'total_investment' => 0,
                'featured' => 1,
                'premium' => 1,
                'popular' => 1,
                'status' => 'Active',
            ],
            [
                'bot_name' => 'Buying Oversold',
                'strategy_type' => 'Stocks',
                'description' => 'Signal flow tuned for oversold entry points and rapid recovery trades.',
                'monthly_return' => 14.25,
                'annual_return' => 170.00,
                'accuracy_rate' => 75.00,
                'drawdown' => 7.2,
                'risk_level' => 'Medium',
                'trading_style' => 'Swing',
                'minimum_investment' => 3800,
                'maximum_investment' => 19000,
                'total_subscribers' => 0,
                'total_investment' => 0,
                'featured' => 1,
                'premium' => 1,
                'popular' => 1,
                'status' => 'Active',
            ],
            [
                'bot_name' => 'Trend Signal',
                'strategy_type' => 'Forex',
                'description' => 'Trend detection engine for high-probability market swings.',
                'monthly_return' => 16.00,
                'annual_return' => 190.00,
                'accuracy_rate' => 78.40,
                'drawdown' => 6.8,
                'risk_level' => 'Medium',
                'trading_style' => 'Trend Following',
                'minimum_investment' => 4000,
                'maximum_investment' => 20000,
                'total_subscribers' => 0,
                'total_investment' => 0,
                'featured' => 1,
                'premium' => 1,
                'popular' => 1,
                'status' => 'Active',
            ],
            [
                'bot_name' => 'Momentum Accumulator',
                'strategy_type' => 'Indices',
                'description' => 'Uses momentum filters for quick index swings.',
                'monthly_return' => 18.25,
                'annual_return' => 210.00,
                'accuracy_rate' => 72.30,
                'drawdown' => 7.0,
                'risk_level' => 'Medium',
                'trading_style' => 'Momentum',
                'minimum_investment' => 4200,
                'maximum_investment' => 21000,
                'total_subscribers' => 0,
                'total_investment' => 0,
                'featured' => 1,
                'premium' => 1,
                'popular' => 0,
                'status' => 'Active',
            ],
            [
                'bot_name' => 'Scalper Pro',
                'strategy_type' => 'Forex',
                'description' => 'Ultra-fast scalping signals for high-frequency traders.',
                'monthly_return' => 10.75,
                'annual_return' => 140.00,
                'accuracy_rate' => 80.10,
                'drawdown' => 5.8,
                'risk_level' => 'High',
                'trading_style' => 'Scalping',
                'minimum_investment' => 2500,
                'maximum_investment' => 10000,
                'total_subscribers' => 0,
                'total_investment' => 0,
                'featured' => 0,
                'premium' => 1,
                'popular' => 1,
                'status' => 'Active',
            ],
            [
                'bot_name' => 'Value Entry',
                'strategy_type' => 'Stocks',
                'description' => 'Deep value entries with strict risk management.',
                'monthly_return' => 13.90,
                'annual_return' => 160.00,
                'accuracy_rate' => 76.00,
                'drawdown' => 6.0,
                'risk_level' => 'Medium',
                'trading_style' => 'Position',
                'minimum_investment' => 3500,
                'maximum_investment' => 17500,
                'total_subscribers' => 0,
                'total_investment' => 0,
                'featured' => 1,
                'premium' => 1,
                'popular' => 0,
                'status' => 'Active',
            ],
            [
                'bot_name' => 'Range Rider',
                'strategy_type' => 'Commodities',
                'description' => 'Signal package for calm range-bound commodity moves.',
                'monthly_return' => 11.80,
                'annual_return' => 145.00,
                'accuracy_rate' => 70.50,
                'drawdown' => 6.5,
                'risk_level' => 'Low',
                'trading_style' => 'Range Trading',
                'minimum_investment' => 3200,
                'maximum_investment' => 16000,
                'total_subscribers' => 0,
                'total_investment' => 0,
                'featured' => 0,
                'premium' => 1,
                'popular' => 0,
                'status' => 'Active',
            ],
            [
                'bot_name' => 'Volatility Hunter',
                'strategy_type' => 'Crypto',
                'description' => 'Precision entry and exit for high-volatility moves.',
                'monthly_return' => 19.10,
                'annual_return' => 220.00,
                'accuracy_rate' => 66.40,
                'drawdown' => 10.2,
                'risk_level' => 'High',
                'trading_style' => 'Swing',
                'minimum_investment' => 5000,
                'maximum_investment' => 25000,
                'total_subscribers' => 0,
                'total_investment' => 0,
                'featured' => 1,
                'premium' => 1,
                'popular' => 1,
                'status' => 'Active',
            ],
            [
                'bot_name' => 'Trend Divergence',
                'strategy_type' => 'Forex',
                'description' => 'Signal package built around divergence setups.',
                'monthly_return' => 15.25,
                'annual_return' => 180.00,
                'accuracy_rate' => 74.00,
                'drawdown' => 7.8,
                'risk_level' => 'Medium',
                'trading_style' => 'Swing',
                'minimum_investment' => 3400,
                'maximum_investment' => 17000,
                'total_subscribers' => 0,
                'total_investment' => 0,
                'featured' => 0,
                'premium' => 1,
                'popular' => 1,
                'status' => 'Active',
            ],
            [
                'bot_name' => 'Alpha Growth Engine',
                'strategy_type' => 'Stocks',
                'description' => 'High-conviction growth setups with adaptive risk.',
                'monthly_return' => 17.80,
                'annual_return' => 205.00,
                'accuracy_rate' => 77.80,
                'drawdown' => 6.3,
                'risk_level' => 'Medium',
                'trading_style' => 'Position',
                'minimum_investment' => 4500,
                'maximum_investment' => 22500,
                'total_subscribers' => 0,
                'total_investment' => 0,
                'featured' => 1,
                'premium' => 1,
                'popular' => 0,
                'status' => 'Active',
            ],
            [
                'bot_name' => 'Smart Entry Matrix',
                'strategy_type' => 'Forex',
                'description' => 'Smart entry timing for multi-timeframe Forex trends.',
                'monthly_return' => 13.40,
                'annual_return' => 165.00,
                'accuracy_rate' => 79.20,
                'drawdown' => 5.9,
                'risk_level' => 'Low',
                'trading_style' => 'Position',
                'minimum_investment' => 3600,
                'maximum_investment' => 18000,
                'total_subscribers' => 0,
                'total_investment' => 0,
                'featured' => 0,
                'premium' => 1,
                'popular' => 0,
                'status' => 'Active',
            ],
        ];

        foreach ($samples as $sample) {
            AiBot::firstOrCreate([
                'bot_name' => $sample['bot_name'],
                'premium' => 1,
            ], $sample);
        }

        // Create example investments (for demo) if there are users available
        $bots = AiBot::where('premium', 1)->get();
        $users = \App\Models\User::take(3)->get();

        foreach ($bots as $index => $bot) {
            $user = $users->get($index);
            if (!$user) break;

            $exists = BotInvestment::where('user_id', $user->id)->where('bot_id', $bot->id)->exists();
            if ($exists) continue;

            $start = now()->subDays(10);
            $end = $start->copy()->addDays(30);

            BotInvestment::create([
                'user_id' => $user->id,
                'bot_id' => $bot->id,
                'investment_amount' => $bot->minimum_investment,
                'current_profit' => 0,
                'current_balance' => $bot->minimum_investment,
                'start_date' => $start,
                'end_date' => $end,
                'status' => 'Running',
            ]);

            // Accrue profits for seeded user so some profit shows up
            \App\Http\Controllers\BotInvestmentController::accruePendingProfitsForUser($user);
        }
    }
}
