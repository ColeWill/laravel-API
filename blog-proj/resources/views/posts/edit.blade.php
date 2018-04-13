@extends('layouts.app')

@section('content')
	<h1>Edit Post</h1>
	
	{!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' =>'multipart/form-data']) !!}
		<div class="form-group">
			{{Form::label('title', 'title')}}
			{{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
		</div>
		<div class="form-group">
			{{Form::label('title', 'title')}}
			{{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'form-control', 'placeholder' => 'Body Text'])}}
		</div>
		<div class="form-group">
			{{Form::file('cover_image')}}
		</div>
		{{-- needed for the update route to work... --}}
		{{Form::hidden('_method', 'PUT')}} 
		{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
	{!! Form::close() !!}


@endsection 