<? include("../inc/header.php"); ?>

<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<?
/*if(!$_AUTH_WRITE){
	error_back("본문작성 권한이 없습니다.");
	exit;
}*/

$s_cate_code = trim(sqlfilter($_REQUEST['s_cate_code'])); // 게시판 카테고리 코드
$bbs_code = trim(sqlfilter($_REQUEST['bbs_code'])); // 게시판 코드
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$field = trim(sqlfilter($_REQUEST['field']));
$keyword = sqlfilter($_REQUEST['keyword']);

################## 파라미터 조합 #####################
$total_param = 'bmenu='.$bmenu.'&smenu='.$smenu.'&field='.$field.'&keyword='.$keyword.'&bbs_code='.$bbs_code.'&s_cate_code='.$s_cate_code;

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

?>

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
				<div>등록하기</div>
			</div>
			<div class="cc-con">
                <form name="frm" action="notice_write_action.php" target="_fra_admin" method="post"  enctype="multipart/form-data">
                <input type="hidden" name="total_param" value="<?=$total_param?>"/>
					<table>
						<tbody>
                            <tr>
                            <th>
                                <span>기업선택</span>
                            </th>
                            <td colspan="3">
                                <select name="id" id="id">
                                    <option value="">기업명을 선택하세요.</option>
                                    <?= getSelectBox($gconnet, 'idx', 'comname', 'tb_company') ?>
                                </select>
                            </td>
                            </tr>
							<tr>
								<th>
									<span>제목</span>
								</th>
								<td colspan="3">
									<input type="text" name="title" required="yes" message="제목">
								</td>
							</tr>
							<tr>
								<th>내용</th>
								<td colspan="3">
									<textarea id="editor" name="content" style="width:750px;"></textarea>
								</td>
							</tr>
							<tr>
                            <?
                                    for($file_i=0; $file_i<$_include_board_file_cnt; $file_i++){
                                        $file_k = $file_i+1;
                            ?>
                                <tr>
                                    <th >첨부파일 <?=$file_k?></th>
                                    <td colspan="3">
                                    <div class="file-input">
                                        <input type="file" style="width:400px;" required="no" message="첨부파일" name="file_<?=$file_i?>">
                                        <span class="button">파일선택</span>
                                        <span class="label" data-js-label="">선택된 파일 없음</span>
                                    </div>
                                    </td>
                                </tr>
                            <?}?>			
							</tr>
						</tbody>
					</table>
					<div class="btn-float">
						<button type="button" onclick="javascript:location.href='notice.php'">목록으로</button>
						<button type="button" onclick="go_submit();">완료</button>
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