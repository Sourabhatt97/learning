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
</style>

@stop
@section('content')

	<center><h1>All Orders</h1></center>

	<table>
		<tr>
			<th>Order Date</th>
			<th>Shipping Date</th>
			<th>Order Status</th>
			<th>Order View</th>
		</tr>

		@foreach($orders as $order)
			<tr>
				<td>{{$order->order_date}}</td>
				<td>{{$order->order_shipdate}}</td>
				<td>{{$order->order_status}}</td>
				<td>
					<a href = "{{url('/myorders/view').'/'.$order->order_id}}"><i class = "fa fa-eye"></i></button></a>
				</td>
			</tr>
		@endforeach
	</table>

</body>
</html>

@stop