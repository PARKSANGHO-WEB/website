<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

	$member_sect_str = "";
	
	$user_id = trim(sqlfilter($_REQUEST['user_id']));
	$user_pwd = trim(sqlfilter($_REQUEST['user_pwd']));
	$user_pwd = md5($user_pwd);
	$user_name = trim(sqlfilter($_REQUEST['user_name']));
	$cell = trim(sqlfilter($_REQUEST['cell1'])).'-'.trim(sqlfilter($_REQUEST['cell2'])).'-'.trim(sqlfilter($_REQUEST['cell3']));
	$birthday = trim(sqlfilter($_REQUEST['birthday1'])).'-'.trim(sqlfilter($_REQUEST['birthday2']));
	$sns_kind = trim(sqlfilter($_REQUEST['sns_kind']));

	$email = trim(sqlfilter($_REQUEST['emailhead'])).'@'.trim(sqlfilter($_REQUEST['emailtail']));
	$mail_ok = trim(sqlfilter($_REQUEST['mail_ok']));
	
	$com_name = trim(sqlfilter($_REQUEST['com_name']));
	$jobposition = trim(sqlfilter($_REQUEST['jobposition']));
	$consult = trim(sqlfilter($_REQUEST['consult']));
	$com_addr = trim(sqlfilter($_REQUEST['com_addr']));


	$sql_pre5 = "select * from member_info_key where user_id = '".$user_id."' "; // 회원테이블 아이디 중복여부 체크
	$result_pre5  = mysqli_query($gconnet,$sql_pre5);
	$row_pre5 = mysqli_fetch_array($result_pre5);
	
	if($row_pre5[sign_ok]=="N") {

		error_frame("이메일인증확인이 되지 않았습니다.");
	}


	$login_ok = "Y"; // 최초 가입시 로그인 허용
	$master_ok = "N"; // 관리자 등록시 Y, 자가 등록시 N
	$ad_mem_sect = "N"; // 관리자 입력여부. 
	$memout_yn = "N"; // 탈퇴신청시 Y , 디폴트는 N 
	$mail_ok = "Y"; // 이메일 수신 허용
	$member_type = "GEN"; // 일반회원
	$member_gubun = "NOR"; // 일반회원

	$member_level_basic_sql = "select level_code from member_level_set where 1 and level_type='".$member_type."' order by idx asc limit 0,1"; // 회원가입시 기본설정 등급코드 추출  
	$member_level_basic_query = mysqli_query($gconnet,$member_level_basic_sql);
	$member_level_basic_row = mysqli_fetch_array($member_level_basic_query);
	$user_level = $member_level_basic_row['level_code'];
	
	$query = " insert into member_info set "; 
	$query .= " member_type = '".$member_type."', ";
	$query .= " member_gubun = '".$member_gubun."', ";
	$query .= " push_key = '".$push_key."', ";
	$query .= " user_id = '".$user_id."', ";
	if($sns_kind =="kt" || $sns_kind =="nv" || $sns_kind =="gp"){
	$query .= " user_pwd = '', ";
	}else{
	$query .= " user_pwd = '".$user_pwd."', ";
	}
	$query .= " user_name = '".$user_name."', ";
	$query .= " cell = '".$cell."', ";
	$query .= " birthday = '".$birthday."', ";
	$query .= " login_ok = '".$login_ok."', ";
	$query .= " master_ok = '".$master_ok."', ";
	$query .= " mail_ok = '".$mail_ok."', ";
	$query .= " ad_mem_sect = '".$ad_mem_sect."', ";
	$query .= " memout_yn = '".$memout_yn."', ";
	$query .= " com_name = '".$com_name."', ";
	$query .= " jobposition = '".$jobposition."', ";
	$query .= " consult = '".$consult."', ";
	$query .= " com_addr = '".$com_addr."', ";
	$query .= " sns_kind = '".$sns_kind."', ";
	$query .= " wdate = now() ";

	//echo $query;

	$result = mysqli_query($gconnet,$query);

	
	$from_email = "contact@kobiinsight.co.kr";
	$from_name = "KOBI insight";
	$to_email = $user_id;

	$subject = "[".$from_name."] Thank you for signing up";
	$body = $user_name."님의 가입을 진심으로 축하합니다.";

	mail_utf($from_email,$from_name,$to_email,$subject,$body);
	

	$member_idx = mysqli_insert_id();

	if($member_idx == 0){
		$member_idx_sql = "select idx from member_info where 1 order by idx desc limit 0,1";
		$member_idx_query = mysqli_query($gconnet,$member_idx_sql);
		$member_idx_row = mysqli_fetch_array($member_idx_query);
		$member_idx = $member_idx_row['idx'];
	}
	

	if($sns_kind == "kt"){
		$_SESSION['member_coinc_id'] = $user_id;
		$_SESSION['member_coinc_name'] = $user_name;
	}else if($sns_kind == "nv"){
			$_SESSION['member_coinc_id'] = $user_id;
			$_SESSION['member_coinc_name'] = $user_name;
	}else if($sns_kind == "gp"){
			$_SESSION['member_coinc_id'] = $user_id;
			$_SESSION['member_coinc_name'] = $user_name;
	}else{
		$_SESSION['member_coinc_id'] = $user_id;
		$_SESSION['member_coinc_name'] = $user_name;
		$_SESSION['member_coinc_password'] = $user_pwd;
	}


	if($result){
	?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('등록이 정상적으로 완료 되었습니다.');
	//parent.location.href =  "member_list.php?<?=$total_param?>";
	parent.location.href =  "../main.php";
	//-->
	</SCRIPT>
	<?}else{?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('등록중 오류가 발생했습니다.');
	history.back();
	//-->
	</SCRIPT>
	<?}?>
 