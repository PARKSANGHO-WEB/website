<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../css/sub.css">
	<link rel="stylesheet" href="../css/header.css">
	<link rel="stylesheet" href="../css/common.css">
	<link rel="stylesheet" href="../css/wSelect.css">
	<meta charset="UTF-8">
	<title>EPL</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="../js/wSelect.js"></script>
</head>
<body>
	<script>
	
        $(document).ready(function() {
            $("header").load("./inc/header.php");
            $("footer").load("./inc/footer.php");
        });
		
		
		
		
	</script>
	
	<script>

		
	</script>
	
	<header></header>
	<section class="member">
		<form action="#">
			<div class="member-sel">
				<div class="ms-wrap">
					<p class="ms-t">멤버십 선택</p>
					<div class="mem-list">
						<ul>
							<li class="lm-big">
								<img src="../img/sub/check-t.png" alt="" class="checked">
								<span class="ml-t">1개월 멤버십</span>
								<span class="mem-spe">포함상품</span>
								<span class="mem-title">EPL 받아쓰기 20,000</span>
								<span class="mem-price">9,800원</span>
								<button type="button">멤버십 선택</button>
							</li>
							<li class="lm-big">
								<img src="../img/sub/check-t.png" alt="" class="checked">
								<span class="ml-t">3개월 멤버십</span>
								<span class="mem-spe">포함상품</span>
								<span class="mem-title">EPL 받아쓰기 20,000</span>
								<span class="mem-price">27,000원</span>
								<button type="button">멤버십 선택</button>
							</li>
							<li class="lm-big">
								<img src="../img/sub/check-t.png" alt="" class="checked">
								<span class="ml-t">5 개월 멤버십</span>
								<span class="mem-spe">포함상품</span>
								<span class="mem-title">EPL 받아쓰기 20,000</span>
								<span class="mem-price">39,500원</span>
								<button type="button">멤버십 선택</button>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="member-con">
				<div class="mc-t">결제정보 입력</div>
				<div class="member-info">
					<div class="mi-t">
						<span>멤버십 정보</span>
					</div>
					<div class="mi-c">
						<div class="mic-l">
							<div class="mic-t">
								<span>멤버십 개월수</span>
							</div>
							<div class="mic-c">
								<input class="month-in" type="text" placeholder="-">
							</div>
						</div>
						<div class="mic-r">
							<div class="mic-t">
								<span>결제금액</span>
							</div>
							<div class="mic-c">
								<input class="price-in" type="text" placeholder="-">
							</div>
						</div>
					</div>
				</div>
				<div class="member-ment">
					<div class="mi-t">
						<span>결제 및 취소규정 <span>(필수)</span></span>
					</div>
					<div class="mi-c">
						<div class="mic-c">
							<p>제 26조 (회원의 청약 철회와 환불)<br />
								1. 회사는 다음 각호의 사유에 해당되는 경우에는 각호의 사유가 발생한 날로부터 기납입한 서비스 이용료를 일할 계산하여 그 잔액을 환불합니다.<br />
								(1) EPL "유료 서비스"에 대한 행정처분으로 인하여 서비스를 제공할 수 없게 된 경우<br />
								(2) 회사의 귀책사유로 인하여 "유료 서비스"를 제공할 수 없게 된 경우<br />
								2. "회원"은 콘텐츠에 대한 환불을 청약(구매, 결제) 일로부터 7일 이내에 요청하시면 전액환불이 가능합니다. 단, 다음 각 호의 경우에는 이용자가 환불을 요청할 수 없습니다.<br />
								(1) 서비스 사용 기록이 남아있는 경우 (예: 다운로드나 스트리밍 기록)<br />
								(2) 서비스 업데이트를 통한 문제 해결이 가능함에도 회원의 의사로 이를 거부하여 서비스를 이용하지 못하는 경우<br />
								(3) 회원의 실수로 해당 서비스를 이용하지 못하는 경우<br />
								3. "회원"은 회사 고객센터나 웹사이트를 통해 환불 신청이 가능합니다.<br />
								4. "회원"이 전 1항 또는 2항에 의하여 환불을 요구할 경우, "회사"는 반환할 사유가 발생한 날로부터 5일 이내에 반환하여야 합니다.
							</p>
						</div>
					</div>
				</div>
					<div class="memcheck">
						<input type="checkbox" id="withdraw" name="withdraw">
						<label for="withdraw">동의합니다.</label>
					</div>
					<div class="btn-wrap">
						<button type="button">결제하기</button>
						<button type="button">취소</button>
					</div>
			</div>
		</form>
	</section>
	<footer></footer>
	
	
</body>
</html>