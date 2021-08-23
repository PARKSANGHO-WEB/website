$(document).ready(function(){
    $(".sub2_2c ul li").mouseenter(function(){
        $(this).addClass("big");
        $(this).siblings().addClass("sm");
    });
    
    $(".sub2_2c ul li").mouseleave(function(){
        $(this).removeClass("big");
        $(this).siblings().removeClass("sm");
    });
    
});