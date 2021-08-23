<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
	$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
	$total_param = trim(sqlfilter($_REQUEST['total_param']));

	$promotion_idx = $_REQUEST['hostpeo'];
	$idx = $_REQUEST['idx'];

	//for($k=0; $k<sizeof($promotion_idx); $k++){
		$query = "delete from tb_employee";
		$query .= " where 1 and cdx =".$idx."";
		$result =  mysqli_query($gconnet,$query);
	//}

	if($result){
		error_frame_go("정상적으로 삭제 되었습니다.","company-people.php?pageNo=".$pageNo."&".$total_param."");
		
	} else {
		error_frame_go("오류가 발생했습니다.","company-people.php?pageNo=".$pageNo."&".$total_param."");
	}
?>

