<?php

namespace Domain\Information\Queries;

use App\Contracts\QueryBuilder;
use Domain\Information\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

final class TagBuilder implements QueryBuilder
{
    public function getBuilder(): Builder
    {
        return Tag::query();
    }

    public function getAllTags(): Collection
    {
        return $this->getBuilder()
            ->select(['id', 'title', 'slug'])
            ->get();
    }

    public function getTagByPluck(): iterable
    {
        return $this->getBuilder()
            ->select(['id', 'title'])
            ->pluck('title', 'id')
            ->all();
    }
}
