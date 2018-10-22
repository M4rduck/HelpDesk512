$(function(){
    
    var btn_guardar = document.getElementById('btn_guardar');
    var select_estado = document.getElementById('estado');

    select_estado.onchange = function(){

        if(select_estado.value == '5'){

            $('#solution_create_modal').modal({
                keyboard: false
            });

            $('#solution_create_modal').on('hidden.bs.modal', function(){

                $('#txta_solucion').val('');

            });

            $('#btn_submit').on('click', function(){
                console.log($(this));

                if($('#txta_solucion').val().length == 0){

                    alert('debe introducir algo');

                }else{

                    $('#solution_create_modal').modal('hide');

                }

            });
    
        }

    };
    
    if(btn_guardar !== null){

        btn_guardar.onclick = function(){

            console.log('btn_update', this);
          
            $.post({
                url: document.getElementById('update_incidence_route').value,
                data: {
                    contacto: document.getElementById('contacto').value,
                    prioridad: document.getElementById('prioridad').value,
                    estado: document.getElementById('estado').value,
                    agente: document.getElementById('agente').value,
                    solucion: document.getElementById('txta_solucion').value
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
                },

            });
            
        };

    }

});