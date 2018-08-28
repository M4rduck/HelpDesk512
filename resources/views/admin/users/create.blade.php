<!-- Modal Users -->

<div class="modal fade" id="modal-form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <!-- Header Modal -->

      {!! Form::open(array('method'=>'POST','id'=>'form-users','class'=>'form-horizontal','data-toggle'=>'validator'
                          ,'autocomplete'=>'off')) !!}
           {{ method_field('POST') }}

           
        <div class="modal-header bg-warning">
            <h3 class="modal-title"></h3>
             {!! Form::button('<span aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></span>'
                              ,['class'=>'close', 'data-dismiss'=>'modal']) !!}
        </div> 
      
        <!-- Body Modal-->
        <div class="modal-body">
            <div class="row col-md-12">
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
                    <!-- Email -->
                    <div class="from-group">
                        {!! Form::label('email', 'Email') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fas fa-envelope"></i>
                            </span>
                            {!! Form::text('email',null, ['class'=>'form-control',
                                                         'title'=>'Email del usuario',
                                                         'placeholder' => 'Email',
                                                         'id'=>'email',
                                                         'autofocus required']) !!}
                        </div>
                    </div>
                    <!-- /Email -->
                </div>
                <div class="col-md-12">
                    <!-- Password -->
                    <div class="from-group">
                        {!! Form::label('password', 'Password') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fas fa-key"></i>
                            </span>
                            {!! Form::password('password',['class' => 'form-control',
                                                           'id'=>'password',
                                                           'title'=>'Contraseña del usuario',
                                                           'placeholder'=>'Password']) !!}
                        </div>
                    </div>
                    <!-- /Password -->
                </div>
                <div class="col-md-12">
                    <!-- Password -->
                    <div class="from-group">
                        {!! Form::label('password1', 'Confirmed Password') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fas fa-key"></i>
                            </span>
                            {!! Form::password('password1',['class' => 'form-control',
                                                           'id'=>'password1',
                                                           'title'=>'Contraseña del usuario',
                                                           'placeholder'=>'Confirmed Password']) !!}
                        </div>
                    </div>
                    <!-- /Password -->
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