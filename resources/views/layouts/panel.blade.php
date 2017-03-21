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
    <link href="/css/admin.css" rel="stylesheet">
    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/js/angular.min.js"></script>
    <script src="/js/angular-route.js"></script>
    <script src="/js/angular-resource.js"></script>
    <script src="/js/angular-sanitize.js"></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        var app = angular.module('main',['ngRoute','ngResource','ngSanitize']);
 
    </script>
    <script src="/js/main.factories.js"></script>
    <script src="/js/admin/admin.config.js"></script>
    <script src="/js/admin/panel.component.js"></script>
   <!-- <script src="/js/admin/panel.dirs.js"></script> -->
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
                    <search-query></search-query>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                            <li><a href="#!/categories">Categories</a></li>
                            <li><a href="#!/posts">Posts</a></li>
                            <li><a href="#!/storage">Storage</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

    </div>

    <!-- Scripts -->

</body>
</html>
