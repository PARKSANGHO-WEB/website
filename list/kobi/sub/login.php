<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/sub.css">
    <link rel="stylesheet" href="../css/header.css">
	 <link rel="stylesheet" href="../css/tagify.css">
    <meta charset="UTF-8">
    <title>코비인사이트(주)</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="../js/menu.js"></script>
	<script src="../js/jQuery.tagify.min.js"></script>
	<script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
</head>
<body>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
    <header class="sub">
        <div class="header-t">
            <div class="h_wrap">
                <div class="gnb">
                    <div class="gnb_wrap">
                        <ul>
                           <?
							if($_SESSION['member_coinc_id'] !=""){
						?>
							<li>
                                <a href="./mypage.php">마이페이지</a>
                            </li>
							<li>
                                <a href="./logout.php">로그아웃</a>
                            </li>
						<?
							}else{
						?>
							<li>
                                <a href="./join_sns.php">회원가입</a>
                            </li>
                            <li>
                                <a href="./login.php">로그인</a>
                            </li>

						<?
						}
						?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="nav">
                <div class="logo" onclick='location.href="../main.php"'>
                    <img src="../img/logo_w.png" alt="">
                </div>
                <div class="menu_b">
                    
                    <ul>
                        <li class="off-item">
                            <a class="big_m"  href="./about.php">About Us</a>
                            <div class="menu_in">
                                <ul>
                                    <li>
                                        <a href="./about.php#about_1">회사소개</a>
                                    </li>
                                    <li>
                                        <a href="./about.php#about_2">미션&비전</a>
                                    </li>
                                    <li>
                                        <a href="./about.php#about_3">CI스토리</a>
                                    </li>
                                    <li>
                                        <a href="./about.php#about_4">조직도</a>
                                    </li>
                                    <li>
                                        <a href="./about.php#about_5">오시는 길</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="off-item">
                            <a class="big_m" href="./business.php">Business Area</a>
                            <div class="menu_in">
                                <ul>
                                    <li>
                                        <a href="./business.php#busi_1">비즈니스 특징</a>
                                    </li>
                                    <li>
                                        <a href="./business.php#busi_2">차별화</a>
                                    </li>
                                    <li>
                                        <a href="./business.php#busi_3">비즈니스 영역</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="off-item">
                            <a class="big_m" href="./factory_1.php">Business Factory</a>
                            <div class="menu_in">
                                <ul>
                                    <li>
                                        <a href="./factory_1.php">진행현황</a>
                                    </li>
                                    <li>
                                        <a href="./factory_2.php">컨설팅 사례</a>
                                    </li>
                                    <li>
                                        <a href="./factory_3.php">상담실(Q&A)</a>
                                    </li>
                                    <li>
                                        <a href="./factory_4.php">FACTORY(자료실)</a>
                                    </li>
                                    <li>
                                        <a href="./factory_5.php">공작소(자료제작)</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="off-item">
                            <a class="big_m" href="./info_1.php">Information</a>
                            <div class="menu_in">
                                <ul>
                                    <li>
                                        <a href="./info_1.php">이용안내</a>
                                    </li>
                                    <li>
                                        <a href="./info_2.php">공지사항</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header-b"></div>
    </header>
        <section>
<? 
$reurl_go = trim($_REQUEST['reurl_go']);


?>

<script>

function init_Onload(){
		document.frm_login.user_id.focus();
	}
	function go_submit() {
			
			if(document.frm_login.user_id.value==''){
				alert('이메일을 입력하세요');
				document.frm_login.user_id.focus();
				return false;
			}
			
			if(document.frm_login.user_pwd.value==''){
				alert('패스워드를 입력하세요');
				document.frm_login.user_pwd.focus();
				return false;
			}

			document.frm_login.submit();
			return;
	}


	function go_submit2() {
			
			if(document.find_frm.user_id.value==''){
				alert('이메일을 입력하세요');
				document.find_frm.user_id.focus();
				return false;
			}

			document.find_frm.submit();
			return;
	}

</script>
            <div class="login">
                <p>로그인</p>
                <span>코비인사이트를 방문해 주셔서 감사합니다.<br />로그인 후 이용해주세요.</span>
            </div>
            <div class="login_f">
                <form action="login_check.php" method="post" name="frm_login" id="frm_login">
				<input type="hidden" name="reurl_go" value="<?=$reurl_go?>">
<!--
                    <div class="form-wrap">
                        <div class="form_left">
                            <input type="text" placeholder="이메일을 입력하세요" name="user_id">
                            <input type="password" placeholder="패스워드를 입력하세요" name="user_pwd">
                        </div>
                        <div class="form_btn">
                            <button type="button" onclick="go_submit();">로그인</button>
                        </div>
                    </div>
-->
					<div class="sns-wrap">
                        <ul>
                            <li id="naver_id_login">
								<span><img src="../img/sns/naver.png" alt=""></span>
                                <span><a class="login_st" href="javascript:;">네이버 로그인</a></span>
							</li>
                            <li>
                                <span><img src="../img/sns/kakao.png" alt=""></span>
                                <span><a class="login_st" href="javascript:loginWithKakao();">카카오톡 로그인</a></span>
                            </li>
							 <li>
                                <span><img src="../img/sns/google.png" alt=""></span>
                                <span><a class="login_st" href="javascript:;" id="google_join_btn">구글 로그인</a></span>
                            </li>
							
                        </ul>
                    </div>
                </form>
            </div>
            <div class="remember">
                <div class="remem_l">
                    <p>코비인사이트 회원이 아니신가요?</p>
                    <span>회원가입을 하시면 서비스를 이용하실 수 있습니다.</span>
                    <button type="button" onclick='location.href="./join_sns.php"'>회원가입</button>
                </div>
<!--
                <div class="remem_r">
                    <p>회원정보를 잊으셨나요?</p>
                    <span>가입시 등록한 정보를 찾으실 수 있습니다.</span>
                    <button type="button">비밀번호 찾기</button>
                </div>
