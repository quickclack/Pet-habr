<?php

namespace Domain\User\Providers;

use Domain\User\Actions\Contracts\CreateCommentContract;
use Domain\User\Actions\Contracts\UpdateProfileContract;
use Domain\User\Actions\CreateCommentActions;
use Domain\User\Actions\RegisteredActions;
use Domain\User\Actions\Contracts\RegisteredContract;
use Domain\User\Actions\UpdateProfileActions;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ActionsServiceProvider extends ServiceProvider
{
    public array $bindings = [
        RegisteredContract::class => RegisteredActions::class,
        UpdateProfileContract::class => UpdateProfileActions::class,
        CreateCommentContract::class => CreateCommentActions::class,
    ];
}
