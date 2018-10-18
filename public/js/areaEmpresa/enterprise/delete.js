$(document).on('click', '.delete-enterprise', function(){
    ruta = $(this).attr('data-id');
    enterprise = $(this).parents('tr').find('td').eq(0).text();
    swal({
        title: 'Advertencia!',
        text: `Deseas eliminar la empresa ${enterprise}`,
        icon: 'warning',
        buttons: true,
    }).then((value) => {
        if(value){
            $('#enterprise-table').LoadingOverlay('show');
            $.ajax({
                url: ruta,
                method: 'DELETE'
           }).done(function(data){
            $('#enterprise-table').LoadingOverlay('hide', true);
               if(data.success && !data.error){
                    swal({
                        title: data.title,
                        text: data.msg,
                        icon: 'success',
                    });       
                    enterpriseTable.ajax.reload();
               }else{
                    swal({
                        title: data.title,
                        text: data.msg,
                        icon: 'error',
                    });       
               }
           }).fail(function(jqXHR, textStatus){
                $('#enterprise-table').LoadingOverlay('hide', true);
               typeError(jqXHR, textStatus);
           });
        }     
    });    
});