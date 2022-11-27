<?php

namespace Domain\User\Actions\Contracts;

use Domain\User\DTO\NewUserDto;
use Domain\User\Models\User;

interface RegisteredContract
{
    public function __invoke(NewUserDTO $data): User;
}
