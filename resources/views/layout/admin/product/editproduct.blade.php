@extends('layout.admin.app')

@section('head')


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style>
    #myform .error
    {
        color:red;
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

    .container {
        padding-top: 50px;
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
                    </table> 
    
                        Multiple Image<sup><font color="red">(optional)</font></sup>
                        <a href="javascript:void(0)" onclick="$('#abc').click()">Upload Image</a>
                        <input type="file" id="abc" name="photos[]" style="display: none;" multiple>
                        <div class="preview-images-zone">
                        </div>
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