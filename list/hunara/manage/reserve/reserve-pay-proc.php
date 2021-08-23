<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/check_login.php"; // 로그인 여부 체크 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/PHPExcel-1.8/Classes/PHPExcel.php";  ?>
<?

$mode   = trim(sqlfilter($_REQUEST['mode']));
$ridx   = trim(sqlfilter($_REQUEST['ridx']));
$seq   = trim(sqlfilter($_REQUEST['seq']));

$idx = explode(',',$ridx);

$resJSON = array("success"=>"false", "msg"=>"", "dataList" => "");
$message = "";
$result  = "false";


if($mode == "TRANS"){

    $ridxList = explode(",", $ridx);


    for($i=0; $i< count($ridxList); $i++){
        $SQL = " select payflag from tb_reInfo where ridx = '".$idx[$i]."' ";

        $res = mysqli_query($gconnet, $SQL);
        $row = mysqli_fetch_array($res);
        $query = " UPDATE tb_reInfo SET payflag = 'T', mdate = now() WHERE ridx = ".$idx[$i]." ";


        $resultQuery = mysqli_query($gconnet,$query);
        $resultCnt += $resultQuery;
    }    

    if($resultCnt > 0){
        $result = "true";
        $message = "처리 되었습니다.";
    }else{
        $result = "false";
        $message = "에러 발생.";

    }    
    
}else if($mode == "CANCEL"){

    $ridxList = explode(",", $ridx);


    for($i=0; $i< count($ridxList); $i++){
        $SQL = " select payflag from tb_reInfo where ridx = '".$idx[$i]."' ";

        $res = mysqli_query($gconnet, $SQL);
        $row = mysqli_fetch_array($res);
        if($row[payflag] == 'P'){
            $query = " UPDATE tb_reInfo SET payflag = 'PC', cancel_date = now() WHERE ridx = ".$idx[$i]." ";

            $query2 = " select payMethod, TotPrice, applNum, tid, idx from tb_pay WHERE ridx = ".$idx[$i]." ";
            $res2 = mysqli_query($gconnet, $query2);
            $row2 = mysqli_fetch_array($res2);


            
            header("Content-Type: text/html; charset=utf-8"); 

            //step1. 요청을 위한 파라미터 설정

            $key = "vkgHxgjL5cWJGFUs";  // INIpayTest 의 INIAPI key
            $type = "Refund";
            $paymethod = $row2['payMethod'];
            $timestamp = date("YmdHis");
            $clientIp = "3.35.44.90";
            $mid = "hunara2015";
            $tid = $row2['tid']; // 40byte 승인 TID 입력
            $msg = "거래취소요청";

            $hashData = hash("sha512",$key.$type.$paymethod.$timestamp.$clientIp.$mid.$tid); // hash 암호화


            //step2. key=value 로 post 요청

            $data = array(
                'type' => $type,
                'paymethod' => $paymethod,
                'timestamp' => $timestamp,
                'clientIp' => $clientIp,
                'mid' => $mid,
                'tid' => $tid,
                'msg' => $msg,
                'hashData' => $hashData
                );

            $url ="https://iniapi.inicis.com/api/v1/refund";  // 전송 URL

            $ch = curl_init();                                                   //curl 초기화
            curl_setopt($ch, CURLOPT_URL, $url);                        // 전송 URL 지정하기
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);     //요청 결과를 문자열로 반환 
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);      //connection timeout 10초 
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));       //POST data
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded; charset=utf-8')); // 전송헤더 설정
            curl_setopt($ch, CURLOPT_POST, 1);                          // post 전송 
            
            $response = curl_exec($ch);
            curl_close($ch);


            //step3. 요청 결과

            $decode = json_decode($response, true);

            $SQL2 = " update tb_pay set ";
            $SQL2 .= " resultCode = '".$decode[resultCode]."', ";
            $SQL2 .= " resultMsg = '".$decode[resultMsg]."', ";
            $SQL2 .= " cancelDate = '".$decode[cancelDate]."', ";
            $SQL2 .= " cancelTime = '".$decode[cancelTime]."', ";
            $SQL2 .= " cshrCancelNum = '".$decode[cshrCancelNum]."' ";
            $SQL2 .= " where ridx = '".$idx[$i]."' and ";
            $SQL2 .= " idx = '".$row2[idx]."' ";


            $result3 = mysqli_query($gconnet, $SQL2);

            $SQL3 = " insert tb_pay_history set ";
            $SQL3 .= " ridx = '".$idx[$i]."', ";
            $SQL3 .= " pidx = '".$row2[idx]."', ";
            $SQL3 .= " resultCode = '".$decode[resultCode]."', ";
            $SQL3 .= " resultMsg = '".$decode[resultMsg]."', ";
            $SQL3 .= " wdate = '".$decode[cancelDate]."', ";
            $SQL3 .= " wtime = '".$decode[cancelTime]."', ";
            $SQL3 .= " TotPrice = '".$row2["TotPrice"]."', ";
            $SQL3 .= " payMethod = '".$row2["payMethod"]."', ";
            $SQL3 .= " applNum = '".$row2["applNum"]."', ";
            $SQL3 .= " cshrCancelNum = '".$decode[cshrCancelNum]."' ";


            $result4 = mysqli_query($gconnet, $SQL3);


        }else{
            $query = " UPDATE tb_reInfo SET payflag = 'TC', cancel_date = now() WHERE ridx = ".$idx[$i]." ";
        }

        $resultQuery = mysqli_query($gconnet,$query);
        $resultCnt += $resultQuery;
    }    

    if($resultCnt > 0){
        $result = "true";
        $message = "처리 되었습니다.";
    }else{
        $result = "false";
        $message = "에러 발생.";

    }    

}

$resJSON["success"] = $result;
$resJSON["msg"] = $message;
$resJSON["dataList"] = $SQL2;

echo json_encode($resJSON, JSON_UNESCAPED_UNICODE);
exit;


?>