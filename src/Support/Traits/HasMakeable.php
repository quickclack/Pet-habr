<?php

namespace Support\Traits;

trait HasMakeable
{
    public static function make(mixed ...$arguments): static
    {
        return new static(...$arguments);
    }
}
