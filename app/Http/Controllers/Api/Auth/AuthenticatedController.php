<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Domain\User\Queries\UserBuilder;
use Illuminate\Http\JsonResponse;

class AuthenticatedController extends Controller
{
    public function store(LoginRequest $request, UserBuilder $builder): JsonResponse
    {
        $request->authenticate();

        $user = $builder->getUserByEmail(email: $request->email);

        return $this->getToken(
            $user->createToken('auth_token')->plainTextToken
        );
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return $this->message('Вы вышли');
    }
}
