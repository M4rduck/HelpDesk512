@extends('adminlte::page')

@section('title','Base de Conocimiento')

@push('js')
    {!! Html::script('./js/tools/loadingOverlay/loadingoverlay.min.js') !!}
    {!! Html::script('./js/system/method/table.js') !!}
@endpush

@push('css')
    <!-- Estilos para botón flotante -->
    {!! Html::style('./css/button_float.css') !!}
@endpush

@section('content')
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
        <section class="content-header">
            
            <h1><i class="fas fa-database"></i> Base de Conocimiento
            
            
            {{ Form::open(['route' => 'baseConocimiento.index', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
            <form action="#" method="post">
                <div class="input-group">
                  <input name="message" placeholder="Type Message ..." class="form-control" type="text">
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-flat">Send</button>
                      </span>
                </div>
                {!! Form::button('<i class="fas fa-plus"></i> Create', 
                    ['class'=>'btn btn-info ',
                    'data-toggle' =>'modal',
                    'onclick'=>'addFrom()',
                    'style'=>'']) !!}
            {{ Form::close() }}</h1>
            
            
        </section>
        <section class="content" id="content-body">
            
        </section>
        </div>
    </div>
@include('BaseConocimiento.modal')
@endsection

@section('js')

<script type="text/javascript">
    var contentBody = $('#content-body');
        function addFrom(){
            $('#modal').modal('show');
            $('#modal-title').text('Create Solution');
            $('#modal-body form')[0].reset();
            $('#tags').tagsinput('removeAll');
            $('#tags').tagsinput({
                maxTags: 5,
            });
        }

        function editFrom(id){
          
          $('#modal').modal('show');
          $('#modal-title').text('Edit Solution');
          $('input[name=_method]').val('PATCH');
          $('#modal-body form')[0].reset();
          contentBody.LoadingOverlay('show');
          $('#tags').tagsinput('destroy');
          $.ajax({
          url: "{{ url('baseConocimiento/edit') }}" + '/' + id,
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            contentBody.LoadingOverlay('hide', true);
            tags = [];
            $('#id').val(data.base.id);
            $('#name').val(data.base.name);
            $('#description').val(data.base.description);
            $.each(data.base.tagged, function(i,item){
                tags.push(data.base.tagged[i].tag_slug);                    

            });
            $('#tags').val(tags);
            $('#tags').tagsinput('refresh');
            $('#solution').val(data.base.solution);
          },
          error : function() {
              swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Nothing Data'
              })
          }
        });
        }
        

        $('#modal-btn-save').click(function(event){
            event.preventDefault();
            var me = $('#modal-body form'),
                url = me.attr('action'),
                method = $('input[name=_method]').val() == undefined ? 'POST' : 'PATCH';

                me.find('.help-block').remove();
                me.find('.form-group').removeClass('has-error');
                
            $.ajax({
                url : url,
                method : method,
                data : me.serialize(),
                success: function (response){
                    me.trigger('reset');
                    loadBody();
                    $('#modal').modal('hide');
                    swal({
                        type : 'success',
                        title : 'Success!',
                        text : 'Data has been saved!'
                    });
                },
                error: function (xhr){
                    var  res = xhr.responseJSON;
                    if ($.isEmptyObject(res) == false) {
                        $.each(res.errors, function (key, value) {
                            $('#' + key)
                                .closest('.form-group')
                                .addClass('has-error')
                                .append('<span class="help-block"><strong>' + value + '</strong></span>');
                        });
                    }
                }

            })    


        });
        
        function loadBody(){
            contentBody.LoadingOverlay('show');
            @if(session()->has('category'))
                contentBody.LoadingOverlay('hide', true);
                cuerpo = {!! session()->get('category') !!};
                contentBody.html(cuerpo);
            @elseif(session()->has('tag'))
                contentBody.LoadingOverlay('hide', true);
                cuerpo = {!! session()->get('tag') !!};
                contentBody.html(cuerpo);
            @else
                $.getJSON('{!! route('BaseConocimiento.loadBody') !!}')
                .done(function(data){
                    contentBody.LoadingOverlay('hide', true);
                    if(!data.error){
                        contentBody.html(data.body);                        
                    }else{                    
                        swal({
                            title: data.title,
                            text: data.text,
                            icon: "error"
                        });
                    }                
                });
            @endif
            
        }

        

        loadBody();
        $(document).on('click', '.pagination a', function(event){            
            contentBody.LoadingOverlay('show');
            event.preventDefault();
            paginador = $(this).attr('href').split('page')[1];
           ruta = '{!! route('BaseConocimiento.loadBody') !!}'+'?page'+paginador;
            


            $.getJSON(ruta)
            .done(function(data){
                contentBody.LoadingOverlay('hide', true);
                if(!data.error){
                    contentBody.html(data.body);                    
                }
            })
            .fail(function(jqXHR, textStatus){
                contentBody.LoadingOverlay('hide', true);
                console.log(jqXHR);
            });
        });
</script>
@endsection