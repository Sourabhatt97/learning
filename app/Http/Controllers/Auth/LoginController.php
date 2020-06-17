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

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
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
}
