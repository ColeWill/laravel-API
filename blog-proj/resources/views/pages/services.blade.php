@extends('layouts.app')

@section('content')
    
    <div class="container-fluid">
        <div class="container">
            <div class="col-lg-10">
                <h1>{{$title}}</h1>
                    @if(count($services) > 0)
                        @foreach($services as $service)
                            <ul class='list-group'>
                                <li class="list-group-item">{{$service}}</li>
                            </ul>
                        @endforeach
                    @endif
            </div>
        </div>
    </div>       
@endsection