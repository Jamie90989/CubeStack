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

    public function toggleHideStandard(Request $request)
    {
        $user = $request->user();

        // Toggle the boolean
        $user->hideStandardAlgs = !$user->hideStandardAlgs;
        $user->save();

        return response()->json([
            'success' => true,
            'hideStandardAlgs' => $user->hideStandardAlgs
        ]);
    }

    // Show the edit form
    public function edit(User $user)
    {
        return view('editUser', compact('user'));
    }

    // Handle the form submission
    public function update(Request $request, User $user)
    {
      $request->validate([
        'name' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,

        'password' => 'nullable|string|min:8',

        'securityQuestion1' => 'nullable|string|max:255',
        'securityAnswer1' => 'nullable|string|max:255',

        'securityQuestion2' => 'nullable|string|max:255',
        'securityAnswer2' => 'nullable|string|max:255',

        'securityQuestion3' => 'nullable|string|max:255',
        'securityAnswer3' => 'nullable|string|max:255',
    ]);

    // Update only fields that are filled
    if ($request->filled('name')) {
        $user->name = $request->name;
    }

    if ($request->filled('email')) {
        $user->email = $request->email;
    }

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    for ($i = 1; $i <= 3; $i++) {
        $q = 'securityQuestion' . $i;
        $a = 'securityAnswer' . $i;

        if ($request->filled($q)) {
            $user->$q = $request->$q;
        }

        if ($request->filled($a)) {
            $user->$a = Hash::make($request->$a);
        }
    }

    $user->save();

    return redirect('/')
        ->with('success', 'Account updated successfully.');
    }
}
