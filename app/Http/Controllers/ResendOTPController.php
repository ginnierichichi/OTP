<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResendOTPController extends Controller
{
    public function resend(ResentOTPRequest $request)
    {
        //dd(request('via'));
        auth()->user()->sendOTP($request->via);
        return back()->with('Message', 'Your new OTP has been sent!');
    }
}
