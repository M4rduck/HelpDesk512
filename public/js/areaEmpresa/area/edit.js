$(document).on('click', '.edit-area', function(){
    editArea = $(this);
    ruta = editArea.attr('data-id');
    area = $('#Area');
    editArea.LoadingOverlay('show');
    $.getJSON(ruta)
    .done(function(data){
        editArea.LoadingOverlay('hide', true);
        if(data.success && !data.error){
            area.find('.modal-title').text('Editar Area');
            $('#nameA').val(data.area.name);
            $('#exten').val(data.area.extension);
            $('#email').val(data.area.email);
            $('#description').val(data.area.description);
            area.modal('show');

        }else{

        }
    }).fail(function(jqXHR, textStatus){
        TypeError(jqXHR, textStatus);
    });
});