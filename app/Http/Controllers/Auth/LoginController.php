<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use App\User;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
        // return "HEllo";
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        $data = Socialite::driver('facebook')->user();

        $finduser = User::where('email',$data->email)->first();
        
        if($finduser)
        {
            Auth::login($finduser);
            return redirect('/home');
        }
            
        else
        {
            $name =  $data->name;
            $email = $data->email;

            return view('auth.register',compact('data'));
/*            $obj = new User;
            
            $obj->name = $data->name;
            $obj->email = $data->email;        
            $obj->gender = 'male';
            $obj->password = bcrypt('123456789');
            $obj->save();
*/
            // return redirect('/home');
        }
    }

    protected function credentials(Request $request)
    {
        if(is_numeric($request->get('email')))
        {
            return ['phone'=>$request->get('email'),'password'=>$request->get('password')];
        }

        else if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $request->get('email')) ) 
        {
            return ['email' => $request->get('email'), 'password' => $request->get('password')];
        } 

        else if(is_string($request->get('email')))
        {
            return ['username' => $request->get('email'), 'password' => $request->get('password')];               
        }
    }
}
