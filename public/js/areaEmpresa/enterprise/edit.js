$(document).on('click', '.edit-enterprise', function(event){
    event.preventDefault();
    editEnterprise = $(this);
    enterpriseModal = $('#enterprise');
    editEnterprise.LoadingOverlay('show');
        
    $.getJSON(editEnterprise.attr('href'))
    .done(function(data){
        editEnterprise.LoadingOverlay('hide', true);
        if(data.success && !data.error){
            enterpriseModal.find('.modal-title').text('Editar Empresa');
            $('#business_name').val(data.enterprise.business_name);
            $('#address').val(data.enterprise.address);
            $('#legal_representative').val(data.enterprise.legal_representative);
            $('#btn-submit').attr('data-id', data.enterprise.id);
            enterpriseModal.modal('show');
        }else{
            swal({
                title: data.title,
                text: data.msg,
                icon: 'error',
            });
        }
    }).fail(function(jqXHR, textStatus){
        editEnterprise.LoadingOverlay('hide', true);
        typeError(jqXHR, textStatus);
    });
});