
<div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="form-permissions" method="post" class="form-horizontal" data-toggle="validator"
      autocomplete="off">
        {{ csrf_field() }} {{ method_field('POST') }}
        <div class="modal-header bg-warning">
            {!! Form::button('<span aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></span>'
                              ,['class'=>'close', 'data-dismiss'=>'modal']) !!}
            <h3 class="modal-title"></h3>
             
        </div> 
       
    
         <!-- Body Modal-->
        <div class="modal-body">
        <div class="col-md-12">
            <!-- id-->
            <input type="hidden" id="id" name="id">

              <!-- Name -->
              <div class="from-group">
                        {!! Form::label('name', 'Name') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fas fa-user"></i>
                            </span>
                            {!! Form::text('name',null, ['class'=>'form-control',
                                                         'title'=>'Nombre del permiso',
                                                         'placeholder' => 'Name',
                                                         'id'=>'name',
                                                         'autofocus required']) !!}
                        </div>
                        <br>
                    </div>
                    <!-- /Name -->
             <!-- Slug -->
             <div class="from-group">
                        {!! Form::label('slug', 'Slug') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                            <i class="fa fa-address-card" aria-hidden="true"></i>
                            </span>
                            {!! Form::text('slug',null, ['class'=>'form-control',
                                                         'title'=>'Slug de Permisos',
                                                         'placeholder' => 'Slug',
                                                         'id'=>'slug',
                                                         'autofocus required']) !!}
                        </div>
                    </div>
                    <!-- /Slug -->
                    <br>
                     <!-- Description -->
                     <div class="from-group">
                        {!! Form::label('description', 'Description') !!}
                        <div class="textarea-group" cols="200" rows="5">
                        
                            {!! Form::textarea ('description',null, ['class'=>'form-control',
                                                         'title'=>'Descripción de Roles',
                                                         'placeholder' => 'Description',
                                                         'id'=>'description',
                                                         'autofocus required']) !!}

                                                      
                       </div>
                 
                    </div>
                    <!-- /Description -->
                <br>
                  <!-- Slug -->
             <div class="from-group">
                        {!! Form::label('special', 'Special') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                            <i class="fa fa-address-card" aria-hidden="true"></i>
                            </span>
                            {!! Form::select('special', ['null' => 'none', 'all-access' => 'All-access', 'no-access' => 'No-access'], '', ['class' => 'form-control', 
                                            'id'=>'special']) !!}
                        </div>
                    </div>
                <br>
                  <!-- Slug -->
             <div class="from-group">
                        {!! Form::label('permissions', 'Permissions') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                            <i class="fa fa-address-card" aria-hidden="true"></i>
                            </span>
                            {!! Form::select('permissions[]', $permissions,null, 
                            ['id'=>'permissions', 'class'=>'form-control margin', 
                            'multiple' => 'multiple']) !!}
                        </div>
                    </div>
                <br>
                
           
            </div>
            
           
      </div>
      <br>
      <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save" id="bcreate"></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fas fa-times-circle"></i> Close
                    </button>
           </div>
        </div>
        
      </form>
    </div>  
  </div>
</div>