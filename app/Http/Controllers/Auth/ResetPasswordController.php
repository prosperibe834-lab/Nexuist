<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /** Handle a password reset request. */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        if (! session('password_reset_verified') || strtolower(trim($request->email)) !== session('password_reset_email')) {
            return back()->withErrors(['email' => 'Your recovery session has expired. Please start again.']);
        }

        $user = User::where('email', strtolower(trim($request->email)))->first();

        if (! $user) {
            return back()->withErrors(['email' => 'We could not find an account with that email address.']);
        }

        $user->password = Hash::make($request->password);
        $user->setRememberToken(Str::random(60));
        $user->save();
        event(new PasswordReset($user));

        session()->forget(['password_reset_email', 'password_reset_otp', 'password_reset_verified']);

        return redirect('/login')->with('status', 'Your password has been updated successfully. Please sign in.');
    }
}
