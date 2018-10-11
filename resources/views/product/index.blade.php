@extends('adminlte::page')

@section('title', 'HelpDesk512 - Hardware')

@section('content_header')
    <h1>Hardware</h1>
@stop

@push('css')
    <!-- Estilos para botón flotante -->
    <!-- {!! Html::style('./css/button_float.css') !!} -->
@endpush

@section('content')
    <div class="absolute bottom-btn">

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="box">

                <div class="box-header with-border">
                    <h1 class="box-title">Listado</h1>

                    <div class="box-tools pull-right">
                    {!! Form::button('<span class="glyphicon glyphicon-circle-arrow-right"></span>', ['class' => 'btn btn-primary',
                                                                                          'title' => 'Crear Controlador',
                                                                                          'data-toggle' =>'modal',
                                                                                          'data-target'=>'#modalCreateModule'
        ]) !!}

                    </div>
                </div>

                <!-- Box Body -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="module-table" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Tipo de hardware</th>
                                <th>Localizacion</th>
                                <th>Numero de contacto</th>
                                <th>Fabricante</th>
                                <th>Modelo</th>
                                <th>Numero de serie</th>
                                <th>Tecnico a cargo del hardware</th>
                                <th>Estado</th>
                                <th>Hardware activo</th>
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
                                     {!!   Form::select('type_hardware', ['Computador' => 'Computador', 'Impresora' => 'Impresora', 'telefono'=> 'Telefono', 'dispositivo'=>'Dispositivo'], null, ['class' => 'form-control',
                                                                              'title' => 'Nombre de la clase del controlador',
                                                                              'placeholder' => 'Hardware',
                                                                              'id' => 'name']) !!}

                                   
                                </div>
                            </div>
                            <!-- /Controlador -->

                            <!-- Url -->
                            <div class="form-group">
                                {!! Form::label('module_id', 'Nombre') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-link"></i>
                                        </span>
                                        
                                        {!! Form::text('name', null, ['class' => 'form-control',
                                                                           'title' => 'Texto que se mostrara al lado del nombre del modulo, preferiblemente poner números',
                                                                           'placeholder' => 'Nombre producto',
                                                                           'id' => 'label'
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
                                {!! Form::label('order', 'Localizacion') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        {!! Form::text('location', null, ['class' => 'form-control',
                                                                           'title' => 'Texto que se mostrara al lado del nombre del modulo, preferiblemente poner números',
                                                                           'placeholder' => 'Localizacion del producto',
                                                                           'id' => 'label'
                                    ]) !!}
                                </div>
                            </div>
                            <!-- /Verbo -->

                            <!-- Nombre de Funcion -->
                            <div class="form-group">
                                {!! Form::label('text', 'Numero Contacto') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        {!! Form::text('num_contact', null, ['class' => 'form-control',
                                                                           'title' => 'Texto que se mostrara al lado del nombre del modulo, preferiblemente poner números',
                                                                           'placeholder' => 'Numero de contacto',
                                                                           'id' => 'label'
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
                                {!! Form::label('icon', 'Fabricante') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        {!! Form::text('maker', null, ['class' => 'form-control',
                                                                           'title' => 'Texto que se mostrara al lado del nombre del modulo, preferiblemente poner números',
                                                                           'placeholder' => 'Fabricante Producto',
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
                                {!! Form::label('icon_color', 'Modelo') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        {!! Form::text('model', null, ['class' => 'form-control',
                                                                           'title' => 'Texto que se mostrara al lado del nombre del modulo, preferiblemente poner números',
                                                                           'placeholder' => 'Modelo producto',
                                                                           'id' => 'label'
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
                                {!! Form::label('label', 'Numero de serie') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        {!! Form::text('serial', null, ['class' => 'form-control',
                                                                           'title' => 'Texto que se mostrara al lado del nombre del modulo, preferiblemente poner números',
                                                                           'placeholder' => 'Numero de Serie',
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
                                {!! Form::label('label_color', 'Tecnico a cargo del hardware') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        {!! Form::text('technical_in_charge', null, ['class' => 'form-control',
                                                                           'title' => 'Texto que se mostrara al lado del nombre del modulo, preferiblemente poner números',
                                                                           'placeholder' => 'Tecnico a cargo del hardware',
                                                                           'id' => 'label'
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
                                {!! Form::label('main', 'Estado') !!}
                                <div class="input-group">
                                <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                {!! Form::text('state', null, ['class' => 'form-control',
                                                                           'title' => 'Texto que se mostrara al lado del nombre del modulo, preferiblemente poner números',
                                                                           'placeholder' => 'Indique el estado del producto',
                                                                           'id' => 'label'
                                    ]) !!}

                                    

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <!-- Nombre del método-->
                            <div class="form-group">
                                {!! Form::label('label_color', 'Hardware activo') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        {!!   Form::select('is_active', ['1' => 'Si', '0' => 'No'], null, ['class' => 'form-control',
                                                                              'title' => 'Nombre de la clase del controlador',
                                                                              'placeholder' => 'Seleccione',
                                                                              'id' => 'name']) !!}
                                </div>
                            </div>
                    </div>
                </div>

                <div class="modal-footer">
                    {!! Form::button('Cerrar', ['class'=>'btn btn-danger pull-left', 'data-dismiss'=>'modal']) !!}
                    {!! Form::button('Guardar', ['class' => 'btn btn-success pull-right','type' => 'submit']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('js')
<script type="text/javascript">
$.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
     });
var table = $('#module-table').DataTable({
            serverSide: true,
            processing: true,
            ajax: "{{ route('api.product')}}",
            columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'type_hardware', name: 'type_hardware'},
                        {data: 'location', name: 'location'},
                        {data: 'num_contact', name: 'num_contact'},
                        {data: 'maker', name: 'maker'},
                        {data: 'model', name: 'model'},
                        {data: 'serial', name: 'serial'},
                        {data: 'technical_in_charge', name: 'technical_in_charge'},
                        {data: 'state', name: 'state'},
                        {data: 'edit', name: 'edit'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]

            });

            
</script>

@endsection




