<?php

namespace App\Providers;

use Domain\Information\Providers\InformationServiceProvider;
use Illuminate\Support\ServiceProvider;
use Domain\User\Providers\AuthServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(InformationServiceProvider::class);
    }
}
