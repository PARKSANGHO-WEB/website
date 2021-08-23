<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/check_login.php"; ?>
<?
	$page_url = explode("?",$_SERVER['REQUEST_URI']);
    $page_url = explode("/",$page_url[0]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
<?
	if($page_url[2] == "notice"){
?>	
	<link rel="stylesheet" href="/manage/css/notice.css">
<?
	}else{
?>
	<link rel="stylesheet" type="text/css" href="/manage/css/sub.css">
<?
	}
?>
	<link rel="stylesheet" type="text/css" href="/manage/css/common.css">
	<link rel="stylesheet" type="text/css" href="/manage/css/zebra_datepicker.css">
	<link rel="stylesheet" type="text/css" href="/manage/css/wSelect.css">
	<link rel="stylesheet" type="text/css" href="/manage/css/calendar.css">
	<link rel="stylesheet" type='text/css' href="/manage/css/ui.jqgrid.css">
	<link rel='stylesheet' type='text/css' href='/manage/css/jquery-ui.css' />

	<meta charset="UTF-8">
	<title>휴나라 관리자모드</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="/manage/js/zebra_datepicker.src.js"></script>
	<script src="/manage/js/wSelect.js"></script>
	<script src="/manage/js/checkbox.js"></script>
	<script src="/manage/js/tab.js"></script>
	<script src="/manage/js/modal.js"></script>
	<script src="/manage/js/calendar.js"></script>
    <script src="/manage/js/jquery.jqgrid.min.js" defer></script>
    <script src="/manage/js/validator.js"></script>
    <script src="/manage/js/common.js"></script>
    <script src="/manage/js/common_js.js"></script>
	<script>
		

        function go_homepage(){
            window.location.href= 'http://<?=$_SESSION['HOMEPAGE']?>'+'.hunara.com';
        }

        function logout(){

            if(confirm("로그아웃 하시겠습니까?")){

                $.ajax({
                    url		: "/manage/login_proc.php",
                    type	: "POST",
                    data	: { mode:"LOGOUT"},
                    async	: false,
                    dataType	: "json",
                    success		: function(data){
                        if ( data.success == "true" ){
                            document.location.href = "/manage/login.php";
                        }
                    }
                });    
            }
        }

	</script>
	
</head>
<header>
        <?
            if( $_SESSION['MEM_LEVEL'] == "00" ){
        ?>    
		<div class="logo" onclick="location.href='/manage/home.php'">
        <?
            }else{
        ?>
        <div class="logo" >
        <?
            }
        ?>

			<img src="../img/common/logo.png" alt="">
		</div>
		<div class="gnb">
			<ul>
				<li>
					<a href="javascript:;"><?=$_SESSION['MEM_NAME']?> 님</a>
				</li>
                <?
                    if(!empty($_SESSION['HOMEPAGE'])){
                ?>
				<li>
					<a href="javascript:go_homepage();">홈페이지 이동</a>
				</li>
                <?
                    }
                ?>
				<li>
					<a href="javascript:logout();">로그아웃</a>
				</li>
			</ul>
		</div>
	</header>
	<div class="menu">
		<ul>
        <?
            if( $_SESSION['MEM_LEVEL'] == "00" ){
        ?>

			<li <?=($page_url[2] == "company")?"class='active'":""?>>
                <?
                    if( $_SESSION['MEM_LEVEL'] == "00" ){
                ?>             
				    <a href="/manage/company/company-new.php">기업관리</a>
                <?  }else{ ?>
                    <a href="/manage/company/company.php">기업관리</a>
                <?  } ?>                
			</li>
        <?
            }
        ?>
			<li <?=($page_url[2] == "room")?"class='active'":""?>>
                <?
                    if( $_SESSION['MEM_LEVEL'] == "00" ){
                ?>             
				    <a href="/manage/room/room-new.php">휴양소 관리</a>
                <?  }else{ ?>
                    <a href="/manage/room/room-manage.php">휴양소 관리</a>
                <?  } ?>
			</li>
			<li <?=($page_url[2] == "reserve")?"class='active'":""?>>
                <?
                    if( $_SESSION['MEM_LEVEL'] == "00" ){
                ?>             
				    <a href="/manage/reserve/reserve-selected.php">예약 관리</a>
                <?  }else{ ?>
                    <a href="/manage/reserve/reserve-list.php">예약 관리</a>
                <?  } ?>

			</li>
        <?
            if($_SESSION['MEM_LEVEL'] == "00" ){
        ?>
			<li <?=($page_url[2] == "notice")?"class='active'":""?>>
				<a href="/manage/notice/notice.php">게시판 관리</a>
			</li>
			<li <?=($page_url[2] == "setting")?"class='active'":""?>>
				<a href="/manage/setting/setting-admin.php">설정 관리</a>
			</li>
        <?
            }
        ?>

		</ul>
	</div>
