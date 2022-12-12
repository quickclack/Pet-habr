<?php

namespace App\Filters;

use Domain\Information\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter extends AbstractFilter
{
    public function key(): string
    {
        return 'category';
    }

    public function values(): array
    {
        return [];
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (Builder $builder) {
            $builder->whereIn('category_id',explode(',', $this->requestValue()));
        });
    }
}
