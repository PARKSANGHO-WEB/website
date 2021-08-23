<? include("../inc/header.php");  ?>
<link rel="stylesheet" href="/css/reserv.css">

<?
    $ridx = trim(sqlfilter($_REQUEST['ridx']));

	$sql = " SELECT a.ridx, a.chasu,  b.comname, date_format(a.cymd, '%Y-%m-%d') as cymd, a.useday, c.flag, a.hide_yn,  ";
	$sql .= "   d.rArea, d.rType, d.rAvg, d.rMax, d.rInfra, a.pcnt1, a.pcnt2, (c.per_amount * a.useday)as per_amount, ";
    $sql .= "   a.name, a.sano, a.hp, a.email, a.regflag, a.regflag_two, c.pg_yn  ";
    $sql .= " FROM tb_reInfo a, tb_hu b, tb_comhuM c, tb_huType d ";
	$sql .= " WHERE a.hidx = b.idx   AND a.midx = c.midx  AND b.idx = d.idx ";
    $sql .= " AND a.seq = d.seq   AND a.ridx = '{$ridx}'  ";    

    $rs = mysqli_query($gconnet, $sql);
    $row = mysqli_fetch_array($rs); 

    $paySql = " SELECT tid FROM tb_pay WHERE ridx = '{$ridx}' AND resultCode = '0000' ";    
    $payRs = mysqli_query($gconnet, $paySql);
    $payRow = mysqli_fetch_array($payRs); 


    //이니시스

    $order_num= date("ymdHis").$row['ridx']; //예약 순번

    require_once($_SERVER["DOCUMENT_ROOT"].'/mypage/libs/INIStdPayUtil.php');
$SignatureUtil = new INIStdPayUtil();

$mid = $inc_fdata_shopid;  // 가맹점 ID(가맹점 수정후 고정)					
$signKey = $inc_fdata_shopkey; // 가맹점에 제공된 웹 표준 사인키(가맹점 수정후 고정)
$timestamp = $SignatureUtil->getTimestamp();   // util에 의해서 자동생성

$orderNumber = $order_num; // 가맹점 주문번호(가맹점에서 직접 설정)
$price = $row['per_amount'];        // 상품가격(특수기호 제외, 가맹점에서 직접 설정)

$cardNoInterestQuota = "11-2:3:,34-5:12,14-6:12:24,12-12:36,06-9:12,01-3:4";  // 카드 무이자 여부 설정(가맹점에서 직접 설정)
$cardQuotaBase = "2:3:4:5:6:11:12:24:36";  // 가맹점에서 사용할 할부 개월수 설정
//###################################
// 2. 가맹점 확인을 위한 signKey를 해시값으로 변경 (SHA-256방식 사용) 
//###################################
$mKey = $SignatureUtil->makeHash($signKey, "sha256");

$params = array(
    "oid" => $orderNumber,
    "price" => $price,
    "timestamp" => $timestamp
);
$sign = $SignatureUtil->makeSignature($params, "sha256");

$etcdata = $ridx."|".$price."|".$_SESSION['EMP_SEQ']."|".$_SESSION['EMP_NO']; // 예약idx|결제금액|회원idx|사원번호

if($pay_method == "card_isp"){
	$pay_method_ini = "Card";
} elseif($pay_method == "bank_iche"){
	$pay_method_ini = "DirectBank";
} elseif($pay_method == "pay_virt"){
	$pay_method_ini = "Vbank";
} elseif($pay_method == "handphone"){
	$pay_method_ini = "HPP";
}


