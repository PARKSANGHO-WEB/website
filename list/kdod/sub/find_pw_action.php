<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$user_id = trim(sqlfilter($_REQUEST['user_id']));
$user_name = trim(sqlfilter($_REQUEST['user_name']));
$email = trim(sqlfilter($_REQUEST['email']));

$prev_sql = "select idx,user_id,user_name,email FROM member_info where 1 and user_id = '".$user_id."' and user_name='".$user_name."' and email = '".$email."' and memout_yn != 'Y' and del_yn='N'";
$prev_result = mysqli_query($gconnet,$prev_sql);

if(mysqli_num_rows($prev_result) > 0){ // 해당하는 계정이 있다.

	$prev_row = mysqli_fetch_array($prev_result);
	$idx = $prev_row['idx'];
	$user_id = $prev_row['user_id'];
	$email = $prev_row['email'];
	$user_name = $prev_row['user_name'];
	$member_code = $prev_row['member_code'];

	$tmp_pass = strtolower(randomChar(2)).substr(time(),6,4).strtolower(randomChar(2)); // 임시 비번 생성
	$tmp_pass_in = md5($tmp_pass); // 생성한 임시 비번을 암호화
	$sql_pre = "update member_info set user_pwd = '".$tmp_pass_in."' where idx='".$idx."'";
	$result_pre  = mysqli_query($gconnet,$sql_pre);

	$FROMNAME = "K-DOT";
	$FROMEMAIL = "no-reply@k-dod.com";  //관리자 메일 수정요함!
	$SUBJECT = "[K-DOT] 임시 비밀번호가 발급 되었습니다.";
	$tomail = $email;
				
		$content = "
		<table cellpadding=\"0\" cellspacing=\"0\" style=\"width:646px;border:1px solid #dddddd;border-top:3px solid #3e4348;\">
        <tr>
        <td colspan=\"3\" style=\"height:23px;\"></td>
    </tr>
    <tr>
        <td style=\"width:56px;\"></td>
        <td style=\"width:533px;\">
            <table cellpadding=\"0\" cellspacing=\"0\" style=\"width:533px;height:209px;\">
                <tr>
                    <td style=\"height:43px;border-bottom:2px solid #333;font-weight:bold;font-size:20px;font-family:'맑은 고딕','Malgun Gothic';color:#333333;\">비밀번호 찾기</td>
                </tr>
                <tr>
                    <td style=\"height:70px;background-color:#f7f7f7;\"></td>
                </tr>
                <tr>
                    <td style=\"text-align:center;font-weight:bold;font-size:16px;font-family:'돋움','Dotum';color:#333333;line-height:23px;background-color:#f7f7f7;\">".$user_name." 회원님의 임시비밀번호는</td>
                </tr>
                <tr>
                    <td style=\"height:12px;background-color:#f7f7f7;\"></td>
                </tr>
                <tr>
                    <td style=\"text-align:center;font-size:13px;font-family:'돋움','Dotum';color:#666666;line-height:16px;background-color:#f7f7f7;\"><font style=\"font-size:16px;color:#e03f4e;font-weight:bold;\">".$tmp_pass."</font> 입니다.</td>
                </tr>
                <tr>
                    <td style=\"height:70px;border-bottom:1px solid #ddd;background-color:#f7f7f7;\"></td>
                </tr>
                <tr>
                    <td style=\"height:55px;\"></td>
                </tr>
                <tr>
                    <td style=\"text-align:center;\"><a href=\"http://k-dod.com/\" style=\"display:inline-block;\" target=\"_blank\">K-DOT 바로가기</a></td>
                </tr>
            </table>
        </td>
        <td style=\"width:55px;\"></td>
    </tr>
    <tr>
        <td colspan=\"3\" style=\"height:45px;\"></td>
    </tr>
    </table>
		";

		$content = $content;

		//$pwd_mail = mail_utf($FROMEMAIL,$FROMNAME,$tomail, $SUBJECT, $content); // 메일을 발송한다.

		$url = "http://webmarker2.cafe24.com/out_mail.php";
		$data = array(
			"FROMEMAIL" => $FROMEMAIL, // 보내는 메일 
			"FROMNAME" => $FROMNAME, // 보내는사람 이름 
			"tomail" => $tomail, // 받는메일 
			"SUBJECT" => $SUBJECT, // 메일제목 
			"content" => $content // 메일내용
		);
		$pwd_mail = get_curl_post($url,$data,"");

		if($pwd_mail){
			$mail_ok = "Y";
		} else {
			$mail_ok = "N";
		}
			
	if($mail_ok == "Y"){
		error_go("회원님 가입당시 입력하신 메일주소 ".$email." 로 임시비밀번호가 전송되었습니다.","/");
	}else{
		error_back("임시비밀번호 전송중 오류가 발생했습니다.");
	}

} else { // 해당하는 계정이 없다.
	error_back('입력하신 정보에 일치하는 계정이 없습니다. 다시 확인하시고 입력해 주세요.');
} // 계정여부 종료 
?>