<!DOCTYPE html>
<html lang="en">
<head>
</head>
<script src="../js/common.js"></script>
<body>
	<div class="gnb">
		<div class="gnb-wrap">
			<a class="login-btn" href="javascript:;">로그인</a>
			<a href="./join.php">회원가입</a>
			<a href="./mypage.php">마이페이지</a>
		</div>
	</div>
	<div class="pc-menu">
		<div class="logo" onclick="location.href='../index.php'">
			<img src="../img/common/logo.png" alt="">
		</div>
		<div class="pc-menuc">
			<ul>
				<li><a href="./intro.php">EPL 소개</a></li>
				<li><a href="./membership.php">EPL 멤버십</a></li>
				<li><a href="./way.php">EPL Courses</a></li>
				<li><a href="./notice.php">커뮤니티</a></li>
			</ul>
		</div>
	</div>
	
	
	<!--  로그인 모달	-->
	<div class="login-modal modal-wrap">
		<form action="#">
			<div class="modal-con">
				<div class="modal-top">
					<div class="close-modal">
						<img src="../img/common/close-modal.png" alt="">
					</div>
				</div>
				<p class="modal-title">로그인</p>
				<div class="id-wrap">
					<div class="id-t">
						<img src="../img/common/pw.svg" alt="">
						<span>아이디</span>
					</div>
					<div class="id-c">
						<input type="text">
					</div>
				</div>
				<div class="pw-wrap">
					<div class="pw-t">
						<img src="../img/common/id.svg" alt="">
						<span>비밀번호</span>
					</div>
					<div class="pw-c">
						<input type="password">
					</div>
				</div>
				<button type="button" class="login-go">로그인</button>
				<div class="link">
					<a class="find-btn" href="javascript:;">아이디 찾기</a>
					<a class="change-btn" href="javascript:;">비밀번호 찾기</a>
				</div>
			</div>
		</form>
	</div>
	
	
	<div class="login-modal login2-modal modal-wrap">
		<form action="#">
			<div class="modal-con">
				<div class="modal-top">
					<div class="close-modal" onclick="location.href='../index.php'">
						<img src="../img/common/close-modal.png" alt="">
					</div>
				</div>
				<p class="modal-title">로그인</p>
				<div class="id-wrap">
					<div class="id-t">
						<img src="../img/common/pw.svg" alt="">
						<span>아이디</span>
					</div>
					<div class="id-c">
						<input type="text">
					</div>
				</div>
				<div class="pw-wrap">
					<div class="pw-t">
						<img src="../img/common/id.svg" alt="">
						<span>비밀번호</span>
					</div>
					<div class="pw-c">
						<input type="password">
					</div>
				</div>
				<button type="button" class="login-go">로그인</button>
				<div class="link">
					<a class="find-btn" href="javascript:;">아이디 찾기</a>
					<a class="change-btn" href="javascript:;">비밀번호 찾기</a>
				</div>
			</div>
		</form>
	</div>
	
	<!--  아이디 찾기 모달	-->
	<div class="find-modal modal-wrap">
		<form action="#">
			<div class="modal-con">
				<div class="modal-top">
					<div class="close-modal">
						<img src="../img/common/close-modal.png" alt="">
					</div>
				</div>
				<p class="modal-title">아이디 찾기</p>
				<div class="id-wrap">
					<div class="id-t">
						<img src="../img/common/pw.svg" alt="">
						<span>아이디</span>
					</div>
					<div class="id-c">
						<input type="text">
					</div>
				</div>
				<div class="pw-wrap">
					<div class="pw-t">
						<img src="../img/common/email.svg" alt="">
						<span>이메일</span>
					</div>
					<div class="pw-c">
						<input type= "text ">
					</div>
				</div>
				<button class="okay-find" type="button">확인하기</button>
			</div>
		</form>
	</div>
	
	
	<!-- 모달-1	-->
<!--
	<div class="error-modal error1-modal">
		<form action="#">
			<div class="modal-con">
				<div class="modal-top">
					<div class="close2-modal">
						<img src="./img/common/close-modal.png" alt="">
					</div>
				</div>
				<p>가입된 이력과 일치하지 않습니다.<br /> 정보를 다시 확인해주세요.</p>
			</div>
		</form>
	</div>
-->
	
	<!--  에러 모달-2	-->
