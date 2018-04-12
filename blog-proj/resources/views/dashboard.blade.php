@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    You are logged in!
                    <a href="/posts/create" class="btn btn-primary">Create Post</a>
                    <h3>Your Blog posts</h3>
                    
                    @if(count($posts) >0) 
                    <table class="table-striped">
                        <tr>
                            <td>Title</td>
                            <td></td>
                            <td></td>
                        </tr>

                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td>
                                    <a href="/posts/{{$post->id}}/edit" 
                                    class="btn btn-default">
                                    Edit
                                    </a>
                                </td>
                                <td>
                                    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'mehtod' => 'POST', 'class' => 'pull-right'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    @else
                        <p>You haven't posted anything yet!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
