$(document).on('click', '.edit-area', function(event){
    event.preventDefault();
    editArea = $(this);
    areaModal = $('#Area');
    editArea.LoadingOverlay('show');

    $.getJSON(editArea.attr('href'))
    .done(function(data){
        editArea.LoadingOverlay('hide', true);
        if(data.success && !data.error){
            areaModal.find('.modal-title').text('Editar Area');
            $('#nameA').val(data.area.name);
            $('#exten').val(data.area.extension);
            $('#email').val(data.area.email);
            $('#description').val(data.area.description);
            $('#btn-submit').attr('data-id', data.area.id);
            areaModal.modal('show');

        }else{
            swal({
                title: data.title,
                text: data.msg,
                icon: 'error',
            });
        }
    }).fail(function(jqXHR, textStatus){
        TypeError(jqXHR, textStatus);
    });
});