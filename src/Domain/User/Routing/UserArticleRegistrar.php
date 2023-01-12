<?php

namespace Domain\User\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Api\User\UserArticleController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class UserArticleRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('api')->prefix('api')->group(function () {
            Route::controller(UserArticleController::class)->middleware('auth:sanctum')->group(function () {

                Route::post('/profile/amount', 'getAmount');

                Route::post('/profile/article/create', 'create')
                    ->middleware('banned');

                Route::post('/profile/article/{article}/publish', 'publish')
                    ->middleware('banned');

                Route::post('/profile/article/{article}/withdraw', 'withdraw')
                    ->middleware('banned');

                Route::post('/profile/articles', 'getAll');

                Route::put('/profile/article/{article:id}/update', 'update')
                    ->middleware('banned');

                Route::delete('/profile/article/{article:id}/delete', 'destroy')
                    ->middleware('banned');

                Route::post('/profile/article/{article:id}', 'getById');
            });
        });
    }
}
