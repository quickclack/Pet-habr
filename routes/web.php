<?php

use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Auth\RegisteredController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;

// временно
Route::get('/', function () {
    return view('welcome');
})->name('home');
//

Route::middleware('guest')->group(function () {
    Route::controller(RegisteredController::class)->group(function () {
        Route::get('/auth/login', 'show')->name('auth.show');
        Route::post('/auth/login', 'store')
            ->middleware('throttle:auth')
            ->name('auth.store');
    });

    Route::controller(AuthenticatedController::class)->group(function () {
        Route::get('/auth/registered', 'show')->name('registered.show');
        Route::post('/auth/registered', 'store')
            ->middleware('throttle:auth')
            ->name('registered.store');
    });
});

Route::controller(VerificationController::class)->group(function () {
    Route::get('/email/verify', 'getVerifyForm')
        ->middleware('auth')
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', 'verificationRequest')
        ->middleware(['auth', 'signed'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', 'repeatSendToMail')
        ->middleware(['auth', 'throttle:6,1'])
        ->name('verification.send');
});

Route::middleware('auth')->group(function () {
    Route::get('/auth/logout', [AuthenticatedController::class, 'logout'])->name('logout');
});
