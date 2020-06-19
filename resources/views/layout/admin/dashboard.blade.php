@extends('layout.admin.app')

@section('title')
Admin/Dashboard
@stop

@section('content')
<div class="col-lg-3 col-md-6">
	<div class="card-box widget-box-two widget-two-primary">
		<i class="mdi mdi-account-multiple widget-two-icon"></i>
		<div class="wigdet-two-content">
			<p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Users</p>
			<h2 class=""><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup">{{$users}}</span></h2>
			<p class="m-0">June 18 - {{$current_time}}</p>
		</div>
	</div>
</div><!-- end col -->
@stop

