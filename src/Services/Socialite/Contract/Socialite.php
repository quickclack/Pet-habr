<?php

namespace Services\Socialite\Contract;

use Illuminate\Http\JsonResponse;
use Laravel\Socialite\Contracts\User;

interface Socialite
{
    public function loginSocial(User $socialUser): JsonResponse;
}
