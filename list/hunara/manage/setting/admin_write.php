<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../css/setting.css">
	<link rel="stylesheet" href="../css/common.css">
	<link rel="stylesheet" href="../css/zebra_datepicker.css">
	<link rel="stylesheet" href="../css/wSelect.css">
	<link rel="stylesheet" href="../css/calendar.css">
	<meta charset="UTF-8">
	<title>휴나라 관리자모드</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="../js/zebra_datepicker.src.js"></script>
	<script src="../js/wSelect.js"></script>
	<script src="../js/checkbox.js"></script>
	<script src="../js/tab.js"></script>
	<script src="../js/modal.js"></script>
	<script src="../js/calendar.js"></script>
    <script src="/manage/js/common_js.js"></script>
</head>

<!--팝업 오픈-->
 <script language="javascript">
  	function roomPopup() { 
			window.open("company-room-pop.php", "a", "width=900, height=800, left=100, top=50"); 
		}
 </script>

 
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

/*if(mysqli_num_rows($query) == 0){
?>
<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('해당하는 관리자가 없습니다.');
	location.href =  "setting-admin.php?<?=$total_param?>";
	//-->
</SCRIPT>
<?
exit;
}*/

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
	<header>
		<div class="logo" onclick="location.href='../home.php'">
			<img src="../img/common/logo.png" alt="">
		</div>
		<div class="gnb">
			<ul>
				<li>
					<a href="javascript:;">휴나라_admin 님</a>
				</li>
				<li>
					<a href="javascript:;">홈페이지 이동</a>
				</li>
				<li>
					<a href="javascript:;">로그아웃</a>
				</li>
			</ul>
		</div>
	</header>
	<div class="menu">
		<ul>
			<li>
				<a href="../company/company.php">기업관리</a>
			</li>
			<li>
				<a href="../room/room-new.php">휴양소 관리</a>
			</li>
			<li>
				<a href="../reserve/reserve-selected.php">예약 관리</a>
			</li>
			<li>
				<a href="../notice/notice.php">게시판 관리</a>
			</li>
			<li class="active">
				<a href="./setting-admin.php">설정 관리</a>
			</li>
		</ul>
	</div>
	<div class="root-wrap">
		<div class="root">
			<ul>
				<li>
					<a href="../home.php">Home</a>
				</li>
				<li class="arrow"><img src="../img/common/arrow.svg" alt=""></li>
				<li>
					<a href="./setting-admin.php">설정관리</a>
				</li>
				<li class="arrow"><img src="../img/common/arrow.svg" alt=""></li>
				<li>
					<a href="../setting/setting-admin.php">관리자 정보 관리</a>
				</li>
			</ul>
		</div>
	</div>
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
				<div>등록</div>
			</div>
			<div class="cc-con">
                <form name="frm" action="admin_write_action.php" target="_fra_admin" method="post"  enctype="multipart/form-data">
                <input type="hidden" name="idx" value="<?=$idx?>">
                <input type="hidden" name="mem_idx" value="<?=$row[mem_idx]?>">
                <input type="hidden" name="mem_level" value="<?=$row[mem_level]?>">
                <input type="hidden" name="flag" value="Y">
                <input type="hidden" name="id_ok" id="id_ok" value="N">
						<div class="set-tab">
							<table id="admin-view">
								<tr>
									<th>아이디</th>
                                    <td>
                                        <input type="text" id="member_id" name="mem_idx" required="yes" message="아이디"><button class="com-mo" type="button" onclick="ch_hu();">중복확인</button>
                                        <div id="check_id" style="paddig-top:10px;"></div>
                                    </td>
								</tr>
								<tr>
									<th>비밀번호</th>
									<td><input type="password" name="mem_pwd" required="yes" message="비밀번호"></td>
								</tr>
								<tr>
									<th>성명</th>
									<td><input type="text" name="mem_name" value="<?=$row[mem_name]?>" required="yes" message="성명"></td>
								</tr>
								<tr>
									<th>연락처</th>
									<td>
										<input class="only-num" type="text" name="tel1" value="<?=explode('-',$row[mem_tel])[0]?>" required="yes" message="연락처1">
										<span class="hypen">-</span>
										<input class="only-num" type="text" name="tel2" value="<?=explode('-',$row[mem_tel])[1]?>" required="yes" message="연락처2">
										<span class="hypen">-</span>
										<input type="text" class="only-num" name="tel3" value="<?=explode('-',$row[mem_tel])[2]?>" required="yes" message="연락처3">
									</td>
								</tr>
								<tr>
									<th>이메일</th>
									<td>
										<input type="text" name="email1" value="<?=explode('@',$row[email])[0]?>" required="yes" message="이메일1">
										<span class="gol">@</span>
										<input type="text" name="email2" value="<?=explode('@',$row[email])[1]?>" required="yes" message="이메일2">
									</td>
								</tr>
							</table>
							<div class="btn-float">
								<button type="button" onclick="location.href='./setting-admin.php'">목록으로</button>
								<button type="button" onclick="go_submit();"> 등록하기</button>
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
            if($('#id_ok').val() =='N'){
                alert('아이디 중복 확인을 해주세요.');
                return false;
            }
            var check = chkFrm('frm');
            if(check) {
                //oEditors.getById["editor"].exec("UPDATE_CONTENTS_FIELD", []);
                frm.submit();
            } else {
                false;
            }
        }

        function ch_hu(){  
            var chkid = $("#member_id").val();
            var vurl = "/pro_inc/check_admin_duple.php";
            $.ajax({
                url		: vurl,
                type	: "GET",
                data	: { idx:"", user_id:$("#member_id").val() },
                async	: false,
                dataType	: "json",
                success		: function(v){
                    if ( v.success == "true" ){
                        $("#id_ok").val("Y");
                        $("#check_id").html( v.msg );
                    } else if ( v.success == "false" ){
                        $("#id_ok").val("N");
                        $("#check_id").html( v.msg );
                    } else {
                        alert( "오류 발생!" );
                    }
                }
            });
        }
	</script>
	
</body>
</html>