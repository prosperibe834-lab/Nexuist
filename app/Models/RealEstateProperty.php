<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class RealEstateProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_name',
        'slug',
        'property_type',
        'description',
        'country',
        'state',
        'city',
        'address',
        'bedrooms',
        'bathrooms',
        'living_rooms',
        'kitchens',
        'parking_spaces',
        'property_size',
        'year_built',
        'market_value',
        'token_price',
        'total_tokens',
        'available_tokens',
        'sold_tokens',
        'minimum_investment',
        'maximum_investment',
        'estimated_apy',
        'expected_annual_return',
        'property_status',
        'featured_property',
        'main_image',
    ];

    protected $casts = [
        'featured_property' => 'boolean',
        'market_value' => 'decimal:2',
        'token_price' => 'decimal:8',
        'total_tokens' => 'decimal:8',
        'available_tokens' => 'decimal:8',
        'sold_tokens' => 'decimal:8',
        'property_size' => 'decimal:2',
        'estimated_apy' => 'decimal:2',
        'expected_annual_return' => 'decimal:2',
    ];

    protected $appends = [
        'token_sale_percentage',
        'occupancy_progress',
        'investment_progress',
    ];

    public static function booted()
    {
        static::creating(function ($property) {
            if (empty($property->slug)) {
                $property->slug = Str::slug($property->property_name);
            }
        });
    }

    public static function seedDemoProperties(int $minimum = 10): void
    {
        $existingCount = static::count();
        if ($existingCount >= $minimum) {
            return;
        }

        $properties = [
            [
                'property_name' => 'Nexuist Heritage Estate',
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
                'minimum_investment' => 150,
                'maximum_investment' => 30000,
                'estimated_apy' => 12.5,
                'property_status' => 'Active',
                'featured_property' => true,
                'main_image' => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'property_name' => 'Daily Yield Tower',
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
                'minimum_investment' => 250,
                'maximum_investment' => 45000,
                'estimated_apy' => 14.8,
                'property_status' => 'Active',
                'featured_property' => false,
                'main_image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'property_name' => 'Azure Marina Residences',
                'property_type' => 'Apartment',
                'description' => 'High-yield waterfront apartments designed for premium short-term and long-term rental returns.',
                'country' => 'United Arab Emirates',
                'state' => 'Dubai',
                'city' => 'Dubai Marina',
                'address' => '39 Marina Walk',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'living_rooms' => 1,
                'kitchens' => 1,
                'parking_spaces' => 1,
                'property_size' => 1800,
                'year_built' => 2025,
                'market_value' => 860000,
                'token_price' => 180,
                'total_tokens' => 4800,
                'minimum_investment' => 180,
                'maximum_investment' => 25000,
                'estimated_apy' => 13.2,
                'property_status' => 'Active',
                'featured_property' => false,
                'main_image' => 'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'property_name' => 'Capital Crest Offices',
                'property_type' => 'Commercial',
                'description' => 'A premium office tower providing diversified cash flow from multiple enterprise tenants.',
                'country' => 'United Kingdom',
                'state' => 'England',
                'city' => 'London',
                'address' => '7 Bishopsgate',
                'bedrooms' => 0,
                'bathrooms' => 4,
                'living_rooms' => 0,
                'kitchens' => 2,
                'parking_spaces' => 10,
                'property_size' => 12500,
                'year_built' => 2022,
                'market_value' => 2850000,
                'token_price' => 320,
                'total_tokens' => 8900,
                'minimum_investment' => 320,
                'maximum_investment' => 60000,
                'estimated_apy' => 11.7,
                'property_status' => 'Active',
                'featured_property' => false,
                'main_image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'property_name' => 'Horizon Park Apartments',
                'property_type' => 'Apartment',
                'description' => 'Luxury park-facing apartments with predictable rental yield and strong occupancy forecasts.',
                'country' => 'Canada',
                'state' => 'Ontario',
                'city' => 'Toronto',
                'address' => '218 Queen St',
                'bedrooms' => 3,
                'bathrooms' => 3,
                'living_rooms' => 1,
                'kitchens' => 1,
                'parking_spaces' => 2,
                'property_size' => 3500,
                'year_built' => 2024,
                'market_value' => 1950000,
                'token_price' => 270,
                'total_tokens' => 7200,
                'minimum_investment' => 270,
                'maximum_investment' => 50000,
                'estimated_apy' => 13.8,
                'property_status' => 'Active',
                'featured_property' => false,
                'main_image' => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'property_name' => 'Summit Ridge Villas',
                'property_type' => 'Villa',
                'description' => 'Hillside villa residences with strong family rental demand and promising capital appreciation.',
                'country' => 'Spain',
                'state' => 'Catalonia',
                'city' => 'Barcelona',
                'address' => '5 Ridge Way',
                'bedrooms' => 5,
                'bathrooms' => 4,
                'living_rooms' => 2,
                'kitchens' => 2,
                'parking_spaces' => 3,
                'property_size' => 6200,
                'year_built' => 2021,
                'market_value' => 2200000,
                'token_price' => 340,
                'total_tokens' => 7600,
                'minimum_investment' => 340,
                'maximum_investment' => 65000,
                'estimated_apy' => 12.9,
                'property_status' => 'Active',
                'featured_property' => false,
                'main_image' => 'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'property_name' => 'Crescent Bay Lofts',
                'property_type' => 'Loft',
                'description' => 'Urban loft development with excellent rental yield potential for premium creative tenants.',
                'country' => 'Australia',
                'state' => 'New South Wales',
                'city' => 'Sydney',
                'address' => '88 Harbour Rd',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'living_rooms' => 1,
                'kitchens' => 1,
                'parking_spaces' => 1,
                'property_size' => 2200,
                'year_built' => 2024,
                'market_value' => 1100000,
                'token_price' => 190,
                'total_tokens' => 5800,
                'minimum_investment' => 190,
                'maximum_investment' => 28000,
                'estimated_apy' => 15.0,
                'property_status' => 'Active',
                'featured_property' => false,
                'main_image' => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'property_name' => 'Orchard Grove Townhomes',
                'property_type' => 'Townhome',
                'description' => 'Suburban townhomes positioned for stable long-term rental income and solid neighborhood demand.',
                'country' => 'USA',
                'state' => 'Georgia',
                'city' => 'Atlanta',
                'address' => '412 Orchard Lane',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'living_rooms' => 1,
                'kitchens' => 1,
                'parking_spaces' => 2,
                'property_size' => 2600,
                'year_built' => 2022,
                'market_value' => 980000,
                'token_price' => 160,
                'total_tokens' => 6100,
                'minimum_investment' => 160,
                'maximum_investment' => 24000,
                'estimated_apy' => 14.2,
                'property_status' => 'Active',
                'featured_property' => false,
                'main_image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'property_name' => 'Platinum Square Center',
                'property_type' => 'Retail',
                'description' => 'A retail hub with diversified tenant mix, providing recurring rental cash flow for yield investors.',
                'country' => 'Singapore',
                'state' => 'Central',
                'city' => 'Singapore',
                'address' => '1 Orchard Road',
                'bedrooms' => 0,
                'bathrooms' => 4,
                'living_rooms' => 0,
                'kitchens' => 2,
                'parking_spaces' => 20,
                'property_size' => 18000,
                'year_built' => 2020,
                'market_value' => 3200000,
                'token_price' => 420,
                'total_tokens' => 9500,
                'minimum_investment' => 420,
                'maximum_investment' => 80000,
                'estimated_apy' => 13.9,
                'property_status' => 'Active',
                'featured_property' => false,
                'main_image' => 'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'property_name' => 'Solstice Corporate Campus',
                'property_type' => 'Campus',
                'description' => 'A corporate campus built for modern enterprise tenants, with strong cash flow visibility and yield.',
                'country' => 'Germany',
                'state' => 'Bavaria',
                'city' => 'Munich',
                'address' => '310 Innovation Drive',
                'bedrooms' => 0,
                'bathrooms' => 6,
                'living_rooms' => 0,
                'kitchens' => 4,
                'parking_spaces' => 40,
                'property_size' => 26000,
                'year_built' => 2021,
                'market_value' => 4100000,
                'token_price' => 450,
                'total_tokens' => 10200,
                'minimum_investment' => 450,
                'maximum_investment' => 90000,
                'estimated_apy' => 12.3,
                'property_status' => 'Active',
                'featured_property' => false,
                'main_image' => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=900&q=80',
            ],
        ];

        foreach ($properties as $propertyData) {
            if (static::where('property_name', $propertyData['property_name'])->exists()) {
                continue;
            }

            $slug = Str::slug($propertyData['property_name']);
            $slugCount = static::where('slug', 'LIKE', "$slug%" )->count();
            if ($slugCount) {
                $slug = $slug . '-' . ($slugCount + 1);
            }

            static::create(array_merge($propertyData, [
                'slug' => $slug,
                'available_tokens' => $propertyData['total_tokens'],
                'sold_tokens' => 0,
                'expected_annual_return' => round($propertyData['market_value'] * ($propertyData['estimated_apy'] / 100), 2),
            ]));
        }
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(PropertyGallery::class, 'property_id');
    }

    public function investments(): HasMany
    {
        return $this->hasMany(RealEstateInvestment::class, 'property_id');
    }

    public function scopeActive($query)
    {
        return $query->where('property_status', 'Active');
    }

    public function scopeFilter($query, $filters)
    {
        if ($filters->filled('search')) {
            $query->where(function ($subQuery) use ($filters) {
                $term = '%' . $filters->input('search') . '%';
                $subQuery->where('property_name', 'LIKE', $term)
                    ->orWhere('city', 'LIKE', $term)
                    ->orWhere('state', 'LIKE', $term)
                    ->orWhere('country', 'LIKE', $term);
            });
        }

        if ($filters->filled('property_type')) {
            $query->where('property_type', $filters->input('property_type'));
        }

        if ($filters->filled('status')) {
            $query->where('property_status', $filters->input('status'));
        }

        if ($filters->filled('location')) {
            $query->where(function ($subQuery) use ($filters) {
                $term = '%' . $filters->input('location') . '%';
                $subQuery->where('city', 'LIKE', $term)
                    ->orWhere('state', 'LIKE', $term)
                    ->orWhere('country', 'LIKE', $term);
            });
        }

        if ($filters->filled('apy_min')) {
            $query->where('estimated_apy', '>=', $filters->input('apy_min'));
        }

        if ($filters->filled('apy_max')) {
            $query->where('estimated_apy', '<=', $filters->input('apy_max'));
        }

        if ($filters->filled('investment_min')) {
            $query->where('minimum_investment', '>=', $filters->input('investment_min'));
        }

        if ($filters->filled('investment_max')) {
            $query->where('maximum_investment', '<=', $filters->input('investment_max'));
        }

        if ($filters->filled('bedrooms')) {
            $query->where('bedrooms', $filters->input('bedrooms'));
        }

        if ($filters->filled('bathrooms')) {
            $query->where('bathrooms', $filters->input('bathrooms'));
        }

        return $query;
    }

    public function getTokenSalePercentageAttribute(): float
    {
        if ($this->total_tokens <= 0) {
            return 0.0;
        }

        return round(($this->sold_tokens / $this->total_tokens) * 100, 2);
    }

    public function getOccupancyProgressAttribute(): float
    {
        return $this->token_sale_percentage;
    }

    public function getInvestmentProgressAttribute(): float
    {
        return $this->token_sale_percentage;
    }
}
