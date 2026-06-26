<?php

namespace App\Http\Controllers;

use App\Models\BotInvestment;
use App\Models\CryptoInvestment;
use App\Models\Deposit;
use App\Models\RealEstateInvestment;
use App\Models\StockInvestment;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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

        $cryptoProfit = CryptoInvestment::where('user_id', $user->id)->get()->sum(function ($investment) {
            return $investment->status === 'Running'
                ? $investment->accrued_profit
                : $investment->current_profit;
        });

        $stockProfit = StockInvestment::where('user_id', $user->id)->get()->sum(function ($investment) {
            return $investment->status === 'Running'
                ? $investment->accrued_profit
                : $investment->current_profit;
        });

        $totalProfit = $realEstateProfit + $botProfit + $cryptoProfit + $stockProfit;

        return view('index', compact('totalDeposit', 'bonus', 'totalProfit'));
    }

    public function profileSetting()
    {
        $user = Auth::user();

        $countries = [
            'Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola', 'Antigua and Barbuda', 'Argentina', 'Armenia', 'Australia', 'Austria',
            'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bhutan',
            'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei', 'Bulgaria', 'Burkina Faso', 'Burundi', 'Cabo Verde', 'Cambodia',
            'Cameroon', 'Canada', 'Central African Republic', 'Chad', 'Chile', 'China', 'Colombia', 'Comoros', 'Congo (Congo-Brazzaville)', 'Costa Rica',
            'Côte d’Ivoire', 'Croatia', 'Cuba', 'Cyprus', 'Czechia', 'Democratic Republic of the Congo', 'Denmark', 'Djibouti', 'Dominica', 'Dominican Republic',
            'Ecuador', 'Egypt', 'El Salvador', 'Equatorial Guinea', 'Eritrea', 'Estonia', 'Eswatini', 'Ethiopia', 'Fiji', 'Finland',
            'France', 'Gabon', 'Gambia', 'Georgia', 'Germany', 'Ghana', 'Greece', 'Grenada', 'Guatemala', 'Guinea',
            'Guinea-Bissau', 'Guyana', 'Haiti', 'Honduras', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq',
            'Ireland', 'Israel', 'Italy', 'Jamaica', 'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati', 'Kuwait',
            'Kyrgyzstan', 'Laos', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libya', 'Liechtenstein', 'Lithuania', 'Luxembourg',
            'Madagascar', 'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta', 'Marshall Islands', 'Mauritania', 'Mauritius', 'Mexico',
            'Micronesia', 'Moldova', 'Monaco', 'Mongolia', 'Montenegro', 'Morocco', 'Mozambique', 'Myanmar', 'Namibia', 'Nauru',
            'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'North Korea', 'North Macedonia', 'Norway', 'Oman',
            'Pakistan', 'Palau', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines', 'Poland', 'Portugal', 'Qatar',
            'Romania', 'Russia', 'Rwanda', 'Saint Kitts and Nevis', 'Saint Lucia', 'Saint Vincent and the Grenadines', 'Samoa', 'San Marino', 'Sao Tome and Principe', 'Saudi Arabia',
            'Senegal', 'Serbia', 'Seychelles', 'Sierra Leone', 'Singapore', 'Slovakia', 'Slovenia', 'Solomon Islands', 'Somalia', 'South Africa',
            'South Korea', 'South Sudan', 'Spain', 'Sri Lanka', 'Sudan', 'Suriname', 'Sweden', 'Switzerland', 'Syria', 'Taiwan',
            'Tajikistan', 'Tanzania', 'Thailand', 'Timor-Leste', 'Togo', 'Tonga', 'Trinidad and Tobago', 'Tunisia', 'Turkey', 'Turkmenistan',
            'Tuvalu', 'Uganda', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States of America', 'Uruguay', 'Uzbekistan',
            'Vanuatu', 'Vatican City', 'Venezuela', 'Vietnam', 'Yemen', 'Zambia', 'Zimbabwe',
        ];

        $activities = $this->getRecentActivity($user);

        if (session('success')) {
            $activities->prepend([
                'icon' => 'bx-refresh',
                'css' => 'update',
                'activity' => 'Profile Updated',
                'description' => session('success'),
                'time' => now()->diffForHumans(),
                'timestamp' => now(),
            ]);
            $activities = $activities->take(4);
        }

        return view('profilesetting', compact('user', 'countries', 'activities'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:25',
            'country' => 'nullable|string|max:100',
        ]);

        /** @var \App\Models\User $user */
        $user->update($validated);

        UserNotification::createForUser(
            $user,
            'Profile Update',
            'Your profile was successfully updated. Changes are now active.'
        );

        session()->flash('success', 'Profile updated successfully');

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'user' => $user,
            ]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    protected function getRecentActivity(User $user)
    {
        $activities = collect();

        $deposits = Deposit::where('user_id', $user->id)->latest()->take(2)->get();
        foreach ($deposits as $deposit) {
            $activities->push([
                'icon' => 'bx-wallet',
                'css' => 'deposit',
                'activity' => 'Deposit ' . ucfirst($deposit->status),
                'description' => 'Amount $' . number_format($deposit->amount, 2) . ' via ' . ($deposit->method ?? 'bank'),
                'time' => $deposit->created_at?->diffForHumans() ?? 'Just now',
                'timestamp' => $deposit->created_at ?? now(),
            ]);
        }

        $botInvestments = BotInvestment::where('user_id', $user->id)->latest()->take(2)->get();
        foreach ($botInvestments as $investment) {
            $activities->push([
                'icon' => 'bx-trending-up',
                'css' => 'bot',
                'activity' => 'AI Bot Trade',
                'description' => 'Invested $' . number_format($investment->amount, 2) . ' in bot trading',
                'time' => $investment->created_at?->diffForHumans() ?? 'Just now',
                'timestamp' => $investment->created_at ?? now(),
            ]);
        }

        $cryptoInvestments = CryptoInvestment::where('user_id', $user->id)->latest()->take(2)->get();
        foreach ($cryptoInvestments as $investment) {
            $activities->push([
                'icon' => 'bx-bitcoin',
                'css' => 'crypto',
                'activity' => 'Crypto Investment',
                'description' => 'Invested $' . number_format($investment->amount, 2) . ' into crypto',
                'time' => $investment->created_at?->diffForHumans() ?? 'Just now',
                'timestamp' => $investment->created_at ?? now(),
            ]);
        }

        $stockInvestments = StockInvestment::where('user_id', $user->id)->latest()->take(2)->get();
        foreach ($stockInvestments as $investment) {
            $activities->push([
                'icon' => 'bx-line-chart',
                'css' => 'stock',
                'activity' => 'Stock Investment',
                'description' => 'Invested $' . number_format($investment->amount, 2) . ' in stock market',
                'time' => $investment->created_at?->diffForHumans() ?? 'Just now',
                'timestamp' => $investment->created_at ?? now(),
            ]);
        }

        if ($activities->isEmpty()) {
            $activities->push([
                'icon' => 'bx-log-in-circle',
                'css' => 'login',
                'activity' => 'Account Login',
                'description' => 'Signed in successfully',
                'time' => now()->diffForHumans(),
                'timestamp' => now(),
            ]);
            $activities->push([
                'icon' => 'bx-refresh',
                'css' => 'update',
                'activity' => 'Profile Viewed',
                'description' => 'Opened profile settings page',
                'time' => now()->diffForHumans(),
                'timestamp' => now(),
            ]);
        }

        return $activities->sortByDesc('timestamp')->values()->take(4);
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