-->
            </div>
        </section>

	
         <div class="pop-pass" style="display: none;">
            <div class="top">
                <span class="pclose">
                    <img src="../img/sub/noimagew.png" alt="">
                </span>
                <img class="logo" src="../img/logo_w.png" alt="">
            </div>
            <div class="pcon">
            
                <span class="pcon-m">가입시 입력한 이메일 주소를 입력해주세요.<br />임시비밀번호가 전송됩니다.</span>
                <form action="missing_pass.php" method="post" name="find_frm" id="find_frm">
                    <div class="line_7">
                        <input type="text" placeholder="이메일 주소를 입력하세요." name="user_id">
                    </div>
                    <button type="button" onClick="go_submit2();">전송하기</button>
                </form>
            </div>
        </div>
        <footer>
        <div class="foot-wrap">
            <ul>
                <li>
                    <span>
                        코비인사이트 주식회사
                    </span>
                </li>
                <li>
                    <span>
                        서울특별시 강남구 테헤란로 82길 14, 4층 ( 대치동 청풍빌딩 )
                    </span>
                </li>
                <li>
                    <span>
                        사업자 등록번호 : 301-88-00046
                    </span>
                    <span>
                        대표전화 : 02-2088-8102
                    </span>
                    <span>
                        팩스번호 : 02-2088-8105
                    </span>
                    <span>
                        이메일 : contact@kobiinsight.co.kr
                    </span>
                    <span class="using">
                        [이용약관]
                    </span>
                    <span class="using-per">
                        [개인정보처리방침]
                    </span>
                </li>
                <li>
                    <span>
                        Copyright ⓒ 2020 KOBI INSIGHT All Right Reserved.
                    </span>
                </li>
            </ul>
        </div>
    </footer>
<!-- SNS 로그인 시 리턴 데이터 수신 및 전달을 위한 폼 시작 -->
<form name="pub_login_form" id="pub_login_form" method="post" >
	<input type="hidden" name="sns_kind">
	<input type="hidden" name="user_id">
	<input type="hidden" name="user_name">
	<input type="hidden" name="user_email">
</form>
<!-- SNS 로그인 시 리턴 데이터 수신 및 전달을 위한 폼 종료 -->

<!-- 구글 -->
<script type="text/javascript" src="https://apis.google.com/js/api:client.js"></script>
<script type="text/javascript">
var GoogleApp = {
	auth2: {},
	// 초기화
	init: function() {
			gapi.load('auth2', function() {
					GoogleApp.auth2 = gapi.auth2.init({
							client_id: '160067170486-c1dpr5o2fb94li486urr24bhuftcomp6.apps.googleusercontent.com', // api 승인 완료 후 받는 클라이언트 키 
							cookiepolicy: 'single_host_origin',
					});

					// 특정 노드에 구글 로그인 버튼 연동
					GoogleApp.attachSignin(document.getElementById('google_join_btn'));
			});
	},
	// 특정 노드에 구글 로그인 연동
	attachSignin: function(element) {
			// 버튼 노드, ?, 로그인 성공시 콜백함수, 로그인 실패시 콜백함수
			GoogleApp.auth2.attachClickHandler(element, {}, GoogleApp.signinCallback, GoogleApp.signinFailure);
	},
	// 로그인 성공시 콜백함수
	signinCallback: function(googleUser) {
			var id = googleUser.getBasicProfile().getId();
			var memberName = googleUser.getBasicProfile().getName();
			var email = googleUser.getBasicProfile().getEmail();
			var token;

			/*alert("구글 로그인 성공");
			alert(id);
			alert(memberName);
			alert(email);*/

			document.pub_login_form.sns_kind.value = "gp"; // 구글 플러스
			document.pub_login_form.user_id.value = email;
			document.pub_login_form.user_name.value = memberName;
			document.pub_login_form.user_email.value = email;
			document.pub_login_form.action="login_check_sns_google.php"; // 이동할 페이지 URL
			document.pub_login_form.target="_self";
			document.pub_login_form.submit();

			// 엑세스 토큰을 어떻게 가져오는지 몰라 무식하게 찾는 방법.
			for (var property in googleUser) {
					if (typeof googleUser[property] === 'object') {
							if (googleUser[property].access_token) {
									token = googleUser[property].access_token;
									break;
							}
					}
			}

			// 실행할 코드
	},
	// 로그인 실패시 콜백함수
	signinFailure: function(error) {
			console.log(JSON.stringify(error, undefined, 2));
		}
};
// 초기화 실행
GoogleApp.init();
</script>

<!-- 카카오 -->
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script type='text/javascript'>
	Kakao.init('82111a633df138b6a129e12c0b9d49c2'); // api 승인 완료 후 받는 클라이언트 키 

	function loginWithKakao() {
		// 로그인 창을 띄웁니다.
		Kakao.Auth.login({
		success: function(authObj) {
			//alert("new12");
			//alert(JSON.stringify(authObj));
			// 로그인 성공시, API를 호출합니다.
			Kakao.API.request({
			url: '/v2/user/me',
			success: function(res) {
				//document.write(JSON.stringify(res));
				var id = JSON.stringify(res.id);
				var email = JSON.stringify(res.kakao_account.email);
				//var name = JSON.stringify(res.properties.nickname);
				//var memberName = name.replaceAll('"','');
				//var mem_email = email.replaceAll('"','');
				//var memberName = name.replaceAll('"', '');
				if (email != "") {
					var mem_email = email.replaceAll('"', '');
				} else {
					var mem_email = "";
				}
				/*alert(id);
				alert(memberName);*/
				document.pub_login_form.sns_kind.value = "kt"; // 카카오톡
				document.pub_login_form.user_id.value = mem_email;
				//document.pub_login_form.user_name.value = memberName;
				document.pub_login_form.user_email.value = mem_email;
				document.pub_login_form.action="login_check_sns_kakao.php"; // 이동할 페이지 URL
				document.pub_login_form.target="_self";
				document.pub_login_form.submit();
			},
			fail: function(error) {
				alert(JSON.stringify(error));
			}
			});
		},
		fail: function(err) {
			alert(JSON.stringify(err));
		}
		});
	};

	String.prototype.replaceAll = function(org, dest) {
		return this.split(org).join(dest);
	}
	</script>

<!-- 네이버아디디로로그인 초기화 Script -->
<script type="text/javascript" src="../js/naverLogin.js" charset="utf-8"></script>
<script type="text/javascript">
function naver_login_go(go_url){
	location.href=go_url;
}

//function naver_login(){
	var naver_id_login = new naver_id_login("A8TcKUOAfBUghrkJTihY", "http://kobiinsight.co.kr/sub/login.php"); // api 승인 완료 후 받는 클라이언트 키 와 승인 신청시에 기재한 return url 
	var state = naver_id_login.getUniqState();
	naver_id_login.setButton("green", 1,45);
	naver_id_login.setDomain(".service.com");
	naver_id_login.setState(state);
	//naver_id_login.setPopup();
	naver_id_login.init_naver_id_login();
//}
</script>
<!-- //네이버아디디로로그인 초기화 Script -->

