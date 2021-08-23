<? include("../inc/header.php"); ?>
<link rel="stylesheet" href="/manage/css/reserve.css">

<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>

<?

$idx = sqlfilter($_REQUEST['idx']);

################## 파라미터 조합 #####################

$where = "and a.idx = '".$idx."'";

$order_by = " ORDER BY a.wdate desc ";

$query = "select * from tb_company a where 1=1 ".$where.$order_by;

$result = mysqli_query($gconnet,$query);
$row = mysqli_fetch_array($result);


?>

<!--팝업 오픈-->
<script language="javascript">

function roomPopup() { 
      console.log("##roomPopup");
      window.open("company-room-pop.html", "a", "width=900, height=800, left=100, top=50"); 
}

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
    <div class="root-wrap">
		<div class="root">
			<ul>
				<li>
					<a href="../home.php">Home</a>
				</li>
				<li class="arrow"><img src="../img/common/arrow.svg" alt=""></li>
				<li>
					<a href="./reserve-selected.php">예약관리</a>
				</li>
				<li class="arrow"><img src="../img/common/arrow.svg" alt=""></li>
				<li>
					<a href="./reserve-survey.php">설문 등록</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="contents reser-survey">
		<div class="left-menu">
			<div class="lm-t">
				<p>예약관리</p>
			</div>
			<ul>
				<li class="lm-act">
					<p class="lm-big">예약관리</p>
					<div class="lm-list">
						<ul>
							<li><a href="./reserve-selected.php">당첨 등록 관리</a></li>
							<li><a href="./reserve-list.php">예약 내역 관리</a></li>
							<li><a href="./reserve-calendar.php">캘린더</a></li>
							<li><a href="./reserve-cancel.php">취소 승인 관리</a></li>
							<li><a href="./reserve-using.php">객실 배정 관리</a></li>
						</ul>
					</div>
				</li>
				<li class="lm-act">
					<p class="lm-big">결제 관리</p>
					<div class="lm-list">
						<ul>
							<li><a href="./reserve-pay.php">결제 관리</a></li>
							<li><a href="./reserve-pg.php">PG결제 관리</a></li>
						</ul>
					</div>
				</li>
				<li class="lm-act">
					<p class="lm-big active">설문 관리</p>
					<div class="lm-list">
						<ul>
							<li class="active"><a href="./reserve-survey.php">설문 등록</a></li>
							<li><a href="./reserve-survey-manage.php">설문 관리</a></li>
							<li><a href="./reserve-survey-result.php">결과 관리</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
		<div class="center-con">
			<div class="cc-title">
				<div>설문 등록</div>
			</div>
			<div class="cc-con">
                <form name="frm" action="reserve-survey_write_action.php" target="_fra_admin" method="post"  enctype="multipart/form-data">
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
												<input type="text" name="surveytitle">
											</td>
										</tr>
										<tr>
											<th>
												<span>기업명</span>
											</th>
											<td>
                                                <input type="hidden" name="cidx"  id="cidx" value="" onChange="setResortInfo();" HNAME="기업명"  REQUIRED>
									            <span id="cName"></span><button class="com-mo" type="button" onClick="searchCompay();" >검색</button>
											</td>
										</tr>
										<tr>
											<th>
												<span>담당자명</span>
											</th>
											<td>
												<input type="text" id="dname" readonly>
											</td>
										</tr>
										<tr>
											<th>
												<span>연락처</span>
											</th>
											<td>
												<input maxlength="4" type="text" class="only-num" id="tel1" readonly>
												<span class="hypen">-</span>
												<input maxlength="4" type="text" class="only-num" id="tel2" readonly>
												<span class="hypen">-</span>
												<input maxlength="4" type="text" class="only-num" id="tel3" readonly>
											</td>
										</tr>
										<tr>
											<th>
												<span>핸드폰</span>
											</th>
											<td>
												<input maxlength="4" type="text" class="only-num" id="hp1" readonly>
												<span class="hypen">-</span>
												<input maxlength="4" type="text" class="only-num" id="hp2" readonly>
												<span class="hypen">-</span>
												<input maxlength="4" type="text" class="only-num" id="hp3" readonly>
											</td>
										</tr>
										<tr>
											<th>
												<span>이메일</span>
											</th>
											<td>
												<input type="text" id="email1" readonly>
												<span class="gol">@</span>
												<input type="text" id="email2" readonly>
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
                                    if($idx){

                                        $query2 = "select * from tb_survey_question a where 1=1 and flag = 10 and cidx = '".$idx."' and del_yn ='N' ";

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
                                    }else{
                                    ?>
									<div class="survey-line manjok">
										<button class="remove-btn" type="button">삭제</button>
										<input type="text" name="question[]">
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
                                if($idx){
                                    $query3 = "select * from tb_survey_question a where 1=1 and flag = 20 and cidx = '".$idx."' and del_yn ='N' ";

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

                                                $query4 = "select * from tb_survey_choice a where 1=1 and cidx = '".$idx."' and qidx = '".$row3[qidx]."' ";

                                                $result4 = mysqli_query($gconnet,$query4);
                                                
                                                for($z=0; $z<6; $z++)
                                                {
                                                $row4 = mysqli_fetch_array($result4);

                                            ?>
                                            <div class="sur-l sur-l2">
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
                                }else{
                                ?>


									<div class="survey-line">
										<button class="remove-btn" type="button">삭제</button>
										<div class="sel-survey">
											<input type="text" class="ex-title" placeholder="제목을 입력해주세요." name="title[]">
											<div class="ex-check">
												<div class="sur-l sur-l1">
													<input type="text" placeholder="선택지를 입력하세요." class="con" name="content1">
												</div>
												<div class="sur-l sur-l2">
													<input type="text" placeholder="선택지를 입력하세요." class="con" name="content2">
												</div>
												<div class="sur-l sur-l3">
													<input type="text" placeholder="선택지를 입력하세요." class="con" name="content3">
												</div>
												<div class="sur-l sur-l4">
													<input type="text" placeholder="선택지를 입력하세요." class="con" name="content4">
												</div>
												<div class="sur-l sur-l5">
													<input type="text" placeholder="선택지를 입력하세요." class="con" name="content5">
												</div>
												<div class="sur-l sur-l6">
													<input type="text" placeholder="선택지를 입력하세요." class="con" name="content6">
												</div>
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
                                if($idx){

                                $query5 = "select * from tb_survey_question a where 1=1 and flag = 30 and cidx = '".$idx."' and del_yn ='N' ";

                                $result5 = mysqli_query($gconnet,$query5);
                                for($w=0; $w<mysqli_num_rows($result5); $w++)
                                {
                                $row5 = mysqli_fetch_array($result5);

                                ?>
                                <div class="survey-line">
                                    <input class="all-man" type="text"  name="manjok" value="<?=$row5[question]?>">
                                </div>
                                <?php
                                    }
                                }else{
                                ?>
									<div class="survey-line">
										<input class="all-man" type="text"  name="manjok">
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
                                if($idx){

                                $query6 = "select * from tb_survey_question a where 1=1 and flag = 40 and cidx = '".$idx."' and del_yn ='N' ";

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
                                }else{
                                ?>
									<div class="survey-line">
										<input class="question" type="text" name="jugwan">
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
							<!--<button type="button">취소</button>-->
							<button type="button" onclick="go_submit();">등록</button>
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
								<button type="button">등록</button>
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
            //oEditors.getById["editor"].exec("UPDATE_CONTENTS_FIELD", []);
            frm.submit();
        } else {
            false;
        }
    }
		
		$(document).ready(function () {	
			$('select').wSelect();
		});
		

		$(document).ready(function(){
			// Also see: https://www.quirksmode.org/dom/inputfile.php

			var inputs = document.querySelectorAll('.file-input')

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
		});


		
	</script>
	
	
	
	<!-- 테이블 sort 선언	-->
	
	
	<script>
		/*$(document).ready(function(){
			
			$('.view-t').on('click',function(){
					if( $(this).parents('.view').hasClass('on') ){
						$(this).parents('.view').removeClass('on');
					}else{
						$('.view').removeClass('on');
						$(this).parents('.view').addClass('on');
					}
				});
		});*/
	
	</script>
</body>
<iframe name="_fra_admin" width="500" height="200" style="display:<?=$show_iframe==TRUE?"":"none"?>"></iframe>
</html>