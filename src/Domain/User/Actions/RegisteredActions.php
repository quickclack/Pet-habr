<?php

namespace Domain\User\Actions;

use Domain\User\Actions\Contract\RegisteredContract;
use Domain\User\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;

final class RegisteredActions implements RegisteredContract
{
    public function handle(string $name, string $email, string $password): void
    {
        // TODO make DTO latters, maybe no)
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'remember_token' => Str::random(40)
        ]);

        event(new Registered($user));

        auth()->login($user);
    }
}
