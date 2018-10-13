@extends('adminlte::page')

@section('title', 'HelpDesk 512')

@section('content_header')
    <h1>@lang('diagnosis/index.title_header')</h1>
@stop

@push('js')
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.0/handlebars.js') !!}
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
        <a href="{!! route('diagnosis.create') !!}">
            {!! Form::button('<span class="glyphicon glyphicon-circle-arrow-right"></span>', ['class' => 'btn btn-primary',
                                                                                              'title' => Lang::get('diagnosis/index.title_btn_create'),                                                                                            
            ]) !!}
        </a>
    </div>
@stop

@section('modal')
    
@endsection