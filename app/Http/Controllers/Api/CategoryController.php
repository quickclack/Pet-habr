<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Domain\Category\Queries\CategoryBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function getAllCategories(CategoryBuilder $builder): JsonResponse
    {
        $categories = $builder->getAllCategories();

        return response()->json([
            'status' => Response::HTTP_OK,
            'category' => $categories
        ]);
    }

    public function getCategoryBySlug(CategoryBuilder $builder, string $slug): JsonResponse
    {
        $category = $builder->getCategoryBySlug($slug);

        $articles = $category->articles()
            ->orderByDesc('id')
            ->get();

        if (!$category) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'Такой категории нет'
            ]);
        }

        return response()->json([
            'status' => Response::HTTP_OK,
            'category' => $category,
            'articles' => $articles
        ]);
    }
}
