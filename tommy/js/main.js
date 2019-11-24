$(function(){
    var a = $("#slide_img div img").css("height");
    var b = $("header").css("height");
    var c = $("footer").css("height");
    
	$('.bxslider').bxSlider({
		nextText: '<img src="main/main_page/arrow_right.jpg" height="70" width="40"/>',
		prevText: '<img src="main/main_page/arrow_left.jpg" height="70" width="40"/>',
		auto: true,
		autoControls: false,
		stopAutoOnClick: true,
		pager: false,
		speed: 1000,
        delay: 500,
		slideMargin: 0
        
	});
    
        $('#slide_img div img').css('height', $(window).height() -113);
        $('#slide_img div img').css('width', $(window).width());
    $(window).resize(function() {
        $('#slide_img div img').css('height', $(window).height() -113);
        $('#slide_img div img').css('width', $(window).width());
   });
});
 