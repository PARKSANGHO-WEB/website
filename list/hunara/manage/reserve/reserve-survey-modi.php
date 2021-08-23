<? include("../inc/header.php"); ?>
<link rel="stylesheet" href="/manage/css/reserve.css">

<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>

<?

$idx = sqlfilter($_REQUEST['idx']);  //기업순번
$sidx = sqlfilter($_REQUEST['sidx']); //설문지 순번

################## 파라미터 조합 #####################

$where = "and a.idx = '".$idx."'";
$order_by = " ORDER BY a.wdate desc ";

$query = "select * from tb_company a where 1=1 ".$where.$order_by;

$result = mysqli_query($gconnet,$query);
$row = mysqli_fetch_array($result);


$survey_query = " select title from tb_survey where sidx = {$sidx} ";
$survey_result = mysqli_query($gconnet,$survey_query);
$survey_row = mysqli_fetch_array($survey_result);



?>


<script language="javascript">

function searchCompay(){

  $("#com-modal").load("/manage/popup/search-company2.php");

  $("#com-modal").addClass("visible");
  

}

function setResortInfo(){
        var cidx = $("#cidx").val();

        $.ajax({
            url		: "/manage/company/resort-data2.php?cidx="+cidx,
            type	: "GET",
            data	: {'cidx' : cidx},
            async	: false,
            dataType	: "json",
            success		: function(data){
                
                $("#dname").val(data.dname);
                $("#tel1").val(data.tel.split('-')[0]);
                $("#tel2").val(data.tel.split('-')[1]);
                $("#tel3").val(data.tel.split('-')[2]);
                $("#hp1").val(data.hp.split('-')[0]);
                $("#hp2").val(data.hp.split('-')[1]);
                $("#hp3").val(data.hp.split('-')[2]);
                $("#email1").val(data.email.split('@')[0]);
                $("#email2").val(data.email.split('@')[1]);

            }
        });         
    }
</script>

