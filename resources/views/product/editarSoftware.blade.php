
<div id="modal-form" class="modal fade" role="dialog">
    <div class="modal-dialog">
    {!! Form::open(array('method'=>'POST','id'=>'form-software','data-toggle'=>'validator','autocomplete'=>'off' )) !!}
           {{ method_field('POST') }}
        <div class="modal-content">
                
            <div class="modal-header bg-warning">
                {!! Form::button('&times;', ['class'=>'close', 'data-dismiss'=>'modal']) !!}
                <h4 class="modal-title">Registrar Software</h4>
            </div>

            <div class="modal-body">
            <input type="hidden" id="id" name="id">
                <div class="row">
                    
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            
                            {!! Form::label('module_id', 'Nombre') !!}
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-link"></i>
                                    </span>
                                    
                                    {!! Form::text('name', null, ['class' => 'form-control',
                                                                      'placeholder' => 'Nombre producto',
                                                                       'id' => 'name'
                                ]) !!}
                            </div>

                            {!! Form::label('module_id', 'Descripción') !!}
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-link"></i>
                                    </span>
                                    
                                    {!! Form::text('descritpion', null, ['class' => 'form-control',
                                                                      'placeholder' => 'Descripción del producto',
                                                                       'id' => 'descritpion'
                                ]) !!}
                            </div>

                            {!! Form::label('module_id', 'Serial') !!}
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-link"></i>
                                    </span>
                                    
                                    {!! Form::text('serial', null, ['class' => 'form-control',
                                                                       'placeholder' => 'Nombre producto',
                                                                       'id' => 'serial'
                                ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                            <div class="col-lg-6 col-sm-12">
                            {!! Form::label('method_id', 'Modulo') !!}
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-cog"></i>
                                </span>
                                {!! Form::text('license', null, ['class' => 'form-control',
                                                                       'placeholder' => 'Licencia',
                                                                       'id' => 'license'
                                ]) !!}                          
                            </div>
                            
                            {!! Form::label('method_id', 'Licencia') !!}
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-cog"></i>
                                    </span>
                                    {!! Form::text('editor', null, ['class' => 'form-control',
                                                                       'placeholder' => 'Editor',
                                                                       'id' => 'editor'
                                ]) !!}                              
                            </div>
                        
                                {!! Form::label('method_id', 'Activo') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-cog"></i>
                                    </span>
                                    {!! Form::text('versions', null, ['class' => 'form-control',
                                                                       'placeholder' => 'Versiones',
                                                                       'id' => 'versions'
                                ]) !!}                               
                                </div>

                                {!! Form::label('method_id', 'Borrado') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-cog"></i>
                                        </span>
                                     {!!   Form::select('category_id', $cate, null, ['class' => 'form-control select2',
                                                                              'id' => 'category_id']) !!}                               
                                </div>
                        </div>
                    </div>
                
             <div class="modal-footer">

            						<button type="submit" class="btn btn-primary btn-save" id="bcreate"></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                <i class="fa fa-times-circle"></i> Close
                </button>
               </div>
            
        </div>
        {!! Form::close() !!}
       
    </div>
</div>