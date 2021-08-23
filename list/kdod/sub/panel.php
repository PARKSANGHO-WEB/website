<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$mem_info_sql = "select user_id,nation,sns_kind from member_info where 1 and idx = '".$_SESSION['member_coinc_idx']."' and del_yn='N'";
//echo $mem_info_sql; exit;
$mem_info_query = mysqli_query($gconnet,$mem_info_sql);
if(mysqli_num_rows($mem_info_query) == 0){
	error_popup("There are no registered member.");
}
$mem_info_row = mysqli_fetch_array($mem_info_query);

$idx = $_SESSION['member_coinc_idx'];
$user_id = trim($mem_info_row['user_id']);
$nation = trim($mem_info_row['nation']);
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
    <link rel="stylesheet" href="../css/wSelect.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1.0">
    <title>K-DOT</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="../js/menu.js"></script>
	<script src="../js/common_js.js"></script>
	<script src="../js/wSelect.js"></script>
</head>
<body>
	<div id="panel">
		<section class="joina">
			<div class="joina-wrap">
				<div class="joina-logo">
					<!--<a href="../index.html">-->
						<img src="../img/logo.png" alt="kdot 로고">
					<!--</a>-->
				</div>
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
						<? } ?>
                        </ul>
                    </div>
-->
                </div>
                <script>
                    $(document).ready(function(){
                        $('.select').on('fousin',function(){
                            $(this).addClass('in');
                        });
                    });
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
					function go_submit() {
						if(!document.frm.check.checked){
							alert('Please confirm that you agree to our Terms of Service.');
							return false;	
						}
						document.frm.submit();
						return;		
					}
				
					function set_nation(str){
						document.frm.nation.value=str;
					}
				</script>

		<form action="panel-join.php" name="frm" method="post" target="_self">
		<input type="hidden" name="member_idx" value="<?=$idx?>">
		<input type="hidden" name="user_id" value="<?=$user_id?>">
		<input type="hidden" name="nation" value="<?=$nation?>">
		<input type="hidden" name="sns_kind" value="<?=$sns_kind?>">

				<div class="container w400">
					<div class="content">
						<div class="area01 area">
							<h4>Survey Info</h4>
							<p class="txt01">This Panel Profile Survey is a mandatory for all online panel members. Without your panel profile, you cannot get K-DOD points or giveaway lucky draw opportunity. All your information will be kept highly confidential and please provide us accurate data.</p>
						</div>
						<div class="area02 area">
							<h4>Now participate in, and be our online panel!</h4>
							<p class="txt01">· ˙Number of Questions : 10 questions<br>
											· ˙Time to Complete : Only 3 minutes</p>
						</div>
						<div class="area03 area">
							<h4>Survey Purpose</h4>
							<p class="txt01">This Panel profile information will be used as your basic profile for all K-DOD online surveys. By completing this one short survey, you don’t need to fill up the same questions all the time. We will update your panel profile every year. Thank you.</p>
						</div>
						<div class="area04 area">
							<h4>Agree to K-DOD Terms of Service</h4>
							<div class="kdodServiceBox">
								<p class="tit">Terms of Service (Ver1.0)</p>
								<p class="txt01">1. Welcome!<br>
								Thank you for using our products and services. These K-DOD Terms of Service define the relationship between the company ("K-DOD")and members of K-DOD("Member(s)")or non-members, who use such Services, with regard to the use of various K-DOD Services, and contain useful information which may help you use K-DOD Services. By using our Services, you are deemed to have been notified of K-DOD Terms of Service, and by signing up as a Member, you are deemed to agree to be bound by these K-DOD Terms of Service and additional relevant operation policies. Plese take a mometnt to read these K-DOD Terms of Service carefully.
								By using our products or services and by signing up as a Member, you are deemed to agree to be bound by these K-DOD Terms of Service and additional relevant operation policies. Please take a moment to read these Terms of Service carefully.</p>
							</div>
						</div>
						<div class="checkBoxWrap"><label for="check">Agree to Terms of Service</label><input type="checkbox" name="check" id="check"></div>
						<div class="btnWrap btnWrap02">
							<a href="javascript:self.close();" class="btn btn01">Close</a>
							<button type="button" class="btn btn02" onclick="javascript:go_submit();">START</button>
						</div>
					</div><!--//contant-->
				</div><!--//container-->
			</form>
			</div><!--//panel-join-->
		</section>
	</div>

</body>
</html>