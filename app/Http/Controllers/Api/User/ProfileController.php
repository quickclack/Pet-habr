<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Domain\User\Queries\UserBuilder;
use Illuminate\Http\JsonResponse;
use Support\Traits\HasValidated;

class ProfileController extends Controller
{
    use HasValidated;

    public function __construct(
        protected UserBuilder $userBuilder,
    ){
    }

    public function update(ProfileRequest $request): JsonResponse
    {
        $user = $this->userBuilder->getUserById();

        $user->update($this->validated($request, 'avatar', 'avatars'));

        return $this->updateSuccess('Профиль');
    }
}
