<? include("../../inc/header.php"); ?>

<script src="../js/zebra_datepicker.src.js" defer></script>
<script src="../js/wSelect.js" defer></script>
<script src="../js/checkbox.js" defer></script>
<script src="../js/tab.js" defer></script>
<script src="../js/modal.js" defer></script>
<script src="../js/calendar.js" defer></script>
<script src="../js/jquery.jqgrid.min.js" defer></script>
<script type='text/javascript' src='http://www.trirand.com/blog/jqgrid/js/i18n/grid.locale-en.js'></script>
<link rel="stylesheet" href="../css/room.css">
<link rel="stylesheet" href="../css/common.css">
<link rel="stylesheet" href="../css/zebra_datepicker.css">
<link rel="stylesheet" href="../css/wSelect.css">
<link rel="stylesheet" href="../css/calendar.css">
<link rel="stylesheet" href="../css/ui.jqgrid.css">
<link rel="stylesheet" href="../css/jquery-ui.min.css">
<link rel='stylesheet' type='text/css' href='https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css' />


<!--팝업 오픈-->
<script language="javascript">
	function roomPopup() {
		window.open("company-room-pop.html", "a",
			"width=900, height=800, left=100, top=50");
	}
</script>
<script>
$(document).ready(function () {
	$("#list_records").jqGrid({
		url: "room-manage2-data.php",
		datatype: "json",
		mtype: "GET",
		colNames: ["선택", "번호", "등록일", "휴양소명", "연락처", "홈페이지", "등록객실"],
		colModel: [
			{ name: "idx", sortable:false, align:"right", formatter:checkBox},
			{ name: "no", sortable:true, sorttype:'number'},
			{ name: "wdate", sortable:true, sorttype:'date'},
			{ name: "comname", sortable:true},
			{ name: "tel", sortable:true},
			{ name: "homepage", sortable:true},
			{ name: "room", sortable:true}
			],
		pager: "#pager2",
		rowNum: 10,
		rowList: [10,20,30],
		sortname: "comname",
		sortorder: "asc",
		height: 'auto',
		viewrecords: true,
        //multiselect:true, // checkbox 생성
		gridview: true,
        loadonce : true,
        autowidth : true,
		caption: ""

		}); 
        
        jQuery("#list_records").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false});
        jQuery("#list_records").jqGrid('sortableRows');
	});

    function checkBox(cellvalue, options, rowObject){
        var idx = cellvalue;
        var str = "<input type='checkbox' name='chk' value='"+idx+"'>";
        
        return str;
    }




</script>

<body class="room-body">
	<header>
		<div class="logo" onclick="location.href='../home.html'">
			<img src="../img/common/logo.png" alt="">
		</div>
		<div class="gnb">
			<ul>
				<li>
					<a href="javascript:;">휴나라_admin 님</a>
				</li>
				<li>
					<a href="javascript:;">홈페이지 이동</a>
				</li>
				<li>
					<a href="javascript:;">로그아웃</a>
				</li>
			</ul>
		</div>
	</header>
	<div class="menu">
		<ul>
			<li>
				<a href="../company/company.html">기업관리</a>
			</li>
			<li class="active">
				<a href="./room-manage.html">휴양소 관리</a>
			</li>
			<li>
				<a href="../reserve/reserve-selected.html">예약 관리</a>
			</li>
			<li>
				<a href="../notice/notice.html">게시판 관리</a>
			</li>
			<li>
				<a href="javascript:;">설정 관리</a>
			</li>
		</ul>
	</div>
	<div class="root-wrap">
		<div class="root">
			<ul>
				<li>
					<a href="../home.html">Home</a>
				</li>
				<li class="arrow"><img src="../img/common/arrow.svg" alt=""></li>
				<li>
					<a href="./room-manage.html">휴양소 관리</a>
				</li>
				<li class="arrow"><img src="../img/common/arrow.svg" alt=""></li>
				<li>
					<a href="./room-manage.html">휴양소 관리</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="contents room-mana">
		<div class="left-menu">
			<div class="lm-t">
				<p>휴양소 관리</p>
			</div>
			<ul>
				<li class="lm-act">
					<p class="lm-big active">휴양소 관리</p>
					<div class="lm-list">
						<ul>
							<li><a href="./room-new.html">신규 휴양소 등록</a></li>
							<li class="active"><a href="./room-manage.html">휴양소 관리</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
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
								<button class="add-people" type="button">사원등록</button>
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
										$page = $_GET['page']; 
										$limit = $_GET['rows']; 
										$sidx = $_GET['sidx']; 
										$sord = $_GET['sord']; 
										if(!$sidx) $sidx =1;

										$resultPerPage = 10;
										$tableName = 'tb_hu';

										$types = $_GET['types'];
                    $search = $_GET['search'];

										$sql = 'SELECT COUNT(*) AS count FROM '.$tableName.'';
										// echo $sql;
										// exit();
										$result = mysqli_query($gconnet, $sql);
										$row = mysqli_num_rows($result);
										
										$count = $row['count'];
										if( $count > 0 && $limit > 0) { 
											$total_pages = ceil($count/$limit); 
									} else { 
											$total_pages = 0; 
									} 
										if ($page > $total_pages) {$page=$total_pages;} 
										$start = $limit*$page - $limit; 
										$SQL = 'SELECT idx, date_format(wdate, "%Y/%m/%d") as wdate, comname, tel, homepage, room FROM '.$tableName.'';
										$result = mysqli_query($gconnet, $SQL) or die("Couldn't execute query.".mysqli_error($gconnet));

										$i=0;
										while ($row = mysqli_fetch_array($result)) {

											$responce->rows[$i]['id'] = $row['id'];
											$responce->rows[$i]['cell']=array($row['idx'], $row['wdate'], $row['comname'], $row['tell'], $row['homepage'], $row['romm']);
											$i++;
										}
										
										//echo json_encode($responce, JSON_UNESCAPED_UNICODE);
									?>
								</tbody>
							</table>
                            <table id="list_records"></table>
                            <div id="pager2"></div>
                            <!--
							<div id="list_records"></div>
                            -->
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