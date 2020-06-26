<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Color;
use App\Product;
use App\products_image;

class productsviewcontroller extends Controller
{
    public function index(Request $request)
    {
    	$allcategories = Category::where('status','y')->get();
    	$allcolors = Color::where('status','y')->get();
    	$allproducts = Product::where('status','y')->get();

    	return view('layout.front.productlist',['categories'=>$allcategories, 'colors'=>$allcolors, 'products'=>$allproducts]);
    }

    public function productfilter(Request $request)
    {
        if($request->category)
        {
            $products = Product::where('category_id',$request->category)->where('status','y')->get();
        }

        else if($request->color && $request->category && $request->option == "Low to High")
        {
            $products = Product::where('status','=','y')
            ->whereIn('category_id',$request->category)
            ->whereIn('color_id',$request->color)
            ->whereBetween('price', 
                array($request->start, $request->end))
            ->orderBy('price','asc')
            ->get();
        }

        else if($request->category && $request->color && $request->option == "High to Low")
        {
            $products = Product::where('status','=','y')
            ->whereIn('category_id',$request->category)
            ->whereIn('color_id',$request->color)
            ->whereBetween('price', 
                array($request->start, $request->end))
            ->orderBy('price','desc')
            ->get();
        }

        else if($request->color && $request->option == "Low to High")
        {
            $products = Product::where('status','=','y')
            ->whereIn('color_id',$request->color)
            ->whereBetween('price', 
                array($request->start, $request->end))
            ->orderBy('price','asc')
            ->get();
        }

        else if($request->color && $request->option == "High to Low")
        {
            $products = Product::where('status','=','y')
            ->whereIn('color_id',$request->color)
            ->whereBetween('price', 
                array($request->start, $request->end))
            ->orderBy('price','desc')
            ->get();
        }

        else if($request->category && $request->option == "Low to High")
        {
            $products = Product::where('status','=','y')
            ->whereIn('category_id',$request->category)
            ->whereBetween('price', 
                array($request->start, $request->end))
            ->orderBy('price','asc')
            ->get();  
        }

        else if($request->category && $request->option == "High to Low")
        {
            $products = Product::where('status','=','y')
            ->whereIn('category_id',$request->category)
            ->whereBetween('price', 
                array($request->start, $request->end))
            ->orderBy('price','desc')
            ->get();  
        }

        else if($request->option == "Low to High")
        {
            $products = Product::where('status','y') ->whereBetween('price', 
                array($request->start, $request->end))->orderBy('price','asc')->get();
        }
        
        else
        {
            $products = Product::where('status','y') ->whereBetween('price', 
                array($request->start, $request->end))->orderBy('price','desc')->get();
        }

        if($request->ListType == 'list')
        {
            return view('layout.front.list', compact("products"));
        }

        else
        {
            return view('layout.front.grid', compact("products"));   
        }
    }

    public function productdetail(Request $request, $access_url)
    {
        $products = Product::where('access_url',$access_url)->get();

        foreach($products as $product)
        {    
            $status = $product['status'];
            $id = $product['id'];
        }

        $images = products_image::where('product_id',$id)->get();

        $category_id = Product::select('category_id')->where('id',$id)->first();
        
        $category_name = Category::where('id',$category_id['category_id'])->get();

        $color_id = Product::select('color_id')->where('id',$id)->first();

        $color_name = Color::where('id',$color_id['color_id'])->get();

        if($status == 'y')
        {
            return view('layout.front.productdetails',['products'=>$products,'images'=>$images,'categories'=>$category_name,'colors'=>$color_name]);
        }

        else
        {
            abort(404);
        }
    }
}
