<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon;

class verifycontroller extends Controller
{
    public function index()
    {

    	$users = User::all()->count();

    	$mytime = Carbon\Carbon::now();
    	$current_time = $mytime->toDateString();

    	return view('layout.admin.dashboard',['users'=>$users,'current_time'=>$current_time]);
    }
}
