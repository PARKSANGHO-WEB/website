
$(document).ready(function(){
	$('#nav-icon1').click(function(){
		$(this).toggleClass('open');
        $(".menu_over").slideToggle(300);
	});
    
    
    $("input[type=radio][name=ps]").on("click",function(){
        
        var chkValue = $("input[type=radio][name=ps]:checked").val();
        
        
        if(chkValue == 'one') {
            $('.store').css('display','none');
        }else if( chkValue = 'two'){
            
            $('.store').css('display','block');
        }
        
        
    });
    
    
    $(".faq_t").click(function(){
        $(this).toggleClass("check");
        $(this).parent().siblings().children().removeClass("check");
        $(this).siblings('.faq_a').slideToggle(300);
        $(this).parents().siblings().children('.faq_a').slideUp(300);
    });
    
    
    $(".c_btn1").click(function(){
        $(this).addClass("on");
        $(this).siblings().removeClass("on");
        $(".notice_wrap").css('display','block');
        $(".faq_wrap,.question_wrap").css('display','none');
    });
    $(".c_btn2").click(function(){
        $(this).addClass("on");
        $(this).siblings().removeClass("on");
        $(".faq_wrap").css('display','block');
        $(".notice_wrap,.question_wrap").css('display','none');
    });
    $(".c_btn3").click(function(){
        $(this).addClass("on");
        $(this).siblings().removeClass("on");
        $(".question_wrap").css('display','block');
        $(".notice_wrap,.faq_wrap").css('display','none');
    });
    
});