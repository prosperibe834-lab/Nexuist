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

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'investment_amount' => 'decimal:2',
        'current_profit' => 'decimal:2',
        'current_balance' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bot()
    {
        return $this->belongsTo(AiBot::class);
    }

    public function getTermDaysAttribute()
    {
        return $this->end_date && $this->start_date
            ? max(1, $this->end_date->diffInDays($this->start_date))
            : 30;
    }

    public function getDailyReturnRateAttribute()
    {
        $monthlyRate = max(0, $this->bot?->monthly_return ?? 0);

        return ($monthlyRate / 100) / 30;
    }

    public function getAccruedProfitAttribute()
    {
        $elapsedDays = $this->start_date ? now()->diffInDays($this->start_date) : 0;
        $elapsedDays = min($elapsedDays, $this->term_days);

        return max(0, round($this->investment_amount * $this->daily_return_rate * $elapsedDays, 2));
    }

    public function refreshEarnings(): self
    {
        if ($this->status !== 'Running') {
            return $this;
        }

        $profit = $this->accrued_profit;
        $this->current_profit = $profit;
        $this->current_balance = round($this->investment_amount + $profit, 2);
        $this->save();

        return $this;
    }
}