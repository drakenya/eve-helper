@extends('layout')
@section('content')
	{{ Form::open([
		'route' => 'user/request',
		'autocomplete' => 'off',
	]) }}
		{{ Form::label('email', 'Email') }}
		{{ Form::text('email', Input::get('email'), [
			'placeholder' => 'john.smith@example.com',
		]) }}

		{{ Form::submit('reset') }}
	{{ Form::close() }}
@stop

@section('footer')
	@parent
	<script src="//polyfill.io"></script>
@stop
