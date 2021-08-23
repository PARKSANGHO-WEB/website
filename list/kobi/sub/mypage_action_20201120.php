<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

	
	$user_pwd = trim(sqlfilter($_REQUEST['user_pwd']));
	$user_pwd2 = md5($user_pwd);
	$cell = trim(sqlfilter($_REQUEST['cell1'])).'-'.trim(sqlfilter($_REQUEST['cell2'])).'-'.trim(sqlfilter($_REQUEST['cell3']));
	
	$com_name = trim(sqlfilter($_REQUEST['com_name']));
	$jobposition = trim(sqlfilter($_REQUEST['jobposition']));
	$consult = trim(sqlfilter($_REQUEST['consult']));
	$com_addr = trim(sqlfilter($_REQUEST['com_addr']));

	$sel_sql = "select * from member_info where user_id = '".$_SESSION['member_coinc_id']."' and user_pwd = '".$_SESSION['member_coinc_password']."'";
	$sel_res =	mysqli_query($gconnet,$sel_sql);
	$sel_row =  mysqli_fetch_array($sel_res);
	



	if($user_pwd){
			$query = " update member_info set "; 
			$query .= " user_pwd = '".$user_pwd2."', ";
			$query .= " cell = '".$cell."', ";
			$query .= " com_name = '".$com_name."', ";
			$query .= " jobposition = '".$jobposition."', ";
			$query .= " consult = '".$consult."', ";
			$query .= " com_addr = '".$com_addr."', ";
			$query .= " mdate = now() ";
			$query .= " where user_id = '".$_SESSION['member_coinc_id']."' ";
			$result = mysqli_query($gconnet,$query);

	}else if(!$user_pwd){
			$query = " update member_info set "; 
			$query .= " cell = '".$cell."', ";
			$query .= " com_name = '".$com_name."', ";
			$query .= " jobposition = '".$jobposition."', ";
			$query .= " consult = '".$consult."', ";
			$query .= " com_addr = '".$com_addr."', ";
			$query .= " mdate = now() ";
			$query .= " where user_id = '".$_SESSION['member_coinc_id']."' ";
			$result = mysqli_query($gconnet,$query);

	}
	

	if($result){
	?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('수정이 정상적으로 완료 되었습니다.');
	//parent.location.href =  "member_list.php?<?=$total_param?>";
	parent.location.href =  "../main.php";
	//-->
	</SCRIPT>
	<?}else{?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('수정중 오류가 발생했습니다.');
	//-->
	</SCRIPT>
	<?}?>
 