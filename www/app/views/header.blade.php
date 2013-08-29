@section('header')
	<div class="header">
		<div class="container">
			<h1>Tutorial</h1>
			@if (Auth::check())
				<a href="{{ URL::route('auth/logout') }}">logout</a>
				<a href="{{ URL::route('user/profile') }}">profile</a>
			@else
				<a href="{{ URL::route('auth/login') }}">login</a>
			@endif
		</div>
	</div>
@show
