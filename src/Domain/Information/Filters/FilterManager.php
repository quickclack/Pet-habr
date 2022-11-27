<?php

declare(strict_types=1);

namespace Domain\Information\Filters;

final class FilterManager
{
    public function __construct(protected array $items = [])
    {
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function registerFilters(array $items): void
    {
        $this->items = $items;
    }
}
