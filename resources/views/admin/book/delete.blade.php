@extends('layouts.admin')

@section('custom-style')
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/select2.css') }}">
@stop

@section('content')

    {!! Former::horizontal_open()
        ->secure()
        ->action(action('Admin\BookController@destroy', [$book->id]))
        ->method('DELETE') !!}

    {!! Former::legend("Удалить книгу") !!}

    @include('errors.list')

    {!! Former::actions(
            "Вы действительно хотите удалить книгу \"{$book->name}\" ?"
        ) !!}

    <hr>

    {!! Former::actions(
            Former::large_danger_submit('delete'),
            Html::link(URL::previous(), __('label.cancel'), ['class' => 'btn btn-default'])
        ) !!}


    {!! Former::close() !!}

@stop

@section('custom-script')
    <script>
        $('select').select2();
    </script>
@stop