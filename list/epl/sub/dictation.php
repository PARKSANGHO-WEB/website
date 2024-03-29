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
					<li>
						<a href="./intro.php">EPL이란?</a>
						<div class="underline"></div>
					</li>
					<li class="active"
					>
						<a href="./dictation.php">받아쓰기란?</a>
						<div class="underline"></div>
					</li>
				</ul>
			</div>
		</div>
		<form action="#">
			
			<div class="sub-con tab-con">
				<div class="dict-top">
					<p class="dict-hi">
						이곳은 트레이닝 하는 곳입니다.<br />받아쓰기 방식으로 트레이닝 하는 비대면 온라인 공간입니다. 
					</p>
					<div class="bar"></div>
					<p class="under-text">왜 받아쓰기냐고요?</p>
					<p class="bot-ment">
						받아쓰기는 집중력 극대화의 방법이에요. <br />리스닝을 하다 보면 어느새 다른 생각을 하거든요.<br />어제 있었던 일, 내일 할 일, 좋은 일, 짜증나는 일.<br />받아쓰기는 초집중을 가능하게 합니다. 
					</p>
					<div class="dict-bot">
						<div class="db-t">
							<p>
								받아쓰기는 몸으로 공부하게 합니다.<br />리스닝은 머리로 공부하는 것이 아니라 몸으로 공부해야 한다<br />고들 말해요.<br />흔히들 “체득”이라고 표현이지요.<br />받아쓰게 되면 스펀지에 물이 스며들듯이 몸에 영어가 스며들<br />게 됩니다. 
							</p>
							<img src="../img/sub/dict-1.png" alt="">
						</div>
						<div class="db-b">
							<img src="../img/sub/dict-2.png" alt="">
							<p>
								이 좋은 것을 왜 못했을까요?<br />사실 받아쓰기 예찬론자들은 많이 있었습니다.<br />그런데 지금까지 왜 제대로 못했을까요?<br />공부하기가 너무 불편했지요.<br />조금 들으면 휙~~~~ 지나가 버리니 어떻게 받아쓰나요?<br />한 손에 연필.<br />다른 한 손에 PLAY, REWIND, REPLAY<br />정말 불편하죠!
							</p>
						</div>
					</div>
				</div>
				<div class="dict-center">
					<div class="bar"></div> 
					<p class="dict-hi">
						그래서!
					</p>
					<p class="dict-hi2">
						EPL에서는 힘들게 개발했답니다. <br />IT시대잖아요.<br />종이에 받아쓰는게 아니라 웹상에서 받아쓸 수 있도록 개발했습니다. <br />정확하게 말하면 받아타이핑이에요.<br />종이도 볼펜도 필요없이 로그인만 하면 언제든지 공부할 수 있어요. 
					</p>
					<div class="dict2-bot">
						<div class="d2b-left">
							<p>기존 영어받아적기</p>
							<img src="../img/sub/dict-3.png" alt="">
							<p>한 손에 연필.<br />다른 한 손에 PLAY 다시 REPLAY<br />불편함 up~</p>
						</div>
						<div class="d2b-right">
							<p>English Power Listening</p>
							<img src="../img/sub/dict-4.png" alt="">
							<p>귀는 듣고 손은 오로지 자판에.<br />초집중 가능해요!</p>
						</div>
					</div>
					<p class="dic2-lastp">
						오디오플레이어도 새로 특화시켜 개발했답니다.<br />보시면 알겠지만 마우스에 손도 안가게 만들었네요.<br />초집중해서 받아타이핑만 할 수 있도록 각종버튼을 특화시켰네요.<br />이러한 오디오 버튼은 어디서 본적이 없을 거에요. 
					</p>
					<div class="dict-last">
						<p>이제 받아쓰기, IT 시대의 효과적인 재미있는 공부랍니다. </p>
					</div>
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
	
<!--	에러모달   -->
	
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