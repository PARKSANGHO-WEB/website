<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
	$idx = $_REQUEST['idx'];

    $query = "delete from popup_div";
    $query .= " where 1 and idx = '".$idx."'";
    $result =  mysqli_query($gconnet,$query);
	
	if($result){
		error_frame_go("정상적으로 삭제 되었습니다.","setting-pop.php");
		
	} else {
		error_frame_go("오류가 발생했습니다.","setting-pop.php");
	}
?>

