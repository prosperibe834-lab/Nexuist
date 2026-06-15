<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RealEstateInvestment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_id',
        'investment_amount',
        'tokens_purchased',
        'token_price',
        'apy',
        'expected_profit',
        'investment_status',
        'investment_date',
    ];

    protected $casts = [
        'investment_amount' => 'decimal:2',
        'tokens_purchased' => 'decimal:8',
        'token_price' => 'decimal:2',
        'apy' => 'decimal:2',
        'expected_profit' => 'decimal:2',
        'investment_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(RealEstateProperty::class, 'property_id');
    }
}
