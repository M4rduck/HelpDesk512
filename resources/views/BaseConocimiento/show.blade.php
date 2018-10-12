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
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{ $base->name }}</h1>
            <div class="panel panel-default">
                <div class="panel-heading">
                @if($base->category)
                Categoría
                <a class="sendData" href="{{route('baseConocimiento.category', $base->category->name)}}">{{ $base->category->name }}</a>
                @else
                 <em>Sin Categoría</em>
                @endif
                 <div class="pull-right">
                    <em>Score</em>
                 </div>
                </div>
                <div class="panel-body">
                {{ $base->description}}
                <hr>
                @if($base->solution)
                {!! $base->solution !!}
                @else
                 <em>No hay Solucción</em>
                @endif
                <hr>
                <div class="pull-right">
                    <em>FAQ({{ $base->sw_faq }})</em>
                </div>
                </div>
                <div class="panel-footer">
                @forelse($base->tags as $tag)
                <a class="sendData" href="{{route('baseConocimiento.tag', $tag->slug)}}">{{ $tag->name }}</a>
                @empty
                <em>Sin etiquetas</em>
                @endforelse
                
                <div class="pull-right">
                @foreach($base->users as $bases)
                Created By <em>{{ $bases->name }}</em>
                @endforeach
                 </div>
                 </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script>
$(document).on('click', '.sendData',function(event){
    console.log($(this).attr('href'));
    event.preventDefault();
    $.getJSON($(this).attr('href'))
    .done(function(data){
        if(!data.error){
            location.href = '{!! route('baseConocimiento.index') !!}';
        }else{

        }
    });
});
</script>
@endsection