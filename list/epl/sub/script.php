<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Frank+Ruhl+Libre:wght@300;400;500;700;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../css/sub.css">
	<link rel="stylesheet" href="../css/header.css">
	<link rel="stylesheet" href="../css/common.css">
	<link rel="stylesheet" href="../css/wSelect.css">
	<link rel="stylesheet" href="../css/green-audio-player.css">
	<meta charset="UTF-8">
	<title>EPL</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="../js/wSelect.js"></script>
	<script src="../js/green-audio-player.js"></script>
</head>
<body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new GreenAudioPlayer('.ready-player-1', { 
				showTooltips: true, 
				showDownloadButton: false,
				enableKeystrokes: true
				
			});
        });
    </script>
	<script>
	
        $(document).ready(function() {
            $("header").load("./inc/header.php");
            $("footer").load("./inc/footer.php");
        });
	</script>
	
	<header></header>
	<script>


	function play() {
		var audio = document.getElementById("audio");
		audio.play();
	}
		
	function pause() {
		var audio = document.getElementById("audio");
		audio.pause();
	}
		
		
	function pause2() {
		var audio = document.getElementById("audio");
		audio.pause();
        audio.currentTime = 0;
		
	}
		
	function rewind() {

		var audio = document.getElementById('audio');
		audio.currentTime -= 2.0; /**tried also with audio.currentTime here. Didn't worked **/

		
	}
		
		
    </script>
	<section>
			<div class="sub-con">
				<div class="study-room">
					<div class="study-top">
						<form action="#">
							<div class="audio-title">
								<p class="big-t">1. The United Kingdom</p>
								<img src="../img/sub/title-arrow.png" alt="">
								<p class="small-t">1-1.The four countries </p>
							</div>
							<div class="study-audio">
								<div class="audio-thumb">
									<img src="../img/sub/main-sample.png" alt="">
								</div>
								<div class="ready-player-1">
									<audio id="audio" crossorigin preload="none">
										<source src="../audio/example-1.mp3" type="audio/mpeg">
									</audio>
									<div class="btn-wrap">
										<div class="rewind">
											<button type="button" class="rewind" onclick="rewind()">
												<span>2 sec</span>
											</button>
										</div>
										<div class="playwrap">
											<button class="on" id="playbtn" type="button" value="PLAY" onclick="play()"></button>
											<button id="stopbtn" type="button" value="PLAY" onclick="pause()"></button>
										</div>
										<div class="restart">
											<button id="rebtn" type="button" onclick="pause2()"></button>
										</div>
									</div>
									<div class="bottom-btn">
										<button type="button" class="all-re active">전체반복</button>
										<button type="button" class="re310">3x10</button>
										<button type="button" class="re320">3x20</button>
										<button type="button" class="re55">5x5</button>
										<button type="button" class="re510">5x10</button>
										<button type="button" class="re520">5x20</button>
										<button type="button" class="re105">10x5</button>
										<button type="button" class="re1010">10x10</button>
									</div>
								</div>
							</div>
						</form>
					</div>				
					<div class="study-text">
						<form action="#">
							<div class="st-t">
								<div class="st-left">
									<div class="st-target">
										<span class="stt-t">
											목표레벨
										</span>
										<span class="stt-c">100%</span>
									</div>
									<div class="st-success">
										<span class="stt-t">
											성공률
										</span>
										<span class="stt-c">50%</span>
									</div>
								</div>
								<div class="st-right">
									<div class="success">
										<div class="okay-script">
											<span>정답스크립트가 해제되었습니다!</span>
										</div>
										<button class="view-answer" type="button">스크립트 열람</button>
									</div>
									<button class="check-false" type="button">오답보기</button>
								</div>
							</div>
							<div class="input-script">
								<textarea class="script-text" name="script-text"></textarea>
							</div>
							<div class="btn">
								<button class="reset-script" type="button">초기화</button>
								<button class="save-script" type="button">저장하기</button>
								<button class="out-script" type="button">나가기</button>
							</div>
						</form>
					</div>
					<div class="script-info">
						<form action="#">
							<div class="script-hint">
								<div class="sh-t">
									<span>힌트창</span>
									<button class="view-hint" type="button">hint 보기</button>
								</div>
								<div class="sh-c">
									<p>
										힌트예시입니다.<br />
										힌트예시입니다.<br />
										힌트예시입니다.<br />
										힌트예시입니다.<br />
										힌트예시입니다.<br />
										힌트예시입니다.<br />
										힌트예시입니다.<br />
										힌트예시입니다.<br />
										힌트예시입니다.<br />
										힌트예시입니다.<br />
										힌트예시입니다.<br />
										힌트예시입니다.<br />
										힌트예시입니다.<br />
										힌트예시입니다.<br />
										힌트예시입니다.<br />
										힌트예시입니다.<br />
									</p>
								</div>
							</div>
							<div class="script-answer">
								<div class="sh-t">
									<span>정답스크립트창</span>
									<button type="button">한/영</button>
								</div>
								<div class="sa-c">
									<p>
										정답스크립트 예시입니다..<br />
										정답스크립트 예시입니다..<br />
										정답스크립트 예시입니다..<br />
										정답스크립트 예시입니다..<br />
										정답스크립트 예시입니다..<br />
										정답스크립트 예시입니다..<br />
										정답스크립트 예시입니다..<br />
										정답스크립트 예시입니다..<br />
										정답스크립트 예시입니다..<br />
										정답스크립트 예시입니다..<br />
										정답스크립트 예시입니다..<br />
										정답스크립트 예시입니다..<br />
										정답스크립트 예시입니다..<br />
										정답스크립트 예시입니다..<br />
										정답스크립트 예시입니다..<br />
										정답스크립트 예시입니다..<br />
									</p>
								</div>
							</div>
							<div class="script-notice">
								<div class="sh-t">
									<span>주의사항!</span>
								</div>
								<div class="sn-c">
									<p>
										-spelling이 정확히 맞아야 합니다.<br />-Apostrophe (소유격이나 축약형에 쓰는 표시)는 정확히 해야 합니다.<br />예) the boy’s book, He’ll be there.<br />-대소문자 구분하지 않습니다. 모두 맞는 것으로 합니다.<br />-단어가 영국식, 미국식 표기 혼용으로 쓰이는 경우 영국식 표기를 정답으로 합니다.<br />-숫자 및 연도의 표기는 아라비아 숫자를 맞는 것으로 합니다.<br />-마침표(full stop, period), 물음표 (question mark), 기호(sign), 하이픈(hyphen), 쉼표(comma), 인용(quotation), 느낌표(exclamation mark), 괄호(bracket)는 점수와 무관합니다.<br />-기타 더 자세한 내용은 Q&A를 참고하시기 바랍니다. 
									</p>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
	</section>
	<footer></footer>
	
	
</body>
</html>