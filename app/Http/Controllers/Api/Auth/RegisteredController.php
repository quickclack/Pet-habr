<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredRequest;
use Domain\User\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;

class RegisteredController extends Controller
{
    public function store(RegisteredRequest $request)
    {
        $user = User::create([
            'nickName' => $request->nickName,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(40)
        ]);

        event(new Registered($user));

        auth()->login($user);

        return response()->json($user);
    }
}
