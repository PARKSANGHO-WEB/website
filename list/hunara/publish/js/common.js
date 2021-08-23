//210428 말줄임 스크립트 추가

$(document).ready(function(){
	
	$('.line2').ellipsis({
		  lines: 2,             // force ellipsis after a certain number of lines. Default is 'auto'
		  ellipClass: 'ellip1',  // class used for ellipsis wrapper and to namespace ellip line
		  responsive: false      // set to true if you want ellipsis to update on window resize. Default is false
	});
});



// 메인 슬라이드 이미지 피팅
$(document).ready(function() {
	$('.ml-img img').each(function() {
		var img = $(this);
		fitimg(img);
		img.parent().resize(function() {
			fitimg(img);
		});
	});

	
	function fitimg(img){
		var ratio = 0;
		var width = img.width();
		var height = img.height();

		ratio = width / height;
		if(ratio <= 1){
		  img.css({
			'height': '100%',
		  });
		} else {
		  img.css({
			'height': '100%',
		  });
		}
	}
});



$(document).ready(function() {
	$('img').each(function() {
		var img = $(this);
		fitimg(img);
		img.parent().resize(function() {
			fitimg(img);
		});
	});

	
	function fitimg(img){
		var ratio = 0;
		var width = img.width();
		var height = img.height();

		ratio = width / height;
		if(ratio <= 1){
		  img.css({
			'height': '100%!important;',
		  });
		} else {
		  img.css({
			'height': '100%!important;',
		  });
		}
	}
});





//스크롤, 셀렉트 박스 

$(document).ready(function(){

	$(".content-rd").mCustomScrollbar({
		theme:"light-3"
	});


	$('select').wSelect();

});


//input 숫자만 입력

$(document).ready(function () {

	$('.only-num').on('paste', function (event) {
		if (event.originalEvent.clipboardData.getData('Text').match(/[^\d]/)) {
			event.preventDefault();
		}
	});

	$(".only-num").on("keypress",function(event){
		if(event.which < 48 || event.which >58){
			return false;
		}
	});
});







//모달

$(document).ready(function(){
	
	
    $(".go-reser").click(function(){
        $(".subroom-modal").addClass("visible");
            event.stopPropagation();
    });
	
    $(".current-btn").click(function(){
        $(".want-modal").addClass("visible");
            event.stopPropagation();
    });
	
	
    $(".survey").click(function(){
        $(".survey-modal").addClass("visible");
            event.stopPropagation();
    });
	
    $(".filter-btn").click(function(){
        $("#sidebar").addClass("visible");
            event.stopPropagation();
    });
	
    $(".pri-mod").click(function(){
        $(".pri-modal").addClass("visible");
            event.stopPropagation();
    });
	
	
    $(".chg-pw").click(function(){
        $(".change-modal").addClass("visible");
            event.stopPropagation();
    });
	
	
    $(".go-pg").click(function(){
        $(".pg-modal").addClass("visible2");
            event.stopPropagation();
    });
	
	
	
    $(".input-pw").click(function(){
        $(".modi-modal").addClass("visible");
            event.stopPropagation();
    });
	
	
	
	
	
    $(document).click(function(event){
        if ($(event.target).hasClass('visible')) {
            $(".modal-wrap").removeClass("visible");
        }
    });
	
	
    $(document).click(function(event){
        if ($(event.target).hasClass('visible2')) {
            $(".modal-wrap2").removeClass("visible2");
        }
    });
	
	$('.close-modal2').on('click',function(){
		$(".modal-wrap2").removeClass("visible2");
	});
	
	$('.close-modal').on('click',function(){
		$(".modal-wrap").removeClass("visible");
	});
});




//상세 마우스 호버시에 이미지 변경


$(document).ready(function(){
	$('a.thumbnail').on("mouseover",function () {
		$('#productImage').attr('src',$(this).children('img').attr('src').replace('60/60','400/200'));
	})
});



//모바일 메뉴

$(document).ready(function(){

	$('.bar').on('click',function(){
		$(this).toggleClass('active');
		$(this).parents('body').toggleClass('active');
		$('.mobile-menu').toggleClass('active');
	});

});






// 기타입력


$(document).ready(function(){

	document.getElementById('else').onchange = function() {
		document.getElementById('anything').disabled = !this.checked;
	};

	document.getElementById('else2').onchange = function() {
		document.getElementById('anything2').disabled = !this.checked;
	};
});




//서브메뉴

$(document).ready(function(){

	$('#subMenu2 button').click(function(){

	  $(this).addClass('active');
	  $('#subMenu2 button').not(this).removeClass('active');

	});
});


jQuery(function($) {

    window.onresize = function(){
      document.location.reload();
    };

});

