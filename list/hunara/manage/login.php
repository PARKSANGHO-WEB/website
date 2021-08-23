<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="/manage/css/common.css">
	<link rel="stylesheet" href="/manage/css/wSelect.css">
	<link rel="stylesheet" href="/manage/css/login.css">
	<meta charset="UTF-8">
	<title>휴나라 관리자모드</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="/manage/js/wSelect.js"></script>
	<script src="/manage/js/tab.js"></script>
    <script src="/manage/js/validator.js"></script>
    <script>
        function companyLogin(){
            var f = document.companyForm;

            if(validate(f)){
                var id = getSelectBoxValue(f.id);
                var pwd = f.pwd.value;
                var type = "CO_ADMIN";
                login(type,id,pwd);
                
            }
            
        }
        function huLogin(){
            var f = document.huForm;

            if(validate(f)){
                var id = getSelectBoxValue(f.id);
                var pwd = f.pwd.value;
                var type = "HU_ADMIN";
                login(type,id,pwd);
                
            }
            
        }
        function systemLogin(){
            var f = document.systemForm;
            
            if(validate(f)){
                var id = f.id.value;
                var pwd = f.pwd.value;
                var type = "SYS_ADMIN";
                login(type,id,pwd);
                
            }

        }

        function login(type,id,pwd){

            $.ajax({
                url		: "/manage/login_proc.php",
                type	: "POST",
                data	: { "mode":"LOGIN", "type":type, "id":id, "pwd":pwd },
                async	: false,
                dataType	: "json",
                success		: function(data){

                    if ( data.success == "true" ){

                        if(type == "SYS_ADMIN"){
                            document.location.href = "/manage/home.php";
                        }else{
                            document.location.href = "/manage/room/room-manage.php";
                        }

                    } else if ( data.success == "false" ){
                        alert(data.msg);
                        return;
                    } else {
                        alert( "시스템 오류 발생 하였습니다. \n 관리자에게 문의하시기 바랍니다." );
                        return;
                    }
                }
            });    

        }

    </script>    
</head>
<body>
	<div class="login">
		<div class="login-logo">
			<img src="./img/common/logo.png"s alt="">
		</div>
		<div class="login-con">
<!--
			<p class="login-title">
				로그인
			</p> 
-->
			<div class="login-top tab-btn">
				<ul>
					<li>
						<span>기업</span>
					</li>
					<li>
						<span>휴양소</span>
					</li>
					<li class="active">
						<span>관리자</span>
					</li>
				</ul>
			</div>
			<div class="login-wrap tab-con" style="display:none;">
				<form name="companyForm">
					<div class="line-1">
						<span class="lw-t">아이디</span>
						<span class="lw-c">
							<select name="id" id="id">
								<option value="">기업명을 선택하세요.</option>
								<?= getSelectBox($gconnet, 'idx', 'comname', 'tb_company') ?>
							</select>
						</span>
					</div>
					<div class="line-2">
						<span class="lw-t">비밀번호</span>
						<span class="lw-c">
							<input type="password" name="pwd" id="pwd">
						</span>
					</div>
					<div class="btn-line" >
						<button type="button" onClick="companyLogin();">로그인</button>
					</div>
				</form>
			</div>
			<div class="login-wrap tab-con" style="display:none;">
				<form name="huForm">
					<div class="line-1">
						<span class="lw-t">아이디</span>
						<span class="lw-c">
							<select name="id" id="id">
								<option value="">휴양소명을 선택하세요.</option>
                                <?= getSelectBox($gconnet, 'idx', 'comname', 'tb_hu') ?>
							</select>
						</span>
					</div>
					<div class="line-2">
						<span class="lw-t">비밀번호</span>
						<span class="lw-c">
							<input type="password" name="pwd" id="pwd">
						</span>
					</div>
					<div class="btn-line" >
						<button type="button" onClick="huLogin();">로그인</button>
					</div>
				</form>
			</div>
			<div class="login-wrap tab-con">
				<form name="systemForm">
					<div class="line-1">
						<span class="lw-t">아이디</span>
						<span class="lw-c">
							<input type="text" name="id" id="id">
						</span>
					</div>
					<div class="line-2">
						<span class="lw-t">비밀번호</span>
						<span class="lw-c">
							<input type="password" name="pwd" id="pwd">
						</span>
					</div>
					<div class="btn-line" >
						<button type="button" onClick="systemLogin();">로그인</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!--  셀렉트 플러그인	-->
	<script>
		$(document).ready(function(){
			
			$('select').wSelect();
		});
	</script>
	
	<script>
	</script>
</body>
</html>