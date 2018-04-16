@extends('layouts.app')

@section('content')
	<div class="container">
		<h1>Create A Post</h1>
		<div class="row">
			
				{!! Form::open(['action' =>'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
					<div class="form-group">
						{{Form::label('Title', 'Title')}}
						{{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
					</div>
					<div class="form-group">
						{{Form::label('title', 'title')}}
						{{Form::textarea('body', '', ['id' => 'article-ckeditor', 'form-control', 'placeholder' => 'Body Text'])}}
					</div>
					<div class="form-group">
						{{Form::file('cover_image')}}
					</div>
					{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
				{!! Form::close() !!}
		</div>
	</div>
	


@endsection 