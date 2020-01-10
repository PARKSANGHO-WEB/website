$(document).ready(function(){
   $('.icon_wrap li').on('click', function(){
    $(this).addClass('selected').siblings().removeClass('selected');
    
});
    

       $('.icon_btn1').on('click', function(){
        $('.order_ban2').css('display','block');
        $('.order_ban2_2,.order_ban2_3,.order_ban2_4,.order_ban2_5').css('display','none');

    });
       $('.icon_btn2').on('click', function(){
        $('.order_ban2_2').css('display','block');
        $('.order_ban2,.order_ban2_3,.order_ban2_4,.order_ban2_5').css('display','none');

    });
       $('.icon_btn3').on('click', function(){
        $('.order_ban2_3').css('display','block');
        $('.order_ban2,.order_ban2_2,.order_ban2_4,.order_ban2_5').css('display','none');

    });
       $('.icon_btn4').on('click', function(){
        $('.order_ban2_4').css('display','block');
        $('.order_ban2_2,.order_ban2_3,.order_ban2,.order_ban2_5').css('display','none');

    });
       $('.icon_btn5').on('click', function(){
        $('.order_ban2_5').css('display','block');
        $('.order_ban2_2,.order_ban2_3,.order_ban2_4,.order_ban2').css('display','none');

    });

    
});
