<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
    
	$sano 	= trim(sqlfilter($_REQUEST['sano']));
	$name 	= trim(sqlfilter($_REQUEST['name']));
    $pwd  	= trim(sqlfilter($_REQUEST['pwd']));
    $email	= trim(sqlfilter($_REQUEST['email']));
    $tel 	= trim(sqlfilter($_REQUEST['tel']));
    $hp 	= trim(sqlfilter($_REQUEST['hp']));
    $resJSON = array("success"=>"false", "msg"=>"");
    $message = "";
    $result  = "false";



    /* 비밀번호 조회 */
    $sql = " SELECT  pwd FROM tb_employee ";
    $sql .= " WHERE seq = '{$_SESSION['EMP_SEQ']}'    ";

    $rs = mysqli_query($gconnet, $sql);    
    $row = mysqli_fetch_array($rs);
    
    
    //if($row['pwd'] == $pwd){

        $query = " UPDATE tb_employee ";
        $query .= " SET  email = '{$email}', tel = '{$tel}', hp = '{$hp}', pwd = '{$pwd}' ";
        $query .= " WHERE  seq = ".$_SESSION['EMP_SEQ'];
                    
        $result_query = mysqli_query($gconnet,$query);

        if($result_query){
            $result = "true";
            $message = "수정 되었습니다.";
            

            $_SESSION['EMP_EMAIL'] = $email;
            $_SESSION['EMP_TEL'] = $tel;
            $_SESSION['EMP_HP'] = $hp;
            
            
        }else{
            $message = "수정 중 오류가 발생했습니다. 관리자에게 문의해 주세요.";
        }
    //}else{
        //$message = "비밀번호가 일치하지 않습니다.";
    //}    	
    	
    
    $resJSON["success"] = $result;
    $resJSON["msg"] = $message;

    echo json_encode($resJSON);
    exit;

?>