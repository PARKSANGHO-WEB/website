
<? include("../inc/header.php"); ?>
<link rel="stylesheet" href="../css/reserve.css">
<script>
 
$(document).ready(function () {

    getList();

});

function getList(){

    $("#list").jqGrid({
		url: "reserve-survey-result-data.php",
		datatype: "json",
		mtype: "post",
		colNames: [ "선택", "번호", "등록일", "기업명", "휴양소명", "설문제목", "응답자", "문항수", "sidx", "hidx"],
		colModel: [
			{ name: "idx", sortable:false, hidden:true, align:"center", formatter:checkBox, width: 35},
			{ name: "no", sortable:true, align:"center", sorttype:'integer', width:50},
			{ name: "wdate", sortable:true, align:"center", sorttype:'date', width: 80},
			{ name: "comname", sortable:true, align:"center", width: 120},
            { name: "huname", sortable:true, align:"center", width: 120},
            { name: "surveytitle", sortable:true, align:"center", width: 180},
			{ name: "answer", sortable:true, align:"center", width: 80},
			{ name: "cnt", sortable:true, align:"center", width: 50},
            { name: "sidx", hidden:true},
            { name: "hidx", hidden:true}
			],
		pager: "#pager",
		rowNum: 10,
		sortname: "no",
		sortorder: "desc",
		height: 'auto',
		viewrecords: true,
		gridview: true,
        loadonce : true,
        autowidth : true,
        onCellSelect: function(rowId, index, contents, event){
	   		var cellNm = $(this).jqGrid('getGridParam', 'colModel');
            var rowData =  $(this).jqGrid('getRowData', rowId );    

	   		if(cellNm[index].name != 'idx' && cellNm[index].name != 'btn')
   			{
                view(rowData.sidx, rowData.hidx);
   			}

	   	},
        loadComplete:function(data){   
        },	
		caption: ""

	});     


}

function checkBox(cellvalue, options, rowObject){
        var idx = cellvalue;
        var str = "<input type='checkbox' name='survey' value='"+idx+"' >";
        
        return str;
}

function search(){

    var dataArr = {
            cidx : $('#cidx').val()
        ,   hidx : $('#hidx').val()
        ,   startDate : $('#startDate').val()
        ,   endDate : $('#endDate').val()
    }

    console.log(dataArr);

	//그리드 클리어
	$("#list").jqGrid("clearGridData", true);

	//데이터 호출
	$("#list").jqGrid('setGridParam', {
		url : "reserve-survey-result-data.php", 
		datatype : 'json', 
		mtype : 'post', 
		//postData : $("#SerachFrm").serialize(),
        postData : dataArr,
		success : function(data) {console(data);}//조건 폼값 전송
	}).trigger('reloadGrid'); //호출 완료 후 리로드    

}

function view(sidx, hidx){
    
    document.location.href = "reserve-survey-view.php?sidx="+sidx+"&hidx="+hidx;
}

</script>


<body>
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
	<div class="contents survey-result">
        <? 
        $MENU_DEPTH1 = "3";
        $MENU_DEPTH2 = "3";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/reserve/left.php"; 
        ?>
		<div class="center-con">
			<div class="cc-title">
				<div>결과 관리</div>
			</div>
			<div class="cc-con">
				<form action="#">
					<div class="view-c">
						<div class="view-mana">
							<div class="com-search">
                                <div class="com-tab">
                                    <div class="rs-w rs-w1">
                                        <select name="cidx" id="cidx">
											<option value="">기업명</option>
                                            <?= getSelectBox($gconnet, 'idx', 'comname', 'tb_company') ?>
										</select>
									</div>
									<div class="rs-w rs-w2">
                                        <select name="hidx" id="hidx">
											<option value="">휴양소명</option>
                                            <?= getSelectBox($gconnet, 'idx', 'comname', 'tb_hu') ?>
										</select>
									</div>
                                    <button type="button" onClick="search();">검색</button>
                                </div>
							</div>
							<div class="all-c">
								<!--<input type="checkbox" data-check-pattern="[name^='survey']"  name="survey" id="survey">
								<label for="survey">전체선택</label>-->
								<!--<div class="btn-float">
									<button type="button" onclick="window.print();">프린트</button>
								</div>-->
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
			// Also see: https://www.quirksmode.org/dom/inputfile.php

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