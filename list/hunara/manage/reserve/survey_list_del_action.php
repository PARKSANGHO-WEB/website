<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
	$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
	$total_param = trim(sqlfilter($_REQUEST['total_param']));

	$promotion_idx = $_REQUEST['survey'];
	$idx = $_REQUEST['idx'];

        $query = " update tb_survey set ";
        $query .= " del_yn = 'Y' ";
        $query .= " where 1 and sidx in (".$idx.") ";
        $result =  mysqli_query($gconnet,$query);

		$query2 = " update tb_survey_question set ";
        $query2 .= " del_yn = 'Y' ";
		$query2 .= " where 1 and sidx in (".$idx.") ";
		$result2 =  mysqli_query($gconnet,$query2);

        $query3 = " update tb_survey_choice set ";
        $query3 .= " del_yn = 'Y' ";
		$query3 .= " where 1 and sidx in (".$idx.") ";
		$result3 =  mysqli_query($gconnet,$query3);

        $query4 = " update tb_survey_answer set ";
        $query4 .= " del_yn = 'Y' ";
		$query4 .= " where 1 and sidx in (".$idx.") ";
		$result4 =  mysqli_query($gconnet,$query4);

	if($result){
		error_frame_go("정상적으로 삭제 되었습니다.","reserve-survey-manage.php?pageNo=".$pageNo."&".$total_param."");
		
	} else {
		error_frame_go("오류가 발생했습니다.","reserve-survey-manage.php?pageNo=".$pageNo."&".$total_param."");
	}
?>

