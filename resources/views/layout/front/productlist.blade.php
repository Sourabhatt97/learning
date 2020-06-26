@extends('layout.front.app')

@section('title')
Laptops
@stop
@section('content')

<div class="main-container col2-left-layout ">
	<div class="container">
		<div class="main">
			<div class="row">
				<div class="col-left sidebar col-lg-3 col-md-3 left-color color">
					<div class="anav-container">
						<br><br><dt class="even">By Price</dt>
						<dd class="even">
							<div class="slider-ui-wrap">
								<div id="price-range" class="slider-ui" slider-min="1" slider-max="99999" slider-min-start="1" slider-max-start="99999"></div>
							</div>
							<form action="#" class="price-range-form">
								<input type="text" name="start" class="range_value range_value_min " id="min"  target="#price-range" /> -
								<input type="text" name="end" class="range_value range_value_max" id="max" target="#price-range" />
								<input type="button" class="btn-submit" value="OK" />
							</form>
						</dd>


						<div class="block block-anav">
							<br><h1><b>Categories</b></h1>
							<ul style="" class="nav-accordion">
								@foreach($categories as $category)
								<form action = "{{url('laptop')}}" method = "POST">
									<label>
										<input type = "checkbox" class = "cat" name = "category" id = "cat" value = "{{$category->id}}"> {{$category->name}}
									</label><br><br>
								</form>
								@endforeach
							</ul>
						</div><!--- .block-anav-->
					</div><!--- .anav-container-->
					<div class="block block-layered-nav block-layered-nav--no-filters">
						<div class="block-title"> <strong><span>Shop By</span></strong></div>
						<div class="block-content toggle-content">
							<p class="block-subtitle block-subtitle--filter">Filter</p>
							<dl id="narrow-by-list">

								<div class="anav-container">
									<h1><b>Colors</b></h1>
									<ul style="" class="nav-accordion">
										@foreach($colors as $color)
										<label>
											<input type = "checkbox" name = "color" id = "col" value = "{{$color->id}}">  {{$color->name}}
										</label><br><br>
										@endforeach
									</ul>
								</div><!--- .anav-container-->
							</dl>
						</div>
					</div><!--- .block-layered-nav-->
				</div><!--- .sidebar-->
				<div class="col-main col-lg-9 col-md-9 content-color color">
					<div class="page-title category-title">
						<div class="category-products">
							<div class="toolbar">
								<div class="sorter view">
									<p class="view-mode"> <label>View as:</label> <a data-href="grid.html" title="Grid" class="redirects grid" id = "grid"> <i class="icon-grid icons"></i> </a> <a href="javascript:void(0)" title="List" class="active list" id = "list"> <i class="icon-list icons"></i> </a></p>
									<div class="sort-by">
										<label>Sort By</label> 
										<select  id="dropdownList">
											<option value="position" selected="selected"> High to Low</option>
											<option value="low"> Low to High</option>
										</select>
									</div>
								</div>
							</div><!--- .toolbar-->
							<div id="products">
								@include('layout.front.list')
							</div>
						</div><!--- .category-products-->	
					</div><!--- .col-main-->
				</div><!--- .row-->
			</div><!--- .main-->
		</div><!--- .container-->
	</div><!-- .block_bottom -->
</div><!--- .main-container -->
@stop

@section("scripts")

<script type="text/javascript">
	/*$(document).ready(function() {
		
	});
	*/

	$('.btn-submit').on('click', function(){
		get_data();
	});

	$(document).on('click','.grid',function(){
		$(this).addClass('active');
		$('.list').removeClass('active');
		get_data();
	});

	$(document).on('click','.list',function(){
		$(this).addClass('active');
		$('.grid').removeClass('active');
		get_data();
	});

	$('input[type = "checkbox"]').click(function() {
		get_data();
	});

	$('#dropdownList').on('click',function(){
		get_data();
	});

	function get_data(){
		var category = [];
		$.each($("input[name='category']:checked"), function() {
			category.push($(this).val());
		});

		var color = [];
		$.each($("input[name='color']:checked"), function() {
			color.push($(this).val());
		});

		var brand = [];
		$.each($("input[name='brand']:checked"), function() {
			brand.push($(this).val());
		});

		var ideal = [];
		$.each($("input[name='ideal']:checked"), function() {
			ideal.push($(this).val());
		});

		var optionText = $("#dropdownList option:selected").text();

		var ListType = $('.view').find('.active').attr('id');
		
		var start = $('#min').val();
		var end = $('#max').val();

		$.ajax({
			type: "GET",
			url: "{{url('watchfilter')}}",
			data: {'category':category, 'color':color, 'brand':brand, 'ideal':ideal, 'option':optionText,'ListType':ListType,'start':start,'end':end},
			
			success:function(res)
			{
				$('#products').html(res);          
			}
		});
	}

	$(document).on('click', '#cart',function(){
		var cart = $(this).attr('value');

		$.ajax({
			type: "GET",
			url: "{{url('addcart')}}",
			data: {'cart':cart,'quan':1},
			success:function(res)
			{
				$('.mini_cart').html(res);          
			}
		});

		alert("Product added successfully");
	});

	$(function() {
		$("input[name='start']").on('input', function(e) {
			$(this).val($(this).val().replace(/[^0-9]/g, ''));
		});
		$("input[name='end']").on('input', function(e) {
			$(this).val($(this).val().replace(/[^0-9]/g, ''));
		});
	});
</script>
@stop