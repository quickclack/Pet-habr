<?php

namespace Domain\User\Providers;

use App\Policies\ArticlePolicy;
use App\Policies\CategoryPolicy;
use App\Policies\TagPolicy;
use Domain\Information\Models\Article;
use Domain\Information\Models\Category;
use Domain\Information\Models\Tag;
use Domain\User\Models\Comment;
use Domain\User\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Category::class => CategoryPolicy::class,
        Tag::class => TagPolicy::class,
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

        Gate::define('update-article', function (User $user, Article $article) {
            return auth()->id() === $user->getKey() && $article->user_id === $user->getKey();
        });

        Gate::define('delete-article', function (User $user, Article $article) {
            return auth()->id() === $user->getKey() && $article->user_id === $user->getKey();
        });
    }
}
