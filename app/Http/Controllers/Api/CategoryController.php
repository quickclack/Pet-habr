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
        return new CategoryCollection(Cache::remember('categories', 60*60*24,
            fn() => $builder->getAllCategories()));
    }

    public function getCategoryBySlug(CategoryBuilder $builder, string $slug): JsonResponse
    {
        try {
            return response()->json([
                'category' => new CategoryArticleResource(Cache::remember('category', 60*60*12,
                    fn() => $builder->getCategoryBySlug($slug)))
            ]);

        } catch (\Throwable $exception) {
            throw new \DomainException('Такой категории нет');
        }
    }
}
