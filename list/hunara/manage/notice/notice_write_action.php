<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login_frame.php"; // 관리자 로그인여부 확인?>

<?
/*if(!$_AUTH_WRITE){
	error_frame("본문작성 권한이 없습니다.");
	exit;
}*/

$title = trim(sqlfilter($_REQUEST['title']));										
$content = trim(sqlfilter($_REQUEST['content']));
$bkind = trim(sqlfilter($_REQUEST['id']));
$name = $_SESSION['MEM_NAME'];
$user_ip = $_SERVER["REMOTE_ADDR"];

//에디터 사용 안할때
if($is_html != "Y"){
	$content = strip_tags($content);
	$content = addslashes($content);
}

if($bkind == ''){
    error_frame('기업을 선택 해주세요.');
}

	$query = " insert into tb_pds set "; 
	$query .= " title = '".$title."', ";
    $query .= " bkind = '".$bkind."', ";
	$query .= " name = '".$name."', ";
    $query .= " user_ip = '".$user_ip."', ";
	$query .= " content = '".$content."', ";
	$query .= " nows = now() ";
	
	//echo $query; exit;
	
	$result = mysqli_query($gconnet,$query);

	$sql_pre2 = " select idx from tb_pds where 1=1 order by idx desc limit 0,1"; 
	$result_pre2  = mysqli_query($gconnet,$sql_pre2);
	$mem_row2 = mysqli_fetch_array($result_pre2);
	$board_idx = $mem_row2[idx]; 

	################# 첨부파일 업로드 시작 #######################
	
	$_P_DIR_FILE = $_P_DIR_FILE.'pds/';
	$_P_DIR_WEB_FILE = $_P_DIR_WEB_FILE;

	$board_tbname = "tb_pds";
	$board_code = $bbs_code;


	for($file_i=0; $file_i<$_include_board_file_cnt; $file_i++){ // 설정된 갯수만큼 루프 시작

		if ($_FILES['file_'.$file_i]['size']>0){ // 파일이 있다면 업로드한다 시작

			$file_o = $_FILES['file_'.$file_i]['name']; 
			$file_c = uploadFile($_FILES, "file_".$file_i, $_FILES['file_'.$file_i], $_P_DIR_FILE); // 파일 업로드후 변형된 파일이름 리턴.

			$query_file = " update tb_pds set "; 
			$query_file .= " ori_name = '".$file_o."', ";
			$query_file .= " b_file1 = '".$file_c."' ";
			$query_file .= " where idx = '".$board_idx."' ";

			$result_file = mysqli_query($gconnet,$query_file);
		
		} // 파일이 있다면 업로드한다 종료 

	} // 설정된 갯수만큼 루프 종료

	################# 첨부파일 업로드 종료 #######################

	if($result){
	?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
		alert('게시물 등록이 정상적으로 완료 되었습니다.');
		parent.location.href =  "notice.php?<?=$total_param?>";
	//-->
	</SCRIPT>
	<?}else{
		echo $query; //exit;
		?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('게시물 등록중 오류가 발생했습니다.');
	//-->
	</SCRIPT>
	<?}?>