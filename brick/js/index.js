$(function(){
    
  $(window).scroll(function(){
  	var scroll = $(window).scrollTop();
	  if (scroll > 50) {
	    $("nav").css("background" , "rgba(162, 100, 67, 0.9");
	  }

	  else{
		  $("nav").css("background" , "rgba(162, 100, 67, 1)"); 
	
	  }
  });
    

    
    $(function(){
        $(".btn-coffee > p").on("click",function(){
            $(".btn-coffee > p").addClass("mhover");  
            $(".btn-bread > p").removeClass("mhover");   
            $(".menu-w").css("display","block");
            $(".menu-e").css("display","none");
        });
        $(".btn-bread > p").on("click",function(){
            $(".btn-bread > p").addClass("mhover");  
            $(".btn-coffee > p").removeClass("mhover");     
            $(".menu-w").css("display","none");
            $(".menu-e").css("display","block"); 
        });
    });
});