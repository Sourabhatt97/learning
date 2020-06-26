	@if(!empty($products))
<ul class="products-grid row products-grid--max-3-col last odd">
	@foreach($products as $product)
	<li class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-mobile-12 item">
		<div class="category-products-grid">
			<div class="images-container">
				<div class="product-hover" style="width:270px;height:290px;">
					<a href="{{url('productdetail').'/'.$product->access_url}}" title="{{$product->product_name}}" class="product-image">
						<img id="product-collection-image-8" class="img-responsive" src=http://localhost/testing/storage/app/public/images/products/{{$product->UPC}}/main.jpg?.rand()
						width= "180" height="150">

					</a>
				</div>
				<div class="actions-no hover-box">
					<div class="actions" >

						<button type="button" onclick="dosomething(this.value)" value="{{$product->id}}" id = "cart"  title="Add to Cart" class="button btn-cart pull-left">

							<span>
								<i class="icon-handbag icons"></i>
								<span>Add to Cart</span>
							</span>
						</button>
						
					</div>
				</div>
			</div>
			<div class="product-info products-textlink clearfix">
				<h2 class="product-name"><a href="{{url('productdetail').'/'.$product->access_url}}" title="{{$product->name}}">{{$product->name}}</a></h2>
				<ul class="configurable-swatch-list configurable-swatch-color clearfix">

				</ul>
				<div class="price-box"> <span class="regular-price"> <span class="price">₹{{$product->price}}.00 </span> </span></div>
			</div>
		</div>
	</li>
	@endforeach
</ul>
@else

Data not available!!

@endif