<!-- 네이버아디디로로그인 Callback페이지 처리 Script -->
<script type="text/javascript">
	// 네이버 사용자 프로필 조회 이후 프로필 정보를 처리할 callback function
	function naverSignInCallback() {
		// naver_id_login.getProfileData('프로필항목명');
		// 프로필 항목은 개발가이드를 참고하시기 바랍니다.
		var id = naver_id_login.getProfileData('id');
		var name = naver_id_login.getProfileData('name');
		var email = naver_id_login.getProfileData('email');
		/*alert(id);
		alert(name);
		alert(email);*/
		document.pub_login_form.sns_kind.value = "nv"; // 네이버
		document.pub_login_form.user_id.value = email;
		document.pub_login_form.user_name.value = name;
		document.pub_login_form.user_email.value = email;
		document.pub_login_form.action="login_check_sns_naver.php"; // 이동할 페이지 URL
		document.pub_login_form.target="_self";
		document.pub_login_form.submit();
	}

	// 네이버 사용자 프로필 조회
	naver_id_login.get_naver_userprofile("naverSignInCallback()");
</script>	<div class="using-u">
        <div class="modal-h">
            <span>이용약관</span>
            <span class="close-mh">닫기</span>
        </div>
        <div class="text-pu">
	    <p><span class="u-title">코비인사이트(주) 홈페이지 이용약관<br/>(www.kobiinsight.co.kr)</span><br /><br />



<span class="sub-tit">제 1 장. 총 칙</span>
<br /><br /><br />
<span class="u-tsub">제 1 조 (목적)</span><br />
이 약관은 코비인사이트 주식회사(이하 “회사”라 합니다)가 제공하는 서비스(이하”서비스”라 합니다)를 이용함에 있어 회사와 회원의 권리, 의무 및 책임사항을 규정함을 목적으로 합니다.<br /><br />

<span class="u-tsub">제 2 조 (약관의 효력 및 변경)</span><br />
① 이 약관은 코비인사이트 홈페이지(www.kobiinsight.co.kr)에 가입하는 회원의 동의함으로 써 그 효력이 발생됩니다.<br />
② 회사는 사정상 중요한 사유가 발생될 경우 사전 고지 없이 이 약관의 내용을 변경할 수 있으며, 변경된 약관은 서비스를 통하여 공지합니다.<br />
③ 회원은 변경된 약관에 동의하지 않을 경우 회원 탈퇴를 요청할 수 있으며, 변경된 약관의 효력발생일 이후 10일 이내에 해지 요청을 하지 않을 경우 약관의 변경 사항에 동의한 것으로 간주됩니다.<br />
<br /><br />
<span class="u-tsub">제 3 조 (용어의 정의)</span><br />
이 약관에서 사용하는 주요한 용어의 정의는 다음과 같습니다.<br />
① 회원: 회사와 서비스 이용 계약을 체결하고 회원 아이디(ID)를 부여 받은 자를 말합니다.<br />
② 아이디: 회원의 식별과 회원의 서비스 이용을 위하여 회원이 선정하고 회사가 승인하는 문자나 숫자 혹은 그 조합을 말합니다. 코비인사이트 홈페이지에서는 회원의 SNS에 연동된 ID(또는 이메일주소)을 말합니다.<br />
③ 이용중지: 회사가 약관에 의거하여 회원의 서비스 이용을 제한하는 것을 말합니다.<br />
④ 해지: 회사 또는 회원이 서비스 사용 후 이용 계약을 해약하는 것을 말합니다.<br />
<br />
<span class="u-tsub">제 4 조 (약관의 준칙)</span><br />
① 고객이 "개인정보의 제공 및 활용 동의서"에 동의한 경우에 한해 "개인정보의 제공 및 활용 동의서"에 명시된 사항이 본 약관과 다를 경우 "개인정보의 제공 및 활용 동의서"를 우선 적용합니다. 단, "개인정보의 제공 및 활용 동의서"에 명시되지 않은 사항이 있을 경우에 한해 본 약관의 조항을 적용합니다.<br />
② 본 약관 및 "개인정보의 제공 및 활용 동의서"에 명시되지 않은 사항은 관계 법령의 규정에 따릅니다.<br />
<br />

<span class="sub-tit">제 2 장. 서비스 이용 계약</span><br /><br /><br />

<span class="u-tsub">제 5 조 (이용 계약의 성립)</span><br />
① 서비스 가입 신청시 본 약관을 읽고 “동의함” 버튼을 클릭하면 이 약관에 동의하는 것으로 간주됩니다.<br />
② 이용계약은 서비스 이용희망자의 이용약관 및 개인정보 동의 후 이용 신청하면, 그 즉시 이용계약이 성립되고 서비스가 제공 되도록 합니다.<br />
<br />
<span class="u-tsub">제 6 조 (개인정보의 보호)</span><br />
① 회사는 회원의 개인정보를 보호하고 존중합니다.<br />
② 회사는 이용 신청 시 회원이 제공하는 정보, 커뮤니티 활동, 각종 이벤트 참가를 위하여 회원이 제공하는 정보, 기타 서비스 이용 과정에서 수집되는 정보 등을 통하여 회원에 관한 정보를 수집하며, 회원의 개인정보는 본 이용계약의 이행과 본 이용계약상의 서비스 제공을 위한 목적으로 사용됩니다.<br />
③ 회사는 서비스 제공과 관련하여 취득한 회원의 신상정보를 본인의 승낙 없이 제3자에게 누설 또는 배포할 수 없으며 상업적 목적으로 사용할 수 없습니다.<br />
④ 제3항의 범위 내에서 회사는 업무와 관련하여 회원 전체 또는 일부의 개인정보에 관한 집합적인통계 자료를 작성하여 이를 사용할 수 있고, 서비스를 통하여 회원의 컴퓨터에 쿠키를 전송할 수 있습니다. 이 경우 회원은 쿠키의 수신을 거부하거나 쿠키의 수신에 대하여 경고하도록 사용하는 컴퓨터의 브라우저의 설정을 변경할 수 있습니다.<br />
⑤ 다음 각 항에 해당되는 경우, 회사가 임의적으로 회원의 개인정보를 변경할 수 있습니다.<br />
   1. 회사가 직접 개인 정보를 변경해줄 것을 회원이 요청하는 경우<br />
   2. 허위정보가 발견되거나 입력된 정보의 오류가 발견되어 이를 정정하는 경우<br />
   3. 회원의 아이디, 전화번호나 주민등록번호, 본인인증정보 등 개인정보의 내용을 포함하고 있어서 타인으로부터 회원의 사생활이 침해 받을 우려가 있는 경우<br />
   4. 타인에게 혐오감을 주거나 욕설 혹은 범죄에 대한 내용이 포함된 경우 또는 비방/분쟁성 내용이나 미풍양속에 반하는 아이디의 경우<br /><br /><br />


