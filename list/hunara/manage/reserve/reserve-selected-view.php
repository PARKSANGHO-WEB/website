<? include("../inc/header.php"); ?>
<link rel="stylesheet" href="/manage/css/reserve.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/xls/0.7.4-a/xls.core.min.js"></script>  

<?
    $midx   = trim(sqlfilter($_REQUEST['midx']));
    $seq    = trim(sqlfilter($_REQUEST['seq']));

	$sql = " SELECT b.comname, c.comname as hname, c.post, c.addr1, c.addr2, c.tel, c.homepage, a.con5, ";
    $sql .= "   d.rArea, d.rType, d.rCnt, d.rAvg, d.rMax, d.rInfra, a.com_amount, a.per_amount, ";
	$sql .= "   a.flag, a.udate1, a.udate2, e.seq  ";
    $sql .= " FROM  tb_comhuM a, tb_company b, tb_hu c, tb_huType d, tb_comhuMtype e ";
	$sql .= " WHERE a.cidx = b.idx      ";
    $sql .= "   AND a.hidx = c.idx      ";
    $sql .= "   AND c.idx = d.idx       ";
    $sql .= "   AND a.midx = e.midx     ";
    $sql .= "   AND e.seq = d.seq       ";
    $sql .= "   AND a.midx = {$midx}    ";    
    $sql .= "   AND e.seq = {$seq}      ";    

    $rs = mysqli_query($gconnet, $sql);
    $row = mysqli_fetch_array($rs); 
    
