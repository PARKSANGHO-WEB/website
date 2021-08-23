<? include("../inc/header.php"); ?>
<link rel="stylesheet" href="/manage/css/reserve.css">
<script>
 
$(document).ready(function () {

    getList();

    var mem_level = "<?=$_SESSION['MEM_LEVEL']?>";

    if(mem_level == '00' || mem_level == '10' ){    
        $('#hidx').append("<?= getSelectBox($gconnet, 'idx', 'comname', 'tb_hu') ?>");
    }
    if(mem_level == '00' || mem_level == '20' ){    
        $('#cidx').append("<?= getSelectBox($gconnet, 'idx', 'comname', 'tb_company') ?>");
    }

});

function getList(){

    var f = document.frm;
    var dataArr = {
            hidx : $('#hidx').val()        
        ,   cidx : $('#cidx').val()
        ,   useday : getMultiInputValues(f.useday)
        ,   searchType : $('#searchType').val()
        ,   searchValue : $('#searchValue').val()
        ,   regflag : $('#regflag').val()
        ,   pgubun : $('#pgubun').val()
        ,   searchDate : $('#searchDate').val()
        ,   startDate : $('#startDate').val()
        ,   endDate : $('#endDate').val()
    }    

    $("#list").jqGrid({
		url: "/manage/reserve/reserve-list-data.php",
		datatype: "json",
		mtype: "post",
        postData : dataArr,
		colNames: [ "선택", "번호", "예약자", "지망", "등록일","예약일", "기업명", "구분", "휴양소명",  "평형"
                    , "사원번호" , "연락처", "결과", "midx","hidx","cidx","seq"],
		colModel: [
			{ name: "idx", label:"선택", sortable:false, align:"center", formatter:checkBox, width:30} ,
			{ name: "no", label:"번호", sortable:true, align:"center", sorttype:'integer',  width:40},
            { name: "name", label:"예약자", sortable:true, align:"center", width: 70},
            { name: "chasu", label:"지망", sortable:true, align:"center",  width:60},
			{ name: "wdate", label:"등록일", sortable:true, align:"center", width: 70},
			{ name: "useday", label:"예약일", sortable:true, align:"center", width: 160},
            { name: "cname", label:"기업명", sortable:true, align:"center", width: 100},
            { name: "flag", label:"구분", sortable:true, align:"center", width: 50},
            { name: "hname", label:"휴양소명", sortable:true, align:"center", width: 150},
			{ name: "rArea", label:"평형", sortable:true, align:"center", width: 110},
			{ name: "sano", label:"사원번호", sortable:true, align:"center", width: 70},
            { name: "hp", label:"연락처", sortable:true, align:"center",  width: 112},
            { name: "regflag", label:"결과", sortable:true, align:"center", formatter:regflag, width: 112},
            { name: "midx", hidden:true},
            { name: "hidx", hidden:true},
            { name: "cidx", hidden:true},
            { name: "seq", hidden:true}
		],
		pager: "#pager",
		rowNum: 1000,
		sortname: "wdate",
		sortorder: "desc",
		height: 'auto',
		viewrecords: true,
		gridview: true,
        loadonce : true,
        autowidth : true,
        onCellSelect: function(rowId, index, contents, event){
	   		var cellNm = $(this).jqGrid('getGridParam', 'colModel');

            if(cellNm[index].name == 'name'){
                empLogin(rowId);
            }else if(cellNm[index].name != 'idx'){
                view(rowId);
   			}

	   	},        
		caption: ""

		});     
}

function checkBox(cellvalue, options, rowObject){
        var idx = cellvalue;
        var str = "<input type='checkbox' name='chk' value='"+idx+"'>";
        
        return str;
}


function regflag(cellvalue, options, rowObject){
        var val = cellvalue;
        
        if(val == null) val = '';

        return val;
}

function search(){

    var f = document.frm;

    var dataArr = {
            hidx : $('#hidx').val()        
        ,   cidx : $('#cidx').val()
        ,   useday : getMultiInputValues(f.useday)
        ,   searchType : $('#searchType').val()
        ,   searchValue : $('#searchValue').val()
        ,   regflag : $('#regflag').val()
        ,   pgubun : $('#pgubun').val()
        ,   searchDate : $('#searchDate').val()
        ,   startDate : $('#startDate').val()
        ,   endDate : $('#endDate').val()
    }

	//그리드 클리어
	$("#list").jqGrid("clearGridData", true);

	//데이터 호출
	$("#list").jqGrid('setGridParam', {
		url : "/manage/reserve/reserve-list-data.php", 
		datatype : 'json', 
		mtype : 'post', 
        postData : dataArr,
		success : function(data) {console(data);}//조건 폼값 전송
	}).trigger('reloadGrid'); //호출 완료 후 리로드    

}

function view(id){
    document.location.href = "/manage/reserve/reserve-list-view.php?ridx="+id;
}

function empLogin(id){

    var rowData = $("#list").jqGrid("getRowData", id);

    employeeLogin(rowData.cidx, rowData.sano);    
}

