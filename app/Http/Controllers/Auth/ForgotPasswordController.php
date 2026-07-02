<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetOtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('forgot-password');
    }

    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = strtolower(trim($request->email));
        $user = User::where('email', $email)->first();

        if (! $user) {
            return back()->withErrors(['email' => 'We could not find an account with that email address.']);
        }

        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        Log::info('Generated OTP: ' . $otp);
        Log::info('Attempting password reset OTP email', ['email' => $email, 'otp' => $otp]);

        try {
            Mail::to($email)->send(new PasswordResetOtpMail($user, $otp));
            Log::info('Password reset OTP email sent successfully', ['email' => $email]);
        } catch (\Throwable $e) {
            Log::error('Password reset OTP email failed', [
                'email' => $email,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->withErrors(['email' => 'Mail send failed: ' . $e->getMessage()]);
        }

        session([
            'password_reset_email' => $email,
            'password_reset_otp' => $otp,
            'password_reset_verified' => false,
        ]);

        return redirect()->route('password.otp')->with('status', 'A 6-digit recovery code has been sent to your email address.');
    }

    public function showOtpForm()
    {
        if (! session('password_reset_email')) {
            return redirect()->route('password.request');
        }

        return view('otp-verification', ['email' => session('password_reset_email')]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        if (strtolower(trim($request->email)) !== session('password_reset_email') || $request->otp !== session('password_reset_otp')) {
            return back()->withErrors(['otp' => 'The recovery code you entered is invalid or has expired.']);
        }

        session(['password_reset_verified' => true]);

        return redirect()->route('password.reset.form');
    }

    public function showResetForm()
    {
        if (! session('password_reset_verified') || ! session('password_reset_email')) {
            return redirect()->route('password.otp');
        }

        return view('reset-password', ['email' => session('password_reset_email')]);
    }
}