<span class="u-tsub">제 7 조 (개인정보의 이용)</span><br />
① 회사가 수집하는 개인정보는 서비스의 제공에 필요한 최소한으로 하되, 필요한 경우 보다 더 자세한 정보를 요구할 수 있습니다.<br />
② 회사는 회사 사이트 내에서 벌어지는 각종 이벤트 행사에 참여한 회원의 개인 정보를 회원의 동의 하에 해당 이벤트의 주최자 및 제3자에게 제공할 수 있습니다. 이러한 경우에도 개인정보의 제 3자 제공은 이용자의 동의 하에서만 이루어지며 개인정보가 제공되는 것을 원하지 않는 경우에는, 특정 서비스를 이용하지 않거나 특정한 형태의 판촉이나 이벤트에 참여하지 않으면 됩니다.<br />
③ 회사가 외부 업체(이하 위탁 받는 업체)에 특정서비스의 제공을 위탁하는 경우 서비스 제공에 필요한 회원의 개인정보를 회원의 동의를 받아 위탁 받는 업체에 제공할 수 있으며 서비스 위탁 사실을 명시 합니다. 위탁 받는 업체는 제공받은 회원의 개인정보의 수집, 취급, 관리에 있어 위탁 받은 목적 외의 용도로 이를 이용하거나 제 3자에게 제공하지 않습니다.<br />
④ 회사는 회사가 제공하는 서비스를 이용하는 이용자를 대상으로 해당 서비스의 양적, 질적 향상을 위하여 이용자의 개인 식별이 가능한 개인정보를 이용자의 동의를 받아 이를 수집하여 맞춤서비스, 온라인광고서비스, 커뮤니티서비스, 유료컨텐츠서비스, 모바일서비스 등에 이용할 수 있습니다.<br />
⑤ 회사는 회원에게 제공되는 서비스의 질을 향상시키기 위해 맞춤서비스, 온라인광고서비스, 쇼핑몰서비스, 커뮤니티서비스, 유료컨텐츠서비스, 모바일서비스, 보험, 신용카드 등의 텔레마케팅서비스, 통계작성 또는 시장조사 등 다양한 서비스를 제공할 목적으로 여러 분야의 전문 컨텐츠 사업자 혹은 비즈니스 사업자와 함께 파트너쉽을 맺을 수 있습니다.<br />
⑥ 회사는 5항의 파트너쉽을 맺은 제휴사와 회원의 개인정보를 제공, 공유할 경우 반드시 이용자의 동의를 받아 필요한 최소한의 정보를 제휴사에게 제공, 공유하며 이때 누구에게 어떤 목적으로 어떠한 정보(제휴사명, 제휴의 목적, 공유하는 개인정보)를 공유하는지 명시합니다.<br />
⑦ 동조 3항~6항의 개인정보 이용 시 이용자의 동의는 본 약관에 동의한 것으로써 갈음할 수 있습니다.<br />
⑧ 회원은 원하는 경우 언제든 회사에 제공한 개인정보의 수집과 이용에 대한 동의를 철회할 수 있으며, 동의의 철회는 해지 신청을 하는 것으로 이루어집니다.<br />
<br />
<span class="u-tsub">제 8 조 (계약 사항의 변경)</span><br />
① 회원은 개인정보관리를 통해 언제든지 본인의 개인정보를 열람하고 수정할 수 있습니다.<br />
② 회원은 이용 신청시 기재한 사항이 변경되었을 경우 온라인으로 수정을 해야 하며 회원정보를 변경하지 아니하여 발생되는 문제의 책임은 회원에게 있습니다.<br />
③ 회원이 원하는 경우 이용동의를 철회할 수 있으며, 이용동의를 철회한 경우 회사 서비스 이용에 제약이 따를 수 있습니다. 이용동의의 철회는 해지 신청을 하는 것으로 이루어집니다.<br />
④ 회사는 만 1년 이상 로그인하지 않은 회원을 휴면회원으로 분류할 수 있습니다. <br /><br />


<span class="sub-tit">제 3 장. 계약 당사자의 의무</span><br /><br />

<span class="u-tsub">제 9 조 (회사의 의무)</span><br />
① 회사는 특별한 사정이 없는 한 회원이 서비스 이용을 신청한 날에 서비스를 이용할 수 있도록 합니다.<br />
② 회사는 이 약관에서 정한 바에 따라 계속적이고 안정적인 서비스의 제공을 위하여 지속적으로 노력하며, 설비에 장애가 생기거나 멸실된 때에는 지체 없이 이를 수리 복구하여야 합니다. 다만, 천재지변, 비상사태 또는 그 밖에 부득이한 경우에는 그 서비스를 일시 중단하거나 중지할 수 있습니다.<br />
③ 회사는 회원으로부터 소정의 절차에 의해 제기되는 의견이나 불만이 정당하다고 인정할 경우에는 적절한 절차를 거처 처리하여야 합니다. 처리시 일정 기간이 소요될 경우 회원에게 그 사유와 처리 일정을 알려주어야 합니다.<br />
④ 회사는 회원의 프라이버시 보호와 관련하여 제6조에 제시된 내용을 지킵니다.<br />
⑤ 회사는 이용계약의 체결, 계약사항의 변경 및 해지 등 이용고객과의 계약 관련 절차 및 내용 등에 있어 이용고객에게 편의를 제공하도록 노력합니다.<br /><br />

