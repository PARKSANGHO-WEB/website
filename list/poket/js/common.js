 

$(document).ready(function(){
    
    //gnb박스
    
    
    
    $(".btngnb").click(function(event) {
        
            if( $(this).hasClass('on') ){
                $('.btngnb').removeClass("on");
                $(".gnb-box").removeClass("on");
                $(this).removeClass('on');
                $(this).siblings(".gnb-box").removeClass("on");

            }else{
                $('.btngnb').removeClass("on");
                $(".gnb-box").removeClass("on");
                $(this).addClass('on');
                $(this).siblings(".gnb-box").toggleClass("on");
                event.stopPropagation();
        }
        
        });

    $(document).click(function(event){
        if (!$(event.target).hasClass('on')) {
            $(".gnb-box").removeClass("on");
            $('.btngnb').removeClass("on");
        }
    });
    
    

    
    
    
    //글 더보기
    
    $(document).delegate('.moreview','click',function(){
        $(this).siblings('.wbv-text').addClass('on');
        $(this).addClass('none');
    });
    
    
    $(document).delegate('.reply-wrap','click',function(){
        $(this).toggleClass('on');
        $(this).parents('.wb-reple').toggleClass('on');
    });
    
    $(document).delegate('.close_reple','click',function(){
        $(this).parents('.wb-reple').removeClass('on');
        $(this).parents('.wb-reple').find('.reply-wrap').removeClass('on');
    });
    


    
    
    // 글 쪽찌, 신고
    
    
    $(document).delegate('.more-box','click',function(event) {
            $(".me_more").addClass("on");
            event.stopPropagation();
        });

        $(document).click(function(event){
            if (!$(event.target).hasClass('on')) {
                $(".me_more").removeClass("on");
            }
        });

    
    
    
    // 댓글 더보기
    
    $('.re-plus').on('click',function(){
        $(this).parents('.re-more').addClass('on');
        $(this).parents('.reple-top').siblings('.re-reple').addClass('on');
        $(this).parents('.reple-top').siblings('.reple-t').addClass('on');
        $(this).parents('.reple-top').siblings('.reple-t').find('.reple-t').focus();
    });
    
    $('.re-minus').on('click',function(){
        $(this).parents('.re-more').removeClass('on');
        $(this).parents('.reple-top').siblings('.re-reple').removeClass('on');
        $(this).parents('.reple-top').siblings('.reple-t').removeClass('on');
    });
    
    
    $('.go-btn').on('click',function(){
        $(this).parents('.re-btn').siblings('.re-more').toggleClass('on');
        $(this).parents('.reple-top').siblings('.re-reple').toggleClass('on');
        $(this).parents('.reple-top').siblings('.reple-t').toggleClass('on');
    });
    
    
    
    
    // 대댓글 작성창 높이 자동 조절
    
    $(".reple-t textarea").on('keydown keyup', function () {
        $(this).height(1).height( $(this).prop('scrollHeight')+5 );	
    });
    
    
    $(document).ready(function(){
        
        $(".reple").each(function(){
            
            $(this).find(".reple-item").slice(0, 10).show(); 
          
            if($(this).find(".reple-item").length < 10) {
              $(this).siblings('.loadten').hide();
            }
        });
        
          $(".loadten").on("click", function(e){
            e.preventDefault();
            $(this).siblings('.reple').find(".reple-item:hidden").slice(0, 10).show();
            if($(this).siblings('.reple').find(".reple-item:hidden").length == 0) {
                $(this).hide();
            }
          });
 
        
        
        
        $('#password, #confirm_password').on('keyup', function () {
          if ($('#password').val() == $('#confirm_password').val()) {
            $('#message').html('비밀번호가 일치합니다.').css('font-size', '12px');
          } else 
            $('#message').html('비밀번호가 일치하지않습니다.').css('font-size', '12px');
        });
        
        
    })
    
    
    // 글작성창
    
    $('.write-btn').on('click',function(){
        $(this).siblings('.write-form').addClass('on');
    });
    
    $('.no-write').on('click',function(){
        $(this).parents('.write-form').removeClass('on');
    });
    
    
    
    //좋아요, 스크랩
    
    $(document).delegate('.like','click',function(){
        $(this).toggleClass('yes');
    });
    
    $(document).delegate('.scrap','click',function(){
        $(this).toggleClass('yes');
    });
    
    
    $(document).delegate('.re-like','click',function(){
        $(this).toggleClass('yes');
    });
    
    
    
    



    // 댓글입력창


    var typepl = document.querySelector('.typing-place');
    var typesm = document.querySelector('.typing-submit');

    typepl.addEventListener('keyup', function() {
      var searchSminput = typepl.value.length;
      if (searchSminput == 0) {
        typesm.classList.remove('on');
      } else {
        typesm.classList.add('on');
      }
    });

    
    
});



    
    
    //모바일 햄버거 메뉴
    $(document).ready(function(){
        
        $('.bar').on('click',function(){
            $(this).toggleClass('active');
            $('.mobile-menu').slideToggle(300);
        });

    });



