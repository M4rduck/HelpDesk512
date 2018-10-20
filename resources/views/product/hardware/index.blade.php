@extends('adminlte::page')

@section('title', 'HelpDesk512 - Hardware')

@section('content_header')
    <h1>Hardware</h1>
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

	<div class="row">
		<div class="col-lg-12">
		<div class="box">

        <!--Box title -->
            <div class="box-header with-border">
                <h1>
                Listado
                {!! Form::button('<span class="glyphicon glyphicon-user"></span> Crear Hardware', 
                ['class'=>'btn btn-primary pull-right',
                'data-toggle' =>'modal',
                'onclick'=>'addFrom()']) !!}
            </div>
            

        <!--Box body -->
        <div class="box-body">
            <div class="table-responsive">
                        <table class="table table-striped" id='module-table'>
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Tipo de hardware</th>
                                <th>Localizacion</th>
                                <th>Numero de contacto</th>
                                <th>Fabricante</th>
                                <th>Modelo</th>
                                <th>Numero de serie</th>
                                <th>Tecnico a cargo del hardware</th>
                                <th>Estado</th>
                                <th>Descripcion</th>
                                <th>Hardware activo</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                           
                        </table>
                    </div>
        </div>
        <!--Box body -->
        <div class="box-footer">
        
	</div>
</div>
</div>
@include('product.hardware.editHard')
</div>

@stop

@section('js')
<script type="text/javascript">
$.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
     });
var table = $('#module-table').DataTable({
            serverSide: true,
            processing: true,
            ajax: "{{ route('api.hardware')}}",
            columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'type_hardware', name: 'type_hardware'},
                        {data: 'location', name: 'location'},
                        {data: 'num_contact', name: 'num_contact'},
                        {data: 'maker', name: 'maker'},
                        {data: 'model', name: 'model'},
                        {data: 'serial', name: 'serial'},
                        {data: 'technical_in_charge', name: 'technical_in_charge'},
                        {data: 'state', name: 'state'},
                        {data: 'description', name: 'description'},
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
        $('.modal-title').html('<i class="fas fa-user-plus"></i> Add Users');
        $('#bcreate').html('<i class="fa fa-plus-circle"></i>  Create');
        $('#type_hardware').select2({
            width:'100%'
        });
        $('#form-users').validator();
    
    }

      function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
          url: "{{ url('producto/hardware') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').html('<i class="fas fa-user-edit"></i> Editar Hardware');
            $('#bcreate').html('<i class="fas fa-pencil-alt"></i>  Edit');
            $('#id').val(data.hard.id);
            $('#type_hardware').val(data.hard.type_hardware);
            $('#name').val(data.hard.name);
            $('#location').val(data.hard.location);
            $('#num_contact').val(data.hard.num_contact);
            $('#maker').val(data.hard.maker);
            $('#model').val(data.hard.model);
            $('#serial').val(data.hard.serial);
            $('#technical_in_charge').val(data.hard.technical_in_charge);
            $('#state').val(data.hard.state);
            $('#description').val(data.hard.description);
            

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
                  url : "{{ url('producto/hardware') }}" + '/' + id,
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
                        url = "{{ url('producto/hardware') }}";
                    else 
                        url = "{{ url('producto/hardware') . '/' }}" + id;
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




