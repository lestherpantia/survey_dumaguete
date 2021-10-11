@extends('layout.main')

@section('title')
    Dumaguete LGU Survey
@stop

@section('header')
    @include('layout.header')
@stop


@section('content')

    <div id="app">
        <survey-component></survey-component>
    </div>

@stop

@section('footer')
    @include('layout.footer')
@stop




