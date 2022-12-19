<?php

namespace Domain\User\Providers;

use Domain\User\Actions\Contracts\CreateCommentContract;
use Domain\User\Actions\CreateCommentActions;
use Domain\User\Actions\RegisteredActions;
use Domain\User\Actions\Contracts\RegisteredContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ActionsServiceProvider extends ServiceProvider
{
    public array $bindings = [
        RegisteredContract::class => RegisteredActions::class,
        CreateCommentContract::class => CreateCommentActions::class,
    ];
}
