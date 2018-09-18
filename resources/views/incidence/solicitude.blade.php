@extends('adminlte::page')

@section('title', 'HelpDesk | Solicitudes')

@push('css')
    {!! Html::style('css/incidence/sweetalert2.min.css') !!}
@endpush

@section('content_header')
    <!--
    <div class="row">
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon">4</span>
                <div class="info-box-content">
                    <h3>&nbsp;&nbsp;SIN RESOLVER</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon">4</span>
                <div class="info-box-content">
                    <h3>&nbsp;&nbsp;ABIERTOS</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon">4</span>
                <div class="info-box-content">
                    <h3>&nbsp;&nbsp;RESUELTOS</h3>
                </div>
            </div>
        </div>
    </div>
    -->
    <div class="page-header">
        <h1>{{ title_case($solicitude->title) }} <small>Solicitud</small></h1>
    </div>
@stop

@push('js')
    {!! Html::script('js/incidence/sweetalert2.min.js') !!}
    {!! Html::script('js/incidence/parsley.min.js') !!}
@endpush

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-8 col-sm-12">
                @if (!$incidences)
                    
                @else
                    <h3>No hay incidencias para esta solicitud</h3>
                @endif
            </div>
            <div class="col-md-4 col-lg-4 col-sm-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title center-block">Informaci&oacute;n</h3>
                    </div>
                    <div class="box-body">
                        <div>jajajajaj</div>
                        <div class="form-group">
                            <label for="area">Area</label>
                            <p id="area">{{ $area }}</p>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripci&oacute;n</label>
                            <p id="description">{{ $solicitude->description }}</p>
                        </div>
                        @if ($solicitude->evidence_route)
                            <div class="form-group">
                                <label for="evidence">Evidencia</label>
                                <p><a id="evidence" href="{{ asset(Storage::url('28')) }}">{{ asset(Storage::url('28')) }}</a></p>
                            </div>
                        @endif
                    </div>
                    <div class="box-footer">
                        <button id="btn_incidencia" class="btn btn-primary pull-right">Nueva Incidencia</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@stop
