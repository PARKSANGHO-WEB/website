
    
$(document).ready(function(){
    $(document).delegate(".show-ts","click", function(event) {
        $(".terms-modal").addClass("visible");
            event.stopPropagation();
    });
    
    $(".close-btn").click(function(){
        $(".terms-modal").removeClass("visible");
    });
    
    $(document).click(function(event){
        if ($(event.target).hasClass('visible')) {
            $(".terms-modal").removeClass("visible");
        }
    });
    
}); 
     
    
$(document).ready(function(){
    $(document).delegate(".show-pp","click", function(event) {
        $(".policy-modal").addClass("visible");
            event.stopPropagation();
    });
    
    $(".close-btn").click(function(){
        $(".policy-modal").removeClass("visible");
    });
    
    $(document).click(function(event){
        if ($(event.target).hasClass('visible')) {
            $(".policy-modal").removeClass("visible");
        }
    });
    
});
//
//$(document).ready(function(){
//
//	$(".img").children("img").each(function(){
//		imgRatio = $(this).height()/$(this).width();
//		containerRatio = $(this).parent().height()/$(this).parent().width();
//		if (imgRatio > containerRatio) {
//			$(this).css({
//				height: '100%',
//				width: 'auto'
//			});
//		} else {
//			$(this).css({
//				height: 'auto',
//				width: '100%'
//			});
//		}
//	});
//
//
//
//});


$(document).ready(function(){
	$('.sear-btn').on('click',function(){
		$(this).parents("header").toggleClass('in');
	});
	
	
	$('.close-sear').on('click',function(){
		$(this).siblings("input").val("");
		$(this).parents("header").removeClass('in');
	});
	
	

	$('.menu-top').on('click',function(){
		$(this).parents('.big-mb').siblings().removeClass('on');
		$(this).parents('.big-mb').toggleClass('on');
	});

});



$(window).resize(function() {
    if ($(window).width() < 1300) {
        $('div').removeClass('content-rd');
    } 
}).resize(); // trigger resize event initially


