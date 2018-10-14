$('#form-store').submit(function(event){ 
    event.preventDefault();
    formulario = $(this);
    //formulario.LoadingOverlay("show");
    console.log(typeof formulario.attr('data-id'));
    formulario.attr('data-id', 12);
    formulario.attr('data-id', '');
    console.log(typeof formulario.attr('data-id'));
    if(formulario.attr('data-id')){
        
    }
    /*$.post($(this).attr('action'),{
        datos: $(this).find(':input').serialize(),
        id: $('#area-id').val()
    }).done(function(data){
        formulario.LoadingOverlay("hide", true);
        if(data.success && !data.error){
            areaTable.ajax.reload();
            swal({
                title: "Good job!",
                text: data.msg,
                icon: "success",
            });
        }else{
            swal({
                title: "Good job!",
                text: data.msg,
                icon: "error",
            });
        }
    }).fail(function(jqXHR, textStatus){
        formulario.LoadingOverlay("hide", true);
        swal({
            title: "At least your trying!",
            text: "You clicked the button!",
            icon: "error",
        });        

    });
    console.log($(this).find(':input').serialize());*/
});