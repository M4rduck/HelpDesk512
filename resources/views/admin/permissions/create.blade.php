<div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="form-permissions" method="post" class="form-horizontal" data-toggle="validator"
      autocomplete="off">
        {{ csrf_field() }} {{ method_field('POST') }}
        <div class="modal-header">
        <h3 class="modal-title"></h3>  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
        </button>
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
     
                     <!-- Description -->
             <div class="from-group">
                        {!! Form::label('description', 'Description') !!}
                        <div class="textarea-group">
                        
                            {!! Form::textarea ('description',null, ['class'=>'form-control',
                                                         'title'=>'Descripcion de Permisos',
                                                         'placeholder' => 'Description',
                                                         'id'=>'description',
                                                         'autofocus required']) !!}

                                                      
                       </div>
                 
                    </div>
                    <!-- /Description -->
                
           
            </div>
           <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save" id="bcreate"></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fas fa-times-circle"></i> Close
                    </button>
           </div>
      </div>
        </div>
        
      </form>
    </div>  
  </div>
</div>