<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$mem_info_sql = "select user_id,nation,membership_no,sns_kind from member_info where 1 and idx = '".$_SESSION['member_coinc_idx']."' and del_yn='N'";
$mem_info_query = mysqli_query($gconnet,$mem_info_sql);
if(mysqli_num_rows($mem_info_query) == 0){
	error_popup("There are no registered members.");
}
$mem_info_row = mysqli_fetch_array($mem_info_query);

$idx = $_SESSION['member_coinc_idx'];
$user_id = trim($mem_info_row['user_id']);
$nation = trim($mem_info_row['nation']);
$membership_no = trim($mem_info_row['membership_no']);
$sns_kind = trim($mem_info_row['sns_kind']);

$sql_pre2 = "select idx from member_register_survey where 1 and member_idx='".$_SESSION['member_coinc_idx']."'"; 
$result_pre2  = mysqli_query($gconnet,$sql_pre2);
if(mysqli_num_rows($result_pre2) > 0){
	error_popup("Already subscribed to the online panel.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/sub.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/nice-select.css">
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="../css/wSelect.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1.0">
    <title>K-DOT</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="../js/menu.js"></script>
	<script src="../js/jquery.nice-select.js"></script>
	<script src="../js/jquery-ui.js"></script>
	<script src="../js/jquery.mCustomScrollbar.js"></script>
	<script src="../js/common.js"></script>
	<script src="../js/common_js_eng.js"></script>
	<script src="../js/wSelect.js"></script>
</head>
<body>
	<div id="panel-join">
		<section class="joina">
			<div class="joina-wrap">
				<div class="joina-logo">
					<a href="../index.html">
						<img src="../img/logo.png" alt="kdot 로고">
					</a>
				</div>
				<div class="container w400">
						<div class="cnt-tit">
							<h2>K-DOD ONLINE PANEL PROFILE SURVEY</h2>

				<div class="joina-sel sel">
					   <select id="demo" tabindex="1" onchange="set_nation(this);">
						<option value="01" <?if($mem_info_row[nation]=="01") echo 'selected="selected"';?> data-icon="../img/korea.png">한국어</option>
						<option value="02" <?if($mem_info_row[nation]=="02") echo 'selected="selected"';?> data-icon="../img/america.png">English</option>
						<option value="03" <?if($mem_info_row[nation]=="03") echo 'selected="selected"';?> data-icon="../img/my.png">မြန်မာဘာသာ</option>
						<option value="04" <?if($mem_info_row[nation]=="04") echo 'selected="selected"';?> data-icon="../img/cb.png">ភាសាខ្មែរ</option>
					  </select>
					  <script type="text/javascript">
						$('select').wSelect();
					  </script>
<!--
							<div class="joina-sel sel">
							  <div class="select" data-role="selectBox">
							    <span date-value="optValue" class="selected-option"></span>
								 옵션 영역 
								<ul class="hide">
						<?if($nation == "01"){?>
                          	<li>
                                <span class="eng" onclick="set_nation('01');">English</span>
                            </li>
                            <li>
                                <span class="myan" onclick="set_nation('02');">မြန်မာဘာသာ</span>
                            </li>
                            <li>
                                <span class="cam" onclick="set_nation('03');">ភាសាខ្មែរ</span>
                            </li>
                            <li>
                                <span class="kr" onclick="set_nation('04');">한국어</span>
                            </li>
						<?}elseif($nation == "02"){?>
                          	<li>
                                <span class="myan" onclick="set_nation('02');">မြန်မာဘာသာ</span>
                            </li>
							<li>
                                <span class="eng" onclick="set_nation('01');">English</span>
                            </li>
                            <li>
                                <span class="cam" onclick="set_nation('03');">ភាសាខ្មែរ</span>
                            </li>
                            <li>
                                <span class="kr" onclick="set_nation('04');">한국어</span>
                            </li>
						<?}elseif($nation == "03"){?>
							 <li>
                                <span class="cam" onclick="set_nation('03');">ភាសាខ្មែរ</span>
                            </li>
                          	<li>
                                <span class="eng" onclick="set_nation('01');">English</span>
                            </li>
                            <li>
                                <span class="myan" onclick="set_nation('02');">မြန်မာဘာသာ</span>
                            </li>
                            <li>
                                <span class="kr" onclick="set_nation('04');">한국어</span>
                            </li>
						<?}elseif($nation == "04"){?>
							<li>
                                <span class="kr" onclick="set_nation('04');">한국어</span>
                            </li>
							<li>
                                <span class="eng" onclick="set_nation('01');">English</span>
                            </li>
                            <li>
                                <span class="myan" onclick="set_nation('02');">မြန်မာဘာသာ</span>
                            </li>
                            <li>
                                <span class="cam" onclick="set_nation('03');">ភាសាខ្មែរ</span>
                            </li>
						<?} else {?>
							<li>
                                <span class="eng" onclick="set_nation('01');">English</span>
                            </li>
                            <li>
                                <span class="myan" onclick="set_nation('02');">မြန်မာဘာသာ</span>
                            </li>
                            <li>
                                <span class="cam" onclick="set_nation('03');">ភាសាខ្មែរ</span>
                            </li>
                            <li>
                                <span class="kr" onclick="set_nation('04');">한국어</span>
                            </li>
                        <?}?>	
								</ul>
							 </div>
							</div>
				
-->
							<script>
								$(document).ready(function(){
									$('.select').on('fousin',function(){
										$(this).addClass('in');
									});
								});
							</script>
						</div>
			<script>
				function go_submit() {
					var check = chkFrm('frm');
					if(check) {
						frm.submit();
					} else {
						false;
					}
				}

				function set_nation(str){
					document.frm.nation.value=str;
				}
			</script>

		<form action="panel-join_action.php" name="frm" method="post" target="_self">
		<input type="hidden" name="member_idx" value="<?=$idx?>">
		<input type="hidden" name="user_id" value="<?=$user_id?>">
		<input type="hidden" name="nation" value="<?=$nation?>">
		<input type="hidden" name="membership_no" value="<?=$membership_no?>">
		<input type="hidden" name="sns_kind" value="<?=$sns_kind?>">
		<input type="hidden" name="attach_count_1" id="attach_count_1" value="1"/>
 
						<div class="content membership">
							<h2><span class="color">Part 1.</span> Your K-DOD Membership Information</h2>

							<div class="area">
								<h3>Gender</h3>
								<div class="gender radio-sel">
									<span><input type="radio" id="male"  name="gender" value="1" required="yes" message="Gender"><label for="male">male</label></span>
									<span><input type="radio" id="femal" name="gender" value="2" required="yes" message="Gender"><label for="femal">female</label></span>
								</div>
							</div>

							<div class="area">							
								<h3>Birth Date, Month, Year</h3>
								<div class="date-sel">
									<input type="text" name="birthday" id="datepicker" class="datepicker" required="yes" message="Birth Date, Month, Year" autocomplete="off">
								</div>
							</div>

							<div class="area">
								<h3>Country</h3>
								<div class="country-sel niceSct-sel">
									<select name="country" id="country" required="yes" message="Country" onchange="view_count_other(this);">
										<option></option><!--비워놓는 영역 화면상 안보임-->
										<option value="Myanmar">Myanmar</option>
										<option value="Cambodia">Cambodia</option>
										<option value="Korean">Korean</option>
										<option value="Other">Other</option>
									</select>
								</div>
							</div>
							<div id="count_txt_area" style="display:none;padding-top:10px;">
								Other : <input type="text" name="count_txt" id="count_txt" style="text-align:center;border:1px solid #949494;border-radius:5px;width:200px;height:40px;line-height:40px;margin-right:10px;">
							</div>
						</div><!--//membership end-->

						<div class="content family">
							<h2><span class="color">Part 2.</span> Family Info</h2>

							<div class="area area01">
								<h3>1. Marriage Status</h3>
								<div class="MarriageStatus-sel niceSct-sel">
									<select name="marriage_state" id="MarriageStatus" required="yes" message="Marriage Status">
										<option></option><!--비워놓는 영역 화면상 안보임-->
										<option value="Single">Single</option>
										<option value="Married">Married</option>
									</select>
								</div>
							</div>

							<div class="area area02">
								<h3>2. Do you have children?</h3>
								<div class="children radio-sel ">
									<span><input type="radio" id="yes" name="children_have" value="YES" required="yes" message="Do you have children?"><label for="yes">yes</label></span>
									<span><input type="radio" id="no" name="children_have" value="NO" required="yes" message="Do you have children?"><label for="no">no</label></span>
								</div>
							</div>
							
							<div class="area area03">
								<h3>3. How many Family members do you live with ?</h3>
								<div class="family-join">
									<p class="if">※ if answer is 1, go to question 5</p>
									<div class="input-wrap"><input type="text" name="family_members_live" required="yes" message="How many Family members do you live with ?"><label>person(s)</label></div>
								</div>
								<div class="guide-box">
									<p>Guide</p>
									-Please include yourself in the count (If you live alone, please input [1])<br>
									-Family members : Grand Parents, Parents, Spouse, Siblings, Children, Relatives only
								</div>
							</div>

							<div class="area area04">
								<h3>4. If you have family members who live with you, who are they? and when is their birth year?</h3>

								<div class="sel-wrap">
									<div class="relationship inner-box">
										<p>Relationship</p>
										<div class="niceSct-sel">
											<select name="family_members_relationship[]" id="Relationship">
												<option></option><!--비워놓는 영역 화면상 안보임-->
												<option value="Father">Father</option>
												<option value="Mother">Mother</option>
												<option value="Spouse">Spouse</option>
												<option value="Brother">Brother</option>
												<option value="Sister">Sister</option>
												<option value="Grand mother">Grand mother</option>
												<option value="Grand father">Grand father</option>
												<option value="Son">Son</option>
												<option value="Daughter">Daughter</option>
												<option value="Relative">Relative</option>
												<option value="Other">Other</option>
											</select>
										</div>
									</div>
									<div class="birthYear inner-box">
										<p>BirthYear</p>
										<div class="niceSct-sel">
											<!--<input type="text" name="family_members_birth_year[]" id="birth" onClick="new CalendarFrame.Calendar(this)" style="height:40px;" autocomplete="off">-->
											<select name="family_members_birth_year[]" id="birth">
												<option value="">Select</option>
											<?
												$sty = date("Y")-90;
												$edy = date("Y");
												for($i=$sty; $i<=$edy; $i++){
											?>
												<option value="<?=$i?>"><?=$i?></option>
											<?}?>
											</select>
										</div>
									</div>
								</div>
								
								<div id="addedFormDiv_1"></div>
								<button type="button" class="btn btn02" onclick="javascript:addForm_1();">+ add</button>
								<button type="button" class="btn btn02" onclick="javascript:delForm_1();" style="margin-right:10px;">- del</button>
							</div>
						</div><!--//family end-->

						<div class="content geographic">
							<h2><span class="color">Part 3.</span> Geographic Info</h2>
							<div class="area area05">
								<h3>5. Do you live in city area or rural area?</h3>
								<div class="live-in radio-sel">
									<span><input type="radio" id="cityArea" name="live_area" value="City"><label for="cityArea">city area</label></span>
									<span><input type="radio" id="ruralArea" name="live_area" value="Rural"><label for="ruralArea">rural area</label></span>
								</div>
							</div>
							
							<div class="area">							
								<h3>6. Where is your region?</h3>
								<div>
									<input type="text" name="region_1" id="region01" style="text-align:center;border:1px solid #949494;border-radius:5px;width:200px;height:40px;line-height:40px;margin-right:10px;">
									&nbsp;
									<input type="text" name="region_2" id="region01" style="text-align:center;border:1px solid #949494;border-radius:5px;width:200px;height:40px;line-height:40px;margin-right:10px;">
									
								</div>
							</div>
						</div><!--//geographic end-->

						<div class="content personal">
							<h2><span class="color">Part 4.</span> Personal Info</h2>
							<div class="area area07">
								<h3>7. Final Education?</h3>
								<div class="niceSct-sel">
									<select name="final_education" id="finalEducation">
										<option></option><!--비워놓는 영역 화면상 안보임-->
										<option value="No Education">No Education</option>
										<option value="Elementary School">Elementary School</option>
										<option value="Mid School">Middle School</option>
										<option value="High School">High School</option>
										<option value="University (Bachelor)">University (Bachelor)</option>
										<option value="Post Graduate (Master)">Post Graduate (Master)</option>
										<option value="Doctor’s Degree (Ph.D)">Doctor’s Degree (Ph.D)</option>
									</select>
								</div>
								<div class="guide-box">
									<p>Guide</p>
									If you are a student, please indicate your current school
								</div>
							</div>
							<div class="area area08">
								<h3>8. Your Job?</h3>
								<div class="niceSct-sel">
									<select name="job" id="job" onchange="view_job_other(this);">
										<option></option><!--비워놓는 영역 화면상 안보임-->
										<option value="No Job">No Job</option>
										<option value="Student">Student</option>
										<option value="Office Worker">Office Worker</option>
										<option value="Labor (factory, manufacturing site, construction sites,..)">Labor (factory, manufacturing site, construction sites,..)</option>
										<option value="Professional Worker (hospital doctor, lawyer,..)">Professional Worker (hospital doctor, lawyer,..)</option>
										<option value="Self-employed (business owner)">Self-employed (business owner)</option>
										<option value="Part-time, Freelancer,..">Part-time, Freelancer,..</option>
										<option value="Farmer, Fisherman, Miner,…">Farmer, Fisherman, Miner,…</option>
										<option value="Housewife">Housewife</option>
										<option value="Other">Other</option>
									</select>
								</div>
								<div id="job_txt_area" style="display:none;padding-top:10px;">
									Other : <input type="text" name="job_txt" id="job_txt" style="text-align:center;border:1px solid #949494;border-radius:5px;width:200px;height:40px;line-height:40px;margin-right:10px;">
								</div>
							</div>
							<div class="area area09">
								<h3>9. Monthly Family Income</h3>
								<div class="niceSct-sel">
									<select name="family_income" id="Income">
										<option></option><!--비워놓는 영역 화면상 안보임-->
										<option value="~300 USD">~300 USD</option>
										<option value="~500 USD">~500 USD</option>
										<option value="~1,000 USD">~1,000 USD</option>
										<option value="~2,000 USD">~2,000 USD</option>
										<option value="~3,000 USD">~3,000 USD</option>
										<option value="~4,000 USD">~4,000 USD</option>
										<option value="~5,000 USD">~5,000 USD</option>
										<option value="5,001 USD or above">5,001 USD or above</option>
									</select>
								</div>
							</div>
							<div class="area area10">
								<h3>10. Religion</h3>
								<div class="niceSct-sel">
									<select name="religion" id="religion" onchange="view_relig_other(this);">
										<option></option><!--비워놓는 영역 화면상 안보임-->
										<option value="Buddhism">Buddhism</option>
										<option value="Christian">Christian</option>
										<option value="Catholic">Catholic</option>
										<option value="Islam">Islam</option>
										<option value="Hinduism">Hinduism</option>
										<option value="Judaism">Judaism</option>
										<option value="Confucianism">Confucianism</option>
										<option value="No Religion">No Religion</option>
										<option value="Other">Other</option>
									</select>
								</div>
								<div id="relig_txt_area" style="display:none;padding-top:10px;">
									Other : <input type="text" name="religion_txt" id="religion_txt" style="text-align:center;border:1px solid #949494;border-radius:5px;width:200px;height:40px;line-height:40px;margin-right:10px;">
								</div>
							</div>
						</div><!--//personal end-->

						<button type="button" class="btn btn02 sumit-btn" onclick="javascript:go_submit();">submit</button>
					</div>
					</form>
			</div>
		</section>
<script language="JavaScript"> 

var count_1 = 1;          
function addForm_1(){
	var addedFormDiv = document.getElementById("addedFormDiv_1");
	var str = "";
	str+='<div class="sel-wrap"><div class="relationship inner-box"><p>Relationship</p><div class="niceSct-sel"><select name="family_members_relationship[]" id="Relationship" style="height:40px;width:98%;margin-top:8px;"><option></option><option value="Father">Father</option><option value="Mother">Mother</option><option value="Spouse">Spouse</option><option value="Brother">Brother</option><option value="Sister">Sister</option><option value="Grand mother">Grand mother</option><option value="Grand father">Grand father</option><option value="Son">Son</option><option value="Daughter">Daughter</option><option value="Relative">Relative</option><option value="Other">Other</option></select></div></div><div class="birthYear inner-box"><p>BirthYear</p><div class="niceSct-sel"><select name="family_members_birth_year[]" id="birth" style="height:40px;width:98%;margin-top:8px;"><option value="">Select</option><?$sty = date("Y")-90; $edy = date("Y"); for($i=$sty; $i<=$edy; $i++){?><option value="<?=$i?>"><?=$i?></option><?}?></select></div></div></div>'; // 추가할 폼(에 들어갈 HTML)

	//str += get_add_data("inner_panel_join_area4.php",""); 

	var addedDiv = document.createElement("div"); // 폼 생성
    addedDiv.id = "added_1_"+count_1; // 폼 Div에 ID 부 여 (삭제를 위해)
    addedDiv.innerHTML  = str; // 폼 Div안에 HTML삽입
    addedFormDiv.appendChild(addedDiv); // 삽입할 DIV에 생성한 폼 삽입
    count_1++;
	frm.attach_count_1.value = count_1;
}

function delForm_1(){
  var addedFormDiv = document.getElementById("addedFormDiv_1");
   if(count_1 >1){ // 현재 폼이 두개 이상이면
      var addedDiv = document.getElementById("added_1_"+(--count_1));
       // 마지막으로 생성된 폼의 ID를 통해 Div객체를 가져옴
        addedFormDiv.removeChild(addedDiv); // 폼 삭제 
		frm.attach_count_1.value = count_1;
    }else{ // 마 지막 폼만 남아있다면
      //  document.baseForm.reset(); // 폼 내용 삭제
     }
}

function get_add_data(url,params){
	if(params != ""){
		url = url + "?" + encodeURI(params);
	}
	$.ajax({
		type: "get",
		url: url,
		dataType: "html"
	}).done(function(data){
		return (data);
	});
}

function view_job_other(z){
	var tmp = z.options[z.selectedIndex].value; 
	if(tmp == "Other"){
		$("#job_txt_area").show();
	} else {
		$("#job_txt_area").hide();
	}
}

function view_relig_other(z){
	var tmp = z.options[z.selectedIndex].value; 
	if(tmp == "Other"){
		$("#relig_txt_area").show();
	} else {
		$("#relig_txt_area").hide();
	}
}
	
function view_count_other(z){
	var tmp = z.options[z.selectedIndex].value; 
	if(tmp == "Other"){
		$("#count_txt_area").show();
	} else {
		$("#count_txt_area").hide();
	}
}
</script>
		 <script>

            const body = document.querySelector('body');
            const select = document.querySelector(`[data-role="selectBox"]`);
            const values = select.querySelector(`[date-value="optValue"]`);
            const option = select.querySelector('ul');
            const opts = option.querySelectorAll('li');

            /* 셀렉트영역 클릭 시 옵션 숨기기, 보이기 */
            function selects(e){
            e.stopPropagation();
            option.setAttribute('style',`top:${select.offsetHeight}px`)
            if(option.classList.contains('hide')){
            select.classList.add('on');
            option.classList.remove('hide');
            option.classList.add('show');
            }else{
            option.classList.add('hide');
            option.classList.remove('show');
            select.classList.remove('on');
            }
            selectOpt();
            }

            /* 옵션선택 */
            function selectOpt(){
            opts.forEach(opt=>{
            const innerValue = opt.innerHTML;
            function changeValue(){
            values.innerHTML = innerValue;
            }
            opt.addEventListener('click',changeValue)
            });
            }

            /* 렌더링 시 옵션의 첫번째 항목 기본 선택 */
            function selectFirst(){
            const firstValue = opts[0].innerHTML;
            values.innerHTML = `${firstValue}`
            }

            /* 옵션밖의 영역(=바디) 클릭 시 옵션 숨김 */
            function hideSelect(){
            if(option.classList.contains('show')){
            option.classList.add('hide');
            option.classList.remove('show');
            select.classList.remove('on');
            }
            }

            selectFirst();
            select.addEventListener('click',selects);
            body.addEventListener('click',hideSelect);
        </script>
        
		<script>
			$(document).ready(function() {
		  $('select').niceSelect();
		});
			
		</script>
		<script>
			$(".datepicker").datepicker({
				 changeYear:true,
				changeMonth:true,
				minDate: '-90y',
				yearRange: 'c-90:c',
				dateFormat:'yy-mm-dd',
				showMonthAfterYear:true,
				constrainInput: true,
				dayNamesMin: ['일','월', '화', '수', '목', '금', '토' ],
				monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월']
			});
		</script>
		<!--   스크롤 스크립  -->
	    <script>
    
        
        $(document).ready(function(){

            $(".content-rd").mCustomScrollbar({
                    theme:"light-3"
                });
            });
    </script>
	</div>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_bottom.php"; // 공통함수 인클루드 ?>
</body>
</html>