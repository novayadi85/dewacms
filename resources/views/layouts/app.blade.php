<html>
    <head>
        <title>App Name - {{config('app.name','News Title')}}</title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
    </head>
    <body>
    @include('inc.navbar')
        <div class="container">
            
            @yield('content')
        </div>
    </body>
</html>