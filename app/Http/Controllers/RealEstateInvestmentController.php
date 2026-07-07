<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRealEstateInvestmentRequest;
use App\Models\RealEstateInvestment;
use App\Models\RealEstateProperty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RealEstateInvestmentController extends Controller
{
    public function invest(StoreRealEstateInvestmentRequest $request)
    {
        DB::beginTransaction();

        try {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $property = RealEstateProperty::findOrFail($request->property_id);
            $investmentAmount = $request->investment_amount;

            if ($investmentAmount <= 0) {
                return response()->json(['success' => false, 'message' => 'Investment amount must be greater than zero.'], 400);
            }

            if ($property->token_price <= 0) {
                return response()->json(['success' => false, 'message' => 'Property token price is invalid.'], 400);
            }

            if ($investmentAmount < $property->minimum_investment) {
                return response()->json(['success' => false, 'message' => 'Investment amount is below minimum allowed.'], 400);
            }

            if ($investmentAmount > $property->maximum_investment) {
                return response()->json(['success' => false, 'message' => 'Investment amount exceeds maximum allowed.'], 400);
            }

            if ($user->balance < $investmentAmount) {
                return response()->json(['success' => false, 'message' => 'Insufficient balance. Please deposit funds before investing.'], 400);
            }

            if (bccomp($property->available_tokens, '0', 8) <= 0) {
                return response()->json(['success' => false, 'message' => 'This property is sold out.'], 400);
            }

            $maxAvailableAmount = bcmul($property->available_tokens, $property->token_price, 8);
            if (bccomp($maxAvailableAmount, (string)$investmentAmount, 8) < 0) {
                return response()->json(['success' => false, 'message' => 'Investment exceeds remaining available tokens.'], 400);
            }

            $tokensPurchased = round($investmentAmount / $property->token_price, 6);
            $expectedProfit = round($investmentAmount * ($property->estimated_apy / 100), 2);

            $user->balance -= $investmentAmount;
            $user->save();

            $investment = RealEstateInvestment::create([
                'user_id' => $user->id,
                'property_id' => $property->id,
                'investment_amount' => $investmentAmount,
                'tokens_purchased' => $tokensPurchased,
                'token_price' => $property->token_price,
                'apy' => $property->estimated_apy,
                'expected_profit' => $expectedProfit,
                'investment_status' => 'Active',
                'investment_date' => now(),
            ]);

            // Record transaction for investment deduction
            try {
                \App\Models\Transaction::create([
                    'user_id' => $user->id,
                    'type' => 'Investment',
                    'amount' => -1 * $investmentAmount,
                    'balance_before' => null,
                    'balance_after' => $user->balance,
                    'related_id' => $investment->id,
                    'related_type' => RealEstateInvestment::class,
                    'transaction_id' => \App\Models\Transaction::generateTransactionId(),
                    'meta' => ['property_id' => $property->id],
                    'status' => 'completed',
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to record real estate investment transaction: ' . $e->getMessage());
            }

            $property->sold_tokens = bcadd($property->sold_tokens, $tokensPurchased, 8);
            $property->available_tokens = max(0, bcsub($property->available_tokens, $tokensPurchased, 8));

            if ($property->available_tokens <= 0) {
                $property->available_tokens = 0;
                $property->property_status = 'Sold Out';
            }

            $property->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'investment' => $investment,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('RealEstateInvestment invest error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Investment failed. ' . $e->getMessage(),
            ], 500);
        }
    }

    public function portfolio()
    {
        $user = Auth::user();

        $investments = RealEstateInvestment::with('property')
            ->where('user_id', $user->id)
            ->get()
            ->each(function ($investment) {
                $investment->investment_duration_days = $investment->investment_date ? now()->diffInDays($investment->investment_date) : 0;
                $dailyRate = ($investment->apy / 100) / 365;
                $investment->accrued_profit = round($investment->investment_amount * $dailyRate * $investment->investment_duration_days, 2);
            });

        $totalInvested = $investments->sum('investment_amount');
        $totalProfit = $investments->sum('expected_profit');
        $totalAccrued = $investments->sum('accrued_profit');
        $activeCount = $investments->where('investment_status', 'Active')->count();
        $totalTokens = $investments->sum('tokens_purchased');
        $averageApy = $investments->count() ? round($investments->avg('apy'), 2) : 0;

        return response()->json([
            'investments' => $investments,
            'summary' => [
                'total_invested' => $totalInvested,
                'total_profit' => $totalProfit,
                'total_accrued_profit' => $totalAccrued,
                'active_properties_count' => $activeCount,
                'total_tokens_owned' => $totalTokens,
                'average_apy' => $averageApy,
            ],
        ]);
    }

    public function index()
    {
        $user = Auth::user();
        $query = RealEstateInvestment::with('property')
            ->where('user_id', $user->id);

        if (request()->filled('status')) {
            $query->where('investment_status', request()->input('status'));
        }

        $investments = $query->latest()->get()->each(function ($investment) {
            $investment->investment_duration_days = $investment->investment_date ? now()->diffInDays($investment->investment_date) : 0;
            $dailyRate = ($investment->apy / 100) / 365;
            $investment->accrued_profit = round($investment->investment_amount * $dailyRate * $investment->investment_duration_days, 2);
        });

        return response()->json($investments);
    }

    public function show($id)
    {
        $user = Auth::user();

        $investment = RealEstateInvestment::with('property')
            ->where('user_id', $user->id)
            ->findOrFail($id);

        return response()->json($investment);
    }
}
