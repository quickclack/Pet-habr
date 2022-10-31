<?php

namespace Services\Socialite;

use Domain\User\Models\User;
use Laravel\Socialite\Contracts\User as SocialUser;

final class SocialiteService implements Contract\Socialite
{
    public function loginSocial(SocialUser $socialUser): string
    {
        $user = User::create([
            'nickName' => $socialUser->getNickname(),
            'firstName' => $socialUser->getName(),
            'email' => $socialUser->getEmail(),
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        auth()->login($user);

        return url('/');
    }
}
