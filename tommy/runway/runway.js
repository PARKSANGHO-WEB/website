$(function(){
        var aa = $(".runway_page2, .runway_page3, .runway_page4, .runway_page5, .runway_page6, .runway_page7, .runway_page8");
        var bb = $(".runway_page1, .runway_page3, .runway_page4, .runway_page5, .runway_page6, .runway_page7, .runway_page8");
        var cc = $(".runway_page1, .runway_page2, .runway_page4, .runway_page5, .runway_page6, .runway_page7, .runway_page8");
        var dd = $(".runway_page1, .runway_page2, .runway_page3, .runway_page5, .runway_page6, .runway_page7, .runway_page8");
        var ee = $(".runway_page1, .runway_page2, .runway_page3, .runway_page4, .runway_page6, .runway_page7, .runway_page8");
        var ff = $(".runway_page1, .runway_page2, .runway_page3, .runway_page4, .runway_page5, .runway_page7, .runway_page8");
        var gg = $(".runway_page1, .runway_page2, .runway_page3, .runway_page4, .runway_page5, .runway_page6, .runway_page8");
        var hh = $(".runway_page1, .runway_page2, .runway_page3, .runway_page4, .runway_page5, .runway_page6, .runway_page7");
    
    
        var aaaa = $(".run_2, .run_3, .run_4, .run_5, .run_6, .run_7, .run_8");
        var bbbb = $(".run_1, .run_3, .run_4, .run_5, .run_6, .run_7, .run_8");
        var cccc = $(".run_1, .run_2, .run_4, .run_5, .run_6, .run_7, .run_8");
        var dddd = $(".run_1, .run_2, .run_3, .run_5, .run_6, .run_7, .run_8");
        var eeee = $(".run_1, .run_2, .run_3, .run_4, .run_6, .run_7, .run_8");
        var ffff = $(".run_1, .run_2, .run_3, .run_4, .run_5, .run_7, .run_8");
        var gggg = $(".run_1, .run_2, .run_3, .run_4, .run_5, .run_6, .run_8");
        var hhhh = $(".run_1, .run_2, .run_3, .run_4, .run_5, .run_6, .run_7");
    
        
    
        var sum = 0;
		  $(".runway_page1").on("click",function(){
              var a = $(".runway_page1").css("z-index");
              if(a!=sum){
                  sum++;
                  $(".run_1").css({"z-index":sum});
				  $(".run_1").stop().animate({"opacity":"1"},1000,"linear");
                  $(".runway_page1").css({"color":"#b30c2f;"});
                  $(aa).css({"color":"#00174f"});
                  $(aaaa).animate({"opacity":"0"},1000,"linear");
                          
              }
		});
		  $(".runway_page2").on("click",function(){
              var a = $(".runway_page2").css("z-index");
              if(a!=sum){
                  sum++;
                  $(".run_2").css({"z-index":sum});
				  $(".run_2").stop().animate({"opacity":"1"},1000,"linear");
                  $(".runway_page2").css({"color":"#b30c2f;"});
                  $(bb).css({"color":"#00174f"});   
                  $(bbbb).animate({"opacity":"0"},1000,"linear");
              }
		});
		  $(".runway_page3").on("click",function(){
              var a = $(".runway_page3").css("z-index");
              if(a!=sum){
                  sum++;
                  $(".run_3").css({"z-index":sum});
				  $(".run_3").stop().animate({"opacity":"1"},1000,"linear");
                  $(".runway_page3").css({"color":"#b30c2f;"});
                  $(cc).css({"color":"#00174f"});
                  $(cccc).animate({"opacity":"0"},1000,"linear");
              }
		});
		  $(".runway_page4").on("click",function(){
              var a = $(".runway_page4").css("z-index");
              if(a!=sum){
                  sum++;
                  $(".run_4").css({"z-index":sum});
				  $(".run_4").stop().animate({"opacity":"1"},1000,"linear");
                  $(".runway_page4").css({"color":"#b30c2f;"});
                  $(dd).css({"color":"#00174f"});
                  $(dddd).animate({"opacity":"0"},1000,"linear");
              }
		});
		  $(".runway_page5").on("click",function(){
              var a = $(".runway_page5").css("z-index");
              if(a!=sum){
                  sum++;
                  $(".run_5").css({"z-index":sum});
				  $(".run_5").stop().animate({"opacity":"1"},1000,"linear");
                  $(".runway_page5").css({"color":"#b30c2f;"});
                  $(ee).css({"color":"#00174f"});
                  $(eeee).animate({"opacity":"0"},1000,"linear");
              }
		});
		  $(".runway_page6").on("click",function(){
              var a = $(".runway_page6").css("z-index");
              if(a!=sum){
                  sum++;
                  $(".run_6").css({"z-index":sum});
				  $(".run_6").stop().animate({"opacity":"1"},1000,"linear");
                  $(".runway_page6").css({"color":"#b30c2f;"}   );
                  $(ff).css({"color":"#00174f"});
                  $(ffff).animate({"opacity":"0"},1000,"linear");
              }
		});
		  $(".runway_page7").on("click",function(){
              var a = $(".runway_page7").css("z-index");
              if(a!=sum){
                  sum++;
                  $(".run_7").css({"z-index":sum});
				  $(".run_7").stop().animate({"opacity":"1"},1000,"linear");
                  $(".runway_page7").css({"color":"#b30c2f;"});
                  $(gg).css({"color":"#00174f"});
                  $(gggg).animate({"opacity":"0"},1000,"linear");
              }
		});
		  $(".runway_page8").on("click",function(){
              var a = $(".run_8").css("z-index");
              if(a!=sum){
                  sum++;
                  $(".run_8").css({"z-index":sum});
				  $(".run_8").stop().animate({"opacity":"1"},1000,"linear");
                  $(".runway_page8").css({"color":"#b30c2f;"});
                  $(hh).css({"color":"#00174f"});
                  $(hhhh).animate({"opacity":"0"},1000,"linear");
              }
		});
});