<span class="u-tsub">제 10 조 (회원의 의무)</span><br />
① 회원은 이 약관에서 규정하는 사항과 이용안내 또는 공지사항 등을 통하여 회사가 공지하는 사항을 준수하여야 하며, 기타 회사의 업무에 방해되는 행위를 하여서는 안됩니다.<br />
② 회원의 ID와 SNS연동 접속권한에 관한 모든 관리책임은 회원에게 있습니다. 회원에게 부여된 ID와 SNS연동 접속 관리 소홀, 부정 사용에 의하여 발생하는 모든 결과에 대한 책임은 회원에게 있습니다.<br />
③ 회원은 자신의 ID가 부정하게 사용되었다는 사실을 발견한 경우에는 즉시 회사에 신고하여야 하며, 신고를 하지 않아 발생하는 모든 결과에 대한 책임은 회원에게 있습니다.<br />
④ 회원은 회사의 사전승낙 없이는 서비스를 이용하여 영업활동을 할 수 없으며, 그 영업활동의 결과와 회원이 약관에 위반한 영업활동을 하여 발생한 결과에 대하여 회사는 책임을 지지 않습니다. 회원은 이와 같은 영업활동으로 회사가 손해를 입은 경우 회원은 회사에 대하여 손해배상의무를 집니다.<br />
⑤ 회원은 회사의 명시적인 동의가 없는 한 서비스의 이용권한, 기타 이용 계약상 지위를 타인에게 양도, 대여, 공유, 증여할 수 없으며, 이를 담보로 제공할 수 없습니다.<br />
⑥ 회원은 서비스 이용과 관련하여 다음 각 호에 해당되는 행위를 하여서는 안됩니다.<br />
   1. 다른 회원의 ID와 본인인증정보 등을 도용하는 행위<br />
   2. 본 서비스를 통하여 얻은 정보를 회사의 사전승낙 없이 회원의 이용 이외 목적으로 복제하거나 이를 출판 및 방송 등에 사용하거나 제 3자에게 제공하는 행위<br />
   3. 특허, 상표, 영업비밀, 저작권 기타 지적재산권을 침해하는 내용을 게시, 전자메일 또는 기타의 방법으로 타인에게 유포하는 행위<br />
   4. 공공질서 및 미풍양속에 위반되는 저속, 음란한 내용의 정보, 문장, 도형 등을 전송, 게시, 전자메일 또는 기타의 방법으로 타인에게 유포하는 행위<br />
   5. 모욕적이거나 위협적이어서 타인의 프라이버시를 침해할 수 있거나 실명, 거주지, 연락처 등과 같은 타인의 신상정보와 관련된 내용을 전송, 게시, 전자메일 또는 기타의 방법으로 타인에게 유포하는 행위<br />
   6. 회사에서 운영하는 사이트와 커뮤니티에서 회원간의 분쟁을 유도하는 등 커뮤니티에 반하는 행위를 상습적으로 행하는 경우<br />
   7. 범죄와 결부된다고 객관적으로 판단되는 행위<br />
   8. 회사의 승인을 받지 않고 다른 회원의 개인정보를 수집 또는 저장하는 행위<br />
   9. 기타 관계법령에 위배되는 행위<br /><br /><br />


<span class="sub-tit">제 4 장. 서비스 이용</span><br />
<br />
<span class="u-tsub">제 11 조 (서비스 이용 범위)</span><br />
회원은 가입할 때 등록한 ID로 회사의 서비스를 이용할 수 있습니다. 다만, 인증 혹은 회원등급에 따라 일부 서비스는 제한될 수 있습니다.<br /><br />

<span class="u-tsub">제 12 조 (정보의 제공)</span><br />
① 회사는 회원이 서비스 이용중 필요가 있다고 인정되는 다양한 정보를 공지사항이나 전자우편 등의 방법으로 회원에게 제공할 수 있습니다.<br />
② 회사는 회원에게 보다 나은 서비스 혜택 제공을 위해 다양한 전달 방법(전화, 안내문, 전자우편 등)을 통해 서비스 관련 정보를 제공할 수 있습니다. 단, 회사는 회원이 서비스 혜택 정보 제공을 원치 않는다는 의사를 밝히는 경우 정보 제공 대상에서 해당 회원을 제외하여야 하며, 대상에서 제외되어 서비스 정보를 제공받지 못해 불이익이 발생하더라도 이에 대해서는 회사가 책임지지 않습니다.<br /><br />

<span class="u-tsub">제 13 조 (요금, 유료정보 및 결제 등)</span><br />
① 회사가 제공하는 서비스는 기본적으로 무료입니다.<br />
② 회사가 별도의 유료 서비스 및 유료 정보를 제공하는 경우, 회사는 해당 서비스의 개설 및 이용에 관하여 안내하여야 하며, 회원이 이를 이용하기 위해서는 해당 정보에 명시된 요금을 지불하여야 합니다.<br /><br />

<span class="u-tsub">제 14 조 (회원의 게시물)</span><br />
회사는 회원이 게시하거나 등록하는 서비스내의 내용물이 다음 각 호에 해당한다고 판단되는 경우에 사전통지 없이 삭제할 수 있습니다.<br />
   1. 다른 회원 또는 제3자를 비방하거나 중상모략으로 명예를 손상시키는 내용인 경우<br />
   2. 공공질서 및 미풍양속에 위반되는 내용인 경우<br />
   3. 범죄적 행위에 결부된다고 인정되는 내용일 경우<br />
   4. 회사의 저작권, 제3자의 저작권 등 기타 권리를 침해하는 내용인 경우<br />
   5. 회사에서 규정한 게시기간이나 용량을 초과한 경우<br />
   6. 회원이 자신의 홈페이지와 게시판에 음란물을 게재하거나 음란사이트를 링크하는 경우<br />
   7. 게시판의 성격에 부합하지 않는 게시물의 경우<br />
   8. 제10조 6항에 해당되는 게시물의 경우<br />
   9. 불법 프로그램 또는 비정상적인 방법을 통한 광고 클릭 방법 또는 링크를 배포하는 경우<br />
   10. 기타 관계법령에 위반된다고 판단되는 경우
<br /><br />
<span class="u-tsub">제 15 조 (게시물의 저작권)</span><br />
서비스에 게재된 자료에 대한 권리는 다음 각 호와 같습니다.<br />
   1. 게시물에 대한 권리와 책임은 게시자에게 있으며 회사는 게시자의 동의 없이는 이를 서비스 내 게재 이외에 영리적 목적으로 사용할 수 없습니다. 단, 비영리적인 경우에는 그러하지 아니하며 또한 회사는 서비스 내의 게재권을 갖습니다.<br />
   2. 회원은 서비스를 이용하여 얻은 정보를 가공, 판매하는 행위 등 서비스에 게재된 자료를 상업적으로 사용할 수 없습니다.<br /><br />

<span class="u-tsub">제 16 조 (광고게재 및 광고주와의 거래)</span><br />
① 회사가 회원에게 서비스를 제공할 수 있는 서비스 투자기반의 일부는 광고게재를 통한 수익으로부터 나옵니다. 서비스를 이용하고자 하는 자는 서비스 이용 시 노출되는 광고게재에 대해 동의하는 것으로 간주됩니다.<br />
② 회사는 본 서비스상에 게재되어 있거나 본 서비스를 통한 광고주의 판촉활동에 회원이 참여하거나 교신 또는 거래의 결과로서 발생하는 모든 손실 또는 손해에 대해 책임을 지지 않습니다.<br /><br />

