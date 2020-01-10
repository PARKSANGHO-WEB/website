$(document).ready(function(){
    $(".que-tab li").on("click",function(){
        $(this).addClass('selected').siblings().removeClass('selected');
    });
    
    
    $(".que-tab li:eq(0)").on("click",function(){
      $(".notice").css('display','block');  
      $(".que, .faq_list, .que_sub").css('display','none');  
    });
    $(".que-tab li:eq(1)").on("click",function(){
      $(".que").css('display','block');  
      $(".notice, .faq_list, .que_sub").css('display','none');  
    });
    $(".que-tab li:eq(2)").on("click",function(){
      $(".faq_list").css('display','block');  
      $(".que, .notice, .que_sub").css('display','none');  
    });
    
    $(".review_btn").on("click",function(){
      $(".que_sub").css('display','block');  
      $(".que, .notice, .faq_list").css('display','none');  
    });
    
     
});