//파일첨부

$(document).ready(function(){
    // Also see: https://www.quirksmode.org/dom/inputfile.html

    var inputs = document.querySelectorAll('.file-input')

    for (var i = 0, len = inputs.length; i < len; i++) {
    customInput(inputs[i])
    }

    function customInput (el) {
        const fileInput = el.querySelector('[type="file"]')
        const label = el.querySelector('[data-js-label]')

        fileInput.onchange =
        fileInput.onmouseout = function () {
            if (!fileInput.value) return

            var value = fileInput.value.replace(/^.*[\\\/]/, '')
            el.className += ' -chosen'
            label.innerText = value
        }
    }
});


//이미지 모달



$(document).ready(function(){
    
    
    $(".wbv-img").click(function(){
        $(".modal").addClass("visible");
            event.stopPropagation();
    });
    
    $(document).click(function(event){
        if ($(event.target).hasClass('visible')) {
            $(".modal").removeClass("visible");
        }
    });
    
});






// 회원가입 2번 페이지 체크박스

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
});





// 시간표 후보등록


    $(document).ready(function(){
        
        
        
        $('.hubo-btn').on('click', function(){
            
            if( $(this).parents('tr').hasClass('appended') ){
                alert('이미 후보 목록에 추가되어있습니다.');
                $(this).css('pointer-events','none');
            }else {
                
                var idLec = $(this).closest('tr').attr('id');
                
                $(this).parents('tr').addClass('appended');
                $('.schedule').find('.alre-list').find('.mCSB_container').append('<div class="wrap"></div>');
                $('.schedule').find('.wrap:last-child').append('<div class="span-wrap"></div>');
                $('.schedule').find('.wrap:last-child').attr('id',idLec);
                $('.schedule').find('.wrap:last-child .span-wrap').append('<span class="close-big"></span>');
                
             
                
                $(this).parents('tr').find('.hubo-info').clone().appendTo($(this).parents('.sub-list').siblings('.schedule').find('.schep-r').find('.wrap:last-child .span-wrap'));
                
                
                alert('후보 목록에 추가되었습니다');  
                
            }
        });
        
        $(document).on("click",".close-big",function(){     
                $(this).parents('div.wrap').remove();
        
             $(".sub-list").find("tr.appended").removeClass("appended");
        
              var itemids3 = $.makeArray($(".schedule").find(".wrap").map(function(){
                    return $(this).attr("id");
                }));
            
                console.log(itemids3);
        
                $.each(itemids3, function() {
                    $(".sub-list").find("#" + this).addClass('appended');
                    $(".mobile-lec").find("#" + this).addClass('appended');
                });
        
          
        });
        

    });

// 1교시 제외 토글


    $(document).ready(function(){
        $('.one-sche > button').on('click',function(){
            $(this).toggleClass('on');
        });
    });




