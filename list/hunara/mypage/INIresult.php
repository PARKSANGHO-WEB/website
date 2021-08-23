<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<link rel="stylesheet" href="/css/reserv.css">
<script type="text/javascript">
            function cancelTid() {
                var form = document.frm;

                var win = window.open('', 'OnLine', 'scrollbars=no,status=no,toolbar=no,resizable=0,location=no,menu=no,width=600,height=400');
                win.focus();
                form.action = "http://walletpaydemo.inicis.com/stdpay/cancel/INIcancel_index.jsp";
                form.method = "post";
                form.target = "OnLine";
                form.submit();

            }
        </script>

<?php
        require_once('libs/INIStdPayUtil.php'); 
        require_once('libs/HttpClient.php');

        $util = new INIStdPayUtil();

        try { 

            //#############################
            // 인증결과 파라미터 일괄 수신
            //#############################
            //		$var = $_REQUEST["data"];

            //#####################
            // 인증이 성공일 경우만
            //#####################

            $merchantData 	= $_REQUEST["merchantData"];     			// 가맹점 관리데이터 수신
			 
			 $etc_data_arr = explode("|",$merchantData); // 예약idx|결제금액|회원idx|사원번호

			 $ridx = $etc_data_arr[0];
			 $price = $etc_data_arr[1];
			 $midx = $etc_data_arr[2];
             $sano = $etc_data_arr[3];

             include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/auto_login_action.php"; // 세션끊김 방지


            if (strcmp("0000", $_REQUEST["resultCode"]) == 0) {

                //############################################
                // 1.전문 필드 값 설정(***가맹점 개발수정***)
                //############################################;

                $mid 			= $_REQUEST["mid"];     					// 가맹점 ID 수신 받은 데이터로 설정
                $signKey 		= "SU5JTElURV9UUklQTEVERVNfS0VZU1RS"; 		// 가맹점에 제공된 키(이니라이트키) (가맹점 수정후 고정) !!!절대!! 전문 데이터로 설정금지
                $timestamp 		= $util->getTimestamp();   					// util에 의해서 자동생성
                $charset 		= "UTF-8";        							// 리턴형식[UTF-8,EUC-KR](가맹점 수정후 고정)
                $format 		= "JSON";        							// 리턴형식[XML,JSON,NVP](가맹점 수정후 고정)

                $authToken 		= $_REQUEST["authToken"];   				// 취소 요청 tid에 따라서 유동적(가맹점 수정후 고정)
                $authUrl 		= $_REQUEST["authUrl"];    					// 승인요청 API url(수신 받은 값으로 설정, 임의 세팅 금지)
                $netCancel 		= $_REQUEST["netCancelUrl"];   				// 망취소 API url(수신 받은f값으로 설정, 임의 세팅 금지)

                $mKey 			= hash("sha256", $signKey);					// 가맹점 확인을 위한 signKey를 해시값으로 변경 (SHA-256방식 사용)

                //#####################
                // 2.signature 생성
                //#####################
                $signParam["authToken"] 	= $authToken;  	// 필수
                $signParam["timestamp"] 	= $timestamp;  	// 필수
                // signature 데이터 생성 (모듈에서 자동으로 signParam을 알파벳 순으로 정렬후 NVP 방식으로 나열해 hash)
                $signature = $util->makeSignature($signParam);


                //#####################
                // 3.API 요청 전문 생성
                //#####################
                $authMap["mid"] 			= $mid;   		// 필수
                $authMap["authToken"] 		= $authToken; 	// 필수
                $authMap["signature"] 		= $signature; 	// 필수
                $authMap["timestamp"] 		= $timestamp; 	// 필수
                $authMap["charset"] 		= $charset;  	// default=UTF-8
                $authMap["format"] 			= $format;  	// default=XML


                try {

                    $httpUtil = new HttpClient();

                    //#####################
                    // 4.API 통신 시작
                    //#####################

                    $authResultString = "";
                    
                    if ($httpUtil->processHTTP($authUrl, $authMap)) {
                        $authResultString = $httpUtil->body;
                        //echo "<p><b>RESULT DATA :</b> $authResultString</p>";			//PRINT DATA
                    } else {
                        //echo "Http Connect Error\n";
                        //echo $httpUtil->errormsg;

                        throw new Exception("Http Connect Error");
                    }

                    //############################################################
                    //5.API 통신결과 처리(***가맹점 개발수정***)
                    //############################################################

                    $resultMap = json_decode($authResultString, true);
					
                    
                    /*************************  결제보안 추가 2016-05-18 START ****************************/ 
                    $secureMap["mid"]		= $mid;							//mid
                    $secureMap["tstamp"]	= $timestamp;					//timestemp
                    $secureMap["MOID"]		= $resultMap["MOID"];			//MOID
                    $secureMap["TotPrice"]	= $resultMap["TotPrice"];		//TotPrice
                    
                    // signature 데이터 생성 
                    $secureSignature = $util->makeSignatureAuth($secureMap);
                    /*************************  결제보안 추가 2016-05-18 END ****************************/

                    $order_num = @(in_array($resultMap["MOID"] , $resultMap) ? $resultMap["MOID"] : "null" );
					$member_idx = $midx;
					$user_id = $mid;

					$order_name = @(in_array($resultMap["buyerName"] , $resultMap) ? $resultMap["buyerName"] : "null" ); 
					$order_cell = @(in_array($resultMap["buyerTel"] , $resultMap) ? $resultMap["buyerTel"] : "null" ); 
					$order_email = @(in_array($resultMap["buyerEmail"] , $resultMap) ? $resultMap["buyerEmail"] : "null" );  
					$pay_type = "normal";

					 if (isset($resultMap["payMethod"]) && strcmp("VBank", $resultMap["payMethod"]) == 0) { //가상계좌
						$pay_sect_1 = "pay_virt";
						$orderstat = "pre";
						$pay_bank = @(in_array($resultMap["vactBankName"] , $resultMap) ? $resultMap["vactBankName"] : "null" );
						$pay_bank_num = @(in_array($resultMap["VACT_Num"] , $resultMap) ? $resultMap["VACT_Num"] : "null" );
						$pay_bank_name = @(in_array($resultMap["VACT_Name"] , $resultMap) ? $resultMap["VACT_Name"] : "null" );
					 } else if (isset($resultMap["payMethod"]) && strcmp("DirectBank", $resultMap["payMethod"]) == 0) { //실시간계좌이체
						$pay_sect_1 = "bank_iche";
						$orderstat = "com";
						$iche_bank_name = @(in_array($resultMap["ACCT_BankCode"] , $resultMap) ? $resultMap["ACCT_BankCode"] : "null" );
					 } else if (isset($resultMap["payMethod"]) && strcmp("HPP", $resultMap["payMethod"]) == 0) { //휴대폰
						$pay_sect_1 = "handphone";
						$orderstat = "com";
					 } else { // 신용카드
						$pay_sect_1 = "card_isp";
						$orderstat = "com";
						$card_name = @(in_array($resultMap["CARD_Num"] , $resultMap) ? $resultMap["CARD_Num"] : "null" ); 
						$quota = @(in_array($resultMap["CARD_Quota"] , $resultMap) ? $resultMap["CARD_Quota"] : "null" );
					 }
					 
					 $ApprNo = @(in_array($resultMap["tid"] , $resultMap) ? $resultMap["tid"] : "null" );
					 $ApprTm = @(in_array($resultMap["applDate"] , $resultMap) ? $resultMap["applDate"] : "null" );
					 $DealNo = @(in_array($resultMap["applTime"] , $resultMap) ? $resultMap["applTime"] : "null" );



					if ((strcmp("0000", $resultMap["resultCode"]) == 0) && (strcmp($secureSignature, $resultMap["authSignature"]) == 0) ){	//결제보안 추가 2016-05-18
					   /*****************************************************************************
				       * 여기에 가맹점 내부 DB에 결제 결과를 반영하는 관련 프로그램 코드를 구현한다.  
					   
						 [중요!] 승인내용에 이상이 없음을 확인한 뒤 가맹점 DB에 해당건이 정상처리 되었음을 반영함
								처리중 에러 발생시 망취소를 한다.
				       ******************************************************************************/
                      $query = "insert into tb_pay set"; 
                      $query .= " ridx = '".$ridx."', ";
                      $query .= " resultCode = '".$resultMap["resultCode"]."', ";
                      $query .= " resultMsg = '".$resultMap["resultMsg"]."', ";
                      $query .= " tid = '".$resultMap["tid"]."', ";
                      $query .= " goodName = '".$resultMap["goodName"]."', ";
                      $query .= " TotPrice = '".$resultMap["TotPrice"]."', ";
                      $query .= " MOID = '".$resultMap["MOID"]."', ";
                      $query .= " payMethod = '".$resultMap["payMethod"]."', ";
                      $query .= " applNum = '".$resultMap["applNum"]."', ";
                      $query .= " applDate = '".$resultMap["applDate"]."', ";
                      $query .= " applTime = '".$resultMap["applTime"]."', ";
                      $query .= " buyerName = '".$resultMap["buyerName"]."', ";
                      $query .= " buyerTel = '".$resultMap["buyerTel"]."', ";
                      $query .= " buyerEmail = '".$resultMap["buyerEmail"]."', ";
                      $query .= " custEmail = '".$resultMap["custEmail"]."', ";
                      $query .= " CARD_Num = '".$resultMap["CARD_Num"]."', ";
                      $query .= " CARD_Interest = '".$resultMap["CARD_Interest"]."', ";
                      $query .= " CARD_Quota = '".$resultMap["CARD_Quota"]."', ";
                      $query .= " CARD_Code = '".$resultMap["CARD_Code"]."', ";
                      $query .= " CARD_CorpFlag = '".$resultMap["CARD_CorpFlag"]."', ";
                      $query .= " CARD_CheckFlag = '".$resultMap["CARD_CheckFlag"]."', ";
                      $query .= " CARD_PRTC_CODE = '".$resultMap["CARD_PRTC_CODE"]."', ";
                      $query .= " CARD_BankCode = '".$resultMap["CARD_BankCode"]."', ";
                      $query .= " CARD_SrcCode = '".$resultMap["CARD_SrcCode"]."', ";
                      $query .= " CARD_Point = '".$resultMap["CARD_Point"]."', ";
                      //$query .= " CARD_CouponPrice = ".$resultMap["CARD_CouponPrice"].", ";
                      //$query .= " CARD_CouponDiscount = ".$resultMap["CARD_CouponDiscount"].", ";
                      $query .= " CARD_UsePoint = '".$resultMap["CARD_UsePoint"]."', ";
                      $query .= " ACCT_BankCode = '".$resultMap["ACCT_BankCode"]."', ";
                      $query .= " CSHR_ResultCode = '".$resultMap["CSHR_ResultCode"]."', ";
                      $query .= " CSHR_Type = '".$resultMap["CSHR_Type"]."', ";
                      $query .= " ACCT_Name = '".$resultMap["ACCT_Name"]."' ";

/*
                      $query = "insert into tb_pay set"; 
                      $query .= " ridx = '".$ridx."', ";
                      $query .= " authyn = '".$resultMap["authSignature"]."', ";
                      $query .= " member_idx = '".$member_idx."', ";
                      $query .= " user_id = '".$user_id."', ";
                      $query .= " orderstat = '".$orderstat."', ";
                      $query .= " order_name = '".$order_name."', ";
                      $query .= " order_email = '".$order_email."', ";
                      $query .= " order_cell = '".$order_cell."', ";
                      $query .= " payment_type  = '".$payment_type."', ";
                      $query .= " payment_sect = '".$payment_sect."', ";
                      $query .= " pay_type = '".$pay_type."', ";
                      $query .= " pay_sect_1 = '".$pay_sect_1."', ";
                      $query .= " pay_bank = '".$pay_bank."', ";
                      $query .= " pay_bank_num = '".$pay_bank_num."', ";
                      $query .= " pay_bank_name = '".$pay_bank_name."', ";
                      $query .= " card_name = '".$card_name."', ";
                      $query .= " quota = '".$quota."', ";
                      $query .= " iche_bank_name = '".$iche_bank_name."', ";
                      $query .= " price_total_org = '".$price."', ";
                      $query .= " coupon_idx = '".$coupon_num."', ";
                      $query .= " pay_refund = '".$discount_price."', ";
                      $query .= " price_total = '".$price."', ";
                      $query .= " ApprNo = '".$ApprNo."', ";
                      $query .= " ApprTm = '".$ApprTm."', ";
                      $query .= " DealNo = '".$DealNo."', ";
                      if($orderstat == "com"){
                          $query .= " order_date = now(), ";
                          $query .= " payment_date = now() ";
                      } else {
                          $query .= " order_date = now() ";
                      }
*/                      

                      $result = mysqli_query($gconnet,$query);
                      //echo $query;
                      $query2 = " update tb_reInfo set payflag = 'P', mdate = now() where ridx = '".$ridx."' ";
                      $result2 = mysqli_query($gconnet,$query2);

                      $query3 = " select * from tb_pay order by idx desc  ";
                      $result3 = mysqli_query($gconnet,$query3);
                      $row3 = mysqli_fetch_array($result3);
                      
                      $query4 = " insert tb_pay_history set pidx = '".$row3[idx]."' , ridx = '".$ridx."', payMethod = '".$resultMap["payMethod"]."', TotPrice = '".$resultMap["TotPrice"]."', applNum = '".$resultMap["applNum"]."', resultCode = '".$resultMap["resultCode"]."', resultMsg = '".$resultMap["resultMsg"]."', wdate = '".$resultMap["applDate"]."', wtime = '".$resultMap["applTime"]."' ";
                      $result4 = mysqli_query($gconnet,$query4);                      

                      ?>
						<script>
						   alert("결제 완료 되었습니다.");
							location.href="/mypage/reserv_view.php?ridx=<?=$ridx?>";
						</script>
					  <?
						//exit;



					} else {
                        ?>
						<script>
                            var msg = "<?=$resultMap['resultMsg']?>";
						   alert("결제 실패 했습니다.\n"+msg);
							location.href="/mypage/reserv_view.php?ridx=<?=$ridx?>";
						</script>
					    <?
						//exit;
                        
                    }
                   
                } catch (Exception $e) {
                    // $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
                    //####################################
                    // 실패시 처리(***가맹점 개발수정***)
                    //####################################
                    //---- db 저장 실패시 등 예외처리----//
                    $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
                    //echo $s;

                    //#####################
                    // 망취소 API
                    //#####################

                    $netcancelResultString = ""; // 망취소 요청 API url(고정, 임의 세팅 금지)
                    
                    if ($httpUtil->processHTTP($netCancel, $authMap)) {
                        $netcancelResultString = $httpUtil->body;
                    } else {
                        //echo "Http Connect Error\n";
                        //echo $httpUtil->errormsg;

                        throw new Exception("Http Connect Error");
                    }

					//echo "<br/>## 망취소 API 결과 ##<br/>";
					
					/*##XML output##*/
					//$netcancelResultString = str_replace("<", "&lt;", $$netcancelResultString);
					//$netcancelResultString = str_replace(">", "&gt;", $$netcancelResultString);
					
                    // 취소 결과 확인
                    //echo "<p>". $netcancelResultString . "</p>";
                }
            } else {

                //#############
                // 인증 실패시
                //#############
                //echo "<pre>" . var_dump($_REQUEST) . "</pre>";
            }
        } catch (Exception $e) {
            $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
            //echo $s;
        }