?>
<script language="javascript">
    var mobile = 
    $(document).ready(function(){
        jQuery('.top-menu a').eq("2").addClass('active');
    });

    function printPopup() { 
		
        var pop = "popupOpener";
        window.open ("",pop, "width=900, height=900, left=100, top=50" );
        var f = document.frm;
        f.target = pop;
        f.action = "print.php";
        f.submit();

	}

    function onCash(){
        
        if(isMobile()){
            myform = document.mobileweb; 
            myform.P_INI_PAYMENT.value = "BANK";
            myform.action = "https://mobile.inicis.com/smart/payment/";
            myform.submit();                       
        }else{
            myform = document.SendPayForm_id; 
            myform.gopaymethod.value = "DirectBank";
            INIStdPay.pay('SendPayForm_id');

        }
    }

    function onCredit(){
        
        if(isMobile()){
            myform = document.mobileweb; 
            myform.P_INI_PAYMENT.value = "CARD";
            myform.action = "https://mobile.inicis.com/smart/payment/";
            myform.target = "_self";
            myform.submit(); 
        }else{
            INIStdPay.pay('SendPayForm_id'); 
        }
    }

    //결제 성공 시 결제버튼 숨김
    function payResult(){
        var f = document.frm;
        f.target = "_self";
        f.action = "reserv_view.php";
        f.submit();
    }

    function revCancel(){

        var cymd = new Date("<?=$row['cymd']?>");

        var revday = new Date(cymd.getFullYear(), cymd.getMonth(),  cymd.getDate());
        var today = new Date();
        
        var diff = (revday.getTime() - today.getTime());
        diff = Math.ceil(diff / (1000*3600 *24));

        if( diff < 1){
            alert('숙박 예약일 이후에는 취소 불가합니다.');
        }else{

            $.ajax({
                url		: "/mypage/reserv_proc.php",
                type	: "POST",
                data	: { ridx: $('#ridx').val(), regflag:$('#regflag').val() },
                async	: false,
                dataType	: "json",
                success		: function(data){
                    if ( data.success == "true" ){
                        alert(data.msg);
                        payResult();  // 화면 새로고침

                    } else if ( data.success == "false" ){
                        alert(data.msg);
                        
                    } else {
                        alert( "시스템 오류 발생 하였습니다. \n 관리자에게 문의하시기 바랍니다." );
                    }
                }
            });             

        }
    }

    function isMobile() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    }

