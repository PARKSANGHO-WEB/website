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


$sql = "SELECT *,(select comname from tb_company where idx = a.bkind) as comname, (select tel from tb_company where idx = a.bkind) as tel FROM tb_qa a where 1=1 and a.idx = '".$idx."' ";


$query = mysqli_query($gconnet,$sql);

//echo $sql; exit;

if(mysqli_num_rows($query) == 0){
?>
<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('해당하는 게시물이 없습니다.');
	location.href =  "qna.php?<?=$total_param?>";
	//-->
</SCRIPT>
<?
exit;
}

$row = mysqli_fetch_array($query);


$sql2 = "SELECT * from tb_qa where idx != '".$idx."' and ref = '".$idx."' order by idx desc limit 0,1";
$query2 = mysqli_query($gconnet,$sql2);
$row2 = mysqli_fetch_array($query2);

$flag = '';
if($row2[idx]){
    $flag='Y';
}

?>
<!-- content -->
<script type="text/javascript">
<!--

function go_modify(no){
		location.href = "board_modify.php?idx="+no+"&<?=$total_param?>";
}


function go_delete(no){
	if(confirm('해당 게시물을 숨기시겠습니까?')){
	//	if(confirm('삭제하신 데이터는 복구할수 없도록 영구 삭제 됩니다. 그래도 삭제 하시겠습니까?')){	
			_fra_admin.location.href = "board_delete_action.php?idx="+no+"&<?=$total_param?>";
	//	}
	}
}

function go_submit() {
	var check = chkFrm('frm');
	if(check) {
		frm.submit();
	} else {
		false;
	}
}

//-->		
</script>


<body>
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
	<div class="contents qna-view">
    <? 
        $MENU_DEPTH1 = "1";
        $MENU_DEPTH2 = "2";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/notice/left.php"; 
    ?>
		<div class="center-con">
			<div class="cc-title">
				<div>Q&amp;A</div>
				<div class="big-arrow"><img src="../img/common/big-arrow.png" alt=""></div>
				<div>상세</div>
			</div>
			<div class="cc-con">
                <form name="frm" action="qna-reple_action.php" target="_fra_admin" method="post"  enctype="multipart/form-data">
                <input type="hidden" name="title" value="<?=$row[title]?>">
                <input type="hidden" name="idx" value="<?=$idx?>">
                <input type="hidden" name="bkind" value="<?=$row[bkind]?>">
                <input type="hidden" name="ip" value="<?= $_SERVER['REMOTE_ADDR']?>">
                <input type="hidden" name="pwd" value="<?=$row[pwd]?>">
                <input type="hidden" name="flag" value="<?=$flag?>">
                <input type="hidden" name="idx2" value="<?=$row2[idx]?>">
                <input type="hidden" name="name" value="<?=$_SESSION['MEM_NAME']?>">
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
									<span>작성자</span>
								</th>
								<td>
                                    <?=$row[name]?>
								</td>
								<th>
									<span>등록일</span>
								</th>
								<td>
                                    <?=substr($row[nows],0,11)?>
								</td>
							</tr>
							<tr>
								<th>
									<span>기업명</span>
								</th>
								<td>
                                    <?=$row[comname]?>
								</td>
								<th>
									<span>연락처</span>
								</th>
								<td>
                                    <?=$row[tel]?>
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
                                $down_query = "select idx,title from tb_qa where idx < ".$idx."  order by idx desc limit 0,1";
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
                                <a href="qna-reple.php?idx=<?=$down_row['idx']?>&<?=$total_param?>">
                                    <?=string_cut2(stripslashes($down_row[title]),40)?> 
                                </a>
                            <? } ?>		
                            </td>
						</tr>
						<tr>
							<th>이전글</th>
							<td>
                            <?
                                $up_query = "select idx,title from tb_qa where idx > ".$idx."  order by idx asc limit 0,1";
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
                                <a href="qna-reple.php?idx=<?=$up_row['idx']?>&<?=$total_param?>">
                                    <?=string_cut2(stripslashes($up_row[title]),40)?> 
                                </a>
                            <? } ?>
                            </td>
						</tr>
					</table>
                    
					<table class="write-reple">
						<!--<tr>
							<th>작성자</th>
							<td><input type="text" name="name" value="<?=$_SESSION['MEM_NAME']?>" readonly></td>
						</tr>-->
						<tr>
							<th>내용</th>
							<td><textarea name="content"><?=$row2[content]?></textarea></td>
						</tr>
						<?
                                for($file_i=0; $file_i<$_include_board_file_cnt; $file_i++){
                                    $file_k = $file_i+1;
                        ?>
                            <tr>
                                <th >첨부파일 <?=$file_k?></th>
                                <td>
                                <div class="file-input">
                                    <input type="file" style="width:400px;" required="no" message="첨부파일" name="file_<?=$file_i?>">
                                    <span class="button">파일선택</span>
                                    <?php if($row2['b_file1']){?>
                                        <span class="label" data-js-label=""><?=$row2['b_file1']?></span>
                                    <?php }else{ ?>
                                        <span class="label" data-js-label="">선택된 파일 없음</span>
                                    <?php } ?>
                                </div>
                                </td>
                            </tr>
                        <?}?>
						<tr>
							<td colspan="2">
								<button type="button" onclick="go_submit();">답변등록</button>
							</td>
						</tr>
					</table>
					<div class="btn-float">
						<button type="button" onclick="location.href='./qna.php'">목록으로</button>
						<button type="button" onclick="location.href='./qna_del_action.php?idx=<?=$row[idx]?>'">삭제</button>
					</div>
				</form>
                <iframe name="_fra_admin" width="500" height="200" style="display:<?=$show_iframe==TRUE?"":"none"?>"></iframe>
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