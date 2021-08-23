$(document).ready(function(){
	
	
    $(".add-people").click(function(){
        $(".add-modal").addClass("visible");
            event.stopPropagation();
    });
	
    $(".limit-peopel").click(function(){
        $(".limit-modal").addClass("visible");
            event.stopPropagation();
    });
	
	/*
    $(".com-mo").click(function(){
        $(".com-modal").addClass("visible");
            event.stopPropagation();
    });
    */
	
	
    $(".room-mo").click(function(){
        $(".room-modal").addClass("visible");
            event.stopPropagation();
    });
	
    $(".opt-set").click(function(){
        $(".calendar-modal").addClass("visible");
            event.stopPropagation();
    });
	/*
    $(".sns-on").click(function(){
        $(".noti-modal").addClass("visible");
            event.stopPropagation();
    });
	*/
    $(".cal-modal").click(function(){
        $(".recal-modal").addClass("visible");
            event.stopPropagation();
    });
	
	
	
	
	
	
    $(document).click(function(event){
        if ($(event.target).hasClass('visible')) {
            $(".modal-wrap").removeClass("visible");
        }
    });
	
	$('.close-modal').on('click',function(){
		$(".modal-wrap").removeClass("visible");
	});
});