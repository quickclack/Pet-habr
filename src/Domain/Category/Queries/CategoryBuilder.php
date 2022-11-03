<?php

namespace Domain\Category\Queries;

use App\Contracts\QueryBuilder;
use Domain\Category\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

final class CategoryBuilder implements QueryBuilder
{
    public function getBuilder(): Builder
    {
        return Category::query();
    }

    public function getAllCategories(): Collection
    {
        return $this->getBuilder()
            ->get();
    }

    public function getCategoryBySlug(string $slug)
    {
        return $this->getBuilder()
            ->with('articles')
            ->where('slug', $slug)
            ->orderByDesc('id')
            ->first();
    }
}
