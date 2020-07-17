<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     
    * protected $redirectTo = RouteServiceProvider::HOME;

    * @param \Illuminate\Http\Request  $request
    
    * @return bool
    */

    protected funtion attemptLogin(Request $request) //not sure why this is incorrect. 
    
    {
        //dd(request('otp_via'));

        $result = $this->guard()->attempt(
        $this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );

        if ($result) {

            auth()->user()->sendOTP(request('via'));
        }
    
        return $result;
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        auth()->user()->update(['isVerified'=> 0]);
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->logOut($request) ?: redirect('/');
    }

   

}
