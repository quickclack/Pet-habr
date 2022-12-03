<?php

namespace Domain\User\Providers;

use Domain\User\Models\Comment;
use Domain\User\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function register(): void
    {
        $this->app->register(
            ActionsServiceProvider::class,
        );
    }

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('update-comment', function (User $user, Comment $comment) {
            return auth()->id() === $user->getKey() && $comment->user_id === $user->getKey();
        });

        Gate::define('delete-comment', function (User $user, Comment $comment) {
            return auth()->id() === $user->getKey() && $comment->user_id === $user->getKey();
        });
    }
}
