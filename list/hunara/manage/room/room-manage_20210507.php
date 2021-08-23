<? include("../inc/header.php"); ?>

<link rel="stylesheet" href="/manage/css/room.css">


<!--팝업 오픈-->
<script language="javascript">
	function roomPopup() {
		window.open("company-room-pop.html", "a",
			"width=900, height=800, left=100, top=50");
	}
</script>

<body class="room-body">
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
    <div class="contents room-mana">
    <? 
        $MENU_DEPTH2 = "2";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/room/left.php"; 
    ?>
		<div class="center-con">
			<div class="cc-title">
				<div>휴양소 관리</div>
			</div>
			<div class="cc-con">
				<form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
					<div class="com-search">
						<div class="com-day">
							<div class="cd-t">
								<span>등록일</span>
							</div>
							<div class="cd-c">
								<input type="text" id="start" data-js-start-date><span>~</span>
								<input type="text" id="end" disabled data-js-end-date>
							</div>
						</div>
						<div class="com-tab">
							<select name="types" id="com-sear">
								<option value="comname">휴양소명</option>
								<option value="tel">연락처</option>
							</select>
							<input type="text" name="search">
							<button type="submit" name="submit">검색</button>
						</div>
					</div>
				</form>
				<form action="#">
					<div class="view-c">
						<div class="btn-wrap">
							<div class="btn-float">
								<button type="button">선택 삭제</button>
								<button type="button" onclick="window.print();">프린트</button>
							</div>
						</div>
						<div class="view-host">
							<div class="all-c">
								<input type="checkbox" id="rMana"
									data-check-pattern="[name^='rMana']" name="rMana">
								<label for="rMana">전체선택</label>
							</div>
							<table id="sort-mana">
								<thead>
									<tr>
										<th>선택</th>
										<th class="th-btn"><span>번호</span></th>
										<th class="th-btn"><span>등록일</span></th>
										<th class="th-btn"><span>휴양소명</span></th>
										<th class="th-btn"><span>연락처</span></th>
										<th class="th-btn"><span>홈페이지</span></th>
										<th class="th-btn"><span>등록 객실</span></th>
									</tr>
								</thead>
								<tbody>
									<!-- <tr onclick="location.href='./room-modify.html'">
										<td onclick="event.cancelBubble=true">
											<input type="checkbox" name="rMana">
										</td>
										<td>1</td>
										<td>2021.02.03</td>
										<td>포시즌스 호텔</td>
										<td>02-xxx-xxxx</td>
										<td>010-xxxx-xxxx</td>
										<td>https://www.lottehotel.com/seoul-signiel/ko.html</td>
										<td>3</td>
									</tr> -->
									<?php 
										if(!$gconnet) {
											die("데이터베이스에 접속하지 못하였습니다.".mysqli_connect_errno());
										}

										$resultPerPage = 10;
										$tableName = 'tb_hu';

										$sql = 'SELECT * FROM '.$tableName;
										$result = mysqli_query($gconnet, $sql);
										
										$numberOfResults = mysqli_num_rows($result);

										$numberOfPage = ceil($numberOfResults/$resultPerPage);

										$pageFirstResult = ($page - 1) * $resultPerPage;

										if(!isset($_GET['page'])) {
												$page = 1;
										} else {
												$page = $_GET['page'];
										}

										$types = $_GET['types'];
										$search = $_GET['search'];

										if ($numberOfResults == 0) {
											echo 
											"
												<tr>
													<td rowspan='9'>등록된 휴양소가 없습니다.</td>
												</tr>    
											";
											} else {
												if (!$types == '') {
													$sql = 'SELECT idx room FROM '.$tableName.' WHERE ' .$types. ' LIKE "%' .$search. '%" ORDER BY idx DESC';
													$result = mysqli_query($gconnet, $sql);
													$numberOfResults = mysqli_num_rows($result);
													$numberOfPage = ceil($numberOfResults/$resultPerPage);
													$sql = 'SELECT idx, date_format(wdate, "%Y/%m/%d") as wdate, comname, tel, homepage, room FROM '.$tableName.' WHERE ' .$types. ' LIKE "%' .$search. '%" ORDER BY idx DESC LIMIT ' . $pageFirstResult . ',' . $resultPerPage;
													// echo $sql;
													// exit();
													$result = mysqli_query($gconnet, $sql);

													while ($row = mysqli_fetch_array($result)) {
										?>
									<tr>
										<td onclick="event.cancelBubble=true">
											<input type="checkbox" name="rMana">
										</td>
										<td><?=$row["idx"]?></td>
										<td><a
												href="qna_view.php?idx=<?=$row["idx"]?>&page=<?=$page?>"><?=$row["wdate"]?></a>
										</td>
										<td><?=$row["comname"]?></td>
										<td><?=$row["tel"]?></td>
										<td><a href="<?=$row['homepage']?>"><?=$row['homepage']?></a></td>
										<td><?=$row['room']?></td>
									</tr>
									<?php
										}
									} else {
										$sql = 'SELECT idx, date_format(wdate, "%Y/%m/%d") as wdate, comname, tel, homepage, room FROM '.$tableName.' ORDER BY idx DESC LIMIT ' . $pageFirstResult . ',' . $resultPerPage;
										
										// echo $sql;
										// exit();

										$result = mysqli_query($gconnet, $sql);

										while ($row = mysqli_fetch_array($result)) {
												?>
										<tr>
											<td onclick="event.cancelBubble=true">
												<input type="checkbox" name="rMana">
											</td>
											<td><?=$row["idx"]?></td>
											<td><a
													href="qna_view.php?idx=<?=$row["idx"]?>&page=<?=$page?>"><?=$row["wdate"]?></a>
											</td>
											<td><?=$row["comname"]?></td>
											<td><?=$row["tel"]?></td>
											<td><a href="<?=$row['homepage']?>"><?=$row['homepage']?></a></td>
											<td><?=$row['room']?></td>
										</tr>
									<?php
											}
										}  
									}  
									
									?>
								</tbody>
							</table>
							<!-- <div class="paging">
								<a class="first"></a>
								<a class="prev"></a>
								<a class="active">1</a>
								<a>2</a>
								<a>3</a>
								<a>4</a>
								<a>5</a>
								<a class="next"></a>
								<a class="last"></a>
							</div> -->
							<?php include("../../inc/paging.php") ?>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


	<!--  셀렉트박스  -->

	<script type="text/javascript">
		$(document).ready(function () {

			$('select').wSelect();
		});
	</script>



</body>

</html>