</script>
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
           		<p>예약확인</p>
           	</div>
            <table>
                <tr>
                    <th>휴양소명</th>
                    <td><?=$row['comname']?></td>
                </tr>
                <tr>
                    <th>이용기간</th>
                    <td><?=tranStrDate($row['cymd'],'kordis.')?>부터 <?=$usedayArray[$row['useday']]?></td>
                </tr>
                <tr>
                    <th>구분</th>
                    <td><?=$row['flag']?></td>
                </tr>
                <tr>
                    <th>객실 타입</th>
                    <td><?=$row['rArea']?> / <?=$row['rType']?> / 기준 : <?=$row['rAvg']?>명 / 최대 : <?=$row['rMax']?>명 / 시설 : <?=$row['rInfra']?></td>
                </tr>
                <tr>
                    <th>이용 인원</th>
                    <td>성인 <?=$row['pcnt1']?>명 / 아동 <?=$row['pcnt2']?>명</td>
                </tr>
                <tr>
                    <th>부담금</th>
                    <td><span>개인 <?=number_format($row['per_amount'])?>원</span> 
                    <?
                        if($row['pg_yn'] =="Y" && $row['regflag'] == "5" && $row['per_amount'] !="" && $row['per_amount'] > 0 && $row['hide_yn'] == "N" ){
                            
                            if(empty($payRow['tid'])){
                    ?>
                            <button class="go-pg" type="button" id="payBtn">결제</button>
                    <?
                            }else{
                    ?>
                            <!--
                            <button type="button" onClick="receiptView('<?=$payRow['tid']?>');">영수증출력</button>
                            -->
                    <?
                            }
                        }
                    ?>    
                    </td>
                </tr>
                <tr>
                    <th>구분</th>
                    <td><?=($row['chasu'] == "0")?"선착순":$row['chasu']."지망"?></td>
                </tr>
                <tr>
                    <th>예약자명</th>
                    <td><?=$row['name']?></td>
                </tr>
                <tr>
                    <th>사원번호</th>
                    <td><?=$row['sano']?></td>
                </tr>
				<tr>
					<th>휴대번호</th>
					<td><?=$row['hp']?></td>
				</tr>
				<tr>
					<th>이메일</th>
					<td><?=$row['email']?></td>
				</tr>
				<tr>
					<th>결과</th>
					<td><span>
                        <?
                            if($row['regflag'] == "8" ){
                                echo "취소";
                            }else if($row['regflag_two'] == "2"){
                                echo "취소 신청중"."<br>".$row['cancel_date'];
                            }else if($row['regflag_two'] == "3"){
                                echo "취소 확정"."<br>".$row['cancel_date'];
                            }else if($row['regflag_two'] == "4"){
                                echo "취소 불가"."<br>".$row['cancel_date'];
                            }else if($row['hide_yn'] == "Y" ){
                                echo "-";
                            }else if($row['hide_yn'] == "N" ){
                                echo $regFlagArray[$row['regflag']]."<br>".$row['cancel_date'];    
                            }else if($row['regflag'] == "5" && $row['type'] == "F" && $row['hide_yn'] == "N" ){
                                echo "선착순";
                            }else if($row['regflag'] == "9"  && $row['hide_yn'] == "N" ){
                                echo "탈락";
                            }
                        ?>                        
                    </span>
                    <?
                        if($row['regflag'] == "5" && $row['regflag_two'] != "2" && $row['hide_yn'] == "N" ){
                    ?>
                        <button type="button"  onclick="printPopup();">배정권 출력</button>
                    <?
                        }
                    ?>
                    </td>
				</tr>
            </table>

			<!--210603 하단 주의사항 추가 시작-->
            <div class="reserv-notice">
   				<div class="noticeBox noticeBox1">
   					<span class="nb-t">예약 전 유의사항</span>
   					<span class="nb-c">
   						<span class="nb-l">예약하기는 사전 접수후 추첨을 실시하며, 잔여 공실은 회사에 따라 실시간 처리됩니다.</span>
   						<span class="nb-l">입실예정일 3일 이내의 예약은 예약 후 12시간 이내에 기업임직원(자기분담금 존재)입금하셔야 예약확정이 됩니다.</span>
   					</span>
   				</div>
   				<div class="noticeBox noticeBox2">
   					<span class="nb-t">휴양기간 준수 사항</span>
   					<span class="nb-c">
   						<span class="nb-l">입실 퇴실 시간을 준수해 주시기바랍니다.</span>
   						<span class="nb-l">기준인원을 준수해주세요.</span>
   						<span class="nb-l">모든 휴양소 이용 임직원은 회사의 품위를 유지하는 행동을 부탁드립니다.</span>
   					</span>
   				</div>
   				<div class="noticeBox noticeBox3">
   					<span class="nb-t">환불 취소 및 규정</span>
   					<span class="nb-c">
   						<span class="nb-l">예약 취소는 이용일 7일전까지 자유롭게 취소가 가능합니다.</span>
   						<span class="nb-l">사용일 기준 7일 이내의 경우 기업의 휴양소 담당자의 승인요합니다.</span>
   					</span>
   				</div>
   				<div class="noticeBox noticeBox4">
   					<span class="nb-t">예약 취소 및 이용제한</span>
   					<span class="nb-c">
   						<span class="nb-i">사전 승인없는 예약 취소 및 확정후 미 사용하는 경우 차년 이용자 선정에서 불이익이 존재할 수 있습니다.</span>
   						<span class="nb-l">취소 가능 기간 : 100% 환불 처리</span>
   						<span class="nb-l">이용일 7일 이내 미승인 취소 : 회사 규정에 따른 처리</span>
   					</span>
   				</div>
   			</div>
			<!--210603 하단 주의사항 추가 시작 끝-->
                        
			<div class="cancel-btn">
            <?
                if($row['regflag'] != "8" && $row['regflag_two'] != "2" ){
            ?>
				<button type="button" onClick="revCancel();" >예약 취소하기</button>
            <?
                }else{
                    echo "<br />";
                }
            ?>    
			</div>
    	</div>
    </div>
    <footer></footer>

	<div class="pg-modal modal-wrap2">
			<div class="modal-con">
				<div class="modal-top">
					<div class="close-modal2">
						<img src="../img/common/close.png" alt="">
					</div>
				</div>
				<div class="modal-bot">
					<p class="rr-title">
						결제하기
					</p>
					<div class="pg-sel">
						<a href="javascript:onCash();">
                        <div class="cash">
							<img src="../img/sub/cash.png" alt="">
							<p>현금결제</p>
						</div>
                        </a>
                        <a href="javascript:onCredit();">
						<div class="credit">
							<img src="../img/sub/credit.png" alt="">
							<p>카드결제</p>
						</div>
                        </a>
					</div>
				</div>
			</div>
            
	</div>
    <script language="javascript" type="text/javascript" src="https://stdpay.inicis.com/stdjs/INIStdPay.js" charset="UTF-8"></script> 

