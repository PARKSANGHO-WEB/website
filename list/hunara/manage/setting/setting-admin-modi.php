<? include("../inc/header.php"); ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<link rel="stylesheet" href="/manage/css/setting.css">
 
<?

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

	$sql = "SELECT * FROM tb_adminuser a where 1=1 and a.idx = '".$idx."' ";

$query = mysqli_query($gconnet,$sql);

//echo $sql; exit;

if(mysqli_num_rows($query) == 0){
?>
<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('해당하는 관리자가 없습니다.');
	location.href =  "setting-admin.php?<?=$total_param?>";
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

function go_modify(no){
		location.href = "setting-admin-modi.php?idx="+no+"&<?=$total_param?>";
}

function go_delete(no){
	if(confirm('해당 관리자를 삭제하시겠습니까?')){
	//	if(confirm('삭제하신 데이터는 복구할수 없도록 영구 삭제 됩니다. 그래도 삭제 하시겠습니까?')){	
			_fra_admin.location.href = "admin_delete_action.php?idx="+no+"&<?=$total_param?>";
	//	}
	}
}
</script>
<body class="room-body">
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>

	<div class="contents admin-modi">
		<div class="left-menu">
			<div class="lm-t">
				<p>설정 관리</p>
			</div>
			<ul>
				<li class="lm-act">
					<p class="lm-big active">설정 관리</p>
					<div class="lm-list">
						<ul>
							<li class="active"><a href="./setting-admin.php">관리자 정보 관리</a></li>
							<li><a href="./setting-pop.php">기업별 팝업 관리</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
		<div class="center-con">
			<div class="cc-title">
				<div>관리자 정보 관리</div>
				<div class="big-arrow"><img src="../img/common/big-arrow.png" alt=""></div>
				<div>수정</div>
			</div>
			<div class="cc-con">
                <form name="frm" action="setting_modify_action.php" target="_fra_admin" method="post"  enctype="multipart/form-data">
                <input type="hidden" name="idx" value="<?=$idx?>">
                <input type="hidden" name="mem_idx" value="<?=$row[mem_idx]?>">
                <input type="hidden" name="mem_level" value="<?=$row[mem_level]?>">
                <input type="hidden" name="flag" value="<?=$row[flag]?>">
						<div class="set-tab">
							<table id="admin-view">
								<tr>
									<th>아이디</th>
									<td><input type="text" placeholder="<?=$row[mem_idx]?>" disabled></td>
								</tr>
								<tr>
									<th>비밀번호</th>
									<td><input type="password" name="mem_pwd"><span>비밀번호 변경시에만 입력</span></td>
								</tr>
								<tr>
									<th>성명</th>
									<td><input type="text" name="mem_name" value="<?=$row[mem_name]?>"></td>
								</tr>
								<tr>
									<th>연락처</th>
									<td>
										<input class="only-num" type="text" name="tel1" value="<?=explode('-',$row[mem_tel])[0]?>">
										<span class="hypen">-</span>
										<input class="only-num" type="text" name="tel2" value="<?=explode('-',$row[mem_tel])[1]?>">
										<span class="hypen">-</span>
										<input type="text" class="only-num" name="tel3" value="<?=explode('-',$row[mem_tel])[2]?>">
									</td>
								</tr>
								<tr>
									<th>이메일</th>
									<td>
										<input type="text" name="email1" value="<?=explode('@',$row[email])[0]?>">
										<span class="gol">@</span>
										<input type="text" name="email2" value="<?=explode('@',$row[email])[1]?>">
									</td>
								</tr>
							</table>
							<div class="btn-float">
								<button type="button" onclick="location.href='./setting-admin.php'">목록으로</button>
								<button type="button" onclick="go_submit();"> 수정하기</button>
								<button type="button" onclick="go_delete(<?=$idx?>)"> 삭제하기</button>
							</div>
						</div>
				</form>
			</div>
		</div>
	</div>
    <iframe name="_fra_admin" width="500" height="200" style="display:<?=$show_iframe==TRUE?"":"none"?>"></iframe>
	
	<!--  셀렉트 박스  -->
	
	<script type="text/javascript">
		$(document).ready(function () {
				
				$('select').wSelect();
			});

            function go_submit() {
            var check = chkFrm('frm');
            if(check) {
                //oEditors.getById["editor"].exec("UPDATE_CONTENTS_FIELD", []);
                frm.submit();
            } else {
                false;
            }
        }
	</script>
	
</body>
</html>