<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?php 
  if (function_exists("mb_http_input")) mb_http_input("utf-8"); 
  if (function_exists("mb_http_output")) mb_http_output("utf-8");
?>
<?php include "./KSPayWebHost.inc"; ?>
<html>
<head>
<meta http-equiv="Cache-Control" content="no-cache"> 
<meta http-equiv="Pragma" content="no-cache"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="http://kspay.ksnet.to/store/KSPayFlashV1.3/mall/css/pgstyle.css" rel="stylesheet" type="text/css" charset="euc-kr">

</head>
<?php
  $rcid       = $_POST['reWHCid'];
  $rctype     = $_POST['reWHCtype'];
  $rhash      = $_POST['reWHHash'];

    $payResult = "";
	$authyn   = "";
	$trno     = "";
	$trddt		= "";
	$trdtm		= "";
	$amt      = "";
	$authno   = "";
	$msg1     = "";
	$msg2     = "";
	$ordno		= "";
	$isscd		= "";
	$aqucd		= "";
	$temp_v		= "";
	$result		= "";
	$halbu		= "";
	$cbtrno   = "";
	$cbauthno = "";
	$resultcd = "";

	//업체에서 추가하신 인자값을 받는 부분입니다
	$a = $_POST["a"]; 
	$b = $_POST["b"]; 
	$c = $_POST["c"]; 
	$d = $_POST["d"];

  $ipg = new KSPayWebHost($rcid, null);

	if ($ipg->kspay_send_msg("1"))  //KSNET 결제결과 중 아래에 나타나지 않은 항목이 필요한 경우 Null 대신 필요한 항목명을 설정할 수 있습니다.
	{
		$authyn   = $ipg->kspay_get_value("authyn");
		$trno     = $ipg->kspay_get_value("trno"  );
		$trddt    = $ipg->kspay_get_value("trddt" );
		$trdtm    = $ipg->kspay_get_value("trdtm" );
		$amt      = $ipg->kspay_get_value("amt"   );
		$authno   = $ipg->kspay_get_value("authno");
		$msg1     = $ipg->kspay_get_value("msg1"  );
		$msg2     = $ipg->kspay_get_value("msg2"  );
		$ordno    = $ipg->kspay_get_value("ordno" );
		$isscd    = $ipg->kspay_get_value("isscd" );
		$aqucd    = $ipg->kspay_get_value("aqucd" );
		$temp_v   = "";
		$result   = $ipg->kspay_get_value("result");
		$halbu    = $ipg->kspay_get_value("halbu");
		$cbtrno   = $ipg->kspay_get_value("cbtrno");
		$cbauthno = $ipg->kspay_get_value("cbauthno");
		
		if (!empty($msg1)) $msg1 = iconv("EUC-KR", "UTF-8", $msg1);
		if (!empty($msg2)) $msg2 = iconv("EUC-KR", "UTF-8", $msg2);

		if (!empty($authyn) && 1 == strlen($authyn))
		{
			if ($authyn == "O") {
                // 정상승인
				$resultcd = "0000";
            }
            else {
                // 승인실패
				$resultcd = trim($authno);
			}
        }
	}

    if($resultcd == "0000"){

        $pay_method = "";
        if (empty($result) || 4 != strlen($result)) {
            $pay_method = "(???)";
        }
        else {
            switch (substr($result,0,1)) {
                case '1' : $pay_method = "신용카드"; break;
                case 'I' : $pay_method = "신용카드"; break;
                case '2' : $pay_method = "실시간계좌이체"; break;
                case '6' : $pay_method = "가상계좌발급"; break; 
                case 'M' : $pay_method = "휴대폰결제"; break; 
                case 'G' : $pay_method = "상품권"; break; 
                default  : $pay_method = "(????)"; break; 
            }
        }

        $sql = " REPLACE INTO tb_pay ";
        $sql .= "(ridx, authyn,  pay_method, result, result_code, ord_no, amount, trans_no, cash_trans_no, trans_date, trans_time, authno, isscd, aqucd, msg1, msg2) ";
        $sql .= " VALUES ";
        $sql .= "( {$ordno}, '{$authyn}', '{$pay_method}', '{$result}', '{$resultcd}', '{$ordno}', {$amt}, '{$trno}', '{$cbtrno}', ";
        $sql .= " '{$trddt}', '{$trdtm}', '{$authno}',  '{$isscd}', '{$aqucd}', '{$msg1}', '{$msg2}' ) ";
    
        $result_query = mysqli_query($gconnet,$sql);

        if($result_query){
            echo "<script>parent.payResult();</script>";
        }else{
            echo "<script>alert('결제 후 결제내역 저장 중 오류가 발생하였습니다.');parent.payResult();</script>";
        }
    
    }else{
        echo "<script>alert('결제 승인에 실패하였습니다.');parent.payResult();</script>";
    }


?>
<body>

</body>
</html>
