<!-- Modal Users -->
<div class="modal fade" id="modal-form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      
      

      {!! Form::open(array('method'=>'POST','id'=>'form-categories','class'=>'form-horizontal',
                                    'data-toggle'=>'validator','autocomplete'=>'off')) !!}
           {{ method_field('POST') }}

        <!-- Header Modal -->  
        <div class="modal-header bg-warning">
            {!! Form::button('<span aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></span>'
                              ,['class'=>'close', 'data-dismiss'=>'modal']) !!}
            <h3 class="modal-title"></h3>
             
        </div> 
       <!-- Body Modal-->
       <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" id="id" name="id">
                    <!-- Name -->
                    <div class="from-group">
                        {!! Form::label('name', 'Name') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fas fa-user"></i>
                            </span>
                            {!! Form::text('name',null, ['class'=>'form-control',
                                                         'title'=>'Nombre del usuario',
                                                         'placeholder' => 'Name',
                                                         'id'=>'name',
                                                         'autofocus required']) !!}
                        </div>
                    </div>
                    <!-- /Name -->
                </div>
                <div class="col-md-12">
                    <!-- Description -->
                    <div class="from-group">
                        {!! Form::label('description', 'Description') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fas fa-envelope"></i>
                            </span>
                            {!! Form::textarea('description',null,
                                    ['class'=>'form-control', 'id'=>'description',
                                    'rows' => 2, 'cols' => 40]) !!}
                        </div>
                    </div>
                    <!-- /Description -->
                </div>
            </div>
        </div>

        <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-save" id="bcreate"></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                <i class="fa fa-times-circle"></i> Close
                </button>
        </div>
        {!! Form::close() !!}
    </div> 
        
  </div>
</div>