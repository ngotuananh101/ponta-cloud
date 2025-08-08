<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VerificationController extends Controller
{
    /**
     * Display the email verification notice view.
     *
     * @return View
     */
    public function show()
    {
        return view('pages.auth.email.verify');
    }

    /**
     * Handle the email verification process.
     *
     * @param EmailVerificationRequest $request
     * @return RedirectResponse
     */
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('home')
            ->with('status', __('auth.verify_success'));
    }

    /**
     * Resend the email verification notification.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', __('Your verification link has been resent to your email address.'));
    }
}
