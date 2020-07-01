@extends('layout.admin.app')

@section('title')
Admin/Order/View
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
                    
                <?php
                    use App\OrderDetail;
                    $order_id = $orders[0]->order_id;
                    $total_amount = OrderDetail::where('order_id',$order_id)->sum('total_amount');

                    $bill_id = $address[0]->id;
                ?>

               <div class="breadcrumb float-right shipping address">
                    <a href="{{url('admin/order/printinvoicepdf/'.$order_id.'/'.$bill_id)}}"><button class="btn btn-primary">Print Invoice</button></a>
                    <H3>Total Payment:- Rs. {{$total_amount}}</H3><br>
                </div>

                <div class = "billing address">
                    <H4><b>Billing Address</b></H4>
                    @foreach($address as $address)
                    Name:- {{$address->bill_name}}<br>
                    Email:- {{$address->email}}<br>
                    Country:- {{$address->country}}<br>
                    State:- {{$address->state}}<br>
                    City:- {{$address->city}}<br>
                    Address:- {{$address->address}}<br>
                    Zip Code:- {{$address->zip_code}}
                    @endforeach
                </div>

                <div class="table-responsive">
                    <table id="datatable-editable" class="table table-striped m-b-0">

                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Total Quantity</th>  
                                <th>Price</th> 
                                <th>Total Amount</th>   
                            </tr>
                        </thead>

                        <br>
                        <b>Status<sup><font color = "red"></font></sup></b>
                        <div class="form-group row">
                            <div class="col-2">
                                <select id = "status" name = "status" class="form-control select2">
                                    <option value = "Select Status">{{$orders[0]->order_status}}</option>
                                    <option value = "Pending">Pending</option>
                                    <option value = "Dispatched">Dispatched</option>
                                    <option value = "Cancel">Cancel</option>
                                </select><br>
                            </div>
                        </div>

                        @foreach($orders as $key=>$order)
                        <thread>
                            <tr>
                                @foreach($users as $user)
                                <td>{{$user->name}}</td>
                                @endforeach
                                <input id = "id" type="hidden" value="{{$order->order_id}}"/>
                                <td>{{$order->product_name}}</td>
                                <td><img src = http://localhost/testing/storage/app/public/images/products/{{$order->UPC}}/main.jpg?.rand() alt = "Image" height = "60" width = "50"></td>
                                <td>{{$order->quantity}}</td>
                                <td>{{$order->product_price}}</td>
                                <td>{{$order->total_amount}}</td>  
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
    $(function() {
        $('#datatable-editable').DataTable();

    });

    $(document).on('change','#status', function(){
        var status = $('#status').val();
        var order_id = $('#id').val();

        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{url('admin/order/status')}}",
            data: {'status':status,'order_id':order_id},
            success: function(res){
                console.log(res)
            }
        });
    });
</script>
@endsection