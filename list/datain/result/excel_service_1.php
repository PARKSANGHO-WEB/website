<? include $_SERVER["DOCUMENT_ROOT"]."/report/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
	$pay_str = "서비스평가모댈_점수변환(100점예시)_총점&등급산출";
	$pay_str =  iconv("UTF-8","EUC-KR",$pay_str);
	$filename = $pay_str."_".date("Y-m-d").".xls";

	Header( "Content-type: application/vnd.ms-excel" ); 
	Header( "Content-Disposition: attachment; filename=".$filename ); 
	Header( "Content-Description: PHP4 Generated Data" );
	
	//$sql_file_0 = "select service_option_idx from wise_analysis_report_service_100data where 1 order by idx desc limit 0,1"; // 문항 

	$service_option_idx = trim(sqlfilter($_REQUEST['service_option_idx']));
	$sql_file_0 = "select service_option_idx,analysis_report_idx from wise_analysis_report_service_100data where 1 ";
	if($service_option_idx){
		$sql_file_0 .= " and service_option_idx='".$service_option_idx."'";
	}
	$sql_file_0 .= " order by idx desc limit 0,1"; 

	$query_file_0 = mysqli_query($gconnet,$sql_file_0);
	$row_file_0 = mysqli_fetch_array($query_file_0);
	$service_option_idx = $row_file_0['service_option_idx'];  
	
	$sql_file_1 = "select analysis_report_service_100data_quiz_no,analysis_report_service_100data_quiz_title,analysis_report_service_100data_group_no from wise_analysis_report_service_100data_detail where 1 and service_option_idx='".$service_option_idx."' and analysis_report_service_100data_no='1'"; // 문항 
	$query_file_1 = mysqli_query($gconnet,$sql_file_1);
	$query_file_1_cnt = mysqli_num_rows($query_file_1);

	for($opt_i=0; $opt_i<$query_file_1_cnt; $opt_i++){
		$row_file_1 = mysqli_fetch_array($query_file_1);
		
		$quiz_no = $row_file_1['analysis_report_service_100data_quiz_no'];
		$group_no = $row_file_1['analysis_report_service_100data_group_no'];
		if($row_file_1['analysis_report_service_100data_group_no']){
			$quiz_title = "집단구분 - ".$row_file_1['analysis_report_service_100data_quiz_title'];
		} else {
			$quiz_title = $row_file_1['analysis_report_service_100data_quiz_title'];
		}

		if($opt_i == $query_file_1_cnt-1){
			$file_1_idx .= $quiz_no;
			$file_1_group .= $group_no;
			$file_1_title .= $quiz_title;
		} else {
			$file_1_idx .= $quiz_no.",";
			$file_1_group .= $group_no.",";
			$file_1_title .= $quiz_title.",";
		}
	}

	$file_1_idx_arr = explode(",",$file_1_idx);
	$file_1_group_arr = explode(",",$file_1_group);
	$file_1_title_arr = explode(",",$file_1_title);

	$sql_file_2 = "select analysis_report_service_100data_no from wise_analysis_report_service_100data_tlc where 1 and service_option_idx='".$service_option_idx."' order by analysis_report_service_100data_count desc";
	$query_file_2 = mysqli_query($gconnet,$sql_file_2);
	$query_file_2_cnt = mysqli_num_rows($query_file_2);
?>
	<head>
			<meta http-equiv=Content-Type content="text/html; charset=ks_c_5601-1987">
			<style>
			<!--
				br{mso-data-placement:same-cell;}
			-->
			</style>
		</head>
			
		<table border width="100%">
		<tr align="center">
			<td bgcolor=#CCCCCC><font color="#669900"><strong><?=iconv("UTF-8","EUC-KR","NO")?></strong></font></td>
		<?
			for($opt_i=0; $opt_i<sizeof($file_1_title_arr); $opt_i++){
				$file_1_title2 = trim($file_1_title_arr[$opt_i]);
		?>
			<td bgcolor=#CCCCCC><font color="#669900"><strong><?=iconv("UTF-8","EUC-KR",$file_1_title2)?><?//=$file_1_title2?></strong></font></td>
		<?}?>
			<td bgcolor=#CCCCCC><font color="#669900"><strong><?=iconv("UTF-8","EUC-KR","총점")?></strong></font></td>
			<td bgcolor=#CCCCCC><font color="#669900"><strong><?=iconv("UTF-8","EUC-KR","등급")?></strong></font></td>
			<td bgcolor=#CCCCCC><font color="#669900"><strong><?=iconv("UTF-8","EUC-KR","순위")?></strong></font></td>
		</tr>
		<?
			for($opt_i=0; $opt_i<$query_file_2_cnt; $opt_i++){
				$row_file_2 = mysqli_fetch_array($query_file_2);
				$data_no = $row_file_2['analysis_report_service_100data_no'];
		?>
			<tr bgcolor=#ffffff align="center" height="22">
				<td><?=$row_file_2['analysis_report_service_100data_no']?></td>
				<?
				for($opt2_i=0; $opt2_i<sizeof($file_1_title_arr); $opt2_i++){
					$file_1_idx2 = trim($file_1_idx_arr[$opt2_i]);
					$file_1_group2 = trim($file_1_group_arr[$opt2_i]);
					$file_1_title2 = trim($file_1_title_arr[$opt2_i]);
				?>	
					<td><?=iconv("UTF-8","EUC-KR",get_service_100data_no_val($service_option_idx,$data_no,$file_1_idx2,$file_1_group2,$file_1_title2))?></td>
				<?}?>
					<td><?=iconv("UTF-8","EUC-KR",get_service_100data_tlc_val($service_option_idx,$data_no,"analysis_report_service_100data_total"))?></td>
					<td><?=iconv("UTF-8","EUC-KR",get_service_100data_tlc_val($service_option_idx,$data_no,"analysis_report_service_option_level_title"))?></td>
					<td><?=iconv("UTF-8","EUC-KR",get_service_100data_tlc_val($service_option_idx,$data_no,"analysis_report_service_100data_count"))?></td>
			</tr>
		<?}?>
		</table>
