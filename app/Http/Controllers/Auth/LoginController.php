<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Display the login form view.
     *
     * @return View
     */
    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate the login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'remember_me' => 'nullable|boolean',
        ]);

        // Attempt to log the user in
        if (auth()->attempt($request->only('email', 'password'), $request->boolean('remember_me'))) {
            // If successful, redirect to the intended page or default route
            return redirect()->route('home')->with('success', __('Hello :name! You are logged in.', ['name' => auth()->user()->name]));
        }

        // If login fails, redirect back with an error message
        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => __('auth.failed')]);
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request)
    {
        // Log the user out
        auth()->logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        // Redirect to the login page with a success message
        return redirect()->route('login')->with('success', __('You are logged out successfully.'));
    }
}
