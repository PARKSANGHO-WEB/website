<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include "../include/header_sub.php"?>
<?
$bbs_code="data_list2";
$idx = trim(sqlfilter($_REQUEST['idx']));
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$field = trim(sqlfilter($_REQUEST['field']));
$keyword = sqlfilter($_REQUEST['keyword']);
$s_cate_code = trim(sqlfilter($_REQUEST['s_cate_code'])); // 게시판 카테고리 코드
$v_sect = "kr"; // 언어분류. kr -국어 / eng -영어 / cam -캄보디아 / myan -미얀마
################## 파라미터 조합 #####################
$total_param = 'field='.$field.'&keyword='.$keyword.'&bbs_code='.$bbs_code.'&v_sect='.$v_sect.'&s_cate_code='.$s_cate_code.'&pageNo='.$pageNo;

if(!$_SESSION['member_coinc_idx']){
	error_go("please login first","online-go-to-survey.php");
}

$sql_pre2 = "select idx from member_register_survey where 1 and member_idx='".$_SESSION['member_coinc_idx']."'"; 
$result_pre2  = mysqli_query($gconnet,$sql_pre2);
if(mysqli_num_rows($result_pre2) == 0){
	error_go("Sign up through the online panel.","online-go-to-survey.php");
}

$member_idx = $_SESSION['member_coinc_idx'];

$check_pass = trim(sqlfilter($_REQUEST['check_pass']));

$sql = "SELECT * FROM board_content where 1 and idx = '".$idx."' and bbs_code='".$bbs_code."'";
$query = mysqli_query($gconnet,$sql);

//echo $sql; exit;

if(mysqli_num_rows($query) == 0){
	error_go("There is no corresponding article.","online-go-to-survey.php?".$total_param."");
}

$row = mysqli_fetch_array($query);

/*if($row['member_idx'] && $row['member_idx'] == $_SESSION['member_bisut_idx']){ // 본인이 쓴 글일때 
} else { // 본인이 쓴 글이 아닐때 
	$passwd = $row['passwd'];
	$passwd = trim($passwd);

	if($check_pass == $passwd){
	} else {
		error_go("비밀번호가 맞지 않습니다","myask_list.php?".$total_param."");
	}
} // 본인이 쓴 글이 아닐때 종료 */

set_vcnt_up("board_content",$row['bbs_code'],$row['idx'],$row['member_idx'],$_SESSION['member_sellb_idx'],"board_content","cnt"); // 조회수 증가

$bbs_sect3 = stripslashes($row['bbs_sect3'.get_front_lang($v_sect).'']);
$bbs_sect3 = preg_replace("/ style=(\"|\')?([^\"\']+)(\"|\')?/","",$bbs_sect3);
$bbs_sect3 = preg_replace("/ style=([^\"\']+) /"," ",$bbs_sect3); 
$bbs_sect3 = str_replace("<img","<img style='max-width:90%;'",$bbs_sect3);

$content = stripslashes($row['content'.get_front_lang($v_sect).'']);
$content = preg_replace("/ style=(\"|\')?([^\"\']+)(\"|\')?/","",$content);
$content = preg_replace("/ style=([^\"\']+) /"," ",$content); 
$content = str_replace("<img","<img style='max-width:90%;'",$content);

$content2 = stripslashes($row['content2'.get_front_lang($v_sect).'']);
$content2 = preg_replace("/ style=(\"|\')?([^\"\']+)(\"|\')?/","",$content2);
$content2 = preg_replace("/ style=([^\"\']+) /"," ",$content2); 
$content2 = str_replace("<img","<img style='max-width:90%;'",$content2);
?>	
 <link rel="stylesheet" href="../css/online-go-to-survey-post.css">
<!--    상단 탭메뉴 사이즈 변형-->
    <style>
        section .about-cont .about-flat {
            width: 1280px;
        }
        section .about-cont .about-flat ul li {
            width: 256px;
        }
        
/*        상단 배너 배경이미지 변경*/
        section.about-busy .sub-banner {
            background: url('../img/sub/survey-ban.png');
        }
        
