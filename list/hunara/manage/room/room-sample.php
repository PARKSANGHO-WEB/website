<? include "../inc/header.php";?>
<?php 
	$types = $_GET['types'];
	$search = $_GET['search'];
	$start = $_GET['start'];
	$end = $_GET['end'];
?>


<script src="../js/zebra_datepicker.src.js" defer></script>
<script src="../js/wSelect.js" defer></script>
<script src="../js/checkbox.js" defer></script>
<script src="../js/tab.js" defer></script>
<script src="../js/modal.js" defer></script>
<script src="../js/calendar.js" defer></script>
<script src='../js/grid.locale-kr.js' defer></script>
<script src="../js/jquery.jqgrid.min.js" defer></script>
<link rel="stylesheet" href="../css/room.css">
<link rel="stylesheet" href="../css/common.css">
<link rel="stylesheet" href="../css/zebra_datepicker.css">
<link rel="stylesheet" href="../css/wSelect.css">
<link rel="stylesheet" href="../css/calendar.css">
<link rel="stylesheet" href="../css/ui.jqgrid.css">
<!-- <link rel="stylesheet" href="../css/jquery-ui.min.css"> -->
<link rel='stylesheet' type='text/css' href='../css/jquery-ui.css' />


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
		url: "room-sample-data2.php?types=<?=$types?>&search=<?=$search?>&start=<?=$start?>&end=<?$end?>",
		datatype: "json",
		mtype: "GET",
		colNames: ["선택", "번호", "등록일", "휴양소명", "연락처", "홈페이지", "등록객실"],
		colModel: [
			{ name: "idx", sortable:false, align:"center", formatter:checkBox, width: 58},
			{ name: "no", sortable:true, align:"center", sorttype:'number', width: 98},
			{ name: "wdate", sortable:true, align:"center", sorttype:'date', width: 140},
			{ name: "comname", sortable:true, align:"center", width: 210},
			{ name: "tel", sortable:true, align:"center", width: 136},
			{ name: "homepage", sortable:true, align:"center", width: 294},
			{ name: "room", sortable:true, align:"center", width: 139}
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
				<form action="<?=$_SERVER['PHP_SELF']?>?types=<?=$types?>&search=<?=$search?>&start=<?=$start?>&end=<?$end?>" method="GET">
					<div class="com-search">
						<div class="com-day">
							<div class="cd-t">
								<span>등록일</span>
							</div>
							<div class="cd-c">
								<input type="text" name="start" id="start" data-js-start-date><span>~</span>
								<input type="text" name="end" id="end" disabled data-js-end-date>
							</div>
						</div>
						<div class="com-tab">
							<select name="types" id="com-sear">
								<option value="comname">휴양소명</option>
								<option value="tel">연락처</option>
							</select>
							<input type="text" name="search">
							<button type="submit">검색</button>
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
                            <!--- JqGrid ------------------------>
                            <table id="list_records"></table>
                            <div id="pager2"></div>
                            <!--- JqGrid ------------------------>
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
							<?php // include("../../inc/paging.php") ?>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


	 <!-- 셀렉트박스  -->

	<script type="text/javascript">
		$(document).ready(function () {

			$('#com-sear').wSelect();
		});
	</script>



</body>

</html>