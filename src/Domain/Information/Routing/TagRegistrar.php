<?php

namespace Domain\Information\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Api\TagController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class TagRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('api')->prefix('api')->group(function () {
            Route::post('/tags', [TagController::class, 'getAllTags']);
        });
    }
}
