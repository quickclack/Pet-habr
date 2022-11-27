<?php

namespace Domain\Information\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class AbstractFilter
{
    public const KEY = 'filters.';

    public function __invoke(Builder $query, $next): void
    {
        $this->apply($query);

        $next($query);
    }

    abstract public function key(): string;

    abstract public function values(): array;

    abstract public function apply(Builder $query): Builder;

    public function requestValue(string $index = null, mixed $default = null): mixed
    {
        return request(
            self::KEY . $this->key() . ($index ? ".$index" : ''),
            $default
        );
    }
}
