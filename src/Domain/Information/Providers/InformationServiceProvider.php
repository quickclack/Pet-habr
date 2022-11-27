<?php

namespace Domain\Information\Providers;

use Illuminate\Support\ServiceProvider;

class InformationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(ActionServiceProvider::class);
    }
}
