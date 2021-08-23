
<? include("../inc/header.php"); ?>
<link rel="stylesheet" href="../css/reserve.css">
<script>
 
$(document).ready(function () {

    getList();

});

function getList(){

    $("#list").jqGrid({
		url: "reserve-survey-manage-data.php",
		datatype: "json",
		mtype: "post",
		colNames: [ "선택", "기업순번", "번호", "등록일", "기업명", "설문제목", "응답자","수정","복사"],
		colModel: [
			{ name: "idx", sortable:false, align:"center", formatter:checkBox, width: 35},
            { name: "cidx", hidden:true },
			{ name: "no", sortable:true, align:"center", sorttype:'integer', width:50},
			{ name: "wdate", sortable:true, align:"center", sorttype:'date', width: 80},
			{ name: "comname", sortable:true, align:"center", width: 160},
            { name: "title", sortable:true, align:"center", width: 180},
			{ name: "answer", sortable:true, align:"center", width: 110},
			{ name: "btn", sortable:false, align:"center", width: 110, formatter:formatOpt1},
            { name: "btn2", sortable:false, align:"center", width: 110, formatter:formatOpt2}
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

	   		if(cellNm[index].name != 'idx' && cellNm[index].name != 'btn' && cellNm[index].name != 'btn2')
   			{
                //view(rowId);
   			}

	   	},
        loadComplete:function(data){   
        },	
		caption: ""

	});     


}

function checkBox(cellvalue, options, rowObject){
        var idx = cellvalue;
        var str = "<input type='checkbox' name='survey[]' value='"+idx+"' >";
        
        return str;
}

function formatOpt1(cellvalue, options, rowObject){ 

var str = "";

var val1 = rowObject[0];
	var val2 = rowObject[1];


   
			
	str += "<button id='modi' type=\"button\" onclick=\"location.href='./reserve-survey-modi.php?sidx="+val1+"&idx="+val2+"' \">수정</button>";   
 
   return str;

}

function formatOpt2(cellvalue, options, rowObject){ 

var str = "";

var val1 = rowObject[0];
	var val2 = rowObject[1];
   
			
	str += "<button id='modi' type=\"button\" onclick=\"location.href='./reserve-survey.php?sidx="+val1+"&idx="+val2+"' \">복사</button>";   
 
   return str;

}

function search(){

    var dataArr = {
            searchType : $('#searchType').val()
        ,   searchValue : $('#searchValue').val()
        ,   startDate : $('#startDate').val()
        ,   endDate : $('#endDate').val()
    }

	//그리드 클리어
	$("#list").jqGrid("clearGridData", true);

	//데이터 호출
	$("#list").jqGrid('setGridParam', {
		url : "reserve-survey-manage-data.php", 
		datatype : 'json', 
		mtype : 'post', 
		//postData : $("#SerachFrm").serialize(),
        postData : dataArr,
		success : function(data) {console(data);}//조건 폼값 전송
	}).trigger('reloadGrid'); //호출 완료 후 리로드    

}

function view(idx){
    
    document.location.href = "reserve-survey-view.php?idx="+idx;
}

function go_tot_del() {
        
        let result = '';
        $('input[name="survey[]"]:checked').each(function(){
            result += $(this).val() + ',';
        });
        
        // 출력
        if(result){
            location.href='./survey_list_del_action.php?idx='+result.slice(0,-1)+'';
            console.log(result.slice(0,-1));
        }
    }

</script>
<body>
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
	<div class="contents survey-manage">
        <? 
        $MENU_DEPTH1 = "3";
        $MENU_DEPTH2 = "2";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/reserve/left.php"; 
        ?>
		<div class="center-con">
			<div class="cc-title">
				<div>설문 관리</div>
			</div>
			<div class="cc-con">
				<form action="#">
					<div class="view-c">
						<div class="view-mana">
							<div class="com-search">
								<div class="com-day">
									<div class="cd-t">
										<span>등록일</span>
									</div>
									<div class="cd-c">
										<input type="text" id="startDate" data-js-start-date><span>~</span>
										<input type="text" id="endDate" disabled data-js-end-date>
									</div> 
								</div>
								<div class="com-tab">
                                <select name="searchType" id="searchType">
                                    <option value="comname">기업명</option>
                                </select>
                                <input type="text" name="searchValue" id="searchValue" >
                                <button type="button" onClick="search();">검색</button>
								</div>
							</div>
							<div class="all-c">
								<input type="checkbox" data-check-pattern="[name^='survey']"  name="survey" id="survey">
								<label for="survey">전체선택</label>
								<div class="btn-float">
									<button type="button" onclick="go_tot_del();">선택 삭제</button>
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
		
	</script>
	
<style>
#modi{
    padding: 5px 20px;
    border-radius: 5px;
    border: none;
    background-color: #2b2e33;
    color: #fff;
    font-size: 14px;
    font-weight: normal;
}
</style>
	
	

	
</body>
</html>