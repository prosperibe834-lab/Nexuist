<?php

namespace App\Http\Controllers;
use App\Models\Deposit;
use App\Models\RealEstateInvestment;
use App\Models\BotInvestment;
use Illuminate\Support\Facades\Auth;

use App\Models\User; // Ensure this points to your User model
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
{
    $users = User::latest()->get();

    $totalUsers = User::count();

    $verifiedUsers = User::where('kyc_status', 'approved')->count();

    $verifiedPercentage = $totalUsers > 0
        ? round(($verifiedUsers / $totalUsers) * 100, 1)
        : 0;

    return view('AdminDashboard.users', compact(
        'users',
        'totalUsers',
        'verifiedUsers',
        'verifiedPercentage'
    ));
}

    public function dashboard()
    {
        $user = Auth::user();
        $totalDeposit = Deposit::where('user_id', $user->id)
            ->where('status', 'Approved')
            ->sum('amount');

        $bonus = $user->bonus ?? 0;
        $realEstateProfit = RealEstateInvestment::where('user_id', $user->id)
            ->where('investment_status', 'Active')
            ->get()
            ->sum(function ($investment) {
                $investmentDurationDays = $investment->investment_date ? max(0, now()->diffInDays($investment->investment_date)) : 0;
                $apy = floatval($investment->apy);
                if ($investment->investment_amount <= 0 || $apy <= 0 || $investmentDurationDays <= 0) {
                    return 0;
                }
                $dailyRate = ($apy / 100) / 365;
                return max(0, round($investment->investment_amount * $dailyRate * $investmentDurationDays, 2));
            });

        $botProfit = BotInvestment::where('user_id', $user->id)->sum('current_profit');

        $totalProfit = $realEstateProfit + $botProfit;

        return view('index', compact('totalDeposit', 'bonus', 'totalProfit'));
    }

    public function updateBalance(Request $request, $userId)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'balance' => 'required|numeric|min:0',
            'crypto_balance' => 'nullable|string'
        ]);

        try {
            // Find the user
            $user = User::findOrFail($userId);

            // Update using mass assignment
            $user->update([
                'balance' => $validated['balance'],
                'crypto_balance' => $validated['crypto_balance'] ?? $user->crypto_balance
            ]);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Balance updated successfully',
                'user' => $user
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating balance: ' . $e->getMessage()
            ], 500);
        }
    }
}
