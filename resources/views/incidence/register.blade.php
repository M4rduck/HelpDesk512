@extends('adminlte::page')

@section('title', 'HelpDesk | Registrar incidencia')

@section('content_header')
@stop

@push('js')
    {!! Html::script('./js/incidence/app.js') !!}
@endpush

@section('content')
    <!--<p>You are logged in!</p>-->
    <div id="incidence_create_form">
    <incidence-create-form submit_route = "{{ route('incidence.store') }}"></incidence-create-form>    
    </div>
    
@stop
