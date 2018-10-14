@extends('adminlte::page')

@section('title', 'HelpDesk 512')

@section('content_header')
    <h1>@lang('diagnosis/create.title_header')</h1>
@stop

@push('js')
    <!-- Input -->
    {!! Html::script('./js/diagnosis/create/input.js') !!}

    <!-- Store -->
    {!! Html::script('./js/diagnosis/create/store.js') !!}
@endpush

@push('css')
    <!-- Estilos para botón flotante -->
    {!! Html::style('./css/button_float.css') !!}
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-warning">

                <div class="box-header with-border">
                    <h1 class="box-title">@lang('diagnosis/create.title_header_box')</h1>
                </div>

                <!-- Box Body -->
                <div class="box-body">
                    <div class="row">
                        {!! Form::hidden('route-input-index', route('input.index'), ['id' => 'route-input-index']) !!}
                        <div class="col-lg-4 col-xs-12" id="camposPersonalizados">
                            
                        </div>

                        <div class="col-lg-8 col-xs-12" id="">
                            <!-- -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('name', Lang::get('diagnosis/create.form-name')) !!}
                                        {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>  
                            <!-- -->                          
                        </div>
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
                                                                                          'title' => Lang::get('diagnosis/create.title_btn_create'),  
                                                                                          'data-toggle' =>'modal',
                                                                                          'data-target'=>'#modal-create-field'                                                                                          
        ]) !!}
    </div>
@stop

@section('modal')
     <!-- Modal -->
     <div id="modal-create-field" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                {!! Form::open(['route' => 'input.store', 'id' => 'form-create-input']) !!}
                <div class="modal-header bg-warning">
                    {!! Form::button('&times;', ['class'=>'close', 'data-dismiss'=>'modal']) !!}
                    <h4 class="modal-title">Registrar</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                {!! Form::label('name', Lang::get('diagnosis/create.label_name_create_field')) !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                    </span>
                                    {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                {!! Form::label('input_type_id', Lang::get('diagnosis/create.label_description_create_field')) !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fas fa-file-alt"></i>
                                    </span>
                                    {!! Form::select('input_type_id', $inputs, null, ['id' => 'input_type_id', 'class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                         </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">                            
                            <div class="form-group">
                                {!! Form::label('description', Lang::get('diagnosis/create.label_description_create_field')) !!}
                                {!! Form::textarea('description', null, ['id' => 'description', 'class' => 'form-control', 'rows' => 2]) !!}
                            </div>                         
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    {!! Form::button('Close', ['class'=>'btn btn-error pull-left', 'data-dismiss'=>'modal']) !!}
                    {!! Form::button('guardar', ['class' => 'btn btn-success pull-right','type' => 'submit']) !!}
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
    <!-- MODAL -->
@endsection