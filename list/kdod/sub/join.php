<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/sub.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/wSelect.css">
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
<script>
function chkPwd(str){
 var reg_pwd = /^.*(?=.{6,20})(?=.*[0-9])(?=.*[a-zA-Z]).*$/;
 if(!reg_pwd.test(str)){
  return false;
 }
 return true;

}
function go_submit() {
			
			if (document.frm.user_id.value=='')
			{
				alert('Please enter your ID.');
				document.frm.user_id.focus();
				return false;
			}

			if (document.frm.email.value == ""){
				alert('Please enter your email.');
				document.frm.email.focus();
				return false;	
			}

			if(!emailCheck(document.frm.email.value)){
				alert('The e-mail address you entered is not valid.');
				document.frm.email.focus();
				return false;	
			}
			
			if (document.frm.user_pwd.value == ""){
				alert('Please check your password.');
				document.frm.user_pwd.focus();
				return false;	
			}

			if(!chkPwd( $.trim($('#password1').val()))){ 
				 alert('Please check your password. (6~20 characters in combination of English and number)');    
				 $('#password1').val('');
				 $('#password1').focus(); 
				 return false;
			}

			if (document.frm.user_pwd_re.value == ""){
				alert('Please check your Password confirm.');
				document.frm.user_pwd_re.focus();
				return false;	
			}

			if(document.frm.user_pwd.value != document.frm.user_pwd_re.value){
				alert('Please confirm the entered password.');
				return false;	
			}
			document.frm.submit();
			return;		
}

function set_nation(str){
	document.frm.nation.value=str;
}
</script>
    <section class="join">
        <form action="join-add.php" name="frm" method="post" target="_self">
		<input type="hidden" name="reurl_go" value="<?=$reurl_go?>">
		    <div class="join-wrap">
                <div class="join-logo">
                    <a href="../index.php">
                        <img src="../img/logo.png" alt="">
                    </a>
                </div>
                <div class="join-title">
                    <p>REGISTRATION</p>
                    <span>It’s free and easy! Be connected with us!</span> 
                </div>
                <div class="join-sel">
                    <div class="gnb-big pd0">
					  <select id="demo" tabindex="1" name="nation_txt">
						<option value="kr" data-icon="../img/korea.png">한국어</option>
						<option value="en" data-icon="../img/america.png">English</option>
						<option value="my" data-icon="../img/my.png">မြန်မာဘာသာ</option>
						<option value="cam" data-icon="../img/cb.png">ភាសាខ្មែរ</option>
					  </select>
					  <script type="text/javascript">
						$('select').wSelect();
					  </script>
           			</div>
                </div>
                <div class="f-btn">
                    <button type="button" onclick="FB.login(FaceBookApp.statusChangeCallback, FaceBookApp.FBScopes);"><span>Sign up with facebook</span></button>
                </div>
                <div class="bar-or">
                    <span class="hypen"></span>
                    <span class="text">or</span>
                    <span class="hypen"></span>
                </div>
                <div class="input-wrap">
                    <input type="text" name="user_id" placeholder="ID">
                    <input type="text" name="email"  placeholder="Email">
                    <input type="password" name="user_pwd" id="password1" placeholder="Password">
                    <input type="password" name="user_pwd_re" id="confirm_password" placeholder="Password confirm">
                    <span class="pass-match" id="message"></span>
                </div>
				<script>
                            $(document).ready(function(){
                                $('#password1, #confirm_password').on('keyup', function (){
                                  if($('#password1').val() == $('#confirm_password').val()){
									$('#message').html('');
                                  }else{
									$('#message').html('*Passwords do not match');
								  }
                                });
                            });
                            
                  </script>
                <!-- <div class="pass-op">
                    <span class="remember-id">
                        <input id="r-id" name="r-id" type="checkbox">
                        <label for="r-id">Remember me</label>
                    </span>
                    <span class="forgot">Forgot your password?</span>
                </div> -->
                <div class="join-btn"onclick="javascript:go_submit();">
                    <button type="button">
                        <span>KDOD - Sign up</span>
                    </button>
                </div>
                <div class="gojoin">
                    <span>Already have an account?</span>
                    <a href="./login.php">Log in</a>
                </div>
            </div>
        </form>
    </section>
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
            option.classList.remove('hide');
            option.classList.add('show');
            }else{
            option.classList.add('hide');
            option.classList.remove('show');
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
	<input type="hidden" name="nation_txt" id="sns_nation">
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

					var sns_nation = $("#demo").val();

					document.pub_login_form.sns_kind.value = "fb"; // 페이스북
					document.pub_login_form.user_id.value = id;
					document.pub_login_form.user_name.value = memberName;
					document.pub_login_form.user_email.value = email;
					$("#sns_nation").val(sns_nation);
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