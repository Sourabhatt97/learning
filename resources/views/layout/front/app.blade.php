<!DOCTYPE html>
<html>
<head>
	<title>
		@yield('title')
	</title>

	@include('layout.front.common.head')

	@yield('head')
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