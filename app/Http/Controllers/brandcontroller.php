<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\brand;

class brandcontroller extends Controller
{
	public function index()
	{
		return view('layout.admin.brand.addbrand');
	}

	public function insert(Request $request)
	{
		$validator = Validator::make($request->all(), 
			[
				'name' => 'required|unique:brands'
			]);

		if ($validator->fails()) 
		{
			return redirect('admin/brand/add')->with("message","brand is already added");
		}   

		$obj = new brand;

		$obj->name = $request->name;

		if($obj->save())
		{
			return back()->with("message","brand Added Successfully");
		}

	}

	public function check(Request $request)
	{
		if($request->ajax())
		{
			$count = brand::where('name',$request->name)->get()->count();

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

	public function checkedit(Request $request)
	{
		if($request->ajax())
		{
			$name = $request->name;
			$id = $request->id;

			$count = brand::where('name',$name)->get()->count();

			$self_count = brand::where('name',$name)->where('id',$id)->get()->count();

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
		$brands = brand::where('status','!=','t')->get();

		return view('layout.admin.brand.showbrand',compact('brands'));
	}

	public function status(Request $request)
	{
		if($request->ajax())
		{
			brand::where('id',$request->id)->update(["status"=>$request->status]);
		}

		else
		{
			abort(404);
		}
	}

	public function delete(Request $request, $id)
	{
		brand::where('id',$request->id)->update(['status'=>'t']);

		return back()->with("message",'brand Deleted Successfully');
	}

	public function trash()
	{
		$trashbrands = brand::where('status','t')->get();

		return view('layout.admin.brand.trashbrand',compact('trashbrands'));
	}

	public function restore(Request $request, $id)
	{
		brand::where('id',$request->id)->update(['status'=>'y']);
		return back()->with("message","brand restored Successfully");
	}

	public function edit(Request $request, $id)
	{
		$editbrand = brand::where('id',$request->id)->get();

		return view('layout.admin.brand.editbrand',compact('editbrand'));
	}

	public function update(Request $request, $id)
	{
		$name = $request->name;
		$id = $request->id;

		$validator = Validator::make($request->all(), 
			[ 
				'name' => 'required|unique:brands,name,' .$id
			]);

		if ($validator->fails()) 
		{
			return back()->with("message","brand is already added");
		}   

		else
		{
			brand::where('id',$request->id)->update(['name'=>$name]);

			return back()->with("message","brand Updated Successfully");
		}
	}
}
