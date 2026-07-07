<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockInvestment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stock_plan_id',
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
        return $this->belongsTo(StockPlan::class, 'stock_plan_id');
    }

    public function getTermDaysAttribute()
    {
        return match ($this->term) {
            'daily' => 1,
            'monthly' => 30,
            'yearly' => 365,
            default => 30,
        };
    }

    public function getAccruedProfitAttribute()
    {
        $elapsedDays = now()->diffInDays($this->start_date);
        if ($elapsedDays <= 0) {
            return 0.00;
        }

        $days = min($elapsedDays, $this->term_days);
        $dailyRate = match ($this->term) {
            'daily' => $this->profit_rate / 100,
            'monthly' => ($this->profit_rate / 100) / 30,
            'yearly' => ($this->profit_rate / 100) / 365,
            default => $this->profit_rate / 100,
        };

        return round($this->amount * $dailyRate * $days, 2);
    }

    public function refreshEarnings(): self
    {
        if ($this->status !== 'Running') {
            return $this;
        }

        $accrued = $this->accrued_profit;
        $this->current_profit = round($accrued, 2);
        $this->current_balance = round($this->amount + $accrued, 2);
        $this->save();

        return $this;
    }
}
