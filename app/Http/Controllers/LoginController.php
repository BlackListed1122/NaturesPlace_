<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    //@desc show login form
    //@route GET /login 
    public function login(): View
    {
        return view('account.login');
    }
    //@desc authenticate user form
    //@route POST /login 
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|string|email|max:100|',
            'password' => 'required|string'
        ]);
        if (Auth::attempt($credentials)) {
            //regenerate the session to prevent fixation attack

            $request->session()->regenerate();
            return redirect()->intended(route('menu.products'));
            // return redirect()->intended(route('/'))->with('success', 'You are now logged in!');
        }
        //if auth fails, redirect back with error
        return back()->withErrors([
            'email' => 'The provided credentials do not match out records'
        ])->onlyInput('email');
    }
    //@desc logout user
    //@route POST /logout 
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logged out successfully');
    }
}