?>
<script>
 
 $(document).ready(function () {
 
     getList();
     getList2([]);
     getList3([]);
     getList4();
 
 });
 
 function getList(){

     var dataArr = {  midx: '<?=$midx?>', seq: '<?=$seq?>'  };
 
     $("#list").jqGrid({
         url: "/manage/reserve/reserve-selected-view-data.php",
         datatype: "json",
         mtype: "post",
         postData : dataArr,
         colNames: [ "선택", "번호", "예약자" , "지망", "신청일","예약일", "기업명", "구분", "휴양소명",  "평형"
                     , "사원번호" , "연락처", "결과일", "예약번호", "결과", "midx","hidx","cidx","seq"],
         colModel: [
             { name: "idx", label:"선택", sortable:false, align:"center", formatter:checkBox, width:30} ,
             { name: "no", label:"번호", sortable:true, align:"center", sorttype:'integer',  width:35},
             { name: "name", label:"예약자", sortable:true, align:"center", width: 60,
                cellattr: function(rowId, tv, rowObject, cm, rdata) {
                     return 'style="cursor: pointer;"' 
                }
             },
             { name: "chasu", label:"지망", sortable:true, align:"center",  width:50},
             { name: "wdate", label:"신청일", sortable:true, align:"center", width: 70},
             { name: "useday", label:"예약일", sortable:true, align:"center", width: 130},
             { name: "cname", label:"기업명", sortable:true, align:"center", width: 100},
             { name: "flag", label:"구분", sortable:true, align:"center", width: 40},
             { name: "hname", label:"휴양소명", sortable:true, align:"center", width: 120},
             { name: "rArea", label:"평형", sortable:true, align:"center", width: 40},
             { name: "sano", label:"사원번호", sortable:true, align:"center", width: 80},
             { name: "hp", label:"연락처", sortable:true, align:"center", sorttype:'integer', width: 90},
             { name: "udate", label:"결과일", sortable:true, align:"center", width: 70},
             { name: "digit7", label:"예약번호", sortable:true, align:"center", width: 60},
             { name: "regflag", label:"결과", sortable:true, align:"center", formatter:regflag, width: 97},
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

	   		if(cellNm[index].name == 'name')
   			{
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

function view(id){ 

    var rowData = $("#list").jqGrid("getRowData", id);

    employeeLogin(rowData.cidx, rowData.sano);
}
 
function search(){
 
     var f = document.frm;
 
     var dataArr = {
             midx : '<?=$midx?>'
         ,   seq : '<?=$seq?>'
         ,   regflag : $('#regflag').val()
     }
 
 
     //그리드 클리어
     $("#list").jqGrid("clearGridData", true);
 
     //데이터 호출
     $("#list").jqGrid('setGridParam', {
         url : "/manage/reserve/reserve-selected-view-data.php", 
         datatype : 'json', 
         mtype : 'post', 
         postData : dataArr,
         success : function(data) {console(data);}//조건 폼값 전송
     }).trigger('reloadGrid'); //호출 완료 후 리로드    
 
 }

 function fileUpload(mode){

    var form = $("#frm")[0];
    var formData = new FormData(form);
    formData.append("mode", mode);
    
    if(mode == "EXCEL_DROPOUT"){

        if($("#file_dropout")[0].files[0].type != "application/vnd.ms-excel"){
            alert("엑셀 파일로 업로드 하십시오.");
            return;
        }
        formData.append("file", $("#file_dropout")[0].files[0]); 
        $("#txt_dropout").html($("#file_dropout")[0].files[0].name);

        $("#list2").jqGrid("clearGridData", true);
    }else{
        
        if($("#file_winner")[0].files[0].type != "application/vnd.ms-excel"){
            alert("엑셀 파일로 업로드 하십시오.");
            return;
        }
        formData.append("file", $("#file_winner")[0].files[0]); 
        $("#txt_winner").html($("#file_winner")[0].files[0].name);

        $("#list3").jqGrid("clearGridData", true);
    }
    
     $.ajax({
        url		: "/manage/reserve/reserve-selected-proc.php?midx=<?=$midx?>",
        type	: "POST",
        processData : false,
        contentType : false,
        data : formData,
        datatype: 'json',
        success		: function(json){
                    
            var data = JSON.parse(json);

            if ( data.success == "true" ){

                if(mode == "EXCEL_DROPOUT"){
                    getList2(data.dataList);
                    $("#file_dropout").val("");

                }else{
                    getList3(data.dataList);
                    $("#file_winner").val("");
                }

            } else if ( data.success == "false" ){
                alert(data.msg);
            } else {
                alert( "시스템 오류 발생 하였습니다. \n 관리자에게 문의하시기 바랍니다." );
            }
        }
    });     
 }

 //탈락자 내역 리스트
 function getList2(mydata){

    $("#list2").jqGrid({
         datatype: "local",
         colNames: [ "번호", "사원번호", "차수"],
        colModel: [
            { name: "idx", sortable:true, align:"center", sorttype:'integer',  width:176},
            { name: "sano", sortable:true, align:"center", width: 600},
            { name: "chasu", sortable:true, align:"center", width: 500},
        ],
         pager: "#pager2",
         rowNum: 5,
         height: 'auto',
         multiselect: true,
         viewrecords: true,
         gridview: true,
         loadonce : true,
         autowidth : true,
         caption: ""
 
    });    


    $("#list2").jqGrid('setGridParam', { 
        datatype: 'local',
        data:mydata
    }).trigger("reloadGrid");

 }

//예약자 내역 리스트
 function getList3(mydata){

    $("#list3").jqGrid({
        datatype: "local",
        colNames: [ "번호", "사원번호", "당첨번호","차수"],
        colModel: [
            { name: "idx", sortable:true, align:"center", sorttype:'integer',  width:176},
            { name: "sano", sortable:true, align:"center", width: 300},
            { name: "digit7", sortable:true, align:"center", width: 300},
            { name: "chasu", sortable:true, align:"center", width: 270},
        ],
        pager: "#pager3",
        rowNum: 5,
        height: 'auto',
        multiselect: true,
        viewrecords: true,
        gridview: true,
        loadonce : true,
        autowidth : true,
        caption: ""

    });    

    if(mydata.length != undefined ){
        $("#list3").jqGrid('setGridParam', { 
            datatype: 'local',
            data:mydata
        }).trigger("reloadGrid");
    }
}
//선택 삭제 버튼 
function delGridRow(gridId){
    var recs = $("#"+gridId).jqGrid('getGridParam', 'selarrrow');
    var rows = recs.length;

    if(rows < 1){
        alert("선택된 행이 없습니다.");
        return;
    }    

    for (var i = rows - 1; i >= 0; i--) {
        $('#'+gridId).jqGrid('delRowData', recs[i]);
    }
}

//전체 삭제 버튼
function delGridAllRow(gridId){
    $("#"+gridId).jqGrid("clearGridData", true);
}

//탈락자 선택적용
function selRowProc_DROPOUT(gridId){
    var recs = $("#"+gridId).jqGrid('getGridParam', 'selarrrow');
    var rows = recs.length;

    if(rows < 1){
        alert("선택된 행이 없습니다.");
        return;
    }

    var rowData;
    var sanoList = new Array();
    for (var i = rows - 1; i >= 0; i--) {
        rowData = $('#'+gridId).jqGrid('getRowData', recs[i]);
        sanoList.push(rowData.sano+":"+rowData.chasu);
    }

    gridProc("DIGIT8", sanoList);

}
//탈락자 전체적용
function allRowProc_DROPOUT(gridId){

    var sanoList = new Array();
    var mya = $("#"+gridId).jqGrid('getGridParam','data');

    if(mya.length < 1){
        alert("적용할 데이터가 없습니다.");
        return;
    }    

	for (var i = 0; i < mya.length; i++) {
        var datac = mya[i];
        console.log(datac);
        // 그리드 전체 데이터 조회
        sanoList.push(datac['sano']+":"+datac['chasu']);
    }

    gridProc("DIGIT8", sanoList);

}

//예약자 선택적용
function selRowProc_WINNER(gridId){
    var recs = $("#"+gridId).jqGrid('getGridParam', 'selarrrow');
    var rows = recs.length;

    if(rows < 1){
        alert("선택된 행이 없습니다.");
        return;
    }

    var rowData;
    var sanoList = new Array();
    for (var i = rows - 1; i >= 0; i--) {
        rowData = $('#'+gridId).jqGrid('getRowData', recs[i]);
        sanoList.push(rowData.sano+":"+rowData.digit7+":"+rowData.chasu);
    }

    gridProc("DIGIT7", sanoList);

}

//예약자 전체적용
function allRowProc_WINNER(gridId){

    var sanoList = new Array();
    var mya = $("#"+gridId).jqGrid('getGridParam','data');

    if(mya.length < 1){
        alert("적용할 데이터가 없습니다.");
        return;
    }    

    for (var i = 0; i < mya.length; i++) {
        var datac = mya[i];
        console.log(datac);
        // 그리드 전체 데이터 조회
        sanoList.push(datac['sano']+":"+datac['digit7']+":"+datac['chasu']);
    }

    gridProc("DIGIT7", sanoList);

}


// 당첨/탈락 처리
function gridProc(mode, sanoList){

    if(sanoList.length > 0){

        $.ajax({
            url		: "/manage/reserve/reserve-selected-proc.php",
            type	: "POST",
            data : {"mode": mode, "midx": "<?=$midx?>", "seq": "<?=$seq?>", "sano" : sanoList.join(",")},
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

 function fileDownload(mode){
     console.log(mode);
    var frm = document.frm;

    if(mode == "EXCEL_DROPOUT"){
        frm.action = "/upload_file/excel_upload/탈락자_양식.xls";
    }else{
        frm.action = "/upload_file/excel_upload/예약자_양식.xls";
    }

    frm.target = "ifrm";
    frm.submit();

 }

 function goList(){
     document.location.href = "/manage/reserve/reserve-selected.php";
 }

 function snsPopup(){

    var dataList = new Array();
    $("input[name=chk]:checked").each(function(){
        if($(this).val() != "on"){
            dataList.push($(this).val());
        }
    });    

    if(dataList.length < 1){
        alert("선택된 행이 없습니다.");
        return;
    }else {

        $(".noti-modal").addClass("visible");

        var dataArr = {  midx: '<?=$midx?>', seq: '<?=$seq?>', ridxArr: dataList.join(',')  };

        //그리드 클리어
        $("#list4").jqGrid("clearGridData", true);
    
        //데이터 호출
        $("#list4").jqGrid('setGridParam', {
            url : "/manage/reserve/reserve-selected-view-data.php", 
            datatype : 'json', 
            mtype : 'post', 
            postData : dataArr,
            success : function(data) {console(data);}//조건 폼값 전송
        }).trigger('reloadGrid'); //호출 완료 후 리로드   
    }

 }
 
 function getList4(){
    var dataArr = {  midx: '<?=$midx?>', seq: '<?=$seq?>'  };
    
    $("#list4").jqGrid({
        url: "/manage/reserve/reserve-selected-view-data.php",
        datatype: "json",
        mtype: "post",
        postData : dataArr,
        colModel: [
            { name: "idx", hidden:true },
            { name: "no", hidden:true },
            { name: "name", label:"예약자", sortable:true, align:"center", width: 60},
            { name: "chasu", hidden:true },
            { name: "wdate", hidden:true },
            { name: "useday", label:"예약일", sortable:true, align:"center", width: 141},
            { name: "cname", label:"기업명", sortable:true, align:"center", width: 110},
            { name: "flag", label:"구분", sortable:true, align:"center", width: 50},
            { name: "hname", label:"휴양소명", sortable:true, align:"center", width: 110},
            { name: "rArea", label:"평형", sortable:true, align:"center", width: 50},
            { name: "sano", label:"사원번호", sortable:true, align:"center", width: 80},
            { name: "hp", label:"연락처", sortable:true, align:"center",  width: 100},
            { name: "udate", hidden:true},
            { name: "digit7", hidden:true},
            { name: "regflag", label:"결과", sortable:true, align:"center", width: 60},
            { name: "midx", hidden:true},
            { name: "hidx", hidden:true},
            { name: "cidx", hidden:true},
            { name: "seq", hidden:true}
        ],
        pager: "#pager4",
        rowNum: 5,
        sortname: "useday",
        sortorder: "desc",
        height: 'auto',
        viewrecords: true,
        gridview: true,
        loadonce : true,
        autowidth : true,
        caption: ""

    });
 }

 function sendSNS(){

    var flag = $("input[name=talk]:checked").val();

    var msg = '';
    if(flag == 'prize') {
        msg = '당첨안내';
    }else if(flag == 'enter') {
        msg = '입실안내';
    }else if(flag == 'fail') {
        msg = '탈락안내';
    }

    if(confirm(msg+' 전송 하시겠습니까')){

        var mya = $("#list4").jqGrid('getGridParam','data');
        var ridxArr = [];
        for (var i = 0; i < mya.length; i++) {
            var datac = mya[i];
            ridxArr.push(datac['idx']);
        }

        console.log(ridxArr.join(','));
        

        $.ajax({
            url		: "/manage/reserve/kakaotalk_proc.php",
            type	: "POST",
            data	: { "mode": flag, "ridxArr":ridxArr.join(',') },
            async	: false,
            dataType	: "json",
            success		: function(data){

                if ( data.success == "true" ){
                    alert(data.msg);

                } else if ( data.success == "false" ){
                    alert(data.msg);
                    return;
                } else {
                    alert( "시스템 오류 발생 하였습니다. \n 관리자에게 문의하시기 바랍니다." );
                    return;
                }
            }
        });    


    }

 }
 </script>

<style type="text/css">

.ui-jqgrid-bdiv {
    overflow-y: scroll !important;
    max-height: 600px !important;
}

</style>
<body>
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
    <div class="contents reserve-view">
    <? 
        $MENU_DEPTH1 = "1";
        $MENU_DEPTH2 = "1";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/reserve/left.php"; 
    ?>
		<div class="center-con">
			<div class="cc-title">
				<div>당첨 등록 관리</div>
				<div class="big-arrow"><img src="../img/common/big-arrow.png" alt=""></div>
				<div>상세</div>
			</div>
			<div class="cc-con">
				<form id="frm" name="frm" action="#">
					<div class="view view-1 on">
						<div class="view-t active">휴양소 정보</div>
						<div class="view-c">
							<table class="reserve1">
								<tr>
									<th>기업명</th>
									<td><?=$row['comname']?></td>
								</tr>
								<tr>
									<th>휴양소명</th>
									<td><?=$row['hname']?></td>
								</tr>
								<tr>
									<th>주소</th>
									<td>(<?=$row['post']?>) <?=$row['addr1']." ".$row['addr2']?></td>
								</tr>
								<tr>
									<th>연락처</th>
									<td><?=$row['tel']?></td>
								</tr>
								<tr>
									<th>홈페이지</th>
									<td><a href="<?=$row['homepage']?>" target="_blank"><?=$row['homepage']?></a></td>
								</tr>
								<tr>
									<th>이용혜택</th>
									<td><?=$row['con5']?></td>
								</tr>
								<tr>
									<th>객실 선택</th>
									<td>
										<div class="reser-l">
											<span>평형&nbsp;:&nbsp;<?=$row['rArea']?>,&nbsp;&nbsp;타입&nbsp;:&nbsp;<?=$row['rType']?>,&nbsp;&nbsp;
                                                객실 수&nbsp;:&nbsp;<?=$row['rCnt']?>,&nbsp;&nbsp;기준&nbsp;:&nbsp;<?=$row['rAvg']?>,&nbsp;&nbsp;
                                                최대&nbsp;:&nbsp;<?=$row['rMax']?>,&nbsp;&nbsp;시설&nbsp;:&nbsp;<?=$row['rInfra']?>
                                            </span>
										</div>
										<div class="reser-l">
											<span>
                                             <?
                                                $sql2 = " SELECT useday FROM tb_comhuM_useday  WHERE midx = {$midx} AND seq = {$row['seq']} ";
                                                $rs2 = mysqli_query($gconnet, $sql2);
                                                                                             
                                                for($i=0; $i< mysqli_num_rows($rs2); $i++){
                                                    $row2 = mysqli_fetch_array($rs2);   
                                                    
                                                    if($i > 0) echo "/";
                                                    echo $usedayArray[$row2['useday']];
                                                }
                                             ?>   
                                            </span>
										</div>
									</td>
								</tr>
								<tr>
									<th>부담금</th>
									<td>기업&nbsp;<?=number_format($row['com_amount'])?>원,&nbsp;&nbsp;
                                        개인&nbsp;<?=number_format($row['per_amount'])?>원,&nbsp;&nbsp;
                                        총&nbsp;<?=number_format($row['com_amount']+$row['per_amount'])?>원</td>
								</tr>
								<tr>
									<th>구분</th>
									<td>
										<div class="period">
											<input type="radio" name="period" id="w-spring" disabled <?=($row['flag']=="동계")?"checked":""?>>
											<label for="w-spring">동계</label>
										</div>
										<div class="period">
											<input type="radio" name="period" id="p-spring"disabled <?=($row['flag']=="하계")?"checked":""?>>
											<label for="p-spring">하계</label>
										</div>
										<div class="period">
											<input type="radio" name="period" id="a-spring"disabled <?=($row['flag']=="상시")?"checked":""?>>
											<label for="a-spring">상시</label>
										</div>
									</td>
								</tr>
								<tr>
									<th>이용기간</th>
									<td>
                                        <?=tranStrDate(to_date($row['udate1']),'YmdKo2')?>
                                        ~ <?=tranStrDate(to_date($row['udate2']),'YmdKo2')?>
                                    </td>
								</tr>
							</table>
						</div>
					</div>
					<div class="view view-2">
						<div class="view-t">신청자 내역</div>
						<div class="view-c">
							<div class="com-search">
								<div class="com-tab">
									<select name="regflag" id="regflag" class="wSelect-el">
										<option value="">전체</option>
										<option value="9">탈락자만</option>
										<option value="5">당첨자만</option>
										<option value="8">취소자만</option>
									</select>

									<button type="button" onClick="search();" style="margin-left:10px;">검색</button>
								</div>
							</div>
							<div class="btn-wrap">
								<div class="btn-float">
									<button type="button" onclick="exportExcel('list');">프린트</button>
								</div>
							</div>
							<div class="view-host">
								<div class="all-c">
									<input type="checkbox" name="all" class="all-check" id="apply-all" data-check-pattern="[name^='chk']" >
									<label for="apply-all">전체선택</label>
									<button class="sns-on" type="button" onClick="snsPopup();">SNS</button>
								</div>

                                <table id="list"></table>
                                <div id="pager"></div>

							</div>
						</div>
					</div>
					<div class="view view-3">
						<div class="view-t">탈락자 내역 올리기</div>
						
						<div class="view-c" id="layerDropout">
							<div class="sample-up">
								<div class="file-input">
									<input type="file" name="file_dropout" id="file_dropout" onChange="fileUpload('EXCEL_DROPOUT');">
									<span class="button">파일선택</span>
									<span class="label" data-js-label="" id="txt_dropout">선택된 파일 없음</span>
								</div>
							</div>
							<div class="btn-wrap">
								<div class="btn-float">
									<button type="button" onClick="delGridRow('list2');">선택 삭제</button>
									<button type="button" onClick="delGridAllRow('list2');">전체 삭제</button>
								</div>
							</div>
							<div class="view-host">
								<div class="all-c">
									<button class="sample-down" type="button" onClick="fileDownload('EXCEL_DROPOUT');" >샘플양식 다운로드</button>
								</div>

                                <table id="list2"></table>
                                <div id="pager2"></div>
                                <br>
								<div class="rv3-btn" >
									<button type="button" onClick="allRowProc_DROPOUT('list2');">전체 적용</button>
									<button type="button" onClick="selRowProc_DROPOUT('list2');">선택 적용</button>
								</div>
							</div>
						</div>
					</div>
					<div class="view view-3" id="layerWinner" >
						<div class="view-t">예약자 내역 올리기</div>
						
						<div class="view-c">
							<div class="sample-up">
								<div class="file-input">
									<input type="file" name="file_winner" id="file_winner" onChange="fileUpload('EXCEL_WINNER');">
									<span class="button">파일선택</span>
									<span class="label" data-js-label="" id="txt_winner">선택된 파일 없음</span>
								</div>
							</div>
							<div class="btn-wrap">
								<div class="btn-float">
									<button type="button" onClick="delGridRow('list3');">선택 삭제</button>
									<button type="button" onClick="delGridAllRow('list3');">전체 삭제</button>
								</div>
							</div>
							<div class="view-host">
								<div class="all-c">
									<button class="sample-down" type="button" onClick="fileDownload('EXCEL_WINNER');" >샘플양식 다운로드</button>
								</div>

                                <table id="list3"></table>
                                <div id="pager3"></div>
                                <br>
								<div class="rv3-btn">
									<button type="button" onClick="allRowProc_WINNER('list3');">전체 적용</button>
									<button type="button" onClick="selRowProc_WINNER('list3');">선택 적용</button>
								</div>
							</div>
						</div>
					</div>
					<div class="view-btn">
						<div class="btn-wrap">
							<button type="button" onClick="goList();">취소</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!--알림톡 수정-->
	<div class="noti-modal modal-wrap">
		<div class="modal-con">
			<div class="modal-top">
				<div class="title-modal">
					<span>SNS</span>
				</div>
				<div class="close-modal">
					<img src="../img/common/close.png" alt="">
				</div>
			</div>
			<div class="modal-bot">
				<form action="#">
				<div class="nm-t">알림톡</div>
					<div class="mo-con mo-con1">
						<div class="form form-1">
							<input type="radio" name="talk" id="okayRadio" value="prize" checked>
							<label for="okayRadio">
								<div class="nf-t"><span>당첨안내</span></div>
								<div class="nf-c">
									<img src="../img/talk1.png" alt="">
								</div>
							</label>
						</div>
						<div class="form form-2">
							<input type="radio" name="talk" id="goRadio" value="enter" >
							<label for="goRadio">
								<div class="nf-t"><span>입실안내</span></div>
								<div class="nf-c">
									<img src="../img/talk2.png" alt="">
								</div>
							</label>
						</div>
						<div class="form form-2">
							<input type="radio" name="talk" id="failRadio" value="fail" >
							<label for="failRadio">
								<div class="nf-t"><span>탈락안내</span></div>
								<div class="nf-c">
									<img src="../img/talk3.png" alt="">
								</div>
							</label>
						</div>
					</div>
					<div>
						<div class="nm-t">받는 사람</div>
						<div class="list-wrap">
							<div class="list-table">
                                <table id="list4"></table>
                                <div id="pager4"></div>
								<div class="btn-apply">
									<button type="button" onClick="sendSNS();" >전송</button>
								</div>						
							</div>
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
            /*
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
            */
		});


		
	</script>
	
<iframe name="ifrm"	 id="ifrm" width="0" height="0"></iframe>
</body>
</html>