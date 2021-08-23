<? include("../inc/header.php"); ?>
<link rel="stylesheet" href="/manage/css/reserve.css">
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script>
 
$(document).ready(function () {

    getList();

    $("#print_excel").on("click", function(){
        //exportGrid("list");
        exportExcel($("#list"), "list_excel");
    });

});

function getList(){

    var dataArr = {
            flag : $('#flag').val()
        ,   cidx : $('#cidx').val()
        ,   hidx : $('#hidx').val()
        ,   chDate : $('#chDate').val()
        ,   com_amount1 : $('#com_amount1').val()
        ,   com_amount2 : $('#com_amount2').val()
        ,   per_amount1 : $('#per_amount1').val()
        ,   per_amount2 : $('#per_amount2').val()
    }    

    $("#list").jqGrid({
		url: "reserve-selected-data.php",
		datatype: "json",
		mtype: "post",
        postData : dataArr,
		colNames: [ "선택", "번호", "등록일", "기업명", "휴양소명", "구분", "예약", "기간", "숙박일수" 
                    , "부담금", "신청수", "예약<br>번호","당첨<br>제외","midx","hidx","cidx","seq"],
		colModel: [
			{ name: "idx", label:"선택", sortable:false, align:"center", formatter:checkBox, width:30} ,
			{ name: "no", label:"번호", sortable:true, align:"center", sorttype:'integer',  width:40},
			{ name: "wdate", label:"등록일", sortable:true, align:"center", sorttype:'date', width: 65},
			{ name: "cname", label:"기업명", sortable:true, align:"center", width: 80},
            { name: "hname", label:"휴양소명", sortable:true, align:"center", width: 140},
            { name: "flag", label:"구분", sortable:true, align:"center", width: 45},
			{ name: "rev_yn", label:"예약", sortable:true, align:"center", width: 45},
            { name: "udate", label:"기간", sortable:true, align:"center", width: 80},
            { name: "useday", label:"숙박일수", sortable:true, align:"center", width: 80},
			{ name: "amount", label:"부담금", sortable:true, align:"center", width: 90},
            { name: "rev_cnt", label:"신청수", sortable:true, align:"center", sorttype:'integer', width: 60},
            { name: "win_cnt", label:"예약번호", sortable:true, align:"center", sorttype:'integer', width: 50},
            { name: "etc_cnt", label:"당첨제외", sortable:true, align:"center", sorttype:'integer', width: 50},
            { name: "midx", hidden:true},
            { name: "hidx", hidden:true},
            { name: "cidx", hidden:true},
            { name: "seq", hidden:true}

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
        onCellSelect: function(rowId, index, contents, event){
	   		var cellNm = $(this).jqGrid('getGridParam', 'colModel');

	   		if(cellNm[index].name != 'idx')
   			{
                view(rowId);
   			}

	   	},
        loadComplete:function(data){   
        },	
		caption: ""

	});     

}

function checkBox(cellvalue, options, rowObject){
        var idx = cellvalue;
        var str = "<input type='checkbox' name='chk' value='"+idx+"'>";
        
        return str;
}

function useDate(cellvalue, options, rowObject){
        var val = cellvalue;
        var days = val.replace('~', '~\n')

        return days;
}

function search(){

    var dataArr = {
            flag : $('#flag').val()
        ,   cidx : $('#cidx').val()
        ,   hidx : $('#hidx').val()
        ,   chDate : $('#chDate').val()
        ,   com_amount1 : $('#com_amount1').val()
        ,   com_amount2 : $('#com_amount2').val()
        ,   per_amount1 : $('#per_amount1').val()
        ,   per_amount2 : $('#per_amount2').val()
        ,   name : $('#name').val()
    }

	//그리드 클리어
	$("#list").jqGrid("clearGridData", true);

	//데이터 호출
	$("#list").jqGrid('setGridParam', {
		url : "reserve-selected-data.php", 
		datatype : 'json', 
		mtype : 'post', 
        postData : dataArr,
		success : function(data) {console(data);}//조건 폼값 전송
	}).trigger('reloadGrid'); //호출 완료 후 리로드    

}

function view(id){

    var rowData = $("#list").jqGrid("getRowData", id);
    document.location.href = "reserve-selected-view.php?midx="+rowData.midx+"&seq="+rowData.seq;

}



</script>
<body> 

    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
    <div class="contents reser-selected">
    <? 
        $MENU_DEPTH1 = "1";
        $MENU_DEPTH2 = "1";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/reserve/left.php"; 
    ?>
		<div class="center-con">
			<div class="cc-title">
				<div>당첨 등록 관리</div>
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
									<span class="ct-t">추첨단계</span>
									<select name="chDate" id="chDate">
                                        <option value="">전체</option>
										<option value="1">1지망</option>
										<option value="2">2지망</option>
										<option value="3">3지망</option>
										<option value="4">4지망</option>
                                        <option value="E">마감</option>
                                        <option value="N">마감제외</option>
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
								<div class="price price2">
                                    <span class="ct-t">예약자명</span>
                                    <div class="min-money">
                                        <input type="text" id="name" style="width:100px">
                                    </div>                      
								</div>                                
								<button class="msel-search" type="button" onClick="search();">검색</button>
							</div>
							<div class="all-c">
								<input type="checkbox"id="hostPall" data-check-pattern="[name^='chk']"  name="hostPall" id="hostPall">
								<label for="hostPall">전체선택</label>
								<div class="btn-float">
									<button type="button" onClick="exportExcel('list');">프린트</button>
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
	
	<!--  셀렉트박스와 파일업로드	-->
	
	<script type="text/javascript">
		
		$(document).ready(function () {	
			$('select').wSelect();
		});
		

		$(document).ready(function(){
			// Also see: https://www.quirksmode.org/dom/inputfile.html

			var inputs = document.querySelectorAll('.file-input')

			for (var i = 0, len = inputs.length; i < len; i++) {
			customInput(inputs[i])
			}

			function customInput (el) {
				const fileInput = el.querySelector('[type="file"]')
				const label = el.querySelector('[data-js-label]')

				fileInput.onchange =
				fileInput.onmouseout = function () {
					if (!fileInput.value) return

					var value = fileInput.value.replace(/^.*[\\\/]/, '')
					el.className += ' -chosen'
					label.innerText = value
				}
			}
		});


		
	</script>
	
	
	
	<!-- 테이블 sort 선언	-->
	
	
	<script>
		$(document).ready(function(){
			
			$('.view-t').on('click',function(){
					if( $(this).parents('.view').hasClass('on') ){
						$(this).parents('.view').removeClass('on');
					}else{
						$('.view').removeClass('on');
						$(this).parents('.view').addClass('on');
					}
				});
		});
	
	</script>
	
</body>
</html>