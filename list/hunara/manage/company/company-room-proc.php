<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
    $midx = "";            
    $mode = trim(sqlfilter($_REQUEST['mode']));
    $hidx = trim(sqlfilter($_REQUEST['hidx']));
    $cidx = trim(sqlfilter($_REQUEST['cidx']));
    $flag = trim(sqlfilter($_REQUEST['flag']));
    $udate1 = trim(sqlfilter($_REQUEST['udate1']));
    $udate2 = trim(sqlfilter($_REQUEST['udate2']));
    $con5 = trim(sqlfilter($_REQUEST['con5']));
    $type = trim(sqlfilter($_REQUEST['type']));
    $weight = trim(sqlfilter($_REQUEST['weight']));
    $com_amount = trim(sqlfilter($_REQUEST['com_amount']));
    $per_amount = trim(sqlfilter($_REQUEST['per_amount']));
    $pg_yn = trim(sqlfilter($_REQUEST['pg_yn']));
    $roomArr = trim(sqlfilter($_REQUEST['roomArr']));
    $usedayArr = trim(sqlfilter($_REQUEST['usedayArr']));
    $reservation = trim(sqlfilter($_REQUEST['reservation']));

    $resJSON = array("success"=>"", "msg"=>"", "idx"=>"");
    $message = "";
    $result  = "false";

    if(empty($com_amount)) $com_amount = 0;
    if(empty($per_amount)) $per_amount = 0;

    $udate1 = str_replace("-","",$udate1);
    $udate2 = str_replace("-","",$udate2);

    if($mode == "SAVE"){

        //기업 휴양소 정보 등록
        $sql = " INSERT INTO tb_comhuM ";
        $sql .= " (hidx, cidx, flag, udate1, udate2,  con5, type, weight, com_amount, per_amount, pg_yn, reservation, wdate) ";
        $sql .= " VALUES ( '{$hidx}', '{$cidx}', '{$flag}', '{$udate1}', '{$udate2}', '{$con5}', '{$type}', '{$weight}' ";
        $sql .= "           , {$com_amount}, {$per_amount}, '{$pg_yn}', '{$reservation}', date_format(now(), '%Y%m%d%H%i%S') )";

        $result_query = mysqli_query($gconnet,$sql);

        if($result_query){
            $result  = "true";  

            $sql = " SELECT max(midx) as midx FROM tb_comhuM ";
            $rs = mysqli_query($gconnet,$sql);
            $row = mysqli_fetch_array($rs);

            $midx =  $row['midx'];     
            $resJSON["idx"] = $midx;     

            $seqArr = explode(",", $roomArr );

            //기업 휴양소 객실 정보 등록
            for($i=0; $i < count($seqArr); $i++){
                $seq = $seqArr[$i];

                $sql = " INSERT INTO tb_comhuMtype  ( midx, seq, rCnt, rType2) ";
                $sql .= " SELECT  {$midx}, seq, rCnt, rType FROM tb_huType WHERE seq = {$seq}  AND idx = {$hidx} ";

                $result_query = mysqli_query($gconnet,$sql);

            }

            //기업 휴양소 객실 이용박수 등록
            $dayArr = explode(",", $usedayArr );
            for($i=0; $i < count($dayArr); $i++){
                
                $use = explode(":", $dayArr[$i]);

                if(in_array($use[0],$seqArr)){
                    $sql = " INSERT INTO tb_comhuM_useday  ( midx, seq, useday) VALUES ( {$midx}, {$use[0]}, {$use[1]} ) ";
                    $result_query = mysqli_query($gconnet,$sql);
                }
            }

        }

        if($result_query) $result = "true";


    }else if($mode == "UPDATE"){

        $midx = trim(sqlfilter($_REQUEST['midx']));
        $seq = trim(sqlfilter($_REQUEST['seq']));

        //기업 휴양소 정보 수정
        $sql = " UPDATE tb_comhuM   ";
        $sql .=" SET flag = '{$flag}', udate1 = '{$udate1}', udate2 = '{$udate2}',  con5 = '{$con5}', type = '{$type}', weight = '{$weight}', ";
        $sql .="    com_amount = {$com_amount}, per_amount = {$per_amount}, pg_yn = '{$pg_yn}', reservation = '{$reservation}', wdate = date_format(now(), '%Y%m%d%H%i%S') ";
        $sql .=" WHERE midx = {$midx} ";
        
        $result_query = mysqli_query($gconnet,$sql);

        //기업 휴양소 객실 정보 삭제 후 재등록
        $sql = " DELETE FROM tb_comhuMtype WHERE midx = {$midx} ";
        $result_query = mysqli_query($gconnet,$sql);

        if($result_query){
            $seqArr = explode(",", $roomArr );

            //기업 휴양소 객실 정보 등록
            for($i=0; $i < count($seqArr); $i++){
                $seq = $seqArr[$i];

                $sql = " INSERT INTO tb_comhuMtype  ( midx, seq, rCnt, rType2) ";
                $sql .= " SELECT  {$midx}, seq, rCnt, rType FROM tb_huType WHERE seq = {$seq}  AND idx = {$hidx} ";

                $result_query = mysqli_query($gconnet,$sql);

            }            

        }

        //기업 휴양소 객실 이용박수 삭제 후 재등록
        $sql = " DELETE FROM tb_comhuM_useday WHERE midx = {$midx} ";
        $result_query = mysqli_query($gconnet,$sql);

        if($result_query){

            $dayArr = explode(",", $usedayArr );
            for($i=0; $i < count($dayArr); $i++){
                
                $use = explode(":", $dayArr[$i]);

                if(in_array($use[0],$seqArr)){
                    $sql = " INSERT INTO tb_comhuM_useday  ( midx, seq, useday) VALUES ( {$midx}, {$use[0]}, {$use[1]} ) ";
                    $result_query = mysqli_query($gconnet,$sql);
                }
            }            
        }

        if($result_query) $result = "true";
        

    }else if($mode == "DELETE"){

        $midx = trim(sqlfilter($_REQUEST['midx']));

        //기업 휴양소 정보 수정
        $sql = " UPDATE tb_comhuM   ";
        $sql .=" SET del_yn = 'Y' WHERE midx = {$midx} ";

        $result_query = mysqli_query($gconnet,$sql);

        if($result_query) $result = "true";
       
    }else if($mode == "CALENDAR"){

        $midx = trim(sqlfilter($_REQUEST['midx']));
        $seq = trim(sqlfilter($_REQUEST['seq']));
        $useday = trim(sqlfilter($_REQUEST['useday']));
        $cntList = trim(sqlfilter($_REQUEST['cntList']));
        $cntArr = explode(",", $cntList );

        

        for($i=0; $i < count($cntArr); $i++){

            $data = explode(":", $cntArr[$i]);

            if(trim($data[1]) == "" || trim($data[2]) == ""){
                $resJSON["success"] = "false";
                $resJSON["msg"] = to_date($data[0])."일자의 객실수를 입력하십시오.";

                echo json_encode($resJSON);
                exit; 
            }

            $sql = " REPLACE INTO tb_room_custom (midx, cidx, hidx, seq, useday, rc_date, rc_cnt, sum_cnt ) ";
            $sql .= " VALUES ({$midx}, {$cidx}, {$hidx}, {$seq}, {$useday}, '{$data[0]}', ".trim($data[1]).", ".trim($data[2])." ) ";

            $message = $sql;
            $result_query = mysqli_query($gconnet,$sql);

            if($result_query) $result = "true";
        }

    }


    if($result == "true" ){
        $message = "처리 되었습니다.";
    }else{
        $message = "처리 시 오류가 발생하였습니다.";
		//$message = $sql;
    }

    $resJSON["success"] = $result;
    $resJSON["msg"] = $message;

    echo json_encode($resJSON);
    exit;    


?>