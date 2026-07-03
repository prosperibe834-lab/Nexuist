<?php

namespace Tests\Unit;

use App\Models\CryptoInvestment;
use App\Models\CryptoPlan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class CryptoInvestmentEarningsTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_accrues_profit_and_updates_balance_for_running_crypto_investments(): void
    {
        Carbon::setTestNow(Carbon::create(2026, 7, 10, 12, 0, 0));

        $user = User::factory()->create();

        $plan = CryptoPlan::create([
            'name' => 'Momentum Vault',
            'tier' => 'Starter',
            'description' => 'Daily growth plan',
            'minimum_investment' => 100,
            'maximum_investment' => 5000,
            'daily_roi' => 2.00,
            'monthly_roi' => 60.00,
            'yearly_roi' => 720.00,
            'duration_days' => 30,
            'bonus' => 0,
            'status' => 'Active',
        ]);

        $investment = CryptoInvestment::create([
            'user_id' => $user->id,
            'crypto_plan_id' => $plan->id,
            'amount' => 1000.00,
            'term' => 'monthly',
            'profit_rate' => 2.00,
            'current_profit' => 0.00,
            'current_balance' => 1000.00,
            'start_date' => now()->subDays(5),
            'end_date' => now()->addDays(25),
            'status' => 'Running',
        ]);

        $investment->refreshEarnings();

        $this->assertGreaterThan(0.0, (float) $investment->current_profit);
        $this->assertGreaterThan(1000.0, (float) $investment->current_balance);
    }
}
