<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoInvestment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'crypto_plan_id',
        'amount',
        'term',
        'profit_rate',
        'current_profit',
        'current_balance',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'amount' => 'decimal:2',
        'profit_rate' => 'decimal:2',
        'current_profit' => 'decimal:2',
        'current_balance' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(CryptoPlan::class, 'crypto_plan_id');
    }
}
