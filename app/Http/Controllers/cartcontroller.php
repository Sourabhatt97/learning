<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Auth;

class cartcontroller extends Controller
{
	public function addcart(Request $request)
	{
		$product_quan_in_db = Product::where('id',$request->cart)->get()->first();
		$total_amount = $product_quan_in_db['price'] * $request->quantity;

		if($request->quantity > 0 && $request->quantity < $product_quan_in_db['stock'])
		{			
			$id = Auth::user()->id;

			$product_count = Cart::where('product_id',$request->cart)->get()->count();

			if($product_count)
			{
				Cart::where('product_id',$request->cart)->update(['quantity'=>$request->quantity,'total_amount'=>$total_amount]);
			}

			else
			{
				$obj = new Cart;

				$obj->user_id = $id;
				$obj->product_id = $request->cart;
				$obj->quantity = $request->quantity;
				$obj->total_amount = $total_amount;
				$obj->save();
			}
		}
	}

	public function getminicart()
	{
		$user_id = auth()->user();
		$userid = $user_id['id'];

		if(Auth::check())
		{
			$data = Cart::join('products', 'carts.product_id', '=', 'products.id')
			->select('products.*', 'products.id as product_id','carts.*','carts.quantity as cart_quantity','carts.id as cart_id')
			->orderBy('cart_id','desc')
			->where('user_id',$userid)
			->get();
			
			if(count($data) == 0)
			{
				$data=null;
			}
			return view('layout.front.cart',['data'=>$data]);
		}	
	}

	public function removeminicart(Request $request)
	{
		Cart::where('id',$request->id)->delete();
	}

	public function getfullcart(Request $request)
	{
		$user_id = auth()->user();
		$userid = $user_id['id'];

		if(Auth::check()){
			$products = Cart::join('users', 'users.id', '=', 'carts.user_id')
			->join('products', 'carts.product_id', '=', 'products.id')
			->select('products.*', 'products.id as pro_id','carts.*','carts.quantity as cart_quan','carts.id as cart_id', 'products.stock as product_quantity')
			->orderBy('cart_id','desc')
			->where('user_id',$userid)
			->get();
			
			if(count($products) == 0)
			{
				$products=null;
			}
		}

		return view('layout.front.wishlist',compact('products'));
	}

	public function removeproduct(Request $request, $id)
	{
		Cart::where('id',$id)->delete();

		return back();
	}
}
