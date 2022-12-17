<?php

namespace Domain\User\DTO;

use Illuminate\Http\Request;
use Support\Traits\HasMakeable;

final class UpdateProfileDto
{
    use HasMakeable;

    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $description,
        public readonly string $sex,
        public readonly string $avatar,
    ){
    }

    public static function formRequest(Request $request): self
    {
        return self::make(...$request->only([
            'firstName',
            'lastName',
            'description',
            'sex',
            'avatar'
        ]));
    }
}
