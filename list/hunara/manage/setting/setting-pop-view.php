<? include("../inc/header.php"); ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<link rel="stylesheet" href="/manage/css/setting.css">



<body class="room-body">
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>

	<div class="contents pop-view">
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
				<div>비엔시스템</div>
			</div>
			<div class="cc-con">
				<form action="#">
						<div class="set-tab">
							<table id="admin-view">
								<tr>
									<th>사용여부</th>
									<td>
										<div class="pop-yes">
											<input type="radio" id="pop-o" id="pop-o" checked>
											<label for="pop-o">사용</label>
										</div>
										<div class="pop-no">
											<input type="radio" id="pop-no" id="pop-no">
											<label for="pop-no">중지</label>
										</div>
										<div class="pop-preview">
											<button type="button"  onclick="previewPopup();">미리보기</button>
										</div>
									</td>
								</tr>
								<tr>
									<th>
										기업명
									</th>
									<td>
										<input type="text" placeholder="비엔시스템">
									</td>
								</tr>
								<tr>
									<th>
										팝업제목
									</th>
									<td>
										<input type="text" placeholder="제목입니다.">
									</td>
								</tr>
								<tr>
									<th>
										팝업 시작일
									</th>
									<td>
										<input type="text" id="start" data-js-start-date>
									</td>
								</tr>
								<tr>
									<th>
										팝업 종료일
									</th>
									<td>
										<input type="text" id="end" disabled data-js-end-date>
									</td>
								</tr>
								<tr>
									<th>
										팝업위치(X)
									</th>
									<td>
										<input type="text" class="only-num" placeholder="400">
										<span>px</span>
									</td>
								</tr>
								<tr>
									<th>
										팝업위치(Y)
									</th>
									<td>
										<input type="text" class="only-num" placeholder="400">
										<span>px</span>
									</td>
								</tr>
								<tr>
									<th>
										팝업크기(가로)
									</th>
									<td>
										<input type="text" class="only-num" placeholder="400">
										<span>px</span>
									</td>
								</tr>
								<tr>
									<th>
										팝업크기(세로)
									</th>
									<td>
										<input type="text" class="only-num" placeholder="400">
										<span>px</span>
									</td>
								</tr>
								<tr>
									<th>
										내용
									</th>
									<td>
										<textarea name="pop-context" id="pop-c"></textarea>
									</td>
								</tr>
							</table>
							<div class="btn-float">
								<button type="button" onclick="location.href='./setting-admin.php'">목록으로</button>
								<button onclick="location.href='setting-pop-modi.php'" type="button">수정하기</button>
								<button type="button">삭제</button>
							</div>
						</div>
				</form>
			</div>
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