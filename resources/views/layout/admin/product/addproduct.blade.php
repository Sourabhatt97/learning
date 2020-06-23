@extends('layout.admin.app')

@section('head')

<style>
	#myform .error
	{
		color: red;
	}
</style>

@section('title')
Admin/Product/Add
@stop
@stop

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">Add Product</h4>
				<div class="breadcrumb float-right">
					<a href = "{{url('admin/product/show')}}"><button type = "submit" class = "btn btn-default"><i class = "fa fa-arrow-left"> Back</i></button></a>
				</div>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">

			<div class="card-box">

				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				
				@include('layout.admin.alert')

				<form class="form-horizontal" name = "myform" method = "POST" action = "{{url('admin/product/insert')}}" id = "myform" role="form" enctype="multipart/form-data">
					@csrf
					<div class="form-group row">
						<div class="col-6">
							<b>Product<sup><font color = "red">*</font></sup></b><input type="text" name="name" id = "name" minlength = "1" maxlength="100" value = "{{old('name')}}" placeholder="Product Name" class="form-control input-md">

							<label class="col-0 col-form-label" for="example-email"></label>
							<span>{{url('/')}}/<span class="access_url_span"></span><input type="text" name="access_url" class="" style="display: none;" id="access_url">
						</span>        
						<span>
							<a href="#" class="edit btn btn-action"><i class="fa fa-edit"></i></a>
						</span>
						<span>
							<a href="#" class="remove btn btn-action"style="display: none;"><i class="fa fa-remove"></i></a>
						</span><br>

						<b>Brand<sup><font color = "red">*</font></sup></b> 
						<select name = "brand_id" id = "brand" class="form-control select2">
							<option value = ''>Select Brand..</option>
							@foreach($brands as $brand)
							<option value = "{{$brand->id}}">{{$brand->name}}</option>
							@endforeach
						</select><br>

						<b>Category<sup><font color = "red">*</font></sup></b> 
						<select name = "category_id" id = "cat" class="form-control select2">
							<option value = ''>Select Category..</option>
							@foreach($categories as $category)
							<option value = "{{$category->id}}">{{$category->name}}</option>
							@endforeach
						</select><br>

						<b>Color<sup><font color = "red">*</font></sup></b>
						<select name = "color_id" class="form-control select2">
							<option value = ''>Select Color..</option>
							@foreach($colors as $color)
							<option value = "{{$color->id}}">{{$color->name}}</option>
							@endforeach
						</select><br>

						<b>Ideal<sup><font color = "red">*</font></sup></b>
						<select name = "ideal_id" class="form-control select2">
							<option value = ''>Select Ideal..</option>
							@foreach($ideals as $ideal)
							<option value = "{{$ideal->id}}">{{$ideal->name}}</option>
							@endforeach
						</select><br>

						<b>Price<sup><font color = "red">*</font></sup></b><input type="text" name="price" minlength = "1" maxlength="10" value = "{{old('price')}}" placeholder="Product Price" class="form-control input-md"><br>

						<b>Stock<sup><font color = "red">*</font></sup></b><input type="text" name="stock" minlength = "1" maxlength="10" value = "{{old('stock')}}" placeholder="Product Stock" class="form-control input-md"><br>

						<b>Description<sup><font color = "red">*</font></sup></b><textarea name="description" value = "{{old('description')}}" placeholder="Description about product" class="form-control input-md"></textarea><br>

						<b>UPC<sup><font color = "red">*</font></sup></b><input type="text" name="UPC" minlength = "11" maxlength="12" value = "{{old('UPC')}}" placeholder="UPC code" class="form-control input-md"><br>

						<b>Image<sup><font color = "red">*</font></sup></b><br>
						<input type = "file" id = "image" name = "image"><br>
						<br>

						<table class="table table-hover" id="dynamic_field">  
							<tr><strong>More Images <sup><font color = "Red">(Optional)</font></sup></strong>
								<td><input type="file" name="images[]" multiple="" class="form-control name_list" /></td>  
								<td><button type="button" name="add" id="add"  class="add">+</button></td>  
							</tr>  
						</table>

						<center>
							<button type = "submit" id = "submit" class = "btn btn-success  btn-block">ADD</button>
						</center>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>