<!--
	<div class="error-modal error2-modal">
		<form action="#">
			<div class="modal-con">
				<div class="modal-top">
					<div class="close2-modal">
						<img src="./img/common/close-modal.png" alt="">
					</div>
				</div>
				<p>이메일 형식이 잘못되었습니다.</p>
			</div>
		</form>
	</div>
-->
	
	<!--  에러 모달-3	-->
<!--
	<div class="error-modal error3-modal">
		<form action="#">
			<div class="modal-con">
				<div class="modal-top">
					<div class="close2-modal">
						<img src="./img/common/close-modal.png" alt="">
					</div>
				</div>
				<p>아이디를 최소4자 이상으로 입력해주세요.</p>
			</div>
		</form>
	</div>
-->



	<!--  에러 모달-4	-->

	<div class="error-modal error4-modal">
		<form action="#">
			<div class="modal-con">
				<div class="modal-top">
					<div class="close2-modal">
						<img src="../img/common/close-modal.png" alt="">
					</div>
				</div>
				<p>이메일로 임시 비밀번호가 발송되었습니다.</p>
			</div>
		</form>
	</div>
	
	<!--  에러 모달-5	-->
	<div class="error-modal error5-modal">
		<form action="#">
			<div class="modal-con">
				<div class="modal-top">
					<div class="close2-modal">
						<img src="../img/common/close-modal.png" alt="">
					</div>
				</div>
				<p>등록된 이메일이 맞지않습니다.</p>
			</div>
		</form>
	</div>


	<!--  아이디 찾기 모달 완료	-->
	<div class="finish-modal modal-wrap">
		<form action="#">
			<div class="modal-con">
				<div class="modal-top">
					<div class="close-modal">
						<img src="../img/common/close-modal.png" alt="">
					</div>
				</div>
				<p class="modal-title">아이디 찾기<span>입력하신 정보와 일치하는 아이디입니다.</span></p>
				<div class="id-wrap">
					<p class="id-title">test_id<span>2021-04-08 가입</span></p>
				</div>
				<div class="btn-wrap">
					<button class="re-login" type="button">로그인하기</button>
					<button class="find-pw" type="button">비밀번호 찾기</button>
				</div>
			</div>
		</form>
	</div>
	
	
	
	<!--  비밀번호 찾기 모달	-->
	<div class="findpw-modal modal-wrap">
		<form action="#">
			<div class="modal-con">
				<div class="modal-top">
					<div class="close-modal">
						<img src="../img/common/close-modal.png" alt="">
					</div>
				</div>
				<p class="modal-title">비밀번호 찾기</p>
				<div class="id-wrap">
					<div class="mt-t">
						<img src="../img/common/pw.svg" alt="">
						<span>아이디</span>
					</div>
					<div class="mt-c">
						<input type="text">
					</div>
				</div>
				<div class="name-wrap">
					<div class="nt-t">
						<img src="../img/common/name.svg" alt="">
						<span>이름</span>
					</div>
					<div class="nt-c">
						<input type="text">
					</div>
				</div>
				<div class="pw-wrap">
					<div class="pw-t">
						<img src="../img/common/email.svg" alt="">
						<span>이메일</span>
					</div>
					<div class="pw-c">
						<input type= "text ">
					</div>
				</div>
				<button class="change-info" type="button">확인하기</button>
			</div>
		</form>
	</div>

	<!--  로그인 모달	-->
<!--
	<div class="changepw-modal modal-wrap">
		<form action="#">
			<div class="modal-con">
				<div class="modal-top">
					<div class="close-modal">
						<img src="../img/common/close-modal.png" alt="">
					</div>
				</div>
				<p class="modal-title">비밀번호 변경</p>
				<div class="pw-wrap">
					<div class="pw-t">
						<img src="../img/common/id.svg" alt="">
						<span>비밀번호</span>
					</div>
					<div class="pw-c">
						<input type="password">
					</div>
				</div>
				<div class="pw-wrap">
					<div class="pw-t">
						<img src="../img/common/id.svg" alt="">
						<span>비밀번호 확인</span>
					</div>
					<div class="pw-c">
						<input type="password">
					</div>
				</div>
				<button type="button">변경하기</button>
			</div>
		</form>
	</div>
-->
</body>
</html>