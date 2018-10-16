$(document).on('click', '.close-modal', function(){
    enterpriseModal = $('#Area');
    enterpriseModal.find('.modal-title').text('Crear Area');
    $('#btn-submit').attr('data-id', '');
    $('#nameA').val('');
    $('#exten').val('');
    $('#email').val('');
    $('#description').val('');
 });