<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
//echo('<pre>'); print_r($_POST); echo('</pre>'); //exit;

$mem_info_sql = "select user_id,nation,membership_no,sns_kind from member_info where 1 and idx = '".$_SESSION['member_coinc_idx']."' and del_yn='N'";
$mem_info_query = mysqli_query($gconnet,$mem_info_sql);
if(mysqli_num_rows($mem_info_query) == 0){
	error_popup("There are no registered members.");
}
$mem_info_row = mysqli_fetch_array($mem_info_query);

$sql_pre2 = "select idx from member_register_survey where 1 and member_idx='".$_SESSION['member_coinc_idx']."'"; 
$result_pre2  = mysqli_query($gconnet,$sql_pre2);
if(mysqli_num_rows($result_pre2) > 0){
	error_popup("Already subscribed to the online panel.");
}

$member_idx = $_SESSION['member_coinc_idx'];
$user_id = trim($mem_info_row['user_id']);
$nation = trim($mem_info_row['nation']);
$membership_no = trim($mem_info_row['membership_no']);
$sns_kind = trim($mem_info_row['sns_kind']);
$attach_count_1 = trim(sqlfilter($_REQUEST['attach_count_1'])); 

	$member_sect_str = "";

	$gender = trim(sqlfilter($_REQUEST["gender"]));
	$birthday = trim(sqlfilter($_REQUEST['birthday']));
	$country = trim(sqlfilter($_REQUEST["country"]));
	$marriage_state = trim(sqlfilter($_REQUEST["marriage_state"]));
	$children_have = trim(sqlfilter($_REQUEST["children_have"]));
	$family_members_live = trim(sqlfilter($_REQUEST["family_members_live"]));
	$live_area = trim(sqlfilter($_REQUEST["live_area"]));
	$region_1 = trim(sqlfilter($_REQUEST["region_1"]));
	$region_2 = trim(sqlfilter($_REQUEST["region_2"]));
	$final_education = trim(sqlfilter($_REQUEST["final_education"]));
	$job = trim(sqlfilter($_REQUEST["job"]));
	$job_txt = trim(sqlfilter($_REQUEST["job_txt"]));
	$family_income = trim(sqlfilter($_REQUEST["family_income"]));
	$religion = trim(sqlfilter($_REQUEST["religion"]));
	$religion_txt = trim(sqlfilter($_REQUEST["religion_txt"]));

	/*for($i=0; $i<$attach_count_1; $i++){ 
		$family_members_relationship = trim(sqlfilter($_REQUEST["family_members_relationship"][$i]));
	}

	for($i=0; $i<$attach_count_1; $i++){ 
		$family_members_birth_year = trim(sqlfilter($_REQUEST["family_members_birth_year"][$i]));
	}
	$family_members_birth_year1=date_create($family_members_birth_year);
	$family_members_birth_year_str=date_format($family_members_birth_year1,'Y');*/

	for($i=0; $i<$attach_count_1; $i++){ 
		if($i == $attach_count_1-1){
			$family_members_relationship_arr .= $_REQUEST["family_members_relationship"][$i];
			$family_members_birth_year_arr .= $_REQUEST["family_members_birth_year"][$i];
		} else {
			$family_members_relationship_arr .= $_REQUEST["family_members_relationship"][$i].",";
			$family_members_birth_year_arr .= $_REQUEST["family_members_birth_year"][$i].",";
		}
	}

	$query = " insert into member_register_survey set "; 
	$query .= " member_idx = '".$member_idx."', ";
	$query .= " user_id = '".$user_id."', ";
	$query .= " birthday = '".$birthday."', ";
	$query .= " gender = '".$gender."', ";
	$query .= " country = '".$country."', ";
	$query .= " marriage_state = '".$marriage_state."', ";
	$query .= " children_have = '".$children_have."', ";
	$query .= " family_members_live = '".$family_members_live."', ";
	$query .= " family_members_relationship ='".$family_members_relationship_arr."',";
	$query .= " family_members_birth_year ='".$family_members_birth_year_arr."',";
	$query .= " live_area = '".$live_area."', ";
	$query .= " region_1 = '".$region_1."', ";
	$query .= " region_2 = '".$region_2."', ";
	$query .= " final_education = '".$final_education."',";
	$query .= " job = '".$job."', ";
	$query .= " job_txt = '".$job_txt."', ";
	$query .= " family_income = '".$family_income."',";
	$query .= " religion = '".$religion."', ";
	$query .= " religion_txt = '".$religion_txt."', ";
	$query .= " membership_no = '".$membership_no."',";
	$query .= " sns_kind = '".$sns_kind."', ";
	$query .= " wdate = now()";
	//echo $query; exit;
	$result = mysqli_query($gconnet,$query);

	$sql_pre2 = "select idx from member_register_survey where 1 order by idx desc limit 0,1"; 
	$result_pre2  = mysqli_query($gconnet,$sql_pre2);
	$mem_row2 = mysqli_fetch_array($result_pre2);
	$register_survey_idx = $mem_row2['idx']; 

	$point_sect = "refund"; // 포인트 

	########### 회원가입시 포인트  적립시작 #################
	$sql_member_in = "select member_in_survey from member_point_set where 1 and point_sect='".$point_sect."' and coin_type='member' order by idx desc limit 0,1 "; // 포인트  설정 테이블에서 회원가입시의 설정값을 추출한다.
	$result_member_in = mysqli_query($gconnet,$sql_member_in);

	if(mysqli_num_rows($result_member_in)==0) {
		$chg_mile = 0; 
	} else {
		$row_member_in = mysqli_fetch_array($result_member_in); 
		$chg_mile = $row_member_in[member_in_survey];
	}

	$mile_title = "Membership join survey points earned"; // 포인트  적립 내역
	$mile_sect = "A"; // 포인트  종류 = A : 적립, P : 대기, M : 차감
	coin_plus_minus($point_sect,$member_idx,$mile_sect,$chg_mile,$mile_title,"","","");
	if($sns_kind == "fb"){
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
	alert('Registration has been successfully completed.');
	//parent.location.href =  "panel-join-complete.php?idx=<?=$member_idx?>&user_id=<?=$user_id?>&sns_kind=<?=$sns_kind?>&membership_no=<?=$membership_no?>&nation=<?=$nation?>";
	parent.location.href =  "panel-join-complete.php?idx=<?=$member_idx?>&register_survey_idx=<?=$register_survey_idx?>";
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