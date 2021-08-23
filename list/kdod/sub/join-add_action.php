<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
	$member_sect_str = "";
	
	$user_id = trim(sqlfilter($_REQUEST['user_id']));
	$user_pwd = trim(sqlfilter($_REQUEST['user_pwd']));
	$user_pwd = md5($user_pwd);
	$user_name = trim(sqlfilter($_REQUEST['user_name']));
	$cell = trim(sqlfilter($_REQUEST['cell']));
	$birthday = trim(sqlfilter($_REQUEST['birthday']));
	$sns_kind = trim(sqlfilter($_REQUEST['sns_kind']));

	//echo "birthday = ".$birthday."<br>"; exit;
	
	//$email = trim(sqlfilter($_REQUEST['emailhead'])).'@'.trim(sqlfilter($_REQUEST['emailtail']));
	$email = trim(sqlfilter($_REQUEST['email']));
	$mail_ok = trim(sqlfilter($_REQUEST['mail_ok']));

	$gender = trim(sqlfilter($_REQUEST["gender"]));
	$addr1 = trim(sqlfilter($_REQUEST["addr1"]));
	$addr2 = trim(sqlfilter($_REQUEST["addr2"]));
	$addr3 = trim(sqlfilter($_REQUEST["addr3"]));
	//$nation = trim(sqlfilter($_REQUEST["nation"]));

	$nation_txt = trim(sqlfilter($_REQUEST['nation_txt']));
	$nation_oth = trim(sqlfilter($_REQUEST['nation_txt_oth']));

	if($nation_txt == "kr"){
		$nation = "01";	
	} elseif($nation_txt == "en"){
		$nation = "02";	
	} elseif($nation_txt == "my"){
		$nation = "03";	
	} elseif($nation_txt == "cam"){
		$nation = "04";	
	} elseif($nation_txt == "others"){
		$nation = "00";	
	}
		
	$login_ok = "Y"; // 최초 가입시 로그인 허용
	$master_ok = "N"; // 관리자 등록시 Y, 자가 등록시 N
	$ad_mem_sect = "N"; // 관리자 입력여부. 
	$memout_yn = "N"; // 탈퇴신청시 Y , 디폴트는 N 
	$mail_ok = "Y"; // 이메일 수신 허용
	$member_type = trim(sqlfilter($_REQUEST['member_type']));; // 일반회원
	$member_gubun = "NOR"; // 일반회원

	$member_level_basic_sql = "select level_code from member_level_set where 1 and level_type='".$member_type."' order by idx asc limit 0,1"; // 회원가입시 기본설정 등급코드 추출  
	$member_level_basic_query = mysqli_query($gconnet,$member_level_basic_sql);
	$member_level_basic_row = mysqli_fetch_array($member_level_basic_query);
	$user_level = $member_level_basic_row['level_code'];
	
	$birthday1=date_create($birthday);
	$birthday_str=date_format($birthday1,'ym');

	$wdate=date_create(date("Ymd"));
	$wdate_str=date_format($wdate,'ymd');
	
	//$mb_rand=sprintf('%03d',rand(000,999));
	
	$cate_code_sql = "select idx from member_info where 1";
	$cate_code_query = mysqli_query($gconnet,$cate_code_sql);
	$cate_code_num = mysqli_num_rows($cate_code_query);
	$cate_code_num = $cate_code_num+1;
	if($cate_code_num < 10){
		$cate_code_ran = "000".$cate_code_num;
	} elseif($cate_code_num >= 10 && $cate_code_num < 100){
		$cate_code_ran = "00".$cate_code_num;
	} elseif($cate_code_num >= 100 && $cate_code_num < 1000){
		$cate_code_ran = "0".$cate_code_num;
	} elseif($cate_code_num >= 1000){
		$cate_code_ran = $cate_code_num;
	}

	if($nation_txt == "others"){
		$membership_no = '0-'.$gender.'-'.$birthday_str.'-'.$wdate_str.'-'.$cate_code_ran;
	} else {
		$membership_no = str_replace("0","",$nation).'-'.$gender.'-'.$birthday_str.'-'.$wdate_str.'-'.$cate_code_ran;
	}

	$query = " insert into member_info set "; 
	$query .= " member_type = '".$member_type."', ";
	$query .= " member_gubun = '".$member_gubun."', ";
	$query .= " push_key = '".$push_key."', ";
	$query .= " user_id = '".$user_id."', ";
	if($sns_kind =="fb"){
	$query .= " user_pwd = '', ";
	}else{
	$query .= " user_pwd = '".$user_pwd."', ";
	}
	$query .= " user_name = '".$user_name."', ";
	$query .= " addr1 = '".$addr1."', ";
	$query .= " addr2 = '".$addr2."', ";
	$query .= " addr3 = '".$addr3."', ";
	$query .= " nation = '".$nation."', ";
	$query .= " nation_oth = '".$nation_oth."', ";
	$query .= " cell = '".$cell."', ";
	$query .= " birthday = '".$birthday."', ";
	$query .= " gender = '".$gender."', ";
	$query .= " email = '".$email."', ";
	$query .= " login_ok = '".$login_ok."', ";
	$query .= " master_ok = '".$master_ok."', ";
	$query .= " mail_ok = '".$mail_ok."', ";
	$query .= " ad_mem_sect = '".$ad_mem_sect."', ";
	$query .= " memout_yn = '".$memout_yn."', ";
	$query .= " sns_kind = '".$sns_kind."', ";
	$query .=" membership_no = '".$membership_no."',";
	$query .= " wdate = now()";

	//echo $query;

	$result = mysqli_query($gconnet,$query);

	$from_email = "korea@k-dod.com";
	$from_name = "K-DOD Korea";
	$to_email = $email;
	//echo "to_email:".$to_email;
	$subject = "[".$from_name."] Thank you for signing up";
	$body = $user_name."Congratulations on your joining.";

	mail_utf($from_email,$from_name,$to_email,$subject,$body);
	
	$member_idx = mysqli_insert_id();

	if($member_idx == 0){
		$member_idx_sql = "select idx from member_info where 1 order by idx desc limit 0,1";
		$member_idx_query = mysqli_query($gconnet,$member_idx_sql);
		$member_idx_row = mysqli_fetch_array($member_idx_query);
		$member_idx = $member_idx_row['idx'];
	}
	
	$sql3 = "insert into member_no_save set ";
	$sql3 .="member_idx='".$member_idx."'";
	$sql3 .="membership_no='".$membership_no."',";
	$sql3 .= "wdate=now()";
	mysqli_query($gconnet,$sql3);


	$point_sect = "refund"; // 포인트 

	########### 회원가입시 포인트  적립시작 #################
	$sql_member_in = "select member_in_gen from member_point_set where 1 and point_sect='".$point_sect."' and coin_type='member' order by idx desc limit 0,1 "; // 포인트  설정 테이블에서 회원가입시의 설정값을 추출한다.
	$result_member_in = mysqli_query($gconnet,$sql_member_in);

	if(mysqli_num_rows($result_member_in)==0) {
		$chg_mile = 0; 
	} else {
		$row_member_in = mysqli_fetch_array($result_member_in); 
		$chg_mile = $row_member_in[member_in_gen];
	}

	$mile_title = "Membership points earned"; // 포인트  적립 내역
	$mile_sect = "A"; // 포인트  종류 = A : 적립, P : 대기, M : 차감
	coin_plus_minus($point_sect,$member_idx,$mile_sect,$chg_mile,$mile_title,"","","");
	
	if($sns_kind == "fb"){
		$_SESSION['member_coinc_idx'] = $member_idx;
		$_SESSION['member_coinc_id'] = $user_id;
		$_SESSION['member_coinc_name'] = $user_name;
	}else{
		$_SESSION['member_coinc_idx'] = $member_idx;
		$_SESSION['member_coinc_id'] = $user_id;
		$_SESSION['member_coinc_name'] = $user_name;
		$_SESSION['member_coinc_password'] = $user_pwd;
	}

if($result){
	?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('Registration has been successfully completed.');
	//parent.location.href =  "member_list.php?<?=$total_param?>";
	parent.location.href =  "../index.php";
	//parent.location.href =  "panel.php?idx=<?=$member_idx?>&user_id=<?=$user_id?>&sns_kind=<?=$sns_kind?>&membership_no=<?=$membership_no?>&nation=<?=$nation?>";
	//-->
	</SCRIPT>
	<?}else{?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('An error occurred during registration.');
	history.back();
	//-->
	</SCRIPT>
	<?}?>