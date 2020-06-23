@extends('layout.admin.app')

@section('title')
Admin/subcategory/Add
@stop

@section('head')
<style>
	input[type=number]::-webkit-inner-spin-button, 
	input[type=number]::-webkit-outer-spin-button { 
		-webkit-appearance: none; 
		margin: 0; 
	}
	#myform .error
	{
		color: red;
	}
</style>
@stop
@section('content')

<!-- Start content -->
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">Add subcategory</h4>
				<div class="breadcrumb float-right">
					<a href = "{{url('admin/category/show')}}"><button type = "submit" class = "btn btn-default"><i class = "fa fa-arrow-left"> Back</i></a></button>
				</div>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">

			<div class="card-box">
				
				@include('layout.admin.alert')
				
				<form class="form-horizontal" name = "myform" method = "POST" action = "{{url('admin/subcategory/insert')}}" id = "myform" role="form">
					@csrf
					<div class="form-group row">

						<div class="col-10">

							<b>Category<sup><font color = "red">*</font></sup></b> 
							<select name = "category_id" id = "category" class="form-control select2">
								<option value = ''>Select Category..</option>
								@foreach($categories as $category)
								<option value = "{{$category->id}}">{{$category->name}}</option>
								@endforeach
							</select><br>

							<input type="text" name="name" id = "abc" value = "{{old('subcategory')}}" placeholder="Add subcategory" class="form-control input-md">

						</div>						
					</div>
					
					<div>
						<input type = "submit" value = "Add" class="btn btn-success">
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

		$('#myform').validate({
			rules: {

				category_id:
				{
					required: true
				},

				name: {
					required: true,

					remote: {
						url: "http://localhost/testing/admin/subcategory/check",
						type: "GET",
						data: {
							name: function()
							{
								return $('#myform :input[name="name"]').val();
							}
						}
					}
				}
			},
			messages:
			{
				name: 
				{ 
					required:'You must have to add subcategory name before submit',
					remote:'This subcategory is already added try another one'
				}
			},
		});
	});
</script> 
@stop
