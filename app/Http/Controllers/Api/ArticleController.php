<?php

namespace App\Http\Controllers\Api;

use App\Enums\ArticleStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Article\ArticleCollection;
use App\Http\Resources\Api\Article\ArticleRelationResource;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function getAllArticles(): ArticleCollection
    {
        // TODO вынести в query builder
        $articles = Article::query()
            ->with('user')
            ->where('status', ArticleStatus::APPROVED)
            ->orderByDesc('created_at')
            ->paginate(20);

        return new ArticleCollection($articles);
    }

    public function getArticleById(int $id): JsonResponse
    {
        // TODO вынести в query builder
        $article = Article::query()
            ->with(['user', 'category', 'tags'])
            ->where('id', $id)
            ->first();

        $this->addViews($article);

        return response()->json([
            'article' => new ArticleRelationResource($article)
        ]);
    }

    private function addViews(Article|Builder $article): void
    {
        $article->views += 1;

        $article->update();
    }
}
