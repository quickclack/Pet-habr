<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticatedController extends Controller
{
    use AuthenticatesUsers
    {
        logout as protected traitLogout;
        login as protected traitLogin;
    }

    public function store(LoginRequest $request): JsonResponse
    {
        return $this->traitLogin($request);
    }

    public function logout(Request $request): JsonResponse
    {
        return $this->traitLogout($request);
    }
}
