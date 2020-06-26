<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Color;
use App\Product;

class productsviewcontroller extends Controller
{
    public function index(Request $request)
    {
    	$allcategories = Category::where('status','y')->get();
    	$allcolors = Color::where('status','y')->get();
    	$allproducts = Product::where('status','y')->get();

    	return view('layout.front.productlist',['categories'=>$allcategories, 'colors'=>$allcolors, 'products'=>$allproducts]);
    }

    public function watchfilter(Request $request)
    {
    	        if($request->color && $request->category && $request->option == "Low to High")
        {
            $products = Product::where('status','=','y')
            ->whereIn('category_id',$request->category)
            ->whereIn('color_id',$request->color)
            ->whereBetween('price', 
                array($request->start, $request->end))
            ->orderBy('price','asc')
            ->get();
        }

        else if($request->color && $request->category && $request->option == "High to Low")
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
}
