$(function(){
    var aa = $("#year_2017, #year_2016, #year_2015");
    
    $("#year_2017").on("click",function(){
        $("#year_2017").css({"color":"#b30c2f"});
        
        $("#year_2016, #year_2015").css({"color":"#00174f"});
        
        $("section article #news_top #top_2017").css({"display":"block"});
        $("section article #news_mid #mid_2017").css({"display":"block"});
        $("section article #news_bot #bot_2017").css({"display":"block"});
        
        $("section article #news_top #top_2016").css({"display":"none"});
        $("section article #news_mid #mid_2016").css({"display":"none"});
        $("section article #news_bot #bot_2016").css({"display":"none"});
        
        $("section article #news_top #top_2015").css({"display":"none"});
        $("section article #news_mid #mid_2015").css({"display":"none"});
        $("section article #news_bot #bot_2015").css({"display":"none"});
    });
    $("#year_2016").on("click",function(){
        $("#year_2016").css({"color":"#b30c2f"});
        
        $("#year_2017, #year_2015").css({"color":"#00174f"});
        
        
        $("section article #news_top #top_2017").css({"display":"none"});
        $("section article #news_mid #mid_2017").css({"display":"none"});
        $("section article #news_bot #bot_2017").css({"display":"none"});
        
        $("section article #news_top #top_2016").css({"display":"block"});
        $("section article #news_mid #mid_2016").css({"display":"block"});
        $("section article #news_bot #bot_2016").css({"display":"block"});
        
        $("section article #news_top #top_2015").css({"display":"none"});
        $("section article #news_mid #mid_2015").css({"display":"none"});
        $("section article #news_bot #bot_2015").css({"display":"none"});
    });
    $("#year_2015").on("click",function(){
        $("#year_2015").css({"color":"#b30c2f"});        
        
        $("#year_2017, #year_2016").css({"color":"#00174f"});
        
        $("section article #news_top #top_2017").css({"display":"none"});
        $("section article #news_mid #mid_2017").css({"display":"none"});
        $("section article #news_bot #bot_2017").css({"display":"none"});
        
        $("section article #news_top #top_2016").css({"display":"none"});
        $("section article #news_mid #mid_2016").css({"display":"none"});
        $("section article #news_bot #bot_2016").css({"display":"none"});
        
        $("section article #news_top #top_2015").css({"display":"block"});
        $("section article #news_mid #mid_2015").css({"display":"block"});
        $("section article #news_bot #bot_2015").css({"display":"block"});
    });
    
    
    $("#top_2017 .top_1 .data_wrap").on("click",function(){
        $("#article_1").css({"display":"block"});
    });
    
    $("#article_1 #article_wrap #img_wrap #out").on("click",function(){
        $("#article_1").css({"display":"none"});
    });
    
    $("#top_2017 .top_2 .data_wrap").on("click",function(){
        $("#article_2").css({"display":"block"});
    });
    
    $("#article_2 #article_wrap_2 #img_wrap_2 #out_2").on("click",function(){
        $("#article_2").css({"display":"none"});
    });
    
    $("#top_2017 .top_3 .data_wrap").on("click",function(){
        $("#article_3").css({"display":"block"});
    });
    
    $("#article_3 #article_wrap_3 #img_wrap_3 #out_3").on("click",function(){
        $("#article_3").css({"display":"none"});
    });
    
    
    
    $("#mid_2017 .mid_1 .data_wrap").on("click",function(){
        $("#article_4").css({"display":"block"});
    });
    
    $("#article_4 #article_wrap_4 #img_wrap_4 #out_4").on("click",function(){
        $("#article_4").css({"display":"none"});
    });
    
    $("#mid_2017 .mid_2 .data_wrap").on("click",function(){
        $("#article_5").css({"display":"block"});
    });
    
    $("#article_5 #article_wrap_5 #img_wrap_5 #out_5").on("click",function(){
        $("#article_5").css({"display":"none"});
    });
        
    $("#mid_2017 .mid_3 .data_wrap").on("click",function(){
        $("#article_6").css({"display":"block"});
    });
    
    $("#article_6 #article_wrap_6 #img_wrap_6 #out_6").on("click",function(){
        $("#article_6").css({"display":"none"});
    });
            
    $("#bot_2017 .bot_1 .data_wrap").on("click",function(){
        $("#article_7").css({"display":"block"});
    });
    
    $("#article_7 #article_wrap_7 #img_wrap_7 #out_7").on("click",function(){
        $("#article_7").css({"display":"none"});
    });
            
    $("#bot_2017 .bot_2 .data_wrap").on("click",function(){
        $("#article_8").css({"display":"block"});
    });
    
    $("#article_8 #article_wrap_8 #img_wrap_8 #out_8").on("click",function(){
        $("#article_8").css({"display":"none"});
    });
            
    $("#bot_2017 .bot_3 .data_wrap").on("click",function(){
        $("#article_9").css({"display":"block"});
    });
    
    $("#article_9 #article_wrap_9 #img_wrap_9 #out_9").on("click",function(){
        $("#article_9").css({"display":"none"});
    });
        
        
     
});