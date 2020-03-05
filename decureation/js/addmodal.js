

$(document).ready(function(){
    
    $("#myBtn_add").on("click",function(){
        $(".addmodal").css("display","block");
    });
    
    
    $("#myBtnm1").on("click",function(){
        $(".addmodal").css("display","block");
    });
    
    $(".addclose").on("click",function(){
        $(".addmodal").css("display","none");
    });
    
    $(".person_mo").on("click",function(){
        $(".personmodal").css("display","block");
    });
    
    $(".personclose").on("click",function(){
        $(".personmodal").css("display","none");
    });
    
    
    $(".begin_mo").on("click",function(){
        $(".beginmodal").css("display","block");
    });
    
    $(".beginclose").on("click",function(){
        $(".beginmodal").css("display","none");
    });
    
    
    $(".leave_mo").on("click",function(){
        $(".leavemodal").css("display","block");
    });
    
    $(".leaveclose").on("click",function(){
        $(".leavemodal").css("display","none");
        $(".star2_input").val(0);
        $(".star2 a").attr("class","fa-star-o");
        $(".star2 a").addClass("fa");
    });
    
    
    $(".delete_modal").on("click",function(){
        $(".delete").css("display","block");
    });
    
    $(".deleteclose").on("click",function(){
        $(".delete").css("display","none");
    });
    
    
    $(".begin_mo").on("click",function(){
        $(".beginmodal").css("display","block");
    });
    
    $(".beginclose").on("click",function(){
        $(".beginmodal").css("display","none");
    });
    
    $(".inter_mo").on("click",function(){
        $(".intermodal").css("display","block");
    });
    
    $(".interclose").on("click",function(){
        $(".intermodal").css("display","none");
    });
    
    $(".advan_mo").on("click",function(){
        $(".advanmodal").css("display","block");
    });
    
    $(".advanclose").on("click",function(){
        $(".advanmodal").css("display","none");
    });
    
    $(".forgot").on("click",function(){
        $(".forgot_m").css("display","block");
    });
    
    $(".forgotclose").on("click",function(){
        $(".forgot_m").css("display","none");
    });
    
    
    $(".static_mo").on("click",function(){
        $(".static").css("display","block");
    });
    
    $(".staticclose").on("click",function(){
        $(".static").css("display","none");
    });
    
    $(".modify_mo").on("click",function(){
        $(".modify").css("display","block");
    });
    
    $(".modifyclose").on("click",function(){
        $(".modify").css("display","none");
    });
    
    
    $(".add_myv").on("click",function(){
        $(".addmodal").css("display","block");
    });
    
    $(".addclose").on("click",function(){
        $(".addmodal").css("display","none");
    });
    
    
});
