<? include $_SERVER["DOCUMENT_ROOT"]."/report/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
	$pay_str = "만족도조사_정리1_만족도지수";
	$pay_str =  iconv("UTF-8","EUC-KR",$pay_str);
	$filename = $pay_str."_".date("Y-m-d").".xls";

	Header( "Content-type: application/vnd.ms-excel" ); 
	Header( "Content-Disposition: attachment; filename=".$filename ); 
	Header( "Content-Description: PHP4 Generated Data" );

	//$sql_file_0 = "select satisfaction_option_idx,analysis_report_idx from wise_analysis_report_satisfaction_100data where 1 order by idx desc limit 0,1"; 
	
	$satisfaction_option_idx = trim(sqlfilter($_REQUEST['satisfaction_option_idx']));
	$sql_file_0 = "select satisfaction_option_idx,analysis_report_idx from wise_analysis_report_satisfaction_100data where 1 ";
	if($satisfaction_option_idx){
		$sql_file_0 .= " and satisfaction_option_idx='".$satisfaction_option_idx."'";
	}
	$sql_file_0 .= " order by idx desc limit 0,1"; 

	$query_file_0 = mysqli_query($gconnet,$sql_file_0);
	$row_file_0 = mysqli_fetch_array($query_file_0);
	$satisfaction_option_idx = $row_file_0['satisfaction_option_idx']; 
	$analysis_report_idx = $row_file_0['analysis_report_idx'];  

	//$sql_file_1 = "select analysis_report_satisfaction_100data_quiz_no,analysis_report_satisfaction_100data_quiz_title from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_no='1' and analysis_report_satisfaction_100data_quiz_title not in ('고객만족도_상하','충성도_상하','고객충성집단')"; // 문항 

	$sql_file_1 = "select analysis_report_satisfaction_100data_quiz_no,analysis_report_satisfaction_100data_quiz_title from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_no='1' and (analysis_report_satisfaction_100data_quiz_no in (select quiz_no from wise_analysis_quiz where 1 and analysis_idx='".$analysis_report_idx."' and (idx in (select analysis_report_satisfaction_option_group_no from wise_analysis_report_satisfaction_option_group where 1 and satisfaction_option_idx='".$satisfaction_option_idx."') or idx in (select analysis_report_satisfaction_option_factor_no from wise_analysis_report_satisfaction_option_model_quiz where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and  analysis_report_satisfaction_option_factor_type='P'))) or analysis_report_satisfaction_100data_quiz_no is null) and analysis_report_satisfaction_100data_quiz_title not in ('고객만족도_상하','충성도_상하','고객충성집단')"; // 문항 

	$query_file_1 = mysqli_query($gconnet,$sql_file_1);
	$query_file_1_cnt = mysqli_num_rows($query_file_1);

	for($opt_i=0; $opt_i<$query_file_1_cnt; $opt_i++){
		$row_file_1 = mysqli_fetch_array($query_file_1);
		if($opt_i == $query_file_1_cnt-1){
			$file_1_idx .= $row_file_1['analysis_report_satisfaction_100data_quiz_no'];
			$file_1_title .= $row_file_1['analysis_report_satisfaction_100data_quiz_title'];
		} else {
			$file_1_idx .= $row_file_1['analysis_report_satisfaction_100data_quiz_no'].",";
			$file_1_title .= $row_file_1['analysis_report_satisfaction_100data_quiz_title'].",";
		}
	}

	$file_1_idx_arr = explode(",",$file_1_idx);
	$file_1_title_arr = explode(",",$file_1_title);

	$sql_file_2 = "select satisfaction_data_group_idx,analysis_report_satisfaction_data_group2_no,analysis_report_satisfaction_data_group2_title from wise_analysis_report_satisfaction_data_group_detail where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' group by satisfaction_data_group_idx,analysis_report_satisfaction_data_group2_no,analysis_report_satisfaction_data_group2_title order by satisfaction_data_group_idx asc,CONVERT(analysis_report_satisfaction_data_group2_no, UNSIGNED) asc"; // 그룹 데이터 
	//echo "sql_file_2 = ".$sql_file_2."<br>";
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
			<td bgcolor=#CCCCCC></td>
			<td bgcolor=#CCCCCC></td>
		<?
			for($opt_i=0; $opt_i<sizeof($file_1_title_arr); $opt_i++){
				$file_1_title2 = trim($file_1_title_arr[$opt_i]);
		?>
			<td bgcolor=#CCCCCC><font color="#669900"><strong><?=iconv("UTF-8","EUC-KR",$file_1_title2)?></strong></font></td>
		<?}?>
		</tr>
		<?
			for($opt_i=0; $opt_i<$query_file_2_cnt; $opt_i++){
				$row_file_2 = mysqli_fetch_array($query_file_2);

				$sql_file_3 = "select analysis_report_satisfaction_data_group_title from wise_analysis_report_satisfaction_data_group where 1 and idx='".$row_file_2['satisfaction_data_group_idx']."' and satisfaction_option_idx='".$satisfaction_option_idx."'"; 
				$query_file_3 = mysqli_query($gconnet,$sql_file_3);
				$row_file_3 = mysqli_fetch_array($query_file_3);
		?>
			<tr bgcolor=#ffffff align="center" height="22">
				<td>
				<?if($group_title != $row_file_3['analysis_report_satisfaction_data_group_title']){?>
					<?=iconv("UTF-8","EUC-KR",$row_file_3['analysis_report_satisfaction_data_group_title'])?>
				<?}?>
				</td>
				<td><?=$row_file_2['analysis_report_satisfaction_data_group2_no']?>=<?=iconv("UTF-8","EUC-KR",$row_file_2['analysis_report_satisfaction_data_group2_title'])?></td>
				<?
				for($opt2_i=0; $opt2_i<sizeof($file_1_title_arr); $opt2_i++){
					$file_1_idx2 = trim($file_1_idx_arr[$opt2_i]);
					$file_1_title2 = trim($file_1_title_arr[$opt2_i]);
				?>	
					<td><?=iconv("UTF-8","EUC-KR",get_satisfaction_data_group_detail($satisfaction_option_idx,$row_file_2['satisfaction_data_group_idx'],$row_file_2['analysis_report_satisfaction_data_group2_no'],$file_1_idx2,$file_1_title2))?></td>
				<?}?>
			</tr>
		<?
			$group_title = $row_file_3['analysis_report_satisfaction_data_group_title'];
			}
		?>
		</table>