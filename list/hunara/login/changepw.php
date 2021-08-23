<? include("../inc/header.php"); ?>

<script type="text/javascript">
$('head').append('<link rel="stylesheet" href="/css/login.css">');    

function changePwd(){
    
    
    if (validate(document.frm)) {
        var pwd = $("#pwd").val();
        var pwd2 = $("#pwd2").val();

        if(pwd == pwd2){
            $.ajax({
                url		: "login_proc.php",
                type	: "POST",
                data	: { mode:"SAVE_PW", sano:$("#sano").val(), name:$("#name").val(), pwd:$("#pwd").val() },
                async	: false,
                dataType	: "json",
                success		: function(data){
                    if ( data.success == "true" ){
                        $(".change-modal").addClass("visible");

                    } else if ( data.success == "false" ){
                        alert(data.msg);
                        
                    } else {
                        alert( "시스템 오류 발생 하였습니다. \n 관리자에게 문의하시기 바랍니다." );
                    }
                }
            });   
        }else{
            alert("비밀번호가 일치 하지 않습니다.");
            $("#pwd2").focus();
            return;
        }
    } 

}
</script>    
<body>
    <header></header>
    <div id="container">
        <div id="login">
            <h2><span class="green">최초 로그인 </span>시<br>비밀번호 설정이 필요합니다.</h2>
            <form name="frm" method="post">
                <label for="sano"><p>사원번호</p></label>
                <input type="text" id="sano" name="sano" HNAME="사원번호" REQUIRED >
                <label for="name"><p>성명</p></label>
                <input type="text" id="name" name="name" HNAME="성명" REQUIRED >
                <label for="pwd"><p>비밀번호</p></label>
                <input type="password" id="pwd" name="pwd" HNAME="비밀번호" REQUIRED MAXBYTE="50" >
                <label for="pwd2"><p>비밀번호 확인</p></label>
                <input type="password" id="pwd2" name="pwd2" class="lastOne" HNAME="비밀번호 확인" REQUIRED >
				<button type="button" class="chg-pw green" onClick="changePwd();" >비밀번호 변경하기</button>
            </form>
        </div>
        <div id="info">
            <div id="info1">
                <p>직원을 위한 휴양소 신청</p>
                <p class="large">사원가족 여러분<br>환영합니다.</p>
                <p>최적의 숙박정보와 특별한<br>가격으로 당신의 가치를<br>빛나게 해드리겠습니다.</p>
            </div>
            <div id="info2">
                <p class="large">고객센터<br>02-567-5880</p>
                <p class="small">숙박 및 기업 행사 등<br>휴나라에 문의해 주시면 최적의 상품을<br>추천 드리겠습니다.</p>
            </div>
        </div>
    </div>
    
    
	<div class="change-modal modal-wrap">
		<div class="modal-con">
			<div class="modal-top">
				<div class="close-modal">
					<img src="/img/common/close.png" alt="">
				</div>
			</div>
			<div class="modal-bot">
				<form action="#">
					<div class="mo-con">
						<p>변경이 완료되었습니다.</p>
						<div class="s1-button">
							<button type="button" onclick="location.href='login.php'">로그인하기
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
    <footer></footer>
</body>
</html>