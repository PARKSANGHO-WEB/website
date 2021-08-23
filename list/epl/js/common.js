


//모달

$(document).ready(function(){
	
	
    $(".login-btn").click(function(){
        $(".login-modal").addClass("visible");
            event.stopPropagation();
    });
	
	
    $(".blur-notlogin").click(function(){
        $(".login2-modal").addClass("visible");
            event.stopPropagation();
    });
	
	
	
    $(".not-login").click(function(){
        $(".login-modal").addClass("visible");
            event.stopPropagation();
    });
	
	
    $(".re-study").click(function(){
        $(".restu-modal").addClass("visible");
            event.stopPropagation();
    });
	
	
    $(".using-btn").click(function(){
        $(".using-modal").addClass("visible");
            event.stopPropagation();
    });
	
	
    $(".privacy-btn").click(function(){
        $(".privacy-modal").addClass("visible");
            event.stopPropagation();
    });
	
	
	
    $(".find-btn").click(function(){
		$(".login-modal").removeClass("visible");
        $(".find-modal").addClass("visible");
            event.stopPropagation();
    });
	
    $(".okay-find").click(function(){
		$(".find-modal").removeClass("visible");
        $(".finish-modal").addClass("visible");
            event.stopPropagation();
    });
	
    $(".re-login").click(function(){
		$(".finish-modal").removeClass("visible");
        $(".login-modal").addClass("visible");
            event.stopPropagation();
    }); 
	
	
    $(".find-pw").click(function(){
		$(".finish-modal").removeClass("visible");
        $(".findpw-modal").addClass("visible");
            event.stopPropagation();
    });
	
	
    $(".change-info").click(function(){
        $(".error5-modal").addClass("visible");
            event.stopPropagation();
    });
	
	
    $(".change-btn").click(function(){
		$(".login-modal").removeClass("visible");
        $(".findpw-modal").addClass("visible");
            event.stopPropagation();
    });
	
	
	
    $(".sece-btn").click(function(){
        $(".sece-modal").addClass("visible");
            event.stopPropagation();
    });
	
	
    $(".buy-btn").click(function(){
        $(".buy-modal").addClass("visible");
            event.stopPropagation();
    });
	
	
    $(".sece-yes").click(function(){
        $(".sece-modal").removeClass("visible");
        $(".seyes-modal").addClass("visible");
            event.stopPropagation();
    });
	
	
    $(".cancel-btn").click(function(){
        $(".paycan-modal").addClass("visible");
            event.stopPropagation();
    });
	
    $(".paycan-yes").click(function(){
        $(".error-modal").addClass("visible");
            event.stopPropagation();
    });
	
	
//    $(".okay-start").click(function(){
//        $(".level-modal").addClass("visible");
//            event.stopPropagation();
//    });
//	
//	
    $(".refresh-study").click(function(){
        $(".restu-modal").removeClass("visible");
        $(".level-modal").addClass("visible");
            event.stopPropagation();
    });
	
	
    /*$(".login-go").click(function(){
        $(".login-modal").removeClass("visible");
        $(".blur-notlogin").css('display','none');
            event.stopPropagation();
    });*/
	
	
	
//	
//	
//    $(document).click(function(event){
//        if ($(event.target).hasClass('visible')) {
//            $(".modal-wrap").removeClass("visible");
//        }
//    });
	
	
	
	$('.close-modal').on('click',function(){
		$(this).parents(".modal-wrap").removeClass("visible");
	});
	
	
	
	$('.close2-modal').on('click',function(){
		$(this).parents(".error-modal").removeClass("visible");
	});
	
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



// 회원가입 페이지 체크박스

$(document).ready(function(){
    
    $("#all-agree").click(function(){
        if($("#all-agree").is(":checked")){
            $(".chk").prop("checked",true);
        }
        else{
            $(".chk").prop("checked",false);
        }
    });

    $(".chk").click(function(){
        
		if($("input[name='chk']:checked").length == 2){
            $("#all-agree").prop("checked",true);
        }else{
            $("#all-agree").prop("checked",false);
        }

    });
	

	$('.agree-toggle').click(function(){
		
			$(this).parents('.j2-line').toggleClass('on');
			$('.j2-line').not($(this).parents('.j2-line')).removeClass('on');
			
	});
});







//셀렉트



$(document).ready(function() {

	$('select').each(function(){
		var $this = $(this), numberOfOptions = $(this).children('option').length;

		$this.addClass('select-hidden'); 
		$this.wrap('<div class="select"></div>');
		$this.after('<div class="select-styled"></div>');

		var $styledSelect = $this.next('div.select-styled');
		$styledSelect.text($this.children('option').eq(0).text());

		var $list = $('<ul />', {
			'class': 'select-options'
		}).insertAfter($styledSelect);

		for (var i = 0; i < numberOfOptions; i++) {
			$('<li />', {
				text: $this.children('option').eq(i).text(),
				rel: $this.children('option').eq(i).val()
			}).appendTo($list);
		}

		var $listItems = $list.children('li');

		$styledSelect.click(function(e) {
			e.stopPropagation();
			$('div.select-styled.active').not(this).each(function(){
			$(this).removeClass('active').next('ul.select-options').hide();
		});
			$(this).toggleClass('active').next('ul.select-options').toggle();
		});

		$listItems.click(function(e) {
			e.stopPropagation();
			$styledSelect.text($(this).text()).removeClass('active');
			$this.val($(this).attr('rel'));
			$list.hide();
		});

		$(document).click(function() {
		$styledSelect.removeClass('active');
		$list.hide();
		});

	});
});



//멤버십 상단 선택


$(document).ready(function(){
	
	$('.lm-big').click(function(){

		$(this).addClass('active');
		$('.lm-big').not(this).removeClass('active');
		
		
		 $('.month-in').val($(this).find('.ml-t').text());
		 $('.price-in').val($(this).find('.mem-price').text());
		
		
		
	});
	
});

$(document).ready(function(){

	var swiper = new Swiper('.swiper-study', {
		slidesPerView: 4,
		spaceBetween: 20,
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});


	$('.big-info').ellipsis({
		 row: 3
	});

	$('.big-title').ellipsis({
		 row: 2
	});
});



// 학습레벨 모달
/*$('.add').click(function () {
	
	alert($(this).prev().find('.field').val());
	
    if ($(this).prev().find('.field').val() < 100) $(this).prev().find('.field').val(+$(this).prev().find('.field').val() + 10);
    
});
$('.sub').click(function () {
    if ($(this).next().find('.field').val() > 0) $(this).next().find('.field').val(+$(this).next().find('.field').val() - 10);
});*/




//텍스트필드 자동 높이 조절

//텍스트 필드 자동 늘어남

$(document).ready(function(){
  autosize();
	function autosize(){
		var text = $('.script-text');
		text.each(function(){
			resize($(this));
		});

		text.on('input', function(){
			resize($(this));
		});

		function resize ($text) {
			$text.css('height', 'auto');
			$text.css('height', $text[0].scrollHeight+'px');
		}
	}
	
	$(".input-script").click(function() {
		$(this).find(".script-text").focus();
	});
	
	
	/*$(".reset-script").click(function() {
		$(".script-text").val("");
	});*/
	
	
	
	$(".view-hint").click(function() {
		$(this).parents('.sh-t').siblings('.sh-c').toggleClass('on');
	});
	
	
	
	/*$(".save-script").click(function() {
		$(this).parents('.study-text').find('.st-right').addClass('on');
	});*/
	
	
	$(".view-answer").click(function() {
		$(this).parents('.study-text').siblings('.script-info').find('.script-answer').addClass('on');
	});
	
	
	
	$('.bottom-btn button').click(function(){
		
			$(this).toggleClass('active');
			$('.bottom-btn button').not($(this)).removeClass('active');
			
	});
	
});





		
	$(document).ready(function(){
		
		$('#playbtn').on('click',function(){
			$(this).removeClass('on');
			$("#stopbtn").addClass('on');
		});
		
		$('#stopbtn').on('click',function(){
			$(this).removeClass('on');
			$("#playbtn").addClass('on');
		});
		
		$('#rebtn').on('click',function(){
			$("#playbtn").addClass('on');
			$("#stopbtn").removeClass('on');
		});
		
	});