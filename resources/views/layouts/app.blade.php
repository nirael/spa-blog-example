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
    <link href="/css/site.css" rel="stylesheet">
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
    <script src="/js/app.config.js"></script>
    <script src="/js/main.factories.js"></script>
    <script src="/js/main.component.js"></script>
    <script src="/js/main.dirs.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
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
                        <!-- Authentication Links -->
                        <li><a href="#!/all"><span class='glyphicon glyphicon-folder-close'></span>&nbsp;All</a></li>
                        @if (Auth::guest())
                           
                        @else
                            <li class="dropdown">
                                <a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <li><a href="{{ url('/adminpanel')}}">Admin Panel </a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
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
