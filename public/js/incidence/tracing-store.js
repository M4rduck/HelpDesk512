$(document).on('click', '#store-traicing', function(event){
    event.preventDefault();
    $.post($(this).attr('actio'), {
        datos: $(this).find(':input').seriallize()
    }).done(function(data){
        if(data.success && !data.error){
            loadTracings();
        }else{
            toastr.error(data.msg);
        }

    }).fail(function(jqXHR, textStatus){

    });
});