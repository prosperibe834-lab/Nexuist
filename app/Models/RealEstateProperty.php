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
