$(document).ready(function () {
    $('.hwrap').mouseenter(function () {
        $(this).parents('.hover-r').addClass('on');
        $(this).parents('.hover-r').siblings().removeClass('on');
    });

    $('.hover-r').mouseleave(function () {
        $('.hover-r').removeClass('on');
    });

    var w = $('.right').width();
    var lw = $('.left').width();
    var wd = $(window).width();


    //	
    //	
    //	 $('.on-bg').css('width', wd);
    //
    //	
    //	
    //	
    //	$('.hover-r1').mouseenter(function(){
    //		$('.hwrap').addClass('on');
    //		$('.visu1').addClass('on');
    //		$('.visu1').stop().animate({width:wd,left: '-' + lw},"easeIn");
    //	});
    //	$('.hover-r1').mouseleave(function(){
    //		$('.hwrap').removeClass('on');
    //		$('.visu1').removeClass('on');
    //		$('.visu1').css('width','25%');
    //		$('.visu1').css('left','0');
    //	});
    //	
    //	$('.hover-r2').mouseenter(function(){
    //		$('.hwrap').addClass('on');
    //		$('.visu2').addClass('on');
    //		$('.visu2').stop().animate({width:wd,left: '-' + lw},"easeIn");
    //	});
    //	$('.hover-r2').mouseleave(function(){
    //		$('.hwrap').removeClass('on');
    //		$('.visu2').removeClass('on');
    //		$('.visu2').css('width','25%');
    //		$('.visu2').css('left','25%');
    //	});
    //	
    //	
    //	$('.hover-r3').mouseenter(function(){
    //		$('.hwrap').addClass('on');
    //		$('.visu3').addClass('on');
    //		$('.visu3').stop().animate({width:wd,left: '-' + lw},"easeIn");
    //	});
    //	$('.hover-r3').mouseleave(function(){
    //		$('.hwrap').removeClass('on');
    //		$('.visu3').removeClass('on');
    //		$('.visu3').css('width','25%');
    //		$('.visu3').css('left','50%');
    //	});




});




