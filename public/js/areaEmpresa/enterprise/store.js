$('#form-store').submit(function(event){
    event.preventDefault();
    formStore = $(this);
    formStore.LoadingOverlay('show');   
    sendData = formStore.find(':input').serialize();
    
    if($('#btn-submit').attr('data-id').trim().length === 0){
        sendRequest = $.post(formStore.attr('action'),{
                        data: sendData
                     });
    }else{
        sendRequest = $.ajax({
                        url: '/area-empresa/empresa/update/'+$('#btn-submit').attr('data-id'),
                        type: 'PUT',
                        data: sendData
                    });        
    }    
    
    sendRequest.done(function(data){
        formStore.LoadingOverlay('hide', true);
        if(data.success && !data.error){
            swal({
                title: data.title,
                text: data.msg,
                icon: 'success',
            });
            enterpriseTable.ajax.reload();
        }else{
            swal({
                title: data.title,
                text: data.msg,
                icon: 'error',
            });
        }
    }).fail(function(jqXHR, textStatus){
        formStore.LoadingOverlay('hide', true);
        typeError(jqXHR, textStatus);
    });
});