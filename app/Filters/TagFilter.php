<?php

namespace App\Filters;

use Domain\Information\Filters\AbstractFilter;
use Domain\Information\Models\Tag;
use Illuminate\Database\Eloquent\Builder;

class TagFilter extends AbstractFilter
{
    public function key(): string
    {
        return 'tags';
    }

    public function values(): array
    {
        return Tag::query()
            ->select(['id', 'title'])
            ->has('articles')
            ->get()
            ->pluck('title', 'id')
            ->toArray();
    }

    public function apply(Builder $query): Builder
    {
        return $query->whereHas('tags', function (Builder $builder) {
            $builder->when($this->requestValue(), function (Builder $q) {
                $q->whereIn('tag_id', explode(',', $this->requestValue()));
            });
        });
    }
}
