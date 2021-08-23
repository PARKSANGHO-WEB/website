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
$rcpage = trim(sqlfilter($_REQUEST['rcpage']));

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

	$bbs_sql = "SELECT member_idx FROM board_comment where 1 and idx = '".$comment_idx."'";
	$bbs_query = mysqli_query($gconnet,$bbs_sql);
	$bbs_row = mysqli_fetch_array($bbs_query);

	if($_SESSION['member_coinc_idx'] && ($_SESSION['member_coinc_idx'] == $bbs_row['member_idx'])){
	} else {
		error_frame("본인이 작성한 댓글만 수정할 수 있습니다.");
	}

	$query = " update board_comment set "; 
	$query .= " writer = '".$writer."', ";
	$query .= " subject = '".$subject."', ";
	$query .= " content = '".$content."' ";
	$query .= " where 1 and idx = '".$comment_idx."' and board_tbname = '".$board_tbname."' and board_code = '".$board_code."'";

	$result = mysqli_query($gconnet,$query);
?>

	<script>
		alert("수정되었습니다.");
		parent.get_data("<?=$target_link?>","<?=$target_id?>","board_tbname=<?=$board_tbname?>&bbs_code=<?=$board_code?>&product_idx=<?=$board_idx?>&pageNo=<?=$rcpage?>");
	</script>