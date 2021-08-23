<? include("../inc/header.php"); 

?>
<script type="text/javascript">


function doLogin(){

    if (validate(document.frm)) {

        $.ajax({
            url		: "login_proc.php",
            type	: "POST",
            data	: { mode:"LOGIN", sano:$("#sano").val(), name:$("#name").val(), pwd:$("#pwd").val() },
            async	: false,
            dataType	: "json",
            success		: function(data){
                if ( data.success == "true" ){
                    
                    var login_return = sessionStorage.getItem('LOGIN_RETURN_URL');

                    //로그인 전 화면으로 이동
                    if(login_return =="" || login_return == null || login_return.indexOf("login") > 0){
                        document.location.href = "/index.php";
                    }else{
                        document.location.href = login_return;
                    }

                } else if ( data.success == "false" ){
                    alert(data.msg);
                    
                } else {
                    alert( "시스템 오류 발생 하였습니다. \n 관리자에게 문의하시기 바랍니다." );
                }
            }
    	});    

    }
}
</script>
<body>
    <header></header>
    <div id="container">
        <div id="login">
            <h2><span class="green">사원번호와 비밀번호</span>를<br>입력해주세요</h2>
            <?php
                $http_host_arr = explode(".",$_SERVER["HTTP_HOST"]);

                //if($http_host_arr[0] != "nhis"){?>
            <form name="frm"  method="POST" >
                <label for="sano"><p>사원번호</p></label>
                <input type="text" id="sano" name="sano" HNAME="사원번호" REQUIRED>
                <label for="name"><p>성명</p></label>
                <input type="text" id="name" name="name" HNAME="성명" REQUIRED >
                <label for="pwd"><p>비밀번호</p></label>
                <input type="password" id="pwd" name="pwd" HNAME="비밀번호" REQUIRED >
                <p class="lastOne"><a href="changepw.php">최초 로그인 </a> <span class="small"> ◀ 최초 로그인 시 비밀번호 설정 필요</span></p>
				<button type="button" onclick="doLogin();">로그인</button>
            </form>
            <?php //} ?>
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
    <footer></footer>
    <? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/index_layer_pop.php"; ?>
</body>
</html>