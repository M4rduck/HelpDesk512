@extends('adminlte::page')

@section('title', 'HelpDesk | Tracing')

@push('css')
    {!! Html::style('css/incidence/sweetalert2.min.css') !!}
@endpush

@section('content_header')

@stop

@push('js')
    {!! Html::script('js/incidence/sweetalert2.min.js') !!}
    {!! Html::script('js/incidence/parsley.min.js') !!}
    {!! Html::script('js/incidence/solicitudes.js') !!}
@endpush

@section('content')

    <div id="incidence">
        {{ $incidence->id }}
    </div>
    
    
@stop
