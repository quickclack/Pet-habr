<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class RegisteredController extends Controller
{
    public function show(): Application|Factory|View
    {
        // TODO возможно будет spa
        return view('');
    }

    public function store(RegisteredRequest $request): RedirectResponse|JsonResponse
    {
        $user = User::create([
            'nickName' => $request->nickName,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(40)
        ]);

        if ($user) {
            event(new Registered($user));

            auth()->login($user);

            return to_route('verification.notice');
        }

        return to_route('login');
    }
}
