<?php

namespace Database\Seeders;

use App\Models\RealEstateProperty;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        if (RealEstateProperty::count() === 0) {
            RealEstateProperty::create([
                'property_name' => 'Nexuist Heritage Estate',
                'slug' => 'nexuist-heritage-estate',
                'property_type' => 'Villa',
                'description' => 'A demonstration tokenized real estate asset with strong rental yield and structurally verified amenities.',
                'country' => 'Nigeria',
                'state' => 'Lagos',
                'city' => 'Ikeja',
                'address' => '12 Eko Avenue, Victoria Island',
                'bedrooms' => 4,
                'bathrooms' => 3,
                'living_rooms' => 1,
                'kitchens' => 1,
                'parking_spaces' => 2,
                'property_size' => 4500,
                'year_built' => 2024,
                'market_value' => 1200000,
                'token_price' => 150,
                'total_tokens' => 8000,
                'available_tokens' => 8000,
                'sold_tokens' => 0,
                'minimum_investment' => 150,
                'maximum_investment' => 30000,
                'estimated_apy' => 12.5,
                'expected_annual_return' => 150000,
                'property_status' => 'Active',
                'featured_property' => true,
                'main_image' => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=900&q=80',
            ]);
        }

        $this->call(StockMarketSeeder::class);
    }
}
