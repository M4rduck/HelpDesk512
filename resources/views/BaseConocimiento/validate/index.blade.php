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
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de Entradas 
                </div>

                <div class="panel-body" id="content-body">

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
var contentBody = $('#content-body');
function editBase(id){
   swal({
            title: 'Esta seguro de activar esta Entrada ?',
            type:  'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar!',
            cancelButtonText: 'Cancelar',
            }).then((result) => {
              if (result.value) {
               $.ajax({
                  url : "{{ url('baseConocimiento/validate') }}" + '/' + id,
                  type : "PUT",
                  data:  {'id': id}, 
                success : function(data) {
                    loadValidate();
                      swal(
                                'Activado !',
                                'Activado con éxito.',
                                'success'
                            )
                        
                  },
                  error : function () {
                    swal({
                          title: 'Oops...',
                          text:  'No puede ser activado.',
                          type:  'error',
                          timer: '1500'
                      })
                  }
              });
              }
            });
}
function loadValidate(){
            contentBody.LoadingOverlay('show');
                $.getJSON('{!! route('baseConocimiento.loadValidate') !!}')
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
            
            
        }
        loadValidate();
</script>
@endsection