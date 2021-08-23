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
    <script src="../js/wSelect.js"></script>
</head>

<body>
    <? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
    <?
	$user_id = trim(sqlfilter($_REQUEST['user_id']));
	//echo $user_id."<br>";
	$email = trim(sqlfilter($_REQUEST['email']));
	//echo $email."<br>";
	$user_pwd = trim(sqlfilter($_REQUEST['user_pwd']));
	$user_name = trim(sqlfilter($_REQUEST['user_name']));
	//echo $user_pwd."<br>";
	$nation_txt = trim(sqlfilter($_REQUEST['nation_txt']));

	if($nation_txt == "kr"){
		$nation = "01";	
	} elseif($nation_txt == "en"){
		$nation = "02";	
	} elseif($nation_txt == "my"){
		$nation = "03";	
	} elseif($nation_txt == "cam"){
		$nation = "04";	
	}

	$sns_kind = trim(sqlfilter($_REQUEST['sns_kind']));

	$sql_pre1 = "select idx from member_info where user_id = '".$user_id."' and memout_yn='N' and del_yn='N'"; // 회원테이블 아이디 중복여부 체크
	$result_pre1  = mysqli_query($gconnet,$sql_pre1);
	if(mysqli_num_rows($result_pre1) > 0) {
		error_go("The ID you entered already exists.","join.php");
	}

	if($email){ // 이메일을 입력했을때 
		$sql_pre4 = "select idx from member_info where email = '".$email."' and memout_yn='N' and del_yn='N'";
		$result_pre4  = mysqli_query($gconnet,$sql_pre4);
		if(mysqli_num_rows($result_pre4) > 0) {
			error_go("The E-mail you entered already exists.","join.php");
		}
	} // 이메일을 입력했을때 종료
?>
    <script>
        function go_submit() {

            if (!document.frm.check_t.checked) {
                alert('Please confirm that you agree to our Terms of Service.');
                return false;
            }

            if (!document.frm.check_p.checked) {
                alert('Please confirm that you agree to our Privacy Policy.');
                return false;
            }

			if(!document.frm.gender[0].checked && !document.frm.gender[1].checked){
				alert('Please select Gender.');
                return false;
			}
			if (document.frm.birthday.value == "") {
                alert('Please input birthday.');
                return false;
            }

            document.frm.submit();
            return;
        }

        function set_nation(str) {
            document.frm.nation.value = str;
        }

	 </script>
    <section class="joina">
        <form action="join-add_action.php" name="frm" method="post" target="_self">
            <input type="hidden" name="user_id" value="<?=$user_id?>">
            <input type="hidden" name="email" value="<?=$email?>">
            <input type="hidden" name="user_pwd" value="<?=$user_pwd?>">
            <input type="hidden" name="sns_kind" value="<?=$sns_kind?>">
            <input type="hidden" name="member_type" value="GEN">
            <div class="joina-wrap">
                <div class="joina-logo">
                    <a href="../index.php">
                        <img src="../img/logo.png" alt="">
                    </a>
                </div>
                <div class="checked-img">
                    <img src="../img/sub/checked.png" alt="">
                </div>
                <div class="joina-title">
                    <p>REGISTRATION -Continued</p>
                    <span>For product or giveaway delivery, we need your accurate data. </span>
                </div>
                <div class="joina-sel sel">
                    <!-- 옵션 영역 -->
                    <div class="gnb-big pd0">
                        <select id="demo" tabindex="1" name="nation_txt">
                            <option value="kr" <?=$nation_txt=="kr"?"selected":""?> data-icon="../img/korea.png">한국어</option>
                            <option value="en" <?=$nation_txt=="en"?"selected":""?> data-icon="../img/america.png">English</option>
                            <option value="my" <?=$nation_txt=="my"?"selected":""?> data-icon="../img/my.png">မြန်မာဘာသာ</option>
                            <option value="cam" <?=$nation_txt=="cam"?"selected":""?> data-icon="../img/cb.png">ភាសាខ្មែរ</option>
                            <option value="others">Others</option>
                        </select>
						 <input type="text" id="divother" name="nation_txt_oth" placeholder="Please enter your nationality">
                        <script type="text/javascript">
                            $('select').wSelect();

							
							
							window.onload = function(){
								var selBox = document.getElementById('demo');
								selBox.onchange = function(){
									if(this.value == 'others'){
										document.getElementById('divother').style.display = 'block';
									}
									else{
										document.getElementById('divother').style.display = 'none';
									}
								}
							}
                        </script>
                        
                        <script type="text/javascript">
    </script>
                    </div>
                    <!--
                        <div class="hide">
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
						<? } ?>
                         </div>
                    </div>
