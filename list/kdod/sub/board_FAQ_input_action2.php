<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // �����Լ� ��Ŭ��� ?>
<?
	$bbs_code = trim(sqlfilter($_REQUEST['bbs_code']));
	$bbs_sect2 = trim(sqlfilter($_REQUEST['bbs_sect2']));
	$writer = trim(sqlfilter($_REQUEST['writer']));
	$product_number = trim(sqlfilter($_REQUEST['product_number']));
	$quantity = trim(sqlfilter($_REQUEST['quantity']));
	$cell = trim(sqlfilter($_REQUEST['cell']));
	$nation = trim(sqlfilter($_REQUEST['nation']));
	$addr1 = trim(sqlfilter($_REQUEST['addr1']));
	$com_name = trim(sqlfilter($_REQUEST['com_name']));
	$email = trim(sqlfilter($_REQUEST['email']));
	$content = trim(sqlfilter($_REQUEST['content']));
	
	$query = " insert into board_content set "; 
	$query .= " bbs_code = '".$bbs_code."',";
	$query .= " user_id = '".$_SESSION['member_coinc_id']."',";
	$query .= " bbs_sect2 = '".$bbs_sect2."',";
	$query .= " writer = '".$writer."',";
	$query .= " product_number = '".$product_number."',";
	$query .= " quantity = '".$quantity."',";
	$query .= " cell = '".$cell."',";
	$query .= " nation = '".$nation."',";
	$query .= " addr1 = '".$addr1."',";
	$query .= " com_name = '".$com_name."',";
	$query .= " email = '".$email."',";
	$query .= " content = '".$content."',";
	$query .= " write_time = now()";

	$result = mysqli_query($gconnet,$query);
	
	$sql_pre2 = " select idx from board_content where 1=1 and bbs_code = '".$bbs_code."' order by idx desc limit 0,1"; 
	$result_pre2  = mysqli_query($gconnet,$sql_pre2);
	$mem_row2 = mysqli_fetch_array($result_pre2);
	$board_idx = $mem_row2[idx]; 

	
	$_P_DIR_FILE = $_P_DIR_FILE.$bbs_code."/";
	$_P_DIR_WEB_FILE = $_P_DIR_WEB_FILE.$bbs_code."/";

	$board_tbname = "board_content";
	$board_code = $bbs_code;

		if ($_FILES['file1']['size']>0){ // ������ �ִٸ� ���ε��Ѵ� ����			
			$file_o = $_FILES['file1']['name']; 
			$file_c = uploadFile($_FILES, "file1", $_FILES['file1'], $_P_DIR_FILE); // ���� ���ε��� ������ �����̸� ����.

			$query_file = " insert into board_file set "; 
			$query_file .= " board_tbname = '".$board_tbname."', ";
			$query_file .= " board_code = '".$board_code."', ";
			$query_file .= " board_idx = '".$board_idx."', ";
			$query_file .= " file_org = '".$file_o."', ";
			$query_file .= " file_chg = '".$file_c."' ";
			$result_file = mysqli_query($gconnet,$query_file);
		} // ������ �ִٸ� ���ε��Ѵ� ���� 

if($result){
	?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('Product Order has been successfully completed.');
	//parent.location.href =  "member_list.php?<?=$total_param?>";
	//parent.location.href =  "../index.php";
	parent.location.href =  "../index.php";
	//-->
	</SCRIPT>
	<?}else{?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('An error occurred during 1:1 Product Order.');
	history.back();
	//-->
	</SCRIPT>
	<?}?>