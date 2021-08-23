<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
	$idx = $_REQUEST['idx'];
    $mem_idx = $_REQUEST['mem_idx'];
    $mem_pwd = $_REQUEST['mem_pwd'];
    $mem_name = $_REQUEST['mem_name'];
    $mem_level = $_REQUEST['mem_level'];
    $flag = $_REQUEST['flag'];
    $tel1 = $_REQUEST['tel1'];
    $tel2 = $_REQUEST['tel2'];
    $tel3 = $_REQUEST['tel3'];
    $mem_tel = $tel1.'-'.$tel2.'-'.$tel3;

    $email1 = $_REQUEST['email1'];
    $email2 = $_REQUEST['email2'];
    $email = $email1.'@'.$email2;


    $query = "update tb_adminuser set";
    $query .= " mem_idx = '".$mem_idx."',";
    $query .= " mem_name = '".$mem_name."',";
    if($_REQUEST['mem_pwd']){
        $query .= " mem_pwd = '".$mem_pwd."',";
    }
    $query .= " mem_tel = '".$mem_tel."',";
    $query .= " email = '".$email."',";
    $query .= " mem_level = '".$mem_level."',";
    $query .= " flag = '".$flag."'";
    $query .= " where 1 and idx = '".$idx."'";
    $result = mysqli_query($gconnet,$query);
    

    
	if($result){
		error_frame_go("정상적으로 수정 되었습니다.","setting-admin.php");
		
	} else {
		error_frame_go("오류가 발생했습니다.","setting-admin.php");
	}
?>

