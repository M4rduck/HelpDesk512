@extends('layouts.app')

@section('content')
<div class="container">
	<div id="crud" class="row mt-5">
		<div class="col-md-12 col-md-offset-2">
		<div class="card ">
		<div class="card-header">
                <h3><i class="material-icons">assignment_turned_in</i>
                  Roles Administration
                  <button onclick="addFrom()" class="btn btn-primary float-right">
                   <i class="fas fa-id-badge"></i>  Create Roles</button>
                </h3>	
		</div>
		<div class="card-body">
      <table class="table table-hover" id="roles-table">
          <thead>
          <tr>
              <th width="30px">ID</th>
              <th>Name</th>
              <th>Display Name</th>
              <th>Description</th>
              <th></th>
          </tr>
          </thead>
          <tbody></tbody>
        </table>
    </div> 
	</div>
</div>
</div>
@include('admin.roles.create')
</div>

@endsection

@section('script')

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
                        {data: 'display_name', name: 'display_name'},
                        {data: 'description', name: 'description'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                      ]
                    });

    function addFrom()
    {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modal-form').modal('show');
        $('#modal-form form')[0].reset();
        $('.modal-title').html('<i class="material-icons">assignment_ind</i> Add Roles');
        $('#bcreate').html('<i class="fas fa-plus-circle"></i>  Create');
    }

     function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
          url: "{{ url('roles') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').html('<i class="material-icons">border_color</i> Edit Roles');
            $('#bcreate').html('<i class="fas fa-pencil-alt"></i>  Edit');
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#display_name').val(data.display_name);
            $('#description').val(data.description);
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
                  url : "{{ url('roles') }}" + '/' + id,
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
                    if (save_method == 'add') url = "{{ url('roles') }}";
                    else url = "{{ url('roles') . '/' }}" + id;
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