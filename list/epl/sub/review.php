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
	<section class="commu">
		<div class="sub-ban">
			<p class="sub-title">커뮤니티</p>
			<div class="sub-menu">
				<ul id="tabsNav">
					<li>
						<a href="./notice.php">공지사항</a>
						<div class="underline"></div>
					</li>
					<li>
						<a href="./qna.php">Q&A</a>
						<div class="underline"></div>
					</li>
					<li  class="active">
						<a href="./review.php">학습후기</a>
						<div class="underline"></div>
					</li>
				</ul>
			</div>
		</div>
		<div class="sub-con">
			<form action="#">
				<div class="notice-wrap">
					<div class="search-tab">
						<div class="search-op">
							<select name="search-noti" id="search-noti">
								<option value="all">전체</option>
								<option value="title">제목</option>
								<option value="context">내용</option>
								<option value="writer">작성자</option>
							</select>
						</div>
						<input type="text" placeholder="검색어를 입력해주세요.">
						<button type="button">검색</button>
					</div>
				</div>
				<table class="qna-table">
					<thead>
						<tr>
							<th>번호</th>
							<th>제목</th> 
							<th>작성자</th> 
							<th>등록일</th>
							<th>조회수</th>
						</tr>
					</thead>
					<tbody>
						<tr onclick="location.href='./review-view.php'">
							<td>10</td>
							<td>너무너무 재미있고, 도움이 됩니다.</td>
							<td>홍길동</td>
							<td>2021-06-25</td>
							<th>212</th>
						</tr>
						<tr  onclick="location.href='./review-view.php'">
							<td>9</td>
							<td>너무너무 재미있고, 도움이 됩니다.</td>
							<td>홍길동</td>
							<td>2021-06-25</td>
							<th>212</th>
						</tr>
						<tr  onclick="location.href='./review-view.php'">
							<td>8</td>
							<td>너무너무 재미있고, 도움이 됩니다.</td>
							<td>홍길동</td>
							<td>2021-06-25</td>
							<th>212</th>
						</tr>
						<tr  onclick="location.href='./review-view.php'">
							<td>7</td>
							<td>너무너무 재미있고, 도움이 됩니다.</td>
							<td>홍길동</td>
							<td>2021-06-25</td>
							<th>212</th>
						</tr>
						<tr  onclick="location.href='./review-view.php'">
							<td>6</td>
							<td>너무너무 재미있고, 도움이 됩니다.</td>
							<td>홍길동</td>
							<td>2021-06-25</td>
							<th>212</th>
						</tr>
						<tr  onclick="location.href='./review-view.php'">
							<td>5</td>
							<td>너무너무 재미있고, 도움이 됩니다.</td>
							<td>홍길동</td>
							<td>2021-06-25</td>
							<th>212</th>
						</tr>
						<tr  onclick="location.href='./review-view.php'">
							<td>4</td>
							<td>너무너무 재미있고, 도움이 됩니다.</td>
							<td>홍길동</td>
							<td>2021-06-25</td>
							<th>212</th>
						</tr>
						<tr  onclick="location.href='./review-view.php'">
							<td>3</td>
							<td>너무너무 재미있고, 도움이 됩니다.</td>
							<td>홍길동</td>
							<td>2021-06-25</td>
							<th>212</th>
						</tr>
						<tr  onclick="location.href='./review-view.php'">
							<td>2</td>
							<td>너무너무 재미있고, 도움이 됩니다.</td>
							<td>홍길동</td>
							<td>2021-06-25</td>
							<th>212</th>
						</tr>
						<tr  onclick="location.href='./review-view.php'">
							<td>1</td>
							<td>너무너무 재미있고, 도움이 됩니다.</td>
							<td>홍길동</td>
							<td>2021-06-25</td>
							<th>212</th>
						</tr>
					</tbody>
				</table>
				<div class="table-btn">
					<button type="button" onclick="location.href='./review-write.php'">글쓰기</button>
				</div>
				<div class="paging">
					<a href="javascript:;"><img src="../img/sub/prev.png" alt=""></a>
					<a class="active" href="javascript:;">1</a>
					<a href="javascript:;">2</a>
					<a href="javascript:;">3</a>
					<a href="javascript:;">4</a>
					<a href="javascript:;">5</a>
					<a href="javascript:;"><img src="../img/sub/next.png" alt=""></a>
				</div>
			</form>
		</div>
	</section>
	<footer></footer>
</body>
</html>