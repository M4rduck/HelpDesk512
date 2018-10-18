function loadTracings(){
    showChat = $('#show-chat');
    chat = $('.chat');

    chat.LoadingOverlay('show');
    $.getJSON(showChat.val())
    .done(function(data){
        chat.LoadingOverlay('hide', true);
        if(data.success && !data.error){
            chat.html(data.body);
        }else{
            toastr.error(data.msg);
        }
    }).fail(function(jqXHR, textStatus){
        chat.LoadingOverlay('hide', true);
    });
}

$('#chat-box').slimScroll({
    height: '400px'
});

loadTracings();