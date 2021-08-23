<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login_frame.php"; // 관리자 로그인여부 확인?>

<?
/*if(!$_AUTH_WRITE){
	error_frame("본문작성 권한이 없습니다.");
	exit;
}*/

$max = trim(sqlfilter($_REQUEST['max2']));
$flag = trim(sqlfilter($_REQUEST['flag2']));		
$duplicate = trim(sqlfilter($_REQUEST['duplicate2']));										
if($flag == 'N'){
    error_frame('파일을 확인 해 주세요.');
}
if($duplicate == 'N'){
    error_frame('존재하지 않는 사원이 있습니다.');
}

	$query = " update tb_employee set exclude = 'Y' where sano in (select sano from tb_employee_excel where max = '".$max."') and cdx in (select cdx from tb_employee_excel where max = '".$max."') ";
echo $query;
	//echo $query; exit;
	
	$result = mysqli_query($gconnet,$query);

    $query2 = " delete from tb_employee_excel where max = '".$max."' "; 
	
	//echo $query; exit;
	
	$result2 = mysqli_query($gconnet,$query2);

	if($result){
	?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
		alert('등록이 정상적으로 완료 되었습니다.');
        parent.location.href =  "company-people.php?<?=$total_param?>";
	//-->
	</SCRIPT>
	<?}else{
		echo $query; //exit;
		?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('등록중 오류가 발생했습니다.');
	//-->
	</SCRIPT>
	<?}?>