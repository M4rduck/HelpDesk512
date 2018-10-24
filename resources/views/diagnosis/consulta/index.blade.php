@extends('adminlte::page')

@section('title', 'HelpDesk 512')

@section('content_header')
    <h1>@lang('diagnosis/create.title_header')</h1>
@stop

@push('js')
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12 col-xs-12">
        
        <div class="box box-warning">

            @if (is_null($formulario))
                <p>No hay diagnosis creado para esta incidencia con solicitud {!! $title_solicitude !!}</p>
            @else
                {!! Form::open(['route' => 'diganosis.storeDiagnosisTechnic']) !!}
                <div class="box-header">
                    <h3 class="box-title">{!! $formulario->name !!}</h3>                
                </div>

                <div class="box-body">
                    @foreach ($formulario->sections->chunk(2) as $sectionsChunk)
                        <div class="row">
                            @foreach ($sectionsChunk as $section)
                                <div class="col-lg-6">
                                    <p>{!! $section->name !!}</p>
                                    @foreach ($section->subSections->chunk(2) as $subSectionsChunk)
                                        <div class="row">
                                            @foreach ($subSectionsChunk as $subSection)
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        {!! Form::label($formulario->id.'_'.$section->id.'_'.$subSection->id, $subSection->name) !!}
                                                        <br>
                                                        @foreach ($subSection->fields as $field)
                                                            @include('diagnosis.consulta.input')
                                                        @endforeach
                                                    </div>                                                    
                                                </div>    
                                            @endforeach                                            
                                        </div>                                        
                                    @endforeach
                                </div>                                
                            @endforeach
                        </div>                        
                    @endforeach
                </div>

                <div class="box-footer">
                    {!! Form::button('Guardar', ['class' => 'btn btn-success pull-right', 'type' => 'submit']) !!}
                </div>
                {!! Form::close() !!}
            @endif

        </div>

    </div>
</div>
@endsection