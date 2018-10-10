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

@endpush

@section('content')

 <div class="container-fluid">
    <div class="row">
        <div class="col-md-9 col-lg-9 col-sm-12">

        </div>
    </div>
 </div>

 <div class="col-md-3 col-lg-3 col-sm-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title center-block">Informaci&oacute;n</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">Titulo de la Solicitud</label>
                            <p id="title">{{ $incidence->solicitude->title }}</p>
                        </div>
                        <div class="form-group">
                            <label for="ID">ID</label>
                            <p id="ID">{{ $incidence->id }}</p>
                        </div>
                        <div class="form-group">
                            <label for="contacto">Contacto</label>
                            <p id="contacto">{{ $incidence->contact->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripci&oacute;n</label>
                            <p id="description">{{ $incidence->description }}</p>
                        </div>
                        @if ($incidence->evidence_route)
                            <div class="form-group">
                                <label for="evidence">Evidencia</label>
                                <p><a id="evidence" href="{{ asset(Storage::url($incidence->id)) }}" download>{{ asset(Storage::url($incidence->id)) }}</a></p>
                            </div>
                        @endif
                    </div>
                    <div class="box-footer">
                        
                    </div>
                </div>

    {{ $incidence->incidence_state }}
    
@stop
