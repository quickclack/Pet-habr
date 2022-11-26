<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\TagController;
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


                Route::controller(ArticleController::class)->group(function () {
                    Route::get('/article/new','show')
                        ->name('admin.articles.new');

                    Route::get('/articles/trash','trash')
                        ->name('admin.article.trash');

                    Route::post('/article/{id}/approved', 'approve')
                        ->name('admin.article.approve');

                    Route::post('/article/{id}/reject', 'reject')
                        ->name('admin.article.reject');

                    Route::post('/article/{id}/destroy', 'destroy')
                        ->name('admin.article.destroy');
                });

                Route::resource('/tags', TagController::class)
                    ->names('admin.tags');
            });
        });
    }
}
