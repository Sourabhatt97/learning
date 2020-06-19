<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class profilecontroller extends Controller
{
    public function index()
    {
		return view('layout.admin.profile');
    }
}
