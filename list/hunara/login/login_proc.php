<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
    $mode = trim(sqlfilter($_REQUEST['mode']));
	$sano = trim(sqlfilter($_REQUEST['sano']));
	$name = trim(sqlfilter($_REQUEST['name']));
    $pwd  = trim(sqlfilter($_REQUEST['pwd']));
    $resJSON = array("success"=>"false", "msg"=>"");
    $message = "";
    $result  = "false";


    /********************************************************************************************** 
    * 로그아웃 
    ***********************************************************************************************/
    if($mode == "LOGOUT"){
    	session_unset();

        $resJSON["success"] = "true";
    
        echo json_encode($resJSON);
        exit;         
    }

    // 사원 정보 조회
    $sql = " SELECT seq, pwd, cdx, sano, name, digit7, email, tel, hp, daycnt, year5, manychild, freshman  ";
    $sql .= " FROM tb_employee ";
    $sql .= " WHERE cdx = '{$_COMPANY_ID}'    ";
    $sql .= "   AND sano = '{$sano}'     ";
    $sql .= "   AND name  = '{$name}'    ";

    $rs = mysqli_query($gconnet, $sql);    
    $row = mysqli_fetch_array($rs);

    if(mysqli_num_rows($rs) > 0){

        if($mode == "LOGIN"){
            /********************************************************************************************** 
             * 로그인 
            ***********************************************************************************************/

            if($row['pwd'] == $pwd){

                $result = "true";
                $_SESSION['EMP_SEQ'] = $row['seq'];
                $_SESSION['EMP_CDX'] = $row['cdx'];
                $_SESSION['EMP_NO'] = $row['sano'];
                $_SESSION['EMP_NM'] = $row['name'];
                $_SESSION['EMP_DIGIT'] = $row['digit7'];
                $_SESSION['EMP_EMAIL'] = $row['email'];
                $_SESSION['EMP_DAY_CNT'] = $row['daycnt'];
		        $_SESSION['EMP_TEL'] = $row['tel'];
		        $_SESSION['EMP_HP'] = $row['hp'];                

            }else if(empty($row['pwd'])){
                $message = "최초 로그인 시 비밀번호 설정이 필요합니다.";
            }else{
                $message = "비밀번호가 일치 하지 않습니다.";
            }
        }else if($mode == "SAVE_PW"){
            /********************************************************************************************** 
             * 비밀번호 설정 
            ***********************************************************************************************/
            if(empty($row['pwd'])){
                $query = " UPDATE tb_employee SET pwd = '{$pwd}' WHERE cdx = '{$_COMPANY_ID}' AND sano = '{$sano}' AND name='{$name}' ";
                
                $result_query = mysqli_query($gconnet,$query);

                if($result_query){
                    $result = "true";
                }else{
                    $message = "오류가 발생했습니다. 관리자에게 문의해 주세요.";
                }

            }else{
                $message = "비밀번호가 이미 설정되어 있습니다.";
            }

        }
    }else{
        $message = "입력 정보가 다르거나 \n현재 신청 대상자가 아닙니다.";
    }

    $resJSON["success"] = $result;
    $resJSON["msg"] = $message;

    echo json_encode($resJSON);
    exit;

?>