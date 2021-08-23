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
$name = trim(sqlfilter($_REQUEST['name']));										
$content = trim(sqlfilter($_REQUEST['content']));
$ref = trim(sqlfilter($_REQUEST['idx']));
$bkind = trim(sqlfilter($_REQUEST['bkind']));
$pwd = trim(sqlfilter($_REQUEST['pwd']));
$user_ip = trim(sqlfilter($_REQUEST['ip']));
$flag = trim(sqlfilter($_REQUEST['flag']));
$idx2 = trim(sqlfilter($_REQUEST['idx2']));

//에디터 사용 안할때
if($is_html != "Y"){
	$content = strip_tags($content);
	$content = addslashes($content);
}

if($flag != 'Y'){
	$query = " insert into tb_qa set "; 
	$query .= " title = '".$title."', ";
    $query .= " ref = '".$ref."', ";
    $query .= " bkind = '".$bkind."', ";
	$query .= " name = '".$name."', ";
	$query .= " content = '".$content."', ";
    $query .= " user_ip = '".$user_ip."', ";
    $query .= " pwd = '".$pwd."', ";
	$query .= " nows = now() ";

}else if($flag == 'Y'){
    $query = " update tb_qa set "; 
	$query .= " title = '".$title."', ";
    $query .= " ref = '".$ref."', ";
    $query .= " bkind = '".$bkind."', ";
	$query .= " name = '".$name."', ";
	$query .= " content = '".$content."', ";
    $query .= " user_ip = '".$user_ip."', ";
    $query .= " pwd = '".$pwd."', ";
	$query .= " nows = now() ";
    $query .= " where idx = '".$idx2."'";

}
	
	//echo $query; exit;
	
	$result = mysqli_query($gconnet,$query);

	$sql_pre2 = " select idx from tb_qa where 1=1 order by idx desc limit 0,1"; 
	$result_pre2  = mysqli_query($gconnet,$sql_pre2);
	$mem_row2 = mysqli_fetch_array($result_pre2);
    if($flag != 'Y'){
	    $board_idx = $mem_row2[idx]; 
    }else if($flag == 'Y'){
        $board_idx = $idx2;
    }

	################# 첨부파일 업로드 시작 #######################
	
	$_P_DIR_FILE = $_P_DIR_FILE.'qa/';
	$_P_DIR_WEB_FILE = $_P_DIR_WEB_FILE;

	$board_tbname = "tb_qa";
	$board_code = $bbs_code;


	for($file_i=0; $file_i<$_include_board_file_cnt; $file_i++){ // 설정된 갯수만큼 루프 시작

		if ($_FILES['file_'.$file_i]['size']>0){ // 파일이 있다면 업로드한다 시작

			$file_o = $_FILES['file_'.$file_i]['name']; 
			$file_c = uploadFile($_FILES, "file_".$file_i, $_FILES['file_'.$file_i], $_P_DIR_FILE); // 파일 업로드후 변형된 파일이름 리턴.

			$query_file = " update tb_qa set "; 
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
		parent.location.href =  "qna.php?<?=$total_param?>";
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