window.location.port === "" ? port = "" :  port = ":" + window.location.port;

var host = window.location.protocol + '//' + window.location.hostname + port + '/';

$.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
});
        
$.extend( true, $.fn.dataTable.defaults, {
    "language": {
            "url": host+'js/lang/datatable/spanish.json'
    }
} );

/*
 * Función que ayuda a identificar la mayoria de errores, a la hora que falle una respuesta del servidor.
 * */
function typeError(jqXHR, textStatus) {
    if (jqXHR.status === 0) {

        toastr.error('Sin conexión: verificar red.');

    } else if (jqXHR.status == 404) {

        toastr.error('Cargo solicitado no encontrado [404]');

    } else if (jqXHR.status == 500) {

        toastr.error('Internal Server Error [500].');

    } else if (textStatus === 'parsererror') {

        toastr.error('La conversión JSON solicitada fracasó.');

    } else if (textStatus === 'timeout') {

        toastr.error('Error de tiempo de espera.');

    } else if (textStatus === 'abort') {

        toastr.error('Solicitud Ajax abortada.');

    } else {

        toastr.error('Error desconocido: ' + jqXHR.responseText);

    }

}