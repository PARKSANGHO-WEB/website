<? include("../inc/header.php"); ?>
<?
$midx 	= trim(sqlfilter($_REQUEST['midx']));

$sql = " SELECT c.comname, b.comname as huname, concat('(',b.post,')', b.addr1, ' ', b.addr2) as addr, b.tel, b.homepage, a.con5, a.weight, ";
$sql .= "       a.com_amount, a.per_amount, a.pg_yn, a.flag, a.udate1, a.udate2, a.type, a.midx, a.hidx, a.cidx, a.reservation ";
$sql .= " FROM tb_comhuM a, tb_hu b, tb_company c ";
$sql .= " WHERE a.midx = '{$midx}' ";
$sql .= "   AND a.hidx = b.idx ";
$sql .= "   AND a.cidx = c.idx ";

$rs = mysqli_query($gconnet, $sql);
$row = mysqli_fetch_array($rs);

$cidx = $row['cidx'];
$hidx = $row['hidx'];
$con5 = $row['con5'];
$udate1 = $row['udate1'];
$udate2 = $row['udate2'];

?>
<!--팝업 오픈-->
 <script language="javascript">

  	function roomPopup(seq, useday) { 
			window.open("company-room-pop.php?midx=<?=$midx?>&hidx=<?=$hidx?>&cidx=<?=$cidx?>&seq="+seq+"&useday="+useday, "a", "width=900, height=900, left=100, top=50"); 
	}


    function calAmount(){
        var per = $("#per_amount").val();
        var com = $("#com_amount").val();

        if(per == "") per = 0;
        if(com == "") com = 0;

        $("#sum_amount").val(Number(per)+Number(com));
    }    

    function save(){

        if(validate(document.frm) ){
            var room_seq = [];
            var room_use = [];

            $('#room_seq:checked').each(function(){
                room_seq.push($(this).val());
            });

            $('.option-c:checked').each(function(){
                room_use.push($(this).val());
            });

            oEditors.getById["editor_5"].exec("UPDATE_CONTENTS_FIELD", []);

            var dataArr = {
                    mode : 'UPDATE'
                ,   midx : '<?=$midx?>'    
                ,   hidx : '<?=$hidx?>'
                ,   cidx : '<?=$cidx?>'
                ,   flag : $('#flag:checked').val()
                ,   udate1 : $('#udate1').val()
                ,   udate2 : $('#udate2').val()
                ,   con5 : $('#editor_5').val()
                ,   type : $('#type:checked').val()
                ,   weight : $('#weight:checked').val()
                ,   com_amount : $('#com_amount').val()
                ,   per_amount : $('#per_amount').val()
                ,   pg_yn : $('#pg_yn:checked').val()
                ,   reservation : $('#reservation:checked').val()
                ,   roomArr : room_seq.join(",")
                ,   usedayArr : room_use.join(",")
            };

            if(dataArr.roomArr == ""){
                alert('객실 선택을 선택 하십시오.');
                return;
            }

            if(dataArr.usedayArr == ""){
                alert('박수 선택을 선택 하십시오.');
                return;
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
                    return;                        
                }

            });

            if(dataArr.pg_yn == undefined){
                alert('결제 구분을 선택 하십시오.');
                return;
            }

            if(dataArr.type == undefined){
                alert('배정 방식을 선택 하십시오.');
                return;
            }

            if(dataArr.flag == undefined){
                alert('구분을 선택 하십시오.');
                return;
            }

            console.log(dataArr);

            if(useSeq && confirm('수정 하시겠습니까')){
                $.ajax({
                    url		: "/manage/company/company-room-proc.php",
                    type	: "POST",
                    data	: dataArr,
                    async	: false,
                    dataType	: "json",
                    success		: function(data){
                        if ( data.success == "true" ){
                            alert(data.msg);
							document.location.reload();

                        } else if ( data.success == "false" ){
                            alert(data.msg);
                            
                        } else {
                            alert( "시스템 오류 발생 하였습니다." );
                        }
                    }
                }); 
            }
        }

    }

	function del(){

		var dataArr = {
                mode : 'DELETE'
            ,   midx : '<?=$midx?>'    
        };		

		if(confirm('삭제하신 데이터는 영구 삭제 됩니다. 삭제 하시겠습니까?')){	
			$.ajax({
                url		: "/manage/company/company-room-proc.php",
                type	: "POST",
                data	: dataArr,
                async	: false,
                dataType	: "json",
                success		: function(data){
                    if ( data.success == "true" ){
                        alert(data.msg);
						cancel();

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
        document.location.href = "/manage/company/company-room-manage.php";
    }

 </script>
<body>
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>
	<div class="contents mRoom-view">
    <? 
        $MENU_DEPTH1 = "2";
        $MENU_DEPTH2 = "2";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/company/left.php"; 
    ?>
		<div class="center-con">
			<div class="cc-title">
				<div>기업 휴양소 관리</div>
				<div class="big-arrow"><img src="../img/common/big-arrow.png" alt=""></div>
				<div>상세</div>
			</div>
			<div class="cc-con">
				<form name="frm" action="#">
					<div class="view view-1 on">
					<div class="view-t active">기업정보</div>
					<div class="view-c">
						<table>
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
									<span><?=$row['huname']?></span>
								</td>
							</tr>
							<tr>
								<th>
									<span>주소</span>
								</th>
								<td>
									<span><?=$row['addr']?></span>
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
									<span><?=$row['homepage']?></span>
								</td>
							</tr>
							<tr>
								<th>
									<span>이용혜택</span>
								</th>
								<td>
                                    <textarea class="autosize" name="con5" id="editor_5" style="height:60px;"><?=$con5?></textarea>
								</td>
							  <script>
							  </script>
							</tr>
							<tr>
								<th>
									<span>객실 선택</span>
								</th>
								<td>
                                <?
                                    //저장되어 있는 객실 순번 담기
                                    $roomSql = " SELECT seq FROM tb_comhuMtype WHERE midx = {$midx} ";
                                    $roomRs = mysqli_query($gconnet, $roomSql);
                                    $roomArr = [];
                                    
                                    for($k=0; $k < mysqli_num_rows($roomRs) ; $k++){
                                        $roomRow = mysqli_fetch_array($roomRs);
                                        array_push($roomArr, $roomRow['seq']);
                                    }
                                    


                                    $sql2 = "SELECT seq, rArea , rType, rCnt, rAvg, rMax, rInfra  ";
                                    $sql2 .= " FROM tb_huType ";
                                    $sql2 .= " WHERE idx = '{$row['hidx']}' ";

                                    $rs2 = mysqli_query($gconnet, $sql2);
                                    for($i=0; $i< mysqli_num_rows($rs2); $i++ ){
                                        $row2 = mysqli_fetch_array($rs2);
                                ?>
									<div class="option option1">
										<div class="opc-wrap">
											<input type="checkbox" name="room_seq" class="opt-check" id="room_seq" value="<?=$row2['seq']?>" <?=(in_array($row2['seq'], $roomArr))?"checked":""?>>
										</div>
										<div class="option-sel">
											<div class="opt-summary">
												<span>평형&nbsp;:&nbsp;<?=$row2['rArea']?></span>
												<span>타입&nbsp;:&nbsp;<?=$row2['rType']?></span>
												<span>객실수&nbsp;:&nbsp;<?=$row2['rCnt']?></span>
												<span>기준&nbsp;:&nbsp;<?=$row2['rAvg']?></span>
												<span>최대&nbsp;:&nbsp;<?=$row2['rMax']?></span>
												<span>시설&nbsp;:&nbsp;<?=$row2['rInfra']?></span>
											</div>
                                            <?
                                                //저장되어 있는 이용 박수 담기
                                                $useSql = " SELECT useday FROM tb_comhuM_useday WHERE midx = {$midx} AND seq={$row2['seq']} ";
												//echo $useSql."<br>";
                                                $useRs = mysqli_query($gconnet, $useSql);
                                                $useArr = [];
												$roomCntArr = [];
                                                
                                                for($k=0; $k < mysqli_num_rows($useRs) ; $k++){
                                                    $useRow = mysqli_fetch_array($useRs);
                                                    array_push($useArr, $useRow['useday']);
                                                }

												$roomCntWhere = " WHERE midx = {$midx} and cidx = {$cidx} and hidx ={$hidx} and seq={$row2['seq']} and rc_date between '{$udate1}' and '{$udate2}' ";


                                            ?>
											<div class="opt-list">
												<div class="list-1">
													<div class="opt-wrap">
														<input class="option-c" type="checkbox" name="useday1" id="useday1" value="<?=$row2['seq'].':1'?>" <?=(in_array(1, $useArr))?"checked":""?> >
														<label for="opt1-1">1박 2일</label>
														<a href="javascript:;" onclick="roomPopup(<?=$row2['seq']?>,1);" >
														<?
														
															if(in_array(1, $useArr) && getCnt($gconnet,"tb_room_custom", $roomCntWhere." and useday= 1 ") > 0){
																echo "<span style='color:red'>[일별 객실 세팅]</span>";
															} else{
																echo "[일별 객실 세팅]";
															}
														?>
														</a>
													</div>
													<div class="opt-wrap">
														<input class="option-c" type="checkbox" name="useday2" id="useday2" value="<?=$row2['seq'].':2'?>" <?=(in_array(2, $useArr))?"checked":""?>>
														<label for="opt1-2">2박 3일</label>
														<a href="javascript:;" onclick="roomPopup(<?=$row2['seq']?>,2);"  >
														<?
														if(in_array(2, $useArr) && getCnt($gconnet,"tb_room_custom", $roomCntWhere." and useday= 2 ") > 0){
															echo "<span style='color:red'>[일별 객실 세팅]</span>";
														} else{
															echo "[일별 객실 세팅]";
														}
														?>													
														</a>
													</div>
													<div class="opt-wrap">
														<input class="option-c" type="checkbox" name="useday3" id="useday3" value="<?=$row2['seq'].':3'?>" <?=(in_array(3, $useArr))?"checked":""?>>
														<label for="opt1-3">3박 4일</label>
														<a href="javascript:;" onclick="roomPopup(<?=$row2['seq']?>,3);"  >
														<?
														
														if(in_array(3, $useArr) && getCnt($gconnet,"tb_room_custom", $roomCntWhere." and useday= 3 ") > 0){
															echo "<span style='color:red'>[일별 객실 세팅]</span>";
														} else{
															echo "[일별 객실 세팅]";
														}
														?>														
														</a>
													</div>
													<div class="opt-wrap">
														<input class="option-c" type="checkbox" name="useday4" id="useday4" value="<?=$row2['seq'].':4'?>" <?=(in_array(4, $useArr))?"checked":""?>>
														<label for="opt1-4">4박 5일</label>
														<a href="javascript:;" onclick="roomPopup(<?=$row2['seq']?>,4);"  >
														<?
														
														if(in_array(4, $useArr) && getCnt($gconnet,"tb_room_custom", $roomCntWhere." and useday= 4 ") > 0){
															echo "<span style='color:red'>[일별 객실 세팅]</span>";
														} else{
															echo "[일별 객실 세팅]";
														}
														?>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>

                                <?
                                    }
                                ?>

								</td>
							</tr>
							<tr>
								<th><span>부담</span></th>
								<td class="price-go">
                                <input type="hidden" class="only-num" id="com_amount" onChange="calAmount();">
									<!--<span>
										기업&nbsp;&nbsp;
										<input type="text" class="only-num" id="com_amount" value="<?=$row['com_amount']?>" onChange="calAmount();">&nbsp;원
									</span>
									,&nbsp;&nbsp;&nbsp;-->
									<span>&nbsp;개인&nbsp;
										<input type="text" class="only-num" id="per_amount" value="<?=$row['per_amount']?>" onChange="calAmount();" >&nbsp;원
									</span>
									&nbsp;&nbsp;&nbsp;
									<span>&nbsp;&nbsp;총&nbsp;
										<input type="text" class="only-num" id="sum_amount" value="<?=$row['per_amount']+$row['com_amount']?>" >&nbsp;원
									</span>
								</td>
							</tr>
							<tr>
								<th><span>결제사용</span></th>
								<td>
									<div class="module-okay">
										<input type="radio"  name="pg_yn" id="pg_yn" <?=($row['pg_yn'] == "Y"?"checked":"")?> value="Y">
										<label for="pg_yn">사용</label>
									</div>
									<div class="module-none">
										<input type="radio" name="pg_yn" id="pg_yn" <?=($row['pg_yn'] != "Y"?"checked":"")?> value="N">
										<label for="pg_yn">미사용</label>
									</div>
								</td>
							</tr>
							<tr>
								<th><span>배정 방식</span></th>
								<td>
									<div class="raffle-okay">
										<input type="radio" value="F" name="type" class="r-okay" id="type" <?=($row['type'] == "F")?"checked":""?>>
										<label for="type">선착순</label>
									</div>
									<div class="raffle-none">
										<input type="radio" value="S" name="type" class="r-none" id="type" <?=($row['type'] == "S")?"checked":""?> >
										<label for="type">추첨</label>
										<span class="between">[</span>
										<span>가중치&nbsp;:&nbsp;</span>
											<input type="radio" name="weight" id="weight" value="H" <?=($row['weight'] == "H")?"checked":""?> >
										 <label for="r-high">
											<span>높은값 우선</span>
										 </label>
											<input type="radio" name="weight" id="weight" value="L" <?=($row['weight'] == "L")?"checked":""?> >
										 <label for="r-low">
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
										<input type="radio" name="flag" id="flag" <?=($row['flag'] == "동계")?"checked":""?> value="동계">
										<label for="flag">동계</label>
									</div>
									<div class="period">
										<input type="radio" name="flag" id="flag" <?=($row['flag'] == "하계")?"checked":""?> value="하계">
										<label for="flag">하계</label>
									</div>
									<div class="period">
										<input type="radio" name="flag" id="flag" <?=($row['flag'] == "상시")?"checked":""?> value="상시">
										<label for="flag">상시</label>
									</div>
								</td>
							</tr>
							<tr>
								<th><span>이용기간(화면 노출기간)</span></th>
								<td>
									<div class="room-day">
										<input type="text" id="udate1" value="<?=to_date($row['udate1'])?>" data-js-start-date HNAME="이용기간 시작일" REQUIRED><span>~</span>
										<input type="text" id="udate2" value="<?=to_date($row['udate2'])?>" data-js-end-date HNAME="이용기간 종료일" REQUIRED>
									</div>
								</td>
							</tr>
                            <tr>
								<th><span>예약가능여부</span></th>
								<td>
									<div class="module-okay">
										<input type="radio"  name="reservation" id="reservation" <?=($row['reservation'] == "Y"?"checked":"")?> value="Y">
										<label for="reservation">예약가능</label>
									</div>
									<div class="module-none">
										<input type="radio" name="reservation" id="reservation" <?=($row['reservation'] != "Y"?"checked":"")?> value="N">
										<label for="reservation">예약불가</label>
									</div>
								</td>
							</tr>
						</table>
						<div class="center-btn">
							<div class="btn-wrap">
								<button type="button" onClick="save();">수정</button>
								<button type="button" onClick="cancel();">취소</button>
								<button type="button" onClick="del();">삭제</button>
							</div>
						</div>
					</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	<!--  셀렉트 박스, 파일 업로드	-->
    <script type="text/javascript" src="/smarteditor2/js/HuskyEZCreator.js" charset="utf-8"></script>
    <script language="javascript">
        
        $(document).ready(function () {
            $('select').wSelect();
        });

        var oEditors = [];
        nhn.husky.EZCreator.createInIFrame({
            oAppRef: oEditors,
            elPlaceHolder: "editor_5",
            sSkinURI: "/smarteditor2/SmartEditor2Skin.html",	
            htParams : {bUseToolbar : true,
                fOnBeforeUnload : function(){
                }
            }, //boolean
            fOnAppLoad : function(){
                oEditors.getById["editor_5"].exec("PASTE_HTML", ['<?//=$con5?>']);
            },
            fCreator: "createSEditor2"
        });   
    </script> 
	
</body>
</html>