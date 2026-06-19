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
        if (AiBot::where('premium', 1)->count() >= 3) {
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
