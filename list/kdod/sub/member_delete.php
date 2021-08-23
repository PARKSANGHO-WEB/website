<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // �����Լ� ��Ŭ��� ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/check_login_frame.php"; ?>
<?
				
		$idx = trim(sqlfilter($_REQUEST['idx']));
		$user_pwd = md5(sqlfilter($_REQUEST['user_pwd']));
		$user_id = trim(sqlfilter($_REQUEST['user_id']));

		$member_idx = $_SESSION['member_coinc_idx'];
		$idx = $_SESSION['member_coinc_idx'];

		$sql = "select * from member_info where 1 and user_id='".$user_id."' and member_type='GEN'";
		$result = mysqli_query($gconnet,$sql);

		$sql2 = "delete from member_register_survey where 1 and member_idx='".$member_idx."'";
		$result2 = mysqli_query($gconnet,$sql2);

		$sql3 = "delete from member_point where 1 and member_idx='".$member_idx."'";
		$result3 = mysqli_query($gconnet,$sql3);

		$sql4 = "delete from member_no_save where 1 and member_idx='".$member_idx."'";
		$result4 = mysqli_query($gconnet,$sql4);

if(mysqli_num_rows($result)>0){
		
	$row = mysqli_fetch_array($result);
	
	/*if(trim($user_pwd) != trim($row['user_pwd'])){
			echo "<script>";
			echo "alert('Passwords do not match.Please check again and member out!');";
			echo "history.back();";
			echo "</script>";
	}*/

		$query = " update member_info set "; 
		$query .= " memout_yn = 'Y', ";
		$query .= " out_m_date = now() ";
		$query .= " where idx='".$idx."' ";
		mysqli_query($gconnet,$query);

?>
<script type="text/javascript">
<!--
parent.location.href="logout.php";	
</script>
<?
} else { 
			echo "<script>";
			echo "alert('There are no matching user password. Please check again and member info!');";
			echo "history.back();";
			echo "</script>";
}
?>