<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/sub.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/wSelect.css">
    <link rel="stylesheet" href="../css/modal-b.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1.0">
    <title>K-DOT</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="../js/menu.js"></script>
    <script src="../js/wSelect.js"></script>
	<script src="../js/common_js.js"></script>
</head>
<body>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? 
$reurl_go = trim($_REQUEST['reurl_go']);


?>

<script>

 window.onload = function() {
 
        if (getCookie("id")) { // getCookie함수로 id라는 이름의 쿠키를 불러와서 있을경우
            document.frm_login.user_id.value = getCookie("id"); //input 이름이 id인곳에 getCookie("id")값을 넣어줌
            document.frm_login.r_id.checked = true; // 체크는 체크됨으로
        }
 
    }
 
    function setCookie(name, value, expiredays) //쿠키 저장함수
    {
        var todayDate = new Date();
        todayDate.setDate(todayDate.getDate() + expiredays);
        document.cookie = name + "=" + escape(value) + "; path=/; expires="
                + todayDate.toGMTString() + ";"
    }
 
    function getCookie(Name) { // 쿠키 불러오는 함수
        var search = Name + "=";
        if (document.cookie.length > 0) { // if there are any cookies
            offset = document.cookie.indexOf(search);
            if (offset != -1) { // if cookie exists
                offset += search.length; // set index of beginning of value
                end = document.cookie.indexOf(";", offset); // set index of end of cookie value
                if (end == -1)
                    end = document.cookie.length;
                return unescape(document.cookie.substring(offset, end));
            }
        }
    }
 



function init_Onload(){
		document.frm_login.user_id.focus();
	}
	function go_submit() {
			if(document.frm_login.user_id.value==''){
				alert('Please enter your ID');
				document.frm_login.user_id.focus();
				return false;
			}
			if(document.frm_login.user_pwd.value==''){
				alert('Please enter your PASSWORD');
				document.frm_login.user_pwd.focus();
				return false;
			}
			if (document.frm_login.r_id.checked == true) { // 아이디 저장을 체크 하였을때
				setCookie("id", document.frm_login.user_id.value, 31); //쿠키이름을 id로 아이디입력필드값을 한달동안 저장
			} else { // 아이디 저장을 체크 하지 않았을때
				setCookie("id", document.frm_login.user_id.value, 0); //날짜를 0으로 저장하여 쿠키삭제
			}
			document.frm_login.submit();
			return;
	}

function set_nation(str){
	document.frm_login.nation.value=str;
}
</script>
    <section class="login">
        <form action="login_check.php"  name="frm_login" id="frm_login"  method="post" >
		<input type="hidden" name="reurl_go" value="<?=$reurl_go?>">
		<input type="hidden" name="nation" id="nation">
            <div class="login-wrap">
                <div class="login-logo">
                    <a href="../index.php">
                        <img src="../img/logo.png" alt="">
                    </a>
                </div>
                <div class="login-title">
                    <p>Login</p>
                    <span>K-DOD website Welcome!</span>
                </div>
                <div class="login-sel">
<!--
                    <div class="select" data-role="selectBox">
                        <span date-value="optValue" class="selected-option">

                        </span>
                         옵션 영역 
                        <ul class="hide">
                           <li>
                                <span class="eng" onclick="set_nation('01');">English</span>
                            </li>
                            <li>
                                <span class="myan" onclick="set_nation('02');">မြန်မာဘာသာ</span>
                            </li>
                            <li>
                                <span class="cam" onclick="set_nation('03');">ភាសាខ្មែរ</span>
                            </li>
                            <li>
                                <span class="kr" onclick="set_nation('04');">한국어</span>
                            </li>
                        </ul>
                    </div>
