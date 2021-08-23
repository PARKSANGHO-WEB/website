<? include "../include/header_sub.php"?>
<link rel="stylesheet" href="../css/my-page.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../js/menu.js"></script>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1.0">
<body>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/check_login.php"; ?>
   <? include "../include/gnb_sub1.php"?> 

    
    <section class="about-ci my-page">
        <div class="sub-banner">
            <div class="ban-text">
                <div class="root">
                    <ul>
                        <li>
                            <a href="../index.php">Home</a>
                        </li>
                        <li class="arrow">></li>
                        <li>
                            <a href="./my-page.php">Mypage</a>
                        </li>
                    </ul>
                </div>
                <div class="ban-ment">
                    <span class="ban-title">MY PAGE</span>
                    <span class="ban-text">WE LISTEN TO <strong>YOUR VOICES</strong> ON MEDICAL, SOCIAL AND INDUSTRIAL ISSUES</span>
                </div>
			</div>
		</div>
<?
	$s_sql = "select * from member_info where idx='".$_SESSION['member_coinc_idx']."'";
	$s_res =  mysqli_query($gconnet,$s_sql);
	$s_row =  mysqli_fetch_array($s_res);

	//echo $s_sql."<br>";

	$p_sql = "select * from member_point where member_idx='".$s_row[idx]."' order by idx desc limit 0,1";
	$p_res =  mysqli_query($gconnet,$p_sql);
	$p_row =  mysqli_fetch_array($p_res);


	$re_sql = "select * from member_register_survey where member_idx='".$s_row[idx]."'";
	$re_res =  mysqli_query($gconnet,$re_sql);
	$re_row =  mysqli_fetch_array($re_res);
?>
		<div class="contanier">
			<div class="content point-info">
				<div class="card area">
					<p class="point"><?=$p_row[cur_mile]?>P</p>
					<p class="membership-number"><?=$s_row['membership_no']?></p>
				</div>
				<div class="info area">
					<p class="id">ID : <?=$s_row['user_id']?></p>
					<p class="e-mail">Email : <?=$s_row['email']?> 
					<?
						if($s_row[sns_kind]=="fb"){
					?>
					<span class="label">Facebook</span>
					<?}?>
					</p>
					<div class="btn-wrap">
						<a href="join_update.php?idx=<?=$s_row[idx]?>" class="btn">회원 정보 수정</a>
						<a href="panel_update.php?member_idx=<?=$s_row[idx]?>" class="btn">패널 가입/수정</a>
						<a href="javascript:;"  class="btn del-btn">회원탈퇴</a>
					</div>
				</div>
			</div>
			<div class="content point-history">
				<table class="history-table">
					<caption>Point history</caption>
					<colgroup>
						<col width="15%">
						<col width="20%">
						<col width="65%">
					</colgroup>
					<tr>
						<th>적립날짜</th>
						<th>적립포인트</th>
						<th>적립내용</th>
					</tr>
				<?
				$r_sql = "select * from member_point where member_idx='".$s_row[idx]."' order by idx desc";
				$r_res =  mysqli_query($gconnet,$r_sql);
				while($r_row =  mysqli_fetch_array($r_res)){
				?>	
					<tr>
						<td><?=substr($r_row[wdate],0,10)?></td>
						<td><?=$r_row[chg_mile]?></td>
						<td><?=$r_row[mile_title]?></td>
					</tr>
				<?}?>		

					<!-- <tr>
						<td>0000-00-00</td>
						<td>800</td>
						<td>회원가입</td>
					</tr>
					<tr>
						<td>0000-00-00</td>
						<td>800</td>
						<td>회원가입</td>
					</tr>
					<tr>
						<td>0000-00-00</td>
						<td>800</td>
						<td>회원가입</td>
					</tr>
					<tr>
						<td>0000-00-00</td>
						<td>800</td>
						<td>회원가입</td>
					</tr>
					<tr>
						<td>0000-00-00</td>
						<td>800</td>
						<td>회원가입</td>
					</tr>
					<tr>
						<td>0000-00-00</td>
						<td>800</td>
						<td>회원가입</td>
					</tr> -->
				</table>
			</div>
		</div>
    </section>

<script type="text/javascript">
$(document).ready(function(){

 $("#btn_submit").on("click", function(){
	
	/*var user_pwd = $("#user_pwd").val();

	if(user_pwd == ""){
		alert("Please enter your PASSWORD");
		$("#user_pwd").focus();
		return;
	}*/
		//if(confirm('정말로 회원탈퇴를 하시겠습니까?')){	
			$("#frm").submit();
		//}
	});
 });
</script>
    <div class="del-modal">
    	
		<div class="delete-con">
			<form action="member_delete.php" name="frm" id="frm" method="post" target="_fra">
			<input type="hidden" name="idx" value="<?=$s_row[idx]?>">
			<input type="hidden" name="user_id" value="<?=$s_row[user_id]?>">
				<p>정말로 회원탈퇴를 하시겠습니까?</p>
				<!--<p>비밀번호를 입력해주세요.</p>
				<input type="password" name="user_pwd" id="user_pwd" placeholder="password">-->
				<div class="btn-del" style="margin-top:10px;">
					<button class="del-can" type="button">취소</button>
					<button type="button" id="btn_submit" type="button">확인</button>
				</div>
			</form>
		</div>
    </div>
    
    <script>
		
		$(document).ready(function(){
			$('.using-btn').on('click',function(){
				$('.policy-modal').removeClass('visible');
				$('.terms-modal').addClass('visible');
			});
			$('.privacy-btn').on('click',function(){
				$('.terms-modal').removeClass('visible');
				$('.policy-modal').addClass('visible');
			});
			$('.modal-close').on('click',function(){
				$('.modal-al').removeClass('visible');
			});
			
			$('.del-btn').on('click',function(){
				$('.del-modal').addClass('visible');
			});
			
			$('.del-can').on('click',function(){
				$('.del-modal').removeClass('visible');
			});
		});
	
	</script>
    <script>
        $(document).ready(function(){           
            
            
            $('.visual-slider').bxSlider({
              auto: true,
              pager: true,
              mode: 'fade',
              hideControlOnEnd:true
            });
            
            $('.cont1-slider').bxSlider({
              auto: true,
              pager: true,
              hideControlOnEnd:true
            });
        });
        
        
        $(document).ready(function(){    
        var tabBtn = $("#tab-btn > ul > li");     //각각의 버튼을 변수에 저장
        var tabCont = $("#tab-cont > div");       //각각의 콘텐츠를 변수에 저장

        //컨텐츠 내용을 숨겨주세요!
        tabCont.hide().eq(0).show();

        tabBtn.click(function(){
          var target = $(this);         //버튼의 타겟(순서)을 변수에 저장
          var index = target.index();   //버튼의 순서를 변수에 저장
          //alert(index);
          tabBtn.removeClass("active");    //버튼의 클래스를 삭제
          target.addClass("active");    //타겟의 클래스를 추가
          tabCont.css("display","none");
          tabCont.eq(index).css("display", "block");
        });
        
        
        });
    </script>
	<? include "../include/footer_sub.php"?>