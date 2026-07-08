<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Mail\PasswordResetOtpMail;

class AdminAuthController extends Controller
{
    // Fixed admin security PIN
    private const ADMIN_PIN = '921340';

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|alpha_dash|min:3|max:30|unique:users,username',
            'fullname' => 'required|string|min:3|max:100',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'phone'    => 'required|string',
            'country'  => 'sometimes|string|nullable',
            'password' => 'required|string|min:8|confirmed',
            'admin_pin'=> 'required|string',
        ]);

        if ($request->admin_pin !== self::ADMIN_PIN) {
            return back()->withErrors(['admin_pin' => 'Invalid admin security PIN.']);
        }

        $user = User::create([
            'username'    => $request->username,
            'name'        => $request->fullname,
            'email'       => $request->email,
            'phone'       => $request->phone,
            // Ensure country is not null when the form doesn't provide it
            'country'     => $request->country ?? '',
            'password'    => $request->password,
            'is_admin'    => true,
        ]);

        Auth::login($user);

        return redirect('/admin-dashboard')->with('success', 'Admin account created and signed in.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login_identity' => 'required|string',
            'password'       => 'required|string',
            'admin_pin'      => 'required|string',
        ]);

        if ($request->admin_pin !== self::ADMIN_PIN) {
            return back()->withErrors(['admin_pin' => 'Invalid admin security PIN.'])->onlyInput('login_identity');
        }

        $loginField = filter_var($request->login_identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginField => $request->login_identity,
            'password'  => $request->password,
            'is_admin'  => true,
        ];

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            return redirect('/admin-dashboard')->with('success', 'Admin authentication verified.');
        }

        return back()->withErrors([
            'login_identity' => 'The provided admin credentials do not match.',
        ])->onlyInput('login_identity');
    }

    /**
     * Send OTP to admin email for password reset.
     * Route name: admin-otp
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->where('is_admin', true)->first();
        if (! $user) {
            return back()->withErrors(['email' => 'No administrator account found for that email.'])->withInput();
        }

        // generate 6-digit numeric OTP
        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // store OTP in cache for 10 minutes
        $cacheKey = 'admin_password_reset:' . sha1($user->email);
        Cache::put($cacheKey, $otp, now()->addMinutes(10));

        // send email
        try {
            Mail::to($user->email)->send(new PasswordResetOtpMail($user, $otp));
        } catch (\Throwable $e) {
            \Log::error('Failed to send admin OTP email', ['email' => $user->email, 'exception' => $e]);
            return back()->withErrors(['email' => 'Unable to send OTP email. Please try again later.']);
        }

        return redirect('/admin-otp')->with('success', 'A one-time verification code has been sent to your email.');
    }

    /**
     * Reset admin password using OTP.
     * Route name: admin-reset
     */
    public function resetWithOtp(Request $request)
    {
        $otpValue = $request->input('otp');
        if (empty($otpValue)) {
            $otpValue = implode('', array_filter([
                $request->input('otp_digit_1'),
                $request->input('otp_digit_2'),
                $request->input('otp_digit_3'),
                $request->input('otp_digit_4'),
                $request->input('otp_digit_5'),
                $request->input('otp_digit_6'),
            ]));
            $request->merge(['otp' => $otpValue]);
        }

        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|string|size:6',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->where('is_admin', true)->first();
        if (! $user) {
            return back()->withErrors(['email' => 'No administrator account found for that email.'])->withInput();
        }

        $cacheKey = 'admin_password_reset:' . sha1($user->email);
        $cached = Cache::get($cacheKey);

        if (! $cached || $cached !== $request->otp) {
            return back()->withErrors(['otp' => 'Invalid or expired verification code.'])->withInput();
        }

        // update password (User model casts password => 'hashed')
        $user->password = $request->password;
        $user->save();

        // remove OTP from cache
        Cache::forget($cacheKey);

        return redirect('/admin-login')->with('success', 'Password reset successful. You can now login.');
    }
}
