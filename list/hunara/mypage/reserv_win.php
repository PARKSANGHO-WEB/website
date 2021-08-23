<? include("../inc/header.php");  ?>
<link rel="stylesheet" href="/css/reserv.css">
<?
    $pageNo = trim(sqlfilter($_REQUEST['pageNo']));
    $regflag = "5";

    $total_param = "regflag=".$regflag;

    if(!$pageNo){
        $pageNo = 1;
    }    

    $pageScale = 10; // 페이지당 10 개씩 
    $start = ($pageNo-1)*$pageScale;
    
    $StarRowNum = (($pageNo-1) * $pageScale);
    $EndRowNum = $pageScale;
    
    //당첨여부[5:당첨 6:예비당첨 7: 당첨후취소  8:취소 9:탈락] 
    $sql = " SELECT a.ridx, a.hidx, a.chasu,  b.comname, date_format(a.cymd, '%Y-%m-%d') as cymd, a.useday, a.regflag, a.hide_yn ";
    $sql .= "       ,c.type , case when a.cymd2 < date_format(now(), '%Y%m%d') then 'Y' else 'N' end servey_yn ";
    $sql .= " FROM tb_reInfo a, tb_hu b, tb_comhuM c ";
    $sql .= " WHERE a.hidx = b.idx      ";
    $sql .= "  AND a.midx = c.midx      ";
    $where = " AND a.cidx = '{$_COMPANY_ID}'   AND a.sano = '{$_SESSION['EMP_NO']}'  ";
    $where .= "AND a.regflag = '{$regflag}' AND ifnull(a.regflag_two,'') != '2' AND a.hide_yn = 'N' ";
    
    $sql .=  $where."   ORDER BY a.ridx  desc LIMIT  {$StarRowNum} , {$EndRowNum}";
	$rs = mysqli_query($gconnet, $sql);


    $query_cnt = "select a.ridx from tb_reInfo a where 1=1 ".$where;
    $result_cnt = mysqli_query($gconnet,$query_cnt);
    $num = mysqli_num_rows($result_cnt);

    $iTotalSubCnt = $num;
    $totalpage	= ($iTotalSubCnt - 1)/$pageScale;    

?>
<script>
    $(document).ready(function(){
        jQuery('.top-menu a').eq("2").addClass('active');
    });

    function view(ridx){
        var f = document.frm;
        f.ridx.value = ridx;
        f.action = "/mypage/reserv_view.php";
        f.submit();
    }

    function popSurvey(ridx,hidx){
        
        var dataArr = {
                mode : 'CHECK'
            ,   ridx : ridx
        };        

        $.ajax({
            url		: "survey_proc.php",
            type	: "POST",
            data	: dataArr,
            async	: false,
            dataType	: "json",
            success		: function(data){
                if ( data.success == "true" ){
                    document.surveyFrm.ridx.value = ridx;
                    document.surveyFrm.hidx.value = hidx;
                    $("#popSurvey").addClass("visible");
                } else if ( data.success == "false" ){
                    alert(data.msg);
                } else {
                    alert( "시스템 오류 발생 하였습니다. \n관리자에게 문의하시기 바랍니다." );
                }
            }
        }); 

    }

    function survey(){

        var ridx = document.surveyFrm.ridx.value;
        var hidx = document.surveyFrm.hidx.value;
        var sidx = document.surveyFrm.sidx.value;

        var dataArr = {
                mode : 'SAVE'
            ,   ridx : ridx
            ,   hidx : hidx
            ,   sidx : sidx 
        };

        // 만족도 
        $('.range-slider__value').each(function(){
            var qidx = $(this).data('qidx');
            var val = $(this).text();

            dataArr['qidx_'+qidx] = val;

        });    

        //객관식
        var choice = true;
        $('input[type=checkbox]').each(function(){
            var qidx = $(this).attr('name');
            var val = [];

            $('input[name='+qidx+']:checked').each(function(){
                val.push($(this).val());
            });

            if(val.length < 1){
                choice = false;
            }

            dataArr[qidx] = val.join(",");
            
        });

        if(choice == false){
            alert('질문에 대한 항목을 선택하십시오.');
            return;
        }



        //기타
        $('.anything').each(function(){
            var qidx = $(this).attr('name');
            var val = $(this).val();

            dataArr[qidx] = val;
            
        });

        $('#txt').each(function(){
            var qidx = $(this).attr('name');
            var val = $(this).val();

            if(checkLen($(this).val()) > 4000 ){
                alert("기타의견은 최대 4,000byte 까지 입력 가능합니다.");
                return;
            }

            dataArr[qidx] = val;
        });

        $.ajax({
                url		: "survey_proc.php",
                type	: "POST",
                data	: dataArr,
                async	: false,
                dataType	: "json",
                success		: function(data){
                    if ( data.success == "true" ){
                        alert(data.msg);
                        $("#popSurvey").removeClass("visible");

                    } else if ( data.success == "false" ){
                        alert(data.msg);
                        
                    } else {
                        alert( "시스템 오류 발생 하였습니다. \n관리자에게 문의하시기 바랍니다." );
                    }
                }
        }); 


    }

