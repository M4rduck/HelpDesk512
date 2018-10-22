@inject('configuration', '\App\Clases\Configuration')
@if($field->typeInput->name === 'select')
    {!! Form::{$field->typeInput->name}($formulario->id.'_'.$section->id.'_'.$subSection->id.'_'.$field->id, $configuration::createValue($field), null, $configuration::createOptions($field)) !!}
@elseif($field->typeInput->name == 'checkbox' || $field->typeInput->name == 'radio')
    <div class="{!!$field->typeInput->name!!}-inline">
        <label>
            {!! Form::{$field->typeInput->name}($formulario->id.'_'.$section->id.'_'.$subSection->id, $field->id, null, $configuration::createOptions($field)) !!}
            {!! $field->name !!}
        </label>        
    </div>    
@elseif($field->typeInput->name === 'file' || $field->typeInput->name === 'submit' || $field->typeInput->name === 'button')
    {!! Form::{$field->typeInput->name}($formulario->id.'_'.$section->id.'_'.$subSection->id.'_'.$field->id, $configuration::createOptions($field)) !!}
@else
    {!! Form::{$field->typeInput->name}($formulario->id.'_'.$section->id.'_'.$subSection->id.'_'.$field->id, $configuration::createValue($field), $configuration::createOptions($field)) !!}
@endif