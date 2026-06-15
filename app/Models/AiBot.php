<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiBot extends Model
{
    protected $fillable = [
        'bot_name',
        'bot_image',
        'bot_logo',
        'strategy_type',
        'description',
        'monthly_return',
        'annual_return',
        'accuracy_rate',
        'drawdown',
        'risk_level',
        'trading_style',
        'minimum_investment',
        'maximum_investment',
        'total_subscribers',
        'total_investment',
        'featured',
        'premium',
        'popular',
        'status'
    ];

    public function features()
    {
        return $this->hasMany(BotFeature::class, 'bot_id');
    }

    public function investments()
    {
        return $this->hasMany(BotInvestment::class, 'bot_id');
    }
}