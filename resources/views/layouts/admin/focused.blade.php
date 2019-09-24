<!DOCTYPE html>
<html lang="en">
<head>
	<title>RentCubo</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/png" href="{{asset('favicon.png')}}"/>

	<link rel="stylesheet" type="text/css" href="{{asset('admin-assets/focused/vendor/bootstrap/css/bootstrap.min.css')}}">

	<link rel="stylesheet" type="text/css" href="{{asset('admin-assets/focused/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">

	<link rel="stylesheet" type="text/css" href="{{asset('admin-assets/focused/fonts/iconic/css/material-design-iconic-font.min.css')}}">

	<link rel="stylesheet" type="text/css" href="{{asset('admin-assets/focused/vendor/animate/animate.css')}}">	

	<link rel="stylesheet" type="text/css" href="{{asset('admin-assets/focused/vendor/css-hamburgers/hamburgers.min.css')}}">

	<link rel="stylesheet" type="text/css" href="{{asset('admin-assets/focused/vendor/animsition/css/animsition.min.css')}}">

	<link rel="stylesheet" type="text/css" href="{{asset('admin-assets/focused/vendor/select2/select2.min.css')}}">	

	<link rel="stylesheet" type="text/css" href="{{asset('admin-assets/focused/vendor/daterangepicker/daterangepicker.css')}}">

	<link rel="stylesheet" type="text/css" href="{{asset('admin-assets/focused/css/util.css')}}">

	<link rel="stylesheet" type="text/css" href="{{asset('admin-assets/focused/css/main.css')}}">
</head>

<body>
	
	@include('notifications.notification')
	<div class="limiter">
		<div class="container-login100">
			@yield('content')
		</div>

	</div>
	
	<script src="{{asset('admin-assets/focused/vendor/jquery/jquery-3.2.1.min.js')}}"></script>

	<script src="{{asset('admin-assets/focused/vendor/animsition/js/animsition.min.js')}}"></script>

	<script src="{{asset('admin-assets/focused/vendor/bootstrap/js/popper.js')}}"></script>

	<script src="{{asset('admin-assets/focused/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

	<script src="{{asset('admin-assets/focused/vendor/select2/select2.min.js')}}"></script>

	<script src="{{asset('admin-assets/focused/vendor/daterangepicker/moment.min.js')}}"></script>

	<script src="{{asset('admin-assets/focused/vendor/daterangepicker/daterangepicker.js')}}"></script>

	<script src="{{asset('admin-assets/focused/vendor/countdowntime/countdowntime.js')}}"></script>

	<script src="{{asset('admin-assets/focused/js/main.js')}}"></script>

</body>
</html>