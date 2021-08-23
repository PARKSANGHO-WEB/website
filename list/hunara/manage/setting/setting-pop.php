<? include("../inc/header.php"); ?>
<link rel="stylesheet" href="../css/setting.css">

<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<script>
 
$(document).ready(function () {

    getList();

});

function getList(){
    $("#list").jqGrid({
        
		url: "popup-data.php",
		datatype: "json",
		mtype: "post",
		colNames: [ "선택", "번호", "사용여부", "기업명", "제목", "시작일","종료일","등록일"],
		colModel: [
			{ name: "idx", sortable:false, align:"center", hidden:true, formatter:checkBox, width:30} ,
			{ name: "no", sortable:true, align:"center", sorttype:'number', width:50},
			{ name: "use", sortable:true, align:"center", width: 240},
			{ name: "comname", sortable:true, align:"center", width: 80},
            { name: "subject", sortable:true, align:"center", width: 80},
            { name: "startdt", sortable:true, align:"center", sorttype:'date', width: 80},
            { name: "enddt", sortable:true, align:"center", sorttype:'date', width: 80},
            { name: "wdate", sortable:true, align:"center", sorttype:'date', width: 80}
			],
		pager: "#pager",
		rowNum: 10,
		sortname: "comname",
		sortorder: "asc",
		height: 'auto',
		viewrecords: true,
		gridview: true,
        loadonce : true,
        autowidth : true,
        onCellSelect: function(rowId, index, contents, event){
	   		var cellNm = $(this).jqGrid('getGridParam', 'colModel');

	   		if(cellNm[index].name != 'idx' && cellNm[index].name != 'btn')
   			{
                view(rowId);
   			}

	   	},

        loadError:function(xhr,status,error){
                alert("실패>>"+error);
        },
        loadComplete:function(data){   
        },	
		caption: ""

	});     


}

function checkBox(cellvalue, options, rowObject){
        var idx = cellvalue;
        var str = "<input type='checkbox' id='notice[]' name='notice[]' required='yes'  message='체크' value='"+idx+"'";
        
        return str;
}

function formatOpt1(cellvalue, options, rowObject){ 

var str = "";

var val1 = rowObject[0];
	var val2 = rowObject[1];
   
			
	str += "<button id='modi' type=\"button\" onclick=\"location.href='./notice-modi.php?idx="+val1+"'\">수정</button>";   
 
   return str;

}

function search(){

    var dataArr = {
            searchType : $('#searchType').val()
        ,   searchValue : $('#searchValue').val()
        //,   startDate : $('#startDate').val()
        //,   endDate : $('#endDate').val()
    }

	//그리드 클리어
	$("#list").jqGrid("clearGridData", true);
    //console.log(dataArr);
	//데이터 호출
	$("#list").jqGrid('setGridParam', {
		url : "popup-data.php", 
		datatype : 'json', 
		mtype : 'post', 
		//postData : $("#SerachFrm").serialize(),
        postData : dataArr,
		success : function(data) {console(data);}//조건 폼값 전송
	}).trigger('reloadGrid'); //호출 완료 후 리로드    

}

function view(idx){
    
    document.location.href = "setting-pop-modi.php?idx="+idx;
}

</script>

<body class="room-body">
	
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
	<div class="contents setting-pop">
		<div class="left-menu">
			<div class="lm-t">
				<p>설정 관리</p>
			</div>
			<ul>
				<li class="lm-act">
					<p class="lm-big active">설정 관리</p>
					<div class="lm-list">
						<ul>
							<li><a href="./setting-admin.php">관리자 정보 관리</a></li>
							<li class="active"><a href="./setting-pop.php">기업별 팝업 관리</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
		<div class="center-con">
			<div class="cc-title">
				<div>기업별 팝업 관리</div>
			</div>
			<div class="cc-con">
				<form action="#">
						<div class="set-tab">
                            <!--<div class="com-day">
                                <div class="cd-t">
                                    <span>등록일</span>
                                </div>
                                <div class="cd-c">
                                    <input type="text" id="startDate" data-js-extra-date><span>~</span>
                                    <input type="text" id="endDate" data-js-extra-date>
                                </div> 
                            </div>-->
							<div class="set-sear" style="padding-bottom:40px;">
                                <select name="searchType" id="searchType">
                                    <option value="comname">기업명</option>
                                    <!--<option value="dname">사용유무</option>-->
                                </select>
                                <input type="text" name="searchValue" id="searchValue" >
                                <button type="button" class="msel-search" onClick="search();">검색</button>
							</div>

                                <table id="list"></table>
                                <div id="pager"></div>

							<div class="btn-float">
								<button type="button" onclick='location.href="./setting-pop-add.php"'>등록하기</button>
							</div>
						</div>
				</form>
			</div>
		</div>
	</div>
	
	
	<!--  셀렉트 박스  -->
	
	<script type="text/javascript">
		$(document).ready(function () {
				
				$('select').wSelect();
			});
	</script>
	
</body>
</html>