<? include("../inc/header.php"); ?>
<?
    $midx   = trim(sqlfilter($_REQUEST['midx']));
    $seq    = trim(sqlfilter($_REQUEST['seq']));

	$sql = " SELECT b.comname, c.comname as hname, c.post, c.addr1, c.addr2, c.tel, c.homepage, a.con5, ";
    $sql .= "   d.rArea, d.rType, d.rCnt, d.rAvg, d.rMax, d.rInfra, a.com_amount, a.per_amount, ";
	$sql .= "   a.flag, a.type, a.udate1, a.udate2, e.seq  ";
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
 
 });

 function getList(){

    var dataArr = {  midx: '<?=$midx?>', seq: '<?=$seq?>'  };

    $("#list").jqGrid({
        url: "/manage/company/company-room-go-view-data.php",
        datatype: "json",
        mtype: "post",
        postData : dataArr,
        colNames: [ "번호", "지망", "신청일","예약일", "예약자", "사원번호" , "연락처", "결과일", "1차", "2차", "3차", "4차","최종결과"],
        colModel: [
            { name: "no", label:"번호", sortable:true, align:"center", sorttype:'integer',  width:40},
            { name: "chasu", label:"지망", sortable:true, align:"center",  width:50},
            { name: "wdate", label:"신청일", sortable:true, align:"center", width: 90},
            { name: "useday", label:"예약일", sortable:true, align:"center", width: 156},
            { name: "name", label:"예약자", sortable:true, align:"center", width: 60},
            { name: "sano", label:"사원번호", sortable:true, align:"center", width: 100},
            { name: "hp", label:"연락처", sortable:true, align:"center", width: 100},
            { name: "udate", label:"결과일", sortable:true, align:"center", width: 91},
            { name: "chDate1", label:"1차", sortable:true, align:"center", width: 82},
            { name: "chDate2", label:"2차", sortable:true, align:"center", width: 82},
            { name: "chDate3", label:"3차", sortable:true, align:"center", width: 82},
            { name: "chDate4", label:"4차", sortable:true, align:"center", width: 82},
            { name: "regflag", label:"최종결과", sortable:true, align:"center", width: 61}
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

    $("#list").jqGrid('setGroupHeaders', {
        useColSpanStyle: true, 
        groupHeaders:[
            {startColumnName: 'chDate1', numberOfColumns: 4, titleText: '<span style="color:#ffffff; font-size:13px;">추첨 단계</span>'},
        ]
    });  
}

function search(){

var f = document.frm;

var dataArr = {
        midx : '<?=$midx?>'
    ,   seq : '<?=$seq?>'
    ,   regflag : $('#regflag').val()
    ,   name : $('#name').val()
}


//그리드 클리어
$("#list").jqGrid("clearGridData", true);

//데이터 호출
$("#list").jqGrid('setGridParam', {
    url : "/manage/company/company-room-go-view-data.php", 
    datatype : 'json', 
    mtype : 'post', 
    postData : dataArr,
    success : function(data) {console(data);}//조건 폼값 전송
}).trigger('reloadGrid'); //호출 완료 후 리로드    

}

 </script>
<body>
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
	<div class="contents company-rmview">
    <? 
        $MENU_DEPTH1 = "2";
        $MENU_DEPTH2 = "3";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/company/left.php"; 
    ?>    
		<div class="center-con">
			<div class="cc-title">
				<div>휴양소 추첨 관리</div>
				<div class="big-arrow"><img src="../img/common/big-arrow.png" alt=""></div>
				<div><?=$row['comname']."(".$row['hname'].")"?></div>
			</div>
			<div class="cc-con">
				<form action="#">
					<div class="view view-1 on">
						<div class="view-t active">등록 휴양소 상세</div>
						<div class="view-c">
							<table id="infoTable">
								<tr>
									<th>
										<span>기업명</span>
									</th>
									<td>
										<span><?=$row['comname']?></span>
									</td>
								</tr>
								<tr>
									<th>
										<span>휴양소명</span>
									</th>
									<td>
										<span><?=$row['hname']?></span>
									</td>
								</tr>
								<tr>
									<th>
										<span>주소</span>
									</th>
									<td>
										<span>(<?=$row['post']?>) <?=$row['addr1']." ".$row['addr2']?></span>
									</td>
								</tr>
								<tr>
									<th>
										<span>연락처</span>
									</th>
									<td>
										<span><?=$row['tel']?></span>
									</td>
								</tr>
								<tr>
									<th>
										<span>홈페이지</span>
									</th>
									<td>
										<span><a href="<?=$row['homepage']?>" target="_blank"><?=$row['homepage']?></a></span>
									</td>
								</tr>
								<tr>
									<th>
										<span>이용혜택</span>
									</th>
									<td>
										<span><?=$row['con5']?></span>
									</td>
								  <script>
								  </script>
								</tr>
								<tr>
									<th>
										<span>객실 선택</span>
									</th>
									<td>
										<span>평형&nbsp;:&nbsp;<?=$row['rArea']?></span>
										<span>타입&nbsp;:&nbsp;<?=$row['rType']?></span>
										<span>객실수&nbsp;:&nbsp;<?=$row['rCnt']?></span>
										<span>기준&nbsp;:&nbsp;<?=$row['rAvg']?></span>
										<span>최대&nbsp;:&nbsp;<?=$row['rMax']?></span>
										<span>시설&nbsp;:&nbsp;<?=$row['rInfra']?></span>
										<div class="empty-room">
                                            <?
                                                $sql2 = " SELECT useday FROM tb_comhuM_useday  WHERE midx = {$midx} AND seq = {$row['seq']} ";
                                                $rs2 = mysqli_query($gconnet, $sql2);
                                                                                             
                                                for($i=0; $i< mysqli_num_rows($rs2); $i++){
                                                    $row2 = mysqli_fetch_array($rs2);   
                                                    
                                                    if($i > 0) echo "/";
                                                    echo $usedayArray[$row2['useday']];
                                                }
                                             ?> 											
										</div>
									</td>
								</tr>
								<tr>
									<th><span>부담</span></th>
									<td class="price-go">
										<span>
											기업&nbsp;&nbsp;
											<?=number_format($row['com_amount'])?>원
										</span>
										,&nbsp;&nbsp;&nbsp;
										<span>&nbsp;개인&nbsp;
                                            <?=number_format($row['per_amount'])?>원
										</span>
										&nbsp;&nbsp;&nbsp;
										<span>&nbsp;&nbsp;총&nbsp;
                                        <?=number_format($row['com_amount']+$row['per_amount'])?>원
										</span>
									</td>
								</tr>
								<tr>
									<th><span>배정 방식</span></th>
									<td>
										<span><?=$assignArray[$row['type']]?></span>
									</td>
								</tr>
								<script>
								</script>
								<tr>
									<th><span>구분</span></th>
									<td>
										<span><?=$row['flag']?></span>
									</td>
								</tr>
								<tr>
									<th><span>이용기간</span></th>
									<td>
										<span><?=tranStrDate(to_date($row['udate1']),'YmdKo2')?>
                                        ~ <?=tranStrDate(to_date($row['udate2']),'YmdKo2')?></span>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="view view-2">
						<div class="view-t">당첨상세</div>
						<div class="view-c">
							<div class="btn-wrap">
								<div class="crm-sear">
									<div class="cs-name">
										<span class="cn-t">사원명</span>
										<input type="text" id="name" name="name" style="width: 100px; height: 35px; border-radius: 5px;  padding: 0px 10px;">
									</div>
									<div class="fin-name">
										<span class="cn-t">최종결과</span>
										<select name="regflag" id="regflag">
											<option value="">전체</option>
											<option value="5">당첨</option>
											<option value="9">탈락</option>
										</select>
									</div>
									<button type="button" onClick="search();">검색</button>
								</div>
								<div class="btn-float">
									<button type="button" onclick="exportExcel('list');">프린트</button>
								</div>
							</div>
							<div class="view-host">
                                <table id="list"></table>
                                <div id="pager"></div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	
	
	<!-- 셀렉트 박스	-->
	
	
	<script>
		$(document).ready(function(){			
			
			$('select').wSelect();
		});
	
	</script>
	
</body>
</html>