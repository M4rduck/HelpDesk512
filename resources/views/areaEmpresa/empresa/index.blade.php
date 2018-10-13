@extends('adminlte::page')

@section('title', 'AdminLTE')


@push('js')
    {!! Html::script('./js/areaEmpresa/enterprise/table.js')  !!}
@endpush

@section('content_header')
    <h1>Empresa</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">

        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table id="enterprise-table" class="table table-striped">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Representante Legal</th>
                        <th>Telefonos</th>
                        <th>Ciudad</th>
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
                                                              'data-target'=>'#enterprise'
        ]) !!}
    </div>
@stop

@section('modal')
<!-- Modal -->
 <div id="enterprise" class="modal fade" role="dialog">
  <div class="modal-dialog">

     <!-- Modal content-->
            <div class="modal-content">
                {!! Form::open(['route' => 'area.store', 'id' => 'form-store']) !!}
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Registrar Empresa</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Nombre & Extencion -->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Nombre -->
                            <div class="form-group">
                                {!! Form::label('business_name', 'Nombre') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-braille"></i>
                                    </span>
                                    {!! Form::text('area[business_name]', null, ['class' => 'form-control',
                                                                                'title' => 'Nombre de la empresa',
                                                                                'placeholder' => 'Nombre de la empresa',
                                                                                'id' => 'business_name',
                                                                                'required'=>true
                                    ]) !!}
                                </div>
                            </div>

                            <!-- /Nombre-->

                            <!-- extencion -->
                            <div class="form-group">
                                {!! Form::label('address', 'Direcci&oacute;n') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-phone-square "></i>
                                    </span>
                                    {!! Form::text('area[address]', null, ['class' => 'form-control',
                                                                                'title' => 'Direcci&iacute;n',
                                                                                'placeholder' => 'Direcci&iacute;n',
                                                                                'id' => 'address',
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
                                {!! Form::label('legal_representative', 'Representante Legal') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope-square "></i>
                                    </span>
                                    {!! Form::text('area[legal_representative]', null, ['class' => 'form-control',
                                                                                       'title' => 'Representante Legal',
                                                                                       'placeholder' => 'Nombre del representante legal',
                                                                                       'id' => 'legal_representative',
                                                                                       'required'=> true
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