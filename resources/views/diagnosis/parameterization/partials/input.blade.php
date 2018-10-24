@if ($inputs->isNotEmpty())
    @inject('Configuration', '\App\Clases\Configuration')
    <div  class="panel-group" id="accordion">
        @foreach ($inputs as $input)
            <div class="panel panel-default">
                <div class="panel-heading bg-yellow">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#{!! $input->name !!}">
                            {!! $input->name !!}
                        </a>
                    </h4>
                </div>
                <div id="{!! $input->name !!}" class="panel-collapse collapse">
                    <!-- Panel Body -->
                    <div class="panel-body">
                        @if ($input->fields->isNotEmpty())
                            <!-- Division una fila, dos campos -->
                            @foreach ($input->fields->chunk(4) as $fields)
                                <!-- Split Row -->
                                <div class="row">
                                    @foreach ($fields as $field)
                                        <!-- Cols with each field -->
                                        <div class="col-lg-6 col-xs-12">
                                            <!-- form-group -->
                                            <div class="form-group">
                                                {!! Form::label($field->id.'_'.$field->input_type_id, $field->name) !!}                        
                                                @if($input->name == 'select')
                                                    {!! Form::{$input->name}($field->id.'_'.$field->input_type_id, [], null, ['id' => $field->id.'_'.$field->input_type_id, 'class' => 'form-control']) !!}
                                                @elseif($input->name == 'checkbox' || $input->name == 'radio')
                                                    {!! Form::{$input->name}($field->id.'_'.$field->input_type_id, '1', null, ['id' => $field->id.'_'.$field->input_type_id]) !!}
                                                @elseif($input->name === 'file' || $input->name === 'submit' || $input->name === 'button')
                                                    {!! Form::{$input->name}($field->id.'_'.$field->input_type_id, []) !!}
                                                @else
                                                    {!! Form::{$input->name}($field->id.'_'.$field->input_type_id, null, ['id' => $field->id.'_'.$field->input_type_id, 'class' => 'form-control']) !!}
                                                @endif
                                            </div>      
                                            <!-- /form-group -->
                                        </div>
                                        <!-- /Cols with each field -->                                                                                              
                                    @endforeach
                                </div>     
                                <!-- /Split Row -->                                                               
                            @endforeach 
                            <!-- Division una fila, dos campos -->                       
                        @else
                            
                        @endif                    
                    </div>
                    <!-- /Panel Body -->
                </div>
            </div>        
        @endforeach    
    </div>
@else
    <div class="alert alert-warning alert-dismissible">        
        {!! Form::button('x', ['class' => 'close', 'data-dismiss' => 'alert', 'aria-hidden' => 'true']) !!}
        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
        @lang('diagnosis/create.fields_not_found_or_create')
    </div>
@endif