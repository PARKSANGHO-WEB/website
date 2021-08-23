<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/kakaotalk_function.php"; // 카카오톡 발송 함수 ?>
<?
    $mode = trim(sqlfilter($_REQUEST['mode']));
	$ridxArr = trim(sqlfilter($_REQUEST['ridxArr']));  

    $resJSON = array("success"=>"false", "msg"=>"");
    $message = "";
    $result  = "false";


    //이름, 휴양소명, 계절, 예약일, 박수, 연락처, 예약번호
    $sql = " SELECT a.name, b.comname as huname, a.pgubun,  date_format(a.cymd, '%Y-%m-%d') as cymd, a.useday, ";
    $sql .= "       ifnull(a.hp, a.tel) as hp, trim(a.digit7) as digit7, a.regflag ";
    $sql .= " FROM tb_reInfo a, tb_hu b ";
    $sql .= " WHERE a.hidx = b.idx ";
    $sql .= "   AND a.ridx in ($ridxArr) ";

    $rs = mysqli_query($gconnet, $sql);    


    $receiverArr = array();
    if(mysqli_num_rows($rs) > 0){


        for($i=0; $i < mysqli_num_rows($rs); $i++){

            $row = mysqli_fetch_array($rs);

            if( ($mode == "prize" || $mode == "enter") && $row['regflag'] != "5" ){
                
                $resJSON["success"] = "false";
                $resJSON["msg"] = $row['name']."님은 당첨 상태가 아닙니다. ";

                echo json_encode($resJSON, JSON_UNESCAPED_UNICODE);
                exit;

            }else if($mode == "enter" && empty($row['digit7']) ){

                $resJSON["success"] = "false";
                $resJSON["msg"] = $row['name']."님의 예약번호가 없습니다. ";

                echo json_encode($resJSON, JSON_UNESCAPED_UNICODE);
                exit;                

            }else if($mode == "fail" && $row['regflag'] != "9" ){
                $resJSON["success"] = "false";
                $resJSON["msg"] = $row['name']."님은 탈락 상태가 아닙니다. ";

                echo json_encode($resJSON, JSON_UNESCAPED_UNICODE);
                exit; 
            }


            $recvinfo = array( "name"=> $row['name'], "huname"=> $row['huname'], "flag"=> $row['pgubun'],
                                "cymd"=> $row['cymd'], "useday"=> $row['useday'], "hp"=> $row['hp'], "digit7"=> $row['digit7'] );

            array_push($receiverArr, $recvinfo);
        
        }

        if($mode == "prize"){

            // 당첨 안내 발송 
            $sendResult = send_prize( $receiverArr );

           
        }else if($mode == "enter"){

            // 입실 안내 발송 
            $sendResult = send_enter( $receiverArr );
        
        }else if($mode == "fail"){

            // 탈락 안내 발송 
            $sendResult = send_fail( $receiverArr );
        }

        //print_r($sendResult);


        if($sendResult['code'] == "0"){

            $result = "true";
            $message = "정상적으로 발송 되었습니다.";

        }

    }else{
        $message = "전송할 데이터가 없습니다.";
    }

    

    $resJSON["success"] = $result;
    $resJSON["msg"] = $message;

    echo json_encode($resJSON, JSON_UNESCAPED_UNICODE);
    exit;

?>