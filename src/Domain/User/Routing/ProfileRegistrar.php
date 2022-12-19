<?php

namespace Domain\User\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Api\User\ProfileController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class ProfileRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('api')->prefix('api')->group(function () {
            Route::controller(ProfileController::class)->middleware('auth:sanctum')->group(function () {

                Route::post('/profile/amount', 'getAllAmountForUser');

                Route::put('/profile/update', 'updateProfile');

                Route::post('/profile/article/create', 'createArticle');

                Route::post('/profile/articles', 'getUserArticles');

                Route::put('/profile/article/{article:id}/update', 'update');

                Route::delete('/profile/article/{article:id}/delete', 'destroy');

                Route::post('/profile/article/{article:id}', 'getArticleById');
            });
        });
    }
}
