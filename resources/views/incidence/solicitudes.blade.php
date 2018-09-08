@extends('adminlte::page')

@section('title', 'HelpDesk | Solicitudes')

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
                    <h3>&nbsp;&nbsp;RESUELTOS</h3>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    {!! Html::script('./js/incidence/solicitudes.js') !!}
@endpush

@section('content')
    <div id="solicitudes">
        <div id="solicitude_create_modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <solicitude-create-form areas_route="{{ route('solicitudes.temp_areas') }}" submit_route = "{{ route('solicitudes.store') }}"></solicitude-create-form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Solicitudes</h3>
                    </div>
                <div class="box-body"><solicitudes-table solicitudes_route="{{ route('solicitudes.list') }}"></solicitudes-table></div>
                    <div class="box-footer clearfix">
                        <button data-toggle="modal" data-target="#solicitude_create_modal" class="btn btn-default btn-flat pull-right">
                            Nueva Solicitud
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop