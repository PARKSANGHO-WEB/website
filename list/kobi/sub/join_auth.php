<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$user_id = trim(sqlfilter($_REQUEST['user_id']));

$resJSON = array("success"=>"false", "msg"=>"");

$mb_auth=sprintf('%04d',rand(0000,9999));;

$from_email = "contact@kobiinsight.co.kr";
$from_name = "KOBI insight";
$to_email = $user_id;

$subject ="[".$from_name."]  Your Certification Number";
$body = "인증번호는 ".$mb_auth." 입니다.";

$sql = "insert into member_info_key set ";
$sql .="user_id = '".$to_email."',";
$sql .="sign_key = '".$mb_auth."',";
$sql .="sign_ok = 'N',";
$sql .="wdate = now()";

$result = mysqli_query($gconnet,$sql);

mail_utf($from_email,$from_name,$to_email,$subject,$body);

if($result){
		$resJSON["success"] = "true";
		$resJSON["msg"] = '이메일 인증 전송을 하였습니다.';
		echo json_encode($resJSON);
	} else {
		$resJSON["msg"] = '이메일 인증 전송을 실패 하였습니다..';
		echo json_encode($resJSON);
		exit;
	}
?>
