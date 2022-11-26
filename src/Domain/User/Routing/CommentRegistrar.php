<?php

namespace Domain\User\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Api\CommentController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class CommentRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('api')->prefix('api')->group(function () {
            Route::post('/comments/{article:id}', [CommentController::class, 'getCommentsOnArticle']);
        });
    }
}
