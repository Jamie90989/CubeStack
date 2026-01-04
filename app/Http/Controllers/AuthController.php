<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Show register form
    public function showRegister()
    {
        return view('register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:100',

            'securityQuestion1' => 'required',
            'securityAnswer1' => 'required|max:100',
            'securityQuestion2' => 'required',
            'securityAnswer2' => 'required|max:100',
            'securityQuestion3' => 'required',
            'securityAnswer3' => 'required|max:100',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

            'securityQuestion1' => $request->securityQuestion1,
            'securityAnswer1' => Hash::make($request->securityAnswer1),

            'securityQuestion2' => $request->securityQuestion2,
            'securityAnswer2' => Hash::make($request->securityAnswer2),

            'securityQuestion3' => $request->securityQuestion3,
            'securityAnswer3' => Hash::make($request->securityAnswer3),
        ]);

        Auth::login($user);

        return redirect('/account');
    }

    // Show login
    public function showLogin()
    {
        return view('login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/account');
        }

        return back()->withErrors(['email' => 'Invalid login credentials']);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
