camposPersonalizados = $('#camposPersonalizados');
rutaInput = $('#route-input-index').val();

loadInputs();
swal({
    title: "titulo",
    text: "mensaje",
    icon: "success",
});
function loadInputs(){  
    camposPersonalizados.LoadingOverlay("show");  
    $.getJSON(rutaInput)
    .done(function(data){
        camposPersonalizados.LoadingOverlay("hide", true);  
        if(data.success && !data.error){
            camposPersonalizados.html(data.html);
        }else{
            swal({
                title: data.title,
                text: data.msg,
                icon: "error",
            });
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown){
        camposPersonalizados.LoadingOverlay("hide", true);  
        typeError(jqXHR, textStatus);
    });
}