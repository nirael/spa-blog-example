<!DOCTYPE html>
<html lang="en" ng-app='main' ng-cloak>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Phoenix's blog</title>

    <!-- Styles -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <!-- Scripts -->
    <script src="/js/app.js"></script>
   
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Branding Image -->
                    <a class="navbar-brand navbar-left" href="{{ url('/') }}">
                       <span style="font-size:1.4em;margin-top: -3px;" class="glyphicon glyphicon-apple brand"></span>
                    </a>
                </div>
        </div>
        </nav>
<div class='container ct'>
        @yield('content')
        </div>
    </div>

    <!-- Scripts -->

</body>
</html>
