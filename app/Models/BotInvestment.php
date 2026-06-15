<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BotInvestment extends Model
{
    protected $fillable = [
        'user_id',
        'bot_id',
        'investment_amount',
        'current_profit',
        'current_balance',
        'start_date',
        'end_date',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bot()
    {
        return $this->belongsTo(AiBot::class);
    }
}