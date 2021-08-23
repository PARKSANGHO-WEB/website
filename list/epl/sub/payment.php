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
	<section class="mypage">
		<div class="sub-ban">
			<p class="sub-title">내 정보</p>
			<div class="sub-menu">
				<ul>
					<li>
						<a href="./mypage.php">회원정보 수정</a>
						<div class="underline"></div>
					</li>
					<li class="active">
						<a href="./payment.php">결제정보</a>
						<div class="underline"></div>
					</li>
				</ul>
			</div>
		</div>
		<form action="#">
		
			<div class="sub-con tab-con">
				<div class="pay-info">
					<div class="pay-top">
						<div class="pt-left">
							<img src="../img/sub/mem-card.png" alt="">
						</div>
						<div class="pt-right">
							<div class="pr-line pr-line1">
								<span class="pr-t">멤버십&nbsp;:&nbsp;</span>
								<span class="pr-c">3개월 EPL 멤버십</span>
							</div>
							<div class="pr-line pr-line2">
								<span class="pr-t">적용기간&nbsp;:&nbsp;</span>
								<span class="pr-c">2021.08.08 ~ 2021.11.08</span>
							</div>
							<div class="pr-line pr-line3">
								<span class="pr-t">결제 정보&nbsp;:&nbsp;</span>
								<span class="pr-c">2021.08.08</span>
								<button class="cancel-btn" type="button">결제취소</button>
							</div>
						</div>
					</div>
					<div class="pay-table">
						<div class="table-border"></div>
						<table>
							<thead>
								<tr>
									<th>결제일</th>
									<th>멤버십명</th>
									<th>멤버십 적용기간</th>
									<th>결제금액</th>
									<th>결제방법</th>
									<th>구분</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>2021.08.08</td>
									<td>3개월 EPL 멤버십</td>
									<td>2021.08.08~2021.11.08</td>
									<td>27,000원</td>
									<td>카드</td>
									<td>적용중</td>
								</tr>
								<tr>
									<td>2021.08.08</td>
									<td>1개월 EPL 멤버십</td>
									<td>2021.08.08~2021.11.08</td>
									<td>27,000원</td>
									<td>카드</td>
									<td>적용중</td>
								</tr>
								<tr>
									<td>2021.08.08</td>
									<td>3개월 EPL 멤버십</td>
									<td>2021.08.08~2021.11.08</td>
									<td>27,000원</td>
									<td>카드</td>
									<td>적용중</td>
								</tr>
								<tr>
									<td>2021.08.08</td>
									<td>3개월 EPL 멤버십</td>
									<td>2021.08.08~2021.11.08</td>
									<td>27,000원</td>
									<td>카드</td>
									<td>적용중</td>
								</tr>
								<tr>
									<td>2021.08.08</td>
									<td>3개월 EPL 멤버십</td>
									<td>2021.08.08~2021.11.08</td>
									<td>27,000원</td>
									<td>카드</td>
									<td>적용중</td>
								</tr>
								<tr>
									<td>2021.08.08</td>
									<td>3개월 EPL 멤버십</td>
									<td>2021.08.08~2021.11.08</td>
									<td>27,000원</td>
									<td>카드</td>
									<td>적용중</td>
								</tr>
								<tr>
									<td>2021.08.08</td>
									<td>3개월 EPL 멤버십</td>
									<td>2021.08.08~2021.11.08</td>
									<td>27,000원</td>
									<td>카드</td>
									<td>적용중</td>
								</tr>
								<tr>
									<td>2021.08.08</td>
									<td>3개월 EPL 멤버십</td>
									<td>2021.08.08~2021.11.08</td>
									<td>27,000원</td>
									<td>카드</td>
									<td>적용중</td>
								</tr>
							</tbody>
						</table>
						<div class="paging">
							<a href="javascript:;"><img src="../img/sub/prev.png" alt=""></a>
							<a class="active" href="javascript:;">1</a>
							<a href="javascript:;">2</a>
							<a href="javascript:;">3</a>
							<a href="javascript:;">4</a>
							<a href="javascript:;">5</a>
							<a href="javascript:;"><img src="../img/sub/next.png" alt=""></a>
						</div>
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