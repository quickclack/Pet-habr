<?php

namespace Services\Socialite;

use Domain\User\Models\User;
use Illuminate\Http\JsonResponse;
use Services\Socialite\Contract\Socialite;
use Laravel\Socialite\Contracts\User as SocialUser;

final class SocialiteService implements Socialite
{
    public function loginSocial(SocialUser $socialUser): JsonResponse
    {
        $user = User::create([
            'nickName' => $socialUser->getNickname(),
            'firstName' => $socialUser->getName(),
            'email' => $socialUser->getEmail(),
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        auth()->login($user);

        return response()->json([
            'message' => 'Вы успешно авторизовались'
        ]);
    }
}