-->
                </div>
                <div class="address-sel sel">
                    <input type="text" placeholder="Username" name="user_name" id="user_name">
                </div>
                <div class="gender-sel sel">
                    <h3>Gender</h3>
                    <span><input type="radio" id="male" name="gender" value="1"><label for="male">male</label></span>
                    <span><input type="radio" id="femal" name="gender" value="2"><label for="femal">female</label></span>
                </div>
                <div class="date-sel sel">
                    <h3>Birth Date, Month, Year</h3>
                    <input type="text" name="birthday" id="datepicker" readonly autocomplete="off">
                </div>
                <div class="address-sel sel">
                    <h3>Country</h3>
                    <!--  <div class="country-sel"> -->
                    <input type="text" name="addr1">
                    <!-- <select name="addr1" id="addr1">
                        <option style="color: blue;" value="none" selected disabled><span class="none">Country</span></option>
                        <option value="Country1">Country1</option>
                        <option value="Country2">Country2</option>
                        <option value="Country3">Country3</option>
                        <option value="Country4">Country4</option>
                        <option value="Country5">Country5</option>
                        <option value="Country6">Country6</option>
                        <option value="Country7">Country7</option>
                        <option value="Country8">Country8</option>
                        <option value="Country9">Country9</option>
                        <option value="Country10">Country10</option>
                        <option value="Country11">Country11</option>
                    </select> -->
                </div>
                <div class="address-sel sel">
                    <!--    <div class="city-sel"> -->
                    <h3>City</h3>
                    <input type="text" name="addr2">
                    <!--  <select name="addr2" id="addr2">
                        <option style="color: blue;" value="none" selected disabled><span class="none">City</span></option>
                        <option value="city1">city1</option>
                        <option value="city2">city2</option>
                        <option value="city3">city3</option>
                        <option value="city4">city4</option>
                        <option value="city5">city5</option>
                        <option value="city6">city6</option>
                        <option value="city7">city7</option>
                        <option value="city8">city8</option>
                        <option value="city9">city9</option>
                        <option value="city10">city10</option>
                        <option value="city11">city11</option>
                    </select> -->
                </div>
                <div class="address-sel sel">
                    <h3>Home Address</h3>
                    <input type="text" name="addr3">
                </div>
                <div class="mobile-sel sel">
                    <h3>Mobile Phone Number</h3>
                    <input type="text" name="cell" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
                </div>
                <div class="show-modal">
                    <div class="terms">
                        <a href="javascript:;" class="show-ts">Show Terms of Service</a>
                        <div class="okay-term">
                            <input type="checkbox" class="check-t" name="check_t" id="check-t" value="Y">
                            <label for="check-t">Please confirm that you agree to our Terms of Service</label>
                        </div>
                    </div>
                    <div class="policy">
                        <a href="javascript:;" class="show-pp">Show Privacy Policy</a>
                        <div class="okay-policy">
                            <input type="checkbox" class="check-p" name="check_p" id="check-p" value="Y">
                            <label for="check-p">Please confirm that you agree to our Privacy Policy</label>
                        </div>
                    </div>
                </div>
                <div class="joina-btn">
                    <button type="button" onclick="javascript:go_submit();">
                        <span>Submit</span>
                    </button>
                </div>
            </div>
        </form>
    </section>
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
        $(function() {
            //input을 datepicker로 선언
            $("#datepicker").datepicker({
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

            //초기값을 오늘 날짜로 설정
            //$('#datepicker').datepicker('setDate', 'today'); //(-1D:하루전, -1M:한달전, -1Y:일년전), (+1D:하루후, -1M:한달후, -1Y:일년후)            
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
    <div class="terms-modal modal-al">
        <div class="modal-con">
            <div class="modal-title">
                <span>Terms of Service</span>
                <div class="close-btn">
                    <img src="../img/sub/close_btn.png" alt="">
                </div>
            </div>
            <div class="line-wrap content-rd">
                <div class="line-w line1">
                    <p class="title">1. 환영합니다!</p>
                    <p class="content">
                        케이닷 제품 및 서비스를 이용해 주셔서 감사합니다. 본 약관은 다양한 케이닷 제품 및 서비스의 이용과 관련하여 회사(이하 ‘케이닷’)와 이를 이용하는 케이닷 회원(이하 ‘회원’) 또는 비회원과의 관계를 설명하며, 아울러 여러분의 케이닷 서비스 이용에 도움이 될 수 있는 유익한 정보를 포함하고 있습니다. <br />
                        케이닷 서비스를 이용하거나 회원으로 가입하실 경우, 여러분은 본 약관 및 관련 운영 정책을 확인하거나 동의하게 되므로, 잠시 시간을 내시어 주의 깊게 살펴봐 주시기 바랍니다
                    </p>
                </div>
                <div class="line-w line2">
                    <p class="title">2. 다양한 제품과 서비스를 즐겨보세요.</p>
                    <p class="content">
                        케이닷은 www.k-dod.com 웹사이트 및 회사 사회관계망 서비스를 통해 온라인 서베이, 다른 이용자와의 커뮤니케이션, 콘텐츠 제공, 제품 소개 등 여러분의 생활의 질을 향상시킬 수 있는 다양한 서비스를 제공하고 있습니다. 여러분은 PC, 휴대폰 등 인터넷 이용이 가능한 각종 단말기를 통해 케이닷 서비스를 자유롭게 이용하실 수 있으며, 개별 서비스들의 구체적인 내용은 각 서비스 상의 안내, 공지사항, 고객센터 도움말 등에서 쉽게 확인하실 수 있습니다.<br />
                        케이닷은 기본적으로 여러분 모두에게 동일한 내용의 서비스를 제공합니다. 다만, '청소년보호법' 등 관련 법령이나 기타 개별 서비스 제공에서의 특별한 필요에 의해서 연령 또는 일정한 등급을 기준으로 이용자를 구분하여 제공하는 서비스의 내용, 이용 시간, 이용 횟수 등을 다르게 하는 등 일부 이용을 제한하는 경우가 있습니다.
                    </p>
                </div>
                <div class="line-w line3">
                    <p class="title">3. 회원으로 가입하시면 케이닷 서비스를 보다 편리하게 이용할 수 있습니다.</p>
                    <p class="content">
                        여러분은 본 약관을 읽고 동의하신 후 회원 가입을 신청하실 수 있으며, 케이닷은 이에 대한 승낙을 통해 회원 가입 절차를 완료하고 여러분께 케이닷 서비스 이용 계정(이하 ‘계정’)을 부여합니다. 계정이란 회원이 케이닷 서비스에 로그인한 이후 이용하는 각종 서비스 이용 이력을 회원 별로 관리하기 위해 설정한 회원 식별 단위를 말합니다. 회원은 자신의 계정을 통해 좀더 다양한 서비스를 보다 편리하고 유용하게 이용할 수 있습니다.
                    </p>
                </div>
                <div class="line-w line4">
                    <p class="title">4. 여러분이 제공한 콘텐츠를 소중히 다루겠습니다.</p>
                    <p class="content">
                        케이닷은 여러분이 게재한 게시물이나 참여하신 서베이 응답들이 우리 모두의 삶을 더욱 풍요롭게 해줄 것을 기대합니다. 케이닷은 여러분의 정보, 생각과 감정이 표현된 콘텐츠들을 소중히 보호할 것을 약속 드립니다. <br />
                        케이닷 서비스를 통해 여러분이 게재한 게시물을 적법하게 제공하려면 해당 콘텐츠에 대한 저장, 복제, 수정, 공중 송신, 전시, 배포, 2차적 저작물 작성 등의 이용 권한(기한과 지역 제한에 정함이 없으며, 별도 대가 지급이 없는 라이선스)이 필요합니다. 게시물 게재로 여러분은 케이닷에게 그러한 권한을 부여하게 되므로, 여러분은 이에 필요한 권리를 보유하고 있어야 합니다.
                    </p>
                </div>
                <div class="line-w line5">
                    <p class="title">5. 여러분의 개인정보를 소중히 보호합니다.</p>
                    <p class="content">
                        여러분의 개인정보를 소중히 보호합니다.<br />
                        케이닷은 서비스의 원활한 제공을 위하여 회원이 동의한 목적과 범위 내에서만 개인정보를 수집, 이용하며, 개인정보 보호 관련 법령에 따라 안전하게 관리합니다. 케이닷에서 이용자 및 회원에 대해 관련 개인정보를 안전하게 처리하기 위하여 기울이는 노력이나 기타 상세한 사항은 개인정보 처리방침에서 확인하실 수 있습니다.<br />
                        케이닷은 여러분이 서비스를 이용하기 위해 일정 기간 동안 로그인 혹은 접속한 기록이 없는 경우, 전자메일, 서비스 내 알림 또는 기타 적절한 전자적 수단을 통해 사전에 안내해 드린 후 여러분의 정보를 파기하거나 분리 보관할 수 있으며, 만약 이로 인해 서비스 제공을 위해 필수적인 정보가 부족해질 경우 부득이 관련 서비스 이용 계약을 해지할 수 있습니다.
                    </p>
                </div>
                <div class="line-w line6">
                    <p class="title">6. 타인의 권리를 존중해 주세요.</p>
                    <p class="content">
                        여러분이 무심코 게재한 게시물로 인해 타인의 저작권이 침해되거나 명예훼손 등 권리 침해가 발생할 수 있습니다. 케이닷은 이에 대한 문제 해결을 위해 ‘정보통신망 이용촉진 및 정보보호 등에 관한 법률’ 및 ‘저작권법’ 등을 근거로 권리침해 주장자의 요청에 따른 게시물 게시중단, 원 게시자의 이의신청에 따른 해당 게시물 게시 재개 등을 할 수 있습니다.
                    </p>
                </div>
                <div class="line-w line7">
                    <p class="title">7. 케이닷에서 제공하는 다양한 포인트를 유용하게 활용해 보세요.</p>
                    <p class="content">
                        케이닷은 여러분이 서비스를 효율적으로 이용할 수 있도록 포인트를 부여하고 있습니다. 포인트는 여러분의 일정한 케이닷 서비스 이용과 연동하여 케이닷이 임의로 책정하거나 조정하여 지급하는 일정한 계산 단위를 갖는 서비스 상의 가상 데이터를 말합니다. 포인트는 재산적 가치가 없기 때문에 금전으로 환불 또는 전환할 수 없지만, 포인트의 많고 적음에 따라 여러분의 케이닷 서비스 이용에 영향을 주는 경우가 있으므로 경우에 따라 적절히 활용해 보세요. <br />
                        케이닷은 서비스의 효율적 이용을 지원하거나 서비스 운영을 개선하기 위해 필요한 경우 사전에 여러분께 안내 드린 후 부득이 포인트의 일부 또는 전부를 조정할 수 있습니다. 그리고 포인트는 케이닷이 정한 기간에 따라 주기적으로 소멸할 수도 있으니 포인트가 부여되는 케이닷 서비스 이용 시 유의해 주시기 바랍니다.
                    </p>
                </div>
                <div class="line-w line8">
                    <p class="title">8. 케이닷 서비스 이용과 관련하여 몇 가지 주의사항이 있습니다.</p>
                    <p class="content">
                        케이닷은 여러분이 서비스를 자유롭고 편리하게 이용할 수 있도록 최선을 다하고 있습니다. 다만, 여러분이 케이닷 서비스를 보다 안전하게 이용하고 여러분과 타인의 권리가 서로 존중되고 보호받으려면 여러분의 도움과 협조가 필요합니다. 여러분의 안전한 서비스 이용과 권리 보호를 위해 부득이 아래와 같은 경우 여러분의 게시물 게재나 케이닷 서비스 이용이 제한될 수 있으므로, 이에 대한 확인 및 준수를 요청 드립니다. <br />
                        -회원 가입 시 이름, 생년월일, 휴대전화번호 등의 정보를 허위로 기재해서는 안 됩니다. 회원 계정에 등록된 정보는 항상 정확한 최신 정보가 유지될 수 있도록 관리해 주세요. 자신의 계정을 다른 사람에게 판매, 양도, 대여 또는 담보로 제공하거나 다른 사람에게 그 사용을 허락해서는 안 됩니다. 아울러 자신의 계정이 아닌 타인의 계정을 무단으로 사용해서는 안 됩니다.<br />
                        -타인에 대해 직접적이고 명백한 신체적 위협을 가하는 내용의 게시물, 타인의 자해 행위 또는 자살을 부추기거나 권장하는 내용의 게시물, 타인의 신상정보, 사생활 등 비공개 개인정보를 드러내는 내용의 게시물, 타인을 지속적으로 따돌리거나 괴롭히는 내용의 게시물, 성매매를 제안, 알선, 유인 또는 강요하는 내용의 게시물, 공공 안전에 대해 직접적이고 심각한 위협을 가하는 내용의 게시물은 제한될 수 있습니다. <br />
                        -관련 법령상 금지되거나 형사처벌의 대상이 되는 행위를 수행하거나 이를 교사 또는 방조하는 등의 범죄 관련 직접적인 위험이 확인된 게시물, 관련 법령에서 홍보, 광고, 판매 등을 금지하고 있는 물건 또는 서비스를 홍보, 광고, 판매하는 내용의 게시물, 타인의 지식재산권 등을 침해하거나 모욕, 사생활 침해 또는 명예훼손 등 타인의 권리를 침해하는 내용이 확인된 게시물은 제한될 수 있습니다.
                    </p>
                </div>
                <div class="line-w line9">
                    <p class="title">9. 부득이 서비스 이용을 제한할 경우 합리적인 절차를 준수합니다.</p>
                    <p class="content">
                        케이닷은 다양한 정보와 의견이 담긴 여러분의 콘텐츠를 소중히 다룰 것을 약속 드립니다만, 여러분이 게재한 게시물이 관련 법령, 본 약관, 게시물 운영정책, 각 개별 서비스에서의 약관, 운영정책 등에 위배되는 경우, 부득이 이를 비공개 또는 삭제 처리하거나 게재를 거부할 수 있습니다. 다만, 이것이 케이닷이 모든 콘텐츠를 검토할 의무가 있다는 것을 의미하지는 않습니다.<br />
                        또한 여러분이 관련 법령, 본 약관, 계정 및 게시물 운영정책, 각 개별 서비스에서의 약관, 운영정책 등을 준수하지 않을 경우, 케이닷은 여러분의 관련 행위 내용을 확인할 수 있으며, 그 확인 결과에 따라 케이닷 서비스 이용에 대한 주의를 당부하거나, 서비스 이용을 일부 또는 전부, 일시 또는 영구히 정지시키는 등 그 이용을 제한할 수 있습니다. 한편, 이러한 이용 제한에도 불구하고 더 이상 케이닷 서비스 이용계약의 온전한 유지를 기대하기 어려운 경우엔 부득이 여러분과의 이용계약을 해지할 수 있습니다.
                    </p>
                </div>
                <div class="line-w line10">
                    <p class="title">10. 언제든지 케이닷 서비스 이용을 해지하실 수 있습니다.</p>
                    <p class="content">
                        케이닷에게는 참 안타까운 일입니다만, 회원은 언제든지 케이닷 서비스 이용계약 해지를 신청하여 회원에서 탈퇴할 수 있으며, 이 경우 케이닷은 관련 법령 등이 정하는 바에 따라 이를 지체 없이 처리하겠습니다. <br />
                        케이닷 서비스 이용계약이 해지되면, 관련 법령 및 개인정보처리방침에 따라 케이닷이 해당 회원의 정보를 보유할 수 있는 경우를 제외하고, 해당 회원 계정에 부속된 게시물 일체를 포함한 회원의 모든 데이터는 소멸됨과 동시에 복구할 수 없게 됩니다. 다만, 이 경우에도 다른 회원이 별도로 담아갔거나 스크랩한 게시물과 공용 게시판에 등록한 댓글 등의 게시물은 삭제되지 않으므로 반드시 해지 신청 이전에 삭제하신 후 탈퇴하시기 바랍니다.
                    </p>
                </div>
                <div class="line-w line11">
                    <p class="title">11. 주요 사항을 잘 안내하고 여러분의 소중한 의견에 귀 기울이겠습니다.</p>
                    <p class="content">
                        케이닷은 서비스 이용에 필요한 주요사항을 적시에 잘 안내해 드릴 수 있도록 힘쓰겠습니다. 회원에게 통지를 하는 경우 전자메일, 서비스 내 알림 또는 기타 적절한 전자적 수단을 통해 개별적으로 알려 드릴 것이며, 다만 회원 전체에 대한 통지가 필요할 경우엔 7일 이상 www.k-dod.com 웹사이트 초기 화면 또는 공지사항 등에 관련 내용을 게시하도록 하겠습니다.<br />
                        케이닷은 여러분의 소중한 의견에 귀 기울이겠습니다. 여러분은 언제든지 QA/게시판을 통해 서비스 이용과 관련된 의견이나 개선사항을 전달할 수 있으며, 케이닷은 합리적 범위 내에서 가능한 그 처리과정 및 결과를 여러분께 전달할 수 있도록 하겠습니다.
                    </p>
                </div>
                <div class="line-w line12">
                    <p class="title">12. 여러분이 쉽게 알 수 있도록 약관 및 운영정책을 게시하며 사전 공지 후 개정합니다.</p>
                    <p class="content">
                        케이닷은 본 약관의 내용을 여러분이 쉽게 확인할 수 있도록 서비스 초기 화면에 게시하고 있으며, 수시로 본 약관, 계정 및 게시물 운영정책을 개정할 수 있습니다.<br />
                        케이닷은 변경된 약관을 게시한 날로부터 효력이 발생되는 날까지 (30일) 약관 변경에 대한 여러분의 의견을 기다립니다. 변경된지 30일이 지나도록 여러분의 의견이 케이닷에 접수되지 않으면, 여러분이 변경된 약관에 따라 서비스를 이용하는 데에 동의하는 것으로 간주됩니다.<br />
                        본 약관은 한국어를 정본으로 합니다. <br /><span class="date">공지 일자:2021년 2월 1일 </span><span class="date">시행 일자:2021년 2월 1일</span>
                    </p>
                </div>
            </div>
        </div>
    </div>


    <div class="policy-modal modal-al">
        <div class="modal-con">
            <div class="modal-title">
                <span>Privacy Policy</span>
                <div class="close-btn">
                    <img src="../img/sub/close_btn.png" alt="">
                </div>
            </div>
            <div class="line-wrap content-rd">
                <div class="line-w line1">
                    <p class="content">
                        회사(이하 ‘케이닷’)는 이용자 개인정보 보호에 우선 순위를 두고 있으며, 개인정보 보호 가이드라인에 대한 국제 기준을 준수하여 서비스를 제공합니다. 케이닷 회원 가입 신청 및 기타 개인정보를 제공하는 분께 수집하는 개인 정보에 대한 내용을 안내 드리오니 주의깊게 읽은 후 동의하여 주시기 바랍니다.
                    </p>
                </div>
                <div class="line-w line1">
                    <p class="title">1. 개인정보처리방침의 의의</p>
                    <p class="content">
                        <span class="indent">
                            -케이닷에서 어떤 정보를 수집하고, 수집한 정보를 어떻게 사용하며, 정보를 언제·어떻게 파기하는지 등 개인정보와 관련한 정보를 투명하게 제공합니다.</span>
                        <span class="indent">-이용자는 자신의 개인정보에 대해 어떤 권리를 가지고 있으며, 이를 어떤 방법과 절차로 행사할 수 있는지를 알려드립니다.</span>
                        <span class="indent">-개인정보와 관련하여 케이닷과 이용자간의 권리 및 의무 관계를 규정하여 이용자의 ‘개인정보자기결정권’을 보장하는 수단이 됩니다.</span>
                    </p>
                </div>
                <div class="line-w line2">
                    <p class="title">2. 수집하는 개인정보</p>
                    <p class="content">
                        이용자는 회원가입을 하지 않아도 제품 정보, 신규 업데이트 등 대부분의 케이닷 서비스를 회원과 동일하게 이용할 수 있습니다. <br />
                        이용자가 온라인 서베이 등과 같이 개인화 혹은 회원제 서비스를 이용하기 위해 회원가입을 할 경우, 케이닷은 서비스 이용을 위해 필요한 최소한의 개인정보를 수집합니다.<br /><br />
                        회원가입 시점에 케이닷이 이용자로부터 수집하는 개인정보 :<br />
                        <span class="indent">-아이디, 비밀번호, 이름, 생년월일, 성별 : 서비스 이용에 따른 본인 식별 절차에 이용</span>
                        <span class="indent">-휴대전화번호, 주소, 이메일주소 : 경품 배송, 기타 새로운 서비스나 이벤트 소개 등 최신 정보 안내에 이용</span><br /><br />
                        서비스 이용 과정에서 이용자로부터 수집하는 개인정보 :<br />
                        <span class="indent">-케이닷 내의 개별 서비스 이용, 이벤트 응모 및 경품 신청 과정에서 해당 서비스의 이용자에 한해 추가 개인정보 수집이 발생할 수 있습니다. 추가로 개인정보를 수집할 경우에는 해당 개인정보 수집 시점에서 이용자에게 수집하는 개인정보에 대해 안내 드리고 동의를 받습니다.</span><br /><br />
                        케이닷은 아래의 방법을 통해 개인정보를 수집합니다 :<br />
                        <span class="indent">-회원가입 및 서비스 이용 과정에서 이용자가 개인정보 수집에 대해 동의를 하고 직접 정보를 입력하는 경우, 해당 개인정보를 수집합니다.</span>
                        <span class="indent">-고객센터를 통한 상담 과정에서 웹페이지, 메일, 팩스, 전화 등을 통해 이용자의 개인정보가 수집될 수 있습니다.</span>
                        <span class="indent">-오프라인에서 진행되는 이벤트, 세미나 등에서 서면을 통해 개인정보가 수집될 수 있습니다.</span>
                        <span class="indent">-기기정보와 같은 생성정보는 PC웹, 모바일 웹/앱 이용 과정에서 자동으로 생성되어 수집될 수 있습니다.</span>
                    </p>
                </div>
                <div class="line-w line3">
                    <p class="title">3. 수집한 개인정보의 이용</p>
                    <p class="content">

                        <span class="indent">-회원 가입 의사의 확인, 연령 확인, 이용자 본인 확인, 이용자 식별, 회원탈퇴 의사의 확인 등 회원관리를 위하여 개인정보를 이용합니다.</span>
                        <span class="indent">-콘텐츠 등 기존 서비스 제공(광고 포함)에 더하여, 인구통계학적 분석, 서비스 방문 및 이용기록의 분석, 개인정보 및 관심에 기반한 이용자간 관계의 형성, 지인 및 관심사 등에 기반한 맞춤형 서비스 제공 등 신규 서비스 요소의 발굴 및 기존 서비스 개선 등을 위하여 개인정보를 이용합니다.</span>
                        <span class="indent">-법령 및 케이닷 이용약관을 위반하는 회원에 대한 이용 제한 조치, 부정 이용 행위를 포함하여 서비스의 원활한 운영에 지장을 주는 행위에 대한 방지 및 제재, 계정도용 및 부정거래 방지, 약관 개정 등의 고지사항 전달, 분쟁조정을 위한 기록 보존, 민원처리 등 이용자 보호 및 서비스 운영을 위하여 개인정보를 이용합니다.</span>
                        <span class="indent">-프리미엄 서비스 제공에 따르는 본인인증, 포인트 부여 및 차감, 상품 및 서비스의 배송을 위하여 개인정보를 이용합니다.</span>
                        <span class="indent">-이벤트 정보 및 참여기회 제공, 광고성 정보 제공 등 마케팅 및 프로모션 목적으로 개인정보를 이용합니다.</span>
                        <span class="indent">-서비스 이용기록과 접속 빈도 분석, 서비스 이용에 대한 통계, 서비스 분석 및 통계에 따른 맞춤 서비스 제공 및 광고 게재 등에 개인정보를 이용합니다.</span>
                        <span class="indent">-보안, 프라이버시, 안전 측면에서 이용자가 안심하고 이용할 수 있는 서비스 이용환경 구축을 위해 개인정보를 이용합니다.</span>
                    </p>
                </div>
                <div class="line-w line4">
                    <p class="title">4. 개인정보의 제공 및 위탁</p>
                    <p class="content">
                        케이닷은 이용자의 사전 동의 없이 개인정보를 외부에 제공하지 않습니다. 단, 이용자가 외부 제휴사의 서비스를 이용하기 위하여 개인정보 제공에 직접 동의를 한 경우, 그리고 관련 법령에 의거해 케이닷에 개인정보 제출 의무가 발생한 경우, 이용자의 생명이나 안전에 급박한 위험이 확인되어 이를 해소하기 위한 경우에 한하여 개인정보를 제공합니다.<br />
                        개인정보 처리위탁 중 국외 법인에서 처리하는 위탁업무는 아래와 같습니다 :<br />
                        케이닷은 이용자의 개인정보를 국외의 다른 사업자에게 제공하지 않습니다. 다만, 데이터 보관 및 서비스 운영 업무를 ‘케이닷 코리아’, ‘케이닷 미얀마’, ‘케이닷 캄보디아’에서 공동 관리하므로, 케이닷과 동일한 정보보호 정책에 따라 이용자의 정보를 보호하며, 케이닷의 엄격한 통제 하에 업무를 수행하고 있습니다. 국외 법인에 대한 정보는 회사 소개 페이지에서 찾아보실 수 있습니다.
                    </p>
                </div>
                <div class="line-w line5">
                    <p class="title">5. 개인정보의 파기</p>
                    <p class="content">
                        회사는 원칙적으로 이용자의 개인정보를 회원 탈퇴 시 지체없이 파기하고 있습니다.<br />
                        단, 이용자에게 개인정보 보관기간에 대해 별도의 동의를 얻은 경우, 또는 법령에서 일정 기간 정보보관 의무를 부과하는 경우에는 해당 기간 동안 개인정보를 안전하게 보관합니다.<br />
                        회원탈퇴, 서비스 종료, 이용자에게 동의받은 개인정보 보유기간의 도래와 같이 개인정보의 수집 및 이용목적이 달성된 개인정보는 재생이 불가능한 방법으로 파기하고 있습니다. 법령에서 보존의무를 부과한 정보에 대해서도 해당 기간 경과 후 지체없이 재생이 불가능한 방법으로 파기합니다
                    </p>
                </div>
                <div class="line-w line6">
                    <p class="title">6. 이용자의 권리와 행사 방법</p>
                    <p class="content">
                        - 이용자는 언제든지 ‘케이닷 내 정보’에서 자신의 개인정보를 조회하거나 수정ㆍ삭제할 수 있으며, 자신의 개인정보에 대한 열람을 요청할 수 있습니다.<br />
                        - 이용자는 언제든지 ‘회원탈퇴’ 등을 통해 개인정보의 수집 및 이용 동의를 철회할 수 있습니다.
                    </p>
                </div>
                <div class="line-w line7">
                    <p class="title">7. 개인정보 보호를 위한 노력</p>
                    <p class="content">
                        케이닷은 이용자의 개인정보를 안전하게 관리하기 위하여 최선을 다하고 있으며, 고객의 개인정보는 비밀번호에 의해 보호되고 있습니다. 고객 계정의 비밀번호는 오직 본인만이 알 수 있으며, 개인정보의 확인 및 변경도 비밀번호를 알고 있는 본인에 의해서만 가능합니다. 따라서 고객의 비밀번호는 누구에게도 알려주시면 안 되며, 작업을 마치신 후에는 로그아웃(log-out) 버튼을 누르십시오. <br />
                        회사는 고객의 개인정보 보호를 위하여 관리 담당자를 지정하고 유출방지에 대한 의식고취 및 대책개발을 위한 지속적인 교육을 실시하고 있습니다. 또한 아울러 기술적으로도 외부로부터의 해킹이나 도난분실의 방지를 위해 최고수준의 솔루션을 확보, 운영하기 위해 노력하고 있습니다. 단, 고객 본인의 부주의나 인터넷상의 문제로 개인정보가 유출해 발생한 문제에 대해 회사는 일체의 책임을 지지 않습니다.
                    </p>
                </div>
                <div class="line-w line8">
                    <p class="title">8. 개정 전 고지 의무</p>
                    <p class="content">
                        본 개인정보처리방침의 내용 추가, 삭제 및 수정이 있을 경우 개정 최소 7일 전에 ‘공지사항’을 통해 사전 공지를 할 것입니다. <br />
                        다만, 수집하는 개인정보의 항목, 이용목적의 변경 등과 같이 이용자 권리의 중대한 변경이 발생할 때에는 최소 30일 전에 공지하며, 필요 시 이용자 동의를 다시 받을 수도 있습니다.
                        <br /><span class="date">공고일자: 2021년 2월 1일</span><span class="date">시행일자: 2021년 2월 1일</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
