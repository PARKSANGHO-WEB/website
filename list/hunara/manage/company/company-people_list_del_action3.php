<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
	$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
	$total_param = trim(sqlfilter($_REQUEST['total_param']));

	$promotion_idx = $_REQUEST['hostpeo2'];
	$idx = $_REQUEST['idx'];
    $max = $_REQUEST['max'];

	//for($k=0; $k<sizeof($promotion_idx); $k++){
		$query = "delete from tb_employee_excel";
		$query .= " where 1 and seq in (".$idx.")";
		$result =  mysqli_query($gconnet,$query);
	//}
    $cnt = 0;
    $sql_pre2 = " select duplicate from tb_employee_excel where 1=1 and max = '".$max."'"; 
    $result_pre2  = mysqli_query($gconnet,$sql_pre2);
    for ($i=0; $i<mysqli_num_rows($result_pre2); $i++){
    $mem_row2 = mysqli_fetch_array($result_pre2);
    if($mem_row2['duplicate'] == 'N'){
        $cnt ++;
        
    }
    }


	if($result){
		$resJSON["success"] = 'true';
        $message = "처리 되었습니다.";
        $resJSON["msg"] = $message;
        if($cnt >0){
            $resJSON["duplicate"] = 'N';
        }else{
            $resJSON["duplicate"] = 'Y';
        }
		
	} else {
		$resJSON["success"] = 'false';
        $message = "처리 시 오류가 발생하였습니다.";
        $resJSON["msg"] = $message;
	}

    echo json_encode($resJSON);
    exit;  
?>

