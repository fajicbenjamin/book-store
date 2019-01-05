<!doctype html>
<html>
<head>
    @include('includes.head')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/album.css') }}">
</head>
<body>
    <div id="app" class="main-wraps">
        @yield('content')
    </div>
    @include('includes.footer')
</body>
</html>