@extends('layouts.master')

@section ('content')

    <h1>Карточка кники</h1>

    <dl class="dl-horizontal">
        <dt> ID книги:</dt>
        <dd><span style="white-space: nowrap;"> {{ $book->id }} </span></dd>

        <dt> Название:</dt>
        <dd><span style="white-space: nowrap;"> {{ $book->name }} </span></dd>

        <dt> Автор:</dt>
        <dd><span style="white-space: nowrap;"> {{ $book->author }} </span></dd>

        <dt> Год издания:</dt>
        <dd><span style="white-space: nowrap;"> {{ $book->year }} </span></dd>


        <dt> Описание:</dt>
        <dd><span> {{ $book->description }} </span></dd>

        <dt> Статус:</dt>
        <dd><strong class="text-success">Свободна</strong></dd>
    </dl>

    <hr>

        <a href="{{ action('BookController@index') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i>
            Вернуться к каталогу</a>

        @if (Auth::user()->favoriteBooks->where('id', $book->id)->count())

            {!! Former::open()->action(action('BookController@deleteFavorite', ['id' => $book->id]))->method('DELETE')->class('inline') !!}
            <button type="submit" href="#" class="btn btn-danger">Убрать из избранного</button>
            {!! Former::close() !!}

        @else

            {!! Former::open()->action(action('BookController@addFavorite', ['id' => $book->id]))->method('POST')->class('inline') !!}
            <button type="submit" href="#" class="btn btn-success">Добавить в избранное</button>
            {!! Former::close() !!}

        @endif

@stop
