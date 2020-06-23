@extends('layout.admin.app')

@section('head')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">Profile</h4>

				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item active">Admin Profile</li>
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
				@include('layout.admin.alert')
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
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Edit Profile</button>
						</div>
					</div>
				</div>
			</div>
			<!--/ meta -->
		</div>
	</div>
</div>

<div class="container">
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<form id="myform" action="{{url('/admin/editprofile')}}" method="post">
						@csrf

						<!--Name -->
						<div class="form-group row">
							<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

							<div class="col-md-6">
								<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{Auth::user()->name}}">

								@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						
						<div class="form-group row">
							<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{Auth::user()->email}}">
							</div>
						</div>

						<div class="form-group row">
							<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

							<div class="col-md-6">
								<input id="username" type="text" class="form-control @error('name') is-invalid @enderror" name="username" value="{{Auth::user()->username}}">
							</div>
						</div>

						<div class="form-group row">
							<label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

							<div class="col-md-6">
								<input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{Auth::user()->phone}}">
							</div>
						</div>

						<div class="modal-footer">
							<input type="submit" class="btn btn-primary" value="submit">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	setTimeout(function() {
		$('#success').fadeOut('fast');
	}, 5000);

    $(document).ready(function(){
        $("#myform").validate({
            rules: 
            {
                name:
                {
                    required: true
                },
                
                email:
                {
                    required: true,
                    email: true,
                    remote:
                    {
                        url: "http://localhost/testing/admin/checkemail",
                        type: "GET",
                        data:
                        {
                            email: function()
                            {
                                return $('#myform :input[name = "email"]').val();
                            }
                        }
                    }
                },

                username:
                {
                    required: true,
                    remote:
                    {
                        url: "http://localhost/testing/admin/checkusername",
                        type: "GET",
                        data:
                        {
                            username: function()
                            {
                                return $('#myform :input[name = "username"]').val();
                            }
                        }
                    }
                },

                phone:
                {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10,

                    remote:
                    {
                        url: "http://localhost/testing/admin/checkphone",
                        type: "GET",
                        data:
                        {
                            phone: function()
                            {
                                return $('#myform :input[name = "phone"]').val();
                            }
                        }
                    }
                },
            },
            messages:
            {
                name:
                {
                  required: 'Please provide your name',  
                }, 

                email:
                {
                    required: 'Enter provide your email address',
                    email: 'Please provide valid email address example:- john@gmail.com',
                    remote:'Sorry this email is already used please use another one'                    
                },

                username:
                {
                    required: 'Enter provide your username',
                    remote:'Sorry this username is already taken please use another one'                    
                },
                phone:
                {
                    required: 'Please provide your phone number',
                    remote:'Sorry this phone number is already taken please use another one'                    
                },
            },
        });
    });
</script>   
@stop