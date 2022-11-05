<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IndexController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AdminRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')->group(function () {
            Route::middleware('guest')->prefix('admin')->group(function () {

                Route::get('/', IndexController::class)
                    ->name('admin.index');

                Route::resource('/category', CategoryController::class)
                    ->names('admin.category');

                Route::resource('/article', ArticleController::class)
                    ->names('admin.articles');

                Route::get('/article/new', [ArticleController::class, 'show'])->name('admin.articles.new');
            });
        });
    }
}
