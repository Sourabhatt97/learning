@extends('layout.front.app')
@section('head')
<style type="text/css">
	input[type=number]::-webkit-inner-spin-button, 
	input[type=number]::-webkit-outer-spin-button { 
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		margin: 0; 
	}
</style>
@stop
@section('content')
<div class="main-container col1-layout content-color color">
	<div class="container">
		<div class="content-top no-border">
			<h2>My Wishlist</h2>
			<div class="wish-list-notice"><i class="icon-check"></i>Product with Variants has been added to your wishlist. <a href="{{url('productdetail')}}">Click here</a> to continue shopping.</div>
		</div>

		<div class="table-responsive-wrapper">
			<table class="table-order table-wishlist">
				@isset($products)
				<tbody>
					@foreach($products as $product)
					<tr>
						<td><a href="{{url('remove_product'.'/'.$product->cart_id)}}"><button type="button" class="button-remove rmv_cart" value="{{$product->cart_id}}" id="{{$product->cart_id}}"><i class="icon-close"></i></button></td></a>
						<td>
							<table class="table-order-product-item">
								<tr>
									<td><img src="http://localhost/testing/storage/app/public/images/products/{{$product->UPC}}/main.jpg?.rand()"  height = "70" width = "70"/></td>
									<td><p>{{$product->name}}</p></td>
								</tr>
							</table>
						</td>
						<td class="wish-list-control">
							<div class = "productprice">
								{{$product->price * $product->cart_quan}}
							</div>
							<div class="number-input">
								<button type="button" class="minus" id = "{{$product->product_id}}">-</button>
								<input type="number" id = "cart_qt" maxlength="2"  value = "{{$product->cart_quan}}" class = "quantity" name="value">
								<button type="button" class="plus" value = "{{$product->price}}" id = "{{$product->product_id}}">+</button>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
				@endisset
					<?php
						use App\Product;
						if(isset($products))
						{
							$id = $product->pro_id;
							$quantity = Product::where('id',$id)->get('stock')->first();
							$user_id = Auth::user()['id'];
						}
					?>
			</table>

			@isset($products)
			<input type="text"hidden id="stock" name="stock" value="{{$quantity['stock']}}">
			<input type="text" hidden name="sub_total" id = "sub_total" value = "{{$product->where('user_id',$user_id)->sum('Total_Amount')}}">
			<Strong><br><H4 align = "right">SUB TOTAL:- 
				<div align = "right" class = "subtotal">{{$product->where('user_id',$user_id)->sum('Total_Amount')}}</div></center></H4>
			</Strong>

			<br><a href="{{url('checkout/billing')}}"><button type="button" class="btn-step cart_add" style="float: right;">Checkout</button></a>
			@endisset
		</div><!--- .table-responsive-wrapper-->

	</div><!--- .container-->
</div><!--- .main-container -->

@stop
@section("scripts")

<script type="text/javascript">

	$(document).on('click','.minus,.plus',function(){
		var quan = $(this).parent().find("#cart_qt").val();

		var stock = $('#stock').val();

		if(quan<1)
		{	
			$(this).parent().find("#cart_qt").val(1);
			alert("You can't enter less the 1");
			return "false";
			
		}
		if(quan > 1000)
		{
			$(this).parent().find("#cart_qt").val(stock);
			alert("Sorry! Not more ".concat(stock));
			return "false";
		}	
	});

	$(document).on('click','.minus,.plus', function(){

		var quantity = $(this).parent().find(".quantity").val();
		var cart = $(this).attr('id');

		$.ajax({

			type: "GET",
			url: "{{url('addcart')}}",
			data: {'quantity':quantity,'cart':cart},
			success:function(res)
			{
				$('.mini_cart').html(res);          
			}
		});

	});

	$(document).on('click','.plus,.minus', function(){
		var tot = $(this).parent().find(".quantity").val() * $(this).parent().find(".plus").val();

		$(this).closest('.wish-list-control').find('.productprice').text(tot);
	});

	$(document).on('click','.plus', function(){

		var subtotal = $("#sub_total").val();

		var price = $(this).parent().find(".plus").val();

		var quan = $(this).parent().find(".quantity").val();

		if(quan<1000)
		{
			var total = parseInt(subtotal) + parseInt(price);
		}

		$("#sub_total").val(total);

		$.ajax({
			type: "GET",
			success:function(res)
			{
				$('.subtotal').html(total);          
			}
		});	 
	});

	$(document).on('click','.minus', function(){

		var subtotal = $("#sub_total").val();

		var quan = $(this).parent().find(".quantity").val();

		var price = $(this).parent().find(".plus").val();

		if(quan>1)
		{
			var total = parseInt(subtotal) - parseInt(price);
		}

		$("#sub_total").val(total);

		$.ajax({
			type: "GET",
			success:function(res)
			{
				$('.subtotal').html(total);          
			}
		});	 
	});
</script>
@stop