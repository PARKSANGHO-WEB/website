<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$pm_id = trim(sqlfilter($_REQUEST['user_id']));
$pm_name = trim(sqlfilter($_REQUEST['user_name']));
$sns_kind = trim(sqlfilter($_REQUEST['sns_kind']));

$reurl_go = trim(sqlfilter($_REQUEST['reurl_go']));
//exit;

$sql = "select * from member_info where 1 and user_id='".$pm_id."' and member_type='GEN'";
//echo $sql;
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
			$reurl_go = "../main.php";
		}	
	}
	}
	?>
	<script type="text/javascript">
	<!--
	parent.location.href="<?=$reurl_go?>";
	//--
	</script>
	<?

} else { 
		if($row[user_id] ==""){
		if(!$reurl_go){
		$reurl_go = "./join.php?user_id=".$pm_id."$user_name".$pm_name."&sns_kind=".$sns_kind;
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