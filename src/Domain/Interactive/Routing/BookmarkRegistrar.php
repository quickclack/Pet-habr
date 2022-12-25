<?php

namespace Domain\Interactive\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Api\BookmarkController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class BookmarkRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('api')->prefix('api')->group(function () {
            Route::post('/bookmarks', [BookmarkController::class, 'get']);
            Route::post('/bookmark/{article}/toggle', [BookmarkController::class, 'toggle']);
        });
    }
}
