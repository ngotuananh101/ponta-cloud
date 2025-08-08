<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * Display the registration form view.
     *
     * @return View
     */
    public function showRegistrationForm()
    {
        return view('pages.auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'accept_term' => 'required|accepted',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Log the user in
        auth()->login($user);

        // Broadcast an event
        event(new Registered($user));

        // Redirect to a specific route after registration
        return redirect()->route('home')->with('success', __('Hi, :name! Welcome to :app_name.', [
            'name' => $user->name,
            'app_name' => config('app.name'),
        ]));
    }
}
