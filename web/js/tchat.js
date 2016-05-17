function displayMessage(data){
    var htmlCraCra = '<li class="left clearfix">'+
        '<span class="chat-img pull-left">'+
        '<a href="/user/'+data.author.id+'"><img src="'+data.author.avatar+'+" alt="User Avatar" class="img-circle avatar" /></a>'+
        '</span>'+
        '<div class="chat-body clearfix">'+
        '<div class="header">'+
        '<a href="/user/'+data.author.id+'"><strong class="primary-font">'+data.author.username+'</strong></a>'+
        '<small class="pull-right text-muted">'+
        '<span class="glyphicon glyphicon-time"></span>'+data.date+'</small>'+
        '</div><p>'+data.message+'</p></div></li>';
    $('.chat').append(htmlCraCra);
    autoScroll();
}

function autoScroll(){
    $('#chat-content').animate({
        scrollTop: $('#chat-content').get(0).scrollHeight}, 2000);
}

$(document).ready(function(){
    autoScroll();
    // Listening on notification from server{

    // Getting socket

    var socket = io('http://node.bfoucher.fr');

    socket.on('notification', function (data) {
        data = $.parseJSON(data);
        displayMessage(data);

    });

    // Listener on form submit event
    $(document).on('submit', '.form-tchat', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '/tchat',
            data: $(this).serialize(),
            success : function(response){
                console.log('Message send.');
                //On vide le formulaire
                $('#tchat_message').val('');
                //TODO:Auto Scroll dans les messages...
            },
            error : function(response){
                console.log('Something went wrong.');
            },
            cache: false
        });

        return false;
    });
});