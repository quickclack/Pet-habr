<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verificationRequest(EmailVerificationRequest $request)
    {
        $request->fulfill();
    }

    public function repeatSendToMail(Request $request): JsonResponse
    {
        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Письмо отправлено повторно']);
    }
}
