<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredRequest;
use Domain\User\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ReturnValidator;
use Illuminate\Support\Facades\Hash;

class RegisteredController extends Controller
{
    use RegistersUsers;

    public function store(RegisteredRequest $request): JsonResponse
    {
        return $this->register($request);
    }

    protected function create(array $data): JsonResponse
    {
        return User::create([
            'nickName' => $data['nickName'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function validator(array $data): ReturnValidator
    {
        return Validator::make($data, []);
    }
}
