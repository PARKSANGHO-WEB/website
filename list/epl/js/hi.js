$(document).ready(function(){
	$('.ab-prev').click(function () {
		var cur = $('.script-t').index($('.script-t.active'));
		if (cur!=0) {
			$('.script-t').removeClass('active');
			$('.script-t').eq(cur-1).addClass('active');
		}
	});
	$('.ab-next').click(function () {
		var cur = $('.script-t').index($('.script-t.active'));
		if (cur!=$('.script-t').length-1) {
			$('.script-t').removeClass('active');
			$('.script-t').eq(cur+1).addClass('active');
		}
	});
});