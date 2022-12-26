<?php

namespace Domain\Interactive\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Api\LikeController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class LikeRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('api')->prefix('api')->group(function () {
            Route::controller(LikeController::class)->group(function () {

                Route::post('/article/{article}/like', 'toggleArticle');
                Route::post('/comment/{comment}/like', 'toggleComment');
            });
        });
    }
}
