<?php

namespace Domain\User\Actions\Contracts;

use Domain\User\DTO\UpdateProfileDto;
use Domain\User\Models\User;

interface UpdateProfileContract
{
    public function __invoke(UpdateProfileDto $data, int $id): User;
}
