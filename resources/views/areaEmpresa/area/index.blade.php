@extends('adminlte::page')

@push('js')
    {!! Html::script('./js/loadingoverlay.min.js')  !!}

    {!! Html::script('./js/areaEmpresa/area/table.js')  !!}

    {!! Html::script('./js/areaEmpresa/area/store.js')  !!}    

    {!! Html::script('./js/areaEmpresa/area/edit.js')  !!}   

    {!! Html::script('./js/areaEmpresa/area/delete.js')  !!}   
@endpush

@push('css')
    <!-- Estilos para botón flotante -->
    {!! Html::style('./css/button_float.css') !!}
@endpush

@section('content_header')
    <h1>Area </h1>
@stop

 @section('content') 
    {!! Form::hidden('area-id', $id, ['id'=>'area-id']) !!}
    <div class="box">
        <div class="box-header">

        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table id="area-table" class="table table-striped">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Extencion</th>
                        <th>Email</th>
                        <th>Descripcion</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="absolute bottom-btn">
        {!! Form::button('<span class="fa fa-plus"></span>', ['class' => 'btn btn-primary',
                                                                                          'title' => 'Crear Area',
                                                                                          'data-toggle' =>'modal',
                                                                                          'data-target'=>'#Area'
        ]) !!}
    </div>
 @stop

 @section('modal')
<!-- Modal -->
 <div id="Area" class="modal fade" role="dialog">
  <div class="modal-dialog">

     <!-- Modal content-->
            <div class="modal-content">
                {!! Form::open(['route' => 'area.store', 'id' => 'form-store']) !!}
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Crear Area</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Nombre & Extencion -->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Nombre -->
                            <div class="form-group">
                                {!! Form::label('nameA', 'Nombre') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-braille"></i>
                                    </span>
                                    {!! Form::text('area[name]', null, ['class' => 'form-control',
                                                                              'title' => 'Nombre del area',
                                                                              'placeholder' => 'Nombre del area',
                                                                              'id' => 'nameA',
                                                                              'required'=>true
                                    ]) !!}
                                </div>
                            </div>

                            <!-- /Nombre-->

                            <!-- extencion -->
                            <div class="form-group">
                                {!! Form::label('exten', 'Extencion') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-phone-square "></i>
                                    </span>
                                    {!! Form::text('area[extension]', null, ['class' => 'form-control',
                                                                             'title' => 'Estencion de area',
                                                                             'placeholder' => 'Numero de la extencion',
                                                                             'id' => 'exten',
                                                                             'required'=>true
                                    ]) !!}
                                </div>
                            </div><!-- /extencion -->
                        </div>
                        <!-- /nombre & extencion -->

                        <!-- email & descripcion -->
                        <div class="col-lg-6 col-sm-12">
                            <!-- email -->
                            <div class="form-group">
                                {!! Form::label('email', 'Correo') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope-square "></i>
                                    </span>
                                    {!! Form::text('area[email]', null, ['class' => 'form-control',
                                                                                       'title' => 'Correo del area',
                                                                                       'placeholder' => 'Descripcion del area',
                                                                                       'id' => 'email',
                                                                                       'required'=>true
                                    ]) !!}
                                </div>
                            </div>
                            <!-- email-->

                            <!-- descripcion-->
                            <div class="form-group">
                                {!! Form::label('description', 'Descripcion') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-pencil-square-o "></i>
                                    </span>
                                    {!! Form::text('area[description]', null, ['class' => 'form-control',
                                                                                       'title' => 'Descripcion del area',
                                                                                       'placeholder' => 'Desripcion del area',
                                                                                       'id' => 'description'
                                    ]) !!}
                                </div>
                            </div>
                            <!-- /descripcion -->
                        </div>
                        <!-- /nombre & extencion -->
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::button('Close', ['class'=>'btn btn-default pull-left', 'data-dismiss'=>'modal']) !!}
                    {!! Form::button('Guardar', ['class' => 'btn btn-success pull-right','type' => 'submit']) !!}

                </div>
                {!! Form::close() !!}
            </div>

    </div>
  </div>

  @endsection