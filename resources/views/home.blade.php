@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@push('js')
    {!! Html::script('./js/app.js') !!}
@endpush

@section('content')
    <div id="app">
        <example-component></example-component>
    </div>    
@stop