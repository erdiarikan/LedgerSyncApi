<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PlatformAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', RegisterController::class)->name('register');
Route::post('/login', LoginController::class)->name('login');

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', LogoutController::class)->name('logout');

    Route::resource('companies', CompanyController::class);
});

Route::middleware('resolve.platform:xero')
    ->prefix('xero')->name('xero.')
    ->group(function () {
        Route::get('/auth/callback', PlatformAuthController::class)->name('auth.callback');
    });
