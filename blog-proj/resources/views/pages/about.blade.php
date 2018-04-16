@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<h3><?php echo $title; ?></h3>
				<p>Thanks for stopping by.  This is a Laravel/MySQL Blog Application with authentication.  All users can view all posts without being authenticated.  A user can CRUD their own posts, but only has the ability to read other posts, and not update or destroy them.  Even though Laravel is not one of the hot new frameworks that everyone is talking about, it is Awesome! And probably my favorite framework to currently work with.  Its is very easy to learn, and I will be definetely building more PHP/Laravel projects in the future!</p>
		</div>
	</div>
	
@endsection