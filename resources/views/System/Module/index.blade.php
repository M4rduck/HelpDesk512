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
    {!! Html::script('./js/system/module/create.js') !!}
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
        <div class="modal-dialog modal-lg">
            <div id="methodCreateVue">
                <method-create-vue :methods = "{{ $methods }}" :modules = "{{ $modules }}" route = "{{ route('module.store') }}" ></method-create-vue>
            </div>
        </div>
    </div>
@endsection