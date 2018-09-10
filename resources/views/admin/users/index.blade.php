@extends('adminlte::page')

@section('title','Users')

@section('content_header')
    <h1>Users </h1>
@stop

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
                Administration
                {!! Form::button('<span class="glyphicon glyphicon-user"></span> Create Users', 
                ['class'=>'btn btn-primary pull-right',
                'data-toggle' =>'modal',
                'onclick'=>'addFrom()']) !!}
            </div>
            

        <!--Box body -->
        <div class="box-body">
            <div class="table-responsive">
            <table class="table table-striped" id="users-table">
                <thead>
                <tr>
                    <th width="30px">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Speciality</th>
                    <th>Options</th>
                    
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
</div>
@include('admin.users.create')
</div>

@endsection

@section('js')

	<script type="text/javascript">
     $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
     });
    var table = $('#users-table').DataTable({
                      processing: true,
                      serverSide: true,
                      ajax: "{{ route('api.users') }}",
                      columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
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
        $('#roles').select2({
            width:'100%'
        });
        $('#speciality').select2({
            width:'100%'
        });
        $('form-users').validator();
    }

     function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
          url: "{{ url('admin/users') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').html('<i class="fas fa-user-edit"></i> Edit Users');
            $('#bcreate').html('<i class="fas fa-pencil-alt"></i>  Edit');
            $('#id').val(data.user.id);
            $('#name').val(data.user.name);
            $('#email').val(data.user.email);
            $('#roles').find('option').remove();
            $.each(data.user.roles, function(i,item){
                $('#roles').append('<option value="' + data.user.roles[i].id + '" selected>' 
                                    + data.user.roles[i].name + '</option>');
            });
            $('#roles').select2({
            width:'100%'
            });
            $('#speciality').select2({
            width:'100%'
        });
            
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
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
               $.ajax({
                  url : "{{ url('admin/users') }}" + '/' + id,
                  type : "POST",
                  data : {'_method' : 'DELETE', '_token' : csrf_token},
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
                        url = "{{ url('admin/users') }}";
                    else 
                        url = "{{ url('admin/users') . '/' }}" + id;
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