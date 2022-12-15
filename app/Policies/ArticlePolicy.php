<?php

namespace App\Policies;

use Domain\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function viewAny(): bool
    {
        return true;
    }

    public function view(): bool
    {
        return true;
    }

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
