function loadTracings(){
    showChat = $('#show-chat');
    chat = $('.chat');

    chat.LoadingOverlay('show');
    $.getJSON(showChat.val())
    .done(function(data){
        chat.LoadingOverlay('hiden', true);
        if(data.success && !data.error){
            chat.html(data.body);
        }else{
            toastr.error(data.msg);
        }
    }).fail(function(jqXHR, textStatus){
        chat.LoadingOverlay('hiden', true);
    });
}

$('#chat-box').slimScroll({
    height: '400px'
});

loadTracings();