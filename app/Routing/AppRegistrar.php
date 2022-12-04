<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\HomeController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AppRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')->group(function () {
           // Auth::routes();

            Route::get('/{view?}', HomeController::class)
                ->where('view', '(.*)');
        });

        Route::middleware('api')->prefix('api')->group(function () {
            Route::post('/search', SearchController::class);
        });
    }
}
