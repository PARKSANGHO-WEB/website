<? include("../inc/header.php");  ?>
<link rel="stylesheet" href="/css/reserv.css">

<?
    $ridx = trim(sqlfilter($_REQUEST['ridx']));

	$sql = " SELECT a.ridx, a.chasu,  b.comname, date_format(a.cymd, '%Y-%m-%d') as cymd, a.useday, c.flag, ";
	$sql .= "   d.rArea, d.rType, d.rAvg, d.rMax, d.rInfra, a.pcnt1, a.pcnt2, (c.per_amount * a.useday)as per_amount, ";
    $sql .= "   a.name, a.sano, a.hp, a.email, a.regflag, a.regflag_two, c.pg_yn  ";
    $sql .= " FROM tb_reInfo a, tb_hu b, tb_comhuM c, tb_huType d ";
	$sql .= " WHERE a.hidx = b.idx   AND a.midx = c.midx  AND b.idx = d.idx ";
    $sql .= " AND a.seq = d.seq   AND a.ridx = '{$ridx}'  ";    

    $rs = mysqli_query($gconnet, $sql);
    $row = mysqli_fetch_array($rs); 

    $paySql = " SELECT trans_no FROM tb_pay WHERE ridx = '{$ridx}' AND authyn = 'O' ";    
    $payRs = mysqli_query($gconnet, $paySql);
    $payRow = mysqli_fetch_array($payRs); 


    //이니시스

    $order_num= make_order_num($order_gift_yn);

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
            $('#mb_sndPaymethod').val('0010000000');
            mobile_pay(document.authFrmFrame);            
        }else{
            $('#sndPayMethod').val('0010000000');
            pc_submit(document.KSPayWeb);
        }
    }

    function onCredit(){
        
        if(isMobile()){
            $('#mb_sndPaymethod').val('1000000000');
            mobile_pay(document.authFrmFrame);
        }else{
            $('#sndPayMethod').val('1000000000');
            document.frm_payment.submit(); 
        }
    }

    //결제 성공 시 결제버튼 숨김
    function payResult(){
        var f = document.frm;
        f.target = "_self";
        f.action = "reserv_view.php";
        f.submit();
    }

    function pay() {
        INIStdPay.pay('SendPayForm_id');
    }

    function revCancel(){

        var cymd = new Date("<?=$row['cymd']?>");

        var revday = new Date(cymd.getFullYear(), cymd.getMonth(),  cymd.getDate());
        var today = new Date();
        
        var diff = (revday.getTime() - today.getTime());
        diff = Math.ceil(diff / (1000*3600 *24));

        if( diff < 1){
            alert('예약 취소 불가합니다.');
        }else{

            $.ajax({
                url		: "/mypage/reserv_proc.php",
                type	: "POST",
                data	: { ridx: $('#ridx').val(), regflag:$('#regflag').val() },
                async	: false,
                dataType	: "json",
                success		: function(data){
                    if ( data.success == "true" ){
                        alert("예약 취소 되었습니다.");
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
                        if($row['pg_yn'] =="Y" && $row['regflag'] == "5" && $row['per_amount'] !="" && $row['per_amount'] > 0 ){
                            
                            if(empty($payRow['trans_no'])){
                    ?>
                            <button class="go-pg" type="button" id="payBtn">결제</button>
                    <?
                            }else{
                    ?>
                            <button type="button" onClick="receiptView('<?=$payRow['trans_no']?>');">영수증출력</button>
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
                            if($row['regflag_two'] == "2"){
                                echo "당첨 후 취소 신청";
                            }else if($row['regflag_two'] == "3"){
                                echo "당첨 후 취소";
                            }else if($row['regflag_two'] == "4"){
                                echo "당첨 후 취소 불가";
                            }else{
                                echo $regFlagArray[$row['regflag']];     
                            }
                        ?>                        
                    </span>
                    <?
                        if($row['regflag'] == "5"){
                    ?>
                        <button type="button"  onclick="printPopup();">배정권 출력</button>
                    <?
                        }
                    ?>
                    </td>
				</tr>
            </table>
			<div class="cancel-btn">
            <?
                if($row['regflag'] == "5"){
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
                        <a href="javascript:pay();">
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

<form name="SendPayForm_id" id="SendPayForm_id" method="post" action="" target="ifrm">
			<!-- 이니시스 결제모듈용 폼 시작 -->
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
			<input type="hidden" name="returnUrl" value="<?php echo $inc_fdata_domain?>/mypage/INIStdPaySample/INIStdPayReturn.php" >
			<input type="hidden" name="closeUrl" value="<?php echo $inc_fdata_domain?>/mypage/INIStdPaySample/close.php" >
			<input type="hidden" name="mKey" id="mKey" value="<?php echo $mKey?>" >
			<input type="hidden" name="gopaymethod" id="gopaymethod" value="Card" >
            <input type="hidden" name="offerPeriod" value="" >
            <input type="hidden" name="acceptmethod" value="HPP(1):no_receipt:va_receipt:vbanknoreg(0):below1000" >
			<input type="hidden" name="merchantData" id="merchantData" value="<?=$etcdata?>">
			<!-- 이니시스 결제모듈용 폼 종료 -->

</form>

<link href="./kspay/pc/css/pgstyle.css" rel="stylesheet" type="text/css" charset="utf-8">
<link href="http://kspay.ksnet.to/store/KSPayFlashV1.3/mall/css/pgstyle.css" rel="stylesheet" type="text/css" charset="euc-kr">
<script language="javascript" src="http://kspay.ksnet.to/store/KSPayWebV1.4/js/kspay_web_ssl.js"></script>

<script language="javascript">

    //모바일 결제
    function mobile_pay(_frm) 
	{
		// sndReply는 kspay_wh_rcv.php (결제승인 후 결과값들을 본창의 KSPayWeb Form에 넘겨주는 페이지)의 절대경로를 넣어줍니다. 
 		_frm.sndReply.value = getLocalUrl("./kspay/mobile/kspay_wh_result.php") ;

		var agent = navigator.userAgent;
		var midx		= agent.indexOf("MSIE");
		var out_size	= (midx != -1 && agent.charAt(midx+5) < '7');

		//_frm.action ='http://kspay.ksnet.to/store/KSPayMobileV1.4/KSPayPWeb.jsp';    //리얼
		//_frm.submit();


        var pop = "popupOpener2";
        window.open ("",pop, "width=100%, height=100%" );
        var f = _frm;
        f.target = pop;
        f.action = 'http://kspay.ksnet.to/store/KSPayMobileV1.4/KSPayPWeb.jsp';    //리얼
        f.submit();

    }
          
    //PC 결제
	function pc_submit(_frm)
	{
		_frm.submit();
	}
	function getLocalUrl(mypage) 
	{ 
		var myloc = location.href; 
		return myloc.substring(0, myloc.lastIndexOf('/')) + '/' + mypage;
	} 
	// goResult() - 함수설명 : 결재완료후 결과값을 지정된 결과페이지(kspay_wh_result.php)로 전송합니다.
	function goResult(){
		document.KSPayWeb.target = "ifrm";
		document.KSPayWeb.action = "./kspay/pc/kspay_wh_result.php";
		document.KSPayWeb.submit();
	}
	// eparamSet() - 함수설명 : 결재완료후 (kspay_wh_rcv.php로부터)결과값을 받아 지정된 결과페이지(kspay_wh_result.php)로 전송될 form에 세팅합니다.
	function eparamSet(rcid, rctype, rhash){
		document.KSPayWeb.reWHCid.value 	= rcid;
		document.KSPayWeb.reWHCtype.value = rctype  ;
		document.KSPayWeb.reWHHash.value 	= rhash  ;
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


<form name="authFrmFrame" method="post" action="./kspay/mobile/kspay_wh_result.php" target="_self" >
<input type="hidden" name="sndPaymethod"  id="mb_sndPaymethod" value="">
<input type="hidden" name=sndStoreid size=10 maxlength=10 value="2999199999"> <!-- 상점아이디 -->
<input type="hidden" name=sndCurrencytype size=30 maxlength=3 value="WON"> 
<!--상품명은 30Byte(한글 15자) 입니다. 특수문자 ' " - ` 는 사용하실수 없습니다. 따옴표,쌍따옴표,빼기,백쿼테이션 -->
<input type="hidden" name=sndOrdernumber size=30 maxlength=30 value="<?=$ridx?>"> <!-- 주문번호 -->
<input type="hidden" name=sndAllregid size=30 maxlength=13 value=""> <!--주민등록번호는 필수값이 아닙니다.-->
<!--상점에서 적용할 할부개월수를 세팅합니다. 여기서 세팅하신 값은 KSPAY결재팝업창에서 고객이 스크롤선택하게 됩니다 -->
<!--아래의 예의경우 고객은 0~12개월의 할부거래를 선택할수있게 됩니다. -->
<input type="hidden" name=sndInstallmenttype size=30 maxlength=30 value="0:2:3:4:5:6:7:8:9:10:11:12">
<!--무이자 구분값은 중요합니다. 무이자 선택하게 되면 상점쪽에서 이자를 내셔야합니다.-->
<!--무이자 할부를 적용하지 않는 업체는 value='NONE" 로 넘겨주셔야 합니다. -->
<!--예 : 모두 무이자 적용할 때는 value="ALL" / 무이자 미적용할 때는 value="NONE" -->
<!--예 : 3,4,5,6개월 무이자 적용할 때는 value="3:4:5:6" -->
<input type="hidden" name=sndInteresttype size=30 maxlength=30 value="NONE">
<!-- 신용카드표시구분 -->
<input type="hidden" name=sndShowcard size=30 maxlength=30 value="C">
<!--상품명은 30Byte(한글 15자)입니다. 특수문자 ' " - ` 는 사용하실수 없습니다. 따옴표,쌍따옴표,빼기,백쿼테이션 -->
<input type="hidden" name=sndGoodname size=30 maxlength=30 value="<?=$row['comname']?> <?=tranStrDate($row['cymd'],'kordis.')?>">
<input type="hidden" name=sndAmount size=30 maxlength=9 value="<?=($row['per_amount'])?>">
<input type="hidden" name=sndOrdername size=30 maxlength=20 value="<?=$row['name']?>">
<input type="hidden" name=sndEmail size=30 maxlength=50 value="<?=$row['email']?>">
<input type="hidden" name=sndMobile size=30 maxlength=12 value="<?=str_replace("-","",$row['hp'])?>">

<input type="hidden" name=sndCharSet              value="utf-8">                       <!--  가맹점 CharSet 설정변수 --> 
<input type="hidden" name=sndReply           		value="">
<input type="hidden" name=sndEscrow          	    value="0">                           <!--에스크로적용여부-- 0: 적용안함, 1: 적용함 -->
<input type="hidden" name=sndVirExpDt     		value="">                            <!-- 마감일시 -->
<input type="hidden" name=sndVirExpTm     		value="">                            <!-- 마감시간 -->
<input type="hidden" name=sndStoreName       	    value="휴나라">             <!--회사명을 한글로 넣어주세요(최대20byte)-->
<input type="hidden" name=sndStoreNameEng    	    value="hunara">                       <!--회사명을 영어로 넣어주세요(최대20byte)-->
<input type="hidden" name=sndStoreDomain     	    value="http://www.hunara.com"> <!-- 회사 도메인을 http://를 포함해서 넣어주세요-->
<input type="hidden" name=sndGoodType		   		value="1">							 <!--실물(1) / 디지털(2) -->
<input type="hidden" name=sndUseBonusPoint		value="">   						 <!-- 포인트거래시 60 -->                                                                                                                                                           
<input type="hidden" name=sndRtApp		   	    value="">							 <!-- 하이브리드APP 형태로 개발시 사용하는 변수 -->
<input type="hidden" name=sndStoreCeoName         value="">                            <!--  카카오페이용 상점대표자명 --> 
<input type="hidden" name=sndStorePhoneNo         value="">                            <!--  카카오페이 연락처 --> 
<input type="hidden" name=sndStoreAddress         value="">                            <!--  카카오페이 주소 --> 
</form>

<iframe name="ifrm" id="ifrm" width="0" height="0"></iframe>
</body>
</html>