@extends('adminlte::page')

@section('title','Roles')

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
                Roles
                {!! Form::button('<span class="glyphicon glyphicon-user"></span> Create Roles', 
                ['class'=>'btn btn-primary pull-right',
                'data-toggle' =>'modal',
                'onclick'=>'addFrom()']) !!}
            </div>
            

        <!--Box body -->
        <div class="box-body">
            <div class="table-responsive">
            <table class="table table-striped" id="roles-table">
          <thead>
          <tr>
              <th width="30px">ID</th>
              <th>Name</th>
              <th>Slug</th>
              <th>Description</th>
              <th>Special</th>
              <th></th>
          </tr>
          </thead>
          <tbody></tbody>
        </table>
            </div>
        </div>
        <!--Box body -->
        <div class="box-footer">
        </div>
	</div>
</div>
</div>
@include('admin.roles.create')
</div>

@endsection

@section('js')

	<script type="text/javascript">
     $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
     });
    var table = $('#roles-table').DataTable({
                      processing: true,
                      serverSide: true,
                      ajax: "{{ route('api.roles') }}",
                      columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'slug', name: 'slug'},
                        {data: 'description', name: 'description'},
                        {data: 'edit', name: 'edit'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                      ]
                    });

    function addFrom()
    {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modal-form').modal('show');
        $('#modal-form form')[0].reset();
        $('.modal-title').html('<i class="fas fa-id-badge"></i> Add Roles');
        $('#bcreate').html('<i class="fa fa-plus-circle"></i>  Create');
        $('#special').select2({
            width:'100%'
        });
        $('#permissions').select2({
            width:'100%'
        });
    }

    $(document).on('change', '#special', function() {
        
        switch($(this).val()){
            case "all-access": 
            valores = [];
            $('#permissions').attr('disabled', false);
            $("#permissions>option").each(function(idx, obj){
                valores.push($(obj).val());
            });
            $('#permissions').val(valores).trigger('change');
            break;

            case "no-access":
            $('#permissions').attr('disabled', true);
            $('#permissions').val(null).trigger('change');
            break;

            case "null":
            $('#permissions').attr('disabled', false);
            $('#permissions').val(null).trigger('change');
            break;

        }
    });

     function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
          url: "{{ url('admin/roles') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            permissions = [];
            $('#modal-form').modal('show');
            $('.modal-title').html('<i class="fas fa-id-badge"></i> Edit Roles');
            $('#bcreate').html('<i class="fas fa-pencil-alt"></i>  Edit');
            $('#id').val(data.roles.id);
            $('#name').val(data.roles.name);
            $('#slug').val(data.roles.slug);
            $('#description').val(data.roles.description);
            $('#special').val(data.roles.special);
            $('#special').select2({width:'100%'});
            
            $.each(data.roles.permissions, function(i,item){
                permissions.push(data.roles.permissions[i].id);                    

            });


            $('#permissions').val(permissions).change();
            $('#permissions').select2({width:'100%'});
            
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
                  url : "{{ url('admin/roles') }}" + '/' + id,
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
                    if (save_method == 'add') url = "{{ url('admin/roles') }}";
                    else url = "{{ url('admin/roles') . '/' }}" + id;
                    $.ajax({
                        url : url,
                        type : "POST",
//                        data : $('#modal-form form').serialize(),
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
                                text: data.message,
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