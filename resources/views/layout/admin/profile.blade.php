@extends('layout.admin.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">Profile</h4>

				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item active">Profile</li>
				</ol>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- end row -->


	<div class="row">
		<div class="col-sm-12">
			<div class="profile-bg-picture" style="background-image">
				<span class="picture-bg-overlay"><img src = "{{url('resources/assets/admin/images/bg-profile.jpg')}}"></span><!-- overlay -->
			</div>
			<!-- meta -->
			<div class="profile-user-box">
				<div class="row">
					<div class="col-sm-6">
						<?php
							$image = Auth::user()->image;
						?>
						<span class="pull-left m-r-15"><img src="{{url('storage/app/'.$image)}}"  alt="" class="thumb-lg rounded-circle"></span>
						<div class="media-body">
							<h4 class="m-t-5 m-b-5 font-18 ellipsis">Name:- {{Auth::user()->name}}</h4>
							<p class="text-muted m-b-0"><strong>Username:- {{Auth::user()->username}}</strong></p>
							<p class="text-muted m-b-0"><strong>Email:- {{Auth::user()->email}}</strong></p>
							<p class="text-muted m-b-0"><strong>Phone:- {{Auth::user()->phone}}</strong></p>
							<p class="text-muted m-b-0"><strong>Admin</strong></p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="text-right">
							<button type="button" class="btn btn-success waves-effect waves-light">
								<i class="mdi mdi-account-settings-variant m-r-5"></i> Edit Profile
							</button>
						</div>
					</div>
				</div>
			</div>
			<!--/ meta -->
		</div>
	</div>
</div>
<!-- end row -->
@stop