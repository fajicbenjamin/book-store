<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
    <div id="app" class="main-wraps">
        @include('includes.header')

        @yield('content')
    </div>
    @include('includes.footer')
</body>
</html>