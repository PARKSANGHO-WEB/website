<? include("../inc/header.php"); ?>


<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<?
/*if(!$_AUTH_VIEW){
	error_back("본문보기 권한이 없습니다.");
	exit;
}*/

$idx = trim(sqlfilter($_REQUEST['idx']));
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$field = trim(sqlfilter($_REQUEST['field']));
$keyword = sqlfilter($_REQUEST['keyword']);
$bbs_code = sqlfilter($_REQUEST['bbs_code']);
$s_cate_code = trim(sqlfilter($_REQUEST['s_cate_code'])); // 게시판 카테고리 코드
$v_sect = trim(sqlfilter($_REQUEST['v_sect'])); // 게시판 분류
$s_gender = sqlfilter($_REQUEST['s_gender']); // 성별 검색
################## 파라미터 조합 #####################
$total_param = 'bmenu='.$bmenu.'&smenu='.$smenu.'&field='.$field.'&keyword='.$keyword.'&bbs_code='.$bbs_code.'&v_sect='.$v_sect.'&s_cate_code='.$s_cate_code.'&s_gender='.$s_gender.'&pageNo='.$pageNo;

if($bbs_code == "reviews"){
	$sql = "select a.*,b.user_id,b.user_name,b.file_chg from tb_rv a inner join member_info b on a.product_idx=b.idx where 1=1 and a.idx = '".$idx."' ";
} else {
	$sql = "SELECT * FROM tb_rv a where 1=1 and a.idx = '".$idx."' ";
}

$query = mysqli_query($gconnet,$sql);

//echo $sql; exit;

if(mysqli_num_rows($query) == 0){
?>
<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('해당하는 게시물이 없습니다.');
	location.href =  "review.php?<?=$total_param?>";
	//-->
</SCRIPT>
<?
exit;
}

$row = mysqli_fetch_array($query);

################## 조회수 관리 시작 ############################

if($_SESSION['admin_coinc_idx'] == $row['member_idx']){ 
} else {  // 작성자 본인이 열람하는것이 아닐때 시작
		
	$sql_prev = "select idx from review-view_cnt where 1=1 and board_tbname='tb_rv' and board_code = '".$row['bbs_code']."' and board_idx='".$row['idx']."' and member_idx = '".$_SESSION['admin_coinc_idx']."' ";
	$query_prev = mysqli_query($gconnet,$sql_prev);
	$cnt_prev = mysqli_num_rows($query_prev);

	if($cnt_prev == 0){ // 현 게시물을 처음 볼때 한해서 조회수를 증가시킨다 시작 
			
			$query_view_cnt = " insert into review-view_cnt set "; 
			$query_view_cnt .= " board_tbname = 'tb_rv', ";
			$query_view_cnt .= " board_code = '".$row['bbs_code']."', ";
			$query_view_cnt .= " board_idx = '".$row['idx']."', ";
			$query_view_cnt .= " member_idx = '".$_SESSION['admin_coinc_idx']."', ";
			$query_view_cnt .= " cnt = '1', ";
			$query_view_cnt .= " wdate = now() ";
			$result_view_cnt = mysqli_query($gconnet,$query_view_cnt);

			$sql_cnt = "update tb_rv set cnt=cnt+1 where 1=1 and idx = '".$row['idx']."'";
			$query_cnt = mysqli_query($gconnet,$sql_cnt);
	
	} // 현 게시물을 처음 볼때 한해서 조회수를 증가시킨다 종료 

}  // 작성자 본인이 열람하는것이 아닐때 종료

$current_cnt_query = "select sum(cnt) as current_cnt from review-view_cnt where 1=1 and board_tbname='tb_rv' and board_code = '".$row['bbs_code']."' and board_idx='".$row['idx']."' ";
$current_cnt_result = mysqli_query($gconnet,$current_cnt_query);
$current_cnt_row = mysqli_fetch_array($current_cnt_result);
if ($current_cnt_row['current_cnt']){
	$current_cnt = $current_cnt_row['current_cnt'];
} else{
	$current_cnt = 1;
} 

################## 조회수 관리 종료 ############################


if($s_cate_code) {
	$sql_sub1 = "select cate_name1 from board_cate where cate_code1='".$s_cate_code."' and cate_level='1' ";
	$query_sub1 = mysqli_query($gconnet,$sql_sub1);
	$row_sub1 = mysqli_fetch_array($query_sub1);
	$bbs_cate_name = $row_sub1['cate_name1'];
}

