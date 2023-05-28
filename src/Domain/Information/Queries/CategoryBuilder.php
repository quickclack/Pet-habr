<?php

declare(strict_types=1);

namespace Domain\Information\Queries;

use App\Contracts\QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Domain\Information\Models\Category;
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
