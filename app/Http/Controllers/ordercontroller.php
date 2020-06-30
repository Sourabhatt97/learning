<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Category;
use App\Product;
use App\Color;
use App\OrderDetail;
use App\Billing_address;
use Auth;
use App\User;

class ordercontroller extends Controller
{
	public function index()
	{
		$products = Order::join('users', 'users.id', '=', 'orders.user_id')
		->select('orders.id as order_id', 'users.name as user_name', 'orders.ship_date as order_status', 'orders.order_date as order_date')
		->orderBy('orders.id','desc')
		->get();

		return view('layout.admin.order.orderlist',compact('products'));
	}

	public function orderview(Request $request, $id)
	{
		$billing_id = Order::select('billing_id')->where('id',$id)->get()->first();

		$billing_address = Billing_address::where('id',$billing_id['billing_id'])->select('billing_addresses.*','billing_addresses.name as bill_name')->get();

		$orders = OrderDetail::join('orders','orderdetails.order_id','=','orders.id')
					->join('products','orderdetails.product_id','=','products.id')
					->select('orders.*','orderdetails.*','products.*','products.name as product_name','products.price as product_price')
					->where('order_id',$id)
					->get();

		foreach($billing_address as $b)
		{
			$users = User::where('id',$b['id'])->get();
		}

		return view('layout.admin.order.orderview',['address'=>$billing_address,'orders'=>$orders,'users'=>$users]);
	}
}















