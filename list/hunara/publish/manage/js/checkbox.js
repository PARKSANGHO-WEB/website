jQuery(function() {
	jQuery('[data-check-pattern]').checkAll();
});

;(function($) {
	'use strict';
	
	$.fn.checkAll = function(options) {
		return this.each(function() {
			var mainCheckbox = $(this);
			var selector = mainCheckbox.attr('data-check-pattern');
			var onChangeHandler = function(e) {
				var $currentCheckbox = $(e.currentTarget);
				var $subCheckboxes;
				
				if ($currentCheckbox.is(mainCheckbox)) {
					$subCheckboxes = $(selector);
					$subCheckboxes.prop('checked', mainCheckbox.prop('checked'));
				} else if ($currentCheckbox.is(selector)) {
					$subCheckboxes = $(selector);
					mainCheckbox.prop('checked', $subCheckboxes.filter(':checked').length === $subCheckboxes.length);
				}
			};
			
			$(document).on('change', 'input[type="checkbox"]', onChangeHandler);
		});
	};
}(jQuery));






// 배정 방식에 대한 스크립트


$(document).ready(function() {


	$(".raffle").attr('disabled', true);

		$("input[name=raffle-or]").change(function() {
			
			if ($(this).val() == "fast") {
				$(".raffle").attr('checked', false);
				$(".raffle").attr('disabled', true);
			}
			
			// Else Enable radio buttons.
			else {
				$(".raffle").attr('disabled', false);
			}
	});
});



 

$(document).ready(function() {

	$(function() {
	  enable_cb();
	  $(".opt-check").click(enable_cb);
	});

	function enable_cb() {
	  if (this.checked) {
		  
		$(this).parents('.opc-wrap').siblings('.option-sel').find(".option-c").removeAttr("disabled");
		  
		  
		$(this).parents('.opc-wrap').siblings('.option-sel').find(".opt-set").removeClass('not');
		  
	  } else {
		  
		  
		$(this).parents('.opc-wrap').siblings('.option-sel').find(".option-c").attr("disabled", true);
		  
		  
		$(this).parents('.opc-wrap').siblings('.option-sel').find(".opt-set").addClass('not');
		
	  }
	}
});





//화살표 효과

$(document).ready(function(){
	$('.th-btn').click(function() {
		  var isSortedAsc  = $(this).hasClass('sort-asc');
		  var isSortedDesc = $(this).hasClass('sort-desc');
		  var isUnsorted = !isSortedAsc && !isSortedDesc;

		  $('.th-btn').removeClass('sort-asc sort-desc');

		  if (isUnsorted) {
			 $(this).addClass('sort-asc');
		  } else if (isSortedAsc) {
			$(this).addClass('sort-desc');
		  } else if (isSortedDesc) {
		  	$('.th-btn').removeClass('sort-desc');
		  }
		});
});









//달력 활성화 비활성화




$(document).ready(function(){
	
				
	(function(){

		var $extra_date = $('[data-js-extra-date]');
		var $end_date = $('[data-js-end-date]');
		var $start_date = $('[data-js-start-date]');


		$extra_date.Zebra_DatePicker();

		$end_date.Zebra_DatePicker({
			direction: 1,
			onClear: function(){
				extraOnChange();
				extraOnClear();
			},
			onSelect: function(val){
				extraOnChange();
				extraUpdate();      
			}
		});
		var dp_end = $end_date.data('Zebra_DatePicker');

		$start_date.Zebra_DatePicker({
			direction: false,
			pair: $end_date,
			onClear: function(){        
				endDateClear(true);
				dp_end.clear_date();

				extraOnChange();
				extraOnClear();
			},
			onSelect: function(val){
				endDateClear(false);
				extraOnChange();
				extraUpdate();
			}
		});


		function endDateClear(bool) {
			$end_date.prop('disabled', bool);
		}


		function extraOnClear(){
			$extra_date.each(function(){
				$(this).data('Zebra_DatePicker').clear_date();
			});
		}
		function extraUpdate(){
			$extra_date.each(function(){
				$(this).data('Zebra_DatePicker').clear_date();
				$(this).data('Zebra_DatePicker').update({
					direction: [$start_date.val(),$end_date.val()]
				});
			});
		}
		function extraOnChange(){
			if($start_date.val() !== '' && $end_date .val() !== ''){
				$extra_date.prop('disabled', false);
			}  else {
				$extra_date.prop('disabled', true);
			}
		}
		extraOnChange();

	})();

});


//텍스트 필드 자동 늘어남

