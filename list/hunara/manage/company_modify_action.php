<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login_frame.php"; // 관리자 로그인여부 확인?>

<?
/*if(!$_AUTH_WRITE){
	error_frame("본문작성 권한이 없습니다.");
	exit;
}*/

$cdomain = trim(sqlfilter($_REQUEST['domain']));
$comname = trim(sqlfilter($_REQUEST['company']));										
$co_password = trim(sqlfilter($_REQUEST['password']));
$dname = trim(sqlfilter($_REQUEST['name']));

$tel1 = trim(sqlfilter($_REQUEST['tel1']));
$tel2 = trim(sqlfilter($_REQUEST['tel2']));
$tel3 = trim(sqlfilter($_REQUEST['tel3']));
$tel = $tel1.'-'.$tel2.'-'.$tel3;

$hp1 = trim(sqlfilter($_REQUEST['phone1']));
$hp2 = trim(sqlfilter($_REQUEST['phone2']));
$hp3 = trim(sqlfilter($_REQUEST['phone3']));
$hp = $hp1.'-'.$hp2.'-'.$hp3;

$email1 = trim(sqlfilter($_REQUEST['email1']));
$email2 = trim(sqlfilter($_REQUEST['email2']));
$email = $email1.'@'.$email2;

$able_dangchum_cnt = trim(sqlfilter($_REQUEST['winning']));
$chk_jumin = trim(sqlfilter($_REQUEST['membernum']));


	$query = " update tb_company set "; 
	$query .= " cdomain = '".$cdomain."', ";
    $query .= " comname = '".$comname."', ";
	$query .= " co_password = '".$co_password."', ";
    $query .= " dname = '".$dname."', ";
	$query .= " tel = '".$tel."', ";
    $query .= " hp = '".$hp."', ";
	$query .= " email = '".$email."', ";
    $query .= " able_dangchum_cnt = '".$able_dangchum_cnt."', ";
	$query .= " chk_jumin = '".$chk_jumin."', ";
	$query .= " wdate = now() ";
	
	//echo $query; exit;
	
	$result = mysqli_query($gconnet,$query);

	$sql_pre2 = " select idx from tb_company where 1=1 order by idx desc limit 0,1"; 
	$result_pre2  = mysqli_query($gconnet,$sql_pre2);
	$mem_row2 = mysqli_fetch_array($result_pre2);
	$board_idx = $mem_row2[idx]; 

	################# 첨부파일 업로드 시작 #######################
	
	$_P_DIR_FILE = $_P_DIR_FILE.'comlogo/';
	$_P_DIR_WEB_FILE = $_P_DIR_WEB_FILE;


	for($file_i=0; $file_i<$_include_board_file_cnt; $file_i++){ // 설정된 갯수만큼 루프 시작

		if ($_FILES['file_'.$file_i]['size']>0){ // 파일이 있다면 업로드한다 시작

			$file_o = $_FILES['file_'.$file_i]['name']; 
			$file_c = uploadFile($_FILES, "file_".$file_i, $_FILES['file_'.$file_i], $_P_DIR_FILE); // 파일 업로드후 변형된 파일이름 리턴.
            $file_d = $file_o."_".date("YmdHis");

			$query_file = " update tb_company set "; 
			$query_file .= " comimg = '".$file_d."' ";
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
		parent.location.href =  "company.php?<?=$total_param?>";
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