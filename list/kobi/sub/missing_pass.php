<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$pm_id = trim(sqlfilter($_REQUEST['user_id']));

$reurl_go = trim(sqlfilter($_REQUEST['reurl_go']));
//exit;


$rand_string="abcdefghijklmnopqrstuvwxyz0123456789"; //영 소문자
$mb_pass="";//임시비밀번호
for($i=0;$i<11;$i++){//8자리만 만들 수 있게
	$mb_pass.=substr($rand_string,rand(0,strlen($rand_string)),1);//랜덤으로 영문자 또는 숫자 지정
}
$pm_pwd2 = md5($mb_pass);

$sql = "select * from member_info where 1 and user_id='".$pm_id."' and member_type='GEN'";
//echo $sql;
$result = mysqli_query($gconnet,$sql);
$row = mysqli_fetch_array($result);

if($pm_id != $row[user_id]){
	echo "<script>";
	echo "alert('찾으려는 정보가 없습니다.');";
	echo "history.back();";
	echo "</script>";
}else{


if($row[sns_kind] =="kt" || $row[sns_kind] =="nv" || $row[sns_kind] =="gp"){
	echo "<script>";
	echo "alert('소셜로그인 회원은 이용할수 없습니다.');";
	echo "history.back();";
	echo "</script>";
}else{
		$sql2 = "update member_info set ";
		$sql2 .= "user_pwd = '".$pm_pwd2."'";
		$sql2 .= "where user_id='".$pm_id."'";
		$result2 = mysqli_query($gconnet,$sql2);


		$from_email = "contact@kobiinsight.co.kr";
		$from_name = "kobiinsight";
		$to_email = $pm_id;

		$subject = "[".$row[user_name]."] is password Notify";
		$body = "임시비밀번호:".$mb_pass."";


		mail_utf($from_email,$from_name,$to_email,$subject,$body);
}

if($result2){
?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('임시 패스워드가 전송되었습니다.');
	//parent.location.href =  "member_list.php?<?=$total_param?>";
	parent.location.href =  "login.php";
	//-->
	<?}
}
?>