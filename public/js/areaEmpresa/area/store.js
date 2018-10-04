$('#form-store').submit(function(event){ 
    event.preventDefault();
    console.log($(this).find(':input'));
});