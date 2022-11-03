<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Domain\User\Queries\UserBuilder;

class ProfileController extends Controller
{
    public function updateUserProfile(ProfileRequest $request, UserBuilder $builder)
    {

    }
}
