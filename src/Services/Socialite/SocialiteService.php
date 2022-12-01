<?php

namespace Services\Socialite;

use Domain\User\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Sanctum\Sanctum;
use Services\Socialite\Contract\Socialite;
use Laravel\Socialite\Contracts\User as SocialUser;

class SocialiteService implements Socialite
{
    public function loginSocial(SocialUser $socialUser): string
    {
        $password = str()->random(10);

        try {
            $user = User::updateOrCreate([
                'nickName' => $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                'firstName' => $socialUser->getName(),
                'password' => bcrypt($password),
                'email_verified_at' => now(),
            ]);

            Sanctum::actingAs($user);

            return url('/');

        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException($exception->getMessage());
        }
    }
}