<span class="u-tsub">제 17 조 (서비스 이용시간)</span><br />
① 서비스의 이용은 회사의 업무상 또는 기술상 특별한 지장이 없는 한 연중무휴 1일 24시간 가능함을 원칙으로 합니다. 다만 정기 점검 등의 필요로 회사가 정한 날이나 시간은 그러하지 않습니다.<br />
② 회사는 서비스를 일정범위로 분할하여 각 범위별로 이용가능 시간을 별도로 정할 수 있습니다. 이 경우 사전에 공지를 통해 그 내용을 알립니다.
<br /><br />
<span class="u-tsub">제 18 조 (서비스 이용 책임)</span><br />
회원은 회사에서 권한 있는 사원이 서명한 명시적인 서면에 구체적으로 허용한 경우를 제외하고는 서비스를 이용하여 상품을 판매하는 영업활동을 할 수 없으며 특히 해킹, 돈벌이 광고, 음란 사이트 등을 통한 상업행위, 상용 S/W 불법배포 등을 할 수 없습니다. 이를 어기고 발생한 영업활동의 결과 및 손실, 관계기관에 의한 구속 등 법적 조치등에 관해서는 회사가 책임을 지지 않습니다.<br /><br />

<span class="u-tsub">제 19 조 (서비스 제공의 중지 등)</span><br />
① 회사는 다음 각 호에 해당하는 경우 서비스 제공을 중지할 수 있습니다.<br />
   1. 서비스용 설비의 보수 등 공사로 인한 부득이한 경우<br />
   2. 전기통신사업법에 규정된 기간통신사업자가 전기통신 서비스를 중지했을 경우<br />
   3. 기타 불가항력적 사유가 있는 경우<br />
② 회사는 국가비상사태, 정전, 서비스 설비의 장애 또는 서비스 이용의 폭주 등으로 정상적인 서비스 이용에 지장이 있는 때에는 서비스의 전부 또는 일부를 제한하거나 중지할 수 있습니다.<br />
③ 회사는 제1항 및 제2항의 규정에 의하여 서비스의 이용을 제한하거나 중지한 때에는 그 사유 및 제한기간 등을 지체 없이 회원에게 알려야 합니다.<br />
<br /><br />

<span class="sub-tit">제 5 장. 계약 해지 및 이용 제한</span>
<br /><br />
<span class="u-tsub">제 20 조 (계약 해지 및 이용 제한)</span><br />
① 회원이 이용 계약을 해지하고자 하는 경우에는 회원 본인이 온라인을 통해 해지를 회사에 신청하여야 합니다.<br />
② 회사는 회원이 다음 각 호에 해당하는 행위를 하였을 경우 사전통지 없이 이용계약을 해지하거나 또는 기간을 정하여 서비스 이용을 일시적으로 중지시킬 수 있습니다.<br />
   1. 타인의 개인정보, ID 및 접속정보를 도용한 경우<br />
   2. 가입한 이름이 실명이 아니거나 가입시 입력한 내용이 허위인 경우<br />
   3. 타인의 명예를 손상시키거나 불이익을 주는 행위를 한 경우<br />
   4. 모욕적이거나 위협적이어서 타인의 프라이버시를 침해할 수 있거나 실명, 거주지, 연락처 등과 같은 타인의 신상정보와 관련된 내용을 전송, 게시, 전자메일 또는 기타의 방법으로 타인에게 유포하는 경우<br />
   5. 회사, 다른 회원 또는 제 3자의 지적재산권을 침해하는 경우<br />
   6. 공공질서 및 미풍양속에 저해되는 내용을 고의로 유포시킨 경우<br />
   7. 회원이 국익 또는 사회적 공익을 저해할 목적으로 서비스 이용을 계획 또는 실행하는    경우<br />
   8. 서비스 운영을 고의로 방해하거나 상습적으로 분쟁을 유도하는 등 커뮤니티에 반하는 행위를 하는 경우<br />
   9. 서비스의 안정적 운영을 방해할 목적으로 다량의 정보를 전송하거나 광고성 정보를 전송하는 경우<br />
   10. 정보통신설비의 오작동이나 정보의 파괴를 유발시키는 컴퓨터 바이러스 프로그램 등을 유포하는 경우<br />
   11. 정보통신윤리위원회 등 외부기관의 시정요구가 있거나 불법선거운동과 관련하여 선거관리위원회의 유권해석을 받은 경우<br />
   12. 회사의 서비스를 이용하여 얻은 정보를 회사의 사전 승낙 없이 복제 또는 유통시키거나 상업적으로 이용하는 경우<br />
   13. 회원이 음란물을 게재하거나 음란 사이트를 링크하는 등 음란 정보를 유포하는 경우<br />
   14. 최근 6개월 이내 서비스 이용기록(로그인 기록)이 없는 경우<br />
   15. 본 약관을 포함하여 기타 회사가 정한 이용 조건에 위반한 경우<br />
   16. 버그 및 변칙적인 방법에 의하여 회사의 서비스를 이용하는경우<br />
③ 회사는 서비스 이용중지 신청 후 60일 이내에 회원의 ID 재사용 요청이 있으면 즉시 처리해주어야 하며, 만약 60일 이내에 재사용 요청이 없으면 서비스를 계속 이용할 의사가 없는 것으로 간주하여 해지처리 합니다.<br /><br /><br />


<span class="sub-tit">제 6 장. 손해배상 및 기타 사항</span>
<br /><br />
<span class="sub-tit">제 21 조 (손해배상)</span><br />
회사는 이용 요금이 무료인 서비스 이용과 관련하여 회원에게 발생한 어떠한 손해에 관하여도 책임을 지지 않습니다.
<br /><br />
<span class="u-tsub">제 22 조 (면책조항)</span><br />
① 회사는 천재지변 또는 이에 준하는 불가항력으로 인하여 서비스를 제공할 수 없는 경우에는 서비스 제공에 관한 책임이 면제됩니다.<br />
② 회사는 회원의 귀책사유로 인한 서비스 이용의 장애에 대하여 책임을 지지 않습니다.<br />
③ 회사는 회원이 서비스를 이용하여 기대하는 수익을 상실한 것이나 서비스를 통하여 얻은 자료로 인한 손해에 관하여 책임을 지지 않습니다.<br />
④ 회사는 회원이 서비스에 게재한 정보, 자료, 사실의 신뢰도, 정확성 등 내용에 관하여는 책임을 지지 않습니다.<br />
⑤ 회사는 서비스 이용과 관련하여 가입자에게 발생한 손해 가운데 회원의 고의, 과실에 의한 손해에 대하여 책임을 지지 않습니다.<br />
<br />
<span class="u-tsub">제 23 조 (관할법원)</span><br />
서비스 이용으로 발생한 분쟁에 대해 소송이 제기될 경우 회사의 본사 소재지를 관할하는 법원을 전속 관할법원으로 합니다.
<br /><br />

 &lt;부 칙&gt;<br /> 
