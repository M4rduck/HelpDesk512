$('#form-create-input').submit(function(event){
    formCreateInput = $(this);
    formCreateInput.LoadingOverlay("show");      
    event.preventDefault();
    $.post($(this).attr('action'),{
        datos: $(this).serialize()
    }).done(function(data){
        formCreateInput.LoadingOverlay("hide", true);  
        if(data.success && !data.error){
            loadInputs();
            icon = 'success'; 
        }else{
            icon = 'error';            
        }
        swal({
            title: data.title,
            text: data.msg,
            icon: icon,
        });
    }).fail(function(jqXHR, textStatus){
        formCreateInput.LoadingOverlay("hide", true);
        typeError(jqXHR, textStatus);
    });
});