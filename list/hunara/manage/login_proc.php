<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
    $mode = trim(sqlfilter($_REQUEST['mode']));
	$type = trim(sqlfilter($_REQUEST['type']));  
	$id = trim(sqlfilter($_REQUEST['id']));
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


    $sql = "";

    if($type == "SYS_ADMIN"){
        $sql = " SELECT idx, mem_idx, mem_pwd,  mem_name, mem_tel, '00' as mem_level, '' as cdomain";
        $sql .= " FROM tb_adminuser                 ";
        $sql .= " WHERE mem_idx = '{$id}'           ";
        $sql .= "   AND flag = 'Y'      ";

    }else if($type == "CO_ADMIN" ){
        $sql = " SELECT idx, cdomain as mem_idx, co_password as mem_pwd, comname as mem_name, tel as mem_tel, '10' as mem_level, cdomain";
        $sql .= " FROM tb_company                 ";
        $sql .= " WHERE idx = '{$id}'           ";

    }else if($type == "HU_ADMIN" ){
        $sql = " SELECT idx, comname as mem_idx, pwd as mem_pwd, comname as mem_name, tel as mem_tel, '20' as mem_level, '' as cdomain";
        $sql .= " FROM tb_hu                 ";
        $sql .= " WHERE idx = '{$id}'           ";

    }

    $rs = mysqli_query($gconnet, $sql);    

    if(mysqli_num_rows($rs) > 0){
        $row = mysqli_fetch_array($rs);

        if($mode == "LOGIN"){
            /********************************************************************************************** 
             * 로그인 
            ***********************************************************************************************/

            if($row['mem_pwd'] == $pwd){

                $result = "true";
                $_SESSION['ADMIN_IDX'] = $row['idx'];
                $_SESSION['MEM_IDX'] = $row['mem_idx'];
                $_SESSION['MEM_NAME'] = $row['mem_name'];
                $_SESSION['MEM_LEVEL'] = $row['mem_level'];
                $_SESSION['HOMEPAGE'] = $row['cdomain'];

            }else{
                $message = "비밀번호가 일치 하지 않습니다.";
            }

        }

    }else{
        $message = "아이디와 비빌번호가 일치 하는 데이타가 없습니다. \n다시 입력하여 주시기 바랍니다.";
    }

    $resJSON["success"] = $result;
    $resJSON["msg"] = $message;

    echo json_encode($resJSON);
    exit;

?>