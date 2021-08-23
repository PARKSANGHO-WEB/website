<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<link rel="stylesheet" type='text/css' href="/manage/css/ui.jqgrid.css">
<link rel='stylesheet' type='text/css' href='/manage/css/jquery-ui.css' />
<script src="/manage/js/modal.js"></script>
<script src="/manage/js/jquery.jqgrid.min.js" defer></script>

<script>
$(document).ready(function () {

	$("#list2").jqGrid({
		url: "/manage/popup/search-resort-data.php",
		datatype: "json",
		mtype: "GET",
		colNames: ["선택", "번호", "등록일", "휴양소", "연락처", "홈페이지"],
		colModel: [
			{ name: "idx", sortable:false, align:"center", formatter:radio, width: 50},
			{ name: "no", sortable:true, align:"center", sorttype:'integer', width: 50}, 
			{ name: "wdate", sortable:true, align:"center",  width: 80, hidden:true},
			{ name: "comname", sortable:true, align:"center", width: 210},
			{ name: "tel", sortable:true, align:"center", width: 150},
			{ name: "homepage", sortable:true, align:"center", width: 240}
			],
		pager: "#pager2",
		rowNum: 5,
		sortname: "comname",
		sortorder: "asc",
		height: 'auto',
		viewrecords: true,
		gridview: true,
        loadonce : true,
        autowidth : true,
		caption: ""

	}); 
        

});

function radio(cellvalue, options, rowObject){
    
    var idx = cellvalue;
    var comname = options.rowData.comname; 

    var str = "<input type='radio' name='rdIdx2' id='rdIdx2' value='"+idx+"' data-comname='"+comname+"' >";
        
        return str;
}

//등록버튼    
function register(){
    
    var rdIdx2 = "";
    var comname = "";

    $('input[name=rdIdx2]:checked').each(function(){
        rdIdx2 = $(this).val();
        comname = $(this).data('comname');
    });

	if(rdIdx2 == ""){
		alert('휴양소를 선택 하십시오.');
		return;
	}

    //opener에 휴양소 순번 및 이름 삽입
    $("#hName").text(comname);
    $("#hidx").val(rdIdx2);

    //opener에서 휴양소 추가정보 조회를 위해 이벤트 발생
    $("#hidx").change();    

    $("#room-modal").removeClass("visible");
}

//취소 버튼
function cancel(){
    $("#room-modal").removeClass("visible");
}



</script>
    
        <div class="modal-con">
			<div class="modal-top">
				<div class="title-modal">
					<span>휴양소 검색</span>
				</div>
				<div class="close-modal">
					<img src="../img/common/close.png" alt="">
				</div>
			</div>

			<form action="#">
				<div class="mo-con">
					<div class="list-wrap">
						<div class="list-table">

                            <table id="list2"></table>
                            <div id="pager2"></div>                         
							<div class="btn-apply">
								<button type="button" onClick="register();">등록</button>
								<button type="button" onClick="cancel();">취소</button>
							</div>						
						</div>
					</div>
				</div>
			</form>

		</div>

