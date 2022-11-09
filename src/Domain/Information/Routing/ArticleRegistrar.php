<?php

namespace Domain\Information\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Api\ArticleController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class ArticleRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('api')->prefix('api')->group(function () {
            Route::post('/articles', [ArticleController::class, 'getAllArticles']);
            Route::post('/article/{article:id}', [ArticleController::class, 'getArticleById']);
        });
    }
}
