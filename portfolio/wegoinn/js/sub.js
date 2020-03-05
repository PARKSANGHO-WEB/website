$(document).ready(function(){
    $('.about_more').click(function(){
        $(this).toggleClass('more_view');
        $(this).parent().parent().siblings('.ans').slideToggle();
    });
    
    $('.check_class').click(function(){
        $(this).addClass('on');
    });
    
    $('.more_bt').click(function(){
        $(this).siblings('.sl_con').slideToggle(300);
    });
});