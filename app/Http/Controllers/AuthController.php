<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // This function handles logging out the user safely
    public function logout(Request $request)
    {
        // 1. Tell Laravel to log the user out
        Auth::logout();

        // 2. Clear out the user's session data from the server memory
        $request->session()->invalidate();

        // 3. Re-generate the security token so nobody can hijack the session
        $request->session()->regenerateToken();

        // 4. Send the user back to the explore page
        return redirect('/explore');
    }
}