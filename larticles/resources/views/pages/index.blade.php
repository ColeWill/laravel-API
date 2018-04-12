@extends('layouts.app')

@section('content')
	<div class="jumbotron text-center">
		<h1>{{$title}}</h1>
		<p>this is the laravel app im building</p>
		<a href="/login" role="button" class="btn btn-primary btn-lg">Login</a>
	</div>
@endsection