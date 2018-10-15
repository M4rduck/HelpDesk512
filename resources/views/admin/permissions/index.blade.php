@extends('adminlte::page')

@section('title','Permisos')

@section('content_header')
    <h1>Permissions </h1>
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
                Permissions Manager
                {!! Form::button('<span  class="fas fa-user-shield"></span> Create Permissions', 
                ['class'=>'btn btn-primary pull-right',
                'data-toggle' =>'modal',
                'onclick'=>'addFrom()']) !!}
            </div>
            

        <!--Box body -->
        <div class="box-body">
            <div class="table-responsive">
            <table class="table table-striped" id="permissions-table">
                <thead>
                <tr>
                    <th width="30px">ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Options</th>
                 </tr>
                </thead>
            </table>
            </div>
            
            </div>
        </div>
        <!--Box body -->
        <div class="box-footer">
        </div>
	</div>
</div>
</div>
@include('admin.permissions.create')
</div>

@endsection

@section('js')

	<script type="text/javascript">
     $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
     });
    var table = $('#permissions-table').DataTable({
                      processing: true,
                      serverSide: true,
                      ajax: "{{ route('api.permissions') }}",
                      columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'slug', name: 'slug'},
                        {data: 'edit', name: 'edit'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                      ]
                    });

    
                    
   
                    CKEDITOR.config.height= 200;
                    CKEDITOR.config.widht='auto';
                    CKEDITOR.replace('description',{toolbar: [ 
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-',] }, 
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] }, 
                    { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] }, 
                    ]});
                    
                   


    function addFrom()
    {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modal-form').modal('show');
        $('#modal-form form')[0].reset();
        $('.modal-title').html('<i class="fas fa-user-shield"></i> Add Permissions');
        $('#bcreate').html('<i class="fa fa-plus-circle"></i>  Create');
        $('#form-permissions').validator();
       
        CKEDITOR.instances['description'].setData('',function(){
            instances.destroy();
        });
      
             
           
               

           
    }

     function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
          url: "{{ url('admin/permissions') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').html('<i class="fas fa-user-shield"></i> Edit Permissions');
            $('#bcreate').html('<i class="fas fa-pencil-alt"></i>  Edit');
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#slug').val(data.slug);
            CKEDITOR.instances['description'].setData(data.description);
        
           
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
                  url : "{{ url('admin/permissions') }}" + '/' + id,
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
                    if (save_method == 'add') url = "{{ url('admin/permissions') }}";
                    else url = "{{ url('admin/permissions') . '/' }}" + id;
                    
                    for (instance in CKEDITOR.instances){
                        CKEDITOR.instances[instance].updateElement();
                        /*CKEDITOR.instances[$('#description')].setData("");*/
                    }
                   
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