-->
                    <div class="gnb-big pd0">
					  <select id="demo" tabindex="1">
						<option value="kr" onclick="set_nation('01');" data-icon="../img/korea.png">한국어</option>
						<option value="en" onclick="set_nation('02');" data-icon="../img/america.png">English</option>
						<option value="my" onclick="set_nation('03');" data-icon="../img/my.png">မြန်မာဘာသာ</option>
						<option value="cam" onclick="set_nation('04');" data-icon="../img/cb.png">ភាសាខ្មែរ</option>
					  </select>
					  <script type="text/javascript">
						$('select').wSelect();
					  </script>
           			</div>
                </div>
                <div class="f-btn">
                    <button type="button" onclick="FB.login(FaceBookApp.statusChangeCallback, FaceBookApp.FBScopes);"><span>Login with facebook</span></button>
                </div>
                <div class="bar-or">
                    <span class="hypen"></span>
                    <span class="text">or</span>
                    <span class="hypen"></span>
                </div>
                <div class="input-wrap">
                    <input type="text" name="user_id" id="user_id" placeholder="ID">
                    <input type="password" name="user_pwd" id="user_pwd" placeholder="Password">
                </div>
                <div class="pass-op">
                    <span class="remember-id">
                        <input id="r-id" name="r_id" type="checkbox" value="saveOk">
                        <label for="r-id">Remember me</label>
                    </span>
                    <span class="forgot">Forgot your password?</span>
                </div>
                <div onclick="javascript:go_submit();" class="login-btn">
                    <button type="button" target="_blank" >
                        <span>KDOD - Login</span>
                    </button>
                </div>
                <div class="gojoin">
                    <span>Not a member?</span>
                    <a href="./join.php">Sign up</a>
                </div>
            </div>
        </form>
    </section>
    
    <div class="find-modal">
    	
		<div class="find-con">
			<form name="frm_pass" action="find_pw_action.php" target="_self" method="post"  enctype="multipart/form-data">
				<p>if you enter the infomation below,<br /> your password will be sent to by email</p>
				<input type="text" placeholder="ID" name="user_id" id="kdod_id" required="yes" message="ID">
				<input type="text" placeholder="NAME" name="user_name" id="kdod_name" required="yes" message="NAME">
				<input type="text" placeholder="E-MAIL" name="email" id="kdod_email" required="yes" message="E-MAIL" is_email="yes">
				<div class="btn-find" style="margin-top:10px;">
					<button class="find-can" type="button">NO</button>
					<button class="find-ok" type="button" onclick="go_submit_pass();">YES</button>
				</div>
			</form>
		</div>
    </div>
    
    <script>
		
		$(document).ready(function(){
			$('.forgot').on('click',function(){
				$('.find-modal').addClass('visible');
			});
			
			$('.find-can').on('click',function(){
				$('.find-modal').removeClass('visible');
			});
		});

		function go_submit_pass() {
			var check = chkFrm('frm_pass');
			if(check) {
				frm_pass.submit();
			} else {
				false;
			}
		}
	
	</script>
    
    <script>
		
		$(document).ready(function(){
			$('.forgot').on('click',function(){
				$('.find-modal').addClass('visible');
			});
			
			$('.find-can').on('click',function(){
				$('.find-modal').removeClass('visible');
			});
		});
	
	</script>
    <script>

            const body = document.querySelector('body');
            const select = document.querySelector(`[data-role="selectBox"]`);
            const values = select.querySelector(`[date-value="optValue"]`);
            const option = select.querySelector('ul');
            const opts = option.querySelectorAll('li');

            /* 셀렉트영역 클릭 시 옵션 숨기기, 보이기 */
            function selects(e){
            e.stopPropagation();
            option.setAttribute('style',`top:${select.offsetHeight}px`)
            if(option.classList.contains('hide')){
            select.classList.add('on');
            option.classList.remove('hide');
            option.classList.add('show');
            }else{
            option.classList.add('hide');
            option.classList.remove('show');
            select.classList.remove('on');
            }
            selectOpt();
            }

            /* 옵션선택 */
            function selectOpt(){
            opts.forEach(opt=>{
            const innerValue = opt.innerHTML;
            function changeValue(){
            values.innerHTML = innerValue;
            }
            opt.addEventListener('click',changeValue)
            });
            }

            /* 렌더링 시 옵션의 첫번째 항목 기본 선택 */
            function selectFirst(){
            const firstValue = opts[0].innerHTML;
            values.innerHTML = `${firstValue}`
            }

            /* 옵션밖의 영역(=바디) 클릭 시 옵션 숨김 */
            function hideSelect(){
            if(option.classList.contains('show')){
            option.classList.add('hide');
            option.classList.remove('show');
            select.classList.remove('on');
            }
            }

            selectFirst();
            select.addEventListener('click',selects);
            body.addEventListener('click',hideSelect);
        </script>

		<!-- SNS 로그인 시 리턴 데이터 수신 및 전달을 위한 폼 시작 -->
<form name="pub_login_form" id="pub_login_form" method="post">
	<input type="hidden" name="sns_kind">
	<input type="hidden" name="user_id">
	<input type="hidden" name="user_name">
	<input type="hidden" name="user_email">
</form>
<!-- SNS 로그인 시 리턴 데이터 수신 및 전달을 위한 폼 종료 -->

<!-- 페이스북 -->
<script type="text/javascript">
var FaceBookApp = {
	FBScopes: {scope: 'public_profile,email'},
	accessToken: '',
	// 초기화 함수
	init: function(d, s, id) {
			window.fbAsyncInit = function() {
					FB.init({
							appId : '114368347100871', // api 승인 완료 후 받는 클라이언트 키 
							xfbml : true,
							//version : 'v2.6'
							version : 'v9.0'
					});
			};
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
		 js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
		 fjs.parentNode.insertBefore(js, fjs);
	},
	statusChangeCallback: function(response) {
			FaceBookApp.accessToken = response.authResponse.accessToken;
			// 연결 성공
			if (response.status === 'connected') {
					// 연결 성공시 실행할 코드
					FaceBookApp.FBsigninCallback();
			// 인증 거부
			} else if (response.status === 'not_authorized') {
					console.log('Please log into this app.');
			// 그 밖..
			} else {
					console.log('Please log into Facebook.');
			}
	},
	FBsigninCallback: function() {
			FB.api('/me?fields=id,email,name', function(response) {
					var id = response.id;
					var token = FaceBookApp.accessToken;
					var memberName = response.name;
					var email = response.email;

					/*alert("페이스북 로그인 성공");
					alert(id);
					alert(token);
					alert(memberName);
					alert(email);*/
					document.pub_login_form.sns_kind.value = "fb"; // 페이스북
					document.pub_login_form.user_id.value = id;
					document.pub_login_form.user_name.value = memberName;
					document.pub_login_form.user_email.value = email;
					document.pub_login_form.action="login_check_sns_facebook.php"; // 이동할 페이지 URL
					document.pub_login_form.target="_self";
					document.pub_login_form.submit();
					// 실행할 코드

		});
	}
};
// 초기화 실행
FaceBookApp.init(document, 'script', 'facebook-jssdk');
</script>
</body>
</html>