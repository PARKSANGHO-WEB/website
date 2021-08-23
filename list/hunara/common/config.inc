<?
/* ┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
	┃ 환경 변수 모음																																							 ┃
	┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛*/

	#사이트 환경 정보
	#$SITE_INFO=db_select("select * from tbl_site_config");

	//마스터 관리자
	#$MASTER_UID = "admin";
	#$MASTER_IP = "218.48.215.126";


	//페이징 함수
	$page_first_page="<img src=\"/img/common/first-b.png\" align=\"처음으로\" class=\"toFirst\" />";
	$page_post_start="<img src=\"/img/common/prev-b.png\" align=\"이전으로\" class=\"prePage\" />";
	$page_next_start="<img src=\"/img/common/next-b.png\" align=\"다음으로\" class=\"nextPage\" />";
	$page_last_page="<img src=\"/img/common/last-b.png\" align=\"끝으로\" class=\"lastPage\" />";

	if(!$list_num) $list_num=10;
	if(!$page_num) $page_num=10;

	$page=$_GET['page'];
	if(!$page) $page=1;
	$start_num=($page-1)*$list_num;

	//사이트 경로 설정
	$DOCUMENT_ROOT=$_SERVER['DOCUMENT_ROOT']; //루트경로
	$return_url=$_SERVER['REQUEST_URI'];
	$current_url=urlencode("https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); //현재페이지 경로
		
	//이니시스 결제 아이디
	//$INI_MID = "INIpayTest";
	//$INI_MID = "trendbyme1";


/* ┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
	┃ 사용자 정의 배열 모음																																							 ┃
	┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛*/

## 이메일
$emailArray=array(
	"naver.com",
	"nate.com",
	"gmail.com",
	"yahoo.com",
	"dreamwiz.com",
	"empal.com",
	"freechal.com",
	"hanafos.com",
	"hitel.net",
	"korea.com",
	"lycos.co.kr",
	"paran.com",
	"yahoo.co.kr",
);
reset($emailArray);

## 전화번호
$telArray=array("02","031","032","033","041","042","043","051","052","053","054","055","061","062","063","064","070","010");
reset($telArray);

## 휴대전화
$hpArray=array("010","011","016","017","018","019");
reset($hpArray);

## 연락처
$phoneArray=array("010","011","016","017","018","019","02","031","032","033","041","042","043","051","052","053","054","055","061","062","063","064","070");
reset($phoneArray);

## 게시판권한
$bbsAuthArray=array(
	"1"=>"비회원",
	"2"=>"회원",
	"3"=>"관리자"
);
reset($bbsAuthArray);

## 게시판형태
$bbsTypeArray=array(
	"1"=>array("일반게시판","list","view"),
	"2"=>array("이벤트","event","event_view"),
	"3"=>array("온라인문의","inquiry"),
	"4"=>array("FAQ게시판","faq"),
	"5"=>array("리뷰","review_list", "review_view"),
	"6"=>array("매거진","magazine", "magazine_view"),
	"7"=>array("매장","strt_list", "strt_view"),
	"8"=>array("1:1 문의","question_list", "question_view"),
	"9"=>array("myreview","myreview_list", "myreview_view"),
	"10"=>array("QnA게시판","qna_list", "qna_view")
);
reset($bbsTypeArray);

## 유무
$ynArray=array(
	"Y"=>"있음",
	"N"=>"없음"
);
reset($ynArray);

## 시도
$sidoArray=array(
	"서울특별시",
	"부산광역시",
	"대구광역시",
	"인천광역시",
	"광주광역시",
	"대전광역시",
	"울산광역시",
	"세종특별자치시",
	"강원도",
	"경기도",
	"경상남도",
	"경상북도",
	"전라남도",
	"전라북도",
	"제주특별자치도",
	"충청남도",
	"충청북도"
);
reset($sidoArray);

## 지역
$sidoArray2=array(
	"서울", 
	"경기", 
	"인천", 
	"강원", 
	"충남", 
	"대전", 
	"충북",
	"경북", 
	"대구",
	"전북",
	"광주",
	"경남",
	"부산", 
	"울산",
	"전남",
	"울릉",
	"제주"
);
reset($sidoArray2);


## 결제방식
$payMethodArray=array(
	"C"=>"신용카드",
	"B"=>"무통장입금",
	"O"=>"계좌이체",
	/*"V"=>"가상계좌",*/
	"H"=>"휴대폰",
	"Z"=>"제로뱅크"
);

reset($payMethodArray);


## 현금영수증
$taxbillArray=array(
	"1"=>"신청",
	"2"=>"신청안함",
	"0"=>"신청안함"
);
reset($taxbillArray);

## 발행용도
$billTypeArray=array(
	"0"=>"소득공제용",
	"1"=>"지출증빙용"
);
reset($billTypeArray);

## 결제코드
$payCodeArray=array(
	"C"=>"CARD",
	"B"=>"",
	"O"=>"DirectBank",
	"V"=>"VBank",
	"H"=>"HPP"
);
reset($payCodeArray);

#은행코드
$bankCodeArray=array(
	"02"=>"한국산업은행",
	"03"=>"기업은행",
	"04"=>"국민은행",
	"05"=>"하나은행(구외환은행)",
	"06"=>"국민은행(구주택은행)",
	"07"=>"수협중앙회",
	"11"=>"농협중앙회",
	"12"=>"단위농협",
	"16"=>"축협중앙회",
	"20"=>"우리은행",
	"21"=>"조흥은행",
	"22"=>"상업은행",
	"23"=>"SC제일은행",
	"24"=>"한일은행",
	"25"=>"서울은행",
	"26"=>"구)신한은행",
	"27"=>"한국씨티은행 (구 한미)",
	"31"=>"대구은행",
	"32"=>"부산은행",
	"34"=>"광주은행",
	"35"=>"제주은행",
	"37"=>"전북은행",
	"38"=>"강원은행",
	"39"=>"경남은행",
	"41"=>"비씨카드",

	"45"=>"새마을금고",
	"48"=>"신용협동조합중앙회",
	"50"=>"상호저축은행",
	"53"=>"한국씨티은행",
	"54"=>"홍콩상하이은행",
	"55"=>"도이치은행",
	"56"=>"ABN암로",
	"57"=>"JP모건",
	"59"=>"미쓰비시도쿄은행",
	"60"=>"BOA(Bank of America)",
	"64"=>"산림조합",
	"70"=>"신안상호저축은행",
	"71"=>"우체국",
	"81"=>"하나은행",
	"83"=>"평화은행",
	"87"=>"신세계",
	"88"=>"신한(통합)은행",

	"D1"=>"유안타증권(구 동양증권)",
	"D2"=>"현대증권",
	"D3"=>"미래에셋증권",
	"D4"=>"한국투자증권",
	"D5"=>"우리투자증권",
	"D6"=>"하이투자증권",
	"D7"=>"HMC투자증권",
	"D8"=>"SK증권",
	"D9"=>"대신증권",
	"DA"=>"하나대투증권",
	"DB"=>"굿모닝신한증권",
	"DC"=>"동부증권",
	"DD"=>"유진투자증권",
	"DE"=>"메리츠증권",
	"DF"=>"신영증권",
	"DG"=>"대우증권",
	"DH"=>"삼성증권",
	"DI"=>"교보증권",
	"DJ"=>"키움증권",
	"DK"=>"이트레이드",
	"DL"=>"솔로몬증권",
	"DM"=>"한화증권",
	"DN"=>"NH증권",
	"DO"=>"부국증권",
	"DP"=>"LIG증권"
);
reset($bankCodeArray);

##배송정책
$delivTypeArray=array(
	"1"=>"무료",
	"2"=>"고정금액",
	"3"=>"주문금액별 차등"
);
reset($delivTypeArray);

##문의유형
$questionTypeArray=array(
	"1"=>"사이트문의",
	"2"=>"회원정보",
	"3"=>"멤버십",
	"4"=>"이벤트",
	"5"=>"주문/결제/배송"
);
reset($questionTypeArray);

##가격대 검색
$searchPriceArray=array(
	"1"=>"10만원 이하",
	"2"=>"10만원 대",
	"3"=>"20만원 대",
	"4"=>"30만원 대",
	"5"=>"40만원 이상"
);
reset($searchPriceArray);


##노출 리스트수
$listnumArray=array(
	"15"=>"15개 출력",
	"20"=>"20개 출력",
	"50"=>"50개 출력",
	"100"=>"100개 출력"
);
reset($listnumArray);

?>
