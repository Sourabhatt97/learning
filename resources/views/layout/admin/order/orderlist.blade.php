@extends('layout.admin.app')

@section('title')
Admin/Order/List
@stop

@section('content')

<!-- Start content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Order</h4>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="table-responsive">
                    <table id="datatable-editable" class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Customer Name</th>   
                                <th>Status</th> 
                                <th>Order Date</th>
                                <th>View Order</th>  
                            </tr>
                        </thead>

                        @isset($products)
                         @foreach($products as $key=>$product)
                        <thread>
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$product->user_name}}</td>
                                <td>Status</td>
                                <td>{{$product->order_date}}</td>
                                <td>
                                    <a href = "{{url('admin/order/view').'/'.$product->order_id}}"><i class = "fa fa-eye"></i></button></a>
                                </td>
                            </tr>
                        </thread>
                        @endforeach
                        @endisset
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section("scripts")
<script type="text/javascript">
    $(function() {
        $('#datatable-editable').DataTable();
    });
    // $(document).ready(function(){

    // });
</script>
@endsection