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
    {!! Html::script('js/incidence/incidences.js') !!}
@endpush

@section('content')
    <!-- Modal para registrar una incidencia -->
    <div id="incidence_create_modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form_incidence" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Nueva Incidencia</h4>
                    </div>
                    <div class="modal-body">
                        <!--
                        <div v-if="form_errors" class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" v-on:click="set_form_values" aria-hidden="true">&times;</button>
                            <ul>
                                <li v-bind:key="error[0]" v-for="error in form_errors">
                                    
                                </li>
                            </ul>
                        </div>
                        -->
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="contact">Contacto:</label>
                                    <select style="width: 100%;" tabindex="-1" data-parsley-required-message="Debe elegir una opci&oacute;n" class="form-control" id="contact" name="contact" required>
                                        @foreach ($contactos as $contacto)
                                            <option value="{{ $contacto->id }}">{{ $contacto->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="theme">Tema</label>
                                    <input data-parsley-required-message="Este campo no puede estar vacio" class="form-control" type="text" name="theme" id="theme" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="description">Descripcion</label>
                                    <textarea data-parsley-required-message="Este campo no puede estar vacio" style="width: 100%;" tabindex="-1" class="form-control" name="description" id="description" required></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="evidence">Evidencia</label>
                                    <input type="file" style="width: 100%;" ref="evidence" tabindex="-1" class="form-control" name="evidence" id="evidence">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="label">Etiquetas:</label>
                                    <select style="width: 100%;" tabindex="-1" data-parsley-required-message="Debe elegir al menos una opci&oacute;n" class="form-control" id="label" name="label" required multiple></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="agent">Asignar a:</label>
                                    <select style="width: 100%;" tabindex="-1" data-parsley-required-message="Debe elegir una opci&oacute;n" class="form-control" id="agent" name="agent" required></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="state">Estado</label>
                                    <select data-parsley-required-message="Debe elegir una opci&oacute;n" class="form-control" id="state" name="state" required></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="priority">Prioridad:</label>
                                    <select data-parsley-required-message="Debe elegir una opci&oacute;n" class="form-control" id="priority" name="priority" required></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class = "btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                        <button id="btn_submit" type="submit" class="btn btn-success pull-right">Guardar</button>
                    </div>
                </form>
            </div>
            <!--<solicitude-create-form areas_route="{{ route('solicitudes.temp_areas') }}" submit_route = "{{ route('solicitudes.store') }}"></solicitude-create-form>-->
        </div>
    </div>
    <!-- Fin modal registrar incidencia -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 col-lg-9 col-sm-12">
                <input type="hidden" name="incidences_route" id="incidences_route" value="{{ "route('incidences.list')" }}">
                @if ($solicitude->incidence->count())
                    <script>
                        var initial_incidences = @json($solicitude->incidence); 
                        var solicitude = @json($solicitude);
                    </script>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Incidencias</h3>
                        </div>
                        <div class="box-body">
                            <br><br>
                            <div style="padding-left: 20px; padding-right: 20px;" id="table_container">
                                <div>
                                    <input id="show_incidence_route" type="hidden" value="{{ route('incidence.show', ['incidence' => ""]) }}">
                                    <table id="incidences_table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tema</th>
                                                <th>Descripcion</th>
                                                <th>Estado</th>
                                                <th>Agente</th>
                                                <th>Detalles</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <br><br>
                        </div>
                    </div>
                @else
                    <h3>No hay incidencias para esta solicitud</h3>
                    <img class="center-block" src="http://1.bp.blogspot.com/-QnzyKyBZz20/Ui4kRwOCM_I/AAAAAAAAAzs/YJmkTNPIrRo/s1600/lola_affair_02.png" alt="no incidences" class="img-responsive">    
                @endif
            </div>
            <div class="col-md-3 col-lg-3 col-sm-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title center-block">Informaci&oacute;n</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <input type="hidden" id="update_solicitude_route" value="{{ route('solicitudes.update',['id' => $solicitude->id]) }}">
                            <label for="area">Area</label>
                            <select class="form-control" name="area" id="area">
                                @foreach ($areas as $area)

                                    @if ($area->id == $solicitude->area_id)
                                        <option value="{{ $area->id }}" selected>{{ $area->name }}</option>    
                                    @else
                                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripci&oacute;n</label>
                            <p id="description">{{ $solicitude->description }}</p>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button id="btn_incidencia" data-target="#incidence_create_modal" data-toggle="modal" class="btn btn-default pull-right">Nueva Incidencia</button>
                    </div>
                </div>
                <div class="pull-right">
                    <!--<a id="btn_edit" href="" class="btn btn-info">Editar</a>-->
                    <a id="btn_delete" href="{{ route('solicitudes.destroy',['id' => $solicitude->id]) }}" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        </div>
    </div>
    
@stop
