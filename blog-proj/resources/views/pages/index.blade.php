@extends('layouts.app')

@section('content')
<div class="container-fluid appBlade">
	<div class="jumbotron text-center homePage">
		<h1>{{$title}}</h1>
		<p>This is a CRUDdable Laravel 5.4 Blog application, thanks for stopping by!</p>
		<a href="/login" role="button" class="btn btn-primary btn-lg">Login</a>
	</div>
</div>
@endsection