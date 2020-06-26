@extends('layout.admin.app')

@section('title')
Admin/Product/List
@stop

@section('content')

<!-- Start content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Products</h4>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                @include('layout.admin.alert')

                <div class="breadcrumb float-right">
                    <a href = "{{url('admin/product/add')}}"><button type = "submit" class = "btn btn-success"><i class = "fa fa-plus"> Add</i></button></a>

                    <a href = "{{url('admin/product/trash')}}"><button type = "submit" class = "btn btn-danger"><i class = "fa fa-trash"> Trash</i></button></a>
                </div>

                <div class="table-responsive">
                    <table id="datatable-editable" class="table table-striped m-b-0">

                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>UPC</th>
                                <th>Category</th>  
                                <th>Color</th>
                                <th>Ideal</th>  
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        @foreach($products as $key=>$product)
                        <thread>
                            <tr>
                                <td>{{$product->product_name}}</td>
                                <td><img src = http://localhost/testing/storage/app/public/images/products/{{$product->UPC}}/main.jpg?.rand() alt = "Image" height = "60" width = "50"></td>
                                <td>{{$product->UPC}}</td>
                                <td>{{$product->category_name}}</td>
                                <td>{{$product->color_name}}</td>
                                <td>{{$product->ideal_name}}</td>
                                <td>{{$product->product_price}}</td>
                                <td>{{$product->product_stock}}</td>
                                <td><input class="switch" type="checkbox" data-id="{{$product->product_id}}" data-plugin="switchery" data-color="#64b0f2"  data-size="small"
                                    @if($product->product_status == 'y')
                                    checked
                                    @endif
                                    />
                                </td>

                                <td>
                                    <a href="{{url('admin/product/delete').'/'.$product->product_id}}"><i class = "fa fa-trash"></i></a>

                                    &nbsp;&nbsp;

                                    <a href="{{url('admin/product/edit').'/'.$product->product_id}}"><i class = "fa fa-pencil"></i></a>
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

        $("#datatable-editable").on("change", ".switch",function(){
            var status = $(this).prop('checked') == true ? 'y' : 'n';
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{url('admin/product/switch')}}",
                data: {'id':id, 'status':status},
                success: function(res){
                    console.log(res)
                }
            });
        });

    });
    // $(document).ready(function(){

    // });
</script>
@endsection