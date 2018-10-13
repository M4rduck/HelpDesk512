@extends('adminlte::page')

@section('title', 'HelpDesk512 - Hardware')

@section('content_header')
    <h1>Hardware</h1>
@stop

@push('css')
    <!-- Estilos para botón flotante -->
    {!! Html::style('./css/button_float.css') !!}
@endpush

@section('content')






<div class="btn-toolbar" role="toolbar">

    <div class="btn-group">
        {!! Form::button('<span class="glyphicon glyphicon-circle-arrow-right"></span> Registrar Software ', 
        ['class' => 'btn btn-primary',
        'title' => 'Crear Producto',
        'data-toggle' =>'modal',
        'data-target'=>'#modalSoft'
        ]) !!}
    </div>
</div>





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
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Serial</th>
                                <th>Modulo ( 1 -> Si, 0 -> No )</th>
                                <th>Licencia ( 1 -> Si, 0 -> No )</th>
                                <th>Activo ( 1 -> Si, 0 -> No )</th>
                                <th>Borrado ( 1 -> Si, 0 -> No )</th>
                                <th>Acciones</th>       
                            </tr>
                        </thead>

                        <tbody>
                           @foreach ($prodSoft as $infoProductoSoft)
                            <tr>
                            <td>{{ $infoProductoSoft->id }}</td>
                            <td>{{ $infoProductoSoft->name }}</td>
                            <td>{{ $infoProductoSoft->descritpion }}</td>
                            <td>{{ $infoProductoSoft->serial }}</td>
                            <td>{{ $infoProductoSoft->has_module}}</td>
                            <td>{{ $infoProductoSoft->has_license }}</td>
                            <td>{{ $infoProductoSoft->is_active }}</td>
                            <td>{{ $infoProductoSoft->is_deleted }}</td>
                            <td><a class="btn btn-primary" href="#">Ver mas</a>
                                <a class="btn btn-primary" href="/HelpDesk512/public/producto/software/{{ $infoProductoSoft->id }}/edit">Editar</a>
                                {!! Form::open([ 'route' => ['product.destroy', $infoProductoSoft->id], 'method' => 'DELETE']) !!}
                                {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                              {!! Form::close() !!}</td>
                            </tr>
                            @endforeach
                        </tbody>
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














<div id="modalSoft" class="modal fade" role="dialog">
    <div class="modal-dialog">
        {!! Form::open(['route' => 'product.store']) !!}
        <div class="modal-content">
            <div class="modal-header bg-warning">
                {!! Form::button('&times;', ['class'=>'close', 'data-dismiss'=>'modal']) !!}
                <h4 class="modal-title">Registrar Software</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            
                            {!! Form::label('module_id', 'Nombre') !!}
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-link"></i>
                                    </span>
                                    
                                    {!! Form::text('Nombre', null, ['class' => 'form-control',
                                                                      'placeholder' => 'Nombre producto',
                                                                       'name' => 'name'
                                ]) !!}
                            </div>

                            {!! Form::label('module_id', 'Descripción') !!}
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-link"></i>
                                    </span>
                                    
                                    {!! Form::text('Descripcion', null, ['class' => 'form-control',
                                                                      'placeholder' => 'Descripción del producto',
                                                                       'name' => 'descritpion'
                                ]) !!}
                            </div>

                            {!! Form::label('module_id', 'Serial') !!}
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-link"></i>
                                    </span>
                                    
                                    {!! Form::text('Serial', null, ['class' => 'form-control',
                                                                       'placeholder' => 'Nombre producto',
                                                                       'name' => 'serial'
                                ]) !!}
                            </div>
                            {!! Form::label('method_id', 'Modulo') !!}
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-cog"></i>
                                </span>
                             {!!   Form::select('Software', [ null => '- - -' , 1 => 'Si', 0 => 'No' ], null, ['class' => 'form-control',
                                                                      'name' => 'has_module']) !!}                           
                            </div>
                            
                            {!! Form::label('method_id', 'Licencia') !!}
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-cog"></i>
                                    </span>
                                 {!!   Form::select('Software' , [ null => '- - -' , 1 => 'Si', 0 => 'No' ], null, ['class' => 'form-control',
                                                                          'name' => 'has_license']) !!}                               
                            </div>
                        
                                {!! Form::label('method_id', 'Activo') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-cog"></i>
                                    </span>
                                 {!!   Form::select('Software', [ null => '- - -' , 1 => 'Si', 0 => 'No' ], null, ['class' => 'form-control',
                                                                          'name' => 'is_active']) !!}                           
                                </div>

                                {!! Form::label('method_id', 'Borrado') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-cog"></i>
                                        </span>
                                     {!!   Form::select('Software' , [ null => '- - -' , 1 => 'Si', 0 => 'No' ], null, ['class' => 'form-control',
                                                                              'name' => 'is_deleted']) !!}                               
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
</div>





































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
                                     {!!   Form::select('Hardware', ['Computador' => 'Computador', 'Impresora' => 'Impresora', 'telefono'=> 'Telefono', 'dispositivo'=>'Dispositivo'], null, ['class' => 'form-control',
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
                                        
                                        {!! Form::text('Nombre', null, ['class' => 'form-control',
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
                                        {!! Form::text('localizacion', null, ['class' => 'form-control',
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
                                        {!! Form::text('numeroC', null, ['class' => 'form-control',
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
                                        {!! Form::text('fabricante', null, ['class' => 'form-control',
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
                                        {!! Form::text('modelo', null, ['class' => 'form-control',
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
                                        {!! Form::text('numeroS', null, ['class' => 'form-control',
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
                                        {!! Form::text('tecnico', null, ['class' => 'form-control',
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
                                {!! Form::text('Estado Producto', null, ['class' => 'form-control',
                                                                           'title' => 'Texto que se mostrara al lado del nombre del modulo, preferiblemente poner números',
                                                                           'placeholder' => 'Indique el estado del producto',
                                                                           'id' => 'label'
                                    ]) !!}
                                </div>
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

