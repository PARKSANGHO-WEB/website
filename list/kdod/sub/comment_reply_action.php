<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/check_login_frame.php"; ?>
<?
//echo('<pre>'); print_r($_POST); echo('</pre>'); exit;
$total_param = trim(sqlfilter($_REQUEST['total_param']));			
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));	
$board_tbname = trim(sqlfilter($_REQUEST['board_tbname']));			
$board_code = trim(sqlfilter($_REQUEST['board_code']));										//bbs_code
$board_idx = trim(sqlfilter($_REQUEST['board_idx']));

$target_link = trim(sqlfilter($_REQUEST['target_link']));
$target_id = trim(sqlfilter($_REQUEST['target_id']));

$view_idx = trim(sqlfilter($_REQUEST['view_idx']));	 //view_id
$p_no = trim(sqlfilter($_REQUEST['p_no']));	 

$member_idx = trim(sqlfilter($_SESSION['member_coinc_idx']));								//user_id
$view_idx = trim(sqlfilter($_SESSION['member_coinc_idx']));	 //view_id
$passwd = sqlfilter($_REQUEST['passwd']);	

if ($passwd==""){
	$passwd = md5(sqlfilter($_SESSION['member_coinc_password']));	//비밀번호
} else {
	$passwd = md5($passwd);	//비밀번호
}

$subject = trim(sqlfilter($_REQUEST['subject']));								//제목
$writer = trim(sqlfilter($_REQUEST['writer']));									//글쓴이
$content = trim(sqlfilter($_REQUEST['fm_write']));												//내용

if ($writer==""){
	$writer = $_SESSION['member_coinc_name'];
}

	/*$wdate = date("Y-m-d H:i:s");
	$subject = "한줄댓글";

	$query = "insert into _shop_bbs_comment (bbs,bbs_no,member_idx,writer,passwd,subject,content,write_time)  values  (N'".$bbs_code."',N'".$bbs_no."',N'".$member_idx."',N'".$writer."',N'".$passwd."',N'".$subject."',N'".$content."',N'".$wdate."')";*/
	
	//echo $query; 
	
	$_P_DIR_FILE = $_P_DIR_FILE.$board_code."/";
	$_P_DIR_FILE2 = $_P_DIR_FILE."img_thumb/";
	$_P_DIR_WEB_FILE = $_P_DIR_WEB_FILE.$bbs."/";

	################ 사진 이미지 업로드 ##############
	if ($_FILES['file1']['size']>0){
		$file_o = $_FILES['file1']['name']; 
		$i_width = "715";
		$i_height = "400";
		$i_width2 = "";
		$i_height2 = "";
		//$watermark_sect = "imgw";
		$watermark_sect = "";
		$file_c = uploadFileThumb_1($_FILES, "file1", $_FILES['file1'], $_P_DIR_FILE,$i_width,$i_height,$i_width2,$i_height2,$watermark_sect);
		
		//echo "file_c = ".$file_c."<br>";
		
		$image_true = upload_img_type($_P_DIR_FILE.$file_c);
		
		if(!$image_true){
			
			//echo "file_c = ".$file_c."<br>";
			if(is_file($_P_DIR_FILE.$file_c)) {

				unlink($_P_DIR_FILE.$file_c); // 이미지 파일이 아니면 원본파일을 삭제한다. 
				unlink($_P_DIR_FILE2.$file_c); // 원본 섬네일 파일도 삭제한다.
			
			}

			error_frame("이미지 파일만 등록해주세요.");
			exit;
		}
		
	}

$max_query = "select ref,step,depth from board_comment where 1=1 and idx = '".$p_no."' ";
$max_result = mysqli_query($gconnet,$max_query);
$max_row = mysqli_fetch_array($max_result);

$ref = $max_row[ref];
$step = $max_row[step];
$depth = $max_row[depth];

$reply_query = "update board_comment set step=(step+1) where board_code='".$board_code."' and ref=".$ref." and step>".$step;
mysqli_query($gconnet,$reply_query);

if ($step ==0){
	$step = 1;
} else {
	$step = $step+1;
}

$depth = $depth +1;

	$query = " insert into board_comment set "; 
	$query .= " board_tbname = '".$board_tbname."', ";
	$query .= " board_code = '".$board_code."', ";
	$query .= " board_idx = '".$board_idx."', ";
	$query .= " member_idx = '".$member_idx."', ";
	$query .= " view_idx = '".$view_idx."', ";
	
	$query .= " p_no = '".$p_no."', ";
	$query .= " ref = '".$max."', ";
	$query .= " step = '".$step."', ";
	$query .= " depth = '".$depth."', ";

	$query .= " writer = '".$writer."', ";
	$query .= " passwd = '".$passwd."', ";
	$query .= " subject = '".$subject."', ";
	$query .= " file_org = '".$file_o."', ";
	$query .= " file_chg = '".$file_c."', ";
	$query .= " content = '".$content."', ";
	$query .= " write_time = now() ";

	//echo $query; exit;
	
	$result = mysqli_query($gconnet,$query);

?>

	<script>
		alert("등록되었습니다.");
		$("#fm_write_<?=$p_no?>", parent.document).val("");
		parent.get_data("<?=$target_link?>","<?=$target_id?>","<?=$total_param?>&pageNo=<?=$pageNo?>");
	</script>
