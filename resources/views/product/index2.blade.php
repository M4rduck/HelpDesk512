@extends('adminlte::page')

@section('title', 'HelpDesk512 - Software')

@section('content_header')
    <h1>Software</h1>
@stop

@push('js')
    {!! Html::script('./js/system/method/table.js') !!}
@endpush
@push('css')
    <!-- Estilos para botón flotante -->
    <!-- {!! Html::style('./css/button_float.css') !!} -->


    {!! Html::style('./css/button_float.css') !!}

@endpush

@section('content')
        
<div class="btn-toolbar" role="toolbar">

    <div class="btn-group">
    {!! Form::button('<span class="glyphicon glyphicon-user"></span> Registrar Software', 
                ['class'=>'btn btn-primary pull-right',
                'data-toggle' =>'modal',
                'onclick'=>'addFrom()']) !!}
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="box">

                <div class="box-header with-border">
                    <h1 class="box-title">Listado</h1>
                </div>

                <!-- Box Body -->
                <div class="box-body">
                    <div class="table-responsive">
                  
                        <table class="table table-striped" id="myTable">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Serial</th>
                                <th>Licencia</th>
                                <th>Editor</th>
                                <th>Versiones</th>
                                <th>Estado</th>
                                <th>Acciones</th>       
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
        @include('product.editarSoftware')
    </div>

@stop
    @section('js')
    <script type="text/javascript">
        $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
         });
        var table = $('#myTable').DataTable({
            serverSide: true,
            processing: true,
            ajax: "{{ route('api.software')}}",
            columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'descritpion', name: 'descritpion'},
                        {data: 'serial', name: 'serial'},
                        {data: 'license', name: 'license'},
                        {data: 'editor', name: 'editor'},
                        {data: 'versions', name: 'versions'},
                        {data: 'edit', name: 'edit'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]

            });

            function addFrom()
    {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modal-form').modal('show');
        $('#modal-form form')[0].reset();
        $('.modal-title').html('<i class="fas fa-user-plus"></i> Añadir Software');
        $('#bcreate').html('<i class="fa fa-plus-circle"></i>  Crear');
        $('#category').select2({
            width:'100%'
        });
        $('#form-users').validator();
    
    }

    function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
          url: "{{ url('producto/software') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').html('<i class="fas fa-user-edit"></i> Editar Hardware');
            $('#bcreate').html('<i class="fas fa-pencil-alt"></i>  Edit');
            $('#id').val(data.soft.id);
            $('#name').val(data.soft.name);
            $('#descritpion').val(data.soft.descritpion);
            $('#serial').val(data.soft.serial);
            $('#license').val(data.soft.license);
            $('#editor').val(data.soft.editor);
            $('#versions').val(data.soft.versions);
            $('#category_id').val(data.soft.category_id);
            

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

      function deleteData(id){
          var csrf_token = $('meta[name="csrf-token"]').attr('content');
          swal({
              title: 'Esta seguro?',
              text: "Esta seguro de desactivar registro!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            }).then((value) => {
                if (value) {
               $.ajax({
                  url : "{{ url('producto/sotfware') }}" + '/' + id,
                  type : "DELETE",
                  dataType : "json",
                  success : function(data) {
                      table.ajax.reload();
                       swal({
                          title: 'Success!',
                          text: data.message,
                          type: 'success',
                          timer: '1500'
                      })
                  },
                  error : function () {
                    swal({
                          title: 'Oops...',
                          text:  data.message,
                          type:  'error',
                          timer: '1500'
                      })
                  }
              });
              }
            });
        }

       $(function(){
            $('#modal-form form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    if (save_method == 'add') 
                        url = "{{ url('producto/software') }}";
                    else 
                        url = "{{ url('producto/software') . '/' }}" + id;
                    $.ajax({
                        url : url,
                        type : "POST",
                        data: new FormData($("#modal-form form")[0]),
                        contentType: false,
                        processData: false,
                        success : function(data) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error : function(data){
                            swal({
                                title: 'Oops...',
                                text:  'Data Error',
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });
                    return false;
                }
            });
        });
</script>


@endsection

