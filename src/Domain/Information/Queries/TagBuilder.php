<?php

namespace Domain\Information\Queries;

use App\Contracts\QueryBuilder;
use Domain\Information\Models\Tag;
use Illuminate\Database\Eloquent\Builder;

final class TagBuilder implements QueryBuilder
{
    public function getBuilder(): Builder
    {
        return Tag::query();
    }

    public function getTagByPluck(): array
    {
        return $this->getBuilder()
            ->pluck('title', 'id')
            ->all();
    }
}