<body>
    <?
        include $_SERVER["DOCUMENT_ROOT"]."/manage/inc/nav.php";
    ?>

	<div class="contents reser-survey">
        <? 
        $MENU_DEPTH1 = "3";
        $MENU_DEPTH2 = "2";
        include $_SERVER["DOCUMENT_ROOT"]."/manage/reserve/left.php"; 
        ?>
		<div class="center-con">
			<div class="cc-title">
                <div>설문 수정</div>
				<div class="big-arrow"><img src="../img/common/big-arrow.png" alt=""></div>
				<div><?=$row[comname]?></div>
			</div>
			<div class="cc-con">
                <form name="frm" action="reserve-survey_modi_action.php" target="_fra_admin" method="post"  enctype="multipart/form-data">
                <input type="hidden" name="cidx" value="<?=$idx?>" >
                <input type="hidden" name="sidx" value="<?=$sidx?>" >
					<div class="view view-1 on">
						<div class="view-t active">기업 선택</div>
						<div class="view-c">
							<div class="view-mody">
								<table id="survey-go">
									<tbody>
										<tr>
											<th>
												<span>설문제목</span>
											</th>
											<td>
												<input type="text" name="surveytitle" value="<?=$survey_row['title']?>">
											</td>
										</tr>
										<tr>
											<th>
												<span>기업명</span>
											</th>
											<td>
                                                <?=$row[comname]?>
									            
											</td>
										</tr>
										<tr>
											<th>
												<span>담당자명</span>
											</th>
											<td>
                                                <?=$row[dname]?>
											</td>
										</tr>
										<tr>
											<th>
												<span>연락처</span>
											</th>
											<td>
                                                <?=explode('-',$row[tel])[0]?>
												<span class="hypen">-</span>
												<?=explode('-',$row[tel])[1]?>
												<span class="hypen">-</span>
												<?=explode('-',$row[tel])[2]?>
											</td>
										</tr>
										<tr>
											<th>
												<span>핸드폰</span>
											</th>
											<td>
                                                <?=explode('-',$row[hp])[0]?>
												<span class="hypen">-</span>
												<?=explode('-',$row[hp])[1]?>
												<span class="hypen">-</span>
												<?=explode('-',$row[hp])[2]?>
											</td>
										</tr>
										<tr>
											<th>
												<span>이메일</span>
											</th>
											<td>
                                                <?=explode('@',$row[email])[0]?>
												<span class="gol">@</span>
												<?=explode('@',$row[email])[1]?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<!--<div class="center-btn">
								<div class="btn-wrap">
									<button type="button">취소</button>
									<button type="button">저장</button>
								</div>
							</div>-->
						</div>
					</div>
					<div class="view view-2">
						<div class="view-t active">만족도 질문 (최대 10개)</div>
						<div class="view-c">
                        
							<div class="view-surv">
								<div class="survey-wrap">
									
										
                                        <?php

                                            $query2 = "select * from tb_survey_question a where 1=1 and flag = 10 and sidx = '".$sidx."' and del_yn ='N' ";

                                            $result2 = mysqli_query($gconnet,$query2);
                                            for($i=0; $i<mysqli_num_rows($result2); $i++)
						                    {
                                            $row2 = mysqli_fetch_array($result2);

                                        ?>
                                        <div class="survey-line manjok">
                                            <button class="remove-btn" type="button">삭제</button>
                                            <input type="text" name="question[]" value="<?=$row2[question]?>">
                                        </div>
                                        <?php
                                            }
                                        ?>
									
								</div>
								<button type="button" class="add-ten">추가</button>
							</div>
							<!--<div class="center-btn">
								<div class="btn-wrap">
									<button type="button">취소</button>
									<button type="button">저장</button>
								</div>
							</div>-->
						</div>
					</div>

                    <script>
                    //문항 추가

                    $(document).ready(function(){
                        $(document).delegate('.add-type','click',function(){

                    //document.getElementById('aa').setAttribute('name','It is kkamikoon Title');

                            
                            var long = $('.survey-wrap').find('.sur-l2').length;

                            console.log(long);
                            
                            if( long < 5 ) {
                            
                            $(this).siblings('.survey-wrap').append("<div class='survey-line'><button class='remove-btn' type='button'>삭제</button><div class='sel-survey'><input type='text' class='ex-title' placeholder='제목을 입력해주세요.' name='title[]'><div class='ex-check'><div class='sur-l sur-l1'><input type='text' placeholder='선택지를 입력하세요.' class='con'></div><div class='sur-l sur-l2'><input type='text' placeholder='선택지를 입력하세요.' class='con'></div><div class='sur-l sur-l3'><input type='text' placeholder='선택지를 입력하세요.' class='con'></div><div class='sur-l sur-l4'><input type='text' placeholder='선택지를 입력하세요.' class='con'></div><div class='sur-l sur-l5'><input type='text' placeholder='선택지를 입력하세요.' class='con'></div><div class='sur-l sur-l6'><input type='text' placeholder='선택지를 입력하세요.' class='con'></div></div></div></div>");
                            
                            for(var i = 1; i< $('.con').length; i++){
                                $('.con').eq(i-1).attr('name','content'+i);
                            }

                                }else{
                                    $('.add-type').css('display','none');
                                }
                        });
                    });



                    //문항 삭제

                    $(document).ready(function(){
                        
                        $(document).delegate('.remove-btn','click',function(){
                            
                            $(this).parents('.survey-line').remove();

                            for(var i = 1; i< $('.con').length; i++){
                                $('.con').eq(i-1).attr('name','content'+i);
                            }

                                var long = $('.survey-wrap').find('.sur-l2').length;

                                if( long < 5 ){
                                        $('.add-type').css('display','block');
                                }
                        });
                    });

                    </script>

					<div class="view view-3">
						<div class="view-t active">객관식 질문 (최대 5개)</div>
						<div class="view-c">
							<div class="view-sl">
								<div class="survey-wrap">
                                    <?php

                                        $query3 = "select * from tb_survey_question a where 1=1 and flag = 20 and sidx = '".$sidx."' and del_yn ='N' ";

                                        $result3 = mysqli_query($gconnet,$query3);
                                        $k = 0;
                                        $q = 1;
                                        for($j=0; $j<mysqli_num_rows($result3); $j++)
                                        {
                                        $row3 = mysqli_fetch_array($result3);

                                    ?>
									<div class="survey-line">
										<button class="remove-btn" type="button">삭제</button>
										<div class="sel-survey">
											<input type="text" class="ex-title" placeholder="제목을 입력해주세요." name="title[]" value="<?=$row3[question]?>">
                                            
											<div class="ex-check">
                                                <?php

                                                    $query4 = "select * from tb_survey_choice a where 1=1 and sidx = '".$sidx."' and qidx = '".$row3[qidx]."' ";

                                                    $result4 = mysqli_query($gconnet,$query4);
                                                    
                                                    for($z=0; $z<6; $z++)
                                                    {
                                                    $row4 = mysqli_fetch_array($result4);

                                                ?>
												<div class="sur-l sur-l<?=($z+1)?>" >
													<input type="text" placeholder="선택지를 입력하세요." class="con" name="content<?=($k*6 + $q)?>" value="<?=$row4[item]?>">
												</div>
												
                                                <?php
                                                $q++;
                                                    }
                                                ?>
											</div>
                                            
										</div>
									</div>
                                    <?php
                                        }
                                    ?>
								</div>
								<button type="button" class="add-type">추가</button>
							</div>
							<!--<div class="center-btn">
								<div class="btn-wrap">
									<button type="button">취소</button>
									<button type="button">저장</button>
								</div>
							</div>-->
						</div>
					</div>
					<div class="view view-4">
						<div class="view-t active">전체 만족도 질문 (필수)</div>
						<div class="view-c">
							<div class="view-sl">
								<div class="survey-wrap">
                                <?php

                                    $query5 = "select * from tb_survey_question a where 1=1 and flag = 30 and sidx = '".$sidx."' and del_yn ='N' ";

                                    $result5 = mysqli_query($gconnet,$query5);
                                    for($w=0; $w<mysqli_num_rows($result5); $w++)
                                    {
                                    $row5 = mysqli_fetch_array($result5);

                                    ?>
									<div class="survey-line">
										<input class="all-man" type="text" name="manjok" value="<?=$row5[question]?>">
									</div>
                                    <?php
                                        }
                                    ?>
								</div>
							</div>
							<!--<div class="center-btn">
								<div class="btn-wrap">
									<button type="button">취소</button>
									<button type="button">저장</button>
								</div>
							</div>-->
						</div>
					</div>
					<div class="view view-5">
						<div class="view-t active">주관식 질문(필수)</div>
						<div class="view-c">
							<div class="view-sl">
								<div class="survey-wrap">
                                <?php

                                    $query6 = "select * from tb_survey_question a where 1=1 and flag = 40 and sidx = '".$sidx."' and del_yn ='N' ";

                                    $result6 = mysqli_query($gconnet,$query6);
                                    for($e=0; $e<mysqli_num_rows($result6); $e++)
                                    {
                                    $row6 = mysqli_fetch_array($result6);

                                    ?>
									<div class="survey-line">
										<input class="question" type="text" name="jugwan" value="<?=$row6[question]?>">
										<!--<textarea name="question-tab" id="question-tab"></textarea>-->
									</div>
                                    <?php
                                        }
                                    ?>
								</div>
							</div>
							<!--<div class="center-btn">
								<div class="btn-wrap">
									<button type="button">취소</button>
									<button type="button">저장</button>
								</div>
							</div>-->
						</div>
					</div>
					<div class="center-btn">
						<div class="btn-wrap">
							<button type="button" onclick="javascript:location.href='reserve-survey-manage.php'">취소</button>
							<button type="button" onclick="go_submit();">수정</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="com-modal modal-wrap">
		<div class="modal-con">
			<div class="modal-top">
				<div class="title-modal">
					<span>기업 검색</span>
				</div>
				<div class="close-modal">
					<img src="../img/common/close.png" alt="">
				</div>
			</div>
			<form action="#">
				<div class="mo-con" style="">
					<div class="list-wrap">
						<div class="list-table">
							<table id="sortRc">
								<thead>
									<tr>
										<th>선택</th>
										<th class="th-btn"><span>번호</span></th>
										<th class="th-btn"><span>등록일</span></th>
										<th class="th-btn"><span>기업명</span></th>
										<th class="th-btn"><span>담당자</span></th>
										<th class="th-btn"><span>연락처</span></th>
										<th class="th-btn"><span>핸드폰</span></th>
										<th class="th-btn"><span>휴양소</span></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input type="radio" name="sel-com"></td>
										<td>1</td>
										<td>2021.02.03</td>
										<td>비엔시스템</td>
										<td>박상호</td>
										<td>123-456-7498</td>
										<td>123-4546-7948</td>
										<td>3</td>
									</tr>
									<tr>
										<td><input type="radio" name="sel-com"></td>
										<td>1</td>
										<td>2021.02.03</td>
										<td>비엔시스템</td>
										<td>박상호</td>
										<td>123-456-7498</td>
										<td>123-4546-7948</td>
										<td>3</td>
									</tr>
									<tr>
										<td><input type="radio" name="sel-com"></td>
										<td>1</td>
										<td>2021.02.03</td>
										<td>비엔시스템</td>
										<td>박상호</td>
										<td>123-456-7498</td>
										<td>123-4546-7948</td>
										<td>3</td>
									</tr>
									<tr>
										<td><input type="radio" name="sel-com"></td>
										<td>1</td>
										<td>2021.02.03</td>
										<td>비엔시스템</td>
										<td>박상호</td>
										<td>123-456-7498</td>
										<td>123-4546-7948</td>
										<td>3</td>
									</tr>
									<tr>
										<td><input type="radio" name="sel-com"></td>
										<td>1</td>
										<td>2021.02.03</td>
										<td>비엔시스템</td>
										<td>박상호</td>
										<td>123-456-7498</td>
										<td>123-4546-7948</td>
										<td>3</td>
									</tr>
									<tr>
										<td><input type="radio" name="sel-com"></td>
										<td>1</td>
										<td>2021.02.03</td>
										<td>비엔시스템</td>
										<td>박상호</td>
										<td>123-456-7498</td>
										<td>123-4546-7948</td>
										<td>3</td>
									</tr>
									<tr>
										<td><input type="radio" name="sel-com"></td>
										<td>1</td>
										<td>2021.02.03</td>
										<td>비엔시스템</td>
										<td>박상호</td>
										<td>123-456-7498</td>
										<td>123-4546-7948</td>
										<td>3</td>
									</tr>
								</tbody>
							</table>
							<div class="paging">
								<a class="first"></a>
								<a class="prev"></a>
								<a class="active">1</a>
								<a>2</a>
								<a>3</a>
								<a>4</a>
								<a>5</a>
								<a class="next"></a>
								<a class="last"></a>
							</div>	
							<div class="btn-apply">
								<button type="button">수정</button>
								<button type="button">취소</button>
							</div>						
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

    <!-- 기업검색 창 -->
    <div class="com-modal modal-wrap" id="com-modal">
    </div>
	
	<!--  셀렉트박스와 파일업로드	-->
	
	<script type="text/javascript">

    function go_submit() {
        var check = chkFrm('frm');
        if(check) {
            frm.submit();
        } else {
            false;
        }
    }
		
		$(document).ready(function () {	
			$('select').wSelect();
		});
		

	</script>
	
	
	

	<?php 
    $show_iframe =true;
    ?>
</body>
<iframe name="_fra_admin" width="0" height="0" style="display:<?=$show_iframe==TRUE?"":"none"?>"></iframe>
</html>