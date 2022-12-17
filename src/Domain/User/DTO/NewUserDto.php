<?php

namespace Domain\User\DTO;

use Illuminate\Http\Request;
use Support\Traits\HasMakeable;

final class NewUserDto
{
    use HasMakeable;

    public function __construct(
        public readonly string $nickName,
        public readonly string $email,
        public readonly string $password,
    )
    {
    }

    public static function formRequest(Request $request): self
    {
        return self::make(...$request->only(['nickName', 'email', 'password']));
    }
}
