<?php

namespace Domain\User\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Api\Auth\SocialiteController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class SocialiteRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('api')->prefix('api')->group(function () {
            Route::middleware('guest')->group(function () {

                Route::controller(SocialiteController::class)->group(function () {
                    Route::get('/auth/{driver}/redirect', 'redirect');
                    Route::get('/auth/{driver}/callback', 'callback');
                });
            });
        });
    }
}
