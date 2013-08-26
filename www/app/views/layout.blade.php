<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="/css/layout.css" />
		<title>Tutorial</title>
	</head>
	<body>
		@include('header')
		<div class="content">
			<div class="container">
				@yield('content')
			</div>
		</div>
		@include('footer')
	</body>
</html>
