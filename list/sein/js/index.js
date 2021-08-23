$(Document).ready(function(){
    $(".menu-btn").on("click",function(){
        $("header").stop().toggleClass("none");
        $(this).stop().toggleClass("on");
        $("section").stop().toggleClass("lock");
        $(".gnb .gnb-wrap").stop().toggleClass("in");
    });
    
//    $(".menu_2").on("click",function(){
//        $(".menu_2 ul").slideToggle(300);
//    });
    
});