<?php

namespace Services\Socialite\Contract;

use Laravel\Socialite\Contracts\User;

interface Socialite
{
    public function loginSocial(User $socialUser): string;
}
