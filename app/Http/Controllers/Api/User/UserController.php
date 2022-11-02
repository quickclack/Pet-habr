<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\UserCollection;
use App\Http\Resources\Api\User\UserResource;
use Domain\User\Queries\UserBuilder;

class UserController extends Controller
{
    public function getUser(UserBuilder $builder, int $id): UserResource
    {
        try {
            return new UserResource($builder->getUserById($id));

        } catch (\Throwable $exception) {
            throw new \DomainException('Такого пользователя не существует');
        }
    }

    public function getAllUsers(UserBuilder $builder): UserCollection
    {
        return new UserCollection($builder->getAllUsers());
    }
}
