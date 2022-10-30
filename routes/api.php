<?php

use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Auth\RegisteredController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('/auth/login', [AuthenticatedController::class, 'store'])->middleware('throttle:auth');
    Route::post('/auth/registered', [RegisteredController::class, 'store'])->middleware('throttle:auth');
});

Route::controller(VerificationController::class)->group(function () {
    Route::get('/email/verify/{id}/{hash}', 'verificationRequest')
        ->middleware(['auth', 'signed'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', 'repeatSendToMail')
        ->middleware(['auth', 'throttle:6,1'])
        ->name('verification.send');
});

Route::middleware('auth')->group(function () {
    Route::get('/auth/logout', [AuthenticatedController::class, 'logout']);
});
