<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Category\CategoryCollection;
use App\Http\Resources\Api\Category\CategoryArticleResource;
use Domain\Information\Queries\CategoryBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function getAllCategories(CategoryBuilder $builder): CategoryCollection
    {
        return Cache::remember(
            'categories', 60*60*24, fn() => new CategoryCollection($builder->getAllCategories())
        );
    }

    public function getCategoryBySlug(CategoryBuilder $builder, string $slug): JsonResponse
    {
        $category = $builder->getCategoryBySlug($slug);

        $category->articles->load('user');

        if (!$category) {
            return response()->json([
                'message' => 'Такой категории нет',
            ]);
        }

        return response()->json([
            'category' => new CategoryArticleResource($category)
        ]);
    }
}
