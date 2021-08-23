<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?php 
  if (function_exists("mb_http_input")) mb_http_input("utf-8"); 
  if (function_exists("mb_http_output")) mb_http_output("utf-8");
?>
<?php  include "./KSPayWebHost.inc"; ?>
<?php 
	$rcid       = $_POST["reCommConId"];
	$rctype     = $_POST["reCommType"];
	$rhash      = $_POST["reHash"];

	$authyn		= "";
	$trno		= "";
	$trddt		= "";
	$trdtm		= "";
	$amt		= "";
	$authno		= "";
	$msg1		= "";
	$msg2		= "";
	$ordno		= "";
	$isscd		= "";
	$aqucd		= "";
	$temp_v		= "";
	$result		= "";
	$resultcd =  "";

	// rcid 없으면 결제를 끝까지 진행하지 않고 중간에 결제취소 
	$ipg = new KSPayWebHost($rcid, null);

	if ($ipg->kspay_send_msg("1"))
	{
		$authyn	 = $ipg->kspay_get_value("authyn");
		$trno	 = $ipg->kspay_get_value("trno"  );
		$trddt	 = $ipg->kspay_get_value("trddt" );
		$trdtm	 = $ipg->kspay_get_value("trdtm" );
		$amt	 = $ipg->kspay_get_value("amt"   );
		$authno	 = $ipg->kspay_get_value("authno");
		$msg1	 = $ipg->kspay_get_value("msg1"  );
		$msg1 = iconv("euc-kr","utf-8",$msg1 );
		$msg2	 = $ipg->kspay_get_value("msg2"  );
		$msg2 = iconv("euc-kr","utf-8",$msg2 );
		$ordno	 = $ipg->kspay_get_value("ordno" );
		$isscd	 = $ipg->kspay_get_value("isscd" );
		$aqucd	 = $ipg->kspay_get_value("aqucd" );
		$result	 = $ipg->kspay_get_value("result");

		if (!empty($authyn) && 1 == strlen($authyn)) {
			if ($authyn == "O") {
				// 승인 성공
				$resultcd = "0000";
			}
			else {
				// 승인 실패
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
        $sql .= "( {$ordno}, '{$authyn}', '{$pay_method}', '{$result}', '{$resultcd}', '{$ordno}', {$amt}, '{$trno}', '', ";
        $sql .= " '{$trddt}', '{$trdtm}', '{$authno}',  '{$isscd}', '{$aqucd}', '{$msg1}', '{$msg2}' ) ";
    
        $result_query = mysqli_query($gconnet,$sql);

        if($result_query){
            echo "<script>opener.payResult();self.close();</script>";
        }else{
            echo "<script>alert('결제 후 결제내역 저장 중 오류가 발생하였습니다.');opener.payResult();self.close();</script>";
        }
    
    }else{
        echo "<script>alert('결제 승인에 실패하였습니다.');opener.payResult();self.close();</script>";
    }    
?>
<html>
<head></head>
<body></body>
</html>