본 약관은 2020년 11월 1일 제정되었으며, 제정과 함께 회사에서 운영하는 사이트에 공지함으로써 그 효력이 발생합니다.<br /><br />
                                            </p>
	    </div>
	</div>
	
	
	
	
	
	<div class="person-u">
        <div class="modal-h">
            <span>개인정보처리방침</span>
            <span class="close-mh">닫기</span>
        </div>
        <div class="text-pu">
	    <p><span class="u-title">코비인사이트(주) 홈페이지 <br/>개인정보처리방침</span><br /><br />

        &lt;코비인사이트(주)&gt;('kobiinsight.co.kr'이하 '코비인사이트 홈페이지')은(는) 개인정보보호법에 따라 이용자의 개인정보 보호 및 권익을 보호하고 개인정보와 관련한 이용자의 고충을 원활하게 처리할 수 있도록 다음과 같은 처리방침을 두고 있습니다.<br /><br />

        코비인사이트(주)는 회사는 개인정보처리방침을 개정하는 경우 웹사이트 공지사항(또는 개별공지)을 통하여 공지할 것입니다.<br /><br />

        ○ 본 방침은부터 2020년 11월 1일부터 시행됩니다.<br /><br />

        <span class="u-tsub">제 1 조 (개인정보의 처리 목적, 개인정보의 처리 · 보유 기간, 처리하는 개인정보의 항목)</span><br />
        코비인사이트 홈페이지는 개인정보를 다음의 목적을 위해 처리합니다. 처리한 개인정보는 다음의 목적이외의 용도로는 사용되지 않으며 이용 목적이 변경될 시에는 사전동의를 구할 예정입니다.<br /><br />

        ① 홈페이지 회원가입 및 관리<br />
        회원 가입의사 확인, 회원제 서비스 제공에 따른 본인 식별·인증, 회원자격 유지·관리, 제한적 본인확인제 시행에 따른 본인확인, 서비스 부정이용 방지, 만14세 미만 아동 개인정보 수집 시 법정대리인 동의 여부 확인, 각종 고지·통지, 고충처리, 분쟁 조정을 위한 기록 보존 등을 목적으로 개인정보를 처리합니다.
        <br /><br /><br />
        ② 민원사무 처리<br />
        민원인의 신원 확인, 민원사항 확인, 사실조사를 위한 연락·통지, 처리결과 통보 등을 목적으로 개인정보를 처리합니다.
        <br /><br />
        ③ 재화 또는 서비스 제공<br />
        맞춤 서비스 제공, 본인인증 등을 목적으로 개인정보를 처리합니다.<br /><br />

