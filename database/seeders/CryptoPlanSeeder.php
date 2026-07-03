<?php

namespace Database\Seeders;

use App\Models\CryptoPlan;
use Illuminate\Database\Seeder;

class CryptoPlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Starter Vault',
                'tier' => 'Starter',
                'description' => 'Fast entry plan for first-time crypto investors.',
                'minimum_investment' => 100,
                'maximum_investment' => 1000,
                'daily_roi' => 1.60,
                'monthly_roi' => 48.00,
                'yearly_roi' => 576.00,
                'duration_days' => 14,
                'bonus' => 15,
                'status' => 'Active',
            ],
            [
                'name' => 'Momentum Pulse',
                'tier' => 'Starter',
                'description' => 'Balanced growth plan with steady daily compounding.',
                'minimum_investment' => 1000,
                'maximum_investment' => 5000,
                'daily_roi' => 2.20,
                'monthly_roi' => 66.00,
                'yearly_roi' => 792.00,
                'duration_days' => 21,
                'bonus' => 35,
                'status' => 'Active',
            ],
            [
                'name' => 'Growth Boost',
                'tier' => 'Starter',
                'description' => 'A stronger contract plan for consistent crypto returns.',
                'minimum_investment' => 5000,
                'maximum_investment' => 15000,
                'daily_roi' => 3.10,
                'monthly_roi' => 93.00,
                'yearly_roi' => 1116.00,
                'duration_days' => 21,
                'bonus' => 70,
                'status' => 'Active',
            ],
            [
                'name' => 'Flex Yield',
                'tier' => 'Growth',
                'description' => 'Higher yield with medium-term capital protection.',
                'minimum_investment' => 15000,
                'maximum_investment' => 30000,
                'daily_roi' => 4.40,
                'monthly_roi' => 132.00,
                'yearly_roi' => 1584.00,
                'duration_days' => 30,
                'bonus' => 95,
                'status' => 'Active',
            ],
            [
                'name' => 'Capital Surge',
                'tier' => 'Growth',
                'description' => 'A premium plan focused on accelerated market capture.',
                'minimum_investment' => 30000,
                'maximum_investment' => 75000,
                'daily_roi' => 5.80,
                'monthly_roi' => 174.00,
                'yearly_roi' => 2088.00,
                'duration_days' => 30,
                'bonus' => 140,
                'status' => 'Active',
            ],
            [
                'name' => 'Secure Alpha',
                'tier' => 'Advanced',
                'description' => 'Advanced yield plan with stronger diversification.',
                'minimum_investment' => 75000,
                'maximum_investment' => 150000,
                'daily_roi' => 7.40,
                'monthly_roi' => 222.00,
                'yearly_roi' => 2664.00,
                'duration_days' => 45,
                'bonus' => 220,
                'status' => 'Active',
            ],
            [
                'name' => 'Prime Asset',
                'tier' => 'Advanced',
                'description' => 'Institutional style returns with longer lock-in duration.',
                'minimum_investment' => 150000,
                'maximum_investment' => 300000,
                'daily_roi' => 9.20,
                'monthly_roi' => 276.00,
                'yearly_roi' => 3312.00,
                'duration_days' => 45,
                'bonus' => 350,
                'status' => 'Active',
            ],
            [
                'name' => 'Institutional Vault',
                'tier' => 'Premium',
                'description' => 'High-capital yield engine with premium capital protection.',
                'minimum_investment' => 300000,
                'maximum_investment' => 750000,
                'daily_roi' => 12.60,
                'monthly_roi' => 378.00,
                'yearly_roi' => 4536.00,
                'duration_days' => 60,
                'bonus' => 650,
                'status' => 'Active',
            ],
            [
                'name' => 'Apex Growth',
                'tier' => 'Premium',
                'description' => 'Elite growth contract for large-scale investors.',
                'minimum_investment' => 750000,
                'maximum_investment' => 1500000,
                'daily_roi' => 16.80,
                'monthly_roi' => 504.00,
                'yearly_roi' => 6048.00,
                'duration_days' => 60,
                'bonus' => 1200,
                'status' => 'Active',
            ],
            [
                'name' => 'Sovereign Infinity',
                'tier' => 'Elite',
                'description' => 'Top-tier long-horizon plan for premium capital allocation.',
                'minimum_investment' => 1500000,
                'maximum_investment' => 5000000,
                'daily_roi' => 24.50,
                'monthly_roi' => 735.00,
                'yearly_roi' => 8820.00,
                'duration_days' => 90,
                'bonus' => 2200,
                'status' => 'Active',
            ],
        ];

        foreach ($plans as $plan) {
            CryptoPlan::firstOrCreate(
                ['name' => $plan['name']],
                $plan
            );
        }
    }
}
