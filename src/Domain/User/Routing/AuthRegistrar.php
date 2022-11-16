<?php

namespace Domain\User\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Api\Auth\AuthenticatedController;
use App\Http\Controllers\Api\Auth\RegisteredController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AuthRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('api')->prefix('api')->group(function () {

            Route::post('/auth/login', [AuthenticatedController::class, 'store'])
                ->middleware('throttle:auth');

            Route::post('/auth/registered', [RegisteredController::class, 'store'])
                ->middleware('throttle:auth');

            Route::post('/auth/logout', [AuthenticatedController::class, 'logout']);
            Route::post('/auth/refresh', [AuthenticatedController::class, 'refresh']);
        });
    }
}
