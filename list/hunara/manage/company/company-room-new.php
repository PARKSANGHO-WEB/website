<? include("../inc/header.php"); ?>
<?php
$sql2 = 'SELECT comname ';
$sql2 .= " FROM tb_hu ";
$rs2 = mysqli_query($gconnet, $sql2);
$comname = '';

for($i=0; $i< mysqli_num_rows($rs2); $i++ ){
    $row2 = mysqli_fetch_array($rs2);
    $comname .= "\"".$row2[comname]."\",";

}
$comname = substr($comname, 0, -1);

?>
<!--팝업 오픈-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script language="javascript">

  	function roomPopup() { 
            console.log("##roomPopup");
			window.open("company-room-pop.html", "a", "width=900, height=800, left=100, top=50"); 
	}

    function searchCompay(){

        $("#com-modal").load("/manage/popup/search-company.php");

        $("#com-modal").addClass("visible");
        

    }

    function searchResort(){

        $("#room-modal").load("/manage/popup/search-resort.php");

        $("#room-modal").addClass("visible");
        

    }

    //휴양소 기본정보 세팅
    function setResortInfo(){
        var hidx = $("#searchInput").val();
        var con5 = "";
        console.log(hidx);
        $.ajax({
            url		: "/manage/company/resort-data.php?hidx="+hidx,
            type	: "GET",
            data	: {'hidx' : hidx},
            async	: false,
            dataType	: "json",
            success		: function(data){
                console.log(data);
                
                $("#addr").html(data.addr);
                $("#tel").html(data.tel);
                $("#homepage").html(data.homepage);
				$("#hidx").val(data.hidx);

                console.log(data.con5);
                
                if(data.con5 != null ){
                    con5 = data.con5;
                }

                oEditors.getById["con5"].exec("PASTE_HTML", [con5]);

                setRoomInfo(data.roomList);

            }
        });         
    }

    function setRoomInfo(data){

        $("#roomInfo").html("");
        for(var i=0; i<data.length; i++){
            var txt = '<div class="option option1"><div class="opc-wrap"><input type="checkbox" name="room_seq" class="opt-check" id="room_seq" value="'+data[i].seq+'"></div>';
            txt = txt +'<div class="option-sel"><div class="opt-summary"><span>평형&nbsp;:&nbsp;'+data[i].rArea+'</span><span> 타입&nbsp;:&nbsp;'+data[i].rType+'</span>';
            txt = txt +'<span> 객실수&nbsp;:&nbsp;'+data[i].rCnt+'</span><span> 기준&nbsp;:&nbsp;'+data[i].rAvg+'</span><span> 최대&nbsp;:&nbsp;'+data[i].rMax+'</span><span> 시설&nbsp;:&nbsp;'+data[i].rInfra+'</span></div>';

            txt = txt +'<div class="opt-list"><div class="list-1">';
            txt = txt +'<div class="opt-wrap"><input class="option-c" type="checkbox" id="useday1" value="'+data[i].seq+':1" ><label for="useday1">1박 2일</label></div>';
            txt = txt +'<div class="opt-wrap"><input class="option-c" type="checkbox" id="useday2" value="'+data[i].seq+':2" ><label for="useday2">2박 3일</label></div>';
            txt = txt +'<div class="opt-wrap"><input class="option-c" type="checkbox" id="useday3" value="'+data[i].seq+':3" ><label for="useday3">3박 4일</label></div>';
            txt = txt +'<div class="opt-wrap"><input class="option-c" type="checkbox" id="useday4" value="'+data[i].seq+':4" ><label for="useday4">4박 5일</label></div>';
            txt = txt +'</div></div>';
            
            txt = txt +'</div></div>';
            
            $("#roomInfo").append(txt);
        }
        $("#searchInput").attr('readonly',true);

    }

    function calAmount(){
        var per = $("#per_amount").val();
        var com = $("#com_amount").val();

        if(per == "") per = 0;
        if(com == "") com = 0;

        $("#sum_amount").val(Number(per)+Number(com));
    }

    function save(){

        if(validate(document.frm)  ){

            var room_seq = [];
            var room_use = [];

            $('#room_seq:checked').each(function(){
                room_seq.push($(this).val());
            });

            $('.option-c:checked').each(function(){
                room_use.push($(this).val());
            });

            oEditors.getById["con5"].exec("UPDATE_CONTENTS_FIELD", []);

            var dataArr = {
                    mode : 'SAVE'
                ,   hidx : $('#hidx').val()
				//,   hidx : $("#searchInput").val()
                ,   cidx : $('#cidx').val()
                ,   flag : $('input[name="flag"]:checked').val()
                ,   udate1 : $('#udate1').val()
                ,   udate2 : $('#udate2').val()
                ,   con5 : $('#con5').val()
                ,   type : $('input[name="type"]:checked').val()
                ,   weight : $('input[name="weight"]:checked').val()
                ,   com_amount : $('#com_amount').val()
                ,   per_amount : $('#per_amount').val()
                ,   pg_yn : $('input[name="pg_yn"]:checked').val()
                ,   roomArr : room_seq.join(",")
                ,   usedayArr : room_use.join(",")
            };

            console.log(dataArr);

            if(dataArr.roomArr == ""){
                alert('객실 선택을 선택 하십시오.');
                return false;
            }

            if(dataArr.usedayArr == ""){
                alert('박수 선택을 선택 하십시오.');
                return false;
            }

            var useSeq;
            $('#room_seq:checked').each(function(){
                var roomSeq = $(this).val();

                useSeq = false;
                $('input[class="option-c"][value ^= "'+roomSeq+':"]').each(function(){
                    if($(this).is(':checked')) {
                        useSeq = true;
                    }
                });   

                if( useSeq == false){
                    alert('박수 선택을 선택 하십시오.');
                    return false;                        
                }

            });


            if(dataArr.pg_yn == undefined){
                alert('결제 사용을 선택 하십시오.');
                return false;
            }

            if(dataArr.type == undefined){
                alert('배정 방식을 선택 하십시오.');
                return false;
            }

            if(dataArr.flag == undefined){
                alert('구분을 선택 하십시오.');
                return false;
            }

            var stDate = $('#udate1').val();
            var edDate = $('#udate2').val();

            if(stDate > edDate){
                alert('이용기간 시작일은 종료일 이전으로 선택 하십시오.');
                return;
            }

            
            if(useSeq && confirm('등록 하시겠습니까')){
                $.ajax({
                    url		: "company-room-proc.php",
                    type	: "POST",
                    data	: dataArr,
                    async	: false,
                    dataType	: "json",
                    success		: function(data){
                        if ( data.success == "true" ){
                            alert(data.msg);
                            document.location.href= "/manage/company/company-room-view.php?midx="+data.idx;

                        } else if ( data.success == "false" ){
                            alert(data.msg);
                            //document.write (data.msg);
                        } else {
                            alert( "시스템 오류 발생 하였습니다." );
                        }
                    }
                });
            }

        } 

    }

    function cancel(){
        document.location.reload();
    }


    $(function() {    //화면 다 뜨면 시작
        var searchSource = [<?=$comname?> ]; // 배열 형태로 
        $("#searchInput").autocomplete({  //오토 컴플릿트 시작
            source : searchSource,    // source 는 자동 완성 대상
            select : function(event, ui) {    //아이템 선택시
                console.log(ui.item);
            },
            focus : function(event, ui) {    //포커스 가면
                return false;//한글 에러 잡기용도로 사용됨
            },
            minLength: 1,// 최소 글자수
            autoFocus: true, //첫번째 항목 자동 포커스 기본값 false
            classes: {    //잘 모르겠음
                "ui-autocomplete": "highlight"
            },
            delay: 10,    //검색창에 글자 써지고 나서 autocomplete 창 뜰 때 까지 딜레이 시간(ms)
//            disabled: true, //자동완성 기능 끄기
            position: { my : "right top", at: "right bottom" },    //잘 모르겠음
            close : function(event){    //자동완성창 닫아질때 호출
                console.log(event);
            }
        });
        
    });
 </script>
