<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredRequest;
use Domain\User\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisteredController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => 'store']);
    }

    public function store(RegisteredRequest $request)
    {
        $user = User::create([
            'nickName' => $request->nickName,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = Auth::login($user);

        // event(new Registered($user));

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