@stop
@section('scripts')

<script type="text/javascript">

	$(document).ready(function(){
		var i=1;  
		$(document).on('click', '.add', function(){  
			i++;  
			$('#dynamic_field').append('<tr id="row'+i+'"><td><input type="file" name="images[]" multiple class="form-control name_list" /></td>'+'<td><button type="button" name="add" class="add">+</button>'
				+'<td><button type="button" name="remove" id="'+i+'" class=" btn_remove">-</button></td></tr>');   
		}); 

		$(document).on('click', '.btn_remove', function(){  
			var button_id = $(this).attr("id");  
			$('#row'+button_id+'').remove();  
		});  
	}); 

	setTimeout(function() {
		$('#success').fadeOut('fast');
	}, 5000);

	$(document).ready(function () {

		var error = $('#myform').validate({
			rules:
			{
				name: 
				{
					required: true,

					remote: 
					{
						url: "http://localhost/testing/admin/product/checkproduct",
						type: "GET",
						data: {
							name: function()
							{
								return $('#myform :input[name="name"]').val();
							}
						}
					}
				},

				category_id:
				{
					required: true
				},

				subcategory_id:
				{
					required: true
				},

				ideal_id:
				{
					required: true
				},

				brand_id:
				{
					required: true
				},

				color_id:
				{
					required: true
				},

				price:
				{
					required: true,
					minlength: 1,
					maxlength: 10,
					number: true
				},

				stock:
				{
					required: true,
					digits: true,
					minlength: 1,
					maxlength: 10.
				},
				
				description:
				{
					required: true
				},

				UPC:
				{
					required: true,
					digits: true,
					minlength: 11,
					maxlength: 12,
					remote: 
					{
						url: "http://localhost/testing/admin/product/checkupc",
						type: "GET",
						data: {
							UPC: function()
							{
								return $('#myform :input[name="UPC"]').val();
							}
						}
					}
				},

				image:
				{
					required: true,
					accept: "image/*"
				},

				"images[]":
				{
					accept: "image/*"
				},

				access_url:
				{
					required: true
				}
			},
			messages:
			{
				name: 
				{ 
					required:'You must have to add product name before submit',
					remote: 'This product is already added'
				},

				category_id:
				{
					required: 'Please select category'
				},

				ideal_id:
				{
					required: 'Please select Ideal'
				},

				color_id:
				{
					required: 'Please select color'
				},

				brand_id:
				{
					required: 'Please select color'
				},

				price:
				{
					required: 'You must have to add product price before submit'
				},

				stock:
				{
					required: 'You must have to add product stock before submit'
				},

				description:
				{
					required: 'Please write description about Product'
				},

				UPC:
				{
					required: 'You must have to add product upc code before submit',
					remote: 'This UPC is already used'
				},

				image:
				{
					required: 'Include Product Image',
					accept: 'PLease include image with png, jpg or jpeg format only'
				},

				"images[]":
				{
					accept: 'PLease include image with png, jpg or jpeg format only'
				},

				access_url:
				{
					required: 'Url is required'
				}
			},
		});
	});

	$("#name").keyup(function(){
		var str=$(this).val();

		var access_url_span=str.trim().replace(/[^a-z0-9]/gi,'-').replace(/-+/g,'-').replace(/^-|-$/g,'');
		$('.access_url_span').text(access_url_span.toLowerCase())
		$('input[name="access_url"]').val ($('.access_url_span').text())
	})
	
	$(document).on('click','.edit',function(){
		$('#access_url').val($('.access_url_span').text()).show();
		$('.edit').hide();
		$('.access_url_span').hide();
		$('.remove').show();

	});
	$('.remove').on('click',function(){
		$('.remove').hide();
		$('.edit').show();
		$('.access_url_span').show();
		$('#access_url').hide();
		$('.access_url_span').text($('#access_url').val());
		$('input[name="access_url"]').val ($('.access_url_span').text())
	});
</script> 
@stop