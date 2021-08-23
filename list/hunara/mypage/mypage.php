<? include("../inc/header.php"); ?>
<?
	$sql = " SELECT name, pwd, sano, email, tel, hp FROM tb_employee WHERE seq = '{$_SESSION['EMP_SEQ']}' ";

    $rs = mysqli_query($gconnet, $sql);
    $row = mysqli_fetch_array($rs); 
  
?>
<script>
    function save(){

            if (validate(document.frm)) {
            var pwd = $("#pwd").val();
            var pwd2 = $("#pwd2").val();

            var dataArr = {
                sano : $("#sano").val(),
                name : $("#name").val(),
                pwd : $("#pwd").val(),
                email : $("#email").val(),
                tel : $("#tel").val(),
                hp : $("#hp").val()
            };

            if(pwd == pwd2){
                $.ajax({
                    url		: "mypage_proc.php",
                    type	: "POST",
                    data	: dataArr,
                    async	: false,
                    dataType	: "json",
                    success		: function(data){
                        if ( data.success == "true" ){
                            alert(data.msg);

                        } else if ( data.success == "false" ){
                            alert(data.msg);
                            
                        } else {
                            alert( "시스템 오류 발생 하였습니다. \n 관리자에게 문의하시기 바랍니다." );
                        }
                    }
                });   
            }else{
                alert("비밀번호와 비밀번호 확인이 일치 하지 않습니다.");
                $("#pwd2").focus();
                return;
            }
        }         

    }
</script>
<body>
    <header></header>
    <div id="container">
		<div class="sort-wrap">
			<div class="sort-menu" id="sangse-sort">
				<ul>
					<li class="active">
						<span onclick="location.href='/mypage/mypage.php'">회원정보</span>
					</li>
					<li>
						<span onclick="location.href='/mypage/reserv.php'">예약내역</span>
					</li>
					<li>
						<span onclick="location.href='/mypage/mywrite.php'">내 게시글 관리</span>
					</li>
				</ul>
			</div>
		</div>
        <h2>기본정보</h2>
        <form name="frm" method="POST">
            <div id="table">
                <label for="com_name"><p>회사명</p></label>
                <input type="text" name="com_name" id="com_name" value="<?=$_SITE_COMPANY ?>" readOnly>
                <label for="name"><p>이름</p></label>
                <input type="text" name="name" id="name" value="<?=$row['name']?>" HNAME="이름" REQUIRED MAXBYTE="50" readOnly >
                <label for="sano"><p>사원번호</p></label>
                <input type="text" name="sano" id="sano" value="<?=$row['sano']?>" HNAME="사원번호" REQUIRED MAXBYTE="20" readOnly >
                <label for="pwd"><p>비밀번호</p></label>
                <input type="password" name="pwd" id="pwd" value="<?=$row['pwd']?>" HNAME="비밀번호" REQUIRED>
                <label for="pwd2"><p>비밀번호 확인</p></label>
                <input type="password" name="pwd2" id="pwd2" value="<?=$row['pwd']?>" HNAME="비밀번호 확인" REQUIRED >
                <label for="email"><p>이메일</p></label>
                <input type="text" name="email" id="email" value="<?=$row['email']?>" HNAME="이메일" OPTION="email" >
                <label for="tel"><p>전화번호</p></label>
                <input type="text" name="tel" id="tel" value="<?=$row['tel']?>" HNAME="전화번호" OPTION="tel" onChange="isValidTel(this)">
                <label for="hp"><p>휴대번호</p></label>
                <input type="text" name="hp" id="hp" value="<?=$row['hp']?>" HNAME="휴대번호" OPTION="phone" REQUIRED onChange="isValidPhone(this)">
				<button type="button" onClick="save();">수정</button>
            </div>
        </form>
	</div> 
    <footer></footer>
</body>
</html>