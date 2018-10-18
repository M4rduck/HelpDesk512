@extends('adminlte::page')

@section('title','Categories')

@section('content_header')
    <h1>Categories</h1>
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
               Category Manager
                {!! Form::button('<i class="fas fa-file-alt"></i> Create New Category', 
                ['class'=>'btn btn-primary pull-right',
                'data-toggle' =>'modal',
                'onclick'=>'addFrom()']) !!}
            </div>
            

        <!--Box body -->
        <div class="box-body">
            <div class="table-responsive">
            <table class="table table-striped" id="categories-table">
                <thead>
                <tr>
                    <th></th>
                    <th width="30px">ID</th>
                    <th>Name</th>                    
                    <th>Description</th>
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
@include('categories.create')
</div>

@endsection

@section('js')
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.0/handlebars.js') !!}
    <script id="details-template" type="text/x-handlebars-template">
        <table class="table">
            <tbody>
            
                <tr>
                
                    <td><b>ID:</b></td>
                    <td>@{{category.id}}<td>
                    <td><b>NAME:</b></td>
                    <td>@{{category.name}}</td>
                    <td><b>DESCRIPTION</b></td>
                    <td>@{{category.description}}</td>
                    <td><b>OPTIONS:</b></td>
                    <td> 
                    <td>@{{category.sw_main}}</td>

                        <button class="btn btn-success btn-sm" onclick="editForm(@{{category.id}})">
                            <i class="fa fa-pencil-square-o"></i> Edit
                        </button>
                          
                        <button class="btn btn-danger btn-sm" href="#" onclick="deleteData(@{{category.id}})">
                            <i class="fa fa-trash"></i> Delete
                        </button>  
                          
                    </td>
                </tr>
            
            </tbody>
        </table>
    </script>
	<script type="text/javascript">
     $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
     });
    

    const template = Handlebars.compile($("#details-template").html());    
    var table = $('#categories-table').DataTable({
                      processing: true,
                      serverSide: true,
                      ajax: "{{ route('api.category') }}",
                      columns: [
                        {
                            orderable: false,
                            searchable: false,
                            data: function(data){
                                return data.category != null ? '<button class="btn btn-success details-control">+</button>' : '';
                            }
                        },
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},                        
                        {data: 'description', name: 'description'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                      ]
                    });

        $('#categories-table tbody').on('click', 'td .details-control', function(){
            const tr = $(this).closest('tr');
            const row = table.row( tr );

            if ( row.child.isShown() ) {
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                row.child( template(row.data()) ).show();
                tr.addClass('shown');
            }
        });            
        
    

    function addFrom()
    {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modal-form').modal('show');
        $('#modal-form form')[0].reset();
        $('.modal-title').html('<i class="far fa-file-alt"></i> Add Category');
        $('#bcreate').html('<i class="fa fa-plus-circle"></i>  Create');
        $('#categories').select2({
            width:'100%'
        });
        
    }

    function addFromSubCategory()
    {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modal-form').modal('show');
        $('#modal-form form')[0].reset();
        $('.modal-title').html('<i class="far fa-file-alt"></i> Add  SubCategory');
        $('#bcreate').html('<i class="fa fa-plus-circle"></i>  Create');
        $('#categories').select2({
            width:'100%'
        });
        
    }

     function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
          url: "{{ url('producto/category') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').html('<i class="fas fa-file-alt"></i> Edit Category');
            $('#bcreate').html('<i class="fas fa-pencil-alt"></i>  Edit');
            $('#categories').select2({
            width:'100%'
        });
        
            $('#name').val(data.name);
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
                  url : "{{ url('producto/category') }}" + '/' + id,
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
                        url = "{{ url('producto/category') }}";
                    else 
                        url = "{{ url('producto/category') . '/' }}" + id;
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