@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Encuesta</h1>
@stop

@section('css')
    {!! Html::style('./css/styles.css') !!}
@stop

@push('js')
    {!! Html::script('./js/app.js') !!}
@endpush

@section('content')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Basado en tu experiencia, porfavor eval&uacute;a tu grado de satisfaccion con el servicio de soporte:</h3>
        </div>
        {!! Form::open(array('url' => 'encuesta/poll', 'method' => 'POST','autocomplete'=>'off')) !!}
        {{ csrf_field() }}
        <div class="box-body" style="padding: 2%;">
            <div class="table-responsive">                                
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            @foreach($respuestas as $r)
                                <th scope="col" style="width: 130px; word-wrap: break-word;">
                                    <div class="speech-bubble">{{$r->respuestas->description}}</div> &nbsp;
                                </th>                                            
                            @endforeach                                        
                        </tr>
                    </thead>
                    <tbody>
                        <input type="hidden" name="cantPreguntas" value="<?php echo count($preguntas); ?>">  
                        @foreach($preguntas as $p => $data)                
                            <tr>
                                <th scope="row">
                                    <div class="card preg">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">{{$data->preguntas->description}}</li>
                                            <input type="hidden" name="Pregunta{{$p + 1}}" value="{{$data->question_id}}">                     
                                        </ul>
                                    </div>
                                </th>
                                @foreach($respuestas as $r)
                                    <td class="options">
                                        {{-- <label>
                                            <input type="radio" name="Respuesta{{$p + 1}}" value="{{$r->response_id}}" required>
                                        </label> --}}
                                        <label class="containers">
                                            <input type="radio" name="Respuesta{{$p + 1}}" value="{{$r->response_id}}" required>
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table><br>
                
            </div>
        </div>

        <div class="box-footer" style="padding: 2%;">
            <button type="submit" class="btn btn-primary pull-right">Guardar</button>
        </div>
        {!! Form::close() !!}
    </div>
@stop
