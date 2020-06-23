@extends('layout.admin.app')

@section('title')
Admin/subcategory/Edit
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
                <h4 class="page-title float-left">Edit subcategory</h4>
                <div class="breadcrumb float-right">
                    <a href = "{{url('admin/subcategory/show')}}"><button type = "submit" class = "btn btn-default"><i class = "fa fa-arrow-left"> Back</i></a></button>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="card-box">
                @include('layout.admin.alert')
                @foreach($editsubcategory as $subcategory)
                <form action = "{{url('/admin/subcategory/update') .'/'. $subcategory->id}}" method = "POST" class="form-horizontal" id = "myform">
                    @csrf
                    <div class="form-group row">

                        <div class="col-10">
                            <b>Category</b>
                            <span class="form-control">
                                {{$subcategory->category_name}}
                            </span> <br>

                          <b>Subcategory:-<br>  <input type="text" name="name" value = "{{$subcategory->name}}"  class="form-control input-md">
                            <input type="text" hidden id="id" name = "id" value = "{{$subcategory->id}}">
                        </div>

                    </div>
                    <div>
                        <input type = "submit" value = "Update" class="btn btn-primary">
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
                        url: "{{url('admin/subcategory/checkedit')}}",
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
                    required:'You must have to add subcategory name before submit',
                    remote:'This subcategory is already added try another one'
                }
            },
        });
    });
</script> 
@stop 