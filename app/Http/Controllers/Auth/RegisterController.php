<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Auth;
use Storage;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return  Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required','digits:10','unique:users'],
            'age' => ['required'],
            'gender' => ['required'],
            'image' => ['mimes:jpg,jpeg,png|required|max:10000'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


    }

    protected function checkemail(Request $request)
    {   
        if($request->ajax())
        {
            $email = User::where('email',$request->email)->get()->count();

            if($email)
            {
                return "false";
            }

            else
            {
                return "true";
            }
        }
    }

    protected function checkusername(Request $request)
    {   
        if($request->ajax())
        {
            $username = User::where('username',$request->username)->get()->count();

            if($username)
            {
                return "false";
            }

            else
            {
                return "true";
            }
        }
    }


    protected function checkphone(Request $request)
    {   
        if($request->ajax())
        {
            $phone = User::where('phone',$request->phone)->get()->count();

            if($phone)
            {
                return "false";
            }

            else
            {
                return "true";
            }
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $pic = request()->file('image')->store('public/users/images/' .$data['username']);
        
        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'age' => $data['age'],
            'gender' => $data['gender'],
            'image' => $pic,
            'password' => Hash::make($data['password']),
        ]);
        
        return $user;
    }
}
