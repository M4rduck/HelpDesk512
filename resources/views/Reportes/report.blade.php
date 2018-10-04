@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Reportes</h1>
@stop

@section('css')
    {!! Html::style('./css/styles.css') !!}
@stop

@push('js')
    {!! Html::script('./js/app.js') !!}
    {!! Html::script('./js/graficos.js') !!}
@endpush

@section('content')
    <div class="row">
        <div class="col-4 col-sm-4 col-sm-4">
            <div class="info-box info-box-btn" id="reportGeneral">
                <span class="info-box-icon bg-blue"><i class="fa fa-pie-chart"></i></span>
                <div class="info-box-content">
                    <h1 class="info-box-text">Graficar reporte de incidentes en general</h1>
                </div>
            </div>
        </div>

        <div class="col-4 col-sm-4">
            <div class="info-box info-box-btn" data-toggle="modal" data-target="#exampleModalCenter">
                <span class="info-box-icon bg-blue"><i class="fa fa-line-chart"></i></span>
                <div class="info-box-content">
                    <h1 class="info-box-text">Graficar reporte por fecha</h1>
                </div>
            </div>
        </div>

        <div class="col-4 col-sm-4">
            <div class="info-box info-box-btn" data-toggle="modal" data-target="#modalEncuesta">
                <span class="info-box-icon bg-blue"><i class="fa fa-bar-chart"></i></span>
                <div class="info-box-content">
                    <h1 class="info-box-text">Graficar Satisfaccion en Encuesta</h1>
                </div>
            </div>
        </div>
    </div>

    @if(session()->has('msj'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5><i class="far fa-check-square"></i>  {{session('msj')}}</h5>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-6 col-sm-6">
            <div class="box">

                <div class="box-body" style="padding: 2%;max-height: 490px; min-height: 485px;">
                    <div id="canvas-container" style="width:100%;"">
                        <canvas id="chart" width="460" height="300"></canvas>
                    </div>
                </div>

                <div class="box-footer" style="padding: 2%;">

                </div>
                
            </div>
        </div>
        <div class="col-6 col-sm-6">
            <div class="box">
                <div class="box-body" style="padding: 2%; height:510px;">
                    <div id="tableReport">

                    </div>
                </div>              
            </div>
        </div>
    </div>
    
    {!! Form::close() !!}


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ingrese el rango de fechas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(array('autocomplete'=>'off', 'id'=>'reportesFechas')) !!}
                    {{ csrf_field() }} 
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <h5>Fecha Inicial:</h5>
                                <input class="form-control" name="fechainicial" type="date" required>
                            </div>
                            <div class="col-6">
                                <h5>Fecha Final:</h5>
                                <input class="form-control" name="fechafinal" type="date" required>
                            </div>
                        </div><br>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Graficar</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <!-- Modal Graficar Encuesta -->
    <div class="modal fade bd-example-modal-lg" id="modalEncuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header card-header">
                    <h5 class="modal-title" id="titleModalEncuesta">Graficar Satisfaccion Del Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="color-blue-light">Seleccione la pregunta para conocer la satisfaccion del cliente.</h4>
                    <div class="row">
                        <div class="col-6">
                            <h5>Pregunta: </h5>
                            <select class="form-control" id="pregunts">
                                @foreach($preguntas as $preg)
                                    <option style="font-size: 1.2em;" value="{{ $preg->question_id }}">{{ $preg->preguntas->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><br>                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="reportEncuest" type="button" class="btn btn-primary">Graficar</button>
                </div>
            </div>
        </div>
    </div>
    
@stop
