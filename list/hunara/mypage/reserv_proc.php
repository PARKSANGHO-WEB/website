<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
    
    $ridx = trim(sqlfilter($_REQUEST['ridx']));
    $regflag = trim(sqlfilter($_REQUEST['regflag']));


    $SQL .= " SELECT cancel from tb_company where idx = (select cidx from tb_reInfo where ridx = '".$ridx."') ";
    $result = mysqli_query($gconnet, $SQL);
    $row = mysqli_fetch_array($result);

    $resJSON = array("success"=>"false", "msg"=>"");
    $message = "";
    $result  = "false";

    $query = "";
    if($regflag == "5"){
        //당첨 후 취소
        if($row[cancel] == 'Y'){
            $query = " UPDATE tb_reInfo SET regflag_two = '3', regflag = '8', cancel_date = now()  WHERE ridx = '{$ridx}'  ";
            $message = "예약 취소 되었습니다.";
        }else{
            $query = " UPDATE tb_reInfo SET regflag_two = '2', cancel_date = now()  WHERE ridx = '{$ridx}'  ";
            $message = "관리자 승인 후 취소가 확정됩니다.";
        }
    
    }else{
        //취소
        $query = " UPDATE tb_reInfo SET regflag = '8', cancel_date = now()  WHERE ridx = '{$ridx}'  ";
        $message = "예약 취소 되었습니다.";
    }

    
                
    $result_query = mysqli_query($gconnet,$query);

    if($result_query){
        $result = "true";
    }else{
        $message = "오류가 발생했습니다. 관리자에게 문의해 주세요.";
    }


    $resJSON["success"] = $result;
    $resJSON["msg"] = $message;

    echo json_encode($resJSON);
    exit;

?>