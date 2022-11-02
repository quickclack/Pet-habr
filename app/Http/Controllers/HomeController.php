<?php

namespace App\Http\Controllers;

use App\Enums\ArticleStatus;
use App\Http\Resources\Api\Article\ArticleCollection;
use App\Http\Resources\Api\Article\ArticleRelationResource;
use App\Models\Article;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): Application|Factory|View
    {
        return view('welcome');
    }

    public function getAllArticles()
    {
        $articles = Article::query()
            ->where('status', ArticleStatus::APPROVED)
            ->orderByDesc('created_at')
            ->paginate(20);

        return new ArticleCollection($articles);
    }

    public function getArticleById(int $id)
    {
        $article = Article::query()
            ->where('id', $id)
            ->first();

        $article->views += 1;

        $article->update();

        return response()->json([
            'article' => new ArticleRelationResource($article)
        ]);
    }
}
