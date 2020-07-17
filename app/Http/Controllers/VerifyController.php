<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifyController extends Controller

{
    public function verify(OTPRequest $request) 
    {
        //dd (request('OTP'));
        //dd (auth()->user()->OTP());

        if (request('OTP') == auth()->user()->OTP()) {        //Cache::get('OTP')) 
            auth()->user()->update(['isVerified' => true]);
            return redirect('/home');
         }

         return back()->withErrors('OTP is expired or invalid');
    }

    public function showVerifyForm()
    {
        return view('OTP.verify');
    }
}
