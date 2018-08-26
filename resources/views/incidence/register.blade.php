@extends('adminlte::page')

@section('title', 'HelpDesk | Registrar incidencia')

@section('content_header')
@stop

@section('content')
    <!--<p>You are logged in!</p>-->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Crear incidencia</h3>
                </div>
                <div style="margin: 2%;" class="box-body">
                    @if(session('msg')['estado'] == 's')
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('msg')['mensaje'] }}
                        </div>
                    @elseif(session('msg')['estado'] == 'w')
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('msg')['mensaje'] }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="form_incidence" action="{{ route('incidence.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="contacto">Contacto:</label>
                                    <select style="width: 100%;" tabindex="-1" class="form-control" id="contacto" name="contacto"></select>
                                </div>  
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tema">Tema:</label>
                            <input type="text" class="form-control" id="tema" name="tema">
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="abierto">Abierto</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="resuelto">Resuelto</option>
                                <option value="cerrado">Cerrado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="prioridad">Prioridad:</label>
                            <select class="form-control" id="prioridad" name="prioridad">
                                <option value="bajo">Bajo</option>
                                <option value="medio">Medio</option>
                                <option value="alto">Alto</option>
                                <option value="urgente">Urgente</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="agente">Asignar a:</label>
                            <select class="form-control" id="agente" name="agente">
                                <option value="0" selected>Sin asignar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea rows="10" class="form-control" id="descripcion" name="descripcion"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="evidencia">Evidencia:</label>
                            <input type="file" id="evidencia" name="evidencia"></input>
                        </div>
                        <div class="form-group">
                            <label for="etiquetas">Etiquetas:</label>
                            <select style="width: 100%;" tabindex="-1" class="form-control" id="etiquetas" name="etiquetas[]" multiple="multiple">
                                <option value="perro">Perro</option>
                                <option value="pajaritos">Pajaritos</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="box-footer">
                    <div class="pull-right">
                        <button id="cancelar" type="button" class="btn btn-default">Cancelar</button>
                        <button id="crear" type="button" class="btn btn-success">Crear</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#contacto').select2();
            $('#etiquetas').select2();
            $('#crear').click(function(){
                $('#form_incidence').submit();
            });
        });
    </script>
@stop