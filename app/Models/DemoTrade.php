<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemoTrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'asset',
        'direction',
        'amount',
        'leverage',
        'duration_minutes',
        'notional_value',
        'status',
        'pnl',
        'result',
        'opened_at',
        'closed_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'notional_value' => 'decimal:2',
        'pnl' => 'decimal:2',
        'opened_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
