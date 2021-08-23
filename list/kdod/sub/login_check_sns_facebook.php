<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$pm_id = trim(sqlfilter($_REQUEST['user_id']));
$pm_email = trim(sqlfilter($_REQUEST['user_email']));
$pm_name = trim(sqlfilter($_REQUEST['user_name']));
$sns_kind = trim(sqlfilter($_REQUEST['sns_kind']));
$nation_txt = trim(sqlfilter($_REQUEST['nation_txt']));
$reurl_go = trim(sqlfilter($_REQUEST['reurl_go']));
//exit;

//$sql = "select * from member_info where 1 and user_id='".$pm_id."' and member_type='GEN' and nation = '".$nation."'";
$sql = "select * from member_info where 1 and user_id='".$pm_name."' and email='".$pm_email."' and member_type='GEN' and memout_yn='N' and del_yn='N'";
//echo $sql; exit;
$result = mysqli_query($gconnet,$sql);
//echo "매칭갯수 = ".mysqli_num_rows($result); exit;

if(mysqli_num_rows($result)>0){
		
	$row = mysqli_fetch_array($result);

	if($sns_kind == "fb"){
		
		if($row[user_id] !=""){
			$_SESSION['member_coinc_id'] = $pm_id;
			$_SESSION['member_coinc_idx'] = $row['idx'];
			$_SESSION['member_coinc_name'] = $row[user_name];
		
		if(!$reurl_go){
			$reurl_go = "../index.php";
		}	
	}
	
		/*if(trim($nation) != trim($row['nation'])){
			echo "<script>";
			echo "alert('The country you selected and the country you signed up for do not match.');";
			echo "history.back();";
			echo "</script>";
		}*/
	}
	?>
	<script type="text/javascript">
	<!--
	parent.location.href="<?=$reurl_go?>";
	//--
	</script>
	<?
	exit;
} else { 
		if($row[user_id] ==""){
		if(!$reurl_go){
			//$reurl_go = "./join-add.php?user_id=".$pm_id."$user_name".$pm_name."&sns_kind=".$sns_kind."&nation=".$nation;
			$reurl_go = "./join-add.php?user_id=".$pm_name."&sns_kind=".$sns_kind."&nation_txt=".$nation_txt."&email=".$pm_email."";
		}
	}
	?>
	<script type="text/javascript">
	<!--
	parent.location.href="<?=$reurl_go?>";
	//--
	</script>
<?	
}
?>