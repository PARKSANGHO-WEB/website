<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/check_login_frame.php"; ?>
<?
	$member_sect_str = "";
	
	$idx = $_SESSION['member_coinc_idx'];
	$cell = trim(sqlfilter($_REQUEST['cell']));
	$birthday = trim(sqlfilter($_REQUEST['birthday']));
	$gender = trim(sqlfilter($_REQUEST["gender"]));
	$addr1 = trim(sqlfilter($_REQUEST["addr1"]));
	$addr2 = trim(sqlfilter($_REQUEST["addr2"]));
	$addr3 = trim(sqlfilter($_REQUEST["addr3"]));
	$member_password = trim(sqlfilter($_REQUEST["member_password"]));
	$user_pwd = md5($member_password);
	
	$query = " update member_info set ";
	if($_REQUEST["member_password"]){
		$query .= " user_pwd = '".$user_pwd."', ";
	}
	$query .= " addr1 = '".$addr1."', ";
	$query .= " addr2 = '".$addr2."', ";
	$query .= " addr3 = '".$addr3."', ";
	$query .= " cell = '".$cell."', ";
	$query .= " birthday = '".$birthday."', ";
	$query .= " gender = '".$gender."', ";
	$query .= " mdate = now()";
	$query .= " where idx='".$idx."'";
	//echo $query;

	$result = mysqli_query($gconnet,$query);



if($result){
	?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('Modify has been successfully completed.');
	//parent.location.href =  "member_list.php?<?=$total_param?>";
	//parent.location.href =  "../index.php";
	parent.location.href =  "../index.php";
	//-->
	</SCRIPT>
	<?}else{?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('An error occurred during Modify.');
	history.back();
	//-->
	</SCRIPT>
	<?}?>