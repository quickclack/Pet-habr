<?php

namespace Domain\Information\Queries;

use App\Contracts\QueryBuilder;
use Domain\Information\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


final class TagBuilder implements QueryBuilder
{
    public function getBuilder(): Builder
    {
        return Tag::query();
    }

    public function getAllTags(): Collection
    {
        return $this->getBuilder()
            ->select('id', 'title', 'slug')
            ->get();
    }


    public function getTagByPluck(): array
    {
        return $this->getBuilder()
            ->pluck('title', 'id')
            ->all();
    }

    public function getTagById(int $id): ?Model
    {
        return $this->getBuilder()
            ->where('id', $id)
            ->first();
    }
}
