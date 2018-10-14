$(document).on('click', '.delete-area', function(){
    ruta = $(this).attr('data-id');
    area = $(this).parents('tr').find('td').eq(0).text();
    swal({
        title: "Eliminar!",
        text: `Deseas eliminar el area de ${area}`,
        icon: "error",
        buttons: true,
    }).then((value) => {
        $.ajax({
            url: ruta,
            method: 'DELETE'
       }).done(function(data){
           if(data.success && !data.error){
   
           }else{
   
           }
       }).fail(function(jqXHR, textStatus){
           TypeError(jqXHR, textStatus);
       });
    });    
});