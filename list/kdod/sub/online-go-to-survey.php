<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include "../include/header_sub.php"?>
<?
$bbs_code="data_list2";
$s_cate_code = trim(sqlfilter($_REQUEST['s_cate_code'])); // 게시판 카테고리 코드
$v_sect = "kr"; // 언어분류. kr -국어 / eng -영어 / cam -캄보디아 / myan -미얀마
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$field = trim(sqlfilter($_REQUEST['field']));
$keyword = sqlfilter($_REQUEST['keyword']);

################## 파라미터 조합 #####################
$total_param = 'field='.$field.'&keyword='.$keyword.'&bbs_code='.$bbs_code.'&v_sect='.$v_sect.'&s_cate_code='.$s_cate_code;

$member_idx = $_SESSION['member_coinc_idx'];

if(!$pageNo){
	$pageNo = 1;
}

//$where = " and result_YN not in ('3')"; // 비공개 제외

if ($v_sect){
	//$where .= "and bbs_sect = '".$v_sect."'";
}

$where .= "and p_no = 0 ";
$where .= " and bbs_code = '".$bbs_code."' "; // 선택한 게시판에 해당하는 내용만 추출한다

if ($field && $keyword){
	if($field == "subtent"){
		$where .= "and (subject".get_front_lang($v_sect)." like '%".$keyword."%' or content".get_front_lang($v_sect)." like '%".$keyword."%')";
	} else {
		$where .= "and ".$field." like '%".$keyword."%'";
	}
}

$pageScale = 6; // 페이지당 6 개씩 
$start = ($pageNo-1)*$pageScale;

$StarRowNum = (($pageNo-1) * $pageScale);
$EndRowNum = $pageScale;

$order_by = " ORDER BY ref desc, step asc, depth asc ";

$query = "select * from board_content where 1=1 ".$where.$order_by." limit ".$StarRowNum." , ".$EndRowNum;

//echo "<br><br>쿼리 = ".$query."<br><Br>";

$result = mysqli_query($gconnet,$query);

$query_cnt = "select idx from board_content where 1=1 ".$where;
$result_cnt = mysqli_query($gconnet,$query_cnt);
$num = mysqli_num_rows($result_cnt);

//echo $num;

$iTotalSubCnt = $num;
$totalpage	= ($iTotalSubCnt - 1)/$pageScale;

$sql_pre2 = "select idx from member_register_survey where 1 and member_idx='".$_SESSION['member_coinc_idx']."'"; 
$result_pre2  = mysqli_query($gconnet,$sql_pre2);
if(mysqli_num_rows($result_pre2) > 0){
	$surv_auth = "Y";
} else {
	$surv_auth = "N";
}

?>
<link rel="stylesheet" href="../css/online-go-to-survey.css">
<link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
<script src="../js/jquery.mCustomScrollbar.js"></script>
<!--    상단 탭메뉴 사이즈 변형-->
<style>
    /*        상단 배너 배경이미지 변경*/
    section.about-busy .sub-banner {
        background: url('../img/sub/survey-ban.png');
    }

</style>

