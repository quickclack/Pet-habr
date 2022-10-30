<?php

namespace Domain\User\Queries\Contract;

use Illuminate\Database\Eloquent\Builder;

interface QueryBuilder
{
    public function getBuilder(): Builder;
}
