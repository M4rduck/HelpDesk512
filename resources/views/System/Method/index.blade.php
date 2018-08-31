@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Metodo</h1>
@stop

@push('js')
    {!! Html::script('./js/system/method/table.js') !!}
    {!! Html::script('./js/system/method/create.js') !!}
@endpush

@push('css')
    <!-- Estilos para botón flotante -->
    {!! Html::style('./css/button_float.css') !!}
    <style>
        .validators {
            display: inline-block;
            width: 60%;
            text-align: center;
            vertical-align: top;
        }
        </style>
@endpush

@section('content')
    <div class="absolute bottom-btn">
        {!! Form::button('<span class="glyphicon glyphicon-circle-arrow-right"></span>', ['class' => 'btn btn-primary',
                                                                                          'title' => 'Crear Controlador',
                                                                                          'data-toggle' =>'modal',
                                                                                          'data-target'=>'#modalCreateMethod'
        ]) !!}
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="box">

                <div class="box-header with-border">
                    <h1 class="box-title">Registrar</h1>
                </div>

                <!-- Box Body -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="method-table" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Controlador</th>
                                <th>Función</th>
                                <th>Url</th>
                                <th>Verbo</th>
                                <th>Nombre</th>
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

    <!-- modal -->
    <div id="modalCreateMethod" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id = "methodCreateVue">
                <method-create-vue :controllers = "{{ $controladores }}" route = "{{ route('method.store') }}" ></method-create-vue>
            </div>
        </div>
    </div>
    <!-- /modal -->
@endsection