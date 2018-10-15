$('#form-create-input').submit(function(event){
    event.preventDefault();
    $.post($(this).attr('action'),{
        datos: $(this).serialize()
    }).done(function(data){
        if(data.success && !data.error){

        }else{
            
        }
    }).fail(function(jqXHR, textStatus){
        typeError(jqXHR, textStatus);
    });
});