<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
	$bbs_code = trim(sqlfilter($_REQUEST['bbs_code']));
	$bbs_sect2 = trim(sqlfilter($_REQUEST['bbs_sect2']));
	$writer = trim(sqlfilter($_REQUEST['writer']));
	$nation = trim(sqlfilter($_REQUEST['nation']));
	$cell = trim(sqlfilter($_REQUEST['cell']));
	$com_name = trim(sqlfilter($_REQUEST['com_name']));
	$email = trim(sqlfilter($_REQUEST['email']));
	$subject = trim(sqlfilter($_REQUEST['subject']));
	$content = trim(sqlfilter($_REQUEST['content']));
	
	$query = " insert into board_content set "; 
	$query .= " bbs_code = '".$bbs_code."',";
	$query .= " user_id = '".$_SESSION['member_coinc_id']."',";
	$query .= " bbs_sect2 = '".$bbs_sect2."',";
	$query .= " writer = '".$writer."',";
	$query .= " nation = '".$nation."',";
	$query .= " cell = '".$cell."',";
	$query .= " com_name = '".$com_name."',";
	$query .= " email = '".$email."',";
	$query .= " subject = '".$subject."',";
	$query .= " content = '".$content."',";
	$query .= " write_time = now()";

	$result = mysqli_query($gconnet,$query);
	
	$sql_pre2 = " select idx from board_content where 1=1 and bbs_code = '".$bbs_code."' order by idx desc limit 0,1"; 
	$result_pre2  = mysqli_query($gconnet,$sql_pre2);
	$mem_row2 = mysqli_fetch_array($result_pre2);
	$board_idx = $mem_row2[idx]; 

	
	$_P_DIR_FILE = $_P_DIR_FILE.$bbs_code."/";
	$_P_DIR_WEB_FILE = $_P_DIR_WEB_FILE.$bbs_code."/";

	$board_tbname = "board_content";
	$board_code = $bbs_code;

		if ($_FILES['file1']['size']>0){ // 파일이 있다면 업로드한다 시작			
			$file_o = $_FILES['file1']['name']; 
			$file_c = uploadFile($_FILES, "file1", $_FILES['file1'], $_P_DIR_FILE); // 파일 업로드후 변형된 파일이름 리턴.

			$query_file = " insert into board_file set "; 
			$query_file .= " board_tbname = '".$board_tbname."', ";
			$query_file .= " board_code = '".$board_code."', ";
			$query_file .= " board_idx = '".$board_idx."', ";
			$query_file .= " file_org = '".$file_o."', ";
			$query_file .= " file_chg = '".$file_c."' ";
			$result_file = mysqli_query($gconnet,$query_file);
		} // 파일이 있다면 업로드한다 종료 

if($result){
	?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('1:1 Inquiry has been successfully completed.');
	//parent.location.href =  "member_list.php?<?=$total_param?>";
	//parent.location.href =  "../index.php";
	parent.location.href =  "../index.php";
	//-->
	</SCRIPT>
	<?}else{?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('An error occurred during 1:1 Inquiry.');
	history.back();
	//-->
	</SCRIPT>
	<?}?>