<body>

    <? include "../include/gnb_sub1.php"?>

    <section class="about-busy on-survey">
        <div class="sub-banner">
            <div class="ban-text">
                <div class="root">
                    <ul>
                        <li>
                            <a href="../index.php">Home</a>
                        </li>
                        <li class="arrow">></li>
                        <li>
                            <a href="online-survey.php">Online Survey</a>
                        </li>
                        <li class="arrow">></li>
                        <li>
                            <a href="online-go-to-survey.php">GO TO SURVEY</a>
                        </li>
                    </ul>
                </div>
                <div class="ban-ment">
                    <span class="ban-title">BE OUR ONLINE PANEL and PARTICIPATE IN SURVEY</span>
                    <span class="ban-text">We listen to <strong>your voices</strong> on medical, social and industrial issues</span>
                </div>
            </div>
        </div>
        <div class="about-cont">
            <div class="about-flat af-market">
                <ul>
                    <li>
                        <a href="online-market-research-survey.php">MARKET RESEARCH SURVEY</a>
                    </li>
                    <li>
                        <a href="online-survey.php">ONLINE SURVEY</a>
                    </li>
                    <li>
                        <a href="online-panel.php">ONLINE PANEL</a>
                    </li>
                    <li>
                        <a href="online-k-dod-point.php"> K-DOD Point </a>
                    </li>
                    <li class="active">
                        <a href="online-go-to-survey.php">GO TO SURVEY </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <div id="go_to_survey">
        <h1>GO TO SURVEY</h1>
        <p class="text">
            진행 중인 서베이와 진행 종료된 서베이 리스트를 확인하세요. <br>
            현재 진행중인 서베이를 확인하신 후 참여하시면, 포인트와 (추첨) 경품을 받으실 수 있습니다. <br>
            1) 패널 멤버는 로그인하신 후 참여할 수 있습니다.<br>
            2) 패널이 아닌 경우 회원 가입 후 참여할 수 있습니다.
        </p>
        <section class="panel_survey">
            <article class="panel_survey_bg cf">
                <div class="text">
                    <h1>
                        PANEL PROFILE SURVEY <br>
                        [Mandatory for all new Panel]
                    </h1>
                    <h2>
                        *This survey is to build up KDOD panel’s Profile data
                    </h2>
                    <p>
                        10 Questions
                    </p>
                    <p>
                        3~5 min
                    </p>
                    <p>
                        K-DOD Point : 200 P
                    </p>
                </div>
                <div class="busy4-btn">
                    <button type="button" onclick="regist_pannel();">
                        <span class="b4b-t">서베이 시작하기 <br /><span class="small">(Start Survey)</span></span>
                    </button>
                </div>
            </article>
        </section>

        <section class="panel_content cf">
            <div class="search-line">
                <div class="numbering">
                    <span>Total : <?=number_format($num)?></span>
                </div>
                <div class="search-t">
                    <form name="s_mem" id="s_mem" method="post" action="<?=basename($_SERVER['PHP_SELF'])?>">
                        <input type="hidden" name="field" value="subtent" />
                        <input type="search" placeholder="search" required="required" autofocus="autofocus" class="search" name="keyword" id="keyword" value="<?=$keyword?>">
                        <div class="search_btn">
                            <a href="javascript:s_mem.submit();"><img src="../img/sub/gotosurvey_icon1.png" alt="search"></a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="article-w">
                <?
		for ($i=0; $i<mysqli_num_rows($result); $i++){
			$row = mysqli_fetch_array($result);

			$listnum	= $iTotalSubCnt - (( $pageNo - 1 ) * $pageScale ) - $i;
			$reg_time3 = to_time(substr($row[write_time],0,10));
		?>
                <article>
                    <div class="content_bg ">
                        <div class="txt">
                            <h1>
                                <?=$row['subject'.get_front_lang($v_sect).'']?>
                            </h1>
                            <h1>
                                <span><?=substr($row[survey_start],0,10)?>~<?=substr($row[survey_end],0,10)?></span>
                            </h1>
                            <div class="cb-info content-rd">
                                <p>
                                    <?=$row['bbs_sect3'.get_front_lang($v_sect).'']?>
                                </p>
                                <p>
                                    <?=$row['content'.get_front_lang($v_sect).'']?>
                                </p>
                            </div>
                        </div>
                        <div class="busy4-btn bt">
                            <button type="button">
                                <?if(date("Ymd") > str_replace("-","",substr($row[survey_end],0,10))){ // 종료일을 경과했을때 ?>
                                <?if($row[result_YN]=="2"){ // 결과보기 상태 ?>
                                <span class="b4b-t"><a href="javascript:go_view('<?=$row[idx]?>');" style="color:#707070;font-weight:800">Result</a></span>
                                <?}else{ // 결과보기 상태 아님 ?>
                                <span class="b4b-t"><a href="javascript:;" style="color:#707070;font-weight:800">COMPLETED</a></span>
                                <?}?>
                                <?}else{  // 종료일 이전일때 ?>
                                <span class="b4b-t"><a href="javascript:go_view('<?=$row[idx]?>');" style="color:#FF6B65;">Start Survey</a></span>
                                <?}  // 종료일 여부 종료 ?>
                            </button>
                        </div>
                    </div>
                </article>
                <?}?>
            </div>
        </section>

        <div class="paging">
            <span class="paging-wrap">
                <?
				include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/paging_front.php";	
			?>
            </span>
        </div>

        <section class="essential">
            <div class="content">
                <div class="fl cf">
                    <img src="../img/sub/gotosurvey_icon2.png" alt="주의아이콘">
                    <h1>서베이 시작 전 꼭 확인하세요 !</h1>
                </div>
                <ul>
                    <li class="ln">
                        서베이 참여를 누르시면 아래 사항에 동의한 것으로 간주됩니다 ;
                        <ul>
                            <li>
                                &nbsp;&nbsp;거짓으로 응답하지 않으며, 나 자신에 대해서나 내 의견에 대하여 솔직하게 응답합니다.
                            </li>
                            <li>
                                &nbsp;&nbsp;나의 응답은 다른 응답자들의 응답과 함께 통계 처리되어 사용됩니다.
                            </li>
                            <li>
                                &nbsp;&nbsp;케이닷 서베이 자료나 캡처한 서베이 화면 등을 유포하지 않습니다.
                            </li>
                            <li>
                                &nbsp;&nbsp;서베이를 진행하면서 획득된 모든 정보에 대한 저작권은 케이닷 (& 조사 의뢰 클라이언트)에 있습니다.
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul>
                    <li class="ln">
                        아래와 같은 경우 ‘불량 응답’으로 간주됩니다 ;
                        <ul>
                            <li>
                                &nbsp;&nbsp;여러 문항에 한 번호로 일괄 응답한 경우
                            </li>
                            <li>
                                &nbsp;&nbsp;지나치게 서베이가 빨리 끝난 경우
                            </li>
                            <li>
                                &nbsp;&nbsp;명백하게 질문과 관계없는 응답인 경우
                            </li>
                            <li>
                                &nbsp;&nbsp;아무런 의미없는 단어 등을 기입한 경우 (ex- abcde, 12345, 😊, hahaha,…)
                            </li>
                            <li>
                                &nbsp;&nbsp;가짜 신상 정보를 기입하는 경우 (기존 기입하신 패널 정보 데이터와 다른 정보)
                            </li>
                        </ul>
                        <p>
                            <span>불량 응답이 <span class="color">3번</span> 발견될 경우, 해당 포인트를 회수하며 조사 참여에 제한이 있을 수 있습니다. <br>
                                <span class="color">5번</span> 불량 응답이 발견될 경우, 회원 탈퇴 처리가 될 수 있습니다.</span>
                        </p>
                    </li>
                </ul>
            </div>
        </section>
    </div>

    <script>
        $(document).ready(function() {

            $(".content-rd").mCustomScrollbar({
                theme: "light-3"
            });
        });

    </script>
    <script>
        /*$(document).ready(function() {
//            하단 컨텐츠 버튼 클릭시 문구 변경
            $('.bt >:button').click(function(){
               $(this).css({'color':'#707070','font-weight':'800'}).text('COMPLETED');
            });
        });*/


        $(document).ready(function() {
            var tabBtn = $("#tab-btn > ul > li"); //각각의 버튼을 변수에 저장
            var tabCont = $("#tab-cont > div"); //각각의 콘텐츠를 변수에 저장

            //컨텐츠 내용을 숨겨주세요!
            tabCont.hide().eq(0).show();

            tabBtn.click(function() {
                var target = $(this); //버튼의 타겟(순서)을 변수에 저장
                var index = target.index(); //버튼의 순서를 변수에 저장
                //alert(index);
                tabBtn.removeClass("active"); //버튼의 클래스를 삭제
                target.addClass("active"); //타겟의 클래스를 추가
                tabCont.css("display", "none");
                tabCont.eq(index).css("display", "block");
            });


        });

       function go_view(no){
		<?if($_SESSION['member_coinc_idx']){?>
			<?if($surv_auth == "N"){?>
				alert("Sign up through the online panel.");
			<?}else{?>
				location.href = "online-go-to-survey-post2.php?idx="+no+"&<?=$total_param?>&pageNo=<?=$pageNo?>";
			<?}?>
		<?}else{?>
			alert("please login first.");
		<?}?>
		}

		function regist_pannel(){
		<?if($_SESSION['member_coinc_idx']){?>
			window.open("panel.php","survey_mem", "top=100,left=400,scrollbars=yes,resizable=no,width=800,height=600");
		<?}else{?>
			alert("please login first.");
		<?}?>
		}

    </script>
    <? include "../include/footer_sub.php"?>
