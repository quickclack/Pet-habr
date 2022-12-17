<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Support\Traits\HasPolicy;

class TagPolicy
{
    use HandlesAuthorization, HasPolicy;
}
