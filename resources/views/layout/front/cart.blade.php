@if(isset($data) && !empty($data)) 
	<p class="block-subtitle">Recently added item(s)</p>
	@forelse($data as $key=>$data)
		@if($key<3)
		<ol id="cart-sidebar" class="mini-products-list clearfix">
			<li class="item clearfix">
				<div class="cart-content-top">
					<a href="{{url('productdetail').'/'.$data->access_url}}" class="product-image"><img src = http://localhost/testing/storage/app/public/images/products/{{$data->UPC}}/main.jpg?.rand()" width="278" height="355" alt=""></a>
					<div class="product-details">
						<?php 
							$user_id = Auth::user()['id']
						?>

						<p class="product-name"><a href="{{url('productdetail').'/'.$data->access_url}}">{{$data->name}}</a></p>
						<strong>{{$data->cart_quantity}}</strong> x <span class="price">₹{{$data->price}}</span>
						= <b>₹{{$data->total_amount}}</b>
					</div>
				</div>
				<div class="cart-content-bottom">
					<div class="clearfix"> <a href="#" title="Edit item" class="btn-edit"><i class="fa fa-pencil-square-o"></i></a> <a href="#" title="Remove" id="{{$data->id}}"  class="btn-remove btn-remove2 remove_cart"><i class="icon-close icons"></i></a></div>
				</div>
			</li>
		</ol>
		@endif
	@empty	
	@endforelse
	<p class="subtotal"> <span class="label">Subtotal:</span> <span class="price">
		{{$data->where('user_id',$user_id)->sum('Total_Amount')}}</span></p>
	<div class="actions"> <a href="{{url('viewcart')}}" class="view-cart"> View cart </a> <a href="{{url('billing')}}">Checkout</a></div>
@else
	No Product Available in the Cart
@endif