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

        if (!$category) {
            return $this->missing('категории');
        }

        $category->articles->load('user');

        return response()->json([
            'category' => new CategoryArticleResource($category)
        ]);
    }
}
