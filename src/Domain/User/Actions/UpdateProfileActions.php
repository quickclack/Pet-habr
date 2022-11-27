<?php

namespace Domain\User\Actions;

use Domain\User\Actions\Contracts\UpdateProfileContract;
use Domain\User\DTO\UpdateProfileDto;
use Domain\User\Models\User;

final class UpdateProfileActions implements UpdateProfileContract
{
    public function __invoke(UpdateProfileDto $data, int $id): User
    {
        $user = User::findOrFail($id);

        $user->update([
            'firstName' => $data->firstName,
            'lastName' => $data->lastName,
            'description' => $data->description,
            'sex' => $data->sex,
            'avatar' => $data->avatar ?? null,
        ]);

        return $user;
    }
}
