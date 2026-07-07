<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\CryptoInvestment;
use App\Models\StockInvestment;
use App\Models\BotInvestment;
use App\Models\RealEstateInvestment;
use App\Models\Transaction;

class ProcessInvestments extends Command
{
    protected $signature = 'investments:process';
    protected $description = 'Process running investments: accrue earnings and finalize completed ones.';

    public function handle()
    {
        $this->info('Processing investments...');

        $this->processModel(CryptoInvestment::class);
        $this->processModel(StockInvestment::class);
        $this->processModel(BotInvestment::class);
        $this->processRealEstateInvestments();

        $this->info('Processing complete.');
        return 0;
    }

    protected function processRealEstateInvestments(): void
    {
        $instances = RealEstateInvestment::where('investment_status', 'Active')->get();

        foreach ($instances as $inv) {
            try {
                DB::beginTransaction();

                $user = $inv->user;
                if (!$user) {
                    DB::commit();
                    continue;
                }

                $investmentDate = $inv->investment_date ? Carbon::parse($inv->investment_date) : null;
                $elapsedDays = $investmentDate ? max(0, now()->diffInDays($investmentDate)) : 0;

                $dailyRate = (($inv->apy ?? $inv->property?->estimated_apy ?? 0) / 100) / 365;

                $accruedProfit = round((float) $inv->investment_amount * $dailyRate * $elapsedDays, 2);

                $paidProfit = (float) Transaction::where('related_type', RealEstateInvestment::class)
                    ->where('related_id', $inv->id)
                    ->where('type', 'RealEstate Profit')
                    ->sum('amount');

                $profitDelta = max(0, round($accruedProfit - $paidProfit, 2));

                if ($profitDelta > 0) {
                    $before = $user->balance;
                    $user->balance = round($user->balance + $profitDelta, 2);
                    $user->save();

                    Transaction::create([
                        'user_id' => $user->id,
                        'type' => 'RealEstate Profit',
                        'amount' => $profitDelta,
                        'balance_before' => $before,
                        'balance_after' => $user->balance,
                        'related_id' => $inv->id,
                        'related_type' => RealEstateInvestment::class,
                        'transaction_id' => Transaction::generateTransactionId(),
                        'meta' => ['note' => 'Daily real estate profit payout'],
                        'status' => 'completed',
                    ]);
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('RealEstate processing error id=' . ($inv->id ?? 'n/a') . ': ' . $e->getMessage());
            }
        }
    }

    protected function processModel(string $modelClass): void
    {
        $instances = $modelClass::where('status', 'Running')->get();

        foreach ($instances as $inv) {
            try {
                DB::beginTransaction();

                // Refresh earnings to update current_profit/current_balance
                if (method_exists($inv, 'refreshEarnings')) {
                    $inv->refreshEarnings();
                }

                // Incremental profit payout logic respecting payout interval per-investment
                $user = $inv->user;
                $totalProfit = (float) ($inv->current_profit ?? 0);

                // determine payout interval
                $interval = 'daily';
                if ($modelClass === BotInvestment::class) {
                    $interval = 'hourly';
                } elseif (isset($inv->term) && in_array($inv->term, ['daily', 'monthly', 'yearly'])) {
                    $interval = $inv->term;
                }

                // last paid timestamp for profit
                $lastPaidAtValue = Transaction::where('related_type', $modelClass)
                    ->where('related_id', $inv->id)
                    ->where('type', 'Investment Profit')
                    ->latest('created_at')
                    ->value('created_at');

                $lastPaidAt = $lastPaidAtValue ? Carbon::parse($lastPaidAtValue) : ($inv->start_date ? Carbon::parse($inv->start_date) : null);

                $shouldPay = false;
                if (!$lastPaidAt) {
                    // never paid before -> allow immediate payout
                    $shouldPay = true;
                } else {
                    $nextPay = match ($interval) {
                        'hourly' => $lastPaidAt->copy()->addHour(),
                        'daily' => $lastPaidAt->copy()->addDay(),
                        'monthly' => $lastPaidAt->copy()->addMonth(),
                        'yearly' => $lastPaidAt->copy()->addYear(),
                        default => $lastPaidAt->copy()->addDay(),
                    };

                    if (Carbon::now()->greaterThanOrEqualTo($nextPay)) {
                        $shouldPay = true;
                    }
                }

                if ($shouldPay && $user) {
                    // Sum of previously paid profit transactions for this investment
                    $paidProfit = (float) Transaction::where('related_type', $modelClass)
                        ->where('related_id', $inv->id)
                        ->where('type', 'Investment Profit')
                        ->sum('amount');

                    $profitDelta = max(0, round($totalProfit - $paidProfit, 2));

                    if ($profitDelta > 0) {
                        $before = $user->balance;
                        $user->balance = round($user->balance + $profitDelta, 2);
                        $user->save();

                        Transaction::create([
                            'user_id' => $user->id,
                            'type' => 'Investment Profit',
                            'amount' => $profitDelta,
                            'balance_before' => $before,
                            'balance_after' => $user->balance,
                            'related_id' => $inv->id,
                            'related_type' => $modelClass,
                            'transaction_id' => Transaction::generateTransactionId(),
                            'meta' => ['note' => 'Interval-based profit payout', 'interval' => $interval],
                            'status' => 'completed',
                        ]);
                    }
                }

                // Finalize if end_date is set and reached - pay remaining profit + principal
                if (isset($inv->end_date) && $inv->end_date && now()->greaterThanOrEqualTo($inv->end_date)) {
                    // Recompute paidProfit after any incremental payout above
                    $paidProfitNow = (float) Transaction::where('related_type', $modelClass)
                        ->where('related_id', $inv->id)
                        ->where('type', 'Investment Profit')
                        ->sum('amount');

                    $remainingProfit = max(0, round(($inv->current_profit ?? 0) - $paidProfitNow, 2));

                    // Determine principal field
                    $principal = $inv->amount ?? $inv->investment_amount ?? ($inv->investment_amount ?? 0);
                    $principal = (float) $principal;

                    // Ensure we don't double-pay full payout
                    $alreadyPayout = Transaction::where('related_type', $modelClass)
                        ->where('related_id', $inv->id)
                        ->where('type', 'Investment Payout')
                        ->exists();

                    if (!$alreadyPayout) {
                        $payoutAmount = round($remainingProfit + $principal, 2);

                        if ($payoutAmount > 0 && $user) {
                            $before = $user->balance;
                            $user->balance = round($user->balance + $payoutAmount, 2);
                            $user->save();

                            Transaction::create([
                                'user_id' => $user->id,
                                'type' => 'Investment Payout',
                                'amount' => $payoutAmount,
                                'balance_before' => $before,
                                'balance_after' => $user->balance,
                                'related_id' => $inv->id,
                                'related_type' => $modelClass,
                                'transaction_id' => Transaction::generateTransactionId(),
                                'meta' => ['investment_status' => 'auto_completed'],
                                'status' => 'completed',
                            ]);
                        }

                        $inv->status = 'Completed';
                        $inv->save();
                    }
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('ProcessInvestments error for ' . $modelClass . ' id=' . ($inv->id ?? 'n/a') . ': ' . $e->getMessage());
            }
        }
    }
}
