<?php

namespace Domain\User\Queries;

use App\Contracts\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class UserBuilder implements QueryBuilder
{
    public function getBuilder(): Builder
    {
        return User::query();
    }

    public function getUserByEmail(string $email): Model|User|null
    {
        return $this->getBuilder()
            ->where('email', $email)
            ->firstOrFail();
    }

    public function getUserById(): ?Model
    {
        return $this->getBuilder()
            ->findOrFail(auth('sanctum')->id());
    }

    public function getAllUsers(): Collection
    {
        return $this->getBuilder()
            ->with('roles')
            ->whereRelation('roles', 'name', '!=', 'Administrator')
            ->get();
    }
}
