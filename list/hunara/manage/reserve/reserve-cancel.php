<? include("../inc/header.php"); ?>
<link rel="stylesheet" href="/manage/css/reserve.css">
<script>
 
$(document).ready(function () {

    getList();

});

function getList(){

    $("#list").jqGrid({
		url: "/manage/reserve/reserve-cancel-data.php",
		datatype: "json",
		mtype: "post",
		colNames: [ "선택", "번호", "지망", "등록일","예약일", "기업명", "구분", "휴양소명",  "평형", "객실수", "예약자" 
                    , "사원번호" , "연락처", "결과", "midx","hidx","cidx","seq"],
		colModel: [
			{ name: "idx", label:"선택", sortable:false, align:"center", formatter:checkBox, width:40} ,
			{ name: "no", label:"번호", sortable:true, align:"center", sorttype:'number',  width:40},
            { name: "chasu", label:"지망", sortable:true, align:"center",  width:60},
			{ name: "wdate", label:"등록일", sortable:true, align:"center", width: 70},
			{ name: "useday", label:"예약일", sortable:true, align:"center", width: 140},
            { name: "cname", label:"기업명", sortable:true, align:"center", width: 90},
            { name: "flag", label:"구분", sortable:true, align:"center", width: 50},
            { name: "hname", label:"휴양소명", sortable:true, align:"center", width: 140},
			{ name: "rArea", label:"평형", sortable:true, align:"center", width: 70},
            { name: "rCnt", label:"객실수", sortable:true, align:"center", sorttype:'number', width: 70},
            { name: "name", label:"예약자", sortable:true, align:"center", width: 70},
			{ name: "sano", label:"사원번호", sortable:true, align:"center", width: 70},
            { name: "hp", label:"연락처", sortable:true, align:"center", sorttype:'number', width: 112},
            { name: "regflag", label:"결과", sortable:true, align:"center", formatter:regflag, width: 112},
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
            flag : $('#flag').val()
        ,   cidx : $('#cidx').val()
        ,   hidx : $('#hidx').val()
        ,   regflag_two : $('#regflag_two').val()
        ,   com_amount1 : $('#com_amount1').val()
        ,   com_amount2 : $('#com_amount2').val()
        ,   per_amount1 : $('#per_amount1').val()
        ,   per_amount2 : $('#per_amount2').val()
    }

	//그리드 클리어
	$("#list").jqGrid("clearGridData", true);

	//데이터 호출
	$("#list").jqGrid('setGridParam', {
		url : "/manage/reserve/reserve-cancel-data.php", 
		datatype : 'json', 
		mtype : 'post', 
        postData : dataArr,
		success : function(data) {console(data);}//조건 폼값 전송
	}).trigger('reloadGrid'); //호출 완료 후 리로드    

}

function updateCancel(regflag_two){

    var frm = document.frm;
    var ridxs = getMultiInputValues(frm.chk);

    if(ridxs == ""){
        alert("선택 된 데이터가 없습니다.");
        return;
    }else{
        var txt;
        if(regflag_two == "3"){
            txt = "당첨취소 승인";
        }else{
            txt = "당첨취소 불가";
        }

        if(confirm(txt+" 하시겠습니까?" )){

            $.ajax({
                url		: "/manage/reserve/reserve_proc.php",
                type	: "POST",
                data	: { "mode":"CANCEL", "ridx": ridxs, "regflag_two":regflag_two },
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

}

</script>
<body>
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
    <div class="contents reser-cancel">
    <? 
        $MENU_DEPTH1 = "1";
        $MENU_DEPTH2 = "4";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/reserve/left.php"; 
    ?>
		<div class="center-con">
			<div class="cc-title">
				<div>취소 승인 관리</div>
			</div>
			<div class="cc-con">
				<form name="frm" action="#">
					<div class="view-c">
						<div class="view-mana">
                            <div class="mana-sel">
								<div class="msel sel1">
									<span class="ct-t">결과</span>
									<select name="regflag_two" id="regflag_two">
                                        <option value="">전체</option>
										<option value="2">당첨후 취소 신청중</option>
										<option value="3">당첨후 취소 확정</option>
										<option value="4">당첨후 취소 불가</option>
										<option value="8">취소</option>
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
									<span class="ct-t">구분</span>
									<select name="flag" id="flag" >
                                        <option value="">전체</option>
                                        <option value="상시">상시</option>
                                        <option value="하계">하계</option>
										<option value="동계">동계</option>
									</select>
								</div>
							</div>
							<div class="mana-price">
								<div class="price price1">
									<span class="ct-t">기업부담금</span>
									<div class="min-money"><input type="text" class="only-num" id="com_amount1"><span>원</span></div>
									<span class="hypen">~</span>
									<div class="max-money"><input type="text" class="only-num" id="com_amount2"><span>원</span></div>
								</div>
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
                                <button type="button" onClick="exportExcel('list');">선택 엑셀 다운로드</button>
								<button type="button" onClick="updateCancel('3');" >선택 당첨취소 승인</button>
								<button type="button" onClick="updateCancel('4');" >선택 당첨 취소 불가</button>
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
	
</body>
</html>