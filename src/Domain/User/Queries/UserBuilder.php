<?php

namespace Domain\User\Queries;

use App\Contracts\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Model;

final class UserBuilder implements QueryBuilder
{
    public function getBuilder(): Builder
    {
        return User::query();
    }

    public function getUserByEmail(string $email): Model
    {
        return $this->getBuilder()
            ->where('email', $email)
            ->firstOrFail();
    }

    public function getUserById(int $id): Model
    {
        return $this->getBuilder()
            ->findOrFail($id);
    }
}
