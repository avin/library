@extends('layouts.admin')

@section ('content')

    @if(isset($book))
        {{ Former::populate( $book ) }}
    @endif

    {!! Former::horizontal_open()
                ->secure()
                ->action(ends_with(Route::currentRouteAction(), '@create') ? action('Admin\BookController@store') : action('Admin\BookController@update', [$book->id]))
                ->rules(['name' => 'required'])
                ->method(ends_with(Route::currentRouteAction(), '@create') ? 'POST' : 'PUT') !!}

    {!! Former::legend(ends_with(Route::currentRouteAction(), '@create') ? 'Добавление книги' : "Редактирование кники \"{$book->name}\"") !!}

    @include('errors.list')

    {!! Former::text('name')->autofocus() !!}
    {!! Former::text('author')->autofocus() !!}
    {!! Former::text('year')->autofocus() !!}

    <hr>

    {!! Former::actions(
        Former::large_primary_submit(ends_with(Route::currentRouteAction(), '@create') ? 'Создать' : 'Сохранить'),
        (ends_with(Route::currentRouteAction(), '@edit') ? Html::linkAction('Admin\BookController@delete', 'Удалить книгу', [$book->id], ['class' => 'btn btn-danger']) : '')

    ) !!}

    {!! Former::close() !!}

    <hr>

        <a href="{{ action('Admin\BookController@index') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i>
            Вернуться к каталогу</a>
@stop
