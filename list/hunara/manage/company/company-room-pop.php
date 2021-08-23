<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
    $midx = trim(sqlfilter($_REQUEST['midx']));
    $cidx = trim(sqlfilter($_REQUEST['cidx']));
    $hidx = trim(sqlfilter($_REQUEST['hidx']));
    $seq = trim(sqlfilter($_REQUEST['seq']));
    $useday = trim(sqlfilter($_REQUEST['useday']));

    $sql = " SELECT udate1, a.udate2   ";
    $sql .= " FROM tb_comhuM a ";
    $sql .= " WHERE a.midx = '{$midx}' ";
    
    $rs = mysqli_query($gconnet, $sql);
    $row = mysqli_fetch_array($rs);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="/manage/css/sub.css">
	<link rel="stylesheet" href="/manage/css/common.css">
	<link rel="stylesheet" href="/manage/css/zebra_datepicker.css">
	<link rel="stylesheet" href="/manage/css/wSelect.css">
	<link rel="stylesheet" href="/manage/css/calendar.css">
	<meta charset="UTF-8">
	<title>휴나라 관리자모드</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="/manage/js/zebra_datepicker.src.js"></script>
	<script src="/manage/js/wSelect.js"></script>
	<script src="/manage/js/checkbox.js"></script>
	<script src="/manage/js/tab.js"></script>
	<script src="/manage/js/modal.js"></script>
	<script src='/manage/js/calendar.js'></script>
    <script src='/manage/js/validator.js'></script>
</head>

<script>
var changeFlag = false;
document.addEventListener('DOMContentLoaded', function() {

    getCalendar();

    // 이전 버튼을 클릭하였을 경우
    jQuery("button.fc-prev-button").click(function() {
            changeCalendar();
    });

    // 다음 버튼을 클릭하였을 경우
    jQuery("button.fc-next-button").click(function() {
            changeCalendar();
    }); 
    
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
                url: '/manage/company/company-room-calendar.php',
                type: "GET",
                async:false,
                datatype: 'json',
                data: {startDate:stDate, endDate:edDate, midx:'<?=$midx?>', seq:'<?=$seq?>', useday:'<?=$useday?>'},
                success: function(data){
                    var json = JSON.parse(data);
                    var events = [];

                    $.each(json, function(i, obj) {
                        if(obj.cnt == ''){
                            obj.cnt = 0;
                        }
                        if(obj.sum_cnt == ''){
                            obj.sum_cnt = 0;
                        }
                        
                        var titleTxt = '<div class="room-line room-line1"><span class="count-room">객실 수:</span>';
                        titleTxt = titleTxt + '<input maxlength="2" type="text" name="rc_cnt" id="val_'+obj.date+'" data-rcdate="'+obj.date+'" value="'+obj.cnt+'" onClick="this.focus();" onblur="calRoomCnt(this.value, \''+obj.date+'\');" /></div>';
                        titleTxt = titleTxt + '<div class="room-line room-line2"><span class="count-room" id="txt_'+obj.date+'" data-sumval="'+obj.sum_cnt+'" >총: '+obj.sum_cnt+'개</span></div>';
                        
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

function save(){
    var dataList = [];

    $('input[type=text]').each(function(){
        var rcdate = $(this).data("rcdate");
        var cntVal = $(this).val();

        var data = rcdate+":"+cntVal+":"+$("#txt_"+rcdate).data("sumval");
        dataList.push(data);

    });

    console.log(dataList);

    if(confirm('등록 하시겠습니까')){
            var dataArr = {
                    mode : 'CALENDAR'
                ,   midx : '<?=$midx?>'        
                ,   cidx : '<?=$cidx?>'    
                ,   hidx : '<?=$hidx?>'
                ,   seq : '<?=$seq?>'   
                ,   useday : '<?=$useday?>'                 
                ,   cntList : dataList.join(",")
            };

            $.ajax({
                url		: "/manage/company/company-room-proc.php",
                type	: "POST",
                data	: dataArr,
                async	: false,
                dataType	: "json",
                success		: function(data){
                    if ( data.success == "true" ){
                        alert(data.msg);
                        changeFlag = false;

                    } else if ( data.success == "false" ){
                        alert(data.msg);
                        
                    } else {
                        alert( "시스템 오류 발생 하였습니다." );
                    }
                }
            }); 
    }    
}

function cancel(){
    window.close();
}

function calRoomCnt(val, rcDate){
    changeFlag = true;

    var cnt = Number(val);
    var useday = Number('<?=$useday?>');

    var preCnt = sumRoomCnt(rcDate);
    $('#txt_'+rcDate).html('총 '+(cnt+preCnt)+'개');
    $('#txt_'+rcDate).data("sumval", (cnt+preCnt) );

    var nextDate = new Date(formatDate(rcDate,'-'));
    var nextCnt = 0;
    var nextDateTxt;
    for(var i=1;i<useday; i++){
        nextDate.setDate(nextDate.getDate() + 1);
        nextDateTxt = nextDate.toY4MDString('');

        var sumCnt = sumRoomCnt(nextDateTxt);

        $('#txt_'+nextDateTxt).html('총 '+(sumCnt+Number($('#val_'+nextDateTxt).val()))+'개');
        $('#txt_'+nextDateTxt).data("sumval", (sumCnt+Number($('#val_'+nextDateTxt).val())) );
    }
}

function sumRoomCnt(rcDate){

    var useday = Number('<?=$useday?>');
    var preDate = new Date(formatDate(rcDate,'-'));

    var preCnt = 0;
    var preDateTxt;
    for(var i=(useday-1); i>0; i--){
        preDate.setDate(preDate.getDate() - 1);
        preDateTxt = preDate.toY4MDString('');

        if($('#val_'+preDateTxt).val() != undefined){
            preCnt = preCnt+ Number($('#val_'+preDateTxt).val());
        }

    }

    return preCnt;    
}


</script>
	
	<body>
	<div class="calendar-modal modal-wrap">
		<div class="modal-con">
			<div class="modal-top">
				<div class="title-modal">
					<span>일별 객실 세팅</span>
				</div>
			</div>
			<form action="#">
				<div class="calendar-con">
					<div class="info-pop">
						<span>사용기간</span>
						<span><?=to_date($row['udate1'])?></span>~
						<span><?=to_date($row['udate2'])?></span>
					</div>
					<div class="pop-warn">
						※숙박 시작 날짜로 입력 시 자동 계산
					</div>
					<div class="cal-cate">
						<span>[<?=$usedayArray[$useday]?>]</span>
					</div>
					<div id="calendar"></div>
					<div class="cal-btn">
						<button type="button" onClick="save();">등록</button>
						<button type="button" onClick="cancel();">취소</button>
					</div>
				</div>
			</form>
		</div>
	</div>

</body>
</html>