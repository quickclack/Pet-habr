<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => 'store']);
    }

    public function store(LoginRequest $request): JsonResponse
    {
        $token = Auth::attempt($request->validated());

        if (!$token) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed')
            ]);
        }

        Auth::user();

        return response()->json([
            'status' => 'success',
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function refresh(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json([
            'status' => 'success',
            'message' => 'Вы успешно вышли',
        ]);
    }
}
