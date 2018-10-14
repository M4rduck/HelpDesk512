@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Controlador</h1>
@stop

@push('js')
    {!! Html::script('./js/system/controller/table.js') !!}
@endpush

@push('css')
    <!-- Estilos para botón flotante -->
    {!! Html::style('./css/button_float.css') !!}
@endpush

@section('content')

    <div class="box">
        <div class="box-header">

        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table id="controller-table" class="table table-striped">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Contenedor</th>
                        <th>Prefijo</th>
                        <th>Estado</th>
                        <th>Editar</th>
                    </tr>
                    </thead>
                </table>
            </div>
         </div>
    </div>
    <div class="absolute bottom-btn">
        {!! Form::button('<span class="glyphicon glyphicon-circle-arrow-right"></span>', ['class' => 'btn btn-primary',
                                                                                          'title' => 'Crear Controlador',
                                                                                          'data-toggle' =>'modal',
                                                                                          'data-target'=>'#myModal'
        ]) !!}
    </div>

    <div class="absolute bottom-btn">
        {!! Form::button('<span class="glyphicon glyphicon-circle-arrow-right"></span>', ['class' => 'btn btn-primary',
                                                                                          'title' => 'Crear Controlador',
                                                                                          'data-toggle' =>'modal',
                                                                                          'data-target'=>'#myModal'
        ]) !!}
    </div>
    <div class="absolute bottom-btn">
        {!! Form::button('<span class="glyphicon glyphicon-circle-arrow-right"></span>', ['class' => 'btn btn-primary',
                                                                                          'title' => 'Crear Controlador',
                                                                                          'data-toggle' =>'modal',
                                                                                          'data-target'=>'#myModal'
        ]) !!}
    </div>
@stop

@section('modal')
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                {!! Form::open(['route' => 'controller.store']) !!}
                <div class="modal-header bg-warning">
                    {!! Form::button('&times;', ['class'=>'close', 'data-dismiss'=>'modal']) !!}
                    <h4 class="modal-title">Registrar</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Controlador & Prefijo -->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Controlador -->
                            <div class="form-group">
                                {!! Form::label('name', 'Controlador') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-cog"></i>
                                    </span>
                                    {!! Form::text('controller[name]', null, ['class' => 'form-control',
                                                                              'title' => 'Nombre de la clase del controlador',
                                                                              'placeholder' => 'NameController',
                                                                              'id' => 'name'
                                    ]) !!}
                                </div>
                            </div>
                            <!-- /Controlador -->

                            <!-- Prefijo -->
                            <div class="form-group">
                                {!! Form::label('prefix', 'Prefijo') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-object-group"></i>
                                    </span>
                                    {!! Form::text('controller[prefix]', null, ['class' => 'form-control',
                                                                                'title' => 'Nombre del grupo de rutas',
                                                                                'placeholder' => 'controller',
                                                                                'id' => 'prefix'
                                    ]) !!}
                                </div>
                            </div>
                            <!-- /Prefijo -->
                        </div>
                        <!-- /Controlador & Prefijo -->

                        <!-- Contenedor & Estado -->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Contenedor -->
                            <div class="form-group">
                                {!! Form::label('containerName', 'Contenedor') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-folder"></i>
                                    </span>
                                    {!! Form::text('controller[containerName]', null, ['class' => 'form-control',
                                                                                       'title' => 'Nombre de la carpeta en la que se encuentre el controlador',
                                                                                       'placeholder' => 'NameFolder',
                                                                                       'id' => 'containerName'
                                    ]) !!}
                                </div>
                            </div>
                            <!-- Contenedor-->

                            <!-- Estado -->
                            <div class="form-group">
                                {!! Form::label('status', 'Estado') !!}
                                <div class="checkbox">
                                    <label title = 'Si el controlador va a estar visible'>{!! Form::checkbox('controller[status]', 1, true, ['id' => 'status'
                                            ]) !!} Visible</label>
                                </div>
                            </div>
                            <!-- Estado -->
                        </div>
                        <!-- /Contenedor & Estado -->
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::button('Close', ['class'=>'btn btn-default pull-left', 'data-dismiss'=>'modal']) !!}
                    {!! Form::button('guardar', ['class' => 'btn btn-success pull-right','type' => 'submit']) !!}
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
@endsection