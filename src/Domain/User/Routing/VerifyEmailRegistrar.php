<?php

namespace Domain\User\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Api\Auth\VerificationController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class VerifyEmailRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::post('email/verify/{token}', [VerificationController::class, 'verify'])
            ->name('user.verify');
    }
}
