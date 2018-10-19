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
@stop

@push('js')
    {!! Html::script('js/incidence/sweetalert2.min.js') !!}
    {!! Html::script('js/incidence/parsley.min.js') !!}
    {!! Html::script('js/incidence/solicitudes.js') !!}
@endpush

@section('content')
    <div id="solicitudes">
        <!-- Modal para registrar una solicitud -->
        <div id="solicitude_create_modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="form_solicitude" method="post" enctype="multipart/form-data" action="{{ route('solicitudes.store') }}">
                        <input type="hidden" name="temp_areas_route" value="{{ route('solicitudes.temp_areas') }}">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nueva Solicitud</h4>
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
                                        <label for="solicitude_area">Area:</label>
                                        <select data-parsley-required-message="Debe elegir una opci&oacute;n" class="form-control" id="solicitude_area" name="solicitude_area" required>
                                            @foreach ($areas_available as $area)
                                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="solicitude_title">Titulo:</label>
                                        <input data-parsley-required-message="Este campo no puede estar vacio" class="form-control" type="text" name="solicitude_title" id="solicitude_title" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="solicitude_description">Descripcion:</label>
                                        <textarea data-parsley-required-message="Este campo no puede estar vacio" style="width: 100%;" tabindex="-1" class="form-control" name="solicitude_description" id="solicitude_description" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="solicitude_evidence">Encuestas:</label>
                                        <select data-parsley-required-message="Debe elegir una opcion" style="width: 100%;" tabindex="-1" class="form-control" name="solicitude_poll" id="solicitude_poll" required multiple>
                                            @if ($polls->count())
                                                @foreach ($polls as $poll)
                                                    <option value="{{ $poll->id }}">{{ $poll->title }}</option>
                                                @endforeach
                                            @else
                                                <option value="">no hay encuestas disponibles</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="solicitude_evidence">Categorias:</label>
                                        <select data-parsley-required-message="Debe elegir una opcion" style="width: 100%;" tabindex="-1" class="form-control" name="solicitude_categories" id="solicitude_categories" required multiple>
                                            @if ($categories->count())
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">no hay categorias disponibles</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class = "btn btn-danger pull-left" data-dismiss = "modal">Cerrar</button>
                            <button id="btn_submit" type="submit" class="btn btn-success pull-right">Guardar</button>
                        </div>
                    </form>
                </div>
                <!--<solicitude-create-form areas_route="{{ route('solicitudes.temp_areas') }}" submit_route = "{{ route('solicitudes.store') }}"></solicitude-create-form>-->
            </div>
        </div>
        <!-- Fin modal registrar solicitud -->
        <script>
            var initial_solicitudes = @json($solicitudes);
        </script>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Solicitudes Disponibles</h3>
                    </div>
                    <div class="box-body">
                        <!-- <solicitudes-table solicitudes_route=""></solicitudes-table></div>-->
                        <br><br>
                        <div class="container" id="table_container">
                            <div class="table-responsive">
                                <table id="solicitudes_table" style="width: 100%">
                                    <input type="hidden" name="solicitudes_route" id="solicitudes_route" value="{{ route('solicitudes.list') }}">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Area</th>
                                            <th>Titulo</th>
                                            <th>Descripcion</th>
                                            <th>Detalles</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <br><br>
                    </div>
                    <div class="box-footer clearfix">
                        @foreach (Auth::user()->roles()->get() as $role)
                            @if ($role->name == 'Admin' || $role->name == 'tecnico')
                                <button data-toggle="modal" data-target="#solicitude_create_modal" class="btn btn-default btn-flat pull-right">
                                    Nueva Solicitud
                                </button> 
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
