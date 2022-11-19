<?php

namespace Domain\Information\Queries;

use App\Contracts\QueryBuilder;
use Domain\Information\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class CategoryBuilder implements QueryBuilder
{
    public function getBuilder(): Builder
    {
        return Category::query();
    }

    public function getAllCategories(): Collection
    {
        return $this->getBuilder()
            ->select('id', 'title', 'slug')
            ->get();
    }

    public function getCategoryBySlug(string $slug): ?Model
    {
        return $this->getBuilder()
            ->with('articles')
            ->where('slug', $slug)
            ->orderByDesc('id')
            ->first();
    }

    public function getCategoryByPlug(): array
    {
        return $this->getBuilder()
            ->pluck('title', 'id')
            ->all();
    }
}
