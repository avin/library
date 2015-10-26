@extends('layouts.admin')

@section ('content')

    {{ Former::populate( $user ) }}
    {!! Former::horizontal_open()
                ->secure()
                ->action(action('Admin\UserController@update', [$user->id]))
                ->rules(['name' => 'required'])
                ->method('PUT') !!}

    {!! Former::legend("Редактирование пользователя \"{$user->name}\"") !!}

    @include('errors.list')

    {!! Former::text('name')->autofocus() !!}
    {!! Former::text('email')->autofocus() !!}
    {!! Former::checkbox('admin')->text('Административные права')->label('&nbsp;') !!}

    <hr>

    {!! Former::password('password')->label('Новый пароль') !!}
    {!! Former::password('password_confirmation') !!}

    <hr>

    {!! Former::actions(
        Former::large_primary_submit(ends_with(Route::currentRouteAction(), '@create') ? 'Создать' : 'Сохранить'),
        (ends_with(Route::currentRouteAction(), '@edit') ? Html::linkAction('Admin\UserController@delete', 'Удалить книгу', [$user->id], ['class' => 'btn btn-danger']) : '')

    ) !!}

    {!! Former::close() !!}

    <hr>

        <a href="{{ action('Admin\UserController@index') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i>
            Вернуться к каталогу</a>
@stop
