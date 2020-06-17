<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Console\Scheduling\Event;

class deletecontroller extends Controller
{
    public function delete_account()
    {
		$id = Auth::user();

		User::where('id',$id->id)->update(["status"=>"disabled"]);
		Auth::logout();

		return redirect('/login')->with("message","Your Account has been Deleted");
    }
}
