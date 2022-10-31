<?php

namespace Domain\User\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Api\Auth\AuthenticatedController;
use App\Http\Controllers\Api\Auth\RegisteredController;
use App\Http\Controllers\Api\Auth\VerificationController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AuthRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('api')->prefix('api')->group(function () {
            Route::middleware('guest')->group(function () {

                Route::post('/auth/login', [AuthenticatedController::class, 'store'])
                    ->middleware('throttle:auth');
                Route::post('/auth/registered', [RegisteredController::class, 'store'])
                    ->middleware('throttle:auth');
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
        });
    }
}
