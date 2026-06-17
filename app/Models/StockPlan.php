<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockPlan extends Model
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
        return $this->hasMany(StockInvestment::class, 'stock_plan_id');
    }
}
