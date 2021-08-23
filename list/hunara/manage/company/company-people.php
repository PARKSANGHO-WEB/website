<? include("../inc/header.php"); ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<script>
 
$(document).ready(function () {

    getList();
	getList2();
    getList3();
    getList4();

});

function getList(){

    $("#list").jqGrid({
		url: "company-people-data.php",
		datatype: "json",
		mtype: "post",
		colNames: [ "선택", "번호", "기업명", "직급", "사원명", "주민번호 뒤 7자리<br>(이용권번호)", "사원번호","가중치","신청횟수","당첨횟수","취소횟수","비밀번호","예약제외"],
		colModel: [
			{ name: "idx",label:"선택", sortable:true, align:"center", formatter:checkBox, width:40},
			{ name: "no",label:"번호", sortable:true, align:"center", sorttype:'integer', width:60},
			{ name: "comname",label:"기업명", sortable:true, align:"center", width: 80},
            { name: "class",label:"직급", sortable:true, align:"center", width: 80},
            { name: "name",label:"사원명", sortable:true, align:"center", width: 80},
			{ name: "digit7",label:"주민번호 뒤 7자리<br>(이용권번호)", sortable:true, align:"center", width: 100},
			{ name: "sano",label:"사원번호", sortable:true, align:"center", width: 80},
            { name: "weight",label:"가중치", sortable:true, align:"center", width: 60},
            { name: "apply",label:"신청횟수", sortable:true, align:"center", width: 60},
			{ name: "winning",label:"당첨횟수", sortable:true, align:"center", width: 80},
            { name: "cancel",label:"취소횟수", sortable:true, align:"center", width: 80},
            { name: "pwd",label:"비밀번호", sortable:true, align:"center", width: 80},
            { name: "exclude",label:"예약제외", sortable:true, align:"center", width: 80}
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
        loadComplete:function(data){   
        },	
		caption: ""

	});     

}

function getList2(){

$("#list2").jqGrid({
	url: "company-people-excel-data.php?id=0",
	datatype: "json",
	mtype: "post",
	colNames: [ "선택", "번호",  "소속", "직급", "사원명", "주민번호 뒤 7자리<br>(이용권번호)", "사원번호", "가중치","연락처","휴대폰","이메일","중복여부"],
	colModel: [
		{ name: "idx",label:"선택", sortable:true, align:"center", formatter:check, width:40},
		{ name: "no",label:"번호", sortable:true, align:"center", sorttype:'number', width:40},
		{ name: "team",label:"소속", sortable:true, align:"center", width: 60},
		{ name: "class",label:"직급", sortable:true, align:"center", width: 60},
		{ name: "name",label:"사원명", sortable:true, align:"center", width: 60},
		{ name: "digit7",label:"주민번호 뒤 7자리<br>(이용권번호)", sortable:true, align:"center", width: 120},
		{ name: "sano",label:"사원번호", sortable:true, align:"center", width: 80},
		{ name: "weight",label:"가중치", sortable:true, align:"center", width: 60},
		{ name: "tel",label:"연락처", sortable:true, align:"center", width: 100},
		{ name: "hp",label:"휴대폰", sortable:true, align:"center", width: 100},
		{ name: "email",label:"이메일", sortable:true, align:"center", width: 100},
		{ name: "duplicate",label:"중복여부", sortable:true, align:"center", width: 60}
		],
	pager: "#pager2",
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
			//view(rowId);
		   }

	   },
	loadComplete:function(data){   
	},	
	caption: ""

});     

}

function getList3(){

$("#list3").jqGrid({
	url: "company-people-excel-data2.php?id=0",
	datatype: "json",
	mtype: "post",
	colNames: [ "선택", "번호", "사원명", "사원번호","사용가능여부"],
	colModel: [
		{ name: "idx",label:"선택", sortable:true, align:"center", formatter:check2, width:40},
		{ name: "no",label:"번호", sortable:true, align:"center", sorttype:'number', width:40},
		{ name: "name",label:"사원명", sortable:true, align:"center", width: 240},
		{ name: "sano",label:"사원번호", sortable:true, align:"center", width: 320},
		{ name: "duplicate",label:"사용가능여부", sortable:true, align:"center", width: 240}
		],
	pager: "#pager3",
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
			//view(rowId);
		   }

	   },
	loadComplete:function(data){   
	},	
	caption: ""

});     

}

