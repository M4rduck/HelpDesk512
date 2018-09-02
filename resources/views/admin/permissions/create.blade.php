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
        <div class="modal-body">
            <input type="hidden" id="id" name="id">
            <div class="form-group">
              <label for="name" class="col-md-3 control-label">Name</label>
              <div class="col-md-12">
                <input type="text" id="name" name="name" class="form-control" placeholder="Name" autofocus required>
                <span class="help-block with-errors"></span>
              </div>
            </div>
            <div class="form-group">
              <label for="slug" class="col-md-3 control-label">Slug</label>
              <div class="col-md-12">
                <input type="text" id="slug" name="slug" class="form-control" placeholder="slug" autofocus required>
                <span class="help-block with-errors"></span>
              </div>  
            </div>
            <div class="form-group">
              <label for="description" class="col-md-3 control-label">Description</label>
              <div class="col-md-12">
                <textarea id="description" name="description" class="form-control" cols="5" maxlength="50"></textarea>
                <span class="help-block with-errors"></span>
              </div>  
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