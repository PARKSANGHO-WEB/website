<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$resJSON = array("success"=>"false", "msg"=>"");
$sign_key = trim(sqlfilter($_REQUEST['sign_key']));

$sel_sql = "select * from member_info_key where sign_key ='".$sign_key."'";
$sel_result = mysqli_query($gconnet,$sel_sql);
$sel_row = mysqli_fetch_array($sel_result);

if($sign_key == $sel_row[sign_key]){
	$sql = "update  member_info_key set ";
	$sql .="sign_ok = 'Y'";
	$sql .="where sign_key='".$sign_key."'";	
	$result = mysqli_query($gconnet,$sql);
}else{
	$resJSON["msg"] = '입력하신 인증번호와 맞지 않습니다.';
	echo json_encode($resJSON);
	exit;
}
if($result){
		$resJSON["success"] = "true";
		$resJSON["msg"] = '이메일 인증이 완료 하였습니다.';
		echo json_encode($resJSON);
	} else {
		$resJSON["msg"] = '이메일 인증이 실패 하였습니다..';
		echo json_encode($resJSON);
		exit;
	}
?>
