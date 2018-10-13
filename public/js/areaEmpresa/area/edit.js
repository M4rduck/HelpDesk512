$(document).on('click', '.edit-area', function(){
    idEdit = $(this).attr('data-id');
    $.ajax({
         url: ''+idEdit,
         method: 'DELETE'
    }).done(function(data){
        if(data.success && !data.error){

        }else{

        }
    }).fail(function(jqXHR, textStatus){
        TypeError(jqXHR, textStatus);
    });
});