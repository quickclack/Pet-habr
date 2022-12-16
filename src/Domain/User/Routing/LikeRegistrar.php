<?php

namespace Domain\User\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Api\LikeController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class LikeRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('api')->prefix('api')->group(function () {
            Route::post('/like', LikeController::class);
        });
    }
}
