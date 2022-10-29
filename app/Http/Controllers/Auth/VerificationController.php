<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function getVerifyForm(): Application|Factory|View
    {
        return view('');
    }

    public function verificationRequest(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();

        return redirect(route('home'));
    }

    public function repeatSendToMail(Request $request): RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', __('email-verification.repeat'));
    }
}
