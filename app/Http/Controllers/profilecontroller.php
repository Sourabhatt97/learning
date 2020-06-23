<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use Auth;
use Validator;

class profilecontroller extends Controller
{
    public function index()
    {
		return view('layout.admin.profile');
    }

    public function edit(Request $request)
    {
    	$id = Auth::user()->id;

    	$name = $request->name;
		$email = $request->email;
    	$username = $request->username;
		$phone = $request->phone;

        if(User::where('id',$id)->update(array('name'=>$name,'username'=>$username,'email'=>$email,'phone'=>$phone)))
        {
            return view('layout.admin.profile')->with("message","Profile Updated Successfully");
        }


    }

    public function checkemail(Request $request)
    {   
    	if($request->ajax())
        {
            $email = $request->email;
            $id = Auth::user()->id;

            $count = User::where('email',$email)->get()->count();

            $self_count = User::where('email',$email)->where('id',$id)->get()->count();

            if($count == $self_count)
            {
                return "true";
            }

            else
            {
                return "false";
            }
        }
    }

     public function checkphone(Request $request)
    {   
    	if($request->ajax())
        {
            $phone = $request->phone;
            $id = Auth::user()->id;

            $count = User::where('phone',$phone)->get()->count();

            $self_count = User::where('phone',$phone)->where('id',$id)->get()->count();

            if($count == $self_count)
            {
                return "true";
            }

            else
            {
                return "false";
            }
        }
    }

    public function checkusername(Request $request)
    {   
    	if($request->ajax())
    	{
    		$username = $request->username;
    		$id = Auth::user()->id;

    		$count = User::where('username',$username)->get()->count();

    		$self_count = User::where('username',$username)->where('id',$id)->get()->count();

    		if($count == $self_count)
    		{
    			return "true";
    		}

    		else
    		{
    			return "false";
    		}
    	}
    }
}
