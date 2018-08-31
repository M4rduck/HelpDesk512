@extends('adminlte::page')

@section('title', 'HelpDesk512 - Computadores')

@section('content_header')
    <h1>Computadores</h1>
@stop

@push('css')
    <!-- Estilos para botón flotante -->
    {!! Html::style('./css/button_float.css') !!}
@endpush

@section('content')
    <div class="absolute bottom-btn">
        {!! Form::button('<span class="glyphicon glyphicon-circle-arrow-right"></span>', ['class' => 'btn btn-primary',
                                                                                          'title' => 'Crear Controlador',
                                                                                          'data-toggle' =>'modal',
                                                                                          'data-target'=>'#modalCreateModule'
        ]) !!}
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="box">

                <div class="box-header with-border">
                    <h1 class="box-title">Listado</h1>
                </div>

                <!-- Box Body -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="module-table" class="table table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Entidad</th>
                                <th>Numero de serie</th>
                                <th>Usuario</th>
                                <th>Tipo</th>
                                <th>Modelo</th>
                                <th>Sistema Operativo</th>
                                <th>Localizacion</th>
                                <th>ID</th>
                                <th>Grupo</th>
                                <th>Red</th>
                                <th>Numero de inventario</th>
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
@stop
@section('modal')
 <div id="modalCreateModule" class="modal fade" role="dialog">
        <div class="modal-dialog">
            {!! Form::open(['route' => 'product.store']) !!}
            <div class="modal-content">
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
                                {!! Form::label('method_id', 'Tipo Hardware') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-cog"></i>
                                        </span>
                                     {!!   Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['class' => 'form-control',
                                                                              'title' => 'Nombre de la clase del controlador',
                                                                              'placeholder' => 'NameController',
                                                                              'id' => 'name']) !!}

                                   
                                </div>
                            </div>
                            <!-- /Controlador -->

                            <!-- Url -->
                            <div class="form-group">
                                {!! Form::label('module_id', 'Módulo') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-link"></i>
                                        </span>
                                        
                                        {!! Form::text('hola', null, ['class' => 'form-control',
                                                                           'title' => 'Texto que se mostrara al lado del nombre del modulo, preferiblemente poner números',
                                                                           'placeholder' => 'Indica número de incidencias: 4',
                                                                           'id' => 'label'
                                    ]) !!}
                                        {!!  Form::select('size', array('L' => 'Large', 'S' => 'Small')); !!}
                                </div>
                            </div>
                            <!-- /Verbo -->
                        </div>
                        <!-- /Controlador & Url -->

                        <!-- Verbo & Nombre de Funcion -->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Verbo -->
                            <div class="form-group">
                                {!! Form::label('order', 'Orden') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        {!!  Form::select('size', array('L' => 'Large', 'S' => 'Small')); !!}
                                </div>
                            </div>
                            <!-- /Verbo -->

                            <!-- Nombre de Funcion -->
                            <div class="form-group">
                                {!! Form::label('text', 'Nombre') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        {!!  Form::select('size', array('L' => 'Large', 'S' => 'Small')); !!}
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
                                {!! Form::label('icon', 'Icono') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        {!!  Form::select('size', array('L' => 'Large', 'S' => 'Small')); !!}
                                </div>
                            </div>
                            <!-- /Nombre del método-->
                        </div>
                        <!-- /Nombre del método-->

                        <!-- Nombre del método-->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Nombre del método-->
                            <div class="form-group">
                                {!! Form::label('icon_color', 'Color Icono') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        {!!  Form::select('size', array('L' => 'Large', 'S' => 'Small')); !!}
                                </div>
                            </div>
                            <!-- /Nombre del método-->
                        </div>
                        <!-- /Nombre del método-->
                    </div>

                    <div class="row">
                        <!-- Nombre del método-->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Nombre del método-->
                            <div class="form-group">
                                {!! Form::label('label', 'Label') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        {!!  Form::select('size', array('L' => 'Large', 'S' => 'Small')); !!}
                                </div>
                            </div>
                            <!-- /Nombre del método-->
                        </div>
                        <!-- /Nombre del método-->

                        <!-- Nombre del método-->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Nombre del método-->
                            <div class="form-group">
                                {!! Form::label('label_color', 'Color Label') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        {!!  Form::select('size', array('L' => 'Large', 'S' => 'Small')); !!}
                                </div>
                            </div>
                            <!-- /Nombre del método-->
                        </div>
                        <!-- /Nombre del método-->
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                {!! Form::label('main', 'Principal') !!}
                                <div class="checkbox">
                                    <label> Sí</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    {!! Form::button('Close', ['class'=>'btn btn-danger pull-left', 'data-dismiss'=>'modal']) !!}
                    {!! Form::button('guardar', ['class' => 'btn btn-success pull-right','type' => 'submit']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

