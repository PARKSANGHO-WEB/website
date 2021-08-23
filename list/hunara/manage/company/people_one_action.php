<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login_frame.php"; // 관리자 로그인여부 확인?>

<?
/*if(!$_AUTH_WRITE){
	error_frame("본문작성 권한이 없습니다.");
	exit;
}*/

$team = trim(sqlfilter($_REQUEST['team']));										
//$wdate = trim(sqlfilter($_REQUEST['wdate']));
$cdx = trim(sqlfilter($_REQUEST['id']));
$class = trim(sqlfilter($_REQUEST['class']));										
$name = trim(sqlfilter($_REQUEST['name']));
$sano = trim(sqlfilter($_REQUEST['sano']));
$weight = trim(sqlfilter($_REQUEST['weight']));
$digit7 = trim(sqlfilter($_REQUEST['digit7']));


$hp1 = trim(sqlfilter($_REQUEST['hp1']));
$hp2 = trim(sqlfilter($_REQUEST['hp2']));
$hp3 = trim(sqlfilter($_REQUEST['hp3']));

$hp = $hp1.'-'.$hp2.'-'.$hp3;

$tel1 = trim(sqlfilter($_REQUEST['tel1']));
$tel2 = trim(sqlfilter($_REQUEST['tel2']));
$tel3 = trim(sqlfilter($_REQUEST['tel3']));

$tel = $tel1.'-'.$tel2.'-'.$tel3;

$email1 = trim(sqlfilter($_REQUEST['email1']));
$email2 = trim(sqlfilter($_REQUEST['email2']));

$email = $email1.'@'.$email2;

$sql_pre2 = " select sano from tb_employee where 1=1 and sano = '".$sano."' and cdx = '".$cdx."' order by seq desc limit 0,1"; 
$result_pre2  = mysqli_query($gconnet,$sql_pre2);
$mem_row2 = mysqli_fetch_array($result_pre2);


if($mem_row2[sano]){
	error_frame('현재 존재하는 사원번호입니다.');
}

//에디터 사용 안할때
if($is_html != "Y"){
	$content = strip_tags($content);
	$content = addslashes($content);
}

if($cdx == ''){
    error_frame('기업을 선택 해주세요.');
}

	$query = " insert into tb_employee set "; 
	$query .= " team = '".$team."', ";
    $query .= " name = '".$name."', ";
	$query .= " cdx = '".$cdx."', ";
	$query .= " class = '".$class."', ";
    $query .= " sano = '".$sano."', ";
    if($weight){
	    $query .= " weight = '".$weight."', ";
    }
	$query .= " digit7 = '".$digit7."', ";
	$query .= " hp = '".$hp."', ";
	$query .= " tel = '".$tel."', ";
	$query .= " email = '".$email."', ";
	$query .= " wdate = now() ";
	
	//echo $query; exit;
	
	$result = mysqli_query($gconnet,$query);

	if($result){
	?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
		alert('사원 등록이 정상적으로 완료 되었습니다.');
		parent.location.href =  "company-people.php?<?=$total_param?>";
	//-->
	</SCRIPT>
	<?}else{
		echo $query; //exit;
		?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('사원 등록중 오류가 발생했습니다.');
	//-->
	</SCRIPT>
	<?}?>