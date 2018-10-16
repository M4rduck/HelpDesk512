$('#form-store').submit(function(event){ 
    event.preventDefault();
    formulario = $(this);
    formulario.LoadingOverlay("show");
    sendData = $(this).find(':input').serialize();
    
    if($('#btn-submit').attr('data-id').trim().length === 0){
        sendRequest = $.post($(this).attr('action'),{
                            datos: sendData,
                            id: $('#area-id').val()
                        });        
    }else{
        sendRequest = $.ajax({
                            url: '/area-empresa/area/update/'+$('#btn-submit').attr('data-id'),
                            type: 'PUT',
                            data: sendData
                        });
    }

    sendRequest.done(function(data){
        formulario.LoadingOverlay("hide", true);
        if(data.success && !data.error){
            areaTable.ajax.reload();
            swal({
                title: "Felicitaciones!",
                text: data.msg,
                icon: "success",
            });
        }else{
            swal({
                title: "Error!",
                text: data.msg,
                icon: "error",
            });
        }
    }).fail(function(jqXHR, textStatus){
        formulario.LoadingOverlay("hide", true);
        typeError(jqXHR, textStatus);      

    });
});