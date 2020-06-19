@extends('layout.admin.app')

@section('title')
Admin/color/Edit
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
                <h4 class="page-title float-left">Edit color</h4>
                <div class="breadcrumb float-right">
                    <a href = "{{url('admin/color/show')}}"><button type = "submit" class = "btn btn-default"><i class = "fa fa-arrow-left"> Back</i></a></button>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="card-box">
                @include('layout.admin.alert')
                @foreach($editcolor as $color)
                <form action = "{{url('/admin/color/update') .'/'. $color->id}}" method = "POST" class="form-horizontal" id = "myform">
                    @csrf
                    <div class="form-group row">

                        <div class="col-10">
                            <input type="text" name="name" value = "{{$color->name}}"  class="form-control input-md">
                            <input type="text" hidden id="id" name = "id" value = "{{$color->id}}">
                        </div>

                        <div>
                            <input type = "submit" value = "Update" class="btn btn-primary">
                        </div>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>

@stop



@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function() {
            $('#success').fadeOut('fast');
        }, 5000);

        $('#myform').validate({
            rules: 
            {
                name: 
                {
                    required: true,

                    remote: 
                    {
                        url: "{{url('admin/color/checkedit')}}",
                        type: "GET",
                        data: 
                        {
                            id:function(){
                                if($('#id').length)
                                {
                                    return $('#id').val();
                                }
                                else
                                {
                                    return 'null';
                                }
                            }             
                        }
                    }
                }
            },
            
            messages:
            {
                name: 
                { 
                    required:'You must have to add color name before submit',
                    remote:'This color is already added try another one'
                }
            },
        });
    });
</script> 
@stop 