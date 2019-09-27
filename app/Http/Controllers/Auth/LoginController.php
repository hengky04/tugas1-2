<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected function validator(request $request)
    {
        $request->validator([
            $this->username()=>'required|string', 'password'=> 'required|string',
            'captcha' => 'required|captcha',


        ]);
    }

    public function username()
    {
        return 'phone';
    }
    protected function credentials(request $request)
    {
        return $request -> only($this->username(),'password');

    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha'=>captcha_img()]);
    }
    
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
