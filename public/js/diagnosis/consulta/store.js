$(document).on('submit', '#form-diagnosis', function(event){
    event.preventDefault();
    let  formulario = $(this);
    formulario.LoadingOverlay("show");
    $.post(formulario.attr('action'),{
        data: formulario.find(':input').serialize()
    }).done(function(data){
        formulario.LoadingOverlay("hide", true);
        if(data.success && !data.error){
            toastr.success(data.msg);
        }else{
            toastr.error(data.msg);
        }
    }).fail(function(jqXHR, textStatus){
        formulario.LoadingOverlay("hide", true);
        typeError(jqXHR, textStatus);
    });
});