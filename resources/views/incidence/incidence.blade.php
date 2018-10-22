@extends('adminlte::page')

@section('title', 'HelpDesk | Tracing')

@push('css')
    {!! Html::style('css/incidence/sweetalert2.min.css') !!}
@endpush

@section('content_header')
    <div class="page-header">
        <h2> &nbsp;&nbsp;&nbsp;{{ $incidence->solicitude->title }}</h2>
        <small>&nbsp;&nbsp;&nbsp;{{ 'Incidencia '.'# '.$incidence->id }}</small>
    </div>
@stop

@push('js')
    {!! Html::script('js/incidence/sweetalert2.min.js') !!}
    {!! Html::script('js/incidence/parsley.min.js') !!}
    {!! Html::script('js/tools/loadingOverlay/loadingoverlay.min.js') !!}
    {!! Html::script('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') !!}
    {!! Html::script('js/incidence/tracing-index.js') !!}
    {!! Html::script('js/incidence/tracing-store.js') !!}
    {!! Html::script('js/incidence/tracing-update.js') !!}
@endpush

@section('content')
<!-- Modal para registrar una incidencia -->
<div id="solution_create_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">¿Cual fue la soluci&oacute;n?</h2>
            </div>
            <div class="modal-body">
                <textarea name="txta_solucion" id="txta_solucion" style="width:100%"></textarea>
            </div>
            <div class="modal-footer">
                <button class = "btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                <button id="btn_submit" name="btn_submit"  type="submit" class="btn btn-success pull-right">Guardar</button>
            </div>
        </div>
        <!--<solicitude-create-form areas_route="{{ route('solicitudes.temp_areas') }}" submit_route = "{{ route('solicitudes.store') }}"></solicitude-create-form>-->
    </div>
</div>
<!-- Fin modal registrar incidencia -->
 <div class="container-fluid">
    <div class="row">
        <div class="col-md-9 col-lg-9 col-sm-12">
        <div class="box box-success">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-comments-o"></i>

              <h3 class="box-title">Comentarios</h3>
            </div>
            

            {!! Form::hidden('show-chat', route('tracing.show', ['id' => $incidence->id]), ['id' => 'show-chat']) !!}
            <div class="box-body chat" id="chat-box" style="overflow: hidden; width: auto; height: 250px;">
                              
            </div>
            <!-- /.chat -->
            <div class="box-footer">
              {!! Form::open(['route' => 'tracing.store', 'id' => 'store-tracing']) !!}  
              <div class="input-group">
                {!! Form::hidden('tracing[id_incidence]', $incidence->id, ['id' => 'id_incidence']) !!}
                {!! Form::text('tracing[comment]', null, ['placeholder'=>"Type message...", 'class'=>"form-control", 'id' => 'comment']) !!}

                <div class="input-group-btn">
                  {!! Form::button('<i class="fa fa-plus"></i>', ['class'=>"btn btn-success", 'type' => 'submit']) !!}
                </div>
              </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>

        <div class="col-md-3 col-lg-3 col-sm-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title center-block">Informaci&oacute;n</h3>
                        @foreach (Auth::user()->roles()->get() as $role)
                            @if ($role->name == 'Admin')
                            <button title="Guardar cambios" class="btn btn-default pull-right" id="btn_guardar" name="btn_guardar"><i class="fas fa-save"></i></button>
                            @endif
                        @endforeach
                    </div>
                    <div class="box-body">
                            <div class="form-group">
                                <label for="theme">Tema</label>
                                <p id="theme">{{ $incidence->theme }}</p>
                            </div>
                            @foreach (Auth::user()->roles()->get() as $role)
                            @if ($role->name == 'Admin')
                                <div class="form-group">
                                    <input type="hidden" id="update_incidence_route" value="{{ route('incidence.update',['id' => $incidence->id]) }}">
                                    <label for="contacto">Contacto:</label>
                                    <select class="form-control" name="contacto" id="contacto">
                                        @foreach ($contactos as $contacto)
                                            @if ($contacto->id == $incidence->contact->id)
                                            <option value="{{ $contacto->id }}" selected>{{ $contacto->name }}</option>    
                                            @else
                                            <option value="{{ $contacto->id }}">{{ $contacto->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="prioridad">Prioridad:</label>
                                    <select class="form-control" name="prioridad" id="prioridad">
                                        @foreach ($prioridades as $prioridad)
                                            @if ($prioridad['id'] == $incidence->priority)
                                            <option value="{{ $prioridad['id'] }}" selected>{{ $prioridad['name'] }}</option>    
                                            @else
                                            <option value="{{ $prioridad['id'] }}">{{ $prioridad['name'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="categories">Estado:</label>
                                    <select class="form-control" name="estado" id="estado">
                                        @foreach ($estados as $estado)
                                            @if ($estado->id == $incidence->incidenceState->id)
                                                <option value="{{ $estado->id }}" selected>{{ $estado->name }}</option>    
                                            @else
                                                <option value="{{ $estado->id }}">{{ $estado->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="categories">Agente asignado:</label>
                                    <select class="form-control" name="agente" id="agente">
                                        @foreach ($agentes as $agente)
                                            @if ($agente->id == $incidence->agent->id)
                                                <option value="{{ $agente->id }}" selected>{{ $agente->name }}</option> 
                                            @else
                                                <option value="{{ $agente->id }}">{{ $agente->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <div class="form-group">
                                    <input type="hidden" id="update_incidence_route" value="{{ route('incidence.update',['id' => $incidence->id]) }}">
                                    <label for="contacto">Contacto:</label>
                                    <select class="form-control" name="contacto" id="contacto" disabled>
                                        @foreach ($contactos as $contacto)
                                            @if ($contacto->id == $incidence->contact->id)
                                                <option value="{{ $contacto->id }}" selected>{{ $contacto->name }}</option>    
                                            @else
                                                <option value="{{ $contacto->id }}">{{ $contacto->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="prioridad">Prioridad:</label>
                                    <select class="form-control" name="prioridad" id="prioridad" disabled>
                                        @foreach ($prioridades as $prioridad)
                                            @if ($prioridad['id'] == $incidence->priority)
                                                <option value="{{ $prioridad['id'] }}" selected>{{ $prioridad['name'] }}</option>    
                                            @else
                                                <option value="{{ $prioridad['id'] }}">{{ $prioridad['name'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="categories">Estado:</label>
                                    <select class="form-control" name="estado" id="estado" disabled>
                                        @foreach ($estados as $estado)
                                            @if ($estado->id == $incidence->incidenceState->id)
                                                <option value="{{ $estado->id }}" selected>{{ $estado->name }}</option>    
                                            @else
                                                <option value="{{ $estado->id }}">{{ $estado->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="categories">Agente asignado:</label>
                                    <select class="form-control" name="agente" id="agente" disabled>
                                        @foreach ($agentes as $agente)
                                            @if ($agente->id == $incidence->agent->id)
                                                <option value="{{ $agente->id }}" selected>{{ $agente->name }}</option> 
                                            @else
                                                <option value="{{ $agente->id }}">{{ $agente->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>    
                            @endif
                        @endforeach
                        {{--
                        <div class="form-group">
                            <label for="title">Titulo de la Solicitud</label>
                            <p id="title">{{ $incidence->solicitude->title }}</p>
                        </div>
                        --}}
                        <div class="form-group">
                            <label for="etiquetas">Etiquetas</label>
                            <p id="etiquetas">
                            @foreach(explode(',', $incidence->label) as $item)
                                {{'#'.$item}}&nbsp;
                            @endforeach
                            </p>
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
