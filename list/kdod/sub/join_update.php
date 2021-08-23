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
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/check_login.php"; ?>
<?

$idx = $_SESSION['member_coinc_idx'];

$sel_sql = "select * from member_info where idx='".$idx."'";
$sel_res =  mysqli_query($gconnet,$sel_sql);
$sel_row =  mysqli_fetch_array($sel_res);
//echo $sel_row[birthday];
?>
<script>
function go_submit() {
	var check = chkFrm('frm');
	if(check) {
		frm.submit();
	} else {
		return;
	}
}
</script>
    <section class="joina">
        <form action="join_update_action.php" name="frm" method="post" target="_self">
		<input type="hidden" name="idx" value="<?=$idx?>">
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
                    <p>MODIFY</p>
                    <span>For product or giveaway delivery, we need your accurate data. </span> 
                </div>
                
                <script>
                    $(document).ready(function(){
                        $('.select').on('fousin',function(){
                            $(this).addClass('in');
                        });
                    });
                </script>
                <div class="gender-sel">
                    <select name="gender" id="gender" required="yes" message="성별">
                        <option style="color: blue;" value="none" selected disabled><span class="none">gender</span></option>
                        <option value="1" <?if($sel_row[gender]=='1') echo 'selected="selected"';?>>male</option>
                        <option value="2" <?if($sel_row[gender]=='2') echo 'selected="selected"';?>>female</option>
                    </select>
                </div>
                <div class="date-sel">
                        <div class="date-sel">
                            <input type="text" name="birthday" id="datepicker" class="datepicker" required="yes" message="Birth Date, Month, Year" autocomplete="off" value="<?=$sel_row[birthday]?>">
                        </div>
                </div>
				<div class="address-sel">
				<input type="text" name="addr1" placeholder="Country Address" value="<?=$sel_row[addr1]?>">
                </div>
				<div class="address-sel">
				<input type="text" name="addr2" placeholder="City Address" value="<?=$sel_row[addr2]?>">
                </div>
                <div class="address-sel">
                    <input type="text" name="addr3" placeholder="Home Address" value="<?=$sel_row[addr3]?>">
                </div>
                <div class="mobile-sel">
                    <input type="text" name="cell" placeholder="Mobile Phone Number" required="yes" message="연락처" value="<?=$sel_row[cell]?>" is_num="yes">
                </div>
                <div class="pass-wrap">
                    <input type="password" id="password1" name="member_password" placeholder="New Password">
                    <input type="password" id="confirm_password" name="member_password2" placeholder="Password confirm">
                    <span class="pass-match" id="message"></span>
                </div>
				<script>
					$(document).ready(function(){
						$('#password1, #confirm_password').on('keyup', function (){
						  if($('#password1').val() == $('#confirm_password').val()){
							$('#message').html('');
						  }else{
							$('#message').html('*Passwords do not match');
						  }
						});
					});
                            
                  </script>
                <div class="joina-btn">
                    <button type="button" onclick="javascript:go_submit();">
                        <span>Submit</span>
                    </button>
                </div>
            </div>
        </form>
    </section>
    <script>
        $(document).ready(function() {
      $('select').niceSelect();
    });
        
    </script>
    
    <script>
        $(function() {
            //input을 datepicker로 선언
            $(".datepicker").datepicker({
				/*showMonthAfterYear: true,
				changeYear: true,
				changeMonth: true,
				dateFormat: "yy-mm-dd",
				dayNames: ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"],
				dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
				dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
				MonthNames: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
				MonthNamesShort: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"]*/
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
            
            //초기값을 오늘 날짜로 설정
        <?
			if(!$sel_row[birthday]){
		?>    
			$('#datepicker').datepicker('setDate', 'today'); //(-1D:하루전, -1M:한달전, -1Y:일년전), (+1D:하루후, -1M:한달후, -1Y:일년후)            
        <?
		}	
		?>
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
</body>
</html>