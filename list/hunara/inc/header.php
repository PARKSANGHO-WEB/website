<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
	$page_url = explode("?",$_SERVER['REQUEST_URI']);
    $page_url = explode("/",$page_url[0]);
?>
<?php
$cidx = $_REQUEST['cidx'];
$sano = $_REQUEST['sano'];

$gconnet = mysqli_connect("127.0.0.1","hunara","hunara2021","hunara");
mysqli_query($gconnet,"set names UTF8");
if($cidx && $sano){
    $sql2 = " SELECT seq, pwd, cdx, sano, name, digit7, email, tel, hp, daycnt, year5, manychild, freshman FROM tb_employee ";
    $sql2 .= " WHERE cdx = '{$cidx}'  AND sano = '{$sano}' ";

    $rs = mysqli_query($gconnet, $sql2);

	if(mysqli_num_rows($rs)>0){ 
		$row = mysqli_fetch_array($rs);

        $_SESSION['EMP_SEQ'] = $row['seq'];
        $_SESSION['EMP_CDX'] = $row['cdx'];
        $_SESSION['EMP_NO'] = $row['sano'];
        $_SESSION['EMP_NM'] = $row['name'];
        $_SESSION['EMP_DIGIT'] = $v['digit7'];
        $_SESSION['EMP_EMAIL'] = $row['email'];
        $_SESSION['EMP_DAY_CNT'] = $row['daycnt'];
        $_SESSION['EMP_TEL'] = $row['tel'];
        $_SESSION['EMP_HP'] = $row['hp']; 
        

	} 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/header.css">
<?
    /*******************************************************
     * 페이지별 css 분리 적용
     *******************************************************/
	if($page_url[1] == "" || $page_url[1] == "index.php"){   // 메인 화면 css 적용
?>
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/swiper.css">
<?
	}else{ //서브화면 css 적용
?>
	<link rel="stylesheet" href="/css/sub.css">
	<link rel="stylesheet" href="/css/wSelect.css">
<?
        if(in_array("resort_view.php", $page_url)){ //휴양소 상세화면 css 추가
?>        
        <link rel="stylesheet" href="/css/slick.css">
        <link rel="stylesheet" href="/css/pgwslider.css">
        <link rel="stylesheet" href="/manage/css/calendar.css">
<?
        }else if(in_array("login", $page_url)){ //로그인 화면
?>
		<link rel="stylesheet" href="/css/login.css">
<?
        }else if(in_array("reserv.php", $page_url) || in_array("reserv_view.php", $page_url)){ 
?>
		<link rel="stylesheet" href="/css/reserv.css">		
<?        	
        }else if(in_array("mywrite.php", $page_url)){ 
?>
		<link rel="stylesheet" href="/css/reserv.css">		
		<link rel="stylesheet" href="/css/community.css">

<?        	
        }else if(in_array("mypage.php", $page_url)){ 
?>
		<link rel="stylesheet" href="/css/mypage.css">
<?        	
        }
	}
    /*******************************************************
     * 페이지별 css 분리 적용
     *******************************************************/

?>
	<link rel="stylesheet" href="/css/jquery.mCustomScrollbar.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta charset="UTF-8">
	<title>휴나라</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="/js/jquery.mCustomScrollbar.js"></script>
	<script src="/js/swiper.js"></script>

	<script src="/js/wSelect.js"></script>
	<script src="/js/index.js"></script>
	<script src="/js/common.js"></script>
	<script src="/js/sticky-sidebar.js"></script>	
	<script src="/js/validator.js"></script>	
<?
    //휴양소 상세화면 js 추가
    if(in_array("resort_view.php", $page_url)){ 
?>        
	<script src="/js/slick.js"></script>
	<script src="/js/pgwslider.js"></script>
	<script src="/manage/js/calendar.js"></script>
<?
	}  
?>
	<script>
		
        $(document).ready(function() {
            $("header").load("/inc/top.php");
            $("footer").load("/inc/footer.php");
        });

        function login_check(){

            if("<?=$_SESSION['EMP_NO']?>" == ""){

                console.log(<?=$_SESSION['EMP_NO']?>);
                console.log('dasd');

                login();

                return false;
            }else{
                
                return true;
            }


        }

        function login(){
            sessionStorage.setItem('LOGIN_RETURN_URL',window.location.href);
            document.location.href = "/login/login.php";
        }

        function logout(){
            if(confirm("로그아웃 하시겠습니까?")){

                $.ajax({
                    url		: "/login/login_proc.php",
                    type	: "POST",
                    data	: { mode:"LOGOUT"},
                    async	: false,
                    dataType	: "json",
                    success		: function(data){
                        if ( data.success == "true" ){
                            document.location.href = "/index.php";
                        }
                    }
                });    
            }
        }
		
	</script>
	
</head>
<?
	if(in_array("login",$page_url) == false){
?>
	<script>login_check();</script>
<?
    }
?>
