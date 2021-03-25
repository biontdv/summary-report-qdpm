<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Library\GetSession;
use Illuminate\Http\Request;
use App\User;						   

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
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    public function logOff(Request $request){
        \Session::forget('users');
        return redirect(env('QDPM_LOGOFF'));
    }
    public function login(Request $request){
        \Session::forget('users');
        $session_users = "";
        if($request->id){
            $users = User::findOrFail($request->id);
            if(!$request->session()->has('users')){
               session()->put('users', $users);
           }
       }else{
        return redirect(env('QDPM_URL'));
    }
        return redirect(env('QDPM_URL'));
    }			  
}
