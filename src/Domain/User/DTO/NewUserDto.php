<?php

namespace Domain\User\DTO;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

final class NewUserDto
{
    use Makeable;

    public function __construct(
        public readonly string $nickName,
        public readonly string $email,
        public readonly string $password,
    )
    {
    }

    public static function formRequest(Request $request): NewUserDTO
    {
        return self::make(...$request->only(['nickName', 'email', 'password']));
    }
}
