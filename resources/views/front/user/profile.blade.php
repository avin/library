@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">

            {!! Former::horizontal_open()
                ->secure()
                ->action(action('UserController@saveProfile'))
                ->rules(['name' => 'required', 'email' => 'required|email', 'password' => 'confirmed'])
                ->method('POST') !!}

            {!! Former::legend('Мой профиль') !!}

            @include('errors.list')

            {!! Former::text('name')->value($user->name)->autofocus() !!}
            {!! Former::text('email')->value($user->email)->disabled() !!}

            <hr>

            {!! Former::password('password')->label('Новый пароль') !!}
            {!! Former::password('password_confirmation') !!}

            <hr>

            {!! Former::actions()
                ->large_primary_submit('save') !!}

            {!! Former::close() !!}

        </div>
    </div>

@stop
