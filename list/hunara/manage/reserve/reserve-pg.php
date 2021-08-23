<? include("../inc/header.php"); ?>
<link rel="stylesheet" href="/manage/css/reserve.css">
<script>
 
$(document).ready(function () {

    getList();
    $('#hidx').append("<?= getSelectBox($gconnet, 'idx', 'comname', 'tb_hu') ?>");
    $('#cidx').append("<?= getSelectBox($gconnet, 'idx', 'comname', 'tb_company') ?>");

});

function getList(){ 

    var f = document.frm;
    var dataArr = {
            hidx : $('#hidx').val()        
        ,   cidx : $('#cidx').val()
        ,   useday : getMultiInputValues(f.useday)
    }    

    $("#list").jqGrid({
		url: "/manage/reserve/reserve-pg-data.php",
		datatype: "json",
		mtype: "post",
        postData : dataArr,
		colModel: [
			{ name: "no", label:"번호", sortable:true, align:"center", sorttype:'integer',  width:50},
            { name: "udate", label:"당첨일", sortable:true, align:"center", width: 120},
            { name: "cname", label:"기업명", sortable:true, align:"center", width: 120},
            { name: "pgubun", label:"구분", sortable:true, align:"center", width: 50},
            { name: "hname", label:"휴양소명", sortable:true, align:"center", width: 110},
            { name: "name", label:"예약자", sortable:true, align:"center", width: 90},
			{ name: "sano", label:"사원번호", sortable:true, align:"center", width: 90},
            { name: "hp", label:"연락처", sortable:true, align:"center", width: 100},
            { name: "applDate", label:"결제일", sortable:true, align:"center",  width:70},
            { name: "applNum", label:"결제번호", sortable:true, align:"center",  width:70},
			{ name: "TotPrice", label:"금액", sortable:true, align:"center", width: 100},
			{ name: "payMethod", label:"방법", sortable:true, align:"center", width: 50},
            { name: "payflag", label:"상태", sortable:true, align:"center", width: 94}
		],
		pager: "#pager",
		rowNum: 10,
		sortname: "udate",
		sortorder: "desc",
		height: 'auto',
		viewrecords: true,
		gridview: true,
        loadonce : true,
        autowidth : true,
		caption: ""

		});     
}

function search(){

    var f = document.frm;

    var dataArr = {
            hidx : $('#hidx').val()        
        ,   cidx : $('#cidx').val()
        ,   useday : getMultiInputValues(f.useday)
    }

	//그리드 클리어
	$("#list").jqGrid("clearGridData", true);

	//데이터 호출
	$("#list").jqGrid('setGridParam', {
		url : "/manage/reserve/reserve-pg-data.php", 
		datatype : 'json', 
		mtype : 'post', 
        postData : dataArr,
		success : function(data) {console(data);}//조건 폼값 전송
	}).trigger('reloadGrid'); //호출 완료 후 리로드    

}



</script>


<body>
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
	<div class="contents reserve-pg">
    <? 
        $MENU_DEPTH1 = "2";
        $MENU_DEPTH2 = "2";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/reserve/left.php"; 
    ?>
		<div class="center-con">
			<div class="cc-title">
				<div>결제 관리</div>
			</div>
			<div class="cc-con">
				
				<form name="frm" action="#">
					<div class="view-c">
						<div class="view-reser">
							<div class="mana-sel">
								<div class="msel sel1" style="margin-bottom:40px;">
                                    <select name="hidx" id="hidx">
										<option value="">휴양소전체</option>
									</select>
									<select name="cidx" id="cidx">
										<option value="">기업전체</option>
									</select>
									<!--<div class="sel-chk one-two">
										<input type="checkbox" name="useday" id="useday" value="1">
										<label for="one-two">1박2일</label>
									</div>
									<div class="sel-chk two-thr">
										<input type="checkbox" name="useday" id="useday" value="2">
										<label for="two-thr">2박3일</label>
									</div>
									<div class="sel-chk thr-fr">
										<input type="checkbox" name="useday" id="useday" value="3">
										<label for="thr-fr">3박4일</label>
									</div>
									<div class="sel-chk fr-fv">
										<input type="checkbox" name="useday" id="useday" value="4">
										<label for="fr-fv">4박5일</label>
									</div>-->
									
									<button class="msel-search" type="button" onclick="search();">검색</button>
								</div>

                                <table  id="list"></table>
                                <div id="pager"></div>                                
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	
	<!--  셀렉트박스와 파일업로드	-->
	
	<script type="text/javascript">
		
		$(document).ready(function () {	
			$('select').wSelect();
		});
		
	</script>
	
	
</body>
</html>