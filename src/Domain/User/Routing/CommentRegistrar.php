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

            Route::post('/comment/create', [CommentController::class, 'store'])
                ->middleware('auth:sanctum');

            Route::put('/comment/{comment:id}/update', [CommentController::class, 'update'])
                ->middleware('auth:sanctum');

            Route::delete('/comment/{comment:id}/delete', [CommentController::class, 'destroy'])
                ->middleware('auth:sanctum');
        });
    }
}
