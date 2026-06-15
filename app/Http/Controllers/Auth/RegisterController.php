<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function submit(Request $request)
    {
        // 1. Validation block
        $request->validate([
            'username'           => 'required|string|alpha_dash|min:3|max:30|unique:users,username',
            'fullname'           => 'required|string|min:3|max:100',
            'email'              => 'required|string|email|max:255|unique:users,email',
            'phone_country_code' => 'required|string', 
            'phone'              => 'required|string|min:7|max:15',
            'country'            => 'required|string|max:100',
            'password'           => 'required|string|min:8|confirmed', 
        ]);

        // 2. Create and save the new trader profile
        $user = User::create([
            'username' => $request->username,
            'name'     => $request->fullname,
            'email'    => $request->email,
            'phone'    => $request->phone_country_code . ' ' . trim($request->phone),
            'country'  => $request->country,
            'password' => Hash::make($request->password),
        ]);

        // Log the user into their new session instantly
        Auth::login($user);

        // FIXED: Using direct path redirect instead of named route syntax
        return redirect('/')->with('success', 'Welcome to Nexuist! Your secure trading terminal is ready.');
    }
}