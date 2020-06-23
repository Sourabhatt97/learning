@extends('layout.admin.app')

@section('head')

<style>
    #myform .error
    {
        color:red;
    }
</style>

@section('title')
Admin/Product/Edit
@stop
@stop

@section('content')

<!-- Start content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Edit Product</h4>
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
                @include('layout.admin.alert')

                @foreach($products as $product)
                <form action = "{{url('/admin/product/update') .'/'. $product->id}}" name = "myform" method = "POST" class="form-horizontal" id = "myform" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">

                        <div class="col-6">
                            <b>Product:-</b><input type="text" name="name" id = "name" value = "{{$product->name}}"  class="form-control input-md">
                            <input type="text" hidden id = "id" name = "id" value = "{{$product->id}}">

                            <span>{{url('/'.$product->access_url)}}/<span {{$product->access_url}} class="access_url_span"></span><input type="text" name="access_url" value = "{{$product->access_url}}" class="" style="display: none;" id="access_url">
                        </span>        

                        <span>
                            <a href="#" class="edit btn btn-action"><i class="fa fa-edit"></i></a>
                        </span>

                        <span>
                            <a href="#" class="remove btn btn-action"style="display: none;"><i class="fa fa-remove"></i></a>
                        </span><br>

                        <b>Price:-</b><input type="text" name="price" minlength = "1" maxlength="10" value = "{{$product->price}}"  class="form-control input-md">
                        <input type="text" hidden name = "id" value = "{{$product->id}}">
                        <br>

                        <b>Category:-</b>
                        <span class="form-control">
                            {{$categories[0]->name}}
                        </span> 
                        <br>
                        
                        

                        <b>Color</b>
                        <span class="form-control">
                            {{$colors[0]->name}}
                        </span> 
                        
                        <br>

                        <b>Brand</b>
                        <span class="form-control">
                            {{$brands[0]->name}}
                        </span> 

                        <b>Ideal</b>
                        <span class="form-control">
                            {{$ideals[0]->name}}
                        </span> 

                        <b>Description:-</b><textarea name="description"  class="form-control input-md">{{$product->description}}</textarea><br>

                        <b>Stock:-</b><input type="text" name="stock" value = "{{$product->stock}}"  class="form-control input-md">
                        <input type="text" hidden name = "id"  value = "{{$product->id}}">
                        <br>
                        <b>UPC:-</b> 
                        <span class="form-control">
                            <input type = "text" hidden name = "upc" value = "{{$product->UPC}}"/>{{$product->UPC}}
                        </span> 
                        <br><br>

                        <divshow class = "editimage">
                         <input type = "file" name = "image" id = "image"><br>
                         <br>
                         <img src = http://localhost/testing/storage/app/public/images/products/{{$product->UPC}}/main.jpg?.rand() alt = "Image" height = "100" width = "90">
                     </div>

                     <table class="table table-hover" id="dynamic_field">  
                        @foreach($images as $i)

                        <tr>
                            <td><input type="file" name = "images[]" value = "{{$i->image}}" class="form-control name_list"></td>

                            <td><input type = "text" hidden name = "imageid[]" value = "{{$i->id}}"></td>

                            <td><img src = http://localhost/testing/storage/app/{{$i->image}}?.rand() alt = "Image" height = "50" width = "45"></td>

                            <td><input type = "checkbox" name = "deleteimage[]" value = "{{$i->id}}">  Delete</td>
                        </tr><br>      
                        @endforeach

                        <tr>
                            <td><input type="file" name="photos[]" multiple="" class="form-control name_list" /></td> 
                            
                            <td><button type="button" name="add" id="add"  class="add">Add More Images</button></td> 
                        </tr>  

                    </table>
                    <div>
                        <input type = "submit" value = "Update" class="btn btn-primary btn-block">
                    </div>
                </div>
            </div>
        </form>
        @endforeach
    </div>
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
         $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="file" name="photos[]" multiple class="form-control name_list" /></td>'+'<td><button type="button" name="add" class="add">+</button>'
            +'<td><button type="button" name="remove" id="'+i+'" class=" btn_remove">-</button></td></tr>');   
     }); 

      $(document).on('click', '.btn_remove', function(){  
         var button_id = $(this).attr("id");  
         $('#row'+button_id+'').remove();  
     });  
  }); 

    $(document).ready(function () {
        setTimeout(function() {
            $('#success').fadeOut('fast');
        }, 5000)

        var error = $('#myform').validate({
            rules: 
            {
                name: 
                {
                    required: true,

                    remote: 
                    {
                        url: "{{url('admin/product/checkeditname')}}",
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
                },

                price:
                {
                    required: true,
                    digits: true,
                    minlength: 1,
                    maxlength: 10            
                },

                stock:
                {
                    required: true,
                    digits: true
                },

                description:
                {
                    required: true,
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

                price:
                {
                    required: 'You must have to add price'
                },

                stock:
                {
                    required: 'You must have to add quantity'
                },

                description:
                {
                    required: 'Please provide description about this Product'
                },

                "images[]":
                {
                    accept: 'Please include image with png, jpg or jpeg format only'
                },

                access_url:
                {
                    required: 'URL is required'
                }
            },
        });
    });

    $("#name").keyup(function(){
        var str=$(this).val();
        /*var trims=$.trim(str);*/
        var access_url_span=str.trim().replace(/[^a-z0-9]/gi,'-').replace(/-+/g,'-').replace(/^-|-$/g,'');
        $('.access_url_span').text(access_url_span.toLowerCase())
        $('input[name="access_url"]').val ($('.access_url_span').text())
    })
    $(document).on('input','#access_url',function(event){
        /*onsole.log("here");*/
        console.log($(this).val());
        var str=$(this).val().toLowerCase().replace(/[\s]+/gi,'-').replace(/[\s]?[^a-z0-9-]/gi,'').replace(/[-]+/g,'-');
        $(this).val(str);

    });
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