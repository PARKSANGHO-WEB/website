<? include("../inc/header.php"); ?>

<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>

<body> 
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
	<div class="contents new-com">
    <? 
        $MENU_DEPTH1 = "1";
        $MENU_DEPTH2 = "1";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/company/left.php"; 
    ?>    
		<div class="center-con">
			<div class="cc-title">
				<div>신규등록</div>
			</div>
			<div class="cc-con">
              <form name="frm" action="company_write_action.php" method="post"  enctype="multipart/form-data">
					<table>
						<tr class="domain">
							<th>
								도메인
							</th>
							<td>
								<span>http://</span><input type="text" name="domain" required="yes" message="도메인"><span>.hunara.com</span>
							</td>
						</tr>
                        <?
                                for($file_i=0; $file_i<$_include_board_file_cnt; $file_i++){
                                    $file_k = $file_i+1;
                        ?>
						<tr class="com-logo">
							<th>
								기업로고 <?=$file_k?>
							</th>
							<td>
								<div class="file-input">
									<input type="file" required="no" message="기타 첨부자료" name="file_<?=$file_i?>">
									<span class="button">파일선택</span>
									<span class="label" data-js-label=""><?=$row[comimg]?></span>
								</div>
							</td>
						</tr>
                        <?}?>
						<tr class="company">
							<th>
								기업명
							</th>
							<td>
								<input type="text" name="company" required="yes" message="기업명">
							</td>
						</tr>
						<tr  class="pass">
							<th>
								패스워드
							</th>
							<td>
								<input type="password" name="password" required="yes" message="비밀번호">
							</td>
						</tr>
						<tr class="peo-name">
							<th>
								담당자명
							</th>
							<td>
								<input type="text" name="name" required="yes" message="담당자명">
							</td>
						</tr>
						<tr class="number">
							<th>
								연락처
							</th>
							<td>
								<input maxlength="4" type="text" class="only-num" name="tel1" required="yes" message="연락처1">
								<span class="hypen">-</span>
								<input maxlength="4" type="text" class="only-num" name="tel2" required="yes" message="연락처2">
								<span class="hypen">-</span>
								<input maxlength="4" type="text" class="only-num" name="tel3" required="yes" message="연락처3">
							</td>
						</tr>
						<tr class="phone">
							<th>
								핸드폰
							</th>
							<td>
								<input maxlength="4" type="text" class="only-num" name="phone1" required="yes" message="핸드폰1">
								<span class="hypen">-</span>
								<input maxlength="4" type="text" class="only-num" name="phone2" required="yes" message="핸드폰2">
								<span class="hypen">-</span>
								<input maxlength="4" type="text" class="only-num" name="phone3" required="yes" message="핸드폰3">
							</td>
						</tr>
						<tr class="mail">
							<th>
								이메일
							</th>
							<td>
								<input type="text" name="email1" required="yes" message="이메일1">
								<span class="gol">@</span>
								<input type="text" name="email2" required="yes" message="이메일2">
							</td>
						</tr>
						<tr class="limit">
							<th>
								개인별 당첨 가능 횟수
							</th>
							<td>
								<input type="text" class="only-num" placeholder="숫자만 입력" name="winning" required="yes" message="당첨 가능 횟수">
							</td>
						</tr>
						<tr  class="reserve-check">
							<th>
								예약 시 주민번호 체크
							</th>
							<td>
								<label for="yes-num">
									<input type="radio" id="yes-num" name="membernum" value="1" checked required="yes" message="주민번호">
									<span>예</span>
								</label>
								<label for="no-num">
									<input type="radio" id="no-num" name="membernum" value="0" required="yes" message="주민번호">
									<span>아니오</span>
								</label>
							</td>
						</tr>
					</table>
						<div class="center-btn">
							<button type="button" onclick="go_submit();">등록</button>
							<button type="button" onClick="document.location.reload();">취소</button>
						</div>
				</form>
                <iframe name="_fra_admin" width="500" height="200" style="display:<?=$show_iframe==TRUE?"":"none"?>"></iframe>
			</div>
		</div>
	</div>
</body>
</html>
<script>
function go_submit() {
    var check = chkFrm('frm');
    if(check) {
        //oEditors.getById["editor"].exec("UPDATE_CONTENTS_FIELD", []);
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