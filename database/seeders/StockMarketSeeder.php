<?php

namespace Database\Seeders;

use App\Models\StockPlan;
use App\Models\StockPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockMarketSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        if (StockPlan::count() === 0) {
            StockPlan::insert([
                [
                    'name' => 'Blue Chip Income Vault',
                    'tier' => 'Institutional',
                    'description' => 'Structured allocation across leading dividend-paying equities with predictable quarterly returns.',
                    'minimum_investment' => 500,
                    'maximum_investment' => 10000,
                    'daily_roi' => 0.80,
                    'monthly_roi' => 24.0,
                    'yearly_roi' => 300.0,
                    'duration_days' => 30,
                    'bonus' => 50,
                    'status' => 'Active',
                ],
                [
                    'name' => 'Growth Momentum Basket',
                    'tier' => 'Premium',
                    'description' => 'High-conviction growth equities selected for momentum and sector leadership.',
                    'minimum_investment' => 2000,
                    'maximum_investment' => 25000,
                    'daily_roi' => 1.20,
                    'monthly_roi' => 36.0,
                    'yearly_roi' => 420.0,
                    'duration_days' => 60,
                    'bonus' => 120,
                    'status' => 'Active',
                ],
                [
                    'name' => 'Global Tech Accumulator',
                    'tier' => 'Elite',
                    'description' => 'Exposure to global technology leaders with disciplined rebalancing and volatility controls.',
                    'minimum_investment' => 5000,
                    'maximum_investment' => 50000,
                    'daily_roi' => 1.75,
                    'monthly_roi' => 52.5,
                    'yearly_roi' => 630.0,
                    'duration_days' => 90,
                    'bonus' => 300,
                    'status' => 'Active',
                ],
            ]);
        }

        if (StockPost::count() === 0) {
            StockPost::insert([
                [
                    'title' => 'Market Outlook: Equities Set to Resume Seasonal Rally',
                    'body' => 'Our analysts expect strong rotation into tech and renewable energy equities over the next 30 days. Structured stock portfolios are positioned to capture these trends with a diversified buffer.',
                    'image_url' => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?auto=format&fit=crop&w=900&q=80',
                ],
                [
                    'title' => 'Daily Alpha Update: Top Stock Picks for Weekend Positions',
                    'body' => 'Review the latest corporate earnings momentum and select stock baskets showing consistent upside. Daily plans are ideal for shorter horizon exposure with efficient risk controls.',
                    'image_url' => 'https://images.unsplash.com/photo-1496307042754-b4aa456c4a2d?auto=format&fit=crop&w=900&q=80',
                ],
                [
                    'title' => 'Long-Term Growth Strategy: Yearly Equity Holdings',
                    'body' => 'Our yearly plans combine stable blue chips and emerging leaders for disciplined capital appreciation. This strategy is built to generate compound returns while protecting downside via sector diversification.',
                    'image_url' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=900&q=80',
                ],
            ]);
        }
    }
}
