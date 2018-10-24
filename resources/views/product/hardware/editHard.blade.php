<!-- Modal Users -->
<div class="modal fade" id="modal-form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
	{!! Form::open(array('method'=>'POST','id'=>'form-hardware','data-toggle'=>'validator','autocomplete'=>'off' )) !!}
           {{ method_field('POST') }}
	<!-- Header Modal -->  
	<div class="modal-header bg-warning">
            {!! Form::button('<span aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></span>'
                              ,['class'=>'close', 'data-dismiss'=>'modal']) !!}
            <h3 class="modal-title"></h3>
             
        </div> 

		<div class="modal-body">
		<input type="hidden" id="id" name="id"> 
                    <div class="row">
                        <!-- Controlador & Url -->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Controlador -->
                            <div class="form-group">
                                {!! Form::label('type_hardware', 'Tipo Hardware') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-cog"></i>
                                        </span>
                                     {!!   Form::select('type_hardware', ['Computador' => 'Computador', 'Impresora' => 'Impresora', 'telefono'=> 'Telefono', 'dispositivo'=>'Dispositivo'], null, ['class' => 'form-control select2',
                                                                              'id' => 'type_hardware']) !!}

                                   
                                </div>
                            </div>
                            <!-- /Controlador -->

                            <!-- Url -->
                            <div class="form-group">
                                {!! Form::label('name', 'Nombre') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-link"></i>
                                        </span>
                                        
                                        {!! Form::text('name', null, ['class' => 'form-control',
                                                                           'title' => 'Texto que se mostrara al lado del nombre del modulo, preferiblemente poner números',
                                                                           'placeholder' => 'Nombre producto',
                                                                           'id' => 'name'
                                    ]) !!}
                                </div>
                            </div>
                            <!-- /Verbo -->
                        </div>
                        <!-- /Controlador & Url -->

                        <!-- Verbo & Nombre de Funcion -->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Verbo -->
                            <div class="form-group">
                                {!! Form::label('location', 'Localizacion') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        {!! Form::text('location', null, ['class' => 'form-control',
                                                                           'title' => 'Texto que se mostrara al lado del nombre del modulo, preferiblemente poner números',
                                                                           'placeholder' => 'Localizacion del producto',
                                                                           'id' => 'location'
                                    ]) !!}
                                </div>
                            </div>
                            <!-- /Verbo -->

                            <!-- Nombre de Funcion -->
                            <div class="form-group">
                                {!! Form::label('text', 'Numero Contacto') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        {!! Form::text('num_contact', null, ['class' => 'form-control',
                                                                           'title' => 'Texto que se mostrara al lado del nombre del modulo, preferiblemente poner números',
                                                                           'placeholder' => 'Numero de contacto',
                                                                           'id' => 'num_contact'
                                    ]) !!}
                                
                                </div>
                            </div>
                            <!-- /Nombre de Funcion -->
                        </div>
                        <!-- /Verbo & Nombre de Funcion -->
                    </div>

                    <div class="row">
                        <!-- Nombre del método-->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Nombre del método-->
                            <div class="form-group">
                                {!! Form::label('icon', 'Fabricante') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        {!! Form::text('maker', null, ['class' => 'form-control',
                                                                           'title' => 'Texto que se mostrara al lado del nombre del modulo, preferiblemente poner números',
                                                                           'placeholder' => 'Fabricante Producto',
                                                                           'id' => 'maker'
                                    ]) !!}
                                </div>
                            </div>
                            <!-- /Nombre del método-->
                        </div>
                        <!-- /Nombre del método-->

                        <!-- Nombre del método-->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Nombre del método-->
                            <div class="form-group">
                                {!! Form::label('icon_color', 'Modelo') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        {!! Form::text('model', null, ['class' => 'form-control',
                                                                           'title' => 'Texto que se mostrara al lado del nombre del modulo, preferiblemente poner números',
                                                                           'placeholder' => 'Modelo producto',
                                                                           'id' => 'model'
                                    ]) !!}
                                </div>
                            </div>
                            <!-- /Nombre del método-->
                        </div>
                        <!-- /Nombre del método-->
                    </div>

                    <div class="row">
                        <!-- Nombre del método-->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Nombre del método-->
                            <div class="form-group">
                                {!! Form::label('label', 'Numero de serie') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        {!! Form::text('serial', null, ['class' => 'form-control',
                                                                           'title' => 'Texto que se mostrara al lado del nombre del modulo, preferiblemente poner números',
                                                                           'placeholder' => 'Numero de Serie',
                                                                           'id' => 'serial'
                                    ]) !!}
                                </div>
                            </div>
                            <!-- /Nombre del método-->
                        </div>
                        <!-- /Nombre del método-->

                        <!-- Nombre del método-->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Nombre del método-->
                            <div class="form-group">
                                {!! Form::label('label_color', 'Tecnico a cargo del hardware') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        {!! Form::text('technical_in_charge', null, ['class' => 'form-control',
                                                                           'title' => 'Texto que se mostrara al lado del nombre del modulo, preferiblemente poner números',
                                                                           'placeholder' => 'Tecnico a cargo del hardware',
                                                                           'id' => 'technical_in_charge'
                                    ]) !!}
                                </div>
                            </div>
                            <!-- /Nombre del método-->
                        </div>
                        <!-- /Nombre del método-->
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                {!! Form::label('main', 'Estado') !!}
                                <div class="input-group">
                                <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                {!! Form::text('state', null, ['class' => 'form-control',
                                                                           'title' => 'Texto que se mostrara al lado del nombre del modulo, preferiblemente poner números',
                                                                           'placeholder' => 'Indique el estado del producto',
                                                                           'id' => 'state'
                                    ]) !!}

                                    
                                    </div>
                                </div>
                            </div>
                        
                    
                        
                        
                        <div class="col-lg-6 col-sm-12">
                            <!-- Nombre del método-->
                            <div class="form-group">
                                {!! Form::label('description', 'Descripcion') !!}
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3',
                                                                           'id' => 'description'
                                    ]) !!}
                                </div>
                            </div>
                            </div>

							<div class="modal-footer">
							<button type="submit" class="btn btn-primary btn-save" id="bcreate"></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                <i class="fa fa-times-circle"></i> Cerrar
                </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>