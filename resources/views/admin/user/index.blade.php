@extends('layouts.admin')

@section ('content')

    <h1>Каталог пользователей</h1>

    <form class="" action="{{ action('Admin\UserController@index') }}">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Найти книгу..." name="search" value="{{ Input::get('search') }}">
        </div>

    </form>

    @if($users->count())
    <table class="table table-bordered table-hover table-responsive">
        <thead>
        <tr>
            <th class="no-width no-wrap">
                Имя
            </th>
            <th class="">
                E-mail
            </th>
            <th class="no-width no-wrap">
                Администратор
            </th>
            <th class="no-width"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td class="no-wrap">
                {{ $user->name }}
            </td>
            <td class="">
                {{ $user->email }}
            </td>
            <td class="text-center no-width">
                @if($user->admin)
                    <i class="fa fa-check text-success"></i>
                @endif

            </td>
            <td class="no-wrap">
                <a href="{{ action('Admin\UserController@edit', ['id' => $user->id]) }}" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Редактировать</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">
        {!! $users->appends(Request::except('page'))->render() !!}
    </div>

    @else
        <p>Ничего не найдено.</p>
    @endif

@stop
