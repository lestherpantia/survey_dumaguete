@extends('adminlte::page')

@section('title', 'Survey')

@section('content_header')


@stop

@section('content')

    <div id="app">
        <user-component></user-component>
    </div>

@stop

@extends('layout.footer')


@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@stop
