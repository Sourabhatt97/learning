<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
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
use Redirect;
use Stripe\create;

class paymentcontroller extends Controller
{
    public function stripepayment(Request $request)
    {
        $id = Auth::user()->id;

        $user = User::where('id',$id)->get()->first();

        Stripe\Stripe::setApiKey('sk_test_51GzbY7Fhvvz54uYqfgrZes1kV9UeMrjiO24wRKvjrIf2kNKaddPZZxSDvznP4t06HJny9VbWvio8nvzaoZ9Unnfp00baDOwuF6');

        try
        {
            $customer = \Stripe\Customer::create(array(
                'name' => $user['name'],
                'description' => 'Payment from ApniDukan',
                'email' => $user['email'],
                'source' => $request->stripeToken,
                "address" => ["city" => $user['city'], "country" => $user['country'], "postal_code" => $user['zip_code'], "state" => $user['state']]
            ));

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
            $payment_obj->payment_type = "Stripe_Getway";
            $payment_obj->status = "paid";
            
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

        catch (Exception $e) 
        {
            Session::flash ( 'fail-message', "Error! Please Try again." );
            return Redirect::back ();
        }

    }

   /* public function stripepayment(Request $request)
    {
        \Stripe\Stripe::setApiKey ( 'sk_test_51GzbY7Fhvvz54uYqfgrZes1kV9UeMrjiO24wRKvjrIf2kNKaddPZZxSDvznP4t06HJny9VbWvio8nvzaoZ9Unnfp00baDOwuF6' );
        
        try 
        {
            \Stripe\Charge::create ( array (
                "amount" => 300 * 100,
                "currency" => "usd",
                    "source" => $request->input ( 'stripeToken' ), // obtained with Stripe.js
                    "description" => "Payment from ApniDukan" 
                ) );

            Session::flash ( 'success-message', 'Payment done successfully !' );

            return Redirect::back ();
        }

        catch ( \Exception $e ) 
        {
            Session::flash ( 'fail-message', "Error! Please Try again." );
            return Redirect::back ();
        }
    }*/
}