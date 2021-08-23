<? include("../inc/header.php"); ?>

<script>
$(document).ready(function () {

	$("#list").jqGrid({
		url: "/manage/company/company-room-manage-data.php",
		datatype: "json",
		mtype: "GET",
		colNames: ["선택", "번호", "등록일", "기업명", "휴양소명", "구분", "배정방식", "기간", "연락처", "부담금"],
		colModel: [
			{ name: "idx", label:"선택", sortable:false, align:"center", formatter:checkBox, width: 40},
			{ name: "no", label:"번호", sortable:true, align:"center", sorttype:'integer', width: 40}, 
			{ name: "wdate", label:"등록일", sortable:true, align:"center",  width: 70},
			{ name: "comname", label:"기업명", sortable:true, align:"center", width: 100},
            { name: "huname", label:"휴양소명", sortable:true, align:"center", width: 100},
            { name: "flag", label:"구분", sortable:true, align:"center", width: 80},
            { name: "type", label:"배정방식", sortable:true, align:"center", width: 70},
            { name: "period", label:"기간", sortable:true, align:"center", width: 120},
			{ name: "tel", label:"연락처", sortable:true, align:"center", width: 90},
            { name: "amount", label:"부담금", sortable:true, align:"center",  width: 100 }
		],
		pager: "#pager",
		rowNum: 10,
		height: 'auto',
		viewrecords: true,
		gridview: true,
        loadonce : true,
        autowidth : true,
        onCellSelect: function(rowId, index, contents, event){
	   		var cellNm = $(this).jqGrid('getGridParam', 'colModel');

	   		if(cellNm[index].name != 'idx')
   			{
                view(rowId);
   			}

	   	},
		emptyrecode : "작성된 글이 없습니다.",   		
		caption: ""

	}); 

});

function checkBox(cellvalue, options, rowObject){
        var idx = cellvalue;
        var str = "<input type='checkbox' name='chk' value='"+idx+"' >";
        
        return str;
}

function view(idx){
   document.location.href = "/manage/company/company-room-view.php?midx="+idx;
}

function search(){

	var dataArr = {
			flag : $('#flag').val()
		,   cidx : $('#cidx').val()
		,   hidx : $('#hidx').val()
		,   type : $('#type').val()
		,   com_amount1 : $('#com_amount1').val()
		,   com_amount2 : $('#com_amount2').val()
		,   per_amount1 : $('#per_amount1').val()
		,   per_amount2 : $('#per_amount2').val()
	}

	//그리드 클리어
	$("#list").jqGrid("clearGridData", true);

	//데이터 호출
	$("#list").jqGrid('setGridParam', {
		url : "/manage/company/company-room-manage-data.php", 
		datatype : 'json', 
		mtype : 'post', 
		postData : dataArr,
		success : function(data) {console(data);}//조건 폼값 전송
	}).trigger('reloadGrid'); //호출 완료 후 리로드    

}



</script>
<body class="room-body">

    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
    <div class="contents cRoom-mana">
    <? 
        $MENU_DEPTH1 = "2";
        $MENU_DEPTH2 = "2";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/company/left.php"; 
    ?>
		<div class="center-con">
			<div class="cc-title">
				<div>기업 휴양소 관리</div>
			</div>
			<div class="cc-con">
				<form action="#">
					<div class="view-c">
						<div class="view-mana">
							<div class="mana-sel">
								<div class="msel sel1">
									<span class="ct-t">구분</span>
									<select name="flag" id="flag">
                                        <option value="">전체</option>
                                        <option value="상시">상시</option>
                                        <option value="하계">하계</option>
										<option value="동계">동계</option>
									</select>
								</div>
								<div class="msel sel2">
									<span class="ct-t">기업명</span>
									<select name="cidx" id="cidx">
                                    <option value="">전체</option>
                                    <?= getSelectBox($gconnet, 'idx', 'comname', 'tb_company') ?>
									</select>
								</div>
								<div class="msel sel3">
									<span class="ct-t">휴양소명</span>
									<select name="hidx" id="hidx">
                                    <option value="">전체</option>
                                    <?= getSelectBox($gconnet, 'idx', 'comname', 'tb_hu') ?>
									</select>
								</div>
								<div class="msel sel4">
									<span class="ct-t">배정방식</span>
									<select name="type" id="type">
                                        <option value="">전체</option>
										<option value="F">선착순</option>
										<option value="S">추첨</option>
									</select>
								</div>
							</div>
							<div class="mana-price">
								<!--<div class="price price1">
									<span class="ct-t">기업부담금</span>
									<div class="min-money"><input type="text" class="only-num" id="com_amount1"><span>원</span></div>
									<span class="hypen">~</span>
									<div class="max-money"><input type="text" class="only-num" id="com_amount2"><span>원</span></div>
								</div>-->
								<div class="price price2">
									<span class="ct-t">개인부담금</span>
									<div class="min-money"><input type="text" class="only-num" id="per_amount1"><span>원</span></div>
									<span class="hypen">~</span>
									<div class="max-money"><input type="text" class="only-num" id="per_amount2"><span>원</span></div>
								</div>
								<button class="msel-search" type="button" onClick="search();">검색</button>
							</div>
							<div class="all-c">
								<input type="checkbox"id="hostPall" data-check-pattern="[name^='chk']"  name="hostPall" id="hostPall">
								<label for="hostPall">전체선택</label>
								<div class="btn-float">
									<button type="button" onclick="exportExcel('list');">프린트</button>
								</div>
							</div>

                            <table id="list"></table>
                            <div id="pager"></div>

						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!--  달력과 셀렉트 박스	-->
	
	<script type="text/javascript">
		$(document).ready(function () {
				
			(function(){
    
				var $extra_date = $('[data-js-extra-date]');
				var $end_date = $('[data-js-end-date]');
				var $start_date = $('[data-js-start-date]');


				$extra_date.Zebra_DatePicker();

				$end_date.Zebra_DatePicker({
					direction: 1,
					onClear: function(){
						extraOnChange();
						extraOnClear();
					},
					onSelect: function(val){
						extraOnChange();
						extraUpdate();      
					}
				});
				var dp_end = $end_date.data('Zebra_DatePicker');

				$start_date.Zebra_DatePicker({
					direction: true,
					pair: $end_date,
					onClear: function(){        
						endDateClear(true);
						dp_end.clear_date();

						extraOnChange();
						extraOnClear();
					},
					onSelect: function(val){
						endDateClear(false);
						extraOnChange();
						extraUpdate();
					}
				});


				function endDateClear(bool) {
					$end_date.prop('disabled', bool);
				}


				function extraOnClear(){
					$extra_date.each(function(){
						$(this).data('Zebra_DatePicker').clear_date();
					});
				}
				function extraUpdate(){
					$extra_date.each(function(){
						$(this).data('Zebra_DatePicker').clear_date();
						$(this).data('Zebra_DatePicker').update({
							direction: [$start_date.val(),$end_date.val()]
						});
					});
				}
				function extraOnChange(){
					if($start_date.val() !== '' && $end_date .val() !== ''){
						$extra_date.prop('disabled', false);
					}  else {
						$extra_date.prop('disabled', true);
					}
				}
				extraOnChange();

			})();
			
				
				$('select').wSelect();
			});
	</script>
</body>
</html>