//선택 당첨/탈락
function selRowProc(mode){

    var dataList = new Array();
    $("input[type=checkbox]:checked").each(function(){
        if($(this).val() != "on"){
            dataList.push($(this).val());
        }
    });    

    if(dataList.length < 1){
        alert("선택된 행이 없습니다.");
        return;
    }else{

        var txt;
        if(mode == "WINNER"){
            txt = "선택 당첨";
        }else{
            txt = "선택 탈락";
        }

        if(confirm(txt+" 하시겠습니까?" )){        

            $.ajax({
                url		: "/manage/reserve/reserve-selected-proc.php",
                type	: "POST",
                data : {"mode": mode,  "ridx" : dataList.join(",")},
                datatype: 'json',
                success		: function(json){

                    var data = JSON.parse(json);

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
}

function excelList(regflag){

    var frm = document.frm;

    frm.excelFlag.value = regflag;
    frm.usedays.value = getMultiInputValues(frm.useday);
    frm.action = "/manage/reserve/reserve-list-excel.php";
    frm.target = "ifrm";
    frm.submit();

}
</script>
<style type="text/css">

.ui-jqgrid-bdiv {
    overflow-y: scroll !important;
    max-height: 600px !important;
}

</style>
<body class="reserve">
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
    <div class="contents reserve-list">
    <? 
        $MENU_DEPTH1 = "1";
        $MENU_DEPTH2 = "2";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/reserve/left.php"; 
    ?>
		<div class="center-con">
			<div class="cc-title">
				<div>예약 내역 관리</div>
			</div>
			<div class="cc-con">
				
				<form name="frm" method="post" action="#">
                    <input type="hidden" name="excelFlag" id="excelFlag" >
                    <input type="hidden" name="usedays" id="usedays" >
					<div class="view-c">
						<div class="view-reser">
							<div class="mana-sel">
								<div class="msel sel1">
									<select name="hidx" id="hidx">
                                        <? if( $_SESSION['MEM_LEVEL'] == "00" || $_SESSION['MEM_LEVEL'] == "10" ){ ?>
										<option value="">휴양소전체</option>
                                        <? }else{?>
                                        <option value="<?=$_SESSION['ADMIN_IDX']?>"><?=$_SESSION['MEM_NAME']?></option>
                                        <? } ?>
									</select>
									<select name="cidx" id="cidx">
                                        <? if( $_SESSION['MEM_LEVEL'] == "00" || $_SESSION['MEM_LEVEL'] == "20" ){ ?>
										<option value="">기업전체</option>
                                        <? }else{?>
                                        <option value="<?=$_SESSION['ADMIN_IDX']?>"><?=$_SESSION['MEM_NAME']?></option>
                                        <? } ?>
									</select>
									<div class="sel-chk one-two">
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
									</div>
								</div>
								<div class="msel sel2">
									<select name="searchType" id="searchType">
										<option value="name" >예약자</option>
										<option value="sano">사원번호</option>
										<option value="hp">연락처</option>
									</select>
									<input type="text" name="searchValue" id="searchValue">
									<select name="regflag" id="regflag">
										<option value="" >결과전체</option>
										<option value="5">당첨</option>
										<option value="8">취소</option>
										<option value="9">탈락</option>
                                        <option value="F">선착순</option>
                                        <option value="10">빈값</option>
									</select>
									<select name="pgubun" id="pgubun">
										<option value="">구분전체</option>
										<option value="동계">동계</option>
										<option value="하계">하계</option>
										<option value="상시">상시</option>
									</select>
									<select name="searchDate" id="searchDate">
                                        <option value="wdate">등록일</option>
										<option value="cymd">예약일</option>
										<option value="cancel">취소일</option>
									</select>
									<div class="com-day">
										<div class="cd-c">
											<input type="text" id="startDate" data-js-extra-date><span>~</span>
											<input type="text" id="endDate" data-js-extra-date>
										</div> 
									</div>
									<button class="msel-search" type="button" onClick="search();">검색</button>
								</div>
							</div>
							<div class="all-c">
								<input type="checkbox"id="hostPall" data-check-pattern="[name^='chk']"  name="hostPall" id="hostPall">
								<label for="hostPall">전체선택</label>
                                <? if( $_SESSION['MEM_LEVEL'] == "00" ){ ?>
								<button type="button" onClick="selRowProc('WINNER');">선택 당첨</button>
								<button type="button" onClick="selRowProc('DROPOUT');">선택 탈락</button>
                                <? } ?>
								<button type="button" onClick="excelList('5');">당첨자 엑셀 다운로드</button>
								<button type="button" onClick="excelList('9');">탈락자 엑셀 다운로드</button>
								<button type="button" onClick="excelList('7');" >당첨후취소 엑셀 다운로드</button>
								<button type="button" onClick="exportExcel('list');">선택 엑셀 다운로드</button>
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
	
<iframe name="ifrm" width="0" height="0" ></iframe>	
</body>
</html>