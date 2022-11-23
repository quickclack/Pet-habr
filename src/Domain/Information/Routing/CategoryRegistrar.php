<?php

namespace Domain\Information\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class CategoryRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('api')->prefix('api')->group(function () {
            Route::controller(CategoryController::class)->group(function () {

                Route::post('/categories', 'getAllCategories');
                Route::post('/category/{categories:slug}', 'getCategoryBySlug');
            });
        });
    }
}
