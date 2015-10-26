@extends('layouts.auth')

@section('content')

    {!! Former::horizontal_open()
        ->secure()
        ->action(action('Auth\PasswordController@postEmail'))
        ->rules(['email' => 'required|email'])
        ->method('POST') !!}

    {!! Former::legend('restore_password') !!}

    @include('errors.list')

    {!! Former::text('email')->autofocus() !!}

    {!! Former::actions()
        ->large_primary_submit('send_restore_instructions')
        ->large_inverse_reset('clear') !!}

    {!! Former::close() !!}

@stop