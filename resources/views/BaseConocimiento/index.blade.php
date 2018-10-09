@extends('adminlte::page')

@section('title','Base de Conocimiento')

@push('js')
    {!! Html::script('./js/system/method/table.js') !!}
@endpush

@push('css')
    <!-- Estilos para botón flotante -->
    {!! Html::style('./css/button_float.css') !!}
@endpush

@section('content')
	<div class="row">
        <section class="content-header">
            <h1><i class="fas fa-database"></i> Base de Conocimiento
            {!! Form::button('<i class="fas fa-search"></i> Search', 
                ['class'=>'btn btn-secundary pull-right',
                'data-toggle' =>'modal',
                'onclick'=>'']) !!}
                {!! Form::button('New', 
                ['class'=>'btn btn-primary pull-right',
                'data-toggle' =>'modal',
                'onclick'=>'viewFrom()']) !!}</h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                @if(session('info'))
                        <div class="alert alert-success">
                            {{ session('info') }}
                        </div>
                @endif
                    
                @if(count($errors))
                    <div class="alert alert-success">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    @foreach($bases->chunk(2) as $chunk)
                        <div class="row">
                            @foreach($chunk as $base)
                            <div class="col-md-6">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">{{ $base->name }}</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-toggle='modal' onclick='addFrom()'><i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                    <div class="box-body">
                                        {{ $base->description }}
                                    </div>
                                    <div class="box-footer">
                                        @forelse($base->tags as $tag)
                                        <span class="label label-info">{{ $tag->name }}</span>
                                        @empty
                                        <em>Sin etiquetas</em>
                                        @endforelse
                                    </div>   
                            </div>
                            </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@include('BaseConocimiento.create')
@endsection

@section('js')

<script type="text/javascript">
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function addFrom(){
            $('#modal-form').modal('show');
            $('#header').removeClass();
            $('#header').addClass('modal-header bg-info');
        }

        function viewFrom(){
            $('#modal-form').modal('show');
            $('#header').removeClass();
            $('#header').addClass('modal-header bg-primary');
        }

</script>
@endsection