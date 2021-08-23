<? include("../inc/header.php"); ?>
<link rel="stylesheet" href="/manage/css/reserve.css">
<?

    $ridx   = trim(sqlfilter($_REQUEST['ridx']));

	$sql = " SELECT e.comname, b.comname as hname, b.post, b.addr1, b.addr2, b.tel, b.homepage, c.con5, ";
    $sql .= "   a.cidx, a.midx, a.seq, a.ridx, a.chasu,  a.cymd, a.useday, c.flag, c.type, ";
	$sql .= "   d.rArea, d.rType, d.rAvg, d.rMax, d.rInfra, a.pcnt1, a.pcnt2, (c.per_amount * a.useday)as per_amount,  ";
    $sql .= "   a.name, a.sano, a.digit7, a.tel, a.hp, a.email, a.regflag, a.regflag_two   ";
    $sql .= " FROM tb_reInfo a, tb_hu b, tb_comhuM c, tb_huType d, tb_company e ";
	$sql .= " WHERE a.hidx = b.idx   AND a.midx = c.midx  AND b.idx = d.idx ";
    $sql .= " AND a.seq = d.seq   AND a.cidx = e.idx  AND a.ridx = '{$ridx}'  ";    

    $rs = mysqli_query($gconnet, $sql);
    $row = mysqli_fetch_array($rs); 

    $midx   = $row['midx'];
    $seq    = $row['seq'];
    $cidx   = $row['cidx'];
    $sano   = $row['sano'];

    
    
?>
<script>
 
 $(document).ready(function () {
     getList4();
 });


 function snsPopup(){

        $(".noti-modal").addClass("visible");

        var dataArr = {  midx: '<?=$midx?>', seq: '<?=$seq?>', ridxArr: '<?=$ridx?>'  };

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

function getList4(){
    var dataArr = {  midx: '<?=$midx?>', seq: '<?=$seq?>', ridxArr: '<?=$ridx?>'  };

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
<body>
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
				<div class="big-arrow"><img src="/manage/img/common/big-arrow.png" alt=""></div>
				<div>상세</div>
			</div>
			<div class="cc-con">
				<form action="#">
					<div class="view view-1 on">
						<div class="view-t active">등록 휴양소 상세</div>
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
									<td><?=$row['homepage']?></td>
								</tr>
								<tr>
									<th>이용혜택</th>
									<td><?=$row['con5']?></td>
								</tr>
							</table>
						</div>
					</div>
                    <?php
                        $sql2 = "select team from tb_employee where cdx = '".$row['cidx']."' and sano = '".$row['sano']."'";
                        $rs2 = mysqli_query($gconnet, $sql2);
                        $row2 = mysqli_fetch_array($rs2); 
                    ?>
					<div class="view view-2">
						<div class="view-t">예약자 내역</div>
						<div class="view-c">
							<table class="reserve1">
								<tr>
									<th>평형(객실타입)</th>
									<td><?=$row['rArea']?> / <?=$row['rType']?> / 기준:<?=$row['rAvg']?>명 / 최대:<?=$row['rMax']?>명</td>
								</tr>
								<tr>
									<th>이용 인원</th>
									<td>성인 <?=$row['pcnt1']?>명 <?=($row['pcnt2']>0)?"아동 ".$row['pcnt2']." 명":""?>
                                    </td>
								</tr>
								<tr>
									<th>예약자명</th>
									<td><a href="javascript:employeeLogin('<?=$cidx?>', '<?=$sano?>');"><?=$row['name']?></a> / <?=$row2['team']?></td>
								</tr>
								<tr>
									<th>사원번호</th>
									<td><?=$row['sano']?></td>
								</tr>
								<tr>
									<th>예약번호</th>
									<td><?=$row['digit7']?></td>
								</tr>
								<tr>
									<th>이용 기간</th>
									<td><?=$usedayArray[$row['useday']]."(".get_days($row['cymd'], $row['useday']).")"?></td>
								</tr>
								<tr>
									<th>부담금</th>
									<td>개인 <?=number_format($row['per_amount'])?>원</td>
								</tr>
								<tr>
									<th>결과</th>
									<td>
                                    <?
                                        if($row['regflag_two'] == "6"){
                                            echo "선착순 당첨";
                                        }else{

                                            if($row['regflag_two'] == "2"){
                                                echo $cancelFlagArray[$row['regflag_two']];
                                            }else{
                                                echo $regFlagArray[$row['regflag']];
                                            }
                                        }
                                    ?>
                                    </td>
								</tr>
								<tr>
									<th>전화</th>
									<td><?=$row['tel']?></td>
								</tr>
								<tr>
									<th>핸드폰</th>
									<td><?=$row['hp']?></td>
								</tr>
								<tr>
									<th>이메일</th>
									<td><?=$row['email']?></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="reser-btn">
						<div class="btn-wrap">
							<button type="button" onclick="history.back(-1); return false;">목록</button>
                            <button type="button" onclick="snsPopup()">SNS</button>
							<button type="button" onclick="window.print();">프린트</button>
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
	
	
	
</body>
</html>