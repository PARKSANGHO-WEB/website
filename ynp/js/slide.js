
$(document).ready(function(){
 
    
    $(".q_list .q").on("click", function() {
        $(this).next().slideToggle();
        $(this).children(".right").toggleClass("active");
    });

});