$(document).on('click', '.delete-area', function(){
    idDelete = $(this).attr('data-id');
    $.ajax({
         url: ''+idDelete,
         method: 'DELETE'
    }).done(function(data){
        if(data.success && !data.error){

        }else{

        }
    }).fail(function(jqXHR, textStatus){
        TypeError(jqXHR, textStatus);
    });
});