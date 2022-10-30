<?php

namespace Domain\User\Actions\Contract;

interface RegisteredContract
{
    public function handle(string $name, string $email, string $password): void;
}
