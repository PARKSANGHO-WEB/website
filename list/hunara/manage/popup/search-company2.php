<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<link rel="stylesheet" type='text/css' href="/manage/css/ui.jqgrid.css">
<link rel='stylesheet' type='text/css' href='/manage/css/jquery-ui.css' />
<script src="/manage/js/modal.js"></script>
<script src="/manage/js/jquery.jqgrid.min.js" defer></script>

<script>
$(document).ready(function () {
	$("#list").jqGrid({
		url: "/manage/popup/search-company-data.php",
		datatype: "json",
		mtype: "GET",
		colNames: ["선택", "번호", "등록일", "기업명", "담당자", "연락처", "핸드폰", "휴양소"],
		colModel: [
			{ name: "idx", sortable:false, align:"center", formatter:radio, width: 58},
			{ name: "no", sortable:true, align:"center", sorttype:'number', width: 78},
			{ name: "wdate", sortable:true, align:"center", sorttype:'date', width: 140},
			{ name: "comname", sortable:true, align:"center", width: 210},
            { name: "dname", sortable:true, align:"center", width: 136},
			{ name: "tel", sortable:true, align:"center", width: 150},
			{ name: "hp", sortable:true, align:"center", width: 150},
			{ name: "cnt", sortable:true, align:"center", width: 100}
			],
		pager: "#pager",
		rowNum: 5,
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
        
});

function radio(cellvalue, options, rowObject){
    
    var idx = cellvalue;
    var comname = options.rowData.comname; 

    var str = "<input type='radio' name='rdIdx' id='rdIdx' value='"+idx+"' data-comname='"+comname+"' >";
        
        return str;
}

//등록버튼    
function register(){
    
    var rdIdx = "";
    var comname = "";

    $('input[name=rdIdx]:checked').each(function(){
        rdIdx = $(this).val();
        comname = $(this).data('comname');
    });

    if(rdIdx == ""){
		alert('기업을 선택 하십시오.');
		return;
	}

    //opener에 기업 순번 및 이름 삽입
    $("#cidx").val(rdIdx);
    $("#cName").text(comname);

    $("#cidx").change();    

    $("#com-modal").removeClass("visible");
}

//취소 버튼
function cancel(){
    $("#com-modal").removeClass("visible");
}



</script>
    
        <div class="modal-con">
			<div class="modal-top">
				<div class="title-modal">
					<span>기업 검색</span>
				</div>
				<div class="close-modal">
					<img src="../img/common/close.png" alt="">
				</div>
			</div>

			<form action="#">
				<div class="mo-con">
					<div class="list-wrap">
						<div class="list-table">

                            <table id="list"></table>
                            <div id="pager"></div>                         
							<div class="btn-apply">
								<button type="button" onClick="register();">등록</button>
								<button type="button" onClick="cancel();">취소</button>
							</div>						
						</div>
					</div>
				</div>
			</form>

		</div>

