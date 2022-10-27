<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot(): void
    {
        Model::shouldBeStrict(!app()->isProduction());

        Password::defaults(fn() => Password::min(8)
            ->letters()
            ->uncompromised()
            ->numbers()
        );
    }
}
