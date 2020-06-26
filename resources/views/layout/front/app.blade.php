<!DOCTYPE html>
<html>
<head>
	<title>
		@yield('title')
	</title>

	@include('layout.front.common.head')

	@yield('head')
	<script type="text/javascript">
		$(document).on('mouseover', '#small_cart', function(){
			$.ajax({
				type: "GET",
				url: "{{url('get_mini_cart')}}",
				success:function(res)
				{
					$('.mini_cart').html(res);          
				}
			});
		});

		$(document).on('click', '.remove_cart',function(){
			var id = $(this).attr('id');
			
			$.ajax({
				type: "GET",
				url: "{{url('remove_mini_cart')}}",
				data: {'id':id},
				success:function(res)
				{
					$('.mini_cart').html(res);          
				}
			});
		});
	</script>
</head>
<body>
	@include('layout.front.common.header')

	<div class="wrapper">
		<div class="page">
			@yield('content')
		</div>
		@include('layout.front.common.footer')
	</div>

	@include('layout.front.common.js')

	@yield('scripts')
</body>
</html>