?>
<body>
    <header></header>
    <div id="container">
		<div class="sort-wrap">
			<div class="sort-menu" id="sangse-sort">
				<ul>
					<li>
						<span onclick="location.href='/mypage/mypage.php'">회원정보</span>
					</li>
					<li class="active">
						<span onclick="location.href='/mypage/reserv.php'">예약내역</span>
					</li>
					<li>
						<span onclick="location.href='/mypage/mywrite.php'">내 게시글 관리</span>
					</li>
				</ul>
			</div>
		</div>
        <form name="frm" id="frm" method="post">
        <input type="hidden" name="ridx" id="ridx" value="<?=$ridx?>" >
        <input type="hidden" name="regflag" id="regflag" value="<?=$row['regflag']?>" >
        </form>
        <div id="reser-sangse">
           	<div class="rs-st">
           		<p>결제내역</p>
           	</div>
            <table>
                <tr>
                    <th>거래 성공 여부</th>
                    <?php if ((strcmp("0000", $resultMap["resultCode"]) == 0) && (strcmp($secureSignature, $resultMap["authSignature"]) == 0) ){ ?>
                        <td>성공</td>
                    <?php }else { ?>
                        <td>실패</td>
                    <?php } ?>
                </tr>
                <tr>
                    <th>결과 코드</th>
                    <td><?=@(in_array($resultMap["resultCode"] , $resultMap) ? $resultMap["resultCode"] : "null" )?></td>
                </tr>
                <tr>
                    <th>거래 번호</th>
                    <td><?=@(in_array($resultMap["tid"] , $resultMap) ? $resultMap["tid"] : "null" )?></td>
                </tr>
                <tr>
                    <th>결제방법 (지불수단)</th>
                    <td><?=@(in_array($resultMap["payMethod"] , $resultMap) ? $resultMap["payMethod"] : "null" )?></td>
                </tr>
                <tr>
                    <th>결과 내용</th>
                    <td><?=@(in_array($resultMap["resultMsg"] , $resultMap) ? $resultMap["resultMsg"] : "null" )?></td>
                </tr>
                <tr>
                    <th>결제완료금액</th>
                    <td><?=@(in_array($resultMap["TotPrice"] , $resultMap) ? $resultMap["TotPrice"] : "null" )?></td>
                </tr>
                <tr>
                    <th>주문 번호</th>
                    <td><?=@(in_array($resultMap["MOID"] , $resultMap) ? $resultMap["MOID"] : "null" )?></td>
                </tr>
                <tr>
                    <th>승인날짜</th>
                    <td><?=@(in_array($resultMap["applDate"] , $resultMap) ? $resultMap["applDate"] : "null" )?></td>
                </tr>
                <tr>
                    <th>승인시간</th>
                    <td><?=@(in_array($resultMap["applTime"] , $resultMap) ? $resultMap["applTime"] : "null" )?></td>
                </tr>
            </table>
            <br><br><br><br><br><br>
    	</div>
    </div>
    <footer></footer>

</body>
</html>