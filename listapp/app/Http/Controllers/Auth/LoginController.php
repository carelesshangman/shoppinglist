<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers; // Important trait
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Where to redirect after successful login
    protected $redirectTo = '/shopping-list';

    // Constructor (optional)
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login form submission
    public function login(Request $request)
    {
        // Validate input (you'll need to add these rules)
        $request->validate([
            'email' => 'required|email|exists:users,email', // Check if email exists
            'password' => 'required|min:8' // Example: Enforce minimum password length
        ]);

        // Attempt to authenticate
        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect()->intended($this->redirectTo);
        }

        // Redirect back on failure
        return back()->withErrors('Invalid credentials');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out

        $request->session()->invalidate(); // Invalidate the session

        $request->session()->regenerateToken();  // CSRF protection

        return redirect('/');  // Or redirect to any page you like
    }
}
