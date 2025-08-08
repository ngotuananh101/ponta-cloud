<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Cloud\OneDriveController;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

    Route::get('/oauth/{provider}', [OAuthController::class, 'redirectToProvider'])->name('oauth.redirect');
    Route::get('/oauth/{provider}/callback', [OAuthController::class, 'handleProviderCallback'])->name('oauth.callback');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->name('verification.verify')
        ->middleware('signed');
    Route::post('/email/resend', [VerificationController::class, 'resend'])
        ->name('verification.resend')
        ->middleware('throttle:6,1');

    Route::get('/onedrive/{cloudId}/redirect', [OneDriveController::class, 'redirectToProvider'])
        ->where('cloudId', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}')
        ->name('onedrive.redirect');
    Route::get('/onedrive/{cloudId}/callback', [OneDriveController::class, 'handleCallback'])
        ->where('cloudId', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}')
        ->name('onedrive.callback');
});
