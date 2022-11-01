<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Category\CategoryCollection;
use App\Http\Resources\Api\Category\CategoryArticleResource;
use Domain\Category\Queries\CategoryBuilder;
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

        try {
            return response()->json([
                'category' => new CategoryArticleResource($category)
            ]);

        } catch (\Throwable $exception) {
            throw new \DomainException('Такой категории нет');
        }
    }
}
