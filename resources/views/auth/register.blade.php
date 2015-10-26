@extends('layouts.auth')

@section('content')

    {!! Former::horizontal_open()
        ->secure()
        ->action(action('Auth\AuthController@postRegister'))
        ->rules(['name' => 'required', 'email' => 'required|email', 'password' => 'required'])
        ->method('POST') !!}

    {!! Former::legend('registration') !!}

    @include('errors.list')

    {!! Former::text('name')->autofocus() !!}
    {!! Former::text('email') !!}

    {!! Former::password('password') !!}
    {!! Former::password('password_confirmation') !!}

    <hr>

    {!! Former::actions()
        ->large_primary_submit('register')
        ->large_inverse_reset('clear') !!}

    {!! Former::actions(
            link_to_action('Auth\AuthController@getLogin', $title = __('label.go_login'))
        ) !!}

    {!! Former::close() !!}

@stop