// 서브 리스트 모달


    $(document).ready(function(){
        
        $('.mo1-on').on('click',function(){
            $('.limo-wrap').find('.limo-op1').addClass('visible');
        });

        
        $('.mo2-on').on('click',function(){
            $('.limo-wrap').find('.limo-op2').addClass('visible');
        });

        
        $('.mo3-on').on('click',function(){
            $('.limo-wrap').find('.limo-op3').addClass('visible');
        });

        
        $('.mo4-on').on('click',function(){
            $('.limo-wrap').find('.limo-op4').addClass('visible');
        });

        
        $('.mo5-on').on('click',function(){
            $('.limo-wrap').find('.limo-op5').addClass('visible');
        });


        $('.close').on('click',function(){
            $(this).parents('.limo-op').removeClass('visible');
        });
        
        
    });

// 시간표 설정

$(document).ready(function(){
    $('.mark-t').on('click',function(){
        $(this).parents('.tm-con').find('.mark-t').removeClass('on');
        $(this).addClass('on');
    });
});


// 시간표 삭제 컨펌

$(document).ready(function(){
    var deleteLinks = document.querySelectorAll('.time-del');

    for (var i = 0; i < deleteLinks.length; i++) {
      deleteLinks[i].addEventListener('click', function(event) {
          event.preventDefault();

          var choice = confirm(this.getAttribute('data-confirm'));

          if (choice) {
            window.location.href = this.getAttribute('href');
          }
      });
    }
     
});



//시간표


$(document).ready(function(){
    
    
    $(".btn-timet").click(function(){
        $(".schep-l").addClass("visi");
            event.stopPropagation();
    });
    
    $(".mobile-close").click(function(){
        $(".schep-l").removeClass("visi");
    });
    
    
    
    $(".op-time").click(function(){
        $(".time-modal").addClass("visible");
            event.stopPropagation();
    });
    
    $(".close").click(function(){
        $(".time-modal").removeClass("visible");
    });
    
    
    
    $(".add-time").click(function(){
        $(".add-wrap").addClass("visible");
            event.stopPropagation();
    });
    
    $(".close").click(function(){
        $(".add-wrap").removeClass("visible");
    });
    
    
    
    $('.tablet-btn a').on('click',function(){
        $('.tablet-btn a').removeClass('active');
        $(this).addClass('active');
    });
    
    
    $('.time-on').on('click',function(){
        $('.schep-r').css('z-index','4999');
    });
    
    $('.hubo-on').on('click',function(){
        $('.schep-r').css('z-index','5001');
    });
});


// 강의평 수강리스트 클릭 이벤트


$(document).ready(function(){
    $('.eval-item').on('click',function(){
        $('.eval-item').removeClass('view');
        $(this).addClass('view');
    });
});





// qna 왼쪽 탭 접고 펼치기

$(document).ready(function(){
    $('.lf-title').on("click",function(){
        $(this).toggleClass('none');
        $(this).parents('.lf-wrap').toggleClass('none');
    });
    
});


$(document).ready(function(){
    $(".accor_title").on("click",function(){
    $(this).parents(".accor_wrap").siblings().children(".accor_title").removeClass("brock");
    $(this).toggleClass("brock"); $(this).parents(".accor_wrap").siblings().children(".accor_con").removeClass("block");
    $(this).siblings(".accor_con").toggleClass("block");
    });
});










// QNA 글 좋아요

$(document).ready(function(){
    $('.qv-like').on('click',function(){
        $(this).toggleClass('on');
    });
});




// QNA 알림설정

$(document).ready(function(){
    $('.qv-alarm').on('click',function(){
        $(this).toggleClass('none');
    });
});



// QNA 댓글


$(document).ready(function(){
    $('.qv-ans').on('click',function(){
        $(this).parents('.border-sec').toggleClass('qv-re');
    });
});



// qna 공유하기 모달



