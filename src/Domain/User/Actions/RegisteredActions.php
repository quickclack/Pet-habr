<?php

namespace Domain\User\Actions;

use Domain\User\Actions\Contracts\RegisteredContract;
use Domain\User\DTO\NewUserDTO;
use Domain\User\Models\Role;
use Domain\User\Models\User;

final class RegisteredActions implements RegisteredContract
{
    public function __invoke(NewUserDTO $data): User
    {
        $user = User::create([
            'nickName' => $data->nickName,
            'email' => $data->email,
            'password' => bcrypt($data->password),
        ]);

        $user->roles()->attach(Role::USER);

        return $user;
    }
}
