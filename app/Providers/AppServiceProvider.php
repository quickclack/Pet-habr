<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Services\Socialite\Contract\Socialite;
use Services\Socialite\SocialiteService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Socialite::class, SocialiteService::class);
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
