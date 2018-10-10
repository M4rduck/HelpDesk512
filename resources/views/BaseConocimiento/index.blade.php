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
                'onclick'=>'',
                'style'=>'margin-top: -8px;']) !!}
                <a href="{{ route('baseConocimiento.create') }}" class="btn btn-primary pull-right modal-show" style="margin-top: -8px;" title="Create User"><i class="icon-plus"></i> Create</a></h1>
        </section>
        <section class="content" id="content-body">
            
        </section>
    </div>
@include('BaseConocimiento.modal')
@endsection

@section('js')

<script type="text/javascript">
        function loadBody(){
            $.getJSON('{!! route('BaseConocimiento.loadBody') !!}')
            .done(function(data){
                console.table(data);
                if(!data.error){
                    $('#content-body').html(data.body);
                }else{
                    swal({
                        title: data.title,
                        text: data.text,
                        icon: "error"
                    });
                }                
            })
        }

        loadBody();

       /*$(document).on('mousedown', '.modal-show', function (event){
            event.preventDefault();
            //$('#input').tagsinput();
            var me = $(this),
                url = me.attr('href'),
                title = me.attr('title');

            $('#modal-title').text('Create Solution');
            $('#modal-btn-save').text('Create');

            $.ajax({
                url: url,
                dataType: 'html',
                success: function (response){
                    $('#modal-body').html(response);
                } 
            });
            
            $('#modal').modal('show');

        });*/
</script>
@endsection