/*        상단 버튼 변경*/
        .post .busy4-btn{
            margin: 0 auto;
            text-align: center;
            margin-bottom: 30px;
        }
        .post .busy4-btn button:nth-child(1){
            margin-left: 0px;
        }
        .post .busy4-btn button{
            width: 138px;
            height: auto;
            box-shadow: 0px 0px 5px rgba(114,114,114,0.4);
            background-color: #fff;
            border-radius: 80px;
            padding: 10px 20px;
        }
        .post .busy4-btn button:hover{
            box-shadow:  0px 0px 8px rgba(114,114,114,0.6);
        }
        .post .busy4-btn button span{
            display: block;
        }
        .post .busy4-btn button .b4b-t{
            font-size: 1rem;
            font-weight: 700;
            font-family: 'Noto Sans KR', sans-serif;
            color: #FF6B65 !important;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/menu.js"></script>
<body>
   <? include "../include/gnb_sub1.php"?> 

    <section class="about-busy">
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
                            <a href="online-panel.php">GO TO SURVEY</a>
                        </li>
                    </ul>
                </div>
                <div class="ban-ment">
                    <span class="ban-title">GO TO SURVEY</span>
                    <span class="ban-text"></span>
                </div>
            </div>
        </div>
        <div class="about-cont">
            <div class="about-flat">
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
                        <a href="online-k-dod-point.php"> K-DOD Point</a>
                    </li>
                    <li  class="active">
                        <a href="online-go-to-survey.php">GO TO SURVEY</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <div id="survey_post">
        <section class="post">
            <div class="title">
                <h1><?=$row['subject'.get_front_lang($v_sect).'']?></h1>
            </div>
            <div class="text">
               <div class="date">
                    <p>
                       <?=substr($row[survey_start],0,10)?>~<?=substr($row[survey_end],0,10)?>
                    </p>
                </div>
                <div class="txt1">
                    <?=$bbs_sect3?>
                </div>
                <div class="txt2">
                    <?=$content?>
                </div>
                <div class="txt3">
                   <?=$content2?>
                </div>
		 <?if(date("Ymd") <= str_replace("-","",substr($row[survey_end],0,10))){ // 종료일 이전일때 ?>
			<?if($row[result_YN]=="1"){ // 서베이 참여 상태일경우 ?>
                <div class="busy4-btn bt">
                    <button type="button">
                      <?if($row[''.get_front_svlink($v_sect).'']){?>
                          <a href="<?=$row[''.get_front_svlink($v_sect).'']?>" target="_blank"><span class="b4b-t">Start Survey</span></a>
					  <?}else{?>
					    	<a href="javascript:;"><span class="b4b-t">Start Survey</span></a>
					  <?}?>
                    </button>
                </div>
			<?} // 서베이 참여 상태일경우?>
		<?} // 종료일 이전일때?>
            </div>
        </section>
    
	<?if(date("Ymd") > str_replace("-","",substr($row[survey_end],0,10))){ // 종료일을 경과했을때 시작 ?>
		<?if($row[result_YN]=="2"){ // 결과보기 상태일경우 시작 ?>    
        <section class="comment">
            <aside class="more">
                <div class="button1">
                    <h2>댓글 펼쳐보기</h2>
                    <img src="../img/sub/Icon%20ionic-ios-arrow-down.png" alt="아래버튼">
                </div>
                <div class="button2">
                    <h2>댓글 닫기</h2>
                    <img src="../img/sub/Icon%20ionic-ios-arrow-down.png" alt="아래버튼">
                </div>
            </aside>
            <div id="toc-content">
                <!-- inner_comment_list.php 에서 불러오기 -->
            </div>
                
           <form name="cmt_frm" id="cmt_frm" action="comment_write_action.php" target="_fra" method="post"  enctype="multipart/form-data">
				<input type="hidden" name="board_tbname" value="board_content">
				<input type="hidden" name="board_code" value="<?=$bbs_code?>">
				<input type="hidden" name="board_idx" value="<?=$idx?>">
				<input type="hidden" name="target_link" value="inner_comment_list.php">
				<input type="hidden" name="target_id" value="toc-content">
				<input type="hidden" name="is_html" value="N">
                <fieldset>
                    <legend>댓글창</legend>
					<?if($_SESSION['member_coinc_idx']){?>	
						 <textarea cols="30" rows="10" placeholder="내용을 입력해주세요" class="comments" name="fm_write" id="fm_write" required="yes" message="내용" ></textarea>
						 <button type="button" onclick="go_cmt_submit();">작성하기</button>
                    <?}else{?>
						<textarea cols="30" rows="10" placeholder="먼저 로그인 해주세요" readonly name="fm_write" id="fm_write" required="yes" message="내용" ></textarea>
					<?}?>
			   </fieldset>
           </form>
        </section>
		<?} // 결과보기 상태일경우 종료 ?>
	<?} // 종료일을 경과했을때 종료 ?>
    </div>

	<div style="height:20px;"></div>

<form name="comment_del_frm" id="comment_del_frm" action="comment_delete_action.php" target="_fra" method="post">
	<input type="hidden" name="board_tbname" value="board_content">
	<input type="hidden" name="board_code" value="<?=$bbs_code?>">
	<input type="hidden" name="board_idx" value="<?=$idx?>">
	<input type="hidden" name="target_link" value="inner_comment_list.php">
	<input type="hidden" name="target_id" value="toc-content">
	<input type="hidden" name="bbs_idx" id="bdel_comment_idx"/>
</form>

<form name="comment_mod_frm" id="comment_mod_frm" action="comment_modify_action.php" target="_fra" method="post"  enctype="multipart/form-data">
	<input type="hidden" name="board_tbname" value="board_content">
	<input type="hidden" name="board_code" value="<?=$bbs_code?>">
	<input type="hidden" name="board_idx" value="<?=$idx?>">
	<input type="hidden" name="target_link" value="inner_comment_list.php">
	<input type="hidden" name="target_id" value="toc-content">
	<input type="hidden" name="bbs_idx" id="bmod_comment_idx"/>
	<input type="hidden" name="rcpage" id="bmod_comment_page"/>
	<textarea name="fm_write" id="comment_fm_write" style="display:none;"></textarea>
</form>

<script type="text/javascript">
<!--
$(document).ready(function(){
	get_data("inner_comment_list.php","toc-content","board_tbname=board_content&bbs_code=<?=$bbs_code?>&product_idx=<?=$idx?>");
});

	function go_cmt_submit() {
		var check = chkFrm('cmt_frm');
		if(check) {
			cmt_frm.submit();
		} else {
			false;
		}
	}

	function go_comment_delete(no){
		if(confirm('Deleted posts cannot be recovered. Are you sure you want to delete?')){
			$("#bdel_comment_idx").val(no);
			$("#comment_del_frm").submit();
		}
	}

	function board_2_v(idx){
		if (document.getElementById("board_2_2_"+idx+"").style.display == ""){
			//document.getElementById("board_2_1_"+idx+"").style.display = "";
			document.getElementById("board_2_2_"+idx+"").style.display = "none";
		} else {
			//document.getElementById("board_2_1_"+idx+"").style.display = "none";
			document.getElementById("board_2_2_"+idx+"").style.display = "";
		}
	}

	function board_3_v(idx){
		if (document.getElementById("board_3_2_"+idx+"").style.display == ""){
			document.getElementById("board_3_1_"+idx+"").style.display = "";
			document.getElementById("board_3_2_"+idx+"").style.display = "none";
		} else {
			document.getElementById("board_3_1_"+idx+"").style.display = "none";
			document.getElementById("board_3_2_"+idx+"").style.display = "";
		}
	}

	function go_comment_reply(frm_name) {
		var check = chkFrm(frm_name);
		if(check) {
			document.forms[frm_name].submit();
		} else {
			return;
		}
	}

	function go_comment_mod(idx){
		
		$("#bmod_comment_idx").val($("#inner_bbs_idx_"+idx+"").val());
		$("#comment_fm_write").val($("#inner_fm_write_"+idx+"").val());
		$("#bmod_comment_page").val($("#inner_rcpage_"+idx+"").val());
		
		if($("#bmod_comment_idx").val() == ""){
			alert("No comments to edit.");
			return;
		}
		if($("#comment_fm_write").val() == ""){
			alert("Please enter the content to edit.");
			return;
		}
		$("#comment_mod_frm").submit();
	}

</script>

    <script>
        
        /*$(document).ready(function() {
//            스타트 서베이 버튼 클릭시 문구 변경
            $('.bt >:button').click(function(){
               $(this).css({'color':'#707070','font-weight':'800'}).text('Result Download');
            });
            
            
//            댓글 더보기
//            $('.comment > article').hide();
            
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
            
            
            $('#toc-content').hide();
            $('.button2').hide();
//			opne클릭시 gnb메뉴 보이기
			$('.button1').click(function(){
				$('#toc-content').show();
//				$('.comment > article').animate({'width':200,'opacity':1},1000);
				$('.button1').stop().hide();
				$('.button2').stop().show();
				$('.button2>img').addClass('rotate');
			});
//			close클릭시 gnb메뉴 가리기
			$('.button2').click(function(){
//				$('.comment > article').animate({'width':0,'opacity':0},1000);
				$('#toc-content').hide();
				$('.button1').stop().show();
				$('.button2').stop().hide();
				$('.button2>img').removeClass('rotate');
			});


        });
    </script>


<? include "../include/footer_sub.php"?>