if($bbs_code){
	$bbs_str = $_include_board_board_title;
} elseif($s_cate_code) {
	$bbs_str = $bbs_cate_name." 카테고리에 해당하는 ";
}

			switch ($row[bbs_sect]) {
						case "t1" : 
						$bbs_sect = "의뢰자가 자주묻는 질문";
						break;
						case "t2" : 
						$bbs_sect = "디자이너가 자주묻는 질문";
						break;
						case "t3" : 
						$bbs_sect = "진행중";
						break;
						case "t4" : 
						$bbs_sect = "심사중";
						break;
						case "t5" : 
						$bbs_sect = "완료";
						break;
						case "t6" : 
						$bbs_sect = "일반";
						break;	
				} 

################### 댓글 서브페이징 시작 ####################

$pageNo_sub = trim(sqlfilter($_REQUEST['pageNo_sub']));
$total_param_sub = $total_param.'&idx='.$idx;
	
################### 댓글 서브페이징 종료 ####################


?>
<!-- content -->
<script type="text/javascript">
<!--
function go_view(no){
		location.href = "review-view.php?idx="+no+"&<?=$total_param?>";
}
	
function go_modify(no){
		location.href = "board_modify.php?idx="+no+"&<?=$total_param?>";
}

function go_reply(no){
		location.href = "board_reply.php?idx="+no+"&<?=$total_param?>";
}

function go_delete(no){
	if(confirm('해당 게시물을 숨기시겠습니까?')){
	//	if(confirm('삭제하신 데이터는 복구할수 없도록 영구 삭제 됩니다. 그래도 삭제 하시겠습니까?')){	
			_fra_admin.location.href = "board_delete_action.php?idx="+no+"&<?=$total_param?>";
	//	}
	}
}

function go_delete_can(no){
	if(confirm('숨겨진 글을 원상복구 하시겠습니까?')){
	//	if(confirm('삭제하신 데이터는 복구할수 없도록 영구 삭제 됩니다. 그래도 삭제 하시겠습니까?')){	
			_fra_admin.location.href = "board_delete_cancel_action.php?idx="+no+"&<?=$total_param?>";
	//	}
	}
}

function go_delete_complete(no){
	if(confirm('완전히 삭제하신 데이터는 이후 복구가 불가능 합니다. 그래도 삭제 하시겠습니까?')){	
		if(confirm('정말 완전히 삭제 하시겠습니까?')){
			_fra_admin.location.href = "board_delete_complete_action.php?idx="+no+"&<?=$total_param?>";
		}
	}
}

function go_list(){
	location.href = "board_list.php?<?=$total_param?>";
}

function go_submit() {
	var check = chkFrm('frm');
	if(check) {
		frm.submit();
	} else {
		false;
	}
}

function go_delete_com(no){
	if(confirm('해당 댓글을 숨기시겠습니까?')){
		_fra_admin.location.href = "delete_action_com.php?board_idx=<?=$row[idx]?>&idx="+no+"&<?=$total_param?>&pageNo=<?=$pageNo?>";
	}
}

function go_delete_can_com(no){
	if(confirm('숨겨진 댓글을 원상복구 하시겠습니까?')){
		_fra_admin.location.href = "delete_cancel_action_com.php?board_idx=<?=$row[idx]?>&idx="+no+"&<?=$total_param?>&pageNo=<?=$pageNo?>";
	}
}

function comment_delete(no){
	if(confirm('해당 댓글을 삭제하시겠습니까?')){
		_fra_admin.location.href = "comment_delete_action.php?idx=<?=$row[idx]?>&comment_idx="+no+"&<?=$total_param?>";
	}
}

function go_reco(){
	if(confirm('정말 추천 하시겠습니까?')){
	//	if(confirm('삭제하신 데이터는 복구할수 없도록 영구 삭제 됩니다. 그래도 삭제 하시겠습니까?')){	
			_fra_admin.location.href = "review-view_reco_action.php?idx=<?=$row['idx']?>&bbs_code=<?=$row['bbs_code']?>&<?=$total_param?>";
	//	}
	}
}

function pay_back_submit() {
	var check = chkFrm('pay_back_frm');
	if(check) {
		pay_back_frm.submit();
	} else {
		false;
	}
}

function comment_reply(ktmp) {
		
	var cur_comment_1 = "comment_in_"+ktmp+"_1";
	var cur_comment_2 = "comment_in_"+ktmp+"_2";
	var cur_comment_3 = "comment_in_"+ktmp+"_3";
		
	var next_viewObj1 = document.getElementById(cur_comment_1);
	next_viewObj1.style.display = 'block';

	var next_viewObj2 = document.getElementById(cur_comment_2);
	next_viewObj2.style.display = 'block';

	var next_viewObj3 = document.getElementById(cur_comment_3);
	next_viewObj3.style.display = 'block';

}

function go_comment_reply(frm_name) {
	var check = chkFrm(frm_name);
	if(check) {
		document.forms[frm_name].submit();
	} else {
		return;
	}
}

