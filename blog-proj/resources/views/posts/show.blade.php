@extends('layouts.app')
<br><br><br>
@section('content')
	<div class="container">
		<h1>{{$post->title}}</h1>
		<img style="width:100%;" src="/storage/cover_images/{{$post->cover_image}}">
		<br><br>
			{{-- allows html to be parsed from ck-editor --}}
		<div class="row">
			{!!$post->body!!}
		</div>
		<a href="/posts" class="btn btn-md btn-success">Go Back</a>
		<hr>
		<small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
		<small>{{$post->cover_image}}</small>
		<hr>
		{{-- if user is NOT a guest they can see delete/edit buttons --}}
		@if(!Auth::guest()) 
			@if(Auth::user()->id == $post->user_id)
				<a href="/posts/{{$post->id}}/edit" class="btn bg-warning text-muted">Edit</a>
				{{-- DELETE BTN --}}
				<div class="float-right">
					{!!Form::open(['action' => ['PostsController@destroy', $post->id], 'mehtod' => 'POST', 'class' => 'pull-right'])!!}
						{{Form::hidden('_method', 'DELETE')}}
						{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
					{!!Form::close()!!}
			@endif
		@endif
		</div>
	</div>

@endsection