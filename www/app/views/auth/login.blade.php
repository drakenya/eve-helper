@extends('layout')

@section('content')
	{{ Form::open([
		'route' => 'auth/login-process',
		'autocomplete' => 'off',
	]) }}

		{{ Form::label('username', 'Username') }}
		{{ Form::text('username', Input::old('username'), [
			'placeholder' => 'john.smith'
		]) }}

		{{ Form::label('password') }}
		{{ Form::password('password', [
			'placeholder' => '********'
		]) }}
		@if ($error = $errors->first('password'))
			<div class="error">
				{{ $error }}
			</div>
		@endif

		{{ Form::submit('login') }}
	{{ Form::close() }}
@stop

@section('footer')
	@parent
	<script src="//polyfill.io"></script>
@stop
