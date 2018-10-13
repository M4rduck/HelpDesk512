@extends('adminlte::page')

@section('title', 'HelpDesk512 - Productos')

@section('content_header')
    <h1>Hardware</h1>
@stop

@push('css')
    <!-- Estilos para botón flotante -->
    {!! Html::style('./css/button_float.css') !!}
@endpush

@section('content')

{!! Form::model($infoProductoSoft, ['route' => ['product.actualizar', $infoProductoSoft], 'method' => 'PATCH', 'files' => true] ) !!}
    
<div class="modal-body">
    <div class="row">
        <!-- Controlador & Url -->





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





       
    </div>
</div>
    {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}

        @endsection()