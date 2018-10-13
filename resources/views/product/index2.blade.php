@extends('adminlte::page')

@section('title', 'HelpDesk512 - Productos')

@section('content_header')
    <h1>Software</h1>
@stop

@push('css')
    <!-- Estilos para botón flotante -->
    {!! Html::style('./css/button_float.css') !!}
@endpush

@section('content')
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/jquery-3.3.1.js">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"></script>

<script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
 </script>
        
<div class="btn-toolbar" role="toolbar">

    <div class="btn-group">
        {!! Form::button('<span class="glyphicon glyphicon-circle-arrow-right"></span> Registrar Software' , 
        ['class' => 'btn btn-primary',
        'title' => 'Crear Producto',
        'data-toggle' =>'modal',
        'data-target'=>'#modalSoft'
        ]) !!}
    </div>
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
                  
                        <table class="table table-striped" id="myTable">
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
                            <td><a class="btn btn-primary" href="/HelpDesk512/public/producto/software/{{ $infoProductoSoft->id }}/edit">Editar</a>
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

  
    
<!--Modal para boton crear software --> 

<div id="modalSoft" class="modal fade" role="dialog">
    <div class="modal-dialog">
        {!! Form::open(['route' => 'product.storeSoft', 'method' => 'POST']) !!}
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
                                    
                                    {!! Form::text('name', null, ['class' => 'form-control',
                                                                      'placeholder' => 'Nombre producto',
                                                                       'name' => 'name'
                                ]) !!}
                            </div>

                            {!! Form::label('module_id', 'Descripción') !!}
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-link"></i>
                                    </span>
                                    
                                    {!! Form::text('descritpion', null, ['class' => 'form-control',
                                                                      'placeholder' => 'Descripción del producto',
                                                                       'name' => 'descritpion'
                                ]) !!}
                            </div>

                            {!! Form::label('module_id', 'Serial') !!}
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-link"></i>
                                    </span>
                                    
                                    {!! Form::text('serial', null, ['class' => 'form-control',
                                                                       'placeholder' => 'Nombre producto',
                                                                       'name' => 'serial'
                                ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                            <div class="col-lg-6 col-sm-12">
                            {!! Form::label('method_id', 'Modulo') !!}
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-cog"></i>
                                </span>
                             {!!   Form::select('has_module', [ null => '- - -' , 1 => 'Si', 0 => 'No' ], null, ['class' => 'form-control',
                                                                      'name' => 'has_module']) !!}                           
                            </div>
                            
                            {!! Form::label('method_id', 'Licencia') !!}
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-cog"></i>
                                    </span>
                                 {!!   Form::select('has_license' , [ null => '- - -' , 1 => 'Si', 0 => 'No' ], null, ['class' => 'form-control',
                                                                          'name' => 'has_license']) !!}                               
                            </div>
                        
                                {!! Form::label('method_id', 'Activo') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-cog"></i>
                                    </span>
                                 {!!   Form::select('is_active', [ null => '- - -' , 1 => 'Si', 0 => 'No' ], null, ['class' => 'form-control',
                                                                          'name' => 'is_active']) !!}                           
                                </div>

                                {!! Form::label('method_id', 'Borrado') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-cog"></i>
                                        </span>
                                     {!!   Form::select('is_deleted' , [ null => '- - -' , 1 => 'Si', 0 => 'No' ], null, ['class' => 'form-control',
                                                                              'name' => 'is_deleted']) !!}                               
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

