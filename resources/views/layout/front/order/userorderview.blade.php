@extends('layout.front.app')

@section('head')

<style>
	table 
	{
		font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	td, th 
	{
		border: 1px solid #dddddd;
		text-align: left;
		padding: 8px;
	}

	tr:nth-child(even) 
	{
		background-color: #dddddd;
	}

	.total
	{
		float: right;

	}
</style>

@stop
@section('content')

	<center><h1>Order</h1></center>

	<?php
		use App\OrderDetail;
		$order_id = $orders[0]->order_id;
		$total_amount = OrderDetail::where('order_id',$order_id)->sum('total_amount');
	?>

	<div class="total">
		<H1>Total Amount:- {{$total_amount}}</H1>
	</div>

	<h1>Order Status:-
		<select id = "status" name = "status">
			<option value = "Select Status">{{$orders[0]->order_status}}</option>
			<option value = "Cancel">Cancel</option>
		</select><br><br>
	</h1>

	<table>
		<tr>
			<th>Product Name</th>
			<th>Image</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Total Amount</th>
		</tr>

		@foreach($orders as $order)
		<tr>
			<input id = "id" type="hidden" value="{{$order->order_id}}"/>
			<td>{{$order->product_name}}</td>
			<td>
				<img src = http://localhost/testing/storage/app/public/images/products/{{$order->UPC}}/main.jpg?.rand() alt = "Image" height = "60" width = "50">
			</td>
			<td>{{$order->quantity}}</td>
			<td>{{$order->price}}</td>
			<td>{{$order->total_amount}}</td>
		</tr>
		@endforeach
	</table>

</body>
</html>

@stop

@section('scripts')
<script type="text/javascript">
    $(document).on('change','#status', function(){
        var status = $('#status').val();
        var order_id = $('#id').val();

        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{url('/myorders/status')}}",
            data: {'status':status,'order_id':order_id},
            success: function(res){
                console.log(res)
            }
        });
    });
</script>
@stop