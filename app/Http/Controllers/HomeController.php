<?php

namespace App\Http\Controllers;

use App\Enums\ArticleStatus;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function getAllArticles()
    {
        $articles = Article::query()
            ->where('status', ArticleStatus::APPROVED)
            ->get();

        return response()->json([
            'status' => Response::HTTP_OK,
            'articles' => $articles
        ]);
    }

    public function getAllCategories()
    {
        $categories = Category::query()->get();

        return response()->json([
            'status' => Response::HTTP_OK,
            'articles' => $categories
        ]);
    }
}
