<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/check_login.php"; ?>
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
    <meta name="viewport" content="initial-scale=1, maximum-scale=1.0">
    <meta charset="UTF-8">
    <title>K-DOT</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/menu.js"></script>
    <script src="../js/jquery.nice-select.js"></script>
    <script src="../js/jquery-ui.js"></script>
    <script src="../js/jquery.mCustomScrollbar.js"></script>
    <script src="../js/common.js"></script>
    <script src="../js/common_js.js"></script>
</head>

<body>
<?
$idx = $_SESSION['member_coinc_idx'];
$sel_sql = "select * from member_register_survey where member_idx='".$idx."'";
$sel_res =  mysqli_query($gconnet,$sel_sql);
$sel_row =  mysqli_fetch_array($sel_res);
?>
    <div id="panel-join">
        <section class="joina">
            <div class="joina-wrap">
                <div class="joina-logo">
                    <a href="../index.php">
                        <img src="../img/logo.png" alt="kdot 로고">
                    </a>
                </div>
                <div class="container w400">
                    <div class="cnt-tit">
                        <h2>K-DOD ONLINE PANEL PROFILE SURVEY</h2>
                        <script>
                            function go_submit() {
                                var check = chkFrm('frm');
                                if (check) {
                                    frm.submit();
                                } else {
                                    false;
                                }
                            }

                        </script>

                        <form action="panel_update_action.php" name="frm" method="post" target="_self">
                            <input type="hidden" name="member_idx" value="<?=$idx?>">
                            <div class="content membership">
                                <h2><span class="color">Part 1.</span> Your K-DOD Membership Information</h2>

                                <div class="area">
                                    <h3>Gender</h3>
                                    <div class="gender radio-sel">
                                        <span><input type="radio" id="male" name="gender" value="1" required="yes" message="Gender" <?if($sel_row[gender]=="1" ) echo 'checked="checked"' ;?>><label for="male">male</label></span>
                                        <span><input type="radio" id="femal" name="gender" value="2" required="yes" message="Gender" <?if($sel_row[gender]=="2" ) echo 'checked="checked"' ;?>><label for="femal">female</label></span>
                                    </div>
                                </div>

                                <div class="area">
                                    <h3>Birth Date, Month, Year</h3>
                                    <div class="date-sel">
                                        <input type="text" name="birthday" id="datepicker" class="datepicker" required="yes" message="Birth Date, Month, Year" autocomplete="off" value="<?=$sel_row[birthday]?>">
                                    </div>
                                </div>

                                <div class="area">
                                    <h3>Country</h3>
                                    <div class="country-sel niceSct-sel">
                                       <select name="country" id="country" required="yes" message="Country">
											<option></option><!--비워놓는 영역 화면상 안보임-->
											<option value="Myanmar" <?=$sel_row[country]=="Myanmar"?"selected":""?> >Myanmar</option>
											<option value="Cambodia"  <?=$sel_row[country]=="Cambodia"?"selected":""?>>Cambodia</option>
											<option value="English"  <?=$sel_row[country]=="English"?"selected":""?>>English</option>
											<option value="Korean"  <?=$sel_row[country]=="Korean"?"selected":""?>>Korean</option>
										</select>
                                    </div>
                                </div>
                            </div>
                            <!--//membership end-->

                            <div class="content family">
                                <h2><span class="color">Part 2.</span> Family Info</h2>

                                <div class="area area01">
                                    <h3>1. Marriage Status</h3>
                                    <div class="MarriageStatus-sel niceSct-sel">
                                        <select name="marriage_state" id="MarriageStatus" required="yes" message="Marriage Status">
                                            <option></option>
                                            <!--비워놓는 영역 화면상 안보임-->
                                            <option value="Single" <?if($sel_row[marriage_state]=="Single" ) echo 'selected="selected"' ;?>>Single</option>
                                            <option value="Married" <?if($sel_row[marriage_state]=="Married" ) echo 'selected="selected"' ;?>>Married</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="area area02">
                                    <h3>2. Do you have children?</h3>
                                    <div class="children radio-sel ">
                                        <span><input type="radio" id="yes" name="children_have" value="YES" required="yes" message="Do you have children?" <?if($sel_row[children_have]=="YES" ) echo 'checked="checked"' ;?>><label for="yes">yes</label></span>
                                        <span><input type="radio" id="no" name="children_have" value="NO" required="yes" message="Do you have children?" <?if($sel_row[children_have]=="NO" ) echo 'checked="checked"' ;?>><label for="no">no</label></span>
                                    </div>
                                </div>

                                <div class="area area03">
                                    <h3>3. How many Family members do you live with ?</h3>
                                    <div class="family-join">
                                        <p class="if">※ if answer is 1, go to question 5</p>
                                        <div class="input-wrap"><input type="text" name="family_members_live" required="yes" message="How many Family members do you live with ?" value="<?=$sel_row[family_members_live]?>"><label>person(s)</label></div>
                                    </div>
                                    <div class="guide-box">
                                        <p>Guide</p>
                                        -Please include yourself in the count (If you live alone, please input [1])<br>
                                        -Family members : Grand Parents, Parents, Spouse, Siblings, Children, Relatives only
                                    </div>
                                </div>

                                <div class="area area04">
                                    <h3>4. If you have family members who live with you, who are they? and when is their birth year?</h3>
                                    <?
								$f_relastion_name_arr = explode(",",$sel_row[family_members_relationship]);
								$f_relastion_birth_arr = explode(",",$sel_row[family_members_birth_year]);
								$f_rel_cnt = sizeof($f_relastion_name_arr);
							?>
                                    <input type="hidden" name="attach_count_1" id="attach_count_1" value="<?=$f_rel_cnt?>" />
                                    <?
								for($i=0; $i<$f_rel_cnt; $i++){
									$f_rel_name = $f_relastion_name_arr[$i];
									$f_rel_birth = $f_relastion_birth_arr[$i];
							?>
                                    <div class="sel-wrap">
                                        <div class="relationship inner-box">
                                            <p>Relationship</p>
                                            <div class="niceSct-sel">

                                                <select name="family_members_relationship[]" id="Relationship">
                                                    <option></option>
                                                    <!--비워놓는 영역 화면상 안보임-->
                                                    <option value="Father" <?if($f_rel_name=='Father' )echo 'selected="selected"' ;?>>Father</option>
                                                    <option value="Mother" <?if($f_rel_name=='Mother' )echo 'selected="selected"' ;?>>Mother</option>
                                                    <option value="Spouse" <?if($f_rel_name=='Spouse' )echo 'selected="selected"' ;?>>Spouse</option>
                                                    <option value="Brother" <?if($f_rel_name=='Brother' )echo 'selected="selected"' ;?>>Brother</option>
													<option value="Sister" <?if($f_rel_name =='Sister')echo 'selected="selected"';?>>Sister</option>
                                                    <option value="Grand mother" <?if($f_rel_name=='Grand mother' )echo 'selected="selected"' ;?>>Grand mother</option>
                                                    <option value="Grand father" <?if($f_rel_name=='Grand father' )echo 'selected="selected"' ;?>>Grand father</option>
                                                    <option value="Son" <?if($f_rel_name=='Son' )echo 'selected="selected"' ;?>>Son</option>
                                                    <option value="Daughter" <?if($f_rel_name=='Daughter' )echo 'selected="selected"' ;?>>Daughter</option>
                                                    <option value="Relative" <?if($f_rel_name=='Relative' )echo 'selected="selected"' ;?>>Relative</option>
                                                    <option value="Other" <?if($f_rel_name=='Other' )echo 'selected="selected"' ;?>>Other</option>
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
                                    <?}?>
                                    <div id="addedFormDiv_1"></div>
                                    <button type="button" class="btn btn02" onclick="javascript:addForm_1();">+ add</button>
                                    <button type="button" class="btn btn02" onclick="javascript:delForm_1();" style="margin-right:10px;">- del</button>
                                </div>
                            </div>
                            <!--//family end-->
                            <div class="content geographic">
                                <h2><span class="color">Part 3.</span> Geographic Info</h2>
                                <div class="area area05">
                                    <h3>5. Do you live in city area or rural area?</h3>
                                    <div class="live-in radio-sel">
                                        <span><input type="radio" id="cityArea" name="live_area" value="City" <?if($sel_row[live_area]=="City" ) echo 'checked="checked"' ;?>><label for="cityArea">city area</label></span>
                                        <span><input type="radio" id="ruralArea" name="live_area" value="Rural" <?if($sel_row[live_area]=="Rural" ) echo 'checked="checked"' ;?>><label for="ruralArea">rural area</label></span>
                                    </div>
                                </div>

                                <div class="area">
                                    <h3>6. Where is your region?</h3>
                                    <div>
                                        <input type="text" name="region_1" id="region01" style="text-align:center;border:1px solid #949494;border-radius:5px;width:200px;height:40px;line-height:40px;margin-right:10px;" value="<?=$sel_row[region_1]?>">
                                        &nbsp;
                                        <input type="text" name="region_2" id="region01" style="text-align:center;border:1px solid #949494;border-radius:5px;width:200px;height:40px;line-height:40px;margin-right:10px;" value="<?=$sel_row[region_2]?>">
                                    </div>
                                </div>
                            </div>
                            <!--//geographic end-->

                            <div class="content personal">
                                <h2><span class="color">Part 4.</span> Personal Info</h2>
                                <div class="area area07">
                                    <h3>7. Final Education?</h3>
                                    <div class="niceSct-sel">
                                        <select name="final_education" id="finalEducation">
                                            <option></option>
                                            <!--비워놓는 영역 화면상 안보임-->
                                            <option value="No Education" <?if($sel_row[final_education]=="No Education" ) echo 'selected="selected"' ;?>>No Education</option>
                                            <option value="Elementary School" <?if($sel_row[final_education]=="Elementary School" ) echo 'selected="selected"' ;?>>Elementary School</option>
                                            <option value="Middle School" <?if($sel_row[final_education]=="Middle School" ) echo 'selected="selected"' ;?>>Middle School</option>
                                            <option value="High School" <?if($sel_row[final_education]=="High School" ) echo 'selected="selected"' ;?>>High School</option>
                                            <option value="University (Bachelor)" <?if($sel_row[final_education]=="University (Bachelor)" ) echo 'selected="selected"' ;?>>University (Bachelor)</option>
                                            <option value="Post Graduate (Master)" <?if($sel_row[final_education]=="Post Graduate (Master)" ) echo 'selected="selected"' ;?>>Post Graduate (Master)</option>
                                            <option value="Doctor’s Degree (Ph.D)" <?if($sel_row[final_education]=="Doctor’s Degree (Ph.D)" ) echo 'selected="selected"' ;?>>Doctor’s Degree (Ph.D)</option>
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
                                            <option></option>
                                            <!--비워놓는 영역 화면상 안보임-->
                                            <option value="No Job" <?if($sel_row[job]=="No Job" ) echo 'selected="selected"' ;?>>No Job</option>
                                            <option value="Student" <?if($sel_row[job]=="Student" ) echo 'selected="selected"' ;?>>Student</option>
                                            <option value="Office Worker" <?if($sel_row[job]=="Office Worker" ) echo 'selected="selected"' ;?>>Office Worker</option>
                                            <option value="Labor (factory, manufacturing site, construction sites,..)" <?if($sel_row[job]=="Labor (factory, manufacturing site, construction sites,..)" ) echo 'selected="selected"' ;?>>Labor (factory, manufacturing site, construction sites,..)</option>
                                            <option value="Professional Worker (hospital doctor, lawyer,..)" <?if($sel_row[job]=="Labor (factory, manufacturing site, construction sites,..)" ) echo 'selected="selected"' ;?>>Professional Worker (hospital doctor, lawyer,..)</option>
                                            <option value="Self-employed (business owner)" <?if($sel_row[job]=="Self-employed (business owner)" ) echo 'selected="selected"' ;?>>Self-employed (business owner)</option>
                                            <option value="Part-time, Freelancer,.." <?if($sel_row[job]=="Part-time, Freelancer,.." ) echo 'selected="selected"' ;?>>Part-time, Freelancer,..</option>
                                            <option value="Farmer, Fisherman, Miner,…" <?if($sel_row[job]=="Farmer, Fisherman, Miner,…" ) echo 'selected="selected"' ;?>>Farmer, Fisherman, Miner,…</option>
                                            <option value="Housewife" <?if($sel_row[job]=="Housewife" ) echo 'selected="selected"' ;?>>Housewife</option>
                                            <option value="Other" <?if($sel_row[job]=="Other" ) echo 'selected="selected"' ;?>>Other</option>
                                        </select>
                                    </div>
									<div id="job_txt_area" style="display:<?if($sel_row[job]=="Other"){}else{?>none<?}?>;padding-top:10px;">
										Other : <input type="text" name="job_txt" id="job_txt" style="text-align:center;border:1px solid #949494;border-radius:5px;width:200px;height:40px;line-height:40px;margin-right:10px;" value="<?=$sel_row[job_txt]?>">
									</div>
                                </div>
                                <div class="area area09">
                                    <h3>9. Monthly Family Income</h3>
                                    <div class="niceSct-sel">
                                        <select name="family_income" id="Income">
                                            <option></option>
                                            <!--비워놓는 영역 화면상 안보임-->
                                            <option value="~300 USD" <?if($sel_row[family_income]=="~300 USD" ) echo 'selected="selected"' ;?>>~300 USD</option>
                                            <option value="~500 USD" <?if($sel_row[family_income]=="~500 USD" ) echo 'selected="selected"' ;?>>~500 USD</option>
                                            <option value="~1,000 USD" <?if($sel_row[family_income]=="~1,000 USD" ) echo 'selected="selected"' ;?>>~1,000 USD</option>
                                            <option value="~2,000 USD" <?if($sel_row[family_income]=="~2,000 USD" ) echo 'selected="selected"' ;?>>~2,000 USD</option>
                                            <option value="~3,000 USD" <?if($sel_row[family_income]=="~3,000 USD" ) echo 'selected="selected"' ;?>>~3,000 USD</option>
                                            <option value="~4,000 USD" <?if($sel_row[family_income]=="~4,000 USD" ) echo 'selected="selected"' ;?>>~4,000 USD</option>
                                            <option value="~5,000 USD" <?if($sel_row[family_income]=="~5,000 USD" ) echo 'selected="selected"' ;?>>~5,000 USD</option>
                                            <option value="5,001 USD or above" <?if($sel_row[family_income]=="5,001 USD or above" ) echo 'selected="selected"' ;?>>5,001 USD or above</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="area area10">
                                    <h3>10. Religion</h3>
                                    <div class="niceSct-sel">
                                        <select name="religion" id="religion" onchange="view_relig_other(this);">
                                            <option></option>
                                            <!--비워놓는 영역 화면상 안보임-->
                                            <option value="Buddhism" <?if($sel_row[religion]=="Buddhism" ) echo 'selected="selected"' ;?>>Buddhism</option>
                                            <option value="Christian" <?if($sel_row[religion]=="Christian" ) echo 'selected="selected"' ;?>>Christian</option>
                                            <option value="Catholic" <?if($sel_row[religion]=="Catholic" ) echo 'selected="selected"' ;?>>Catholic</option>
                                            <option value="Islam" <?if($sel_row[religion]=="Islam" ) echo 'selected="selected"' ;?>>Islam</option>
                                            <option value="Hinduism" <?if($sel_row[religion]=="Hinduism" ) echo 'selected="selected"' ;?>>Hinduism</option>
                                            <option value="Judaism" <?if($sel_row[religion]=="Judaism" ) echo 'selected="selected"' ;?>>Judaism</option>
                                            <option value="Confucianism" <?if($sel_row[religion]=="Confucianism" ) echo 'selected="selected"' ;?>>Confucianism</option>
                                            <option value="No Religion" <?if($sel_row[religion]=="No Religion" ) echo 'selected="selected"' ;?>>No Religion</option>
                                            <option value="Other" <?if($sel_row[religion]=="Other" ) echo 'selected="selected"' ;?>>Other</option>
                                        </select>
                                    </div>
									<div id="relig_txt_area" style="display:<?if($sel_row[religion]=="Other"){}else{?>none<?}?>;padding-top:10px;">
										Other : <input type="text" name="religion_txt" id="religion_txt" style="text-align:center;border:1px solid #949494;border-radius:5px;width:200px;height:40px;line-height:40px;margin-right:10px;" value="<?=$sel_row[religion_txt]?>">
									</div>
                                </div>
                            </div>
                            <!--//personal end-->

                            <button type="button" class="btn btn02 sumit-btn" onclick="javascript:go_submit();">submit</button>
                    </div>
                    </form>
                </div>
        </section>
        <script language="JavaScript">
            var count_1 = 1;

            function addForm_1() {
                var addedFormDiv = document.getElementById("addedFormDiv_1");
                var str = "";
                str += '<div class="sel-wrap"><div class="relationship inner-box"><p>Relationship</p><div class="niceSct-sel"><select name="family_members_relationship[]" id="Relationship" style="height:40px;width:98%;margin-top:8px;"><option></option><option value="Father">Father</option><option value="Mother">Mother</option><option value="Spouse">Spouse</option><option value="Brother">Brother</option><option value="Sister">Sister</option><option value="Grand mother">Grand mother</option><option value="Grand father">Grand father</option><option value="Son">Son</option><option value="Daughter">Daughter</option><option value="Relative">Relative</option><option value="Other">Other</option></select></div></div><div class="birthYear inner-box"><p>BirthYear</p><div class="niceSct-sel"><select name="family_members_birth_year[]" id="birth" style="height:40px;width:98%;margin-top:8px;"><option value="">Select</option><?$sty = date("Y")-90; $edy = date("Y"); for($i=$sty; $i<=$edy; $i++){?><option value="<?=$i?>"><?=$i?></option><?}?></select></div></div></div>'; // 추가할 폼(에 들어갈 HTML)

                //str += get_add_data("inner_panel_join_area4.php",""); 

                var addedDiv = document.createElement("div"); // 폼 생성
                addedDiv.id = "added_1_" + count_1; // 폼 Div에 ID 부 여 (삭제를 위해)
                addedDiv.innerHTML = str; // 폼 Div안에 HTML삽입
                addedFormDiv.appendChild(addedDiv); // 삽입할 DIV에 생성한 폼 삽입
                count_1++;
                frm.attach_count_1.value = count_1;
            }

            function delForm_1() {
                var addedFormDiv = document.getElementById("addedFormDiv_1");
                if (count_1 > 1) { // 현재 폼이 두개 이상이면
                    var addedDiv = document.getElementById("added_1_" + (--count_1));
                    // 마지막으로 생성된 폼의 ID를 통해 Div객체를 가져옴
                    addedFormDiv.removeChild(addedDiv); // 폼 삭제 
                    frm.attach_count_1.value = count_1;
                } else { // 마 지막 폼만 남아있다면
                    //  document.baseForm.reset(); // 폼 내용 삭제
                }
            }

            function get_add_data(url, params) {
                if (params != "") {
                    url = url + "?" + encodeURI(params);
                }
                $.ajax({
                    type: "get",
                    url: url,
                    dataType: "html"
                }).done(function(data) {
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

        </script>
        <script>
            const body = document.querySelector('body');
            const select = document.querySelector(`[data-role="selectBox"]`);
            const values = select.querySelector(`[date-value="optValue"]`);
            const option = select.querySelector('ul');
            const opts = option.querySelectorAll('li');

            /* 셀렉트영역 클릭 시 옵션 숨기기, 보이기 */
            function selects(e) {
                e.stopPropagation();
                option.setAttribute('style', `top:${select.offsetHeight}px`)
                if (option.classList.contains('hide')) {
                    select.classList.add('on');
                    option.classList.remove('hide');
                    option.classList.add('show');
                } else {
                    option.classList.add('hide');
                    option.classList.remove('show');
                    select.classList.remove('on');
                }
                selectOpt();
            }

            /* 옵션선택 */
            function selectOpt() {
                opts.forEach(opt => {
                    const innerValue = opt.innerHTML;

                    function changeValue() {
                        values.innerHTML = innerValue;
                    }
                    opt.addEventListener('click', changeValue)
                });
            }

            /* 렌더링 시 옵션의 첫번째 항목 기본 선택 */
            function selectFirst() {
                const firstValue = opts[0].innerHTML;
                values.innerHTML = `${firstValue}`
            }

            /* 옵션밖의 영역(=바디) 클릭 시 옵션 숨김 */
            function hideSelect() {
                if (option.classList.contains('show')) {
                    option.classList.add('hide');
                    option.classList.remove('show');
                    select.classList.remove('on');
                }
            }

            selectFirst();
            select.addEventListener('click', selects);
            body.addEventListener('click', hideSelect);

        </script>

        <script>
            $(document).ready(function() {
                $('select').niceSelect();
            });

        </script>
        <script>
            $(".datepicker").datepicker({
                changeYear: true,
                changeMonth: true,
                minDate: '-90y',
                yearRange: 'c-90:c',
                dateFormat: 'yy-mm-dd',
                showMonthAfterYear: true,
                constrainInput: true,
                dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
                monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월']
            });

        </script>
        <!--   스크롤 스크립  -->
        <script>
            $(document).ready(function() {

                $(".content-rd").mCustomScrollbar({
                    theme: "light-3"
                });
            });

        </script>
    </div>
    <? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_bottom.php"; // 공통함수 인클루드 ?>
</body>

</html>
