<?php

namespace Support\Traits;

use Carbon\Carbon;

trait DateConversion
{
    public function setDate(mixed $model): string
    {
        return Carbon::parse($model->created_at)
            ->subDay()
            ->diffForHumans(['options' => Carbon::ONE_DAY_WORDS]);
    }
}
