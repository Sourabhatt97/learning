@extends('layout.admin.app')

@section('title')
Admin/Category/Add
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
				<h4 class="page-title float-left">Add Category</h4>
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
				
				<form class="form-horizontal" name = "myform" method = "POST" action = "{{url('admin/category/insert')}}" id = "myform" role="form">
					@csrf
					<div class="form-group row">

						<div class="col-10">

							<b>Category<sup><font color = "red">*</font></sup></b> 
							<select name = "category_id" id = "category" class="form-control select2">
								<option value = ''>Select Category..</option>
								<option value = '0'>Main Category</option>

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

							<input type="text" name="name" id = "abc" value = "{{old('category')}}" placeholder="Add Category" class="form-control input-md">
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
						url: "http://localhost/testing/admin/category/check",
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
					required:'You must have to add category name before submit',
					remote:'This category is already added try another one'
				}
			},
		});
	});
</script> 
@stop
