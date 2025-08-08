<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    /**
     * Display the form to request a password reset link.
     *
     * @return View
     */
    public function showLinkRequestForm()
    {
        return view('pages.auth.passwords.email');
    }

    /**
     * Send a password reset link to the given user.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return back()->with(['success' => __('If your email address is registered, you will receive a password reset link.')])->withInput($request->only('email'));
    }
}
