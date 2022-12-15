<?php

namespace Domain\Information\Sorters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Stringable;

final class Sorter
{
    public const SORT_KEY = 'sort';

    public function __construct(
        protected array $columns = []
    ){
    }

    public function run(Builder $builder): Builder
    {
        $sortData = $this->sortData();

        return $builder->when($sortData->contains($this->getColumns()), function (Builder $query) use ($sortData) {
            $query->orderBy((string) $sortData->remove('-'),
                $sortData->contains('-') ? 'ASC' : 'DESC');
        });
    }

    public function getKey(): string
    {
        return self::SORT_KEY;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function sortData(): Stringable
    {
        return request()->str($this->getKey());
    }

    public function isActive(string $column, string $direction = 'DESC'): bool
    {
        $column = trim($column, '-');

        if (strtolower($direction) === 'ASC') {
            $column = '-' . $column;
        }

        return request($this->getKey()) === $column;
    }
}
