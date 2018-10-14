$(document).on('submit', '#store-tracing', function(event){
    event.preventDefault();
    storeTraicing = $(this);
    storeTraicing.LoadingOverlay('show');
    $.post(storeTraicing.attr('action'), {
        datos: storeTraicing.find(':input').serialize()
    }).done(function(data){
        storeTraicing.LoadingOverlay('hide', true);
        if(data.success && !data.error){
            $('#comment').val('');
            loadTracings();
        }else{
            toastr.error(data.msg);
        }

    }).fail(function(jqXHR, textStatus){
        storeTraicing.LoadingOverlay('hide', true);
    });
});