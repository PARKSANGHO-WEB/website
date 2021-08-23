<? include("../inc/header.php"); ?>
<link rel="stylesheet" href="/manage/css/reserve.css">
<script>

$(document).ready(function () {

    getList();
    $('#hidx').append("<?= getSelectBox($gconnet, 'idx', 'comname', 'tb_hu') ?>");
    $('#cidx').append("<?= getSelectBox($gconnet, 'idx', 'comname', 'tb_company') ?>");

    $('select').wSelect();

});


function getList(){

    $("#list").jqGrid({
		url: "/manage/reserve/reserve-using-data.php",
		datatype: "json",
		mtype: "post",
        colNames: [ "번호", "등록일", "기업명", "휴양소명", "평형", "타입", "구분", "배정", "숙박일", "총 개수", "잔여 개수" ],
		colModel: [
			{ name: "no", label:"번호", sortable:true, align:"center", sorttype:'integer',  width:48},
			{ name: "wdate", label:"등록일", sortable:true, align:"center", width: 85},
            { name: "cname", label:"기업명", sortable:true, align:"center", width: 134},
            { name: "hname", label:"휴양소명", sortable:true, align:"center", width: 145},
			{ name: "rArea", label:"평형", sortable:true, align:"center", width: 66},
            { name: "rType", label:"타입", sortable:true, align:"center", width: 125},
            { name: "flag", label:"구분", sortable:true, align:"center", width: 66},
            { name: "type", label:"배정", sortable:true, align:"center", width: 115},
            { name: "useday", label:"숙박일", sortable:true, align:"center", width: 97},
            { name: "sumCnt", label:"총 개수", sortable:true, align:"center", sorttype:'integer', width: 97},
            { name: "rCnt", label:"잔여 개수", sortable:true, align:"center", sorttype:'integer',width: 98}
		],
		pager: "#pager",
		rowNum: 10,
		sortname: "wdate",
		sortorder: "desc",
		height: 'auto',
		viewrecords: true,
		gridview: true,
        loadonce : true,
        autowidth : true,
		caption: "",
        loadComplete:function(data){
            console.log(data);
            if(data == null || data == "" || data.rows.length == 0){
               // $("#list > tbody").append("<tr class='ui-widget-content jqgrow ui-row-ltr' ><td align='center' colspan='11'>검색 결과가 없습니다.</td></tr>");
            }
        }
	});      

    $("#list").jqGrid('setGroupHeaders', {
        useColSpanStyle: true, 
        groupHeaders:[
            {startColumnName: 'useday', numberOfColumns: 3, titleText: '<span style="color:#ffffff; font-size:13px;">숙박 수량</span>'},
        ]
    });        
}


function search(){
    var f = document.frm;

    var dataArr = {
            hidx : $('#hidx').val()        
        ,   cidx : $('#cidx').val()
        ,   flag : $('#flag').val()
        ,   searchDate : $('#searchDate').val()
        ,   startDate : $('#startDate').val()
        ,   endDate : $('#endDate').val()
    }

	//그리드 클리어
	$("#list").jqGrid("clearGridData", true);

	//데이터 호출
	$("#list").jqGrid('setGridParam', {
		url : "/manage/reserve/reserve-using-data.php", 
		datatype : 'json', 
		mtype : 'post', 
        postData : dataArr,
		success : function(data) {}//조건 폼값 전송
	}).trigger('reloadGrid'); //호출 완료 후 리로드    

}


</script>
<body>
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
    <div class="contents reser-using">
    <? 
        $MENU_DEPTH1 = "1";
        $MENU_DEPTH2 = "5";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/reserve/left.php"; 
    ?>
		<div class="center-con">
			<div class="cc-title">
				<div>객실 배정 관리</div>
			</div>
			<div class="cc-con">
				<form action="#">
					<div class="view-c">
						<div class="view-mana">
							<div class="mana-sel">
								<div class="msel sel1">
									<select name="hidx" id="hidx">
										<option value="">휴양소 전체</option>
									</select>
								</div>
								<div class="msel sel2">
									<select name="cidx" id="cidx">
										<option value="">기업 전체</option>
									</select>
								</div>
								<div class="msel sel3">
									<select name="flag" id="flag">
										<option value="">구분 전체</option>
										<option value="동계">동계</option>
										<option value="하계">하계</option>
										<option value="상시">상시</option>
									</select>
								</div>
								<div class="msel sel4">
									<select name="searchDate" id="searchDate">
										<option value="wdate">등록일</option>
									</select>
								</div>
								<div class="com-day">
									<div class="cd-c">
										<input type="text" id="startDate" data-js-extra-date><span>~</span>
										<input type="text" id="endDate" data-js-extra-date>
									</div> 
								</div>
								<button class="msel-search" type="button" onClick="search();" >검색</button>
							</div>
							<div class="btn-float">
								<button type="button" onclick="exportExcel('list');">프린트</button>
							</div>

                            <table id="list"></table>
                            <div id="pager"></div>

						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
</body>
</html>