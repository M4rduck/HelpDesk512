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
		<div class="col-lg-12">
		<div class="box">

        <!--Box title -->
            <div class="box-header with-border">
                <h1>
                Base de Conocimiento
                {!! Form::button('<i class="fas fa-search"></i> Search', 
                ['class'=>'btn btn-secundary pull-right',
                'data-toggle' =>'modal',
                'onclick'=>'']) !!}
                {!! Form::button('New', 
                ['class'=>'btn btn-primary pull-right',
                'data-toggle' =>'modal',
                'onclick'=>'']) !!}
            </div>
            

        <!--Box body -->
        <!--Alertas -->
        <div class="box-body">
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
        <!-- /Alertas -->
        <!-- panel -->                
            @foreach($bases as $base)
                    <div class="panel panel-info">
                        <div class="panel-heading">{{ $base->name }}
                        {!! Form::button('<i class="fas fa-eye"></i>',['class'=>'btn btn-primary','onclick'=>'']) !!}</div>
                        <div class="panel-body">{{ $base->solution }}</div>
                        <div class="panel-footer">
                            @forelse($base->tags as $tag)
                            <span class="label label-info">{{ $tag->name }}</span>
                            @empty
                            <em>Sin etiquetas</em>
                            @endforelse
                        </div>
                    </div>
            @endforeach
        <!-- panel -->            
        </div>
        <!--Box body -->
        <div class="box-footer">
        </div>
	</div>
</div>
</div>

</div>

@endsection

@section('js')

<script type="text/javascript">
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
</script>
@endsection