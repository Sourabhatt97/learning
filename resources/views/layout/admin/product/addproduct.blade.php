@extends('layout.admin.app')

@section('head')


<style>
	#myform .error
	{
		color: red;
	}

	.preview-images-zone {
		width: 100%;
		border: 1px solid #ddd;
		min-height: 180px;
		/* display: flex; */
		padding: 5px 5px 0px 5px;
		position: relative;
		overflow:auto;
	}
	.preview-images-zone > .preview-image:first-child {
		height: 185px;
		width: 185px;
		position: relative;
		margin-right: 5px;
	}
	.preview-images-zone > .preview-image {
		height: 90px;
		width: 90px;
		position: relative;
		margin-right: 5px;
		float: left;
		margin-bottom: 5px;
	}
	.preview-images-zone > .preview-image > .image-zone {
		width: 100%;
		height: 100%;
	}
	.preview-images-zone > .preview-image > .image-zone > img {
		width: 100%;
		height: 100%;
	}
	.preview-images-zone > .preview-image > .tools-edit-image {
		position: absolute;
		z-index: 100;
		color: #fff;
		bottom: 0;
		width: 100%;
		text-align: center;
		margin-bottom: 10px;
		display: none;
	}
	.preview-images-zone > .preview-image > .image-cancel {
		font-size: 18px;
		position: absolute;
		top: 0;
		right: 0;
		font-weight: bold;
		margin-right: 10px;
		cursor: pointer;
		display: none;
		z-index: 100;
	}
	.preview-image:hover > .image-zone {
		cursor: move;
		opacity: .5;
	}
	.preview-image:hover > .tools-edit-image,
	.preview-image:hover > .image-cancel {
		display: block;
	}
	.ui-sortable-helper {
		width: 90px !important;
		height: 90px !important;
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

						<b>Category<sup><font color = "red">*</font></sup></b> 
						<select name = "category_id" id = "category" class="form-control select2">
							<option value = ''>Select Category..</option>

							@foreach($categories as $category)
							<option value = "{{$category->id}}">{{$category->name}}</option>

							@if($category->children)
							@foreach($category->children as $child)
							<option value = "{{$child->id}}">--{{$child->name}}</option>

							@if($child->children)
							@foreach($child->children as $c)
							<option value = "{{$c->id}}">----{{$c->name}}</option>

							@if($c->children)
							@foreach($c->children as $c1)
							<option value = "{{$c1->id}}">------{{$c1->name}}</option>

							@if($c1->children)
							@foreach($c1->children as $c2)
							<option value = "{{$c2->id}}">--------{{$c2->name}}</option>

							@if($c1->children)
							@foreach($c2->children as $c3)
							<option value = "{{$c3->id}}">----------{{$c3->name}}</option>

							@if($c3->children)
							@foreach($c3->children as $c4)
							<option value = "{{$c4->id}}">------------{{$c4->name}}</option>
							@endforeach
							@endif
							@endforeach
							@endif
							@endforeach
							@endif
							@endforeach
							@endif
							@endforeach
							@endif
							@endforeach
							@endif
							@endforeach
						</select><br>


						<b>Color<sup><font color = "red">*</font></sup></b>
						<select name = "color_id" class="form-control select2">
							<option value = ''>Select Color..</option>
							@foreach($colors as $color)
							<option value = "{{$color->id}}">{{$color->name}}</option>
							@endforeach
						</select><br>

						<b>Price<sup><font color = "red">*</font></sup></b><input type="text" name="price" minlength = "1" maxlength="10" value = "{{old('price')}}" placeholder="Product Price" class="form-control input-md"><br>

						<b>Stock<sup><font color = "red">*</font></sup></b><input type="text" name="stock" minlength = "1" maxlength="10" value = "{{old('stock')}}" placeholder="Product Stock" class="form-control input-md"><br>

						<b>Description<sup><font color = "red">*</font></sup></b><textarea name="description" value = "{{old('description')}}" placeholder="Description about product" class="form-control input-md"></textarea><br>

						<b>UPC<sup><font color = "red">*</font></sup></b><input type="text" name="UPC" minlength = "11" maxlength="12" value = "{{old('UPC')}}" placeholder="UPC code" class="form-control input-md"><br>

						<b>Image<sup><font color = "red">*</font></sup></b><br>
						<input type = "file" id = "image" name = "image"><br>
						<br>

						Multiple Image<sup><font color="red">(optional)</font></sup>
						<a href="javascript:void(0)" onclick="$('#abc').click()">Upload Image</a>
						<input type="file" id="abc" name="images[]" style="display: none;" multiple>
						<div class="preview-images-zone">

						</div><br>

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

				color_id:
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

	$(document).ready(function() {
		document.getElementById('abc').addEventListener('change', readImage, false);

		$( ".preview-images-zone" ).sortable();

		$(document).on('click', '.image-cancel', function() {
			let no = $(this).data('no');
			$(".preview-image.preview-show-"+no).remove();
		});
	});



	var num = 4;
	function readImage() {
		if (window.File && window.FileList && window.FileReader) {
        var files = event.target.files; //FileList object
        var output = $(".preview-images-zone");

        for (let i = 0; i < files.length; i++) {
        	var file = files[i];
        	if (!file.type.match('image')) continue;

        	var picReader = new FileReader();

        	picReader.addEventListener('load', function (event) {
        		var picFile = event.target;
        		var html =  '<div class="preview-image preview-show-' + num + '">' +
        		'<div class="image-cancel" data-no="' + num + '">x</div>' +
        		'<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result + '"></div>' +
        		'<div class="tools-edit-image"><a href="javascript:void(0)" data-no="' + num + '" class="btn btn-light btn-edit-image">edit</a></div>' +
        		'</div>';

        		output.append(html);
        		num = num + 1;
        	});

        	picReader.readAsDataURL(file);
        }
    } 
}


</script> 
@stop