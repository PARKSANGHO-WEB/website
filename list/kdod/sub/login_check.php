<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$nation = trim(sqlfilter($_REQUEST['nation']));
$pm_id = trim(sqlfilter($_REQUEST['user_id']));
$pm_pwd = md5(sqlfilter($_REQUEST['user_pwd']));
$reurl_go = trim(sqlfilter($_REQUEST['reurl_go']));
//exit;

//$sql = "select * from member_info where 1 and user_id='".$pm_id."' and member_type='GEN' and nation = '".$nation."'";
$sql = "select * from member_info where 1 and user_id='".$pm_id."' and member_type='GEN' and memout_yn='N' and del_yn='N'";
//echo $sql;
$result = mysqli_query($gconnet,$sql);
//echo "매칭갯수 = ".mysqli_num_rows($result); exit;

if(mysqli_num_rows($result)>0){
		
	$row = mysqli_fetch_array($result);

	//echo "입력한 비번 = ".$_REQUEST['lms_pass']." : 암호화 시킨 비번 = ".$pm_pwd." : DB 의 비번 = ".$row['user_pwd'];
	
	//if($_SERVER['REMOTE_ADDR'] == "121.167.147.150" || $_SERVER['REMOTE_ADDR'] == "59.9.37.47"){
	//} else {
		if(trim($pm_pwd) != trim($row['user_pwd'])){
			echo "<script>";
			echo "alert('Passwords do not match.Please check again and log in!');";
			echo "history.back();";
			echo "</script>";
		}
	//}

	if($row['login_ok'] == "N"){ 
		error_back("You are currently unable to log in. If you have any questions, please contact the administrator.");
	} 

	/*if(trim($nation) != trim($row['nation'])){
		echo "<script>";
		echo "alert('The country you selected and the country you signed up for do not match.');";
		echo "history.back();";
		echo "</script>";
	}*/
	
	$sns_kind = trim(sqlfilter($_REQUEST['sns_kind']));
	$_SESSION['member_coinc_id'] = $pm_id;
	$_SESSION['member_coinc_idx'] = $row['idx'];
	$_SESSION['member_coinc_name'] = $row['user_name'];
	$_SESSION['member_coinc_password'] = $pm_pwd;
			
	if(!$reurl_go){
		$reurl_go = "../index.php";
	}
	?>
	<script type="text/javascript">
	<!--
	parent.location.href="<?=$reurl_go?>";
	//--
	</script>
	<?

} else { 

	echo "<script>";
			echo "alert('There are no matching user accounts. Please check again and log in!');";
			echo "history.back();";
			echo "</script>";
	
}
?>