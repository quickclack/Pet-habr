<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\UserCollection;
use App\Http\Resources\Api\User\UserResource;
use Domain\User\Queries\UserBuilder;

class UserController extends Controller
{
    public function getUser(): UserResource
    {
        return new UserResource(auth()->user());
    }

    public function getAllUsers(UserBuilder $builder): UserCollection
    {
        return new UserCollection($builder->getAllUsers());
    }
}
