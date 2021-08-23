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
    <script src="/manage/js/common.js"></script>
    <script src="/manage/js/common_js.js"></script>
</head>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>

<!--팝업 오픈-->
 <script language="javascript">
  	function previewPopup() { 
			window.open("setting-pop-preivew.php", "a", "width=400, height=500, left=100, top=50"); 
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
					<a href="../setting/setting-pop.php">기업별 팝업 관리</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="contents pop-add">
		<div class="left-menu">
			<div class="lm-t">
				<p>기업별 팝업 관리</p>
			</div>
			<ul>
				<li class="lm-act">
					<p class="lm-big active">설정 관리</p>
					<div class="lm-list">
						<ul>
							<li><a href="./setting-admin.php">관리자 정보 관리</a></li>
							<li class="active"><a href="./setting-pop.php">기업별 팝업 관리</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
		<div class="center-con">
			<div class="cc-title">
				<div>기업별 팝업 관리</div>
				<div class="big-arrow"><img src="../img/common/big-arrow.png" alt=""></div>
				<div>등록</div>
			</div>
			<div class="cc-con">
                <form name="frm" action="popup_write_action.php" target="_fra_admin" method="post"  enctype="multipart/form-data">
			    <input type="hidden" name="total_param" value="<?=$total_param?>"/>
						<div class="set-tab">
							<table id="admin-view">
								<tr>
									<th>사용여부</th>
									<td>
										<div class="pop-yes">
											<input type="radio" name="is_use" value="Y" required="yes" message="팝업사용여부">
											<label for="pop-o">사용</label>
										</div>
										<div class="pop-no">
											<input type="radio" name="is_use" value="N" required="yes" message="팝업사용여부">
											<label for="pop-no">중지</label>
										</div>
										<!--<div class="pop-preview">
											<button type="button"  onclick="previewPopup();">미리보기</button>
										</div>-->
									</td>
								</tr>
								<tr>
									<th>
										기업명
									</th>
									<td>
                                        <select name="id" id="id">
                                            <option value="">기업명을 선택하세요.</option>
                                            <?= getSelectBox($gconnet, 'idx', 'comname', 'tb_company') ?>
                                        </select>
									</td>
								</tr>
								<tr>
									<th>
										팝업제목
									</th>
									<td>
										<input type="text" name="subject" required="yes"  message="팝업제목" value="">
									</td>
								</tr>
								<tr>
									<th>
										팝업 시작일
									</th>
									<td>
										<input type="text" id="start" data-js-start-date name="startdt" required="yes" message="팝업 시작일">
									</td>
								</tr>
								<tr>
									<th>
										팝업 종료일
									</th>
									<td>
										<input type="text" id="end" disabled data-js-end-date name="enddt" required="yes" message="팝업 종료일">
									</td>
								</tr>
								<tr>
									<th>
										팝업위치(X)
									</th>
									<td>
										<input type="text" class="only-num" name="x" required="yes" message="팝업 위치(X)" is_num="yes">
										<span>px</span>
									</td>
								</tr>
								<tr>
									<th>
										팝업위치(Y)
									</th>
									<td>
										<input type="text" class="only-num" name="y" required="yes" message="팝업 위치(Y)" is_num="yes">
										<span>px</span>
									</td>
								</tr>
								<tr>
									<th>
										팝업크기(가로)
									</th>
									<td>
										<input type="text" class="only-num" name="width" required="yes" message="팝업 크기(가로)" is_num="yes">
										<span>px</span>
									</td>
								</tr>
								<tr>
									<th>
										팝업크기(세로)
									</th>
									<td>
										<input type="text" class="only-num" name="height" required="yes" message="팝업 크기(세로)" is_num="yes">
										<span>px</span>
									</td>
								</tr>
								<tr>
									<th>
										팝업내용
									</th>
									<td>
										<textarea name="fm_write" id="editor" id="pop-c"></textarea>
									</td>
								</tr>
							</table>
							<div class="btn-float">
								<button type="button" onclick="location.href='./setting-pop.php'">목록으로</button>
								<button type="button" onclick="go_submit();">등록하기</button>
							</div>
						</div>
				</form>
			</div>
		</div>
	</div>

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

	function go_submit() {
		var check = chkFrm('frm');
		if(check) {
			oEditors.getById["editor"].exec("UPDATE_CONTENTS_FIELD", []);
			frm.submit();
		} else {
			false;
		}
	}
	
	function go_list(){
		location.href = "popup_list.php?<?=$total_param?>";
	}
</script>
<iframe name="_fra_admin" width="500" height="200" style="display:<?=$show_iframe==TRUE?"":"none"?>"></iframe>

	<div class="com-modal modal-wrap">
			<div class="modal-con">
				<div class="modal-top">
					<div class="title-modal">
						<span>기업 검색</span>
					</div>
					<div class="close-modal">
						<img src="../img/common/close.png" alt="">
					</div>
				</div>
				<form action="#">
					<div class="mo-con" style="">
						<div class="list-wrap">
							<div class="list-table">
								<table id="sortRc">
									<thead>
										<tr>
											<th>선택</th>
											<th class="th-btn"><span>번호</span></th>
											<th class="th-btn"><span>등록일</span></th>
											<th class="th-btn"><span>기업명</span></th>
											<th class="th-btn"><span>담당자</span></th>
											<th class="th-btn"><span>연락처</span></th>
											<th class="th-btn"><span>핸드폰</span></th>
											<th class="th-btn"><span>휴양소</span></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input type="radio" name="sel-com"></td>
											<td>1</td>
											<td>2021.02.03</td>
											<td>비엔시스템</td>
											<td>박상호</td>
											<td>123-456-7498</td>
											<td>123-4546-7948</td>
											<td>3</td>
										</tr>
										<tr>
											<td><input type="radio" name="sel-com"></td>
											<td>1</td>
											<td>2021.02.03</td>
											<td>비엔시스템</td>
											<td>박상호</td>
											<td>123-456-7498</td>
											<td>123-4546-7948</td>
											<td>3</td>
										</tr>
										<tr>
											<td><input type="radio" name="sel-com"></td>
											<td>1</td>
											<td>2021.02.03</td>
											<td>비엔시스템</td>
											<td>박상호</td>
											<td>123-456-7498</td>
											<td>123-4546-7948</td>
											<td>3</td>
										</tr>
										<tr>
											<td><input type="radio" name="sel-com"></td>
											<td>1</td>
											<td>2021.02.03</td>
											<td>비엔시스템</td>
											<td>박상호</td>
											<td>123-456-7498</td>
											<td>123-4546-7948</td>
											<td>3</td>
										</tr>
										<tr>
											<td><input type="radio" name="sel-com"></td>
											<td>1</td>
											<td>2021.02.03</td>
											<td>비엔시스템</td>
											<td>박상호</td>
											<td>123-456-7498</td>
											<td>123-4546-7948</td>
											<td>3</td>
										</tr>
										<tr>
											<td><input type="radio" name="sel-com"></td>
											<td>1</td>
											<td>2021.02.03</td>
											<td>비엔시스템</td>
											<td>박상호</td>
											<td>123-456-7498</td>
											<td>123-4546-7948</td>
											<td>3</td>
										</tr>
										<tr>
											<td><input type="radio" name="sel-com"></td>
											<td>1</td>
											<td>2021.02.03</td>
											<td>비엔시스템</td>
											<td>박상호</td>
											<td>123-456-7498</td>
											<td>123-4546-7948</td>
											<td>3</td>
										</tr>
									</tbody>
								</table>
								<div class="paging">
									<a class="first"></a>
									<a class="prev"></a>
									<a class="active">1</a>
									<a>2</a>
									<a>3</a>
									<a>4</a>
									<a>5</a>
									<a class="next"></a>
									<a class="last"></a>
								</div>	
								<div class="btn-apply">
									<button type="button">등록</button>
									<button type="button">취소</button>
								</div>						
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	
	
	<!--  셀렉트 박스  -->
	
	<script type="text/javascript">
		$(document).ready(function () {
				
				$('select').wSelect();
			});
	</script>
	
</body>
</html>