<html>
    <head>
        <title>@yield('title','Index')</title>
        @section('head')
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <!--[if IE]>
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <![endif]-->
            <!-- BOOTSTRAP CORE STYLE  -->
            <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
            {{ HTML::script('assets/vendor/jquery-ui/jquery-ui.js'); }}
            {{ HTML::script('assets/vendor/list.js/dist/list.js'); }}
            {{ HTML::script('assets/vendor/tinysort/dist/tinysort.min.js'); }}
            {{ HTML::style('css/bootstrap.css'); }}
            {{ HTML::script('js/bootstrap.js'); }}
            {{ HTML::style('css/bootstrap-horizon.css'); }}
            {{ HTML::style('css/font-awesome.css'); }}
        @show
    </head>
    <body>
        <div class='header'>
            @include('includes.header')
        </div>
        <div class="header-space"></div>
        @yield('content')
        <div class='footer'>
            @include('includes.footer')
        </div>
    </body>
</html>