$(document).ready(function(){
    
    
    $(".share-btn").click(function(){
        $(".snsmodal").addClass("visible");
            event.stopPropagation();
    });
    
    
    $(".snsmodal .close").click(function(){
        $(".snsmodal").removeClass("visible");
    });

    
    
    
});


function copyToClipboard(element) {
  document.execCommand("copy");
}

$('.url-copy').click(function() {
  var id = $(this).attr('id');
  var text = '';
  if(id == 'url-link') {
    text = $('.lbl1').text();
  } 
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val(text).select();
  document.execCommand("copy");
  $temp.remove();
});




// qna 글쓰기, 업로드한 이미지 삭제



$(document).ready(function(){
    

    $(document).delegate('click',".opacity",function(){
        $(this).remove();
    });

});


// 스터디 글 작성부분 카테고리별 체크박스 중복방지

$(document).ready(function(){
    $(".lecinput").click(function(){
        $(".examinput, .certinput").prop("checked", false);
    });
    $(".examinput").click(function(){
        $(".lecinput, .certinput").prop("checked", false);
    });
    $(".certinput").click(function(){
        $(".examinput, .lecinput").prop("checked", false);
    });
});




// qna 모바일 버전, 필터 토글

$(document).ready(function(){
    $('.filter-on').on('click',function(){
        $('.left-filter').toggleClass('block');
    });
    
    
    $('.lclose-btn').on('click',function(){
        $('.left-filter').removeClass('block');
    });
});


// qna 답변 채택

    $(document).ready(function(){
        $('.qva-select').on('click',function(){
            $('.border-sec').find('.qva-wrap').removeClass('selected');
            $(this).parents('.qva-wrap').addClass('selected');
        });
    });




// 내 수업, 900px이하부터 모달 변경





$(document).ready(function(){
    
    
    $(".ft-lec").click(function(){
        $(".myc-right").addClass("visible");
            event.stopPropagation();
    });
    
    $(".mob-close").click(function(){
        $(".myc-right").removeClass("visible");
    });

    
});



// 자주 묻는 질문

$(document).ready(function(){
    $('.freq-t').on('click',function(){
        $(this).parents('.freq-wrap').siblings().removeClass('freq');
        $(this).parents('.freq-wrap').toggleClass('freq');
    });
});





// 마이페이지 모달

$(document).ready(function(){
    
        $('.change-nick').on('click',function(){
            $('.nick-wrap').addClass('visible');
        });
    
        $('.change-info').on('click',function(){
            $('.info-wrap').addClass('visible');
        });

    
        $('.school-certy').on('click',function(){
            $('.school-wrap').addClass('visible');
        });
        $('.image-change').on('click',function(){
            $('.profile-wrap').addClass('visible');
        });


        $('.close').on('click',function(){
            $(this).parents('.myp-modal').removeClass('visible');
        });
        
});



//마이페이지 푸터



// 마이페이지 탭



    $(document).ready(function(){

        var tabBtn = $(".my-ltop > ul > li");  
        var tabCont = $(".my-right");   

        tabCont.hide().eq(0).show();

        tabBtn.click(function(){
              var target = $(this);      
              var index = target.index();  

              tabBtn.removeClass("active");  
              target.addClass("active");  
              tabCont.css("display","none");
              tabCont.eq(index).css("display","block");
        });
    });   




    $(document).ready(function(){

        var notBtn = $(".my-lbot > ul > li");  
        var notCont = $(".my-right2");   

        notCont.hide().eq(0).show();

        notBtn.click(function(){
              var targetnot = $(this);      
              var indexnot = targetnot.index();  

              notBtn.removeClass("active");  
              targetnot.addClass("active");  
              notCont.css("display", "none");
              notCont.eq(indexnot).css("display", "block");
        });
    });   




// 마이페이지 쪽찌함 탭



    $(document).ready(function(){
        

        var messBtn = $(".mr1-btn > ul > li");  
        var messCont = $(".message-wrap");   

        messCont.hide().eq(0).show();

        messBtn.click(function(){
              var msstarget = $(this);      
              var mssindex = msstarget.index();  

              messBtn.removeClass("active");  
              msstarget.addClass("active");  
              messCont.css("display","none");
              messCont.eq(mssindex).css("display", "block");
        });


    });   



