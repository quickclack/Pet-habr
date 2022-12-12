<?php

namespace Domain\User\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class UserRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('api')->prefix('api')->group(function () {
            Route::post('/user/info', [UserController::class, 'getUser'])
                ->middleware('auth:sanctum');
        });
    }
}
