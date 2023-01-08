<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Profile\Article\ArticleProfileCollection;
use Domain\Information\Models\Article;
use Domain\User\Queries\UserBuilder;
use Illuminate\Http\JsonResponse;

class BookmarkController extends Controller
{
    public function __construct(
        protected UserBuilder $builder
    ){
    }

    public function get(): ArticleProfileCollection
    {
        $user = $this->builder->getUserById();

        return new ArticleProfileCollection(
            $user->bookmarks()
                ->with(['category', 'tags', 'user'])
                ->paginate(5)
        );
    }

    public function toggle(Article $article): JsonResponse
    {
        $user = $this->builder->getUserById();

        $user->bookmarks()->toggle($article);

        return $this->amount(
            $article->bookmarks()
                ->where('article_id', $article->getKey())
                ->count()
        );
    }
}
