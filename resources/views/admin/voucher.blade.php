@extends('adminlte::page')

@section('title', 'Dumaguete LGU Survey')

@section('content_header')


@stop

@section('content')

    <div id="app">
        <voucher-component></voucher-component>
    </div>

@stop

@extends('layout.footer')


@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@stop

