@extends('adminlte::page')

@section('title', 'HelpDesk | Tracing')

@push('css')
    {!! Html::style('css/incidence/sweetalert2.min.css') !!}
@endpush

@section('content_header')
    <div class="page-header">
        <h2> &nbsp;&nbsp;&nbsp;{{ 'Incidencia '.'# '.$incidence->id }}</h2>
    </div>
@stop

@push('js')
    {!! Html::script('js/incidence/sweetalert2.min.js') !!}
    {!! Html::script('js/incidence/parsley.min.js') !!}

@endpush

@section('content')

 <div class="container-fluid">
    <div class="row">
        <div class="col-md-9 col-lg-9 col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title center-block">Tracing</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="label">Comentarios</label>
                    </div>
                </div>

                <div class="box-footer clearfix">
                        <button data-toggle="modal" data-target="#myModal" class="btn btn-default btn-flat pull-right">
                            Nuevo Comentario
                        </button>
                    </div>
            </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Comentarios</h4>
      </div>
            <div class="modal-body">
                    <div class="form-group">
                        <textarea class="form-control" name="tracing" cols="50" rows="8"></textarea>
                    </div>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
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
                            <label for="theme">Nombre de Incidencia</label>
                            <p id="theme">{{ $incidence->theme }}</p>
                        </div>
                        <div class="form-group">
                            <label for="contacto">Contacto</label>
                            <p id="contacto">{{ $incidence->contact->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="etiquetas">Etiquetas</label>
                            <p id="etiquetas">
                            @foreach(explode(',', $incidence->label) as $item)
                                {{'#'.$item}}&nbsp;
                            @endforeach
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="prioridad">Prioridad</label>
                            <p id="prioridad">{{ $incidence->priority }}</p>
                        </div>
                        <div class="form-group">
                            <label for="state">Estado</label>
                            <p id="state">{{ $incidence->incidencestate->name }}</p>
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
                </div>
            </div>
    </div>
</div>
@stop
