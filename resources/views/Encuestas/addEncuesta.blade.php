@extends('adminlte::page')

@section('title', 'AdminLTE')



@section('css')
    {!! Html::style('./css/styles.css') !!}
@stop

@push('js')

    <script>
        $(document).ready(function() {
            var cantPreg=0;
            var cantResp=0;

            $('#btAddPreg').click(function() {
                crearPreg();
            });
            $('#btAddResp').click(function() {
                crearResp();
            });

            $('#crearEncuesta').submit(function(e){
                e.preventDefault();
                if($('#cantPreg').val() > 0 && $('#cantResp').val() > 0){
                    this.submit();
                }else{
                    alert('falta agregar preguntas a la encuesta');
                }              
            });

            function crearPreg(){
                $.ajax({
                    url : '/encuesta/poll/preguntas',
                    type : 'GET',
                    dataType : 'json',
                    success : function(json) {
                        cantPreg++;

                        var html = '<div id="preg'+cantPreg+'">';
                        html += '<label>Pregunta #'+cantPreg+'</label>';
                        html += '<select class="form-control" name="pregunta'+cantPreg+'">';

                        $.each(json, function(i, value){                        
                            html += '<option value="'+ value.idQuestion +'">'+ value.description +'</option>';
                        });

                        html += '</select><br></div>';

                        $('#cantPreg').val(cantPreg);
                        $('#preguntas').append(html);
                    },
                    error : function(xhr, status) {
                        alert('Disculpe, existió un problema');
                    }
                });        
            }

            function crearResp(){
                $.ajax({
                    url : '/encuesta/poll/respuestas',
                    type : 'GET',
                    dataType : 'json',
                    success : function(json) {
                        cantResp++;

                        var html = '<div id="resp'+cantResp+'">';
                        html += '<label>Respuesta #'+cantResp+'</label>';
                        html += '<select class="form-control" name="respuesta'+cantResp+'">';

                        $.each(json, function(i, value){                        
                            html += '<option value="'+ value.idResponse +'">'+ value.description +'</option>';
                        });

                        html += '</select><br></div>';
                        $('#cantResp').val(cantResp);
                        $('#respuestas').append(html);
                    },
                    error : function(xhr, status) {
                        alert('Disculpe, existió un problema');
                    }
                });
            }

            $('#btRemovePreg').click(function() {   // Elimina un elemento por click
                if (cantPreg > 0) {
                    $('#preg'+cantPreg).remove();                    
                    cantPreg = cantPreg - 1;
                    $('#cantPreg').val(cantPreg);
                }
            });

            $('#btRemoveResp').click(function() {   // Elimina un elemento por click
                if (cantResp > 0) {
                    $('#resp'+cantResp).remove();                    
                    cantResp = cantResp - 1;
                    $('#cantResp').val(cantResp);
                }
            });
        });
    </script>
@endpush

@section('content')
    <div class="box box-info">
        <div class="container">
            <div class="row">
                <h1>Crea tu encuesta</h1>


                <div class="col-md-12">
                    <div class="btn-group pull-right" role="group" aria-label="Basic example">                  
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPregunta">Crear pregunta</button>
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalRespuesta">Crear respuesta</button>
                    </div><br><br>
                    @if(session()->has('msj'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4><i class="glyphicon glyphicon-ok"></i>  &nbsp;{{session('msj')}}</h4>
                        </div>
                    @endif
                    
                    {!! Form::open(array('url' => 'encuesta/poll/create', 'method' => 'GET','autocomplete'=>'off', 'id' => 'crearEncuesta')) !!}
                    {{ csrf_field() }}

                        <div class="form-row">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Titulo encuesta</label>
                                <input type="text" class="form-control" name="titlePoll" required>
                                <br>
                            </div>
                        </div>

                        <div class="form-row">
                            <label for="exampleFormControlInput1">Descripcion</label>
                            <input type="text" class="form-control" name="descriptionPoll" required>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="form-group col-sm-12 col-md-6">
                                <input type="button" id="btAddPreg" value="Agregar Pregunta" class="btn btn-info" />&nbsp;
                                <input type="button" id="btRemovePreg" value="Eliminar Pregunta" class="btn btn-info" />
                            </div>

                            <div class="form-group col-sm-12 col-md-6">
                                <input type="button" id="btAddResp" value="Agregar Respuesta" class="bt btn btn-info" />&nbsp;
                                <input type="button" id="btRemoveResp" value="Eliminar Respuesta" class="bt btn btn-info" />&nbsp;
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <input type="hidden" id="cantPreg" name="cantPreg">
                            <input type="hidden" id="cantResp" name="cantResp">
                            <div class="form-group col-md-6" id="preguntas">
                            </div>
                            <div class="form-group col-md-6" id="respuestas">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success pull-right btn-lg">Guardar</button>
                    {!! Form::close() !!}
                </div>
            </div>    
        </div><br>
    </div>

     <!-- Modal crear pregunta --> 
    <div class="modal fade" id="modalPregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva pregunta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(array('url' => 'encuesta/poll/create', 'method' => 'GET','autocomplete'=>'off')) !!}
                {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pregunta-text" class="col-form-label">Pregunta:</label>
                            <textarea class="form-control" name="pregunta" id="pregunta-text" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

     <!-- Modal crear respuesta -->
    <div class="modal fade" id="modalRespuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva respuesta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(array('url' => 'encuesta/poll/create', 'method' => 'GET','autocomplete'=>'off')) !!}
                {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="respuesta-text" class="col-form-label">Respuesta:</label>
                            <textarea class="form-control" id="respuesta-text" name="respuesta" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop

