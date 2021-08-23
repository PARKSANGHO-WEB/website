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
	<script src="../js/common.js"></script>
	<script src="../js/wSelect.js"></script>
	<link rel="stylesheet" href="../js/common.js">
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
	<section class="intro">
		<div class="sub-ban">
			<p class="sub-title">EPL 소개</p>
			<div class="sub-menu">
				<ul>
					<li class="active">
						<a href="./intro.php">EPL이란?</a>
						<div class="underline"></div>
					</li>
					<li>
						<a href="./dictation.php">받아쓰기란?</a>
						<div class="underline"></div>
					</li>
				</ul>
			</div>
		</div>
		<form action="#">
			<div class="sub-con">
				<div class="intro-top">
					<p class="intro-hi">
						안녕하세요.
					</p>
					<div class="bar"></div>
					<p class="under-text">우리는 영어리스닝의 후발주자와 같이 합니다.</p>
					<img src="../img/sub/intro-1.png" alt="">
					<p class="bot-ment">
						후발주자란 영어를 모국어로 갖지 않은 사람들을 말합니다.<br />어려서 영어를 모국어처럼 접하는 환경에 있던 사람들은 후발주자라<br />할 수 없겠네요.<br />아마도 우리 주변의 대부분의 사람들은 후발주자일 거에요. <br />우리는 후발주자의 어려움을 너무 잘 이해하거든요. 
					</p>
				</div>
				<div class="intro-center">
					<p>
						EPL은 마라톤 정신이라고 말하고 싶어요.<br />100미터 전력질주가 아니거든요. <br />몇 바퀴 트랙을 뛰고 금메달을 노리는 단거리 스프린터가 아니랍니다. <br />우리 후발주자는 장거리 선수의 운명으로 태어났다고나 할까요?<br />영어리스닝은 절대 단거리 종목이 아니에요. <br />“우리 후발주자는 마라톤 선수다.” 이렇게 마음 먹어야 해요. 
					</p>
					<img src="../img/sub/intro-2.png" alt="">
				</div>
				<div class="intro-bot">
					<img src="../img/sub/intro-3.png" alt="">
					<p>
						EPL은 오뚜기 정신이랍니다.<br />후발주자가 영어리스닝의 야심을 갖는 순간<br />좌절과 고통은 시작된 것이에요. <br />다 들리는 것 같았지만 곧 분명 아니라는 것을 알거에요.<br />다시 일어나야 해요. <br />우리는 영어리스닝에 손쉬운 길이 있다고 절대 말하지 않을 겁니다.<br />겁을 주는 것이 아니거든요.<br />단지 그런 것은 없기 때문이에요.<br />
						시간이 지나면 아시게 될거에요. 

					</p>
				</div>
			</div>
		</form>
	</section>
	<footer></footer>
	
	


	<!--  결제 취소 모달	-->
	<div class="paycan-modal modal-wrap">
		<form action="#">
			<div class="modal-con">
				<div class="modal-top">
					<div class="close-modal">
						<img src="../img/common/close-modal.png" alt="">
					</div>
				</div>
				<p class="modal-title">
					결제 취소 신청을<br />하시겠습니까?
				</p>
				<div class="btn-wrap">
					<button class="paycan-yes" type="button">예</button>
					<button class="close-modal" type="button">아니오</button>
				</div>
			</div>
		</form>
	</div>
	
	
	
		<div class="error-modal error2-modal long-error">
			<form action="#">
				<div class="modal-con">
					<div class="modal-top">
						<div class="close2-modal">
							<img src="../img/common/close-modal.png" alt="">
						</div>
					</div>
					<p>결제 취소는 멤버십 사용 기록이 없어야 가능합니다. <br />고객센터로 문의 바랍니다.</p>
				</div>
			</form>
		</div>
</body>
</html>