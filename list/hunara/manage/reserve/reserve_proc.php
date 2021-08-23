<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
    $mode = trim(sqlfilter($_REQUEST['mode']));
	$ridx = trim(sqlfilter($_REQUEST['ridx']));
	$regflag_two = trim(sqlfilter($_REQUEST['regflag_two']));

    $resJSON = array("success"=>"false", "msg"=>"");
    $message = "";
    $result  = "false";
 

    /********************************************************************************************** 
    * 당첨 취소 승인/ 승인 붚가
    ***********************************************************************************************/
    if($mode == "CANCEL"){

        $query = " UPDATE tb_reInfo ";
        $query .= " SET  regflag_two = '{$regflag_two}', cancel_date = now()  ";
        
        if($regflag_two == "3"){
            $query .= ", regflag = '7' ";
        }if($regflag_two == "4"){  //당첨취소 불가일 경우 당첨상태 유지
            $query .= ", regflag = '5' ";
        }

        $query .= " WHERE  ridx in (".$ridx.")";
                    
        $result_query = mysqli_query($gconnet,$query);

        if($result_query){
            $result = "true";
            $message = "처리 되었습니다.";
        }

    }


    $resJSON["success"] = $result;
    $resJSON["msg"] = $message;

    echo json_encode($resJSON, JSON_UNESCAPED_UNICODE);
    exit;

?>