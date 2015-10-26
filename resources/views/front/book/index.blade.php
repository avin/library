@extends('layouts.master')

@section ('content')


    @if(isset($favorite))
        <h1>Избранные книги</h1>
    @elseif(Input::get('search'))
        <h1>Результат поиска по запросу "{{ Input::get('search') }}"</h1>
    @else
        <h1>Каталог книг</h1>
    @endif


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
            <td>
                <a href="{{ action('BookController@show', ['id' => $book->id]) }}" class="btn btn-xs btn-primary">Открыть</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">
        {!! $books->appends(Request::except('page'))->render() !!}
    </div>

    @else
        <p>По вашему запросу ничего не найдено.</p>
    @endif

@stop
