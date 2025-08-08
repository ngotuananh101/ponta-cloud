<?php

use App\Http\Controllers\Cloud\OneDriveController;
use App\Http\Controllers\Home\HomeController;
use Illuminate\Support\Facades\Route;
use Microsoft\Graph\GraphServiceClient;
use Microsoft\Kiota\Abstractions\ApiException;
use Microsoft\Kiota\Authentication\Oauth\AuthorizationCodeContext;

include base_path('routes/auth.php');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});
