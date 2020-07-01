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
use Mail;
use PDF;

class ordercontroller extends Controller
{
	public function index()
	{
		$products = Order::join('users', 'users.id', '=', 'orders.user_id')
		->select('orders.id as order_id', 'users.name as user_name', 'orders.ship_date as order_shipdate', 'orders.order_date as order_date', 'orders.status as order_status')
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
		->select('orders.*','orders.id as order_id','orders.status as order_status','orderdetails.*','products.*','products.name as product_name','products.price as product_price')
		->where('order_id',$id)
		->get();

		foreach($billing_address as $b)
		{
			$users = User::where('id',$b['id'])->get();
		}

		return view('layout.admin.order.orderview',['address'=>$billing_address,'orders'=>$orders,'users'=>$users]);
	}

	public function status(Request $request)
	{
		$user_id = Order::where('id',$request->order_id)->get()->first();	

		$user = User::where('id',$user_id['user_id'])->get()->first();

		Order::where('id',$request->order_id)->update(array('status'=>$request->status));

		$pdf = PDF::loadView('layout.admin.orderstatus',['status'=>$request->status]);  

		$data["email"]=$user['email'];
		$data["name"]=$user['name'];
		$data["subject"]="Order StatusF";

		Mail::send('layout.admin.orderstatus', $data, function($message)use($data,$pdf) {
			$message->to($data["email"], $data["name"])
			->subject($data["subject"])
			->attachData($pdf->output(), "orderstatus.pdf");
		});
	}

	public function userorderlist()
	{
		$orders = Order::join('users', 'users.id', '=', 'orders.user_id')
		->select('orders.id as order_id', 'orders.ship_date as order_shipdate', 'orders.order_date as order_date', 'orders.status as order_status')
		->orderBy('orders.id','desc')
		->get();

		return view('layout.front.order.userorderlist',['orders'=>$orders]);
	}

	public function userorderview(Request $request, $id)
	{
		$billing_id = Order::select('billing_id')->where('id',$id)->get()->first();

		$billing_address = Billing_address::where('id',$billing_id['billing_id'])->select('billing_addresses.*','billing_addresses.name as bill_name')->get();

		$orders = OrderDetail::join('orders','orderdetails.order_id','=','orders.id')
		->join('products','orderdetails.product_id','=','products.id')
		->select('orders.*','orders.id as order_id','orders.status as order_status','orderdetails.*','products.*','products.name as product_name','products.price as product_price')
		->where('order_id',$id)
		->get();

		foreach($billing_address as $b)
		{
			$users = User::where('id',$b['id'])->get();
		}

		return view('layout.front.order.userorderview',['address'=>$billing_address,'orders'=>$orders,'users'=>$users]);
	}

	public function userorderstatus(Request $request)
	{
		$user_id = Order::where('id',$request->order_id)->get()->first();	

		$user = User::where('id',$user_id['user_id'])->get()->first();

		Order::where('id',$request->order_id)->update(array('status'=>"cancel_by_user"));

		$pdf = PDF::loadView('layout.admin.orderstatus',['status'=>$request->status]);  

		$data["email"]=$user['email'];
		$data["name"]=$user['name'];
		$data["subject"]="Order StatusF";

		Mail::send('layout.admin.orderstatus', $data, function($message)use($data,$pdf) {
			$message->to($data["email"], $data["name"])
			->subject($data["subject"])
			->attachData($pdf->output(), "orderstatus.pdf");
		});
	}

	public function printinvoicepdf(Request $request, $order_id, $bill_id)
	{    	
		$user_id = Auth::user()->id;

		$products = OrderDetail::join('orders','orderdetails.order_id','=','orders.id')
		->join('products','orderdetails.product_id','=','products.id')
		->select('orders.*','orders.id as order_id','orders.status as order_status','orderdetails.quantity as order_quantity','orderdetails.*','products.*','products.name as product_name','products.price as product_price')
		->where('orderdetails.order_id',$order_id)
		->get();

		$address = Billing_address::where('id',$bill_id)->get();   

		$pdf = PDF::loadView('layout.front.checkout.pdf',['products'=>$products,'address'=>$address]);
  
		return $pdf->download('invoice.pdf');
	}
}















