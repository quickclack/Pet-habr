<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Article\ArticleCollection;
use App\Http\Resources\Api\Article\ArticleRelationResource;
use Domain\Information\Models\Article;
use Domain\Information\Queries\ArticleBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    public function getAllArticles(ArticleBuilder $builder): ArticleCollection
    {
        return new ArticleCollection(Cache::remember('articles', 60*60*12,
            fn() => $builder->getAllApprovedArticles()));
    }

    public function getArticleById(ArticleBuilder $builder, int $id): JsonResponse
    {
        $article = $builder->getArticleById($id);

        $this->addViews($article);

        return response()->json([
            'article' => new ArticleRelationResource(Cache::remember('article', 60*60*12,
                fn() => $article))
        ]);
    }

    private function addViews(Article|Model $article): void
    {
        $article->views += 1;

        $article->update();
    }
}
