<html>
    <head>
        <title>@yield('title','Default Content')</title>
        @include('includes.head')
    </head>
    <body>
        <div class='header'>
            @include('includes.header')
        </div>
        @yield('content)
        <div class='footer'>
            @include('includes.footer')
        </div>
    </body>
</html>