{!! Form::model([
    'route' =>  'baseConocimiento.store',
    'method' => 'POST'
]) !!}

<div class="form-group">
    <label for="name" class="control-label">Title</label>
    {!! Form::text('name',null,['class'=>'form-control', 'id'=>'name']) !!}
</div>

<div class="form-group">
    <label for="" class="control-label">Description</label>
    {!! Form::text('description',null,['class'=>'form-control', 'id'=>'description']) !!}
</div>

<div class="form-group well">
    <label for="tags">Etiquetas (palabras separadas por coma)</label>    
    {!! Form::text('tags', null, ['data-role' => 'tagsinput', 'class' => 'form-control', 'id'=>'input']) !!}
</div>

<div class="form-group">
    <label for="" class="control-label">Solution</label>
    {!! Form::textarea('solution',null,['class'=>'form-control', 'id'=>'solution', 'row'=>'20', 'cols'=>'50']) !!}
</div>


{!! Form::close() !!}
<!-- Bootstrap-tagsInput -->
{!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css') !!}
<!-- Bootstrap-tagsInput -->
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js') !!}