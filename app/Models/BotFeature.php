<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BotFeature extends Model
{
    protected $fillable = [
        'bot_id',
        'feature_name'
    ];

    public function bot()
    {
        return $this->belongsTo(AiBot::class);
    }
}