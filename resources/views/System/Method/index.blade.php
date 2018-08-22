@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Metodo</h1>
@stop

@push('js')
    {!! Html::script('./js/system/method/table.js') !!}
@endpush

@push('css')
    <!-- Estilos para botón flotante -->
    {!! Html::style('./css/button_float.css') !!}
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header with-border">
                    <h1 class="box-title">Registrar</h1>
                </div>
                <!-- Box Body -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="method-table" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Controlador</th>
                                <th>Función</th>
                                <th>Url</th>
                                <th>Verbo</th>
                                <th>Nombre</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- /Box Body -->
                <div class="box-footer">
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-btn">
        {!! Form::button('<span class="glyphicon glyphicon-circle-arrow-right"></span>', ['class' => 'btn btn-primary',
                                                                                          'title' => 'Crear Controlador',
                                                                                          'data-toggle' =>'modal',
                                                                                          'data-target'=>'#modalCreateMethod'
        ]) !!}
    </div>
@stop

@section('modal')
    <!-- modal -->
    <div id="modalCreateMethod" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                {!! Form::open(['route' => 'method.store']) !!}
                <div class="modal-header bg-warning">
                    {!! Form::button('&times;', ['class'=>'close', 'data-dismiss'=>'modal']) !!}
                    <h4 class="modal-title">Registrar</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <!-- Controlador & Url -->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Controlador -->
                            <div class="form-group">
                                {!! Form::label('controller_id', 'Controlador') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-cog"></i>
                                    </span>
                                    {!! Form::select('methods[controller_id]', $controladores, null, ['class' => 'form-control',
                                                                                                     'title' => 'Controlador al que pertenece el método',
                                                                                                     'placeholder' => 'Selecciona un controlador',
                                                                                                     'id' => 'controller_id'
                                    ]) !!}
                                </div>
                            </div>
                            <!-- /Controlador -->

                            <!-- Url -->
                            <div class="form-group">
                                {!! Form::label('url', 'Url') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-link"></i>
                                    </span>
                                    {!! Form::text('methods[url]',null, ['class' => 'form-control',
                                                                        'title' => 'Url del método',
                                                                        'placeholder' => '/url',
                                                                        'id' => 'url'
                                    ]) !!}
                                </div>
                            </div>
                            <!-- /Verbo -->
                        </div>
                        <!-- /Controlador & Url -->

                        <!-- Verbo & Nombre de Funcion -->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Verbo -->
                            <div class="form-group">
                                {!! Form::label('verbName', 'Verbo') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-object-group"></i>
                                    </span>
                                    {!! Form::select('methods[verbName]', $verbos, null, ['class' => 'form-control',
                                                                                         'title' => 'Verbo del método',
                                                                                         'placeholder' => 'Selecciona un verbo',
                                                                                         'id' => 'verbName'
                                    ]) !!}
                                </div>
                            </div>
                            <!-- /Verbo -->

                            <!-- Nombre de Funcion -->
                            <div class="form-group">
                                {!! Form::label('name_function', 'Funcion') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-object-group"></i>
                                    </span>
                                    {!! Form::text('methods[name_function]', null, ['class' => 'form-control',
                                                                                   'title' => 'Nombre de la función del método',
                                                                                   'placeholder' => 'index',
                                                                                   'id' => 'name_function'
                                    ]) !!}
                                </div>
                            </div>
                            <!-- /Nombre de Funcion -->
                        </div>
                        <!-- /Verbo & Nombre de Funcion -->
                    </div>

                    <div class="row">
                        <!-- Nombre del método-->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Nombre del método-->
                            <div class="form-group">
                                {!! Form::label('name', 'Nombre') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-object-group"></i>
                                    </span>
                                    {!! Form::text('methods[name]', null, ['class' => 'form-control',
                                                                          'title' => 'Nombre de la ruta',
                                                                          'placeholder' => 'general.index',
                                                                          'id' => 'name'
                                    ]) !!}
                                </div>
                            </div>
                            <!-- /Nombre del método-->
                        </div>
                        <!-- /Nombre del método-->
                    </div>
                </div>

                <div class="modal-footer">
                    {!! Form::button('Close', ['class'=>'btn btn-danger pull-left', 'data-dismiss'=>'modal']) !!}
                    {!! Form::button('guardar', ['class' => 'btn btn-success pull-right','type' => 'submit']) !!}
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
    <!-- /modal -->
@endsection