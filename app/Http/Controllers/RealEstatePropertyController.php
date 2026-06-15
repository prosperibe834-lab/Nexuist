<?php

namespace App\Http\Controllers;

use App\Models\RealEstateProperty;
use Illuminate\Http\Request;

class RealEstatePropertyController extends Controller
{
    public function index(Request $request)
    {
        $existingProperties = RealEstateProperty::count();

        if ($existingProperties < 1) {
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
            $existingProperties++;
        }

        if ($existingProperties < 2) {
            RealEstateProperty::create([
                'property_name' => 'Daily Yield Tower',
                'slug' => 'daily-yield-tower',
                'property_type' => 'Condominium',
                'description' => 'A stabilized income property modeled for daily yield distributions from high-demand rental units.',
                'country' => 'USA',
                'state' => 'Florida',
                'city' => 'Miami',
                'address' => '104 Sunset Blvd',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'living_rooms' => 1,
                'kitchens' => 1,
                'parking_spaces' => 2,
                'property_size' => 3200,
                'year_built' => 2023,
                'market_value' => 1450000,
                'token_price' => 250,
                'total_tokens' => 5800,
                'available_tokens' => 5800,
                'sold_tokens' => 0,
                'minimum_investment' => 250,
                'maximum_investment' => 45000,
                'estimated_apy' => 14.8,
                'expected_annual_return' => 214000,
                'property_status' => 'Active',
                'featured_property' => false,
                'main_image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80',
            ]);
        }

        $properties = RealEstateProperty::query()
            ->active()
            ->with('galleries')
            ->filter($request)
            ->latest()
            ->paginate(12);

        return response()->json($properties);
    }

    public function show($slug)
    {
        $property = RealEstateProperty::with(['galleries', 'investments.user'])
            ->where('slug', $slug)
            ->where('property_status', 'Active')
            ->firstOrFail();

        return response()->json($property);
    }
}
