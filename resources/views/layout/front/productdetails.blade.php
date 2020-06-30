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
<div class="wrapper"> 
	<div class="page">
		<div class="main-container col2-left-layout ">
			<div class="container">
				<div class="main">
					<div class="row">
						<div class="alert alert-success" hidden>
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Success!</strong> Product is successfully added
						</div>
						<div class="col-main col-lg-12">
							<div class="product-view">
								<div class="product-essential">
									<div class="row">
										<form action="#" method="post" id="product_addtocart_form">
											<div class="product-img-box clearfix col-md-5 col-sm-5 col-xs-12">
												<div class="product-img-content">
													<div class="product-image product-image-zoom">
														@foreach($products as $product)
														<div class="product-image-gallery"><img id="image-main"
															class="gallery-image visible img-responsive"
															src = "http://localhost/testing/storage/app/public/images/products/{{$product->UPC}}/main.jpg?.rand()" 
															alt="{{$product->name}}"
															title="{{$product->name}}"/></div>
														</div><!--- .product-image-->
														@endforeach
														<?php
															use App\Product;
															$id = $product->id;
															$quantity = Product::where('id',$id)->get('stock')->first();
														?>


														<div class="more-views">
															<h2>More Views</h2>
															<ul class="product-image-thumbs">
																@foreach($images as $image)
																<li> <a class="thumb-link" href="http://localhost/testing/storage/app/{{$image->image}}?.rand()" title="" data-image-index="0"> <img class="img-responsive" src = "http://localhost/testing/storage/app/{{$image->image}}?.rand()"
																	alt="" /> </a>
																</li>
																@endforeach
															</ul>

														</div><!--- .more-views -->
													</div><!--- .product-img-content-->
												</div><!--- .product-img-box-->
												<div class="product-shop col-md-7 col-sm-7 col-xs-12">
													<div class="product-shop-content">
														<div class="product-name">
															<h1>{{$product->name}}</h1>
														</div>

														<div class="product-type-data">
															<div class="price-box">
																<p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> Rs.{{$product->price}} </span></p>
															</div>
														</div>
														<div class="short-description">
															<h2>Product Description</h2>
															<p>{{$product->description}}</p>
														</div>

														<div class="products-sku"> <span class="text-sku">Product Code: {{$product->UPC}}</span> demo_02</div>

														<div class="products-sku"> <span class="text-sku">Category: {{$categories[0]->name}}</span> demo_02</div>

														<div class="products-sku"> <span class="text-sku">Color: {{$colors[0]->name}}</span> demo_02</div>

														<input type="text"hidden id="stock" name="stock" value="{{$quantity['stock']}}">

														<div class="add-to-box">
															<div class="product-qty">
																<label for="qty">Qty:</label>
																<div class="custom-qty"> <input type="number" min="1" max="10" name="qty" id="qty" value="1" title="Qty" class="input-text qty" /> <button  type="button" class="increase items" id = "plus" onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;"> <i class="fa fa-plus"></i> </button> <button  type="button" class="reduced items" onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) && qty > 1 ) result.value--;return false;"><i class="fa fa-minus"></i> </button></div>
															</div>
															<div class="add-to-cart"> <button type="button" onclick="dosomething(this.value)"  value = "{{$product->id}}" id = "cart_abc" title="Add to Cart" class="button btn-cart" > <span> <span class="view-cart icon-handbag icons">Add to Cart</span> </span> </button></div>
														</div>
													</div><!--- .product-shop-content-->
												</div><!--- .product-shop-->
											</form>
										</div>
									</ul>
								</div><!--- .product-essential-->
							</div><!--- .product-view-->
						</div><!--- .col-main-->
					</div><!--- .row-->
				</div><!--- .main-->
			</form>
		</div><!--- .container-->	
	</div><!--- .main-container -->
</div><!--- .page -->
</div><!--- .wrapper -->
@stop

@section("scripts")

<script type="text/javascript">

	$(document).on('click','#cart_abc', function(){

		var cart = $(this).attr('value');

		var quantity = $('#qty').val();

		var stock = $('#stock').val();

		if(quantity < 1)
		{
			alert("Sorry! Not less than 1");
			return "false";
		}

		else if(quantity > 1000)
		{
			alert("Sorry! Out of stock Not more than ".concat(stock));
			return "false";
		}	

		else
		{
			$("div.alert-success").show("slow");
		}

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
</script>
@stop