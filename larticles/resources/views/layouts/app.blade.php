<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> {{config('APP_NAME', 'LSAPP')}}</title> 
        {{-- rendered from .env --}}
        <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
        
    </head>
    <body>
        @include('inc.navbar')
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>