// 마이페이지 나의 활동 qna 탭
    $(document).ready(function(){
        

        var qswBtn = $(".mr3-btn > ul > li");  
        var qswCont = $(".acti-wrap");   

        qswCont.hide().eq(0).show();

        qswBtn.click(function(){
          var qwtarget = $(this);      
          var qwindex = qwtarget.index();  
          //alert(index);
          qswBtn.removeClass("active");  
          qwtarget.addClass("active");  
          qswCont.css("display","none");
          qswCont.eq(qwindex).css("display", "block");
        });



    });   

//마이페이지 나의 활동 게시판 탭
    $(document).ready(function(){


        var acbBtn = $(".mr4-btn > ul > li");  
        var acbCont = $(".acboard-wrap");   

        acbCont.hide().eq(0).show();

        acbBtn.click(function(){
          var abtarget = $(this);      
          var abindex = abtarget.index();  
          //alert(index);
          acbBtn.removeClass("active");  
          abtarget.addClass("active");  
          acbCont.css("display","none");
          acbCont.eq(abindex).css("display", "block");
        });


    });   



// mypage.html을 제외한 나머지 페이지에서 푸터 클릭시 탭 활성화


    $(document).ready(function() {

        var hash = window.location.hash;
        var hashNavLink = $('.nav-link[href="'+hash+'"]');
        var hashCon = $('.nav-item[href="'+hash+'"]');

      if (hashNavLink.length === 0) {
            hashNavLink = $('.nav-link[href="#message"]');
            hashCon = $('.nav-item[href="#message"]');
      }
          $('.nav-link').removeClass('active');
          hashNavLink.addClass('active');
          $('.nav-item').css("display", "none");
          hashCon.css("display", "block");
		
		


});



//쪽지함 팝업

    $(document).ready(function() {

        var mesh = window.location.mesh;
        var meshCon = $('.receive-modal[href="'+mesh+'"]');


		  if (hashNavLink.length === meshCon) {
				$('.receive-modal').css('display','none');
		  }
		
		$('.receive-modal').css('display','block');
});



// 쪽지함 닫기, 마이페이지에서의 쪽지함 팝업
$(document).ready(function(){
	
		$('.receive-btn').on('click',function(){
			$('.receive-modal').css('display','block');
		});
		
		$('.mp-mess').on('click',function(){
			$('.receive-modal').css('display','block');
		});
		
		$('.profile-mbtn').on('click',function(){
			$('.mess-modal').css('display','block');
			$('.receive-modal').css('display','none');
		});
	
		
		$('.tm-close').on('click',function(){
			$(this).parents('.receive-modal').css('display','none');
		});
	
		$('.mm-close').on('click',function(){
			$(this).parents('.mess-modal').css('display','none');
		});
	
	
});

$(document).ready(function() {
	var bodyOffset = $('body').offset();
	$(window).scroll(function() {
		if ($(document).scrollTop() > bodyOffset.top) {
			$('header').addClass('scroll');
		} else {
			$('header').removeClass('scroll');
		}
	});
});




// 클릭시 스크롤 탑으로 이동

$(document).ready(function(){
    $('.top-btn').on('click',function(){
            $('html, body').animate({scrollTop: '0'}, 500);
    });
});


$(document).ready(function(){
    $('.ampm-hr').on('click',function(){

        var hour = $(this).val(); 
        
        
        $(this).parents('.myw-opt').siblings('.myws').find('.fin-ampm').text(hour);

    });
});         


$(document).ready(function(){
    $('.hour-hr').on('click',function(){

        var hour = $(this).val(); 
        
        
        $(this).parents('.myw-opt').siblings('.myws').find('.fin-hour').text(hour);

    });
});                          


