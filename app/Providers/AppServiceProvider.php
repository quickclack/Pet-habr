<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Services\Socialite\Contract\Socialite;
use Services\Socialite\SocialiteService;
use Services\Uploads\Contract\Upload;
use Services\Uploads\UploadService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(Socialite::class, SocialiteService::class);
        $this->app->bind(Upload::class, UploadService::class);
    }

    public function boot(): void
    {
        Model::shouldBeStrict(!app()->isProduction());

        Password::defaults(fn() => Password::min(8)
            ->letters()
            ->uncompromised()
            ->numbers()
        );

        JsonResource::withoutWrapping();

        Paginator::useBootstrap();
    }
}
