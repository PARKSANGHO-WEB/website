$(document).ready(function(){
	$('.list-view').on('click',function(){
		$(this).addClass('on');
		$('.list-square').removeClass('on');
		
		$(this).parents('.fil-wrap').siblings('.room-right').find('.rr-list').addClass('list');
		$(this).parents('.fil-wrap').siblings('.room-right').find('.rr-list').removeClass('square');
	});
	
	
	$('.list-square').on('click',function(){
		$(this).addClass('on');
		$('.list-view').removeClass('on');
		
		
		$(this).parents('.fil-wrap').siblings('.room-right').find('.rr-list').addClass('square');
		$(this).parents('.fil-wrap').siblings('.room-right').find('.rr-list').removeClass('list');
	});
});