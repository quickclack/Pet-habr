<?php

namespace App\Policies;

use Domain\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Support\Traits\HasPolicy;

class UserPolicy
{
    use HandlesAuthorization, HasPolicy;

    public function update(User $user): Response
    {
        return $user->roles->containsStrict('id', 1)
            && $user->roles->containsStrict('id', 2)
                ? Response::allow()
                : Response::deny();
    }
}
