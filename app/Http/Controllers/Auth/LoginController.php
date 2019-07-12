<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Input;
use \Validator, \Auth, \Redirect;
use Request;
use App\Models\LoginLog;

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
    protected $redirectTo = '/info';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username(){
        return 'clues';
    }

    public function showLogin(){
        return view('login');
    }

    public function doLogin(){
        try{
            $rules = array(
                'user'     => 'required',
                'password' => 'required|alphaNum|min:3'
            );
    
            $validator = Validator::make(Input::all(), $rules);
    
            if ($validator->fails()) {
                return Redirect::to('login')
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
            }else{
                $userdata = array(
                    'clues'     => Input::get('user'),
                    'password'  => Input::get('password')
                );
    
                if (Auth::attempt($userdata)) {
                    $usuario = Auth::user();

                    $log = [
                        'user_id'=>$usuario->id,
                        'clues'=>$usuario->clues,
                        'ip'=>Request::ip()
                    ];

                    LoginLog::create($log);
                    return Redirect::to('info');
                } else {
                    return Redirect::to('login')
                        ->withErrors($validator) // send back all errors to the login form
                        ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
                }
            }
        }catch(\Exception $e){
            echo $e->getMessage() . '<br>' . $e->getLine();
        }
    }
}
