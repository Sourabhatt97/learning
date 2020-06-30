@extends('layout.front.app')
@section('content')
<div class="wrapper"> 
	<div class="page">
		<div class="main-container col1-layout content-color color">
			<div class="woocommerce">
				<div class="container">
					<div class="content-top">
						<h2>Checkout</h2>
						<p>Need to Help? Call us: +91 6378707734 or Email: <a href="https://bit.ly/2II0hUV">sbhatt692@gmail.com</a></p>
					</div><!--- .content-top-->
					<div class="checkout-step-process">
						<ul>
							<li>
								<div class="step-process-item"><i data-href="checkout-step2.html" class="redirectjs fa fa-check step-icon"></i><span class="text">Address</span></div>
							</li>
							<li>
								<div class="step-process-item active"><i data-href="checkout-step4.html" class="redirectjs step-icon icon-notebook"></i><span class="text"><a href = "{{url('checkout/review')}}">Order Review</a></span></div>
							</li>
						</ul>
					</div><!--- .checkout-step-process-->						
					
					<ul class="row">
						<li class="col-md-9 col-padding-right">
							<table class="table-order table-order-review">
								<thead>
									<tr>
										<td width="68">Product Name</td><td width="14">price</td><td width="14">QTY</td><td width="14">Total</td>
									</tr>
								</thead>
								<tbody>
									@foreach($products as $product)
									<tr>
										<td class="name">{{$product->name}}</td><td>₹{{$product->price}}</td><td>{{$product->cart_quan}}</td><td class="price">₹{{$product->total_amount}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>

							<?php
							$user_id = Auth::user()['id']
							?>
							<table class="table-order table-order-review-bottom">
								<tr>
									<td class="first" width="80%">Sub total</td>
									<td width="20%">₹{{$product->where('user_id',$user_id)->sum('Total_Amount')}}</td>
								</tr>
								<tr>
									<td class="first">Shipping Fee</td>
									<td>₹100</td>
								</tr>
								<tr>
									<td class="first large">Total Payment</td>
									<td class="price large">₹{{$product->where('user_id',$user_id)->sum('Total_Amount')+100}}</td>
								</tr>
								<tfoot>
									<td colspan="2">
										<div class="left">Forgot an Item? <a href="{{url('viewcart')}}">Edit Your Cart</a></div>
									</td>
								</tfoot>
							</table>
						</li>
						<li class="col-md-3">
							<ul class="step-list-info">
								<li>
									<div class="title-step">Billing Address</div>
									<p><strong>{{$address->name}}</strong><br>
										
										{{$address->address}}<br> {{$address->zip_code}}<br>
										{{$address->phone}}
									</p>
								</li>
							</ul>
						</li>
					</ul>
					<form action="{{url('/paymenttype')}}" method="get">

						<input type="text" name="bill_id" value="{{$address->id}}" hidden="">
						
						<div class="checkout-info-text">
							<h3>Payment Method</h3>
						</div>
						<div class="content-radio">
							<input type="radio" name="payment" checked id="pr1" value="home">
							<label for="pr1" class="label-radio">At home</label>
							<p>Pay for the package when you recieve it.</p>
						</div>
						<div class="content-radio">
							<input type="radio" name="payment" id="pr2" value="getway">
							<label for="pr2" class="label-radio">Credit Card</label>
							<p>Pay with a credit card</p>
						</div>
						<div class="checkout-col-footer">
							<input type="submit" value="Place Order" class="btn-step btn-highligh">
						</div>
						<div class="line-bottom"></div>
					</form>
				</div><!--- .container-->	
			</div><!--- .woocommerce-->	
		</div><!--- .main-container -->
	</div><!--- .page -->
</div><!--- .wrapper -->
@stop