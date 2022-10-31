<?php

namespace App\Http\Controllers;

use App\Enums\ArticleStatus;
use App\Models\Article;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

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
            ->get();

        return response()->json([
            'status' => Response::HTTP_OK,
            'articles' => $articles
        ]);
    }
}
