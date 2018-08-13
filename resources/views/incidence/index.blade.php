@extends('adminlte::page')

@section('title', 'HelpDesk | Incidencias')

@section('content_header')
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
                    <h3>&nbsp;&nbsp;NO ASIGNADOS</h3>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <!--<p>You are logged in!</p>-->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Incidencias</h3>
                </div>
                <div class="box-body">DataTables con las incidencias</div>
            </div>
        </div>
    </div>
@stop