<?php

namespace Domain\Interactive\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Api\User\NotificationController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class NotificationRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('api')->prefix('api')->group(function () {
            Route::controller(NotificationController::class)->group(function () {

                Route::post('/profile/notifications', 'getAll');
                Route::post('/profile/notification/{notification}', 'getAll');
            });
        });
    }
}