<body class="room-body">
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
    <div class="contents cRoom-view">
    <? 
        $MENU_DEPTH1 = "2";
        $MENU_DEPTH2 = "1";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/company/left.php"; 
    ?>    
		<div class="center-con">
			<div class="cc-title">
				<div>신규 휴양소 추가</div>
			</div>
			<div class="cc-con">
				<form name="frm" action="#">
                    
					<div class="pview-c">
						<table>
							<tr>
								<th>
									<span>기업명</span>
								</th>
								<td>
                                    <input type="hidden" name="cidx"  id="cidx" value="" HNAME="기업명" REQUIRED>
									<span id="cName"></span><button class="com-mo" type="button" onClick="searchCompay();" >검색</button>
								</td>
							</tr>
							<tr>
								<th>
									<span>휴양소명</span>
								</th>
								<td>
                                    <input id="searchInput">
                                    <!--<input type="hidden" name="hidx"  id="hidx" value="" onChange="setResortInfo();" HNAME="휴양소명" REQUIRED>-->
									<input type="hidden" name="hidx" id="hidx" value="">
                                    <span id="hName"></span><button class="room-mo" type="button" onClick="setResortInfo();">검색</button>
									<!--<span id="hName"></span><button class="room-mo" type="button" onClick="searchResort();">검색</button>-->
								</td>
							</tr>
							<tr>
								<th>
									<span>주소</span>
								</th>
								<td>
									<span id="addr"></span>
								</td>
							</tr>
							<tr>
								<th>
									<span>연락처</span>
								</th>
								<td>
									<span id="tel"></span>
								</td>
							</tr>
							<tr>
								<th>
									<span>홈페이지</span>
								</th>
								<td>
									<span id="homepage"></span>
								</td>
							</tr>
							<tr>
								<th>
									<span>이용혜택</span>
								</th>
								<td>
                                    <textarea class="autosize" name="con5" id="con5" style="height: 60px;"></textarea>
								</td>
							  <script>
							  </script>
							</tr>
							<tr>
								<th>
									<span>객실 선택</span>
								</th>
								<td id="roomInfo">

								</td>
							</tr>
							<tr>
								<th><span>부담</span></th>
								<td class="price-go">
                                <input type="hidden" class="only-num" id="com_amount" onChange="calAmount();">
									<!--<span>
										기업&nbsp;&nbsp;
										<input type="text" class="only-num" id="com_amount" onChange="calAmount();">&nbsp;원
									</span>
									,&nbsp;&nbsp;&nbsp;-->
									<span>&nbsp;개인&nbsp;
										<input type="text" class="only-num" id="per_amount" onChange="calAmount();">&nbsp;원
									</span>
									&nbsp;&nbsp;&nbsp;
									<span>&nbsp;&nbsp;총&nbsp;
										<input type="text" id="sum_amount" readOnly >&nbsp;원
									</span>
								</td>
							</tr>
							<tr>
								<th><span>결제사용</span></th>
								<td>
									<div class="module-okay">
										<input type="radio" name="pg_yn" id="pg_yn1" value="Y" >
										<label for="pg_yn1">사용</label>
									</div>
									<div class="module-none">
										<input type="radio" name="pg_yn" id="pg_yn2" value="N" >
										<label for="pg_yn2">미사용</label>
									</div>
								</td>
							</tr>
							<tr>
								<th><span>배정 방식</span></th>
								<td>
									<div class="raffle-okay">
										<input type="radio" value="F" name="type" class="r-okay" id="type1" >
										<label for="type1">선착순</label>
									</div>
									<div class="raffle-none">
										<input type="radio" value="S" name="type" class="r-none" id="type2">
										<label for="type2">추첨</label>
										<span class="between">[</span>
										<span>가중치&nbsp;:&nbsp;</span>
											<input type="radio" name="weight" id="weight1" value="H">
										 <label for="weight1">
											<span>높은값 우선</span>
										 </label>
											<input type="radio" name="weight" id="weight2" value="L">
										 <label for="weight2">
											<span>낮은값 우선</span>
										 </label>
										<span class="between">]</span>
									</div>
								</td>
							</tr>
							<script>
							</script>
							<tr>
								<th><span>구분</span></th>
								<td>
									<div class="period">
										<input type="radio" name="flag" id="flag1" value="동계">
										<label for="flag1">동계</label>
									</div>
									<div class="period">
										<input type="radio" name="flag" id="flag2" value="하계">
										<label for="flag2">하계</label>
									</div>
									<div class="period">
										<input type="radio" name="flag" id="flag3" value="상시">
										<label for="flag3">상시</label>
									</div>
								</td>
							</tr>
							<tr>
								<th><span>이용기간(화면 노출기간)</span></th>
								<td>
									<div class="room-day">
										<input type="text" id="udate1" data-js-start-date HNAME="이용기간 시작일" REQUIRED><span>~</span>
										<input type="text" id="udate2" data-js-end-date HNAME="이용기간 종료일" REQUIRED>
									</div>
								</td>
							</tr>
						</table>
						<div class="center-btn">
							<div class="btn-wrap">
								<button type="button" onClick="save();">등록</button>
								<button type="button" onClick="cancel();" >취소</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

    <!-- 기업검색 창 -->
    <div class="com-modal modal-wrap" id="com-modal">
    </div>

    <!-- 휴양소 검색 창 -->
	<!--<div class="room-modal modal-wrap" id="room-modal">
	</div>-->

    <script type="text/javascript" src="/smarteditor2/js/HuskyEZCreator.js" charset="utf-8"></script>
    <script language="javascript">
        
        $(document).ready(function () {
            $('select').wSelect();
        });

        var oEditors = [];
        nhn.husky.EZCreator.createInIFrame({
            oAppRef: oEditors,
            elPlaceHolder: "con5",
            sSkinURI: "/smarteditor2/SmartEditor2Skin.html",	
            htParams : {bUseToolbar : true,
                fOnBeforeUnload : function(){
                }
            }, //boolean
            fOnAppLoad : function(){
                //예제 코드
                //.getById["ir1"].exoEditorsec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
            },
            fCreator: "createSEditor2"
        });   
    </script> 

</body>
</html>