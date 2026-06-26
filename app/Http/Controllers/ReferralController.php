<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReferralController extends Controller
{
    public function userDashboard()
    {
        $user = Auth::user();

        if (! $user->referral_code) {
            $user->referral_code = $this->generateReferralCode($user);
            $user->save();
        }

        $referrals = User::where('referred_by', $user->id)->get();
        $totalReferrals = $referrals->count();
        $totalEarnings = $user->referral_earnings ?? 0;
        $currentTier = $this->getReferralTier($totalReferrals);
        $progressWidth = match ($currentTier) {
            'Starter' => 20,
            'Bronze' => 40,
            'Silver' => 60,
            'Gold' => 80,
            'Elite' => 100,
            default => 20,
        };
        $referralLink = url('/ref/' . $user->referral_code);
        $referralCode = $user->referral_code;

        $globalTierData = [
            ['name' => 'Starter', 'range' => '0-9 Referrals', 'reward' => '5% Comm.', 'active' => $currentTier === 'Starter'],
            ['name' => 'Bronze', 'range' => '10-24 Referrals', 'reward' => '7% Comm.', 'active' => $currentTier === 'Bronze'],
            ['name' => 'Silver', 'range' => '25-49 Referrals', 'reward' => '10% Comm.', 'active' => $currentTier === 'Silver'],
            ['name' => 'Gold', 'range' => '50-99 Referrals', 'reward' => '12% Comm.', 'active' => $currentTier === 'Gold'],
            ['name' => 'Elite', 'range' => '100+ Referrals', 'reward' => '15% Comm.', 'active' => $currentTier === 'Elite'],
        ];

        return view('referUser', compact(
            'totalReferrals',
            'totalEarnings',
            'currentTier',
            'referralLink',
            'referralCode',
            'progressWidth',
            'globalTierData',
            'referrals'
        ));
    }

    public function adminDashboard()
    {
        $referralUsers = User::whereNotNull('referral_code')
            ->withCount(['referrals'])
            ->get()
            ->map(function (User $user) {
                $tier = $this->getReferralTier($user->referrals_count);
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'country' => $user->country,
                    'referral_code' => $user->referral_code,
                    'referrals_count' => $user->referrals_count,
                    'total_earnings' => number_format($user->referral_earnings ?? 0, 2),
                    'tier' => $tier,
                    'status' => $this->getReferralStatus($tier),
                ];
            });

        $totalRegisteredReferrals = User::whereNotNull('referred_by')->count();
        $activeNetworkNodes = User::whereNotNull('referral_code')->count();
        $totalDistributedEarnings = User::sum('referral_earnings');
        $pendingAccumulations = 0;

        return view('AdminDashboard.AdminReferUSer', compact(
            'referralUsers',
            'totalRegisteredReferrals',
            'activeNetworkNodes',
            'totalDistributedEarnings',
            'pendingAccumulations'
        ));
    }

    protected function generateReferralCode(User $user): string
    {
        $base = strtoupper(Str::slug($user->username ?: $user->name, ''));
        $code = substr($base, 0, 6) . '-' . strtoupper(Str::random(4));

        while (User::where('referral_code', $code)->exists()) {
            $code = substr($base, 0, 6) . '-' . strtoupper(Str::random(4));
        }

        return $code;
    }

    protected function getReferralTier(int $totalReferrals): string
    {
        return match (true) {
            $totalReferrals >= 100 => 'Elite',
            $totalReferrals >= 50 => 'Gold',
            $totalReferrals >= 25 => 'Silver',
            $totalReferrals >= 10 => 'Bronze',
            default => 'Starter',
        };
    }

    protected function getReferralStatus(string $tier): string
    {
        return match ($tier) {
            'Elite' => 'Synchronized',
            'Gold' => 'Synchronized',
            'Silver' => 'Synchronized',
            'Bronze' => 'Synchronized',
            default => 'Pending',
        };
    }
}
