<div class="modal fade" id="modal-form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    <!-- Header Modal -->  
    <div class="modal-header bg-info" id="header">
            {!! Form::button('<span aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></span>'
                              ,['class'=>'close', 'data-dismiss'=>'modal']) !!}
            <h3 class="modal-title"></h3>
             
    </div>

    <div class="modal-body"></div>

    <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-save" id="bcreate"></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                <i class="fa fa-times-circle"></i> Close
                </button>
    </div>

    </div>
    </div>
    </div> 