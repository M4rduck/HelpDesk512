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
            <div class="panel panel-default" data-id="{{ $base->id }}">
                <div class="panel-heading">
                @if($base->category)
                Categoría
                <a  href="{{route('baseConocimiento.category', $base->category->name)}}">{{ $base->category->name }}</a>
                @else
                 <em>Sin Categoría</em>
                @endif
                
                <span class="like-btn pull-right">
                    <i id="like{{$base->id}}" class="glyphicon glyphicon-thumbs-up {{ auth()->user()->hasLiked($base) ? 'like-base' : '' }}"></i> <div id="like{{$base->id}}-bs3">{{ $base->likers()->get()->count() }}</div>
                </span>
                 
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
                <div class="row">
                        <div class="col-md-6"><em>Ultima actualización: {{ $base->updated_at}} </em></div>
                        <div class="col-md-4"><em>Número de visualizaciones:{{ $base->score }}</em></div>
                        <div class="col-md-2 pull-right"><em>FAQ({{ $base->sw_faq }})</em></div>
                    </div>
                </div>
                <div class="panel-footer">
                @forelse($base->tags as $tag)
                <span class="label label-primary"><a class="sendData" href="{{route('baseConocimiento.tag', $tag->slug)}}">{{ $tag->name }}</a></span>
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
$('i.glyphicon-thumbs-up, i.glyphicon-thumbs-down').click(function(){
        var id = $(this).parents(".panel").data('id');
        var c = $('#'+this.id+'-bs3').html();
        var cObjId = this.id;
        var cObj = $(this);
        const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        console.log(id,c,cObjId,cObj);
        $.ajax({
            type: 'POST',
            url : '{!! route('baseConocimiento.like') !!}',
            data: {id:id},
            success: function(data){
                if(jQuery.isEmptyObject(data.success.attached)){
                    $('#'+cObjId+'-bs3').html(parseInt(c)-1);
                    $(cObj).removeClass("like-base");
                    toast({
                        type: 'warning',
                        title: 'dislike successfully'
                    })
                }else{
                    $('#'+cObjId+'-bs3').html(parseInt(c)+1);
                    $(cObj).addClass("like-base");
                    toast({
                        type: 'success',
                        title: 'like successfully'
                    })
                    
                }
            }
        });

});

</script>
@endsection
@push('css')
{!! Html::style('css/BaseConocimiento/knowledgeBase.css') !!}
@endpush