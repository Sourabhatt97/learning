@extends('layout.admin.app')

@section('title')
Admin/trashproduct/Trash
@stop

@section('content')

<!-- Start content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Product/Trash</h4>
                <div class="breadcrumb float-right">
                    <a href = "{{url('admin/product/show')}}"><button type = "submit" class = "btn btn-default"><i class = "fa fa-arrow-left"> Back</i></button></a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                @include('layout.admin.alert')
                <div class="table-responsive">
                    <table id="datatable-editable" class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>UPC</th>
                                <th>Category</th>   
                                <th>Color</th>
                                <th>Brand</th>   
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        @foreach($trashproducts as $trashproduct)
                         <thread>
                            <tr>
                                <td>{{$trashproduct->product_name}}</td>
                                <td><img src = http://localhost/testing/storage/app/public/images/products/{{$trashproduct->UPC}}/main.jpg?.rand() alt = "Image" height = "60" width = "50"></td>
                                <td>{{$trashproduct->UPC}}</td>
                                <td>{{$trashproduct->category_name}}</td>
                                <td>{{$trashproduct->color_name}}</td>
                                <td>{{$trashproduct->brand_name}}</td>
                                <td>{{$trashproduct->product_price}}</td>
                                <td>{{$trashproduct->product_stock}}</td>
                                <td>
                                    <a href="{{url('admin/product/restore').'/'. $trashproduct->id}}"><input type = "submit" value = "Restore" class="btn btn-warning"></a>
                                </td>   
                            </tr>
                        </thread>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section("scripts")
<script type="text/javascript">
    setTimeout(function() {
        $('#success').fadeOut('fast');
    }, 5000);

    $(function() {
        $('#datatable-editable').DataTable();
    });
</script>
@stop