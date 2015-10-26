@extends('layouts.auth')

@section('content')

    {!! Former::horizontal_open()
        ->secure()
        ->action(action('Auth\AuthController@postLogin'))
        ->rules(['email' => 'required|email', 'password' => 'required'])
        ->method('POST') !!}

    {!! Former::legend('authorization') !!}

    @include('errors.list')

    {!! Former::text('email')->autofocus() !!}
    {!! Former::password('password') !!}

    {!! Former::checkbox('remember')
        ->label(' ')
        ->text('remember_me')
        ->check() !!}

    {!! Former::actions()
    ->large_primary_submit('login')
    ->large_inverse_reset('clear') !!}

    {!! Former::actions(
            link_to_action('Auth\AuthController@getRegister', $title = __('label.go_register')),
            '</br>',
            link_to_action('Auth\PasswordController@getEmail', $title = __('label.go_restore'))
        ) !!}

    {!! Former::close() !!}

@stop
