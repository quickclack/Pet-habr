<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Domain\User\Models\UserVerify;

class VerificationController extends Controller
{
    public function verify(string $token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'К сожалению, ваш адрес электронной почты не может быть идентифицирован.';

        if(!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = 'Ваш адрес электронной почты подтвержден.';

            } else {
                $message = 'Ваш адрес электронной почты уже подтвержден.';
            }
        }

        return response()->json([
            'message' => $message
        ]);
    }
}
