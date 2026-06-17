<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tier',
        'description',
        'minimum_investment',
        'maximum_investment',
        'daily_roi',
        'monthly_roi',
        'yearly_roi',
        'duration_days',
        'bonus',
        'status',
    ];

    public function investments()
    {
        return $this->hasMany(CryptoInvestment::class, 'crypto_plan_id');
    }
}
