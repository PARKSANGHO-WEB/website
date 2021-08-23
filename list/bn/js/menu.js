$(document).ready(function(){
    $(".bar").on("click",function(){
        $(".bar div").toggleClass("click");
        $(".m_header").toggleClass("click");
        $(".m_menu").toggleClass("click");
    });
    
    
    $(".depth_men").on("click",function(){
        $(".bar div").removeClass("click");
        $(".m_header").removeClass("click");
        $(".m_menu").removeClass("click");
    });
    
//    $(".m_menuw ul li p").on("click",function(){
//        $(this).toggleClass("click");
//        $(this).parent().siblings().children("p").removeClass("click");
//        $(this).siblings(".depth_men").slideToggle(300);
//        $(this).parent().siblings().children(".depth_men").slideUp(300);
//    });
//    
});