function go_comment_reco(no){
	if(confirm('추천 하시겠습니까?')){
	//	if(confirm('삭제하신 데이터는 복구할수 없도록 영구 삭제 됩니다. 그래도 삭제 하시겠습니까?')){	
			_fra_admin.location.href = "comment_view_reco_action.php?board_idx=<?=$row['idx']?>&comment_idx="+no+"&bbs_code=<?=$row['bbs_code']?>&<?=$total_param?>";
	//	}
	}
}

function go_reply_modify(no){
	location.href = "board_modify.php?idx="+no+"&orgin_idx=<?=$row[idx]?>&<?=$total_param?>";
}

function go_reply_delete(no){
	if(confirm('답변을 삭제하시면 영구 삭제가 됩니다. 그래도 삭제 하시겠습니까?')){
		if(confirm('삭제된 답변은 복구되지 않습니다. 정말로 삭제 하시겠습니까?')){
			_fra_admin.location.href = "board_delete_complete_action.php?idx="+no+"&orgin_idx=<?=$row[idx]?>&<?=$total_param?>";
		}
	}
}
//-->		
</script>

<body>
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
	<div class="contents review-view">
    <? 
        $MENU_DEPTH1 = "1";
        $MENU_DEPTH2 = "3";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/notice/left.php"; 
    ?>
		<div class="center-con">
			<div class="cc-title">
				<div>이용후기</div>
				<div class="big-arrow"><img src="../img/common/big-arrow.png" alt=""></div>
				<div>상세보기</div>
			</div>
			<div class="cc-con">
				<form action="#">
					<table>
						<tbody>
							<tr>
								<th>
									<span>제목</span>
								</th>
								<td colspan="3">
									<?=$row[title]?>
								</td>
							</tr>
							<tr>
								<th>
									<span>조회수</span>
								</th>
								<td>
                                   <?=$row[hit]?>
								</td>
								<th>
									<span>등록일</span>
								</th>
								<td>
                                    <?=substr($row[nows],0,11)?>
								</td>
							</tr>
							<tr>
								<th>내용</th>
								<td colspan="3"><?=$row[content]?></td>
							</tr>
						</tbody>
					</table>
					<table class="prevnext">
						<tr>
							<th>다음글</th>
							<td>
                            <?
                                $down_query = "select idx,title from tb_rv where idx < ".$idx."  order by idx desc limit 0,1";
                                if($my_list){ // 1:1 게시판일때
                                    if($view_idx){
                                        $down_query .= " and view_idx = '".$view_idx."' ";
                                    }
                                }

                                //echo $query;
                                $down_result = mysqli_query($gconnet,$down_query);
                                $down_row = mysqli_fetch_array($down_result);

                                    if(mysqli_num_rows($down_result) == 0){
                            ?>
                                    다음글이 없습니다.
                            <? } else { ?>
                                <a href="review-view.php?idx=<?=$down_row['idx']?>&<?=$total_param?>">
                                    <?=string_cut2(stripslashes($down_row[title]),40)?> 
                                </a>
                            <? } ?>		
                            </td>
						</tr>
						<tr>
							<th>이전글</th>
							<td>
                            <?
                                $up_query = "select idx,title from tb_rv where idx > ".$idx."  order by idx asc limit 0,1";
                                if($my_list){ // 1:1 게시판일때
                                    if($view_idx){
                                        $up_query .= " and view_idx = '".$view_idx."' ";
                                    }
                                }

                                //echo $query;
                                $up_result = mysqli_query($gconnet,$up_query);
                                $up_row = mysqli_fetch_array($up_result);

                                    if(mysqli_num_rows($up_result) == 0){
                            ?>
                                    이전글이 없습니다.
                            <? } else { ?>
                                <a href="review-view.php?idx=<?=$up_row['idx']?>&<?=$total_param?>">
                                    <?=string_cut2(stripslashes($up_row[title]),40)?> 
                                </a>
                            <? } ?>
                            </td>
						</tr>
					</table>
					<div class="btn-float">
						<button type="button" onclick="location.href='./review.php'">목록으로</button>
						<button type="button" onclick="location.href='./review_del_action.php?idx=<?=$row[idx]?>'">삭제</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	<!--  셀렉트박스와 파일업로드	-->
	
	<script type="text/javascript">
		
		$(document).ready(function () {	
			$('select').wSelect();
		});
		

		$(document).ready(function(){
			// Also see: https://www.quirksmode.org/dom/inputfile.php

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


		
	</script>
	
	
	
	<!-- 테이블 sort 선언	-->
	
	
	<script>
		$(document).ready(function(){
			
			$('.view-t').on('click',function(){
					if( $(this).parents('.view').hasClass('on') ){
						$(this).parents('.view').removeClass('on');
					}else{
						$('.view').removeClass('on');
						$(this).parents('.view').addClass('on');
					}
				});
		});
	
	</script>
	
</body>
</html>