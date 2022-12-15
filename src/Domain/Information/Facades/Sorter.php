<?php

namespace Domain\Information\Facades;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Builder run(Builder $query)
 *
 * @see \Domain\Information\Sorters\Sorter
 */
final class Sorter extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Domain\Information\Sorters\Sorter::class;
    }
}
