@extends('layouts.admin')

@section ('content')

    <h1>Каталог книг</h1>

    <form class="" action="{{ action('Admin\BookController@index') }}">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Найти книгу..." name="search" value="{{ Input::get('search') }}">
        </div>

    </form>

    @if($books->count())
        <table class="table table-bordered table-hover table-responsive">
            <thead>
            <tr>
                <th class="no-width no-wrap">
                    Автор
                </th>
                <th>
                    Название
                </th>
                <th class="no-width"></th>
                <th class="no-width"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr>
                    <td class="no-wrap">
                        {{ $book->author }}
                    </td>
                    <td>
                        {{ $book->name }}
                        @if(Auth::user()->favoriteBooks->where('id', $book->id)->count())
                            <span class="pull-right label label-success">В избранном</span>
                        @endif
                    </td>
                    <td class="no-wrap">
                        <a href="#" class="btn btn-xs btn-warning"><i class="fa fa-hand-grab-o"></i> Выдать</a>
                    </td>
                    <td class="no-wrap">
                        <a href="{{ action('Admin\BookController@edit', ['id' => $book->id]) }}" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Редактировать</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="text-center">
            {!! $books->appends(Request::except('page'))->render() !!}
        </div>

    @else
        <p>Ничего не найдено.</p>
    @endif

    <a href="{{ action('Admin\BookController@create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Добавить книгу</a>

@stop