$(document).ready(function(){
    $('.min-hr').on('click',function(){

        var min = $(this).val(); 
        
        
        $(this).parents('.myw-opt').siblings('.myws').find('.fin-mn').text(min);

    });
});


$(document).ready(function(){
    
    $(".time-call").click(function(event) {
            $(".myw-opt").removeClass("visible");
            $(this).find(".myw-opt").addClass("visible");
            event.stopPropagation();
        });

    $(document).click(function(event){
        if (!$(event.target).hasClass('visible')) {
            $(".myw-opt").removeClass("visible");
        }
    });
    
});
        


    //쪽찌함 팝업

    
    
    
$(document).ready(function(){
    $(document).delegate(".rb-mess","click", function(event) {
        $(".mess-modal").addClass("mess");
            event.stopPropagation();
    });
    
    $(".close").click(function(){
        $(".mess-modal").removeClass("mess");
    });
    
//    $(document).click(function(event){
//        if ($(event.target).hasClass('mess')) {
//            $(".mess-modal").removeClass("mess");
//        }
//    });
    
});
        









// 시간표 체크박스 필터링




    $(document).on("click",".mobtn",function(){
        

            var itemids1 = $.makeArray($(".mo1-modal").find('input:checked').siblings(".fil-name").map(function(){
                return $(this).attr("id");
            }));
        
            $.each(itemids1, function() {
                   
                $("#" + this).addClass('appended');
            });
        
            $(this).parents('body').find('.filtering1').find('.fil-name.appended').remove();
            
            $('.mo1-modal').find('.fil-name.appended').clone().appendTo( $('.filtering1').find('.fil-con') );
        
            $(this).parents('.limo-op1').removeClass('visible');

        
            var filleng = itemids1.length;
            
            if( filleng > 0){
                $('.filtering1').find('.del-fil').addClass('on');
            }else{
                $('.filtering1').find('.del-fil').removeClass('on');
            }
            
            if( filleng > 2){
                
                var fcont = $('.filtering1').find('.fil-name').length;
                
                $('.filtering1').find('.numbering').addClass('on');
                $('.filtering1').find('.count-filter').text(fcont-2);
            }else{
                $('.filtering1').find('.numbering').removeClass('on');
            }
        
            
    });    


// 필터 삭제 예시입니다.

    $(document).on("click",".del-fil1",function(){
        
        $(this).siblings('.fil-con').find('span').remove();
        
        $('.filtering1').find('.del-fil').removeClass('on');
        
        $('.filtering1').find('.numbering').removeClass('on');
        
        $('.limo-op1').find('input:checked').prop('checked', false);
        $('.limo-op1').find('span.appended').removeClass('checked', false);
        
        
    });





// 비밀번호 찾기 탭



    $(document).ready(function(){

        var tabBtn = $(".join-tab > ul > li");  
        var tabCont = $(".join-cont");   

        tabCont.hide().eq(0).show();

        tabBtn.click(function(){
              var target = $(this);      
              var index = target.index();  

              tabBtn.removeClass("active");  
              target.addClass("active");  
              tabCont.css("display","none");
              tabCont.eq(index).css("display","block");
        });
    });   


	





// 검색결과  탭



    $(document).ready(function(){

        var tabBtn = $(".search-tab > ul > li");  
        var tabCont = $(".search-l");   

        tabCont.hide().eq(0).show();

        tabBtn.click(function(){
              var target = $(this);      
              var index = target.index();  

              tabBtn.removeClass("active");  
              target.addClass("active");  
              tabCont.css("display","none");
              tabCont.eq(index).css("display","block");
        });
    });   




// 검색탭 새로운 jquery

		$(document).ready(function(){
			$('.search-t').focusin(function(){
				$(this).addClass('in');
				$(this).removeClass('none');

			});
			
				$('.search-btn').on('click',function(){
					$('.search-t').removeClass('in');
					$(this).siblings('.search-key').val("");
				});
			
		});






