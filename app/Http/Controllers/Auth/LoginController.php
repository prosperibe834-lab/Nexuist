<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // 1. Render the premium secure login terminal view layout
    public function showLoginForm()
    {
        return view('login'); 
    }

    // 2. Validate and authenticate the inbound identity handshake payload
    public function submit(Request $request)
    {
        $request->validate([
            'login_identity' => 'required|string',
            'password'       => 'required|string',
        ]);

        $loginField = filter_var($request->login_identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginField => $request->login_identity,
            'password'  => $request->password,
        ];

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            UserNotification::createForUser(
                Auth::user(),
                'Login',
                'New login detected from IP: ' . $request->ip() . '. User agent: ' . $request->userAgent()
            );

            return redirect('/')->with('success', 'Terminal authentication verified. Welcome back.');
        }

        return back()->withErrors([
            'login_identity' => 'The provided security credentials do not match our institutional node logs.',
        ])->onlyInput('login_identity');
    }

    // 3. Handle Logout and Redirect to Explore
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('explore');
    }
}