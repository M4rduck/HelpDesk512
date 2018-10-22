$(function(){
    
    var btn_guardar = document.getElementById('btn_guardar');
    
    if(btn_guardar !== null){

        btn_guardar.onclick = function(){

            console.log('btn_update', this);
          
            $.post({
                url: document.getElementById('update_incidence_route').value,
                data: {
                    contacto: document.getElementById('contacto').value,
                    prioridad: document.getElementById('prioridad').value,
                    estado: document.getElementById('estado').value,
                    agente: document.getElementById('agente').value
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);

                    swal(
                        'Exito',
                        "Los cambios se han aplicado con exito",
                        'success'
                    );

                },
                error: function(response) {
                    console.log('error', response);
                }
            });
            
        };

    }

});