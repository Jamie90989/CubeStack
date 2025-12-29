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
            
            'security_question_1' => 'required',
            'security_answer_1' => 'required|max:100',
            'security_question_2' => 'required',
            'security_answer_2' => 'required|max:100',
            'security_question_3' => 'required',
            'security_answer_3' => 'required|max:100',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

            'security_question_1' => $request->security_question_1,
            'security_answer_1' => $request->security_answer_1,

            'security_question_2' => $request->security_question_2,
            'security_answer_2' => $request->security_answer_2,

            'security_question_3' => $request->security_question_3,
            'security_answer_3' => $request->security_answer_3,
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
