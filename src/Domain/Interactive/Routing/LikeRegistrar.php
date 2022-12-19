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
            Route::post('/article/{article}/like', [LikeController::class, 'toggleArticle']);
            Route::post('/comment/{comment}/like', [LikeController::class, 'toggleComment']);
        });
    }
}
