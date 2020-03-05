$('#prev').on('click', function () {
    var last = $('.logo').last().css({opacity: '0', width: '0px'});
    last.prependTo('.showrooms');
    last.animate({opacity: '1', width: '108px'});
});
$('#next').on('click', function () {
    var first = $('.logo').first();
    first.animate({opacity: '0', width: '0px'}, function() {
        first.appendTo('.showrooms').css({opacity: '1', width: '108px'});
    });
});