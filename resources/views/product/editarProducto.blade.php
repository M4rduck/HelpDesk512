@extends('adminlte::page')

@section('title', 'HelpDesk512 - Productos')

@section('content_header')
    <h1>software</h1>
@stop

@push('css')
    <!-- Estilos para botón flotante -->
    {!! Html::style('./css/button_float.css') !!}
@endpush

@section('content')

<div class="container">
        <div class="col-lg-6 col-sm-12">
                <div class="box">
    
                    <div class="box-header with-border">
                        <h1 class="box-title">Editar datos</h1>
                    </div>
{!! Form::model($infoProductoSoft, ['route' => ['product.actualizar', $infoProductoSoft], 'method' => 'PATCH', 'files' => true] ) !!}
    
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
                                                               'name' => 'name'
                        ]) !!}
                    </div>

                    {!! Form::label('module_id', 'Descripción') !!}
                    <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-link"></i>
                            </span>
                            
                            {!! Form::text('descritpion', null, ['class' => 'form-control',
                                                               'name' => 'descritpion'
                        ]) !!}
                    </div>

                    {!! Form::label('module_id', 'Serial') !!}
                    <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-link"></i>
                            </span>
                            
                            {!! Form::text('serial', null, ['class' => 'form-control',
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
                     {!!   Form::select('has_module', [1 => 'Si', 0 => 'No' ], null, ['class' => 'form-control',
                                                              'name' => 'has_module']) !!}                           
                    </div>
                    
                    {!! Form::label('method_id', 'Licencia') !!}
                    <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-cog"></i>
                            </span>
                         {!!   Form::select('has_license' , [1 => 'Si', 0 => 'No' ], null, ['class' => 'form-control',
                                                                  'name' => 'has_license']) !!}                               
                    </div>
                
                        {!! Form::label('method_id', 'Activo') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-cog"></i>
                            </span>
                         {!!   Form::select('is_active', [1 => 'Si', 0 => 'No' ], null, ['class' => 'form-control',
                                                                  'name' => 'is_active']) !!}                           
                        </div>

                        {!! Form::label('method_id', 'Borrado') !!}
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-cog"></i>
                                </span>
                             {!!   Form::select('is_deleted' , [1 => 'Si', 0 => 'No' ], null, ['class' => 'form-control',
                                                                      'name' => 'is_deleted']) !!}                               
                        </div>

                    </div>
                    
            </div>

       
    

<div class="modal-footer">

        <a class="btn btn-danger pull-left" href="/HelpDesk512/public/producto/software">Cancelar</a>

    {!! Form::submit('Aceptar', ['class' => 'btn btn-primary pull-right']) !!}

        {!! Form::close() !!}

    </div>
</div>      
</div>
        @endsection()