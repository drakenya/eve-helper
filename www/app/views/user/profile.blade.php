@extends('layout')
@section('content')
	<h2>Hello {{ Auth::user()->username }}</h2>
	<p>Welcome to your sparse profile page.</p>
	<p>Eve Server Open? {{ $pheal_response->serverOpen ? "open" : "closed" }} </p>
	<p>Online Players: {{ $pheal_response->onlinePlayers }}</p>
	<p>Current balance: {{ $character->accounts[0]->balance }}</p>
@stop
