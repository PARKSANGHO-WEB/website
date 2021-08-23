			
<?php

header("Content-Type: text/html; charset=utf-8"); 

//step1. 요청을 위한 파라미터 설정

$key = "vkgHxgjL5cWJGFUs";  // INIpayTest 의 INIAPI key
$type = "Refund";
$paymethod = "Card";
$timestamp = date("YmdHis");
$clientIp = "3.35.44.90";
$mid = "hunara2015";
$tid = "StdpayCARDhunara201520210622173137677945"; // 40byte 승인 TID 입력
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

echo $response;
echo "<br>";
$decode = json_decode($response, true);

echo $decode["resultMsg"];

?>