$(function () {
    //$(window).on("resize", function () {
    var WinW = $(window).width();

    var winW = $(".right").outerWidth(),
        target = $('.rwrap .title-wrap'),
        target2 = $('.rwrap .visual-wrap'),
        textBox = target.find('.hwrap'),
        length = 4,
        idx = 0,
        check = true,
        css = [],
        ease = "easeInOutQuint",
        time = 1000;
    if (WinW > 1255) {
        target2.find('.visubg').each(function (e) {
            css.push({
                'width': 100 / length + '%',
                'left': e * (100 / length) + '%',
                'left2': -e * 100 + '%'
            });
            $(this).css({
                    'width': css[e].width,
                    'left': css[e].left
                })
                .find('.on-bg').css({
                    'width': winW,
                    'left': css[e].left2
                });
        });

        target.find('.hover-r1').on("mouseenter", function () {
            $(this).addClass('on').siblings().addClass('off');
            $('.visu1').addClass('hover').stop().animate({
                    'left': '0',
                    'width': '100%'
                }, time, ease)
                .find('.on-bg').stop().animate({
                    'left': 0
                }, time, ease);
            $(".hover-r1 > .hover_txt").fadeIn();
            $(".hover-r1 >.hwrap>.hover-p1").stop().css({
                "font-size": "0",
                "margin-top": "-50px"
            });
            $(".hover-r1 >.hwrap>.hover-p2").stop().css({
                "margin-top": "80px",
                "color":"#fff"
            });
        });


        target.find('.hover-r1').on("mouseleave", function () {
            idx = $(this).index();
            $(this).removeClass('on').siblings().removeClass('off');
            $('.visu1').removeClass('hover').stop().css('width', '25%').css('left', '0%')
                .find('.on-bg').stop().css('left', '0px');
            $(".hover-r1 > .hover_txt").fadeOut();
            $(".hover-r1 >.hwrap>.hover-p1").stop().css({
                "font-size": "32px",
                "margin-top": "0px"
            });
            $(".hover-r1 >.hwrap>.hover-p2").stop().css({
                "margin-top": "0px",
                "color":"#B8B8B8"
            });
        });

        target.find('.hover-r2').on("mouseenter", function () {
            $(this).addClass('on').siblings().addClass('off');
            $('.visu2').addClass('hover').stop().animate({
                    'left': '0',
                    'width': '100%'
                }, time, ease)
                .find('.on-bg').stop().animate({
                    'left': 0
                }, time, ease);
            $(".hover-r2 > .hover_txt").fadeIn();
            $(".hover-r2 >.hwrap>.hover-p1").stop().css({
                "font-size": "0",
                "margin-top": "-50px"
            });
            $(".hover-r2 >.hwrap>.hover-p2").stop().css({
                "margin-top": "80px",
                "color":"#fff"
            });
        });

        target.find('.hover-r2').on("mouseleave", function () {
            idx = $(this).index();
            $(this).removeClass('on').siblings().removeClass('off');
            $('.visu2').removeClass('hover').stop().css('width', '25%').css('left', '25%')
                .find('.on-bg').stop().css('left', '-100%');
            $(".hover-r2 > .hover_txt").fadeOut();
            $(".hover-r2 >.hwrap>.hover-p1").stop().css({
                "font-size": "32px",
                "margin-top": "0px"
            });
            $(".hover-r2 >.hwrap>.hover-p2").stop().css({
                "margin-top": "0px",
                "color":"#B8B8B8"
            });
        });

        target.find('.hover-r3').on("mouseenter", function () {
            $(this).addClass('on').siblings().addClass('off');
            $('.visu3').addClass('hover').stop().animate({
                    'left': '0',
                    'width': '100%'
                }, time, ease)
                .find('.on-bg').stop().animate({
                    'left': 0
                }, time, ease);
            $(".hover-r3 > .hover_txt").fadeIn();
            $(".hover-r3 >.hwrap>.hover-p1").stop().css({
                "font-size": "0",
                "margin-top": "-50px"
            });
            $(".hover-r3 >.hwrap>.hover-p2").stop().css({
                "margin-top": "80px",
                "color":"#fff"
            });
        });

        target.find('.hover-r3').on("mouseleave", function () {
            idx = $(this).index();
            $(this).removeClass('on').siblings().removeClass('off');
            $('.visu3').removeClass('hover').stop().css('width', '25%').css('left', '50%')
                .find('.on-bg').stop().css('left', '-200%');
            $(".hover-r3 > .hover_txt").fadeOut();
            $(".hover-r3 >.hwrap>.hover-p1").stop().css({
                "font-size": "32px",
                "margin-top": "0px"
            });
            $(".hover-r3 >.hwrap>.hover-p2").stop().css({
                "margin-top": "0px",
                "color":"#B8B8B8"
            });
        });


        target.find('.hover-r4').on("mouseenter", function () {
            $(this).addClass('on').siblings().addClass('off');
            $('.visu4').addClass('hover').stop().animate({
                    'left': '0',
                    'width': '100%'
                }, time, ease)
                .find('.on-bg').stop().animate({
                    'left': 0
                }, time, ease);
            $(".hover-r4 > .hover_txt").fadeIn();
            $(".hover-r4 >.hwrap>.hover-p1").stop().css({
                "font-size": "0",
                "margin-top": "-50px"
            });
            $(".hover-r4 >.hwrap>.hover-p2").stop().css({
                "margin-top": "80px",
                "color":"#fff"
            });
        });

        target.find('.hover-r4').on("mouseleave", function () {
            idx = $(this).index();
            $(this).removeClass('on').siblings().removeClass('off');
            $('.visu4').removeClass('hover').stop().css('width', '25%').css('left', '75%')
                .find('.on-bg').stop().css('left', '-300%');
            $(".hover-r4 > .hover_txt").fadeOut();
            $(".hover-r4 >.hwrap>.hover-p1").stop().css({
                "font-size": "32px",
                "margin-top": "0px"
            });
            $(".hover-r4 >.hwrap>.hover-p2").stop().css({
                "margin-top": "0px",
                "color":"#B8B8B8"
            });
        });
        /* $(window).resize(function(){
           if ($(window).width() < 1255) {
              $('.hover-r').unbind('mouseenter mouseleave');
           }esle{
              $('.hover-r').bind('mouseenter mouseleave');
           }
        });*/
        /*$(window).on("resize", function () {
            var WinW = $(window).width();
            if (WinW < 1255) { //1255px 보다 작은 경우 이벤트 해제
                $(".hover-r").unbind("mouseenter mouseleave");
                $(".hover-r1").unbind("mouseenter mouseleave");
                $(".hover-r2").unbind("mouseenter mouseleave");
                $(".hover-r3").unbind("mouseenter mouseleave");
                $(".hover-r4").unbind("mouseenter mouseleave");
            }
        });
        $(window).on("resize", function () {
            var WinW = $(window).width();
            if (WinW > 1255) { //1255px 보다 클 경우 이벤트 시작
                $(".hover-r").bind("mouseenter mouseleave");
                $(".hover-r1").bind("mouseenter mouseleave");
                $(".hover-r2").bind("mouseenter mouseleave");
                $(".hover-r3").bind("mouseenter mouseleave");
                $(".hover-r4").bind("mouseenter mouseleave");
            }
        });*/
    }
    //});
    $(window).on("resize", function () {
        var WinW = $(window).width();
        if (WinW < 1255) { //1255px 보다 작은 경우 이벤트 해제
            $(".hover-r").unbind("mouseenter mouseleave");
            $(".hover-r1").unbind("mouseenter mouseleave");
            $(".hover-r2").unbind("mouseenter mouseleave");
            $(".hover-r3").unbind("mouseenter mouseleave");
            $(".hover-r4").unbind("mouseenter mouseleave");
        }
    });

	
	
	var i = 0;

	$(function () {
		$(window).on("resize", function () {
			var windowsize = $(this).width();
			if (windowsize <= 1255 && i === 0) {
				i = 1;
			} else if (windowsize > 1255 && i == 1) {
				location.reload();
				i = 0;
			}
		});
	});
});
