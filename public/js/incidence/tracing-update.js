$(function(){
    
    var btn_guardar = document.getElementById('btn_guardar');
    var select_estado = document.getElementById('estado');
    var estado_inicial = select_estado.value;
    var checkbox_baseconocimiento = document.getElementById('check_baseconocimiento');
    var solucion = "";
    var baseconocimiento = checkbox_baseconocimiento.checked ? 1 : 0;
    var editor = CKEDITOR.replace('txta_solucion');

    console.log(baseconocimiento);

    select_estado.onchange = function(){

        if(select_estado.value == '5'){

            $('#solution_create_modal').modal({
                keyboard: false,
                backdrop: 'static'
            });

            $('#solution_create_modal').on('hidden.bs.modal', function(e){
                editor.setData('');

            });

            $('#btn_submit').on('click', function(){
                console.log($(this));

                if(editor.getData().length == 0){

                    alert('debe introducir algo');

                }else{

                    solucion = editor.getData();
                    baseconocimiento = checkbox_baseconocimiento.checked ? 1 : 0;
                    $('#solution_create_modal').modal('hide');

                }

            });

            $('#btn_dismiss').on('click', function(){
                console.log($(this));
                select_estado.value = estado_inicial;
                solucion = "";

            });
    
        }else{

            solucion = "";

        }

    };
    
    if(btn_guardar !== null){

        btn_guardar.onclick = function(){

            console.log('btn_update', this);

            console.log(estado_inicial !== select_estado.value);

            $.post({
                url: document.getElementById('update_incidence_route').value,
                data: {
                    contacto: document.getElementById('contacto').value,
                    prioridad: document.getElementById('prioridad').value,
                    estado: document.getElementById('estado').value,
                    agente: document.getElementById('agente').value,
                    solucion: solucion,
                    insertar_solucion: estado_inicial !== select_estado.value,
                    baseconocimiento: baseconocimiento
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);

                    solucion = "";

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