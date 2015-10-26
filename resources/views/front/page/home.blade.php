@extends('layouts.master')


@section ('content')

    <div class="header">
        <h1 class="title">Твоя библиотека</h1>
        <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p>
    </div>

    <p>Welcome to home <strong>{{ Auth::user()->name }}</strong>!</p>

@stop
