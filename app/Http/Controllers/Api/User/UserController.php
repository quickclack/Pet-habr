<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\UserCollection;
use App\Http\Resources\Api\User\UserResource;
use Domain\User\Queries\UserBuilder;

class UserController extends Controller
{
    public function __construct(
        protected UserBuilder $builder
    ){
    }

    public function getUser(): UserResource
    {
        return new UserResource($this->builder->getUserById());
    }

    public function getAllUsers(): UserCollection
    {
        return new UserCollection($this->builder->getAllUsers());
    }
}
