<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class RegisteredController extends Controller
{
    public function store(RegisteredRequest $request): JsonResponse
    {
        $user = User::create([
            'nickName' => $request->nickName,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(40)
        ]);

        if ($user) {
            //event(new Registered($user));

            auth()->login($user);

            // TODO вернуть на форму подтверждения email
        }

        return response()->json([
            'status' => Response::HTTP_CREATED
        ]);
    }
}
