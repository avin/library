<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Библиотека</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/master.css') }}">
</head>
<body>

{{--Navigation--}}
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ action('PageController@home') }}">Библиотека</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ action('BookController@indexFavorite') }}">Избранное</a></li>
                <li><a href="{{ action('UserController@getProfile') }}">Профиль</a></li>
                @if(Auth::user()->admin)
                    <li><a href="{{ action('Admin\BookController@index') }}">Администрирование</a></li>
                @endif
                <li><a href="{{ action('Auth\AuthController@getLogout') }}">Выйти</a></li>
            </ul>
            <form class="navbar-form navbar-right" action="{{ action('BookController@index') }}">
                <input type="text" class="form-control" placeholder="Поиск..." name="search" value="{{ Input::get('search') }}">
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">

    @include('flash::message')

    @yield('content')
</div>

<!-- JS -->
<script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/select2.js') }}"></script>

@yield('custom-script')

</body>
</html>