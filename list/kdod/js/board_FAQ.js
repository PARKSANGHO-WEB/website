/*탭메뉴 js*/
//1. 각 탭메뉴 변수로 지정
var tab = $('#menu_gnb').find('li');
//2. 선언적 함수 만들기
var i;
function tab_menu(num) {
	//	2-1. for()문 사용 : 인덱스값 0~8까지 9번실행
	for (i=0;i<tab.length;i++) {
		if(num==i){
//			클릭한 MENU에 active 클래스가 적용됨
			tab.eq(i).addClass('active');
			$('.tab_content_0'+i).show();
		}else{
			tab.eq(i).removeClass('active');
			$('.tab_content_0'+i).hide();
		}
	}
}

/*ALL메뉴 클릭시 모든 Qna나오도록*/
$('.show').click(function(){
   $('.all>div').show();
});



/*qna메뉴 클릭시 효과*/
var dpCheck;
$('.qna .qna_title').click(function(){
    $('.qna_txt').stop().slideUp();
    $('.arrowUp').css('transform','rotate(-360deg)');
    dpCheck = $(this).next().css('display');
    if(dpCheck=='block'){
        $(this).next().stop().slideUp();
        $(this).children('img').css('transform','rotate(-360deg)');
    }else{
        $(this).next().stop().slideDown();
        $(this).children('img').css('transform','rotate(-180deg)');
        $(this).children('img').addClass('arrowUp');
    }
});


/*스크롤 중간에서 qna메뉴 클릭시 메뉴 상단으로 가는 것 방지*/

var qna_title = $('.qna_title');
for(var i=2;i<qna_title.length;i++){
    $('.qna_title').eq(i).click(function(e){

    e.preventDefault();
    });
}

/*a 태그 클릭시 페이지 상단으로 가는 현상 방지*/
$('a[href="#"]').click(function(e){
    e.preventDefault();
});