function getList4(){

$("#list4").jqGrid({
	url: "company-people-excel-data2.php?id=0",
	datatype: "json",
	mtype: "post",
	colNames: [ "선택", "번호", "사원명", "사원번호","사용가능여부"],
	colModel: [
		{ name: "idx",label:"선택", sortable:true, align:"center", formatter:check3, width:40},
		{ name: "no",label:"번호", sortable:true, align:"center", sorttype:'number', width:40},
		{ name: "name",label:"사원명", sortable:true, align:"center", width: 240},
		{ name: "sano",label:"사원번호", sortable:true, align:"center", width: 320},
		{ name: "duplicate",label:"사용가능여부", sortable:true, align:"center", width: 240}
		],
	pager: "#pager4",
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
        var str = "<input type='checkbox' id='hostpeo[]' name='hostpeo[]' required='yes'  message='체크' value='"+idx+"'";
        
        return str;
}

function check(cellvalue, options, rowObject){
        var idx = cellvalue;
        var str = "<input type='checkbox' id='hostpeo2[]' name='hostpeo2[]'  message='체크' value='"+idx+"'";
        
        return str;
}

function check2(cellvalue, options, rowObject){
        var idx = cellvalue;
        var str = "<input type='checkbox' id='hostpeo3[]' name='hostpeo3[]'  message='체크' value='"+idx+"'";
        
        return str;
}

function check3(cellvalue, options, rowObject){
        var idx = cellvalue;
        var str = "<input type='checkbox' id='hostpeo4[]' name='hostpeo4[]'  message='체크' value='"+idx+"'";
        
        return str;
}

function search(){

    var dataArr = {
            	id : $('#id').val()
				,   sano : $('#sano').val()
				,   name : $('#name').val()
                ,   exclude : $('#exclude').val()
    }

	//그리드 클리어
	$("#list").jqGrid("clearGridData", true);

	//데이터 호출
	$("#list").jqGrid('setGridParam', {
		url : "company-people-data.php", 
		datatype : 'json', 
		mtype : 'post', 
		//postData : $("#SerachFrm").serialize(),
        postData : dataArr,
		success : function(data) {console(data);}//조건 폼값 전송
	}).trigger('reloadGrid'); //호출 완료 후 리로드    

}

function search2(max,duplicate){
    var a = $('#flag').val();
    if(max != '' && max != null){
        $('#max').val(max);
        $('#duplicate').val(duplicate);
    }
    $('#flag').val('Y');

var dataArr = {
		    id : max
        ,   dupl : $('#dupl').val()
}

//그리드 클리어
$("#list2").jqGrid("clearGridData", true);

//데이터 호출
$("#list2").jqGrid('setGridParam', {
	url : "company-people-excel-data.php", 
	datatype : 'json', 
	mtype : 'post', 
	//postData : $("#SerachFrm").serialize(),
	postData : dataArr,
	success : function(data) {console(data);}//조건 폼값 전송
}).trigger('reloadGrid'); //호출 완료 후 리로드    

}

function search3(max,duplicate){
    var a = $('#flag2').val();
    if(max != '' && max != null){
        $('#max2').val(max);
        $('#duplicate2').val(duplicate);
    }
    $('#flag2').val('Y');

var dataArr = {
		    id : max
        ,   dupl : $('#dupl2').val()
}

//그리드 클리어
$("#list3").jqGrid("clearGridData", true);

//데이터 호출
$("#list3").jqGrid('setGridParam', {
	url : "company-people-excel-data2.php", 
	datatype : 'json', 
	mtype : 'post', 
	//postData : $("#SerachFrm").serialize(),
	postData : dataArr,
	success : function(data) {console(data);}//조건 폼값 전송
}).trigger('reloadGrid'); //호출 완료 후 리로드    

}

function search4(max,duplicate){
    var a = $('#flag3').val();
    if(max != '' && max != null){
        $('#max3').val(max);
        $('#duplicate3').val(duplicate);
    }
    $('#flag3').val('Y');

var dataArr = {
		    id : max
        ,   dupl : $('#dupl3').val()
}

//그리드 클리어
$("#list4").jqGrid("clearGridData", true);

//데이터 호출
$("#list4").jqGrid('setGridParam', {
	url : "company-people-excel-data2.php", 
	datatype : 'json', 
	mtype : 'post', 
	//postData : $("#SerachFrm").serialize(),
	postData : dataArr,
	success : function(data) {console(data);}//조건 폼값 전송
}).trigger('reloadGrid'); //호출 완료 후 리로드    

}


function view(idx){
    
    document.location.href = "company-people-view.php?idx="+idx;
}

function go_tot_del() {
        /*var check = chkFrm('frm');
        if(check) {
            if(confirm('선택하신 공지를 삭제 하시겠습니까?')){
                frm.action = "notice_list_del_action.php";
                frm.submit();
            }
        } else {
            false;
        }*/
        const query = 'input[name="hostpeo[]"]:checked';
        const selectedEls = 
            document.querySelectorAll(query);
        
        // 선택된 목록에서 value 찾기
        let result = '';
        selectedEls.forEach((el) => {
            result += el.value + ',';
        });
        
        // 출력
        if(result){
            if(confirm('정말 삭제하시겠습니까 ?')){
                location.href='./company-people_list_del_action.php?idx='+result.slice(0,-1)+'';
                console.log(result.slice(0,-1));
            }
        }
    }

    function go_tot_del2() {
        /*var check = chkFrm('frm');
        if(check) {
            if(confirm('선택하신 공지를 삭제 하시겠습니까?')){
                frm.action = "notice_list_del_action.php";
                frm.submit();
            }
        } else {
            false;
        }*/
        const query = 'input[name="hostpeo2[]"]:checked';
        const selectedEls = 
            document.querySelectorAll(query);
        
        // 선택된 목록에서 value 찾기
        let result = '';
        selectedEls.forEach((el) => {
            result += el.value + ',';
        });

        var max = $('#max').val();
        
        // 출력
        if(result){
            var dataArr = {
                    idx : result.slice(0,-1)
                ,   max : max
            };

            $.ajax({
                url		: "/manage/company/company-people_list_del_action2.php",
                type	: "POST",
                data	: dataArr,
                async	: false,
                dataType	: "json",
                success		: function(data){
                    if ( data.success == "true" ){
                        alert(data.msg);
                        $('#duplicate').val(data.duplicate);
                        search2();

                    } else if ( data.success == "false" ){
                        alert(data.msg);
                        
                    } else {
                        alert( "시스템 오류 발생 하였습니다." );
                    }
                }
            }); 
        }
    }

    function go_tot_del3() {
        /*var check = chkFrm('frm');
        if(check) {
            if(confirm('선택하신 공지를 삭제 하시겠습니까?')){
                frm.action = "notice_list_del_action.php";
                frm.submit();
            }
        } else {
            false;
        }*/
        const query = 'input[name="hostpeo3[]"]:checked';
        const selectedEls = 
            document.querySelectorAll(query);
        
        // 선택된 목록에서 value 찾기
        let result = '';
        selectedEls.forEach((el) => {
            result += el.value + ',';
        });

        var max = $('#max2').val();
        
        // 출력
        if(result){
            var dataArr = {
                    idx : result.slice(0,-1)
                ,   max : max
            };

            $.ajax({
                url		: "/manage/company/company-people_list_del_action3.php",
                type	: "POST",
                data	: dataArr,
                async	: false,
                dataType	: "json",
                success		: function(data){
                    if ( data.success == "true" ){
                        alert(data.msg);
                        $('#duplicate2').val(data.duplicate);
                        search3();

                    } else if ( data.success == "false" ){
                        alert(data.msg);
                        
                    } else {
                        alert( "시스템 오류 발생 하였습니다." );
                    }
                }
            }); 
        }
    }

    function go_tot_del4() {
        /*var check = chkFrm('frm');
        if(check) {
            if(confirm('선택하신 공지를 삭제 하시겠습니까?')){
                frm.action = "notice_list_del_action.php";
                frm.submit();
            }
        } else {
            false;
        }*/
        const query = 'input[name="hostpeo4[]"]:checked';
        const selectedEls = 
            document.querySelectorAll(query);
        
        // 선택된 목록에서 value 찾기
        let result = '';
        selectedEls.forEach((el) => {
            result += el.value + ',';
        });

        var max = $('#max3').val();
        
        // 출력
        if(result){
            var dataArr = {
                    idx : result.slice(0,-1)
                ,   max : max
            };

            $.ajax({
                url		: "/manage/company/company-people_list_del_action4.php",
                type	: "POST",
                data	: dataArr,
                async	: false,
                dataType	: "json",
                success		: function(data){
                    if ( data.success == "true" ){
                        alert(data.msg);
                        $('#duplicate3').val(data.duplicate);
                        search4();

                    } else if ( data.success == "false" ){
                        alert(data.msg);
                        
                    } else {
                        alert( "시스템 오류 발생 하였습니다." );
                    }
                }
            }); 
        }
    }
function deleteAll(){
    var id = $('#id').val();
    if(id == ''){
        alert('기업을 선택 해주시길 바랍니다.');
        return false;
    }
    if(confirm('정말 전체 삭제하시겠습니까 ?')){
        if(confirm('삭제한 데이터는 복구 할 수 없습니다.')){
            location.href='./company-people_all_del_action.php?idx='+id+'';
        }
    }

}
</script>

<body class="cp-m">
	<?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
    <div class="contents company-peo">
    <? 
        $MENU_DEPTH1 = "1";
        $MENU_DEPTH2 = "3";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/company/left.php"; 
    ?>    
	
	
		
		<div class="center-con">
			<div class="cc-title">
				<div>기업 사원 관리</div>
			</div>
            <form name="s_mem" id="s_mem" method="post" action="<?php $_SERVER[PHP_SELP] ?>">
			<div class="com-search new-com">
				<div class="min-money">
					<span>사원명</span><input type="text" id="name" style="width:100px">
				</div> 
				<div class="min-money">
					<span>사원번호</span><input type="text" id="sano" style="width:100px">
				</div> 
                <div class="min-money">
                    <select name="exclude" id="exclude">
                        <option value="">　　전체　　</option>
                        <option value="Y">　예약예외　</option>
                        <option value="N">　예약가능　</option>
                    </select>
                </div>
				<div class="com-tab">				
                    <select name="id" id="id">
                        <option value="">기업명을 선택하세요.</option>
                        <?= getSelectBox($gconnet, 'idx', 'comname', 'tb_company') ?>
                    </select>
					
					<button type="button" onclick="search();">검색</button>
				</div>
			</div>
            </form>
			<div class="cc-con">
					
						<div class="view-c">
							<div class="btn-wrap">
								<div class="btn-float">
									<button class="limit-people" type="button">예외등록</button>
									<button class="add-people" type="button">사원등록</button>
									<button type="button" onclick="go_tot_del();">선택 삭제</button>
                                    <button class="rightS btnAm"  type="button" onclick="deleteAll();">전체 삭제</button>
									<button type="button" onclick="exportExcel('list');">프린트</button>
								</div>
							</div>
							<div class="view-host">
								<div class="all-c">
									<input type="checkbox"id="hostPall" data-check-pattern="[name^='hostpeo']"  name="hostPall" id="hostPall">
									<label for="hostPall">전체선택</label>
								</div>
                                <table id="list"></table>
                                <div id="pager"></div>

								<div class="paging">
                                    <?include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/paging.php";?>
                                </div>
							</div>
						</div>
				</form>
			</div>
		</div>
	</div>
	<div class="add-modal modal-wrap">
		<div class="modal-con">
			<div class="modal-top">
				<div class="title-modal">
					<span>사원등록</span>
				</div>
				<div class="close-modal">
					<img src="../img/common/close.png" alt="">
				</div>
			</div>
			<div class="modal-bot">
				<div class="tab-btn">
					<ul> 
						<li class="active"><a href="javascript:;">개별등록</a></li>
						<li><a href="javascript:;">일괄등록</a></li>
					</ul>
				</div>
				<form name="frm" action="people_one_action.php" target="_fra_admin" method="post"  enctype="multipart/form-data">
					<div class="tab-wrap">
						<div class="mo-con">
							<div class="indi-wrap">
								<ul>
											<select name="id" id="id">
												<option value="">기업명을 선택하세요.</option>
												 <?= getSelectBox($gconnet, 'idx', 'comname', 'tb_company') ?>
											 </select>
									<!--<li>
										<div class="indi-t">등록일</div>
										<div class="indi-c"><input type="text" id="p-date" name="wdate"></div>
									</li>-->
									<li>
										<div class="indi-t">소속</div>
										<div class="indi-c"><input type="text" name="team"></div>
									</li>
									<li>
										<div class="indi-t">직급</div>
										<div class="indi-c"><input type="text" name="class"></div>
									</li>
									<li>
										<div class="indi-t">사원명</div>
										<div class="indi-c"><input type="text" name="name"></div>
									</li>
									<li>
										<div class="indi-t">사원번호</div>
										<div class="indi-c"><input type="text" class="only-num" name="sano" ></div>
									</li>
									<li>
										<div class="indi-t">주민번호 뒤 7자리(이용권번호)</div>
										<div class="indi-c"><input type="text" class="only-num" name="digit7"></div>
									</li>
									<li>
										<div class="indi-t">가중치</div>
										<div class="indi-c"><input type="text" class="only-num" name="weight"></div>
									</li>
									<li class="smallSize">
										<div class="indi-t">연락처</div>
										<div class="indi-c"><input type="text" maxlength="4" class="only-num" name="tel1"></div>
										<span>-</span>
										<div class="indi-c"><input type="text" maxlength="4" class="only-num" name="tel2"></div>
										<span>-</span>
										<div class="indi-c"><input type="text" maxlength="4" class="only-num" name="tel3"></div>
									</li>
									<li class="smallSize">
										<div class="indi-t">휴대폰</div>
										<div class="indi-c"><input type="text" maxlength="4" class="only-num" name="hp1"></div><span>-</span>
										<div class="indi-c"><input type="text" maxlength="4" class="only-num" name="hp2"></div><span>-</span>
										<div class="indi-c"><input type="text" maxlength="4" class="only-num" name="hp3"></div>
									</li>
									<li class="mediumSize">
										<div class="indi-t">이메일</div>
										<div class="indi-c"><input type="text" name="email1"></div><span>@</span>
										<div class="indi-c"><input type="text" name="email2"></div>
									</li>
								</ul>
							</div>
							</form>

							<div class="btn-apply">
								<button type="button" onclick="go_submit();">등록</button>
							</div>
						</div>
						<div class="mo-con">
							<div class="list-wrap">
							<form enctype="multipart/form-data" name="excel" id="excel" action="excel.php" target="_fra_admin" method="post">
							<select name="id2" id="id2">
							<option value="">기업명을 선택하세요.</option>
								<?= getSelectBox($gconnet, 'idx', 'comname', 'tb_company') ?>
							</select>

							<button class="rightS btnAm" type="button" onclick="search2();">검색</button>
							<select class="rightS" name="dupl" id="dupl" style="">
								<option value="">　　　전체　　　</option>
								<option value="Y">　　　중복　　　</option>
								<option value="N">　중복아님　</option>
							</select>
									<div class="btn-up">
										<!--<label for="">파일올리기</label>-->
										<input type="file" id="excelFile" name="excelFile"/>
									</div>
									<div class="btn-down">
										<a href="/upload_file/data/테스트엑셀.xlsx" download>양식 다운로드</a>
									</div>
							<div class="all-c">
								<input type="checkbox"id="hostPall2" data-check-pattern="[name^='hostpeo2']"  name="hostPall2" id="hostPall2">
								<label for="hostPall2">전체선택</label>
							<button class="rightS btnAm"  type="button" onclick="go_tot_del2();">선택 삭제</button>

							</div>
							</form>
							<form enctype="multipart/form-data" name="excel2" id="excel2" action="excel_write.php" target="_fra_admin" method="post">
							<input type="hidden" id="max" name="max" value="0">
							<input type="hidden" id="flag" name="flag" value="N">
							<input type="hidden" id="duplicate" name="duplicate" value="N">

							<div class="cc-con">

								<table id="list2"></table>
								<div id="pager2"></div>


							</div>
							<script>
								$(function(){
									$('#excelFile').hide();
								})
								$("#id2").change(function(){
									if($('#id2').val() != ''){
										$('#excelFile').show();
									}
									if($('#id2').val() == ''){
										$('#excelFile').hide();
									}

								});

								$("#excelFile").click(function(){
									$("#excelFile").val('');

								});

								$("#excelFile").change(function(){
									$("#excel").submit();

								});
                                

							</script>

							<div class="btn-apply">
								<button type="button" onclick="go_submit2();">등록</button>
							</div>


							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	

<div class="limit-modal modal-wrap">
	<div class="modal-con">
		<div class="modal-top">
			<div class="title-modal">
				<span>예외등록</span>
			</div>
			<div class="close-modal">
				<img src="../img/common/close.png" alt="">
			</div>
		</div>
		<div class="modal-bot">
			<div class="tab-btn2">
				<ul> 
					<li class="active"><a href="javascript:;">예외등록</a></li>
					<li><a href="javascript:;">예외해제</a></li>
				</ul>
			</div>
				<div class="tab-wrap">
					<div class="mo-con2">
					<div class="list-wrap">
							<form enctype="multipart/form-data" name="excel3" id="excel3" action="excel2.php" target="_fra_admin" method="post">
							<select name="id3" id="id3">
							<option value="">기업명을 선택하세요.</option>
								<?= getSelectBox($gconnet, 'idx', 'comname', 'tb_company') ?>
							</select>

							<button class="rightS btnAm" type="button" onclick="search3();">검색</button>
							<select class="rightS" name="dupl2" id="dupl2" style="">
								<option value="">　　전체　　</option>
								<option value="Y">　등록가능　</option>
								<option value="N">　등록불가　</option>
							</select>
									<div class="btn-up">
										<!--<label for="">파일올리기</label>-->
										<input type="file" id="excelFile2" name="excelFile2"/>
									</div>
									<div class="btn-down">
										<a href="/upload_file/data/예외등록엑셀.xlsx" download>양식 다운로드</a>
									</div>
							<div class="all-c">
								<input type="checkbox"id="hostPall3" data-check-pattern="[name^='hostpeo3']"  name="hostPall3" id="hostPall3">
								<label for="hostPall3">전체선택</label>
							<button class="rightS btnAm"  type="button" onclick="go_tot_del3();">선택 삭제</button>

							</div>
                            </form>
                            <form enctype="multipart/form-data" name="excel4" id="excel4" action="excel_write2.php" target="_fra_admin" method="post">
                            <input type="hidden" id="max2" name="max2" value="0">
							<input type="hidden" id="flag2" name="flag2" value="N">
							<input type="hidden" id="duplicate2" name="duplicate2" value="N">
							<div class="cc-con">

								<table id="list3"></table>
								<div id="pager3"></div>


							</div>
							<script>
								$(function(){
									$('#excelFile2').hide();
								})
								$("#id3").change(function(){
									if($('#id3').val() != ''){
										$('#excelFile2').show();
									}
									if($('#id3').val() == ''){
										$('#excelFile2').hide();
									}

								});

								$("#excelFile2").click(function(){
									$("#excelFile2").val('');

								});

								$("#excelFile2").change(function(){
									$("#excel3").submit();

								});

							</script>

							<div class="btn-apply">
								<button type="button" onclick="go_submit3();">등록</button>
							</div>


							</div>
						
					</div>
				</div>
			</form>

            <div class="tab-wrap">
					<div class="mo-con2">
					<div class="list-wrap">
							<form enctype="multipart/form-data" name="excel5" id="excel5" action="excel3.php" target="_fra_admin" method="post">
							<select name="id4" id="id4">
							<option value="">기업명을 선택하세요.</option>
								<?= getSelectBox($gconnet, 'idx', 'comname', 'tb_company') ?>
							</select>

							<button class="rightS btnAm" type="button" onclick="search4();">검색</button>
							<select class="rightS" name="dupl3" id="dupl3" style="">
								<option value="">　　전체　　</option>
								<option value="Y">　등록가능　</option>
								<option value="N">　등록불가　</option>
							</select>
									<div class="btn-up">
										<!--<label for="">파일올리기</label>-->
										<input type="file" id="excelFile3" name="excelFile3"/>
									</div>
									<div class="btn-down">
										<a href="/upload_file/data/예외등록엑셀.xlsx" download>양식 다운로드</a>
									</div>
							<div class="all-c">
								<input type="checkbox"id="hostPall4" data-check-pattern="[name^='hostpeo4']"  name="hostPall4" id="hostPall4">
								<label for="hostPall4">전체선택</label>
							<button class="rightS btnAm"  type="button" onclick="go_tot_del4();">선택 삭제</button>

							</div>
                            </form>
                            <form enctype="multipart/form-data" name="excel6" id="excel6" action="excel_write3.php" target="_fra_admin" method="post">
                            <input type="hidden" id="max3" name="max3" value="0">
							<input type="hidden" id="flag3" name="flag3" value="N">
							<input type="hidden" id="duplicate3" name="duplicate3" value="N">
							<div class="cc-con">

								<table id="list4"></table>
								<div id="pager4"></div>


							</div>
							<script>
								$(function(){
									$('#excelFile3').hide();
								})
								$("#id4").change(function(){
									if($('#id4').val() != ''){
										$('#excelFile3').show();
									}
									if($('#id4').val() == ''){
										$('#excelFile3').hide();
									}

								});

								$("#excelFile3").click(function(){
									$("#excelFile3").val('');

								});

								$("#excelFile3").change(function(){
									$("#excel5").submit();

								});

							</script>

							<div class="btn-apply">
								<button type="button" onclick="go_submit4();">등록</button>
							</div>


							</div>
						
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

	
	<script type="text/javascript">
		$(document).ready(function () {
			
			$('#p-date').Zebra_DatePicker({ });

			$('select').wSelect();
		});

        function go_submit() {
            var check = chkFrm('frm');
            if(check) {
                //oEditors.getById["editor"].exec("UPDATE_CONTENTS_FIELD", []);
                frm.submit();
            } else {
                false;
            }
        }
		function go_submit2() {
            var check = chkFrm('excel2');
            if(check) {
                //oEditors.getById["editor"].exec("UPDATE_CONTENTS_FIELD", []);
                excel2.submit();
            } else {
                false;
            }
        }
        function go_submit3() {
            var check = chkFrm('excel4');
            if(check) {
                //oEditors.getById["editor"].exec("UPDATE_CONTENTS_FIELD", []);
                excel4.submit();
            } else {
                false;
            }
        }
        function go_submit4() {
            var check = chkFrm('excel6');
            if(check) {
                //oEditors.getById["editor"].exec("UPDATE_CONTENTS_FIELD", []);
                excel6.submit();
            } else {
                false;
            }
        }
	</script>
	
</body>
<?php
$show_iframe =true;
?>
<iframe name="_fra_admin" width="0" height="0" style="display:<?=$show_iframe==TRUE?"":"none"?>"></iframe>
</php>