<? include("../inc/header.php"); ?>

<script>

$(document).ready(function () {

    getList();
    $('#cidx').append("<?= getSelectBox($gconnet, 'idx', 'comname', 'tb_company') ?>");

	$('select').wSelect();

}); 
 
function getList(){

	var dataArr = {
		   cidx : $('#cidx').val()
        ,   chDate : $('#chDate').val()
	}    

	$("#list").jqGrid({
		url: "/manage/company/company-room-go-data.php",
		datatype: "json",
		mtype: "post",
        postData : dataArr,
		colNames: [ "선택", "번호", "등록일", "기업명", "휴양소명", "평형" , "구분", "기간", "숙박일", "총 개수", "잔여 개수", "1차", "2차", "3차", "4차", "midx", "hidx", "seq", "cidx", "endDate" ],
		colModel: [
			{ name: "idx", sortable:false, align:"center", formatter:checkBox, width: 35},
			{ name: "no",  sortable:true, align:"center", sorttype:'integer',  width:40},
			{ name: "wdate", sortable:true, align:"center", width: 70},
			{ name: "cname", sortable:true, align:"center", width: 100},
			{ name: "hname", sortable:true, align:"center", width: 145},
            { name: "rArea", sortable:true, align:"center", width: 60},
			{ name: "flag", sortable:true, align:"center", width: 60},
			{ name: "udate", sortable:true, align:"center", width: 91},
			{ name: "useday", sortable:true, align:"center", width: 71},
			{ name: "sumCnt", sortable:true, align:"center", sorttype:'integer', width: 71},
			{ name: "revCnt", sortable:true, align:"center", sorttype:'integer', width: 71},
			{ name: "chDate1", sortable:true, align:"center", sorttype:'date',width: 72},
			{ name: "chDate2", sortable:true, align:"center", sorttype:'date',width: 72},
			{ name: "chDate3", sortable:true, align:"center", sorttype:'date',width: 72},
			{ name: "chDate4", sortable:true, align:"center", sorttype:'date',width: 72},
            { name: "midx", hidden:true},
            { name: "hidx", hidden:true},
            { name: "seq", hidden:true},
            { name: "cidx", hidden:true},
            { name: "endDate", hidden:true}
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
		caption: ""
	});     

	$("#list").jqGrid('setGroupHeaders', {
		useColSpanStyle: true, 
		groupHeaders:[
			{startColumnName: 'useday', numberOfColumns: 3, titleText: '<span style="color:#ffffff; font-size:13px;">숙박일수(개수)</span>'},
			{startColumnName: 'chDate1', numberOfColumns: 4, titleText: '<span style="color:#ffffff; font-size:13px;">추첨단계</span>'},
		]
	});        
}

function checkBox(cellvalue, options, rowObject){
        var idx = cellvalue;
        var str = "<input type='checkbox' name='chk' value='"+idx+"' >";
        
        return str;
}

function search(){

	var f = document.frm;

	var dataArr = {
		   cidx : $('#cidx').val()
        ,   chDate : $('#chDate').val()
	}

	//그리드 클리어
	$("#list").jqGrid("clearGridData", true);

	//데이터 호출
	$("#list").jqGrid('setGridParam', {
		url : "/manage/company/company-room-go-data.php", 
		datatype : 'json', 
		mtype : 'post', 
		postData : dataArr,
		success : function(data) {}//조건 폼값 전송
	}).trigger('reloadGrid'); //호출 완료 후 리로드    

}

function view(id){

    var rowData = $("#list").jqGrid("getRowData", id);
    document.location.href = "company-room-go-view.php?midx="+rowData.midx+"&seq="+rowData.seq;

}

function doChuchum(step){

    var dataList = new Array();
    $("input[type=checkbox]:checked").each(function(){
        if($(this).val() != "on"){
            var idx = $(this).val();
            var rowData = $('#list').jqGrid('getRowData', idx );

            dataList.push(rowData);
        }
    });  

    if(dataList.length < 1){
        alert('선택한 휴양소가 없습니다.');
        return;
    }
    
    var keyArr = [];
    for(var i=0; i< dataList.length; i++){

        if(dataList[i].endDate != ""){
            alert('마감처리 되어 추첨이 불가합니다.');
            return;
        }

        if(i >0 && dataList[i-1].cname != dataList[i].cname){
            alert('같은 기업이 아닙니다.');
            return;
        }

        var chDate;
        if(step == 1){
            chDate = dataList[i].chDate1;
        }else if(step == 2){
            chDate = dataList[i].chDate2;
            if(dataList[i].chDate1 == "") {
                chDate = "error";
            }
        }else if(step == 3){
            chDate = dataList[i].chDate3;
            if(dataList[i].chDate1 == "" || dataList[i].chDate2 == "") {
                chDate = "error";
            }
        }else if(step == 4){
            chDate = dataList[i].chDate4;
            if(dataList[i].chDate1 == "" || dataList[i].chDate2 == "" || dataList[i].chDate3 == "") {
                chDate = "error";
            }

        }

        if(chDate != ""){
            alert('추첨단계가 맞지 않습니다.');
            return;
        }

        keyArr.push(dataList[i].midx+":"+dataList[i].seq);
    }

    if(confirm(step+'차 추첨 하시겠습니까')){

        var dataArr = {
                mode : "CHUCHUM"
            ,   step : step
            ,   keyArr : keyArr.join(",")
        }
        //console.log(dataArr);

        $.ajax({
            url		: "/manage/company/company-room-go-proc_dev.php",
            type	: "POST",
            data	: dataArr,
            async	: false,
            dataType	: "json",
            success		: function(data){
                if ( data.success == "true" ){
                    alert(data.msg);
                    search();

                } else if ( data.success == "false" ){
                    alert(data.msg);
                            
                } else {
                    alert( "시스템 오류 발생 하였습니다. \n 관리자에게 문의하시기 바랍니다." );
                }
            }
        }); 

    }

}

function doDeadLine(){
    var dataList = new Array();
    $("input[type=checkbox]:checked").each(function(){
        if($(this).val() != "on"){
            var idx = $(this).val();
            var rowData = $('#list').jqGrid('getRowData', idx );

            dataList.push(rowData);
        }
    });  

    if(dataList.length < 1){
        alert('선택한 휴양소가 없습니다.');
        return;
    }
    
    var keyArr = [];
    for(var i=0; i< dataList.length; i++){

        if(dataList[i].endDate != ""){
            alert('이미 마감처리 되어 있습니다.');
            return;
        }

        keyArr.push(dataList[i].midx+":"+dataList[i].seq);
    }    

    if(confirm('마감처리 하면 더이상 추첨이 불가 합니다. 선택 마감 하시겠습니까')){

        var dataArr = {
                mode : "DEADLINE"
            ,   keyArr : keyArr.join(",")
        }

        $.ajax({
            url		: "/manage/company/company-room-go-proc_dev.php",
            type	: "POST",
            data	: dataArr,
            async	: false,
            dataType	: "json",
            success		: function(data){
                if ( data.success == "true" ){
                    alert(data.msg);
                    search();

                } else if ( data.success == "false" ){
                    alert(data.msg);
                            
                } else {
                    alert( "시스템 오류 발생 하였습니다. \n 관리자에게 문의하시기 바랍니다." );
                }
            }
        }); 
    }    


}
</script>


<body class="room-body">
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
	<div class="contents cRoom-go">
    <? 
        $MENU_DEPTH1 = "2";
        $MENU_DEPTH2 = "3";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/company/left.php"; 
    ?>    
		<div class="center-con">
			<div class="cc-title">
				<div>휴양소 추첨 관리</div>
			</div>
			<div class="cc-con">
				<form action="#">
					<div class="view-c">
						<div class="view-mana">
							<div class="gosel">
                                <span class="ct-t">기업명</span>
								<select name="cidx" id="cidx" >
									<option value="">기업전체</option>
								</select>
                                
                                <span class="ct-t" style="margin-left:10px;" >추첨단계</span>
								<select name="chDate" id="chDate">
									<option value="N" selected>마감제외</option>
                                    <option value="">전체</option>
                                    <option value="1">1차</option>
                                    <option value="2">2차</option>
                                    <option value="3">3차</option>
                                    <option value="4">4차</option>
                                    <option value="E">마감</option>
								</select>
								<button type="button" onClick="search();">검색</button>
							</div>                            
							<div class="gosel-btn">
								<span class="gsb-warn">
									※같은 기업 / 같은 추첨 단계만 선택가능
								</span>
								<div class="go-btn">
									<button type="button" onClick="doChuchum(1);">
										<span>선택</span>
										<span>1차추첨</span>
									</button>
									<button type="button" onClick="doChuchum(2);">
										<span>선택</span>
										<span>2차추첨</span>
									</button>
									<button type="button" onClick="doChuchum(3);">
										<span>선택</span>
										<span>3차추첨</span>
									</button>
									<button type="button" onClick="doChuchum(4);">
										<span>선택</span>
										<span>4차추첨</span>
									</button>
									<button type="button" onClick="doDeadLine();">
										<span>선택 마감처리</span>
									</button>
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
	
</body>
</html>