<!-- 이니시스 결제모듈용 폼 시작 (PC)-->
<form name="SendPayForm_id" id="SendPayForm_id" method="post" action="" target="ifrm">
			<input type="hidden" name="version" value="1.0">
			<input type="hidden" name="mid" value="<?php echo $mid ?>" >
			<input type="hidden" name="goodname" id="pay_goodname" value="<?=$row['comname']?>">
			<input type="hidden" name="oid" value="<?php echo $orderNumber ?>" >
			<input type="hidden" name="price" id="pay_price" value="<?=$row['per_amount']?>" >
			<input type="hidden" name="currency" value="WON" >
			<input type="hidden" name="buyername" value="<?=$row['name']?>" >
			<input type="hidden" name="buyertel" value="<?=$row['hp']?>" >
			<input type="hidden" name="buyeremail" value="<?=$row['email']?>" >
			<input type="hidden" name="timestamp" id="timestamp" value="<?php echo $timestamp ?>" >
			<input type="hidden" name="signature" id="signature" value="<?php echo $sign ?>" >
			<input type="hidden" name="returnUrl" value="<?php echo $inc_fdata_domain?>/mypage/INIresult.php" >
			<input type="hidden" name="closeUrl" value="<?php echo $inc_fdata_domain?>/mypage/INIStdPaySample/close.php" >
			<input type="hidden" name="mKey" id="mKey" value="<?php echo $mKey?>" >
			<input type="hidden" name="gopaymethod" id="gopaymethod" value="Card" >
            <input type="hidden" name="offerPeriod" value="" >
            <input type="hidden" name="acceptmethod" value="HPP(1):no_receipt:va_receipt:vbanknoreg(0):below1000" >
			<input type="hidden" name="merchantData" id="merchantData" value="<?=$etcdata?>">
</form>
<!-- 이니시스 결제모듈용 폼 시작 (PC)-->

<!-- 이니시스 결제모듈용 폼 시작 (MOBIle)-->
<form name="mobileweb" method="post" accept-charset="euc-kr" target="ifrm"> 

<!-- 리턴받는 가맹점 URL 세팅 -->
<input type="hidden" name="P_NEXT_URL" value="<?php echo $inc_fdata_domain?>/mypage/INIresult_mobile.php"> 

<!-- 지불수단 선택 (신용카드,계좌이체,가상계좌,휴대폰) -->
<input type="hidden" name="P_INI_PAYMENT"  value=""> 

<!-- 복합/옵션 파라미터  // -->
<input type="hidden" name="P_RESERVED" value="twotrs_isp=Y&block_isp=Y&twotrs_isp_noti=N"> 
  
<input type="hidden" name="P_MID" value="<?= $mid ?>"> 
<input type="hidden" name="P_OID" value="<?= $orderNumber ?>">  
<input type="hidden" name="P_GOODS" value="<?=$row['comname']?>"> 
<input type="hidden" name="P_AMT" value="<?=$row['per_amount']?>"> 
<input type="hidden" name="P_UNAME" value="<?=$row['name']?>"> 

<input type="hidden" name="P_MOBILE" value="<?=$row['hp']?>"> 
<input type="hidden" name="P_EMAIL" value="<?=$row['email']?>"> 
<input type="hidden" name="P_NOTI" value="<?=$etcdata?>" >
</form> 

<script language="javascript">

          
    //PC 결제
	function pc_submit(_frm)
	{
		_frm.submit();
	}


	function mcancel()
	{
		// 취소
		closeEvent();
	}

    // 영수증 출력 스크립트
    function receiptView(tr_no)
    {
        if(tr_no.substr(0,1) == "1"){  // 신용카드 영수증 출력

            receiptWin = "http://pgims.ksnet.co.kr/pg_infoc/src/bill/credit_view.jsp?tr_no="+tr_no;
            window.open(receiptWin , "" , "scrollbars=no,width=434,height=700, left=100, top=50");

        }else if(tr_no.substr(0,1) == "2"){ // 현금영수증 출력

            receiptWin = "http://pgims.ksnet.co.kr/pg_infoc/src/bill/ps2.jsp?s_pg_deal_numb="+tr_no;
            window.open(receiptWin , "" , "scrollbars=no,width=434,height=580, left=100, top=50");

        }
    }

</script>


<iframe name="ifrm" id="ifrm" width="0" height="0"></iframe>
</body>
</html>