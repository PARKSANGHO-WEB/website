<? include $_SERVER["DOCUMENT_ROOT"]."/report/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
	$pay_str = "의사결정모델_개인별AHP값(고유치법)";
	$pay_str =  iconv("UTF-8","EUC-KR",$pay_str);
	$filename = $pay_str."_".date("Y-m-d").".xls";

	Header( "Content-type: application/vnd.ms-excel" ); 
	Header( "Content-Disposition: attachment; filename=".$filename ); 
	Header( "Content-Description: PHP4 Generated Data" );
	
	//$sql_file_0 = "select decision_option_idx from wise_analysis_report_decision_100data where 1 order by idx desc limit 0,1"; // 문항 

	$decision_option_idx = trim(sqlfilter($_REQUEST['decision_option_idx']));
	$sql_file_0 = "select decision_option_idx,analysis_report_idx from wise_analysis_report_decision_100data where 1 ";
	if($decision_option_idx){
		$sql_file_0 .= " and decision_option_idx='".$decision_option_idx."'";
	}
	$sql_file_0 .= " order by idx desc limit 0,1"; 

	$query_file_0 = mysqli_query($gconnet,$sql_file_0);
	$row_file_0 = mysqli_fetch_array($query_file_0);
	$decision_option_idx = $row_file_0['decision_option_idx'];  
	
	// 표본특성문항 
	/*$sql_file_1 = "select *,(select quiz_no from wise_analysis_quiz where 1 and idx=wise_analysis_report_decision_option_group.analysis_report_decision_option_group_no) as quiz_no from wise_analysis_report_decision_option_group where 1 and decision_option_idx='".$decision_option_idx."' order by idx asc";
	$query_file_1 = mysqli_query($gconnet,$sql_file_1);
	$query_file_1_cnt = mysqli_num_rows($query_file_1);

	for($opt_i=0; $opt_i<$query_file_1_cnt; $opt_i++){ 
		$row_file_1 = mysqli_fetch_array($query_file_1);
		if($opt_i == $query_file_1_cnt-1){
			$file_1_idx .= $row_file_1['idx'];
			$file_1_quizno .= $row_file_1['quiz_no'];
			$file_1_title .= $row_file_1['analysis_report_decision_option_group_title'];
		} else {
			$file_1_idx .= $row_file_1['idx'].",";
			$file_1_quizno .= $row_file_1['quiz_no'].",";
			$file_1_title .= $row_file_1['analysis_report_decision_option_group_title'].",";
		}
	}*/

	$sql_file_1 = "select analysis_report_decision_100data_quiz_no as quiz_no,analysis_report_decision_100data_quiz_title as quiz_title from wise_analysis_report_decision_100data_detail where 1 and decision_option_idx='".$decision_option_idx."' and analysis_report_decision_100data_no='1' order by analysis_report_decision_100data_quiz_no asc";
	$query_file_1 = mysqli_query($gconnet,$sql_file_1);
	$query_file_1_cnt = mysqli_num_rows($query_file_1);

	for($opt_i=0; $opt_i<$query_file_1_cnt; $opt_i++){ 
		$row_file_1 = mysqli_fetch_array($query_file_1);
		if($opt_i == $query_file_1_cnt-1){
			$file_1_quizno .= $row_file_1['quiz_no'];
			$file_1_title .= $row_file_1['quiz_title'];
		} else {
			$file_1_quizno .= $row_file_1['quiz_no'].",";
			$file_1_title .= $row_file_1['quiz_title'].",";
		}
	}
	$file_1_quizno_arr = explode(",",$file_1_quizno);
	$file_1_title_arr = explode(",",$file_1_title);

	//분석모델설정 테이블
	$sql_file_2 = "select *,(select quiz_no from wise_analysis_quiz where 1 and idx=wise_analysis_report_decision_option_model_quiz.analysis_report_decision_option_model_quiz_no) as quiz_no from wise_analysis_report_decision_option_model_quiz where 1 and decision_option_idx='".$decision_option_idx."' order by idx asc";
	$query_file_2 = mysqli_query($gconnet,$sql_file_2);
	$query_file_2_cnt = mysqli_num_rows($query_file_2);

	for($opt_i=0; $opt_i<$query_file_2_cnt; $opt_i++){ 
		$row_file_2 = mysqli_fetch_array($query_file_2);
		if($opt_i == $query_file_2_cnt-1){
			$file_2_idx .= $row_file_2['idx'];
			$file_2_quizno .= $row_file_2['quiz_no'];
			$file_2_title .= $row_file_2['analysis_report_decision_option_model_quiz_title'];
		} else {
			$file_2_idx .= $row_file_2['idx'].",";
			$file_2_quizno .= $row_file_2['quiz_no'].",";
			$file_2_title .= $row_file_2['analysis_report_decision_option_model_quiz_title'].",";
		}
	}
	$file_2_idx_arr = explode(",",$file_2_idx);
	$file_2_quizno_arr = explode(",",$file_2_quizno);
	$file_2_title_arr = explode(",",$file_2_title);

	$sql_file_2 = "select distinct(analysis_report_decision_100data_no) as data_no from wise_analysis_report_decision_100data_detail where 1 and decision_option_idx='".$decision_option_idx."' order by analysis_report_decision_100data_no asc";
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
			<!--<td bgcolor=#CCCCCC><font color="#669900"><strong><?=iconv("UTF-8","EUC-KR","총점")?></strong></font></td>
			<td bgcolor=#CCCCCC><font color="#669900"><strong><?=iconv("UTF-8","EUC-KR","등급")?></strong></font></td>
			<td bgcolor=#CCCCCC><font color="#669900"><strong><?=iconv("UTF-8","EUC-KR","순위")?></strong></font></td>-->
		</tr>
		<?
			for($opt_i=0; $opt_i<$query_file_2_cnt; $opt_i++){
				$row_file_2 = mysqli_fetch_array($query_file_2);
				$data_no = $row_file_2['data_no'];
		?>
			<tr bgcolor=#ffffff align="center" height="22">
				<td><?=$data_no?></td>
				<?
				for($opt2_i=0; $opt2_i<sizeof($file_1_title_arr); $opt2_i++){
					/*$file_1_idx2 = trim($file_1_idx_arr[$opt2_i]);
					$file_1_group2 = trim($file_1_group_arr[$opt2_i]);
					$file_1_title2 = trim($file_1_title_arr[$opt2_i]);*/

					$file_1_quizno = trim($file_1_quizno_arr[$opt2_i]);
				?>	
					<td><?=iconv("UTF-8","EUC-KR",get_decision_100data_no_val($decision_option_idx,$data_no,$file_1_quizno,$file_1_idx2,$file_1_group2,$file_1_title2))?></td>
				<?}?>
					<!--<td><?//=iconv("UTF-8","EUC-KR",get_decision_100data_tlc_val($decision_option_idx,$data_no,"analysis_report_decision_100data_total"))?></td>
					<td><?//=iconv("UTF-8","EUC-KR",get_decision_100data_tlc_val($decision_option_idx,$data_no,"analysis_report_decision_option_level_title"))?></td>
					<td><?//=iconv("UTF-8","EUC-KR",get_decision_100data_tlc_val($decision_option_idx,$data_no,"analysis_report_decision_100data_count"))?></td>-->
			</tr>
		<?}?>
		</table>
