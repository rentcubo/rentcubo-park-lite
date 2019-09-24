<!DOCTYPE html>
<html>
<head>
	@include('layouts.users.styles')
</head>
<body>

	@include('layouts.users.header')
	
	@yield('content')
	
	@include('layouts.users.footer')

	@include('layouts.users.scripts')

</body>
</html>