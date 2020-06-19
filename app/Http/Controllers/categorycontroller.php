<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use Validator;

class categorycontroller extends Controller
{
    public function index()
    {
    	return view('layout.admin.category.addcategory');
    }

    public function insert(Request $request)
    {
       $validator = Validator::make($request->all(), 
        [
            'name' => 'required|unique:categories'
        ]);

        if ($validator->fails()) 
        {
            return redirect('admin/category/add')->with("message","Category is already added");
        }   

    	$obj = new category;

    	$obj->name = $request->name;
    	
        if($obj->save())
        {
    	   return back()->with("message","Category Added Successfully");
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

    public function checkedit(Request $request)
    {
        if($request->ajax())
        {
            $name = $request->name;
            $id = $request->id;

            $count = Category::where('name',$name)->get()->count();

            $self_count = Category::where('name',$name)->where('id',$id)->get()->count();

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
        $categories = Category::where('status','!=','t')->get();

    return view('layout.admin.category.showcategory',compact('categories'));
    }

    public function status(Request $request)
    {
        if($request->ajax())
        {
            Category::where('id',$request->id)->update(["status"=>$request->status]);
        }

        else
        {
            abort(404);
        }
    }

    public function delete(Request $request, $id)
    {
        Category::where('id',$request->id)->update(['status'=>'t']);

        return back()->with("message",'Category Deleted Successfully');
    }

    public function trash()
    {
        $trashcategories = Category::where('status','t')->get();

        return view('layout.admin.category.trashcategory',compact('trashcategories'));
    }

    public function restore(Request $request, $id)
    {
        Category::where('id',$request->id)->update(['status'=>'y']);
        return back()->with("message","Category restored Successfully");
    }

    public function edit(Request $request, $id)
    {
        $editcategory = Category::where('id',$request->id)->get();

        return view('layout.admin.category.editcategory',compact('editcategory'));
    }

    public function update(Request $request, $id)
    {
        $name = $request->name;
        $id = $request->id;

        $validator = Validator::make($request->all(), 
        [ 
            'name' => 'required|unique:categories,name,' .$id
        ]);

        if ($validator->fails()) 
        {
            return back()->with("message","Category is already added");
        }   

        else
        {
            Category::where('id',$request->id)->update(['name'=>$name]);

            return back()->with("message","Category Updated Successfully");
        }

    }
}










