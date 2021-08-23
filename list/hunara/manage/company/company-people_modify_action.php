<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login_frame.php"; // 관리자 로그인여부 확인?>

<?
/*if(!$_AUTH_WRITE){
	error_frame("본문작성 권한이 없습니다.");
	exit;
}*/

$seq = trim(sqlfilter($_REQUEST['seq']));	
$team = trim(sqlfilter($_REQUEST['team']));										
$class = trim(sqlfilter($_REQUEST['class']));
$name = trim(sqlfilter($_REQUEST['name']));
$sano = trim(sqlfilter($_REQUEST['sano']));
$weight = trim(sqlfilter($_REQUEST['weight']));										
$pwd = trim(sqlfilter($_REQUEST['pwd']));
$exclude = trim(sqlfilter($_REQUEST['exclude']));


//에디터 사용 안할때
if($is_html != "Y"){
	$content = strip_tags($content);
	$content = addslashes($content);
}

	$query = " update tb_employee set "; 
	$query .= " team = '".$team."', ";
    $query .= " class = '".$class."', ";
	$query .= " name = '".$name."', ";
    $query .= " sano = '".$sano."', ";
    if($weight){
        $query .= " weight = '".$weight."', ";
    }
	$query .= " pwd = '".$pwd."', ";
    $query .= " exclude = '".$exclude."', ";
	$query .= " wdate = now() ";
    $query .= " where seq = '".$seq."'";
	
	//echo $query; exit;
	
	$result = mysqli_query($gconnet,$query);


	if($result){
	?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
		alert('게시물 수정이 정상적으로 완료 되었습니다.');
		parent.location.href =  "company-people.php?<?=$total_param?>";
	//-->
	</SCRIPT>
	<?}else{
		echo $query; //exit;
		?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('게시물 수정중 오류가 발생했습니다.');
	//-->
	</SCRIPT>
	<?}?>