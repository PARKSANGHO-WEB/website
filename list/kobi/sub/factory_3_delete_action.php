<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$idx = trim(sqlfilter($_REQUEST['idx']));
$bbs_code = "qna";


?>
<?
	$sel_sql2 = "select * from board_content where idx='".$idx."'";
	$sel_res2 = mysqli_query($gconnet,$sel_sql2);
	$sel_row2 = mysqli_fetch_array($sel_res2);
?>

<?
if($_SESSION['member_coinc_id']!=$sel_row2[user_id]){
?>
<SCRIPT LANGUAGE="JavaScript">
	alert('해당글은 작성한 본인만 삭제가 가능합니다.');
	location.href =  history.back();
</SCRIPT>
<?
exit;
}
?>


<?
$sql="delete from board_content where idx='".$idx."' and bbs_code = '".$bbs_code."'";
$res = mysqli_query($gconnet,$sql);

if($res){
?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
		alert('상담실(Q&A)가 완전히 삭제하였습니다.');
		parent.location.href =  "factory_3.php";
	//-->
	</SCRIPT>
	<?}else{?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
		alert('완전삭제중 오류가 발생했습니다.');
	//-->
	</SCRIPT>
	<?}?>