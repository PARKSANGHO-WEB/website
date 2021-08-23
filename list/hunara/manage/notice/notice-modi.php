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
	<div class="contents board-view">
		<div class="left-menu">
			<div class="lm-t">
				<p>게시판 관리</p>
			</div>
			<ul>
				<li class="lm-act">
					<div class="lm-list">
						<ul>
							<li class="active"><a href="notice.php">공지사항</a></li>
							<li><a href="qna.php">Q&amp;A</a></li>
							<li><a href="review.php">이용후기</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
		<div class="center-con">
			<div class="cc-title">
				<div>공지사항</div>
				<div class="big-arrow"><img src="../img/common/big-arrow.png" alt=""></div>
				<div>수정</div>
			</div>
			<div class="cc-con">
				<form name="frm" action="notice_modify_action.php" target="_fra_admin" method="post"  enctype="multipart/form-data">
                <input type="hidden" name="total_param" value="<?=$total_param?>"/>
				<input type="hidden" name="idx" value="<?=$idx?>"/>
					<table>
						<tbody>
							<tr>
                            <th>
                                <span>기업선택</span>
                            </th>
                            <td colspan="3">
                                <select name="id" id="id">
                                    <option value="">기업명을 선택하세요.</option>
                                    <?= getSelectBox($gconnet, 'idx', 'comname', 'tb_company', '', $row['bkind']) ?>
                                </select>
                            </td>
                            </tr>
							<tr>
								<th>
									<span>제목</span>
								</th>
								<td colspan="3">
									<input type="text" placeholder="제목입니다." name="title" value="<?=$row[title]?>">
								</td>
							</tr>
							<tr>
								<th>내용</th>
								<td colspan="3">
									<textarea placeholder="내용입니다." id="editor" style="width:750px;" name="content"><?=$row[content]?></textarea>
								</td>
							</tr>
							<?
								$sql_file = "select idx,b_file1,ori_name from tb_pds where 1=1 and idx='".$row['idx']."' order by idx asc ";
								$query_file = mysqli_query($gconnet,$sql_file);
								$cnt_file = mysqli_num_rows($query_file);

								if($cnt_file < 1){
									$cnt_file = 1;
								}
								
								for($i_file=0; $i_file<$cnt_file; $i_file++){
									$row_file = mysqli_fetch_array($query_file);
									$k_file = $i_file+1;
							?>
							<input type="hidden" name="pfile_idx_<?=$i_file?>" value="<?=$row_file['idx']?>" />
							<input type="hidden" name="pfile_old_name_<?=$i_file?>" value="<?=$row_file['file_chg']?>" />
							<input type="hidden" name="pfile_old_org_<?=$i_file?>" value="<?=$row_file['file_org']?>" />
							<tr>
								<th>파일</th>
								<td colspan="3">
									<div class="file-input">
										<input type="file" maxlength="10" required="no" message="기타 첨부자료" name="file_<?=$i_file?>" id="file_<?=$i_file?>">
										<span class="button">파일선택</span>
										<?php if($row['b_file1']){?>
											<span class="label" data-js-label=""><?=$row['b_file1']?></span>
										<?php }else{ ?>
											<span class="label" data-js-label="">선택된 파일 없음</span>
										<?php } ?>
									</div>
								</td>
							</tr>
							<?}?>
						</tbody>
					</table>
					<div class="btn-float">
						<button type="button"onclick="location.href='./notice.php'">목록으로</button>
						<button type="button" onclick="go_submit();">완료</button>
						<button type="button" onclick="location.href='./notice_del_action.php?idx=<?=$row[idx]?>'">삭제</button>
					</div>
				</form>
				<iframe name="_fra_admin" width="500" height="200" style="display:<?=$show_iframe==TRUE?"":"none"?>"></iframe>
			</div>
		</div>
	</div>

	<!--  셀렉트박스  -->
    <script type="text/javascript" src="/smarteditor2/js/HuskyEZCreator.js" charset="utf-8"></script>
	<script type="text/javascript">
    var oEditors = [];
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "editor",
		sSkinURI: "/smarteditor2/SmartEditor2Skin.html",	
		htParams : {bUseToolbar : true,
			fOnBeforeUnload : function(){
				//alert("아싸!");	
			}
		}, //boolean
		fOnAppLoad : function(){
			//예제 코드
			//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
		},
		fCreator: "createSEditor2"
	});
	</script>
	
	
	<!--  셀렉트박스와 파일업로드	-->
	
	<script type="text/javascript">
		
		$(document).ready(function () {	
			$('select').wSelect();
		});

		function go_submit() {
            var check = chkFrm('frm');
            if(check) {
            	oEditors.getById["editor"].exec("UPDATE_CONTENTS_FIELD", []);
                frm.submit();
            } else {
                false;
            }
        }
		

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