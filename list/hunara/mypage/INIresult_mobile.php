<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<?php

header("Content-Type: text/html; charset=euc-kr");


extract($_POST);
extract($_GET);


echo '<인증결과내역>'."<br/><br/>";

echo 'P_STATUS : '.$_REQUEST["P_STATUS"]."<br/>";
echo 'P_RMESG1 : '.$_REQUEST["P_RMESG1"]."<br/>";
echo 'P_TID : '.$_REQUEST["P_TID"]."<br/>";
echo 'P_REQ_URL : '.$_REQUEST["P_REQ_URL"]."<br/>";
echo 'P_NOTI : '.$_REQUEST["P_NOTI"]."<br/>";
echo 'P_AMT : '.$_REQUEST["P_AMT"]."<br/><br/><br/><br/>";


$merchantData 	= $_REQUEST["P_NOTI"];     			// 가맹점 관리데이터 수신
			 
$etc_data_arr = explode("|",$merchantData); // 예약idx|결제금액|회원idx|사원번호

$ridx = $etc_data_arr[0];
$price = $etc_data_arr[1];
$midx = $etc_data_arr[2];
$sano = $etc_data_arr[3];

include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/auto_login_action.php"; // 세션끊김 방지

if ($_REQUEST["P_STATUS"] === "00") {     // 인증이 P_STATUS===00 일 경우만 승인 요청

    $id_merchant = substr($P_TID,'10','10');     // P_TID 내 MID 구분
    
    $data = array(
     'P_MID' => $id_merchant,         // P_MID
     'P_TID' => $P_TID                // P_TID
    );
   
   // curl 통신 시작 
   $ch = curl_init();                                                             //curl 초기화
   curl_setopt($ch, CURLOPT_URL, $_REQUEST["P_REQ_URL"]);      //URL 지정하기
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    //요청 결과를 문자열로 반환 
   curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);     //connection timeout 10초 
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);           //원격 서버의 인증서가 유효한지 검사 안함
   curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));    //POST 로 $data 를 보냄
   curl_setopt($ch, CURLOPT_POST, 1);                                         //true시 post 전송 
    
   $response = curl_exec($ch);
   curl_close($ch);
   
   
   // -------------------- 승인결과 수신 -------------------------------------------
   
   echo '<승인결과내역>'."<br/><br/>"; 
   
   $result =  str_replace ("&", "<br/>", $response);
   
   echo $result;
   
   
   }else {   //  인증이 P_STATUS===00 아닐경우 아래 인증 실패를 출력함
   
   echo 'P_STATUS : '.$_REQUEST["P_STATUS"]."<br/>";
   echo 'P_RMESG1 : '.$_REQUEST["P_RMESG1"]."<br/>";
   
   }
     
   ?>
   
   
?>
</body>
</html>