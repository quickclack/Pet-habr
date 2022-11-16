<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredRequest;
use Domain\User\Actions\Contract\RegisteredContract;
use Domain\User\DTO\NewUserDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RegisteredController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => 'store']);
    }

    public function store(RegisteredRequest $request, RegisteredContract $contract): JsonResponse
    {
        $token = Auth::login($contract(NewUserDTO::formRequest($request)));

        return response()->json([
            'status' => 'success',
            'message' => 'Вы успешно зарегистрировались',
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }
}
