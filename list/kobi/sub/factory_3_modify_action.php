<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$bbs_code = "qna";

$subject = trim(sqlfilter($_REQUEST['subject']));								//제목
$writer = trim(sqlfilter($_REQUEST['writer']));		
$com_name = trim(sqlfilter($_REQUEST['com_name']));	
$bbs_sect2 = sqlfilter($_REQUEST['bbs_sect2']);

$idx = trim(sqlfilter($_REQUEST['idx']));
$content = trim(sqlfilter($_REQUEST['content']));										//내용
$ip = trim(sqlfilter($_REQUEST['ip']));											//ip
$wdate = date("Y-m-d H:i:s");
$write_time = trim(sqlfilter($_REQUEST['write_time']));

$email = trim(sqlfilter($_REQUEST['email']));	
$cell = trim(sqlfilter($_REQUEST['cell']));	
$attach_count_1 = trim(sqlfilter($_REQUEST['attach_count_1']));
//echo "0:".$attach_count_1."<br>";
	$query = " update board_content set "; 
	$query .= " com_name = '".$com_name."', ";
	$query .= " bbs_sect2 = '".$bbs_sect2."', ";
	$query .= " subject = '".$subject."', ";
	$query .= " content = '".$content."', ";
	$query .= " cell = '".$cell."', ";
	$query .= " modify_time = now()";
	$query .= " where idx='".$idx."' and email='".$email."' and bbs_code='".$bbs_code."'";
	
	$result = mysqli_query($gconnet,$query);
################# 첨부파일 업로드 시작 #######################
	
	$_P_DIR_FILE = $_P_DIR_FILE.$bbs_code."/";
	$_P_DIR_WEB_FILE = $_P_DIR_WEB_FILE.$bbs_code."/";

	$sql_file = "select idx from board_file where 1=1 and board_tbname='board_content' and board_code = '".$bbs_code."' and board_idx='".$idx."' ";
	$query_file = mysqli_query($gconnet,$sql_file);
	$cnt_file = mysqli_num_rows($query_file);

	if($cnt_file < $attach_count_1){
		$cnt_file = $attach_count_1;
	}

	for($file_i=0; $file_i<$cnt_file; $file_i++){ // 설정된 갯수만큼 루프 시작
		$file_idx = trim(sqlfilter($_REQUEST['file_idx_0_'.$file_i])); // 기존 첨부파일 DB PK 값.
		$file_old_name = trim(sqlfilter($_REQUEST['file_old_name_0_'.$file_i])); // 원본 서버파일 이름
		$file_old_org = trim(sqlfilter($_REQUEST['file_old_org_0_'.$file_i]));	// 원본 오리지널 파일 이름
		$del_org = trim(sqlfilter($_REQUEST['del_org_0_'.$file_i]));	// 원본 파일 삭제여부

		if ($_FILES['file0_'.$file_i]['size']>0){ // 파일이 있다면 업로드한다 시작
				
			if($file_old_name){
				unlink($_P_DIR_FILE.$file_old_name); // 원본파일 삭제
			}
			$file_o = $_FILES['file0_'.$file_i]['name']; 
			//echo "file_o:".$file_o."<br>";
			$file_c = uploadFile($_FILES, "file0_".$file_i, $_FILES['file0_'.$file_i], $_P_DIR_FILE); // 파일 업로드후 변형된 파일이름 리턴.
			//echo "file_c:".$file_c."<br>";
		} else { // 파일이 있다면 업로드한다 종료 , 파일이 없을때 시작 
			
			if($file_old_name && $file_old_org){
				$file_c = $file_old_name;
				$file_o = $file_old_org;
			} else {
				$file_c = "";
				$file_o = "";
			}

			if($del_org == "Y"){
				if($file_old_name){
					unlink($_P_DIR_FILE.$file_old_name); // 원본파일 삭제
				}
				$file_c = "";
				$file_o = "";
			}

		} //  파일이 없을때 종료 

		if($file_idx){ // 기존에 첨부파일 DB 에 있던 값
			
			if ($file_o && $file_c){ // 파일이 있으면 업데이트, 없으면 삭제 
				$query_file = " update board_file set "; 
				$query_file .= " file_org = '".$file_o."', ";
				$query_file .= " file_chg = '".$file_c."' ";
				$query_file .= " where 1=1 and idx = '".$file_idx."' ";
				//echo "1:".$query_file;
			} else {
				$query_file = " delete from board_file "; 
				$query_file .= " where 1=1 and idx = '".$file_idx."' ";
				//echo "2:".$query_file;
			}

			$result_file = mysqli_query($gconnet,$query_file);

		} else { // 기존에 첨부파일 DB 에 없던 값 

			$board_tbname = "board_content";
			$board_code = $bbs_code;
			$board_idx = $idx;

			//echo $_FILES['file_'.$file_i]['size']."<br>";
			
			if ($_FILES['file0_'.$file_i]['size']>0){ // 업로드 파일이 있으면 인서트 
			
				$query_file = " insert into board_file set "; 
				$query_file .= " board_tbname = '".$board_tbname."', ";
				$query_file .= " board_code = '".$board_code."', ";
				$query_file .= " board_idx = '".$board_idx."', ";
				$query_file .= " file_org = '".$file_o."', ";
				$query_file .= " file_chg = '".$file_c."' ";
				//echo "3:".$query_file;		
				$result_file = mysqli_query($gconnet,$query_file);
			}
		} // 기존에 첨부파일 DB 에 있었는지 없었는지 모두 종료 
		//echo $query_file."<br>";
	} // 설정된 갯수만큼 루프 종료

	################# 첨부파일 업로드 종료 #######################

if($result){
	?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
		alert('상담실(Q&A) 수정이 정상적으로 완료 되었습니다.');
		parent.location.href =  "factory_3.php";
	//-->
	</SCRIPT>
	<?}else{
		echo $query; //exit;
		?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('상담실(Q&A) 의뢰 수정중 오류가 발생했습니다.');
	//-->
	</SCRIPT>
	<?}?>