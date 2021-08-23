<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Frank+Ruhl+Libre:wght@300;400;500;700;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../css/sub.css">
	<link rel="stylesheet" href="../css/header.css">
	<link rel="stylesheet" href="../css/common.css">
	<link rel="stylesheet" href="../css/swiper.css">
	<meta charset="UTF-8">
	<title>EPL</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="../js/common.js"></script>
	<script src="../js/wSelect.js"></script>
	<script src="../js/swiper.js"></script>
	<script src="../js/jquery.ellipsis.js"></script>
</head>
<body>
	<script>
	
        $(document).ready(function() {
            $("header").load("./inc/header.php");
            $("footer").load("./inc/footer.php");
        });
		
		
		
		
	</script>
	
	<header></header>
	<section class="course">
		<div class="sub-ban">
			<p class="sub-title">EPL Courses</p>
			<div class="sub-menu">
				<ul id="tabsNav">
					<li>
						<a href="./way.php">학습방법</a>
						<div class="underline"></div>
					</li>
					<li>
						<a href="./epl-write.php">EPL 받아쓰기 20,000</a>
						<div class="underline"></div>
					</li>
					<li class="active">
						<a href="./current.php">받아쓰기 현황판</a>
						<div class="underline"></div>
					</li>
					<li>
						<a href="./added.php">EPL Additional Lessons</a>
						<div class="underline"></div>
					</li>
				</ul>
			</div>
		</div>			
			<div class="sub-con tab-con">
				<form action="#">
					<div class="current-chap">
						<div class="cc-t">
							<div class="mark-current">
								<div class="mark-wrap mark-1">
									<span class="mw-i">
										<img src="../img/sub/retry.png" alt="">
									</span>
									<span class="mw-t">재학습</span>
								</div>
								<div class="mark-wrap mark-2">
									<span class="mw-i">이어서</span>
									<span class="mw-t">이어서 학습하기</span>
								</div>
								<div class="mark-wrap mark-3">
									<span class="mw-i"></span>
									<span class="mw-t">목표 달성</span>
								</div>
								<div class="mark-wrap mark-4">
									<span class="mw-i"></span>
									<span class="mw-t">목표 달성 실패</span>
								</div>
							</div>
						</div>
						<table class="cc-table">
							<thead>
								<tr>
									<th> </th>
									<th>1</th>
									<th>2</th>
									<th>3</th>
									<th>4</th>
									<th>5</th>
									<th>6</th>
									<th>7</th>
									<th>8</th>
									<th>9</th>
									<th>10</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td rowspan="2">
										<span class="small-th">1.<br />Getting to know the United Kingdom</span>
									</td>
									<td>
										<span class="small-title">1-1.<br />The four countries</span>
										<div class="current current-f">-</div>
									</td>
									<td>
										<span class="small-title">1-2.<br />England</span>
										<div class="current current-f">-</div>
									</td>
									<td>
										<span class="small-title">1-3.<br />Scotland</span>
										<div class="current current-s">60%</div>
									</td>
									<td>
										<span class="small-title">1-4.<br />Wales</span>
										<div class="current current-s">70%</div>
									</td>
									<td>
										<span class="small-title">1-5.<br />Northern Ireland</span>
										<div class="current current-f">90%</div>
									</td>
									<td>
										<span class="small-title">1-6.<br />Government</span>
										<div class="current current-s">40%</div>
									</td>
									<td>
										<span class="small-title">1-7.<br />Politics</span>
										<div class="current current-s">60%</div>
									</td>
									<td>
										<span class="small-title">1-8.<br />Language and culture</span>
										<div class="current current-s">70%</div>
									</td>
									<td>
										<span class="small-title">1-9.<br />Education</span>
										<div class="current current-s">90%</div>
									</td>
									<td>
										<span class="small-title">1-10.<br />Places of interest</span>
										<div class="current current-s">40%</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="btn-one">
											<button class="go-study" type="button">학습하기</button>
										</div>
									</td>
									<td>
										<div class="btn-one">
											<button class="go-study" type="button">학습하기</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
								</tr>
								<tr>
									<td rowspan="2">
										<span class="small-th">2.<br />Sports</span>
									</td>
									<td>
										<span class="small-title">2-1.<br />The four countries</span>
										<div class="current current-f">-</div>
									</td>
									<td>
										<span class="small-title">2-2.<br />England</span>
										<div class="current current-f">-</div>
									</td>
									<td>
										<span class="small-title">2-3.<br />Scotland</span>
										<div class="current current-s">60%</div>
									</td>
									<td>
										<span class="small-title">2-4.<br />Wales</span>
										<div class="current current-s">70%</div>
									</td>
									<td>
										<span class="small-title">2-5.<br />Northern Ireland</span>
										<div class="current current-f">90%</div>
									</td>
									<td>
										<span class="small-title">2-6.<br />Government</span>
										<div class="current current-s">40%</div>
									</td>
									<td>
										<span class="small-title">2-7.<br />Politics</span>
										<div class="current current-s">60%</div>
									</td>
									<td>
										<span class="small-title">2-8.<br />Language and culture</span>
										<div class="current current-s">70%</div>
									</td>
									<td>
										<span class="small-title">2-9.<br />Education</span>
										<div class="current current-s">90%</div>
									</td>
									<td>
										<span class="small-title">2-10.<br />Places of interest</span>
										<div class="current current-s">40%</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="btn-one">
											<button class="go-study" type="button">학습하기</button>
										</div>
									</td>
									<td>
										<div class="btn-one">
											<button class="go-study" type="button">학습하기</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
								</tr>
								<tr>
									<td rowspan="2">
										<span class="small-th">3.<br />British Food</span>
									</td>
									<td>
										<span class="small-title">3-1.<br />The four countries</span>
										<div class="current current-f">-</div>
									</td>
									<td>
										<span class="small-title">3-2.<br />England</span>
										<div class="current current-f">-</div>
									</td>
									<td>
										<span class="small-title">3-3.<br />Scotland</span>
										<div class="current current-s">60%</div>
									</td>
									<td>
										<span class="small-title">3-4.<br />Wales</span>
										<div class="current current-s">70%</div>
									</td>
									<td>
										<span class="small-title">3-5.<br />Northern Ireland</span>
										<div class="current current-f">90%</div>
									</td>
									<td>
										<span class="small-title">3-6.<br />Government</span>
										<div class="current current-s">40%</div>
									</td>
									<td>
										<span class="small-title">3-7.<br />Politics</span>
										<div class="current current-s">60%</div>
									</td>
									<td>
										<span class="small-title">3-8.<br />Language and culture</span>
										<div class="current current-s">70%</div>
									</td>
									<td>
										<span class="small-title">3-9.<br />Education</span>
										<div class="current current-s">90%</div>
									</td>
									<td>
										<span class="small-title">3-10.<br />Places of interest</span>
										<div class="current current-s">40%</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="btn-one">
											<button class="go-study" type="button">학습하기</button>
										</div>
									</td>
									<td>
										<div class="btn-one">
											<button class="go-study" type="button">학습하기</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
								</tr>
								<tr>
									<td rowspan="2">
										<span class="small-th">4.<br />The Royal Family</span>
									</td>
									<td>
										<span class="small-title">4-1.<br />The four countries</span>
										<div class="current current-f">-</div>
									</td>
									<td>
										<span class="small-title">4-2.<br />England</span>
										<div class="current current-f">-</div>
									</td>
									<td>
										<span class="small-title">4-3.<br />Scotland</span>
										<div class="current current-s">60%</div>
									</td>
									<td>
										<span class="small-title">4-4.<br />Wales</span>
										<div class="current current-s">70%</div>
									</td>
									<td>
										<span class="small-title">4-5.<br />Northern Ireland</span>
										<div class="current current-f">90%</div>
									</td>
									<td>
										<span class="small-title">4-6.<br />Government</span>
										<div class="current current-s">40%</div>
									</td>
									<td>
										<span class="small-title">4-7.<br />Politics</span>
										<div class="current current-s">60%</div>
									</td>
									<td>
										<span class="small-title">4-8.<br />Language and culture</span>
										<div class="current current-s">70%</div>
									</td>
									<td>
										<span class="small-title">4-9.<br />Education</span>
										<div class="current current-s">90%</div>
									</td>
									<td>
										<span class="small-title">4-10.<br />Places of interest</span>
										<div class="current current-s">40%</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="btn-one">
											<button class="go-study" type="button">학습하기</button>
										</div>
									</td>
									<td>
										<div class="btn-one">
											<button class="go-study" type="button">학습하기</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
								</tr>
								<tr>
									<td rowspan="2">
										<span class="small-th">5.<br />Great Britons</span>
									</td>
									<td>
										<span class="small-title">5-1.<br />The four countries</span>
										<div class="current current-f">-</div>
									</td>
									<td>
										<span class="small-title">5-2.<br />England</span>
										<div class="current current-f">-</div>
									</td>
									<td>
										<span class="small-title">5-3.<br />Scotland</span>
										<div class="current current-s">60%</div>
									</td>
									<td>
										<span class="small-title">5-4.<br />Wales</span>
										<div class="current current-s">70%</div>
									</td>
									<td>
										<span class="small-title">5-5.<br />Northern Ireland</span>
										<div class="current current-f">90%</div>
									</td>
									<td>
										<span class="small-title">5-6.<br />Government</span>
										<div class="current current-s">40%</div>
									</td>
									<td>
										<span class="small-title">5-7.<br />Politics</span>
										<div class="current current-s">60%</div>
									</td>
									<td>
										<span class="small-title">5-8.<br />Language and culture</span>
										<div class="current current-s">70%</div>
									</td>
									<td>
										<span class="small-title">5-9.<br />Education</span>
										<div class="current current-s">90%</div>
									</td>
									<td>
										<span class="small-title">5-10.<br />Places of interest</span>
										<div class="current current-s">40%</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="btn-one">
											<button class="go-study" type="button">학습하기</button>
										</div>
									</td>
									<td>
										<div class="btn-one">
											<button class="go-study" type="button">학습하기</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
								</tr>
								<tr>
									<td rowspan="2">
										<span class="small-th">6.<br />How the British see Asia</span>
									</td>
									<td>
										<span class="small-title">6-1.<br />The four countries</span>
										<div class="current current-f">-</div>
									</td>
									<td>
										<span class="small-title">6-2.<br />England</span>
										<div class="current current-f">-</div>
									</td>
									<td>
										<span class="small-title">6-3.<br />Scotland</span>
										<div class="current current-s">60%</div>
									</td>
									<td>
										<span class="small-title">6-4.<br />Wales</span>
										<div class="current current-s">70%</div>
									</td>
									<td>
										<span class="small-title">6-5.<br />Northern Ireland</span>
										<div class="current current-f">90%</div>
									</td>
									<td>
										<span class="small-title">6-6.<br />Government</span>
										<div class="current current-s">40%</div>
									</td>
									<td>
										<span class="small-title">6-7.<br />Politics</span>
										<div class="current current-s">60%</div>
									</td>
									<td>
										<span class="small-title">6-8.<br />Language and culture</span>
										<div class="current current-s">70%</div>
									</td>
									<td>
										<span class="small-title">6-9.<br />Education</span>
										<div class="current current-s">90%</div>
									</td>
									<td>
										<span class="small-title">6-10.<br />Places of interest</span>
										<div class="current current-s">40%</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="btn-one">
											<button class="go-study" type="button">학습하기</button>
										</div>
									</td>
									<td>
										<div class="btn-one">
											<button class="go-study" type="button">학습하기</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
								</tr>
								<tr>
									<td rowspan="2">
										<span class="small-th">7.<br />Every day English</span>
									</td>
									<td>
										<span class="small-title">7-1.<br />The four countries</span>
										<div class="current current-f">-</div>
									</td>
									<td>
										<span class="small-title">7-2.<br />England</span>
										<div class="current current-f">-</div>
									</td>
									<td>
										<span class="small-title">7-3.<br />Scotland</span>
										<div class="current current-s">60%</div>
									</td>
									<td>
										<span class="small-title">7-4.<br />Wales</span>
										<div class="current current-s">70%</div>
									</td>
									<td>
										<span class="small-title">7-5.<br />Northern Ireland</span>
										<div class="current current-f">90%</div>
									</td>
									<td>
										<span class="small-title">7-6.<br />Government</span>
										<div class="current current-s">40%</div>
									</td>
									<td>
										<span class="small-title">7-7.<br />Politics</span>
										<div class="current current-s">60%</div>
									</td>
									<td>
										<span class="small-title">7-8.<br />Language and culture</span>
										<div class="current current-s">70%</div>
									</td>
									<td>
										<span class="small-title">7-9.<br />Education</span>
										<div class="current current-s">90%</div>
									</td>
									<td>
										<span class="small-title">7-10.<br />Places of interest</span>
										<div class="current current-s">40%</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="btn-one">
											<button class="go-study" type="button">학습하기</button>
										</div>
									</td>
									<td>
										<div class="btn-one">
											<button class="go-study" type="button">학습하기</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
								</tr>
								<tr>
									<td rowspan="2">
										<span class="small-th">8.<br />London</span>
									</td>
									<td>
										<span class="small-title">8-1.<br />The four countries</span>
										<div class="current current-f">-</div>
									</td>
									<td>
										<span class="small-title">8-2.<br />England</span>
										<div class="current current-f">-</div>
									</td>
									<td>
										<span class="small-title">8-3.<br />Scotland</span>
										<div class="current current-s">60%</div>
									</td>
									<td>
										<span class="small-title">8-4.<br />Wales</span>
										<div class="current current-s">70%</div>
									</td>
									<td>
										<span class="small-title">8-5.<br />Northern Ireland</span>
										<div class="current current-f">90%</div>
									</td>
									<td>
										<span class="small-title">8-6.<br />Government</span>
										<div class="current current-s">40%</div>
									</td>
									<td>
										<span class="small-title">8-7.<br />Politics</span>
										<div class="current current-s">60%</div>
									</td>
									<td>
										<span class="small-title">8-8.<br />Language and culture</span>
										<div class="current current-s">70%</div>
									</td>
									<td>
										<span class="small-title">8-9.<br />Education</span>
										<div class="current current-s">90%</div>
									</td>
									<td>
										<span class="small-title">8-10.<br />Places of interest</span>
										<div class="current current-s">40%</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="btn-one">
											<button class="go-study" type="button">학습하기</button>
										</div>
									</td>
									<td>
										<div class="btn-one">
											<button class="go-study" type="button">학습하기</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
								</tr>
								<tr>
									<td rowspan="2">
										<span class="small-th">9.<br />Politics</span>
									</td>
									<td>
										<span class="small-title">9-1.<br />The four countries</span>
										<div class="current current-f">-</div>
									</td>
									<td>
										<span class="small-title">9-2.<br />England</span>
										<div class="current current-f">-</div>
									</td>
									<td>
										<span class="small-title">9-3.<br />Scotland</span>
										<div class="current current-s">60%</div>
									</td>
									<td>
										<span class="small-title">9-4.<br />Wales</span>
										<div class="current current-s">70%</div>
									</td>
									<td>
										<span class="small-title">9-5.<br />Northern Ireland</span>
										<div class="current current-f">90%</div>
									</td>
									<td>
										<span class="small-title">9-6.<br />Government</span>
										<div class="current current-s">40%</div>
									</td>
									<td>
										<span class="small-title">9-7.<br />Politics</span>
										<div class="current current-s">60%</div>
									</td>
									<td>
										<span class="small-title">9-8.<br />Language and culture</span>
										<div class="current current-s">70%</div>
									</td>
									<td>
										<span class="small-title">9-9.<br />Education</span>
										<div class="current current-s">90%</div>
									</td>
									<td>
										<span class="small-title">9-10.<br />Places of interest</span>
										<div class="current current-s">40%</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="btn-one">
											<button class="go-study" type="button">학습하기</button>
										</div>
									</td>
									<td>
										<div class="btn-one">
											<button class="go-study" type="button">학습하기</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
								</tr>
								<tr>
									<td rowspan="2">
										<span class="small-th">10.<br />Uniquely British</span>
									</td>
									<td>
										<span class="small-title">10-1.<br />The four countries</span>
										<div class="current current-f">-</div>
									</td>
									<td>
										<span class="small-title">10-2.<br />England</span>
										<div class="current current-f">-</div>
									</td>
									<td>
										<span class="small-title">10-3.<br />Scotland</span>
										<div class="current current-s">60%</div>
									</td>
									<td>
										<span class="small-title">10-4.<br />Wales</span>
										<div class="current current-s">70%</div>
									</td>
									<td>
										<span class="small-title">10-5.<br />Northern Ireland</span>
										<div class="current current-f">90%</div>
									</td>
									<td>
										<span class="small-title">10-6.<br />Government</span>
										<div class="current current-s">40%</div>
									</td>
									<td>
										<span class="small-title">10-7.<br />Politics</span>
										<div class="current current-s">60%</div>
									</td>
									<td>
										<span class="small-title">10-8.<br />Language and culture</span>
										<div class="current current-s">70%</div>
									</td>
									<td>
										<span class="small-title">10-9.<br />Education</span>
										<div class="current current-s">90%</div>
									</td>
									<td>
										<span class="small-title">10-10.<br />Places of interest</span>
										<div class="current current-s">40%</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="btn-one">
											<button class="go-study" type="button">학습하기</button>
										</div>
									</td>
									<td>
										<div class="btn-one">
											<button class="go-study" type="button">학습하기</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
									<td>
										<div class="btn-two">
											<button class="go-retry" type="button">
												<img src="../img/sub/retry.png" alt="">
											</button>
											<button type="button" class="go-continue">
												이어서
											</button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</form>
			</div>
	</section>
	<footer></footer>
	
	
	
	<!--  멤버쉽 구매 모달	-->
	<div class="buy-modal modal-wrap">
		<form action="#">
			<div class="modal-con">
				<div class="modal-top">
					<div class="close-modal">
						<img src="../img/common/close-modal.png" alt="">
					</div>
				</div>
				<p class="modal-title">현재 적용중인<br />EPL 멤버십이 없습니다!<br />멤버십을 구매해 주세요!</p>
				<div class="btn-wrap">
					<button class="go-mem" type="button" onclick="location.href='./membership.php'">구매하러 가기</button>
					<button class="close-modal" type="button">취소하기</button>
				</div>
			</div>
		</form>
	</div>
	
	
	<!--  재학습 모달	-->
	<div class="restu-modal modal-wrap">
		<form action="#">
			<div class="modal-con">
				<div class="modal-top">
					<div class="close-modal">
						<img src="../img/common/close-modal.png" alt="">
					</div>
				</div>
				<p class="modal-title">재학습시 학습정보가 초기화 됩니다!</p>
				<div class="btn-wrap">
					<button class="refresh-study" type="button">초기화 하기</button>
					<button class="close-modal" type="button">취소하기</button>
				</div>
			</div>
		</form>
	</div>
	
	
	<!--  레벨설정 모달	-->
	<div class="level-modal modal-wrap">
		<form action="#">
			<div class="modal-con">
				<div class="modal-top">
					<div class="close-modal">
						<img src="../img/common/close-modal.png" alt="">
					</div>
				</div>
				<p class="modal-title">학습 레벨 설정</p>
				<div class="level-value">
					<button type="button" id="sub" class="sub"><img src="../img/sub/minus.png" alt=""></button>
					<div class="lv-val">
						<input type="text" id="1" value="0" class="field" disabled />
						<span>%</span>
					</div>
					<button type="button" id="add" class="add"><img src="../img/sub/plus.png" alt=""></button>
				</div>
				<div class="btn-wrap">
					<button class="okay-level" type="button">설정하기</button>
				</div>
			</div>
		</form>
	</div>
	
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
				var swiper = new Swiper('.swiper-two', {
					slidesPerView: 4,
					spaceBetween: 20,
					pagination: {
						el: '.swiper-pagination',
						clickable: true,
					},
					navigation: {
						nextEl: '.swiper-button-next',
						prevEl: '.swiper-button-prev',
					},
				});
				
				$(document).ready(function(){
					
					$('.big-info').ellipsis({
						 row: 3
					});
					
					$('.big-title').ellipsis({
						 row: 2
					});
				});
			</script>
</body>
</html>