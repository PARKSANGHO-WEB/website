<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/check_login_frame.php"; ?>
<?
$board_tbname = trim(sqlfilter($_REQUEST['board_tbname']));			
$board_code = trim(sqlfilter($_REQUEST['board_code']));										//bbs_code
$board_idx = trim(sqlfilter($_REQUEST['board_idx']));
$target_link = trim(sqlfilter($_REQUEST['target_link']));
$target_id = trim(sqlfilter($_REQUEST['target_id']));
$comment_idx = trim(sqlfilter($_REQUEST['bbs_idx']));

	$bbs_sql = "SELECT member_idx FROM board_comment where 1 and idx = '".$comment_idx."'";
	$bbs_query = mysqli_query($gconnet,$bbs_sql);
	$bbs_row = mysqli_fetch_array($bbs_query);

	if($_SESSION['member_coinc_idx'] && ($_SESSION['member_coinc_idx'] == $bbs_row['member_idx'])){
	} else {
		error_frame("본인이 작성한 댓글만 삭제할 수 있습니다.");
	}

	// 첨부한 이미지 삭제
	$file_sql = "select file_chg,p_no from board_comment where 1=1 and idx = '".$comment_idx."' and board_tbname = '".$board_tbname."' and board_code = '".$board_code."'";
	$file_query = mysqli_query($gconnet,$file_sql);
	$file_row = mysqli_fetch_array($file_query);
	$file_old_name1 = $file_row['file_chg'];
		
	$_P_DIR_FILE = $_P_DIR_FILE.$bbs_code."/";
	$_P_DIR_FILE2 = $_P_DIR_FILE."img_thumb/";
		
	if($file_old_name1){
		unlink($_P_DIR_FILE.$file_old_name1); // 
		unlink($_P_DIR_FILE2.$file_old_name1); // 원본 작은 섬네일 파일 삭제
	}

	$query = " delete from board_comment "; 
	$query .= " where idx = '".$comment_idx."' and board_tbname = '".$board_tbname."' and board_code = '".$board_code."'";

	//echo $query; exit;

	$result = mysqli_query($gconnet,$query);
?>

	<script>
		alert("삭제되었습니다.");
		parent.get_data("<?=$target_link?>","<?=$target_id?>","board_tbname=<?=$board_tbname?>&bbs_code=<?=$board_code?>&product_idx=<?=$board_idx?>");
	</script>