<br /><br />
        <span class="u-tsub">제 2 조 (개인정보 파일 현황)</span><br />
        코비인사이트가 개인정보 보호법 제32조에 따라 등록․공개하는 개인정보파일의 처리목적은 다음과 같습니다.<br /><br />

        ① 개인정보 파일명 : 코비인사이트 개인정보<br />
        - 개인정보 항목 : 이메일, 휴대전화번호, 성별, 생년월일, 이름, 직책, 회사명, 직업, 회사주소<br />
        - 수집방법 : 홈페이지<br />
        - 보유근거 : 회원가입<br />
        - 보유기간 : 5년<br />
        - 관련법령 : 신용정보의 수집/처리 및 이용 등에 관한 기록 : 3년, 소비자의 불만 또는 분쟁처리에 관한 기록 : 3년, 계약 또는 청약철회 등에 관한 기록 : 5년, 표시/광고에 관한 기록 : 6개월
        <br /><br /><br />

        <span class="u-tsub">제 3 조 (개인정보의 처리 및 위탁)</span>
        <br /><br />
        ① 코비인사이트 홈페이지는 법령에 따른 개인정보 보유·이용기간 또는 정보주체로부터 개인정보를 수집시에 동의 받은 개인정보 보유,이용기간 내에서 개인정보를 처리,보유,위탁합니다.
        <br /><br />
        ② 각각의 개인정보 처리 및 보유 기간은 다음과 같습니다.<br />
        &lt;홈페이지 회원가입 및 관리&gt;와 관련한 개인정보는 수집.이용에 관한 동의일로부터&lt;5년&gt;까지 위 이용목적을 위하여 보유.이용됩니다.<br />
        - 보유근거 : 회원가입<br />
        - 관련법령 : <br />
        1) 신용정보의 수집/처리 및 이용 등에 관한 기록 : 3년<br />
        2) 소비자의 불만 또는 분쟁처리에 관한 기록 : 3년<br />
        3) 대금결제 및 재화 등의 공급에 관한 기록 : 5년<br />
        4) 계약 또는 청약철회 등에 관한 기록 : 5년<br />
        5) 표시/광고에 관한 기록 : 6개월<br />
        <br />
        ③ 코비인사이트는 위탁계약 체결시 개인정보 보호법 제25조에 따라 위탁업무 수행목적 외 개인정보 처리금지, 기술적․관리적 보호조치, 재위탁 제한, 수탁자에 대한 관리․감독, 손해배상 등 책임에 관한 사항을 계약서 등 문서에 명시하고, 수탁자가 개인정보를 안전하게 처리하는지를 감독하고 있습니다.<br /><br />

        ④ 위탁업무의 내용이나 수탁자가 변경될 경우에는 지체없이 본 개인정보 처리방침을 통하여 공개하도록 하겠습니다.
        <br /><br /><br />

        <span class="u-tsub">제 4 조 (정보주체의 권리·의무 및 그 행사방법)</span>
        정보주체와 법정대리인의 권리·의무 및 그 행사방법 이용자는 개인정보주체로써 다음과 같은 권리를 행사할 수 있습니다.
        <br />
        ① 정보주체는 코비인사이트(주)에 대해 언제든지 개인정보 열람,정정,삭제,처리정지 요구 등의 권리를 행사할 수 있습니다.
        <br /><br />
        ② 제1항에 따른 권리 행사는 코비인사이트(주)에 대해 개인정보 보호법 시행령 제41조제1항에 따라 서면, 전자우편, 모사전송(FAX) 등을 통하여 하실 수 있으며 코비인사이트(주)는 이에 대해 지체 없이 조치하겠습니다.
        <br /><br />
        ③ 제1항에 따른 권리 행사는 정보주체의 법정대리인이나 위임을 받은 자 등 대리인을 통하여 하실 수 있습니다. 이 경우 개인정보 보호법 시행규칙 별지 제11호 서식에 따른 위임장을 제출하셔야 합니다.
        <br /><br />
        ④ 개인정보 열람 및 처리정지 요구는 개인정보보호법 제35조 제5항, 제37조 제2항에 의하여 정보주체의 권리가 제한 될 수 있습니다.<br /><br />

        ⑤ 개인정보의 정정 및 삭제 요구는 다른 법령에서 그 개인정보가 수집 대상으로 명시되어 있는 경우에는 그 삭제를 요구할 수 없습니다.<br /><br />

        ⑥ 코비인사이트(주)은(는) 정보주체 권리에 따른 열람의 요구, 정정·삭제의 요구, 처리정지의 요구 시 열람 등 요구를 한 자가 본인이거나 정당한 대리인인지를 확인합니다.
        <br /><br />


        <span class="u-tsub">제 5 조 (처리하는 개인정보의 항목)</span>
        코비인사이트 홈페이지는 다음의 개인정보 항목을 처리하고 있습니다.
        <br /><br />
        &lt;홈페이지 회원가입 및 관리&gt;<br />
        필수항목 : 이메일, 휴대전화번호, 로그인ID, 성별, 생년월일, 이름, 직책, 회사명, 직업, 회사주소
        <br />
        <br /><br />

        <span class="u-tsub">제 6 조 (개인정보의 파기)</span>
        코비인사이트 홈페이지는 원칙적으로 개인정보 처리목적이 달성된 경우에는 지체없이 해당 개인정보를 파기합니다. 파기의 절차, 기한 및 방법은 다음과 같습니다.<br /><br />

        ① 파기절차<br />
        이용자가 입력한 정보는 목적 달성 후 별도의 DB에 옮겨져(종이의 경우 별도의 서류) 내부 방침 및 기타 관련 법령에 따라 일정기간 저장된 후 혹은 즉시 파기됩니다. 이 때, DB로 옮겨진 개인정보는 법률에 의한 경우가 아니고서는 다른 목적으로 이용되지 않습니다.<br /><br />

        ② 파기기한<br />
        이용자의 개인정보는 개인정보의 보유기간이 경과된 경우에는 보유기간의 종료일로부터 5일 이내에, 개인정보의 처리 목적 달성, 해당 서비스의 폐지, 사업의 종료 등 그 개인정보가 불필요하게 되었을 때에는 개인정보의 처리가 불필요한 것으로 인정되는 날로부터 5일 이내에 그 개인정보를 파기합니다.
        <br /><br />
        ③ 파기방법<br />
        전자적 파일 형태의 정보는 기록을 재생할 수 없는 기술적 방법을 사용합니다<br /><br /><br />



        <span class="u-tsub">제 7 조 (개인정보 자동 수집 장치의 설치•운영 및 거부에 관한 사항)</span>
        <br />
        코비인사이트(주) 은 정보주체의 이용정보를 저장하고 수시로 불러오는 ‘쿠키’를 사용하지 않습니다.
        <br /><br /><br />

        <span class="u-tsub">제 8 조 (개인정보 보호책임자 작성)</span>
        <br /><br />
        ① 코비인사이트 홈페이지는 개인정보 처리에 관한 업무를 총괄해서 책임지고, 개인정보 처리와 관련한 정보주체의 불만처리 및 피해구제 등을 위하여 아래와 같이 개인정보 보호책임자를 지정하고 있습니다.
        <br /><br />
        ▶ 개인정보 보호책임자<br />
        - 성명 :고경호<br />
        - 직책 :대표이사<br />
        - 직급 :대표이사<br />
        - 연락처 :02-2088-8102, insight@kobiinsight.co.kr, 02-2088-<br />
        ※ 개인정보 보호 담당부서로 연결됩니다.<br />
        <br />
        ▶ 개인정보 보호 담당부서<br />
        - 부서명 :관리부<br />
        - 담당자 :유건재<br />
        - 연락처 :02-2088-8102, gjyoo@kobiinsight.co.kr, 02-2088-8104<br /><br />

        ② 정보주체께서는 코비인사이트 홈페이지의 서비스(또는 사업)을 이용하시면서 발생한 모든 개인정보 보호 관련 문의, 불만처리, 피해구제 등에 관한 사항을 개인정보 보호책임자 및 담당부서로 문의하실 수 있습니다. 코비인사이트 홈페이지는 정보주체의 문의에 대해 지체 없이 답변 및 처리해드릴 것입니다.<br />


        <span class="u-tsub">제 9 조 (개인정보 처리방침 변경)</span>

        이 개인정보처리방침은 시행일로부터 적용되며, 법령 및 방침에 따른 변경내용의 추가, 삭제 및 정정이 있는 경우에는 변경사항의 시행 7일 전부터 공지사항을 통하여 고지할 것입니다.
        <br /><br />

            <span class="u-tsub">10. 개인정보의 안전성 확보 조치</span><br />
        코비인사이트 홈페이지는 개인정보보호법 제29조에 따라 다음과 같이 안전성 확보에 필요한 기술적/관리적 및 물리적 조치를 하고 있습니다.<br /><br />

            <span class="u-tsub">① 정기적인 자체 감사 실시</span><br />
        개인정보 취급 관련 안정성 확보를 위해 정기적(분기 1회)으로 자체 감사를 실시하고 있습니다.<br /><br />

            <span class="u-tsub">② 개인정보 취급 직원의 최소화 및 교육</span><br />
        개인정보를 취급하는 직원을 지정하고 담당자에 한정시켜 최소화 하여 개인정보를 관리하는 대책을 시행하고 있습니다.
        <br /><br />
            <span class="u-tsub">③ 내부관리계획의 수립 및 시행</span><br />
        개인정보의 안전한 처리를 위하여 내부관리계획을 수립하고 시행하고 있습니다.<br /><br />

            <span class="u-tsub">④ 개인정보에 대한 접근 제한</span><br />
        개인정보를 처리하는 데이터베이스시스템에 대한 접근권한의 부여,변경,말소를 통하여 개인정보에 대한 접근통제를 위하여 필요한 조치를 하고 있으며 침입차단시스템을 이용하여 외부로부터의 무단 접근을 통제하고 있습니다.<br /><br />

            <span class="u-tsub">⑤ 문서보안을 위한 잠금장치 사용</span><br />
        개인정보가 포함된 서류, 보조저장매체 등을 잠금장치가 있는 안전한 장소에 보관하고 있습니다.<br /><br />

            <span class="u-tsub">⑥ 비인가자에 대한 출입 통제</span><br />
        개인정보를 보관하고 있는 물리적 보관 장소를 별도로 두고 이에 대해 출입통제 절차를 수립, 운영하고 있습니다.<br /><br />
                                            </p>
	    </div>
	</div>
	
	<script>
        $(document).ready(function(){
            $('.using-per').on('click',function(){
                $('.person-u').css("display","block");
            });
            $('.close-mh').on('click',function(){
                $(this).parents('.person-u').css("display","none");
            });
            
            
            
            $('.using').on('click',function(){
                $('.using-u').css("display","block");
            });
            $('.close-mh').on('click',function(){
                $(this).parents('.using-u').css("display","none");
            });
        });
    </script>
</body>
</html>