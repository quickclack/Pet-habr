<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Category\CategoryCollection;
use App\Http\Resources\Api\Category\CategoryArticleResource;
use Domain\Information\Queries\CategoryBuilder;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function getAllCategories(CategoryBuilder $builder): CategoryCollection
    {
        return new CategoryCollection($builder->getAllCategories());
    }

    public function getCategoryBySlug(CategoryBuilder $builder, string $slug): JsonResponse
    {
        $category = $builder->getCategoryBySlug($slug);

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
