<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header label-info" id="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-title">Form Input</h4>
            </div>

            <div class="modal-body" id="modal-body">
                {!! Form::model(null,[
                        'route' =>  'baseConocimiento.store',
                        'method' => 'POST'
                ]) !!}

                <div class="form-group">
                    <label for="name" class="control-label">Title</label>
                    {!! Form::text('name',null,['class'=>'form-control', 'id'=>'name']) !!}
                </div>

                <div class="form-group">
                    <label for="description" class="control-label">Description</label>
                    {!! Form::text('description',null,['class'=>'form-control', 'id'=>'description']) !!}
                </div>

                <div class="form-group well">
                    <label for="tags" class="control-label">Etiquetas (palabras separadas por coma)</label>    
                    {!! Form::text('tags', null, ['class'=>'form-control' ,'data-role' => 'tagsinput', 'id'=>'tags']) !!}
                </div>
                <div class="form-group">
                    <label for="solution" class="control-label">Solution</label>
                    {!! Form::textarea('solution',null,['class'=>'form-control', 'id'=>'solution', 'row'=>'20', 'cols'=>'50']) !!}
                </div>


                {!! Form::close() !!}
            </div>
            
            <div class="modal-footer" id="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info" id="modal-btn-save">Save changes</button>
            </div>
        </div>
    </div>
</div>