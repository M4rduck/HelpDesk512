@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Modulo</h1>
@stop

@push('js')
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.0/handlebars.js') !!}
    <script id="details-template" type="text/x-handlebars-template">
        <table class="table">
            <tbody>
            @{{#each modules as |module|}}
                <tr>
                    <td><b>Texto:</b></td>
                    <td>@{{ module.text }}</td>
                    <td><b>Icono</b></td>
                    <td>@{{ module.icon }}</td>
                    <td><b>Método</b></td>
                    <td>@{{ module.method.name }}</td>
                    <td><b>Opciones:</b></td>
                    <td><button class="btn btn-xs btn-primary" data-id="@{{ module.id }}"><i class="glyphicon glyphicon-edit"></i></button></td>
                </tr>
            @{{/each}}
            </tbody>
        </table>
    </script>
    {!! Html::script('./js/system/module/table.js') !!}
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
                        <table id="module-table" class="table table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Texto</th>
                                <th>Icono</th>
                                <th>Método</th>
                                <th>Modulo</th>
                                <th>Color Icono</th>
                                <th>Label</th>
                                <th>Color Label</th>
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
                                                                                          'data-target'=>'#modalCreateModule'
        ]) !!}
    </div>
@stop

@section('modal')
    <!-- modal -->
    <div id="modalCreateModule" class="modal fade" role="dialog">
        <div class="modal-dialog">
            {!! Form::open(['route' => 'module.store']) !!}
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
                                    {!! Form::text('module[order]', null, ['class' => 'form-control',
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

                <div class="modal-footer">
                    {!! Form::button('Close', ['class'=>'btn btn-danger pull-left', 'data-dismiss'=>'modal']) !!}
                    {!! Form::button('guardar', ['class' => 'btn btn-success pull-right','type' => 'submit']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection