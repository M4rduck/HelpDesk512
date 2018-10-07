@if ($inputs->isNotEmpty())
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
                    <div class="panel-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                        minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                        commodo consequat.
                    </div>
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