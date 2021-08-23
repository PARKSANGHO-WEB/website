<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

    $mode = trim(sqlfilter($_POST['mode']));
    $ridx = trim(sqlfilter($_POST['ridx']));
    $hidx = trim(sqlfilter($_POST['hidx']));
    $sidx = trim(sqlfilter($_POST['sidx']));

    $resJSON = array("success"=>"false", "msg"=>"");
    $message = "";
    $result  = "true";

     
    if($mode == "CHECK"){
        $sql = " select count(*) cnt from tb_survey_answer where cidx = '{$_COMPANY_ID}' and ridx = '{$ridx}' ";

        $result_query = mysqli_query($gconnet,$sql);
        $row = mysqli_fetch_array($result_query);

        if($row['cnt'] > 0){
            $result = "false";
            $message = "이미 설문에 참여했습니다.";
        }

    }else if($mode == "SAVE"){
        foreach($_POST as $key => $val){


            if(substr($key , 0, 5) == "qidx_" ){

                $qidx = str_replace("qidx_","", $key);
                $val = trim(sqlfilter($val));

                $sql = " INSERT into tb_survey_answer (cidx, sidx, hidx, ridx, qidx, answer,  sano, wdate)  ";
                $sql .= " values ({$_COMPANY_ID}, {$sidx}, {$hidx}, {$ridx}, {$qidx}, '{$val}', '{$_SESSION['EMP_NO']}', now()) ";

                $result_query = mysqli_query($gconnet,$sql);

                if($result_query == false){

                    $sql = " DELETE FROM tb_survey_answer WHERE cidx = '{$_COMPANY_ID}' AND sidx = '{$sidx}' AND ridx = '{$ridx}'  ";
                    mysqli_query($gconnet,$sql);

                    $resJSON["success"] = "false";
                    $resJSON["msg"] = "설문내용 저장 중 오류가 발생하였습니다. \n관리자에게 문의하시기 바랍니다.";

                    echo json_encode($resJSON);
                    exit;
                }

            }

        }

        foreach($_POST as $key => $val){
            
            if(substr($key , 0, 4) == "etc_" ){    
                $qidx = str_replace("etc_","", $key);

                $sql = " UPDATE tb_survey_answer SET etc =  '{$val}' WHERE cidx = '{$_COMPANY_ID}' AND sidx = '{$sidx}' AND ridx = '{$ridx}' AND qidx = '{$qidx}'   "; 
                $result_query = mysqli_query($gconnet,$sql);

            }
        }    

        if($result == "true"){
            $message = "설문내용이 저장되었습니다. \n설문에 참여해 주셔서 감사합니다.";
        }
    }

    $resJSON["success"] = $result;
    $resJSON["msg"] = $message;

    echo json_encode($resJSON);
    exit;      



?>    