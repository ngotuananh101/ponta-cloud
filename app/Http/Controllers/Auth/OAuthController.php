<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class OAuthController extends Controller
{
    /**
     * Redirect the user to the OAuth provider.
     *
     * @param string $provider
     * @return RedirectResponse
     */
    public function redirectToProvider(string $provider)
    {
        // Validate the provider
        if (!in_array($provider, ['github', 'google'])) {
            abort(404, __('Your request is not supported'));
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from the provider.
     *
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback(string $provider)
    {
        // Validate the provider
        if (!in_array($provider, ['github', 'google'])) {
            abort(404, __('Your request is not supported'));
        }
        $user = Socialite::driver($provider)->user();

        // Find user by oath provider id
        $authUser = User::where($provider . '_id', $user->getId())->first();

        if ($authUser) {
            // User exists, log them in
            auth()->login($authUser, true);
            return redirect()->route('home')->with('success', __('Hello :name! You are logged in.', ['name' => $authUser->name]));
        } else {

            // Check if the user already exists by email
            $existingUser = User::where('email', $user->getEmail())->first();
            if ($existingUser) {
                return redirect()->route('login')->with('email', __('Your social account is not linked to any user.'))
                    ->withInput(['email' => $user->getEmail()]);
            }

            // User does not exist, create a new user
            $newUser = User::create([
                'name' => $user->getName() ?? fake()->name(),
                'email' => $user->getEmail(),
                'avatar' => $user->getAvatar(),
                $provider . '_id' => $user->getId(),
                'password' => Hash::make(Str::random()),
                'remember_token' => Str::random(10),
            ])->setAttribute('email_verified_at', now());

            // Log the new user in
            auth()->login($newUser, true);
            return redirect()->route('home')->with('success', __('Hi, :name! Welcome to :app_name.', [
                'name' => $newUser->name,
                'app_name' => config('app.name'),
            ]));
        }
    }
}