function checkLen(val){
    var len = 0;
	for(j=0; j<val.length; j++) {
		var str = val.charAt(j);
		len += (str.charCodeAt() > 128) ? 2 : 1
	}
    return len;

}
</script>
<body>
<form name="frm" method="get">
<input type="hidden" name="ridx" id="ridx">
</form>
    <header></header>
    <div id="container">
		<div class="sort-wrap">
			<div class="sort-menu" id="sangse-sort">
				<ul>
					<li>
						<span onclick="location.href='/mypage/mypage.php'">회원정보</span>
					</li>
					<li class="active">
						<span onclick="location.href='/mypage/reserv.php'">예약내역</span>
					</li>
					<li>
						<span onclick="location.href='/mypage/mywrite.php'">내 게시글 관리</span>
					</li>
				</ul>
			</div>
		</div>

        <div id="table">
            <? include("reserv_tab.php");  ?>
            <table id="reserv-t" class="reserv-sel">
                <tr>
                    <th>번호</th>
                    <th>지망</th>
                    <th>휴양소명</th> 
                    <th>예약일</th>
                    <th>결과</th>
                    <th>설문조사</th>
                </tr>
            <?
                    $listCnt = mysqli_num_rows($rs);
                    for ($i=0; $i<mysqli_num_rows($rs); $i++){
                        $row = mysqli_fetch_array($rs);      
                        $no = $iTotalSubCnt - (( $pageNo - 1 ) * $pageScale ) - $i;
            ?>
                <tr onclick="view('<?=$row['ridx']?>');">
                    <td><p><?=$no?></p></td>
                    <td><p><?=($row['type'] == "F")?"선착순":$row['chasu']."지망"?></p></td>
                    <td><p><?=$row['comname']?></p></td>
                    <td><p><?=tranStrDate($row['cymd'],'kordis.')?>부터 <?=$usedayArray[$row['useday']]?></p></td>
                    <td><p><?=$regFlagArray[$row['regflag']]?></p></td>
                    <td onclick="event.cancelBubble=true">
                    <?
                        if($row['regflag'] == "5" && $row['servey_yn'] == "Y"){
                    ?>
                        <div class="survey"><a href="javascript:popSurvey('<?=$row['ridx']?>','<?=$row['hidx']?>');">설문조사</a></div>
                    <?
                        }
                    ?>    
                    </td>
                </tr>
                <?
                    }
                ?>
            </table>
            <div id="paging">
                <ul>
                    <?
    		    	    include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/paging_front.php";	
	        	    ?>	                
                </ul>
            </div>
    	</div>
    </div>
    <footer></footer>
    <?
        $sql2 = " SELECT sidx, title FROM tb_survey WHERE cidx = '{$_COMPANY_ID}' AND del_yn = 'N' ";
        $rs2 = mysqli_query($gconnet, $sql2);
        $row2 = mysqli_fetch_array($rs2);   

    ?>
	<div id="popSurvey" class="survey-modal modal-wrap">

			<div class="modal-con">
				<div class="modal-top">
					<div class="close-modal">
						<img src="../img/common/close.png" alt="">
					</div>
				</div>
				<div class="modal-bot">
					<form method="post" name="surveyFrm" id="surveyFrm">
                        <input type="hidden" name="ridx" >
                        <input type="hidden" name="hidx" >
                        <input type="hidden" name="sidx" value="<?=$row2['sidx']?>" >
						<div class="mo-con">
							<p class="rr-title">
								<?=$row2['title']?>
							</p>
                            <?
                                $sql = " SELECT qidx, flag, question, @ROWNUM := @ROWNUM +1 AS rownum   ";
                                $sql .= " FROM tb_survey_question t, (SELECT @ROWNUM := 0) tmp ";
                                $sql .= " WHERE cidx = '{$_COMPANY_ID}' AND sidx = '{$row2['sidx']}' AND del_yn = 'N' ORDER BY flag, qidx ";

                                $rs = mysqli_query($gconnet, $sql);

                                for($i=0; $i< mysqli_num_rows($rs); $i++){
                                    $row = mysqli_fetch_array($rs);   
                            ?>
							<div class="sml-line sml-line<?=($i+1)?>">
								<p><?=($i+1)?>. <?=$row['question']?></p>
                                <?
                                    if($row['flag'] == "10" or $row['flag'] == "30" ) { //만족도
                                ?>
								<div class="range-slider">
									<input class="range-slider__range" type="range"  value="100" min="0" max="100">
									<span class="range-slider__value" data-qidx="<?=$row['qidx']?>" >0</span>
								</div>
                                <?
                                    }else if($row['flag'] == "20" ){ //객관식

                                        $choice_sql = " SELECT qidx, oidx, item, etc_yn FROM tb_survey_choice WHERE cidx = '{$_COMPANY_ID}' and qidx = '{$row['qidx']}' AND del_yn = 'N' ";
                                        $choice_rs = mysqli_query($gconnet, $choice_sql);

                                        for($j=0; $j < mysqli_num_rows($choice_rs); $j++){
                                            $choice_row = mysqli_fetch_array($choice_rs); 
                                ?>
                                        <div class="l5-label">
                                            <input type="checkbox" name="qidx_<?=$row['qidx']?>" id="qidx_<?=$row['qidx']?>_<?=$choice_row['oidx']?>" value="<?=$choice_row['item']?>">
                                            <label for="qidx_<?=$row['qidx']?>_<?=$choice_row['oidx']?>"><?=$choice_row['item']?></label>
                                            <?
                                                if($choice_row['etc_yn'] == "Y"){
                                            ?>
                                                <input type="text" id="etc_<?=$row['qidx']?>"  name="etc_<?=$row['qidx']?>" class="anything" >
                                            <?
                                                }
                                            ?>
                                        </div>
                                <?       
                                        }// end of for j                                 
                                    }else if($row['flag'] == "40"){
                                ?>
                                        <textarea name="qidx_<?=$row['qidx']?>" id="txt" ></textarea>
                                <?
                                    }// end of if
                                ?>
							</div>
                            <?
                                } // end of for i
                            ?>



							<div class="sml-line sml-line9">
								<p>설문에 참여해 주셔서 감사합니다.</p>
								<button type="button" onclick="survey();">설문제출</button>
							</div>
						</div>
					</form>
				</div>
			</div>

	</div>
		
		<script>
	
		var rangeSlider = function(){
			  var slider = $('.range-slider'),
				  range = $('.range-slider__range'),
				  value = $('.range-slider__value');

			  slider.each(function(){

				value.each(function(){
				  var value = $(this).prev().attr('value');
				  $(this).html(value);
				});

				range.on('input', function(){
				  $(this).next(value).html(this.value);
				});
			  });
			};

			rangeSlider();
	
		</script>
</body>
</html>