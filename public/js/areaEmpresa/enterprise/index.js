$('input').on('beforeItemAdd', function(event) {
    var tag = event.item;
    // Do some processing here
    console.log(event);

    if (!event.options || !event.options.preventPost) {
       console.log('hola');
    }
 });

 $(document).on('click', '.close-modal', function(){
    enterpriseModal = $('#enterprise');
    enterpriseModal.find('.modal-title').text('Registrar Empresa');
    $('#btn-submit').attr('data-id', '');
    $('#business_name').val('');
    $('#address').val('');
    $('#legal_representative').val('');
 });