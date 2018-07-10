@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Controlador</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                {!! Form::open(['route' => 'controller.store']) !!}
                <div class="box-header with-border">
                    <h1 class="box-title">Registrar</h1>
                </div>

                <!-- Box Body -->
                <div class="box-body">
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
                <!-- /Box Body -->

                <div class="box-footer">
                    {!! Form::button('guardar', ['class' => 'btn btn-success pull-right','type' => 'submit']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop