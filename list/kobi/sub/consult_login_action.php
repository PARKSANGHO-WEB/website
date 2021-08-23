<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$bbs_code = trim(sqlfilter($_REQUEST['bbs_code']));
$member_idx = trim(sqlfilter($_SESSION['member_coinc_idx']));								//user_id
$view_idx = trim(sqlfilter($_SESSION['member_coinc_idx']));	 //view_id
$subject = trim(sqlfilter($_REQUEST['subject']));								//제목
$writer = trim(sqlfilter($_REQUEST['writer']));		
$com_name = trim(sqlfilter($_REQUEST['com_name']));	
$bbs_sect2 = sqlfilter($_REQUEST['bbs_sect2']);

$content = trim(sqlfilter($_REQUEST['content']));										//내용
$ip = trim(sqlfilter($_REQUEST['ip']));											//ip
$wdate = date("Y-m-d H:i:s");
$write_time = trim(sqlfilter($_REQUEST['write_time']));

$email = trim(sqlfilter($_REQUEST['email']));	
$cell = trim(sqlfilter($_REQUEST['cell']));	



$user_id = $_SESSION['member_coinc_id'];
$view_id = $_SESSION['member_coinc_id'];

	$query = " insert into board_content set "; 
	$query .= " member_idx = '".$member_idx."', ";
	$query .= " view_idx = '".$view_idx."', ";
	$query .= " user_id = '".$user_id."', ";
	$query .= " view_id = '".$view_id."', ";
	$query .= " bbs_code = '".$bbs_code."', ";
	$query .= " com_name = '".$com_name."', ";
	$query .= " bbs_sect2 = '".$bbs_sect2."', ";
	$query .= " subject = '".$subject."', ";
	$query .= " writer = '".$writer."', ";
	$query .= " content = '".$content."', ";
	$query .= " bbs_sect4= '접수', ";
	$query .= " email = '".$email."', ";
	$query .= " cell = '".$cell."', ";
	$query .= " ip = '".$ip."', ";
	$query .= " write_time = now()";
	
	$result = mysqli_query($gconnet,$query);

	$sql_pre2 = " select idx from board_content where 1=1 and bbs_code = '".$bbs_code."' order by idx desc limit 0,1"; 
	$result_pre2  = mysqli_query($gconnet,$sql_pre2);
	$mem_row2 = mysqli_fetch_array($result_pre2);
	$board_idx = $mem_row2[idx]; 

	################# 첨부파일 업로드 시작 #######################
	
	$_P_DIR_FILE = $_P_DIR_FILE.$bbs_code."/";
	$_P_DIR_WEB_FILE = $_P_DIR_WEB_FILE.$bbs_code."/";

	$board_tbname = "board_content";
	$board_code = $bbs_code;

	for($file_i=0; $file_i<1; $file_i++){ // 설정된 갯수만큼 루프 시작

		if ($_FILES['file_'.$file_i]['size']>0){ // 파일이 있다면 업로드한다 시작
			
			if($bbs_code == "data_list"){
				$file_o = $_FILES['file_'.$file_i]['name']; 
				if($file_i==0){
				$i_width = "258";
				$i_height = "199";
				}else if($file_i==1){
				$i_width = "1920";
				$i_height = "1277";	
				}
				$i_width2 = "";
				$i_height2 = "";
				$file_c = uploadFileThumb_1($_FILES, "file_".$file_i, $_FILES['file_'.$file_i], $_P_DIR_FILE,$i_width,$i_height,$i_width2,$i_height2,$watermark_sect);
			} else {
				$file_o = $_FILES['file_'.$file_i]['name']; 
				$file_c = uploadFile($_FILES, "file_".$file_i, $_FILES['file_'.$file_i], $_P_DIR_FILE); // 파일 업로드후 변형된 파일이름 리턴.
			}

			$query_file = " insert into board_file set "; 
			$query_file .= " board_tbname = '".$board_tbname."', ";
			$query_file .= " board_code = '".$board_code."', ";
			$query_file .= " board_idx = '".$board_idx."', ";
			$query_file .= " file_org = '".$file_o."', ";
			$query_file .= " file_chg = '".$file_c."' ";

			$result_file = mysqli_query($gconnet,$query_file);
		
		} // 파일이 있다면 업로드한다 종료 

	} // 설정된 갯수만큼 루프 종료

	################# 첨부파일 업로드 종료 #######################


if($result){
	?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
		alert('컨설팅 의뢰 등록이 정상적으로 완료 되었습니다.');
		parent.location.href =  "factory_1.php";
	//-->
	</SCRIPT>
	<?}else{
		echo $query; //exit;
		?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('컨설팅 의뢰 등록중 오류가 발생했습니다.');
	//-->
	</SCRIPT>
	<?}?>