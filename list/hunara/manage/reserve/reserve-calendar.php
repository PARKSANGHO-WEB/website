<? include("../inc/header.php"); ?>
<link rel="stylesheet" href="/manage/css/reserve.css">
<link rel="stylesheet" href="/manage/css/calendar.css">
<script src="/manage/js/calendar.js"></script>
<script>

$(document).ready(function() {
    getCalendar();
	
});

function getCalendar(){    

    var calendarEl = document.getElementById('calendar');
    var initialLocaleCode = 'en';

    var calendar = new FullCalendar.Calendar(calendarEl, {
      editable: false,
      lang: 'ko',
        events: function (info, successCallback, failureCallback) {
            var stDate = getFormatDate(info.start); //캘린더 시작일
            var edDate = getFormatDate(info.end);  //캘린더 시작일
            $.ajax({
                url: '/manage/reserve/reserve-calendar-data.php',
                type: "POST",
                async:false,
                datatype: 'json',
                data: {startDate:stDate, endDate:edDate},
                success: function(data){
                    
                    var json = JSON.parse(data);
                    var events = [];

                    $.each(json, function(i, obj) {
                        var titleTxt = '<div class="cal-modal" onClick="popList(\''+obj.date+'\');" ><span>'+obj.name;

                        if(obj.cnt > 1) titleTxt += ' 외'+obj.cnt+'명';

                        titleTxt += '</span></div>';

                        events.push({id: i+1, title: titleTxt, start: obj.date, allDay: true});
                    });

                    successCallback(events);
                },
            });
        },
		locale: 'ko',
        fixedWeekCount: false
    });

    calendar.render();

    // 이전 버튼을 클릭하였을 경우
    jQuery("button.fc-prev-button").click(function() {
        changeCalendar();
    });

    // 다음 버튼을 클릭하였을 경우
    jQuery("button.fc-next-button").click(function() {
        changeCalendar();
    }); 
    
    changeCalendar();    

}

function changeCalendar(){
    // calendar에  title 추가시 html 으로 적용되도록 처리
	$('.fc-event-title').each(function(){
		var txt = $(this).text();
        $(this).parent().parent().parent().html(txt);
	});
}

function getFormatDate(date){
    var year = date.getFullYear();              
    var month = (1 + date.getMonth());          
    month = month >= 10 ? month : '0' + month;  
    var day = date.getDate();                   
    day = day >= 10 ? day : '0' + day;          
    return  year + '' + month + '' + day;       
}  

function popList(cymd){

    var cymds = cymd.split('-');

    var txt_cymd = Number(cymds[1]) +'월 '+ Number(cymds[2]) + '일 예약자 내역 ';
    $("#txt_cymd").html(txt_cymd);
    $("#txt_cymd").data("cymd", cymds[1] +'. '+ cymds[2] );

    //그리드 클리어
	$("#list").jqGrid("clearGridData", true);

    //데이터 호출
    $("#list").jqGrid('setGridParam', {
        url : "/manage/reserve/reserve-calendar-pop-data.php?cymd="+cymd,
        datatype : 'json', 
        mtype : 'post', 
        success : function(data) {console(data);}
    }).trigger('reloadGrid');     


    $("#list").jqGrid({
		url: "/manage/reserve/reserve-calendar-pop-data.php?cymd="+cymd,
		datatype: "json",
		mtype: "GET",
        colModel: [
			{ name: "idx", label:"선택", sortable:false, align:"center", formatter:checkBox, width:30} ,
            { name: "chasu", label:"지망", sortable:true, align:"center",  width:65},
			{ name: "wdate", label:"등록일", sortable:true, align:"center", width: 80},
			{ name: "useday", label:"박수", sortable:true, align:"center", width: 60},
            { name: "cymd", label:"예약일", sortable:true, align:"center", formatter:fmtCymd, width: 120 },
            { name: "cname", label:"기업명", sortable:true, align:"center", width: 100},
            { name: "hname", label:"휴양소명", sortable:true, align:"center", width: 120},
            { name: "name", label:"예약자", sortable:true, align:"center", width: 80},
			{ name: "sano", label:"사원번호", sortable:true, align:"center", width: 95},
            { name: "hp", label:"연락처", sortable:true, align:"center", sorttype:'number', width: 95},
            { name: "regflag", label:"결과", sortable:true, align:"center", formatter:regflag, width: 50}
		],
		pager: "#pager",
		rowNum: 5,
		sortname: "wdate",
		sortorder: "desc",
		height: 'auto',
		viewrecords: true,
		gridview: true,
        loadonce : true,
        autowidth : true,
		caption: ""
	});        

    $(".recal-modal").addClass("visible");
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

function fmtCymd(cellvalue, options, rowObject){

        var cymd = $("#txt_cymd").data("cymd").trim();

        var val = cellvalue.split("/");
        
        for(var i=0; i<val.length; i++){

            if(val[i].trim() == cymd){
                val[i] = "<font color='red'>"+val[i]+"</font>";
            }
        }

        return val.join("/");
}

function selRowProc(){

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

        if(confirm("탈락 하시겠습니까?" )){        

            $.ajax({
                url		: "/manage/reserve/reserve-selected-proc.php",
                type	: "POST",
                data : {"mode": "DROPOUT",  "ridx":dataList.join(",")},
                datatype: 'json',
                success		: function(json){

                    var data = JSON.parse(json);

                    if ( data.success == "true" ){
                        alert(data.msg);
                        closePop();
                        getCalendar();

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

function closePop(){
    $(".recal-modal").removeClass("visible");
}
</script>
<body>
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
    <div class="contents reserve-list">
    <? 
        $MENU_DEPTH1 = "1";
        $MENU_DEPTH2 = "3";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/reserve/left.php"; 
    ?>
		<div class="center-con">
			<div class="cc-title">
				<div>예약 내역 관리</div>
			</div>
			<div class="cc-con">
				
				<form action="#">
					<div class="view-c">
						<div id="calendar"></div>
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
	
	
	<div class="recal-modal modal-wrap">
		<div class="modal-con">
			<div class="modal-top">
				<div class="title-modal">
					<span id="txt_cymd" data-cymd=""></span>
				</div>
				<div class="close-modal">
					<img src="../img/common/close.png" alt="">
				</div>
			</div>
			<div class="modal-bot">
				<form action="#">
					<button type="button" class="false" onClick="selRowProc();" >선택 탈락</button>
					<div class="mo-con">
						<div class="indi-wrap">

                            <table id="list"></table>
                            <div id="pager"></div>

						</div>
						<div class="btn-apply">
							<button type="button" onClick="closePop();">닫기</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	
</body>
</html>