@extends('layouts.app')
@section('head')
<meta http-equiv="Content-Type" content="text/html; charset=Western (ISO-8895-1)" />
<link rel="stylesheet" type="text/css" href="css/frontend.css">
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>

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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registration') }}</div>

                <div class="card-body">
                    <form method="POST" id = "myform" enctype="multipart/form-data" action="{{url('register') }}">
                        @csrf
                        @if(isset($data))
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data->name}}">

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $data->email }}">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        @else

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('name') is-invalid @enderror" name="username" value="{{ old('username') }}">

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        @endisset


                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>

                            <div class="col-md-6">
                                <input id="age" type="age" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}">

                                @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-6 col-form-label text-md-right"><center>{{ __('Gender :-') }}</center></label>  
                           <div class="col-md-6">
                            <input type = "radio" name = "gender" value = "Male" Checked> Male<br>
                            <input type = "radio" name = "gender" value = "Female"> Female<br>
                            <input type = "radio" name = "gender" value = "Other"> Other<br>                            

                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <input id="Image" type="file" class="form-control" name="image">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
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
                        url: "http://localhost/testing/register/checkemail",
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
                        url: "http://localhost/testing/register/checkusername",
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
                        url: "http://localhost/testing/register/checkphone",
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
                password:
                {
                    required: true,
                    minlength: 8
                },
                password_confirmation:
                {
                    required: true,
                    equalTo: "#password"
                },

                image:
                {
                    required: true,
                    accept: "jpg|jpeg|png|JPG|JPEG|PNG"
                },

                age:
                {
                    required: true,
                    digits: true,
                    range: [10,100]
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

                image:
                {
                    required: 'Please provide your picture',
                    accept: 'Please include image with png, jpg or jpeg format only'
                },

                phone:
                {
                    required: 'Please provide your phone number',
                    remote:'Sorry this phone number is already taken please use another one'                    
                },

                age:
                {
                    required: 'Please provide your age',
                    range: 'Age must be between 10 to 100 years'
                },
                password: 'Please provide password of atleast 8 character',
                password_confirmation: 'Value in the password and confirm password field must be same',
            },
        });
    });
</script>   
@stop