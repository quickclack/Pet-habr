<?php

namespace Support\Traits;

use Domain\User\Models\User;
use Illuminate\Auth\Access\Response;

trait HasPolicy
{
    public function create(User $user): Response
    {
        return $user->roles->containsStrict('id', 1)
            ? Response::allow()
            : Response::deny();
    }

    public function update(User $user): Response
    {
        return $user->roles->containsStrict('id', 1)
            ? Response::allow()
            : Response::deny();
    }

    public function delete(User $user): bool
    {
        return $user->roles->containsStrict('id', 1);
    }
}
