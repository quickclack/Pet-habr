<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ReestablishRequest;
use App\Jobs\SendNewPasswordJob;
use Domain\User\Queries\UserBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class ReestablishController extends Controller
{
    public function __invoke(ReestablishRequest $request, UserBuilder $builder): JsonResponse
    {
        $password = Str::random(15);

        $user = $builder->getUserByEmail($request->email);

        $user->forceFill([
            'password' => bcrypt($password)
        ]);

        dispatch(new SendNewPasswordJob($user, $password));

        $user->save();

        return $this->message('Временный пароль был отправлен на вашу почту');
    }
}
