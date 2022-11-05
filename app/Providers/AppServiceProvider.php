<?php

namespace App\Providers;

use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\Kernel;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
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

        DB::listen(function ($query) {
            if ($query->time > 5) {
                logger()->channel('telegram')
                    ->debug('whenQueryingForLongerThan:' . $query->sql, $query->bindings);
            }
        });

        app(Kernel::class)->whenRequestLifecycleIsLongerThan(
            CarbonInterval::seconds(5), fn() => logger()
                ->channel('telegram')
                ->debug('whenRequestLifecycleIsLongerThan:' . request()->url()));

        Password::defaults(fn() => Password::min(8)
            ->letters()
            ->uncompromised()
            ->numbers()
        );

        JsonResource::withoutWrapping();

        Paginator::useBootstrap();
    }
}
