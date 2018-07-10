@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Metodo</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                {!! Form::open(['route' => 'module.store']) !!}
                <div class="box-header with-border">
                    <h1 class="box-title">Registrar</h1>
                </div>

                <!-- Box Body -->
                <div class="box-body">
                    <div class="row">
                        <!-- Controlador & Url -->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Controlador -->
                            <div class="form-group">
                                {!! Form::label('method_id', 'Método') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-cog"></i>
                                    </span>
                                    {!! Form::select('module[method_id]', $metodos, null, ['class' => 'form-control',
                                                                                           'title' => 'Método al cuál redirigira el módulo, siempre y cuando no sea principal',
                                                                                           'placeholder' => 'Selecciona un método',
                                                                                           'id' => 'method_id'
                                    ]) !!}
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
                                    {!! Form::select('module[module_id]', $modulos,null, ['class' => 'form-control',
                                                                                          'title' => 'Módulo al cual pertenecera el submenu',
                                                                                          'placeholder' => 'Selecciona un módulo',
                                                                                          'id' => 'module_id'
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
                                {!! Form::label('order', 'Orden') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-object-group"></i>
                                    </span>
                                    {!! Form::text('methods[order]', null, ['class' => 'form-control',
                                                                            'title' => 'Orden en el cuál se vizualizara el módulo',
                                                                            'placeholder' => 'Ejemplo: 1',
                                                                            'id' => 'order'
                                    ]) !!}
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
                                    {!! Form::text('module[text]', null, ['class' => 'form-control',
                                                                          'title' => 'Nombre del módulo',
                                                                          'placeholder' => 'Incidencias',
                                                                          'id' => 'text'
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
                                {!! Form::label('icon', 'Icono') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-object-group"></i>
                                    </span>
                                    {!! Form::text('module[icon]', null, ['class' => 'form-control',
                                                                          'title' => 'Nombre del icono que se mostrará con el módulo',
                                                                          'placeholder' => 'fa-cogs, omitir fa, solo poner cogs',
                                                                          'id' => 'icon'
                                    ]) !!}
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
                                    {!! Form::text('module[icon_color]', null, ['class' => 'form-control',
                                                                                'title' => 'Color con el cuál se pintara el icono del modulo',
                                                                                'placeholder' => 'Selecciona un color',
                                                                                'id' => 'icon_color'
                                    ]) !!}
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
                                    {!! Form::text('module[label]', null, ['class' => 'form-control',
                                                                           'title' => 'Texto que se mostrara al lado del nombre del modulo, preferiblemente poner números',
                                                                           'placeholder' => 'Indica número de incidencias: 4',
                                                                           'id' => 'label'
                                    ]) !!}
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
                                    {!! Form::text('module[label_color]', null, ['class' => 'form-control',
                                                                                 'title' => 'Color del label',
                                                                                 'placeholder' => 'Selecciona el color',
                                                                                 'id' => 'label_color'
                                    ]) !!}
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
                                    <label>{!! Form::checkbox('module[main]', 1, true, []) !!} Sí</label>
                                </div>
                            </div>
                        </div>
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