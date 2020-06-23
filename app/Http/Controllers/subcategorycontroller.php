<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\subcategory;
use App\category;
use Auth;
use Validator;

class subcategorycontroller extends Controller
{
    public function index()
    {
    	$categories = category::where('status','=','y')->get();
    	
    	return view('layout.admin.subcategory.addsubcategory',compact('categories'));
    }

    public function insert(Request $request)
    {
       $validator = Validator::make($request->all(), 
        [
            'name' => 'required|unique:categories'
        ]);

        if ($validator->fails()) 
        {
            return redirect('admin/subcategory/add')->with("message","subcategory is already added");
        }   

    	$obj = new category;

    	$obj->name = $request->name;
    	$obj->parent_id = $request->category_id;
    	
        if($obj->save())
        {
    	   return back()->with("message","subcategory Added Successfully");
        }

    }

    public function check(Request $request)
    {
    	if($request->ajax())
    	{
    		$count = category::where('name',$request->name)->get()->count();

            if($count == 0)
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
