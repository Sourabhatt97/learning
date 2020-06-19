<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\color;
use Validator;

class colorcontroller extends Controller
{
	public function index()
	{
		return view('layout.admin.color.addcolor');
	}

	public function check(Request $request)
	{
		if($request->ajax())
		{
			$count = color::where('name',$request->name)->get()->count();

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

	public function insert(Request $request)
	{
		$validator = Validator::make($request->all(), 
			[
				'name' => 'required|unique:colors'
			]);

		if ($validator->fails()) 
		{
			return redirect('admin/color/add')->with("message","Color is already added");
		}   

		$obj = new color;
		$obj->name = $request->name;

		if($obj->save())
		{
			return back()->with("message","Color Added Successfully");
		}
	}

	public function checkedit(Request $request)
	{
		if($request->ajax())
		{
			$name = $request->name;
			$id = $request->id;

			$count = Color::where('name',$name)->get()->count();

			$self_count = Color::where('name',$name)->where('id',$id)->get()->count();

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

	public function show()
	{
		$colors = Color::where('status','!=','t')->get();

		return view('layout.admin.color.showcolor',compact('colors'));
	}

	public function status(Request $request)
	{
		if($request->ajax())
		{
			Color::where('id',$request->id)->update(["status"=>$request->status]);
		}

		else
		{
			abort(404);
		}
	}

    public function delete(Request $request, $id)
    {
        Color::where('id',$request->id)->update(['status'=>'t']);

        return back()->with("message",'Color Deleted Successfully');
    }

    public function trash()
    {
        $trashcolors = color::where('status','t')->get();

        return view('layout.admin.color.trashcolor',compact('trashcolors'));
    }


    public function restore(Request $request, $id)
    {
        Color::where('id',$request->id)->update(['status'=>'y']);
        return back()->with("message","Color restored Successfully");
    }

    public function edit(Request $request, $id)
    {
        $editcolor = Color::where('id',$request->id)->get();

        return view('layout.admin.color.editcolor',compact('editcolor'));
    }

    public function update(Request $request, $id)
    {
    	$name = $request->name;
    	$id = $request->id;

    	$validator = Validator::make($request->all(), 
    		[ 
    			'name' => 'required|unique:colors,name,' .$id
    		]);

    	if ($validator->fails()) 
    	{
    		return back()->with("message","Color is already added");
    	}   

    	else
    	{
    		Color::where('id',$request->id)->update(['name'=>$name]);

    		return back()->with("message","Color Updated Successfully");
    	}
    }

}
