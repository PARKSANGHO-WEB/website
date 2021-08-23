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
	$sql = "select a.*,b.user_id,b.user_name,b.file_chg from tb_pds a inner join member_info b on a.product_idx=b.idx where 1=1 and a.idx = '".$idx."' ";
} else {
	$sql = "SELECT * FROM tb_pds a where 1=1 and a.idx = '".$idx."' ";
}

$query = mysqli_query($gconnet,$sql);

//echo $sql; exit;

if(mysqli_num_rows($query) == 0){
?>
<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('해당하는 게시물이 없습니다.');
	location.href =  "notice.php?<?=$total_param?>";
	//-->
</SCRIPT>
<?
exit;
}

$row = mysqli_fetch_array($query);

?>
<!-- content -->
<script type="text/javascript">
<!--
function go_view(no){
		location.href = "notice-view.php?idx="+no+"&<?=$total_param?>";
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
</script>


<body>
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
	<div class="contents board-view">
    <? 
        $MENU_DEPTH1 = "1";
        $MENU_DEPTH2 = "1";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/notice/left.php"; 
    ?>
		<div class="center-con">
			<div class="cc-title">
				<div>공지사항</div>
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
                            <tr>
                                <th>첨부파일</th>
                                <td>
                                <?php
                                if(!$row['b_file1'] == null) {
                                    $fileName = $row['b_file1'];
                                    $fileExt = explode(".", $fileName);
                                    $fileActualExt = strtolower(end($fileExt));
                                    $images = array("jpg","jpeg","png");
                                    if(in_array($fileActualExt, $images)) {
                                        echo
                                        "
                                        <br><a href='../../upload_file/pds/".$row['b_file1']."'target='_blank'><p>".$row['ori_name']."</p></a>    
                                        <img src='../../upload_file/pds/".$row['b_file1']."' alter='설명이미지' style='width:100%'>
                                        ";
                                    } else {
                                        echo
                                        "
                                        <br><a href='../../upload_file/pds/".$row['b_file1']."'target='_blank'><p>".$row['ori_name']."</p></a>
                                        ";
                                    }

                                }
                                
                                ?>
                                </td>
                            </tr>
						</tbody>
					</table>
					<table class="prevnext">
						<tr>
							<th>다음글</th>
							<td>
                            <?
                                $down_query = "select idx,title from tb_pds where idx < ".$idx."  order by idx desc limit 0,1";
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
                                <a href="notice-view.php?idx=<?=$down_row['idx']?>&<?=$total_param?>">
                                    <?=string_cut2(stripslashes($down_row[title]),40)?> 
                                </a>
                            <? } ?>		
                            </td>
						</tr>
						<tr>
							<th>이전글</th>
							<td>
                            <?
                                $up_query = "select idx,title from tb_pds where idx > ".$idx."  order by idx asc limit 0,1";
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
                                <a href="notice-view.php?idx=<?=$up_row['idx']?>&<?=$total_param?>">
                                    <?=string_cut2(stripslashes($up_row[title]),40)?> 
                                </a>
                            <? } ?>
                            </td>
						</tr>
					</table>
					<div class="btn-float">
						<button type="button" onclick="location.href='./notice.php'">목록으로</button>
						<button type="button" onclick="location.href='./notice-modi.php?idx=<?=$row[idx]?>'">수정하기</button>
						<button type="button" onclick="location.href='./notice_del_action.php?idx=<?=$row[idx]?>'">삭제</button>
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