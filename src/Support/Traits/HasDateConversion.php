<?php

namespace Support\Traits;

use Carbon\Carbon;

trait HasDateConversion
{
    public function setDate(Carbon $value): string
    {
        return Carbon::parse($value)
            ->subMinutes()
            ->diffForHumans();
    }
}
