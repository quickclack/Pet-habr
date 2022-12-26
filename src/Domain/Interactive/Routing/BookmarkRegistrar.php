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
            Route::controller(BookmarkController::class)->group(function () {

                Route::post('/bookmarks', 'get');
                Route::post('/bookmark/{article}/toggle', 'toggle');
            });
        });
    }
}
