<?php

namespace Domain\User\Actions;

use Domain\User\Actions\Contract\RegisteredContract;
use Domain\User\DTO\NewUserDTO;
use Domain\User\Models\User;
use Domain\User\Models\UserVerify;
use Illuminate\Support\Str;

final class RegisteredActions implements RegisteredContract
{
    public function __invoke(NewUserDTO $data): User
    {
        $user = User::create([
            'nickName' => $data->nickName,
            'email' => $data->email,
            'password' => bcrypt($data->password),
        ]);

        $token = Str::random(64);

        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);

        return $user;
    }
}
