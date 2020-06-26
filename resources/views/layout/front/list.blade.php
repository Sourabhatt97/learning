@foreach($products as $product)
<ol class="products-list" id="products-list">
	<li class="item odd">
		<div class="row">
			<div class="col-mobile-12 col-xs-5 col-md-4 col-sm-4 col-lg-4">
				<div class="products-list-container">
					<div class="images-container">
						<div class="product-hover">
							<a href="{{url('productdetail').'/'.$product->access_url}}" title="" class="product-image">
								<img id="product-collection-image-8" class="img-responsive" src = http://localhost/testing/storage/app/public/images/products/{{$product->UPC}}/main.jpg?.rand() width="100" height="100" alt=""> 
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="product-shop col-mobile-12 col-xs-7 col-md-8 col-sm-8 col-lg-8">
				<div class="f-fix">
					<div class="product-primary products-textlink clearfix">
						<h2 class="product-name"><a href="{{url('productdetail').'/'.$product->access_url}}" title="Configurable Product">{{$product->name}}</a></h2>

						<div class="price-box"> <span class="regular-price"> <span class="price">₹{{$product->price}}</span> </span></div>
						<ul class="configurable-swatch-list configurable-swatch-color clearfix">
							<li class="option-blue is-media"> <a href="javascript:void(0)" name="blue" class="swatch-link swatch-link-92 has-image" title="blue"> <span class="swatch-label">  </span> </a></li>
							<li class="option-red is-media"> <a href="javascript:void(0)" name="red" class="swatch-link swatch-link-92 has-image" title="red"> <span class="swatch-label"> </span> </a></li>
						</ul>
					</div>
					<div class="product-secondary actions-no actions-list clearfix">
						<p class="action"><button type="button" onclick="dosomething(this.value)" value="{{$product->id}}" id = "cart" title="Add to Cart" class="button btn-cart pull-left" ><span><i class="icon-handbag icons abc"></i><span>Add to Cart</span></span></button></p>
					</div>
				</div>
			</div>
		</div>
	</li>
</ol><!--- .products-list-->
@endforeach