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
    <div style="margin-left: 1%;" class="page-header">
        <h2>{{ title_case($solicitude->title) }}</h2>
        <small>Solicitud #{{ $solicitude->id }}</small>
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
                <form id="form_incidence" method="post" enctype="multipart/form-data" action="{{ route('incidence.store') }}">
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
                        <input type="hidden" id="solicitude_id" value="{{ $solicitude->id }}">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="contact">Contacto:</label>
                                    <select style="width: 100%;" tabindex="-1" data-parsley-required-message="Debe elegir una opci&oacute;n" class="form-control" id="contact" name="contact" required>
                                        <option value=""></option>
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
                                    <select style="width: 100%;" tabindex="-1" data-parsley-required-message="Debe elegir una opci&oacute;n" class="form-control" id="agent" name="agent" required>
                                        <option value=""></option>
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
                                    <label for="state">Estado</label>
                                    <select data-parsley-required-message="Debe elegir una opci&oacute;n" class="form-control" id="state" name="state" required disabled>
                                        @foreach ($estados_incidencia as $estado)
                                            @if ($estado->id == 4)
                                                <option value="{{ $estado->id }}" selected>{{ $estado->name }}</option>
                                            @else
                                                <option value="{{ $estado->id }}">{{ $estado->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="priority">Prioridad:</label>
                                    <select data-parsley-required-message="Debe elegir una opci&oacute;n" class="form-control" id="priority" name="priority" required>
                                        @foreach ($prioridades as $prioridad)
                                            <option value="{{ $prioridad['id'] }}">{{ $prioridad['name'] }}</option>
                                        @endforeach
                                    </select>
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
                <input type="hidden" name="incidences_route" id="incidences_route" value="{{ route('solicitudes.incidences', ['solicitude' => $solicitude->id]) }}">
                @if ($solicitude->incidence->count())
                    <script>
                        var initial_incidences = @json($solicitude->incidence); 
                        var solicitude = @json($solicitude);
                    </script>
                @else
                    <script>
                        var initial_incidences = [];
                        var solicitude = {};
                    </script>
                @endif
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Incidencias</h3>
                    </div>
                    <div class="box-body">
                        <br><br>
                        <div style="padding-left: 20px; padding-right: 20px;" id="table_container">
                            <div>
                                <input id="show_incidence_route" type="hidden" value="{{ route('incidence.show', ['incidence' => ""]) }}">                                
                                {!! Form::hidden('show_diagnosis_route', route('diagnosis.show', ['id' => '']), ['id' => 'show_diagnosis_route']) !!}
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
            </div>
            <div class="col-md-3 col-lg-3 col-sm-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Informaci&oacute;n</h3>
                        @foreach (Auth::user()->roles()->get() as $role)
                            @if ($role->name == 'Admin')
                            <button title="Guardar cambios" class="btn btn-default pull-right" id="btn_guardar" name="btn_guardar"><i class="fas fa-save"></i></button>
                            @endif
                        @endforeach
                    </div>
                    <div class="box-body">
                        @foreach (Auth::user()->roles()->get() as $role)
                            @if ($role->name == 'Admin')
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
                                    <label for="area">Encuesta</label>
                                    <select class="form-control" name="encuesta" id="encuesta">
                                        @foreach ($polls as $poll)
                                            <option value="{{ $poll->id }}">{{ $poll->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="categories">Categorias</label>
                                    <select class="form-control" name="categories" id="categories" multiple>
                                        @foreach ($available_categories as $available_category)
                                            @if(in_array($available_category->id, $registered_categories->toArray()))
                                                <option value="{{ $available_category->id }}" selected>{{ $available_category->name }}</option>
                                            @else
                                                <option value="{{ $available_category->id }}">{{ $available_category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Descripci&oacute;n</label>
                                    <textarea class="form-control" id="solicitude_description">{{ $solicitude->description }}</textarea>
                                </div>
                            @else
                                <div class="form-group">
                                    <input type="hidden" id="update_solicitude_route" value="{{ route('solicitudes.update',['id' => $solicitude->id]) }}">
                                    <label for="area">Area</label>
                                    <select class="form-control" name="area" id="area" disabled>
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
                                    <label for="area">Encuesta</label>
                                    <select class="form-control" name="encuesta" id="encuesta" disabled>
                                        @foreach ($polls as $poll)
                                            <option value="{{ $poll->id }}">{{ $poll->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="categories">Categorias</label>
                                    <select class="form-control" name="categories" id="categories" multiple disabled>
                                        @foreach ($available_categories as $available_category)
                                            @if(in_array($available_category->id, $registered_categories->toArray()))
                                                <option value="{{ $available_category->id }}" selected>{{ $available_category->name }}</option>
                                            @else
                                                <option value="{{ $available_category->id }}">{{ $available_category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Descripci&oacute;n</label>
                                    <textarea class="form-control" id="solicitude_description" disabled>{{ $solicitude->description }}</textarea>
                                </div>    
                            @endif
                        @endforeach
                    </div>
                    <div class="box-footer">
                        <button id="btn_incidencia" data-target="#incidence_create_modal" data-toggle="modal" class="btn btn-default pull-right">Nueva Incidencia</button>
                    </div>
                </div>
                
                    
                @foreach (Auth::user()->roles()->get() as $role)
                    @if ($role->name == 'Admin')
                        <div class="pull-right">
                            <!--<a id="btn_edit" href="" class="btn btn-info">Editar</a>-->
                            <a id="btn_delete" href="{{ route('solicitudes.destroy',['id' => $solicitude->id]) }}" class="btn btn-danger">Eliminar</a>
                        </div> 
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    
@stop
