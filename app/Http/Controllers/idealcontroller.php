<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ideal;
use Validator;
use Auth;

class idealcontroller extends Controller
{
    public function index()
    {
    	return view('layout.admin.ideal.addideal');
    }

    public function insert(Request $request)
    {
       $validator = Validator::make($request->all(), 
        [
            'name' => 'required|unique:ideals'
        ]);

        if ($validator->fails()) 
        {
            return redirect('admin/ideal/add')->with("message","ideal is already added");
        }   

    	$obj = new ideal;

    	$obj->name = $request->name;
    	
        if($obj->save())
        {
    	   return back()->with("message","ideal Added Successfully");
        }

    }

    public function check(Request $request)
    {
    	if($request->ajax())
    	{
    		$count = ideal::where('name',$request->name)->get()->count();

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

            $count = ideal::where('name',$name)->get()->count();

            $self_count = ideal::where('name',$name)->where('id',$id)->get()->count();

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
        $ideals = ideal::where('status','!=','t')->get();

    return view('layout.admin.ideal.showideal',compact('ideals'));
    }

    public function status(Request $request)
    {
        if($request->ajax())
        {
            ideal::where('id',$request->id)->update(["status"=>$request->status]);
        }

        else
        {
            abort(404);
        }
    }

    public function delete(Request $request, $id)
    {
        ideal::where('id',$request->id)->update(['status'=>'t']);

        return back()->with("message",'ideal Deleted Successfully');
    }

    public function trash()
    {
        $trashideals = ideal::where('status','t')->get();

        return view('layout.admin.ideal.trashideal',compact('trashideals'));
    }

    public function restore(Request $request, $id)
    {
        ideal::where('id',$request->id)->update(['status'=>'y']);
        return back()->with("message","ideal restored Successfully");
    }

    public function edit(Request $request, $id)
    {
        $editideal = ideal::where('id',$request->id)->get();

        return view('layout.admin.ideal.editideal',compact('editideal'));
    }

    public function update(Request $request, $id)
    {
        $name = $request->name;
        $id = $request->id;

        $validator = Validator::make($request->all(), 
        [ 
            'name' => 'required|unique:ideals,name,' .$id
        ]);

        if ($validator->fails()) 
        {
            return back()->with("message","ideal is already added");
        }   

        else
        {
            ideal::where('id',$request->id)->update(['name'=>$name]);

            return back()->with("message","ideal Updated Successfully");
        }

    }
}
