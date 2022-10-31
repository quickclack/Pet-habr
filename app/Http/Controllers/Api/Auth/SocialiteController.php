<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Services\Socialite\Contract\Socialite as Service;

class SocialiteController extends Controller
{
    public function redirect(string $driver): RedirectResponse
    {
        try {
            return Socialite::driver($driver)->redirect();

        } catch (\Throwable $exception) {
            throw new \DomainException("Произошла ошибка или $driver не поддерживается");
        }
    }

    public function callback(Service $social, string $driver): RedirectResponse
    {
        return redirect(
            $social->loginSocial(Socialite::driver($driver)->user())
        );
    }
}