$(document).ready(function(){
  autosize();
	function autosize(){
		var text = $('.autosize');

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
});



//휴양소 객실 옵션 추가 삭제

$(document).ready(function(){
	$(document).delegate('.add-btn','click',function(){
		$(this).siblings('.room-twrap').append("<div class='room-type room-type1'><button type='button' class='remove-type'>삭제</button><span class='rt-wrap'><span class='rt-t'>평형&nbsp;:&nbsp;</span><input type='text'><span>평형</span><span class='colon'>,</span><span class='rt-t'>타입&nbsp;:&nbsp;</span><input type='text'><span class='colon'>,</span><span class='rt-t'>객실 수&nbsp;:&nbsp;</span><input type='text'><span class='colon'>,</span><span class='rt-t'>기준&nbsp;:&nbsp;</span><input type='text'><span class='colon'>,</span><span class='rt-t'>최대&nbsp;:&nbsp;</span><input type='text'><span class='colon'>,</span><span class='rt-t'>시설&nbsp;:&nbsp;</span><input type='text'></span></div>");
	});
});



//추가된 객실옵션 삭제

$(document).ready(function(){
	
	$(document).delegate('.remove-type','click',function(){
		$(this).parents('.room-type').remove();
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





//210524 만족도 추가, 삭제 스크립트 수정


//만족도 추가

$(document).ready(function(){
	$(document).delegate('.add-ten','click',function(){
		
		var long1 = $('.view-2').find('.survey-wrap').find('.survey-line').length;
		
		if( long1 < 10 ) {
		
		$(this).siblings('.survey-wrap').append("<div class='survey-line'><button class='remove-btn' type='button'>삭제</button><input type='text'></div>");
			
			}else{
				$('.add-ten').css('display','none');
				alert('만족도 질문은 최대 10개입니다.');
			}
	});
});

//문항 삭제

$(document).ready(function(){
	
	$(document).delegate('.remove-btn','click',function(){
		
		$(this).parents('.survey-line').remove();

			var long2 = $('.view-2').find('.survey-wrap').find('.survey-line').length;

			if( long2 < 11 ){
					$('.add-ten').css('display','block');
			}
	});
});




//210524 객관식 질문 추가 스크립트 수정

//문항 추가

$(document).ready(function(){
	$(document).delegate('.add-type','click',function(){
		
		var long = $('.survey-wrap').find('.sur-l2').length;
		
		if( long < 5 ) {
		
		$(this).siblings('.survey-wrap').append("<div class='survey-line'><button class='remove-btn' type='button'>삭제</button><div class='sel-survey'><input type='text' class='ex-title' placeholder='제목을 입력해주세요.'><div class='ex-check'><div class='sur-l sur-l1'><input type='text' placeholder='선택지를 입력하세요.'></div><div class='sur-l sur-l2'><input type='text' placeholder='선택지를 입력하세요.'></div><div class='sur-l sur-l3'><input type='text' placeholder='선택지를 입력하세요.'></div><div class='sur-l sur-l4'><input type='text' placeholder='선택지를 입력하세요.'></div><div class='sur-l sur-l5'><input type='text' placeholder='선택지를 입력하세요.'></div><div class='sur-l sur-l6'><input type='text' placeholder='선택지를 입력하세요.'></div></div></div></div>");
			
			}else{
				$('.add-type').css('display','none');
				alert('객관식 질문은 최대 10개입니다.');
			}
	});
});



//문항 삭제

$(document).ready(function(){
	
	$(document).delegate('.remove-btn','click',function(){
		
		$(this).parents('.survey-line').remove();

			var long = $('.survey-wrap').find('.sur-l2').length;

			if( long < 5 ){
					$('.add-type').css('display','block');
			}
	});
});





//왼쪽 서브메뉴

$(document).ready(function(){

	$('.lm-big').click(function(){

	  $(this).toggleClass('active');
	  $('.lm-big').not(this).removeClass('active');

	});
});




//팝업 미리보기 위치 및 사이즈 210519

$(document).ready(function(){

var newWindowButton,  // Reference to the button we can click on
    newWindowWidth,   // We can provide a width for the new window, defaults to 200 px
    newWindowHeight;  // We can provide a height for the new window, defaults to 200 px

	newWindowButton = document.getElementById('newWindow');
	newWindowButton.onclick = function () {
		var newWindowUrl,
			newWindowName,
			newWindowOptions;

		newWindowWidth = document.getElementById('windowWidth').value;
		newWindowHeight = document.getElementById('windowHeight').value;
		newWindowLeft = document.getElementById('windowLeft').value;
		newWindowTop = document.getElementById('windowTop').value;
		newWindowUrl = '';
		newWindowName = 'NewWin';    
		newWindowOptions = 'toolbar=no,status=no,width='+newWindowWidth+',height='+newWindowHeight+',left='+newWindowLeft+',top='+newWindowTop;    

		window.open(newWindowUrl, newWindowName, newWindowOptions);
};
});




