<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Billing_address;
use App\User;
use Auth;
use Validator;
use App\Cart;
use PDF;
use Mail;
use App\Order;
use Carbon;
use App\Orderdetail;
use App\Product;
use App\Payments;
use Stripe;
use Session;

class billingcontroller extends Controller
{
    public function index(Request $request)
    {
    	$id = Auth::user()->id;
    	
    	$bills = Billing_address::where('user_id',$id)->get();

    	return view('layout.front.checkout.billing_address',compact('bills'));
    }

    public function add(Request $request)
    {
		if($request->newaddress == "addaddress")
		{
	    	$validator = Validator::make($request->all(), [
				'name' => 'required',
				'email' => 'required|email',
				'country' => 'required',
				'state' => 'required',
				'city' => 'required',
				'zip_code' => 'required',
				'address' => 'required',
				'phone' => 'required','digits:10',
			]);

			if($validator->fails())
			{
				return back();
			}

			$id = Auth::user()->id;

			$obj = new Billing_address;

			$obj->user_id = $id;
			$obj->name = $request->name;
			$obj->email = $request->email;
			$obj->country = $request->country;
			$obj->state = $request->state;
			$obj->city = $request->city;
			$obj->zip_code = $request->zip_code;
			$obj->address = $request->address;
			$obj->phone = $request->phone;

			$obj->save();

			$products = Cart::join('products', 'carts.product_id', '=', 'products.id')
			->select('products.*', 'products.id as pro_id','carts.*','carts.quantity as cart_quan','carts.id as cart_id')
			->orderBy('cart_id','desc')
			->where('user_id',$id)
			->get();

			$bill_id = Billing_address::latest()->first();

			$address = Billing_address::where('id',$bill_id['id'])->get()->first();

			return view('layout.front.checkout.orderreview',['products'=>$products,'address'=>$address]);
		}

		else
		{
			$user_id = Auth::user()->id;

			$products = Cart::join('products', 'carts.product_id', '=', 'products.id')
			->select('products.*', 'products.id as pro_id','carts.*','carts.quantity as cart_quan','carts.id as cart_id')
			->orderBy('cart_id','desc')
			->where('user_id',$user_id)
			->get();

			$address = Billing_address::where('id',$request->newaddress)->get()->first();	

			return view('layout.front.checkout.orderreview',['products'=>$products,'address'=>$address]);
		}
    }

    public function paymenttype(Request $request)
    {
    	if($request->payment == "home")
    	{
            $user_id = Auth::user()->id;
            // Add data in orders table
            
            $mytime = Carbon\Carbon::now();
            $current_time = $mytime->toDateString();

            $ship = Carbon\Carbon::now()->addDays(7);
            $ship_time = $ship->toDateString();

            $order_obj = new Order;

            $order_obj->user_id = $user_id;
            $order_obj->billing_id = $request->bill_id;
            $order_obj->order_date = $current_time;
            $order_obj->ship_date = $ship_time;
            $order_obj->payment_date = $ship_time;
            $order_obj->status = "pending";

            $order_obj->save(); 

            $order_id = Order::latest()->first();

            $carts_data = Cart::where('user_id',$user_id)->get();

            foreach($carts_data as $cartdata)
            {
                $orderdetail_obj = new Orderdetail;
                
                $orderdetail_obj->product_id = $cartdata['product_id'];
                $orderdetail_obj->order_id = $order_id['id'];
                $orderdetail_obj->quantity = $cartdata['quantity'];
                $orderdetail_obj->total_amount = $cartdata['total_amount'];
            
                $product_id = Product::where('id',$orderdetail_obj['product_id'])->get('stock')->first();

                $new_stock = $product_id['stock'] - $orderdetail_obj['quantity'];

                Product::where('id',$orderdetail_obj['product_id'])->update(['stock'=>$new_stock]);

                $orderdetail_obj->save();
            }

            $payment_obj = new Payments;

            $payment_obj->order_id = $order_id['id'];
            $payment_obj->payment_type = "Cash_On_Delivery";
            $payment_obj->status = "pending";
            
            $payment_obj->save();

            Cart::where('user_id',$user_id)->delete();

            $email = Auth::user()->email;
            $name = Auth::user()->name;

            $user_id = Auth::user()->id;

            $products = OrderDetail::join('orders','orderdetails.order_id','=','orders.id')
            ->join('products','orderdetails.product_id','=','products.id')
            ->select('orders.*','orders.id as order_id','orders.status as order_status','orderdetails.quantity as order_quantity','orderdetails.*','products.*','products.name as product_name','products.price as product_price')
            ->where('orderdetails.order_id',$order_id['id'])
            ->get();

            $address = Billing_address::where('id',$request->bill_id)->get();   

            $pdf = PDF::loadView('layout.front.checkout.pdf',['products'=>$products,'address'=>$address]);  
            
            $data["email"]=$email;
            $data["name"]=$name;
            $data["subject"]="Invoice PDF";
            $data["address"] = $address;
            $data["products"] = $products;

            Mail::send('layout.front.checkout.pdf', $data, function($message)use($data,$pdf) {
            $message->to($data["email"], $data["name"])
            ->subject($data["subject"])
            ->attachData($pdf->output(), "invoice.pdf");
            });
            
            return view('layout.front.checkout.invoice',['products'=>$products,'address'=>$address,'user_id'=>$user_id]);
    	}

    	else if($request->payment == "getway")
    	{
            $bill_id = $request->bill_id;
    		return view('layout.front.payment.stripegetway',compact('bill_id'));
    	}
    } 
}









