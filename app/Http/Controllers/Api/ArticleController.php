<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Article\ArticleCollection;
use App\Http\Resources\Api\Article\ArticleRelationResource;
use App\Http\Resources\Api\Category\CategoryArticleResource;
use Domain\Information\Models\Article;
use Domain\Information\Models\Category;
use Domain\Information\Queries\ArticleBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function getAllArticles(ArticleBuilder $builder): ArticleCollection
    {
        return new ArticleCollection($builder->getAllApprovedArticles());
    }

    public function getArticleById(ArticleBuilder $builder, int $id): JsonResponse
    {
        $article = $builder->getArticleById($id);

        if (!$article) {
            return response()->json([
                'message' => 'Такой статьи нет'
            ]);
        }

        $this->addViews($article);

        return response()->json([
            'article' => new ArticleRelationResource($article)
        ]);
    }

    public function getArticleByFilters(): ArticleCollection
    {
        $articles = Article::query()
            ->with('user')
            ->filter()
            ->paginate(5);

        return new ArticleCollection($articles);
    }

    private function addViews(Article|Model $article): void
    {
        $article->views += 1;

        $article->update();
    }
}
