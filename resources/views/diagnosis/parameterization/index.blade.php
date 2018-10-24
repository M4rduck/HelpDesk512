@extends('adminlte::page')

@section('title', 'HelpDesk 512')

@section('content_header')
    <h1>@lang('diagnosis/index.title_header')</h1>
@stop

@push('js')
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.0/handlebars.js') !!}
    <script>
            $('#form-diagnosis-table').DataTable();

            $(document).on('click', '.form-diagnosis-delete', function(){
                swal({
                    title: 'Eliminar',
                    text: 'Deseas eliminar este diagnostico?',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                });
            });
    </script>
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
                    <h1 class="box-title">@lang('diagnosis/index.title_header_box')</h1>
                </div>

                <!-- Box Body -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="form-diagnosis-table" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripcion</th>                                
                                <th>Solicitud</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Diagnosis</td>
                                    <td>Descripcion del tecnico al realizar la incidencia</td>
                                    <td>No esta parametrizado a ninguna solicitud</td>
                                    <td>
                                        {!! Form::button('<i class="glyphicon glyphicon-edit"></i> Asignar', ['class' => 'btn btn-xs btn-primary form-diagnosis-assign', 'data-toggle'=>"modal", 'data-target'=>"#form-diagnosis-modal"]) !!}
                                        {!! Form::button('<i class="glyphicon glyphicon-edit"></i> Editar', ['class' => 'btn btn-xs btn-success form-diagnosis-edit']) !!}
                                        {!! Form::button('<i class="glyphicon glyphicon-edit"></i> Eliminar', ['class' => 'btn btn-xs btn-danger form-diagnosis-delete']) !!}
                                    </td>
                                </tr>
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
    <div class="absolute bottom-btn">
        <a href="{!! route('diagnosis.create') !!}">
            {!! Form::button('<span class="glyphicon glyphicon-circle-arrow-right"></span>', ['class' => 'btn btn-primary',
                                                                                              'title' => Lang::get('diagnosis/index.title_btn_create'),                                                                                            
            ]) !!}
        </a>
    </div>
@stop

@section('modal')
    <!-- Modal -->
    <div id="form-diagnosis-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
      
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header bg-yellow">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Asignar a Solicitud</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                          {!! Form::label('solicitude_id', 'Solicitud') !!} <br>
                          {!! Form::select('solicitude_id', $solicitudes, null, ['placeholder' => 'Selecciona la solicitud','id' => 'solicitude_id']) !!}
                      </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Guardar</button>
            </div>
          </div>
      
        </div>
      </div>    
@endsection