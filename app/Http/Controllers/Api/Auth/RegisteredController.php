<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredRequest;
use Domain\User\Actions\Contracts\RegisteredContract;
use Domain\User\DTO\NewUserDto;
use Illuminate\Http\JsonResponse;

class RegisteredController extends Controller
{
    public function store(RegisteredRequest $request, RegisteredContract $contract): JsonResponse
    {
        $user = $contract(NewUserDto::formRequest($request));

        return $this->getToken(
            $user->createToken('auth_token')->plainTextToken
        );
    }
}
