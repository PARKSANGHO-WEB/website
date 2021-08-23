<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? 
    $mode = trim(sqlfilter($_REQUEST['mode']));
    $step = trim(sqlfilter($_REQUEST['step']));
    $keyArr = trim(sqlfilter($_REQUEST['keyArr']));
    $midxArr = explode(",", $keyArr);

    $resJSON = array("success"=>"", "msg"=>"");
    $message = "";
    $result  = "false";

    if($mode == "CHUCHUM"){

        for($ii=0; $ii < count($midxArr); $ii++){
            $keys = explode(":",$midxArr[$ii]);
            $midx = $keys[0];
            $seq = $keys[1];

            for ($h=1; $h < 4; $h++){ //1지망 ~ 3지망
                /*
                echo "<br>**************************************************************************************************************";
                echo "<br> midx= $midx, seq = $seq, $h 지망 ";
                echo "<br>**************************************************************************************************************";
                */
                $sql = " select  date_format(t.udate1, '%Y-%m-%d') as udate1, t.udate2, DATEDIFF(t.udate2, t.udate1) as datecnt,  ";
                $sql .= "       t.seq, t.rcnt, t.useday, t.weight, t.hidx, t.cidx   ";
                $sql .= " from ( ";
                $sql .= "   select  case when c.udate1 < e.cdate then e.cdate else c.udate1 end as udate1, c.udate2, e.cdate,  ";
                $sql .= "           a.seq, a.rcnt, d.useday, c.weight, c.hidx, c.cidx   ";
                $sql .= "   from tb_comhuMtype a, tb_comhuM c, tb_comhuM_useday d, (select date_format(now(), '%Y%m%d') cdate) e ";
                $sql .= "   where a.midx = c.midx  ";
                $sql .= "   and a.midx = d.midx   ";    
                $sql .= "   and a.seq = d.seq     ";    
                $sql .= "   and a.midx = {$midx}  ";
                $sql .= "   and a.seq = {$seq}    ";
                $sql .= "   and c.del_yn = 'N'    ";
                $sql .= " )t ";   
    
                $result = mysqli_query($gconnet, $sql);

                for ($i=0; $i< mysqli_num_rows($result); $i++){ //1박2일, 2박3일.. 박 수 만큼 반복

                    $row = mysqli_fetch_array($result);
                    $cidx = $row['cidx'];
                    $hidx = $row['hidx'];
                    $datecnt = $row['datecnt']; //총 일수
                    $fromDate = $row['udate1']; //시작일자
                    $useday = $row['useday']; //박 수
                    $weight = ""; //가중치

                    if($row['weight'] == "H"){
                        $weight = " t.weight desc, ";
                    }else if($row['weight'] == "L"){
                        $weight = " t.weight, ";
                    }



                    // 당첨자를 제외한 신청자를 조회하여 순서대로 loop 를 돌린다. ( tb_reinfo. regflag is null <-- 신청자)
                    for($j=0; $j <= $datecnt; $j++){

                        $target_date = date('Ymd', strtotime($fromDate.'+'.$j.' days') );
                        //echo "<br>################# target_date = [$target_date] ################# ";
                        $sql2 = " select rc_cnt from tb_room_custom ";
                        $sql2 .= " where midx = {$midx} and cidx = {$cidx} and hidx= {$hidx} ";
                        $sql2 .= "   and seq= {$seq} and useday = '{$useday}' ";
                        $sql2 .= "   and rc_date= '{$target_date}'  ";

                        $result2 = mysqli_query($gconnet, $sql2);
                        
                        $room_cnt = 0;  //객실 수
                        $choiceCnt = 0; //당첨자 수

                        if(mysqli_num_rows($result2) > 0) {
                            $row2 = mysqli_fetch_array($result2);
                            $room_cnt = $row2['rc_cnt'];
                        }
                        //echo "<br> room_cnt = ".$room_cnt;

                        if($room_cnt > 0){

                            //현재 기업, 휴양소, 방, 일자에 대해서 당첨자 숫자를 카운트 한다.
                            $sql3 = " select count(*) as choiceCnt from tb_reInfo ";
                            $sql3 .= " where midx = {$midx} and cidx = {$cidx} ";
                            $sql3 .= " and hidx = {$hidx} and seq= {$seq} ";
                            $sql3 .= " and cymd =  '{$target_date}'  ";
                            $sql3 .= " and regflag = '5' and useday = '{$useday}' ";

                            $result3 = mysqli_query($gconnet, $sql3);
                            

                            if(mysqli_num_rows($result3) > 0) {
                                $row3 = mysqli_fetch_array($result3);
                                $choiceCnt = $row3['choiceCnt'];
                            }

                            //echo "<br> choiceCnt = ".$choiceCnt;

                            if($room_cnt > $choiceCnt){

                                $sql4 = " select t.* from ( ";
                                $sql4 .= "  select  a.cidx, a.ridx,  a.name, a.sano, a.pgubun, a.chasu, b.weight,  ";
                                $sql4 .= "          ifnull((select count(*) from tb_reInfo where cidx = a.cidx and sano = a.sano and regflag = '5' ),0) as dangchum_cnt ";
                                $sql4 .= "  from tb_reInfo a , tb_employee b   ";
                                $sql4 .= "  where a.cidx = b.cdx ";
                                $sql4 .= "   and a.sano = b.sano ";
                                $sql4 .= "   and a.midx = {$midx} ";
                                $sql4 .= "   and a.cidx = {$cidx} ";
                                $sql4 .= "   and a.hidx = {$hidx} ";
                                $sql4 .= "   and a.seq =  {$seq} ";
                                $sql4 .= "   and a.regflag is null  ";
                                $sql4 .= "   and a.cymd = '{$target_date}' ";
                                $sql4 .= "   and a.useday = '{$useday}' ";
                                $sql4 .= "   and a.chasu = {$h} ";
                                $sql4 .= " )t ";
                                $sql4 .= " where t.dangchum_cnt = 0 "; //당첨 이력이 있으면 제외
                                $sql4 .= " order by t.chasu, ".$weight."  rand() ";
                                $sql4 .= " limit ".(($room_cnt - $choiceCnt)*3);

                                //echo "<br> sql4 = ".$sql4;

                                $result4 = mysqli_query($gconnet, $sql4);

                                for($k=0; $k< mysqli_num_rows($result4); $k++){
                                    $row4 = mysqli_fetch_array($result4);
                                    $sano = $row4['sano'];
                                    $chasu = $row4['chasu'];


                                    // 당첨처리
                                    $sql6 = " update tb_reInfo set regflag = '5', udate = now() ";
                                    $sql6 .= " where midx = {$midx} and  cidx  =  {$cidx} ";
                                    $sql6 .= "   and hidx  = {$hidx} and seq   = {$seq} ";
                                    $sql6 .= "   and sano = '{$sano}' and chasu = '{$chasu}' ";
                                    $sql6 .= "   and useday = '{$useday}'  and regflag is null ";

                                    //echo "<br> sql6 = ".$sql6;

                                    $result6 = mysqli_query($gconnet,$sql6);

                                    if($result6){
                                        //당첨 카운트 증가
                                        $choiceCnt++;

                                        //echo "<br> choiceCnt = ".$choiceCnt;

                                        // 당첨이 되었으므로, 같은 회사의  사번의 모든 휴양소의 신청 데이터를 탈락처리한다.
                                        $sql7 = " update tb_reInfo set regflag = '9' , udate = now() ";
                                        $sql7 .= " where cidx  =  {$cidx} ";
                                        $sql7 .= "   and sano = '{$sano}' ";
                                        $sql7 .= "   and regflag is null  ";

                                        //echo "<br> sql7 = ".$sql7;
            
                                        $result7 = mysqli_query($gconnet,$sql7);      

                                        if( $room_cnt <= $choiceCnt ) {

                                            //echo "<br> ############# room_cnt = [$room_cnt], choiceCnt = [$choiceCnt] break!! #############";
                                            break;
                                        }

                                    }//end of if

                                } // end of for k                        
                            }// end of if
                        }

                        if($choiceCnt >= $room_cnt ){

                            //  해당 일자의 같은 회사 모든 휴양소 신청 데이터를 탈락처리한다. 
                            $sql7 = " update tb_reInfo set regflag = '9', udate = now() ";
                            $sql7 .= " where cidx  =  '{$cidx}'         ";
                            $sql7 .= "   and midx = '{$midx}'           ";
                            $sql7 .= "   and seq = '{$seq}'             ";
                            $sql7 .= "   and useday = '{$useday}'       ";
                            $sql7 .= "   and cymd = '{$target_date}'    ";
                            $sql7 .= "   and regflag is null            ";

                            //echo "<br> sql77 = ".$sql7;
                            $result7 = mysqli_query($gconnet,$sql7);  
                        }                

                    } //end of j

                } //end of i

            } //end of h

            //당첨처리 완료
            $sql8 = " update tb_comhuMtype set  chDate".$step." = now() ";
            $sql8 .= " where midx = '{$midx}'           ";
            $sql8 .= "   and seq = '{$seq}'             ";

            //echo "<br> sql8=".$sql8;

            $result8 = mysqli_query($gconnet,$sql8); 

            if($result8){
                $result = "true";
            }
        }         
    }else if($mode == "DEADLINE"){

        for($ii=0; $ii < count($midxArr); $ii++){
            $keys = explode(":",$midxArr[$ii]);
            $midx = $keys[0];
            $seq = $keys[1];

            //마감처리 완료
            $sql = " update tb_comhuMtype set endDate = now() ";
            $sql .= " where midx = '{$midx}'           ";
            $sql .= "   and seq = '{$seq}'             ";

            $rs = mysqli_query($gconnet,$sql); 

            if($rs){
                $result = "true";
            }            

        }        

    }

    if($result == "true" ){
        $message = "처리 되었습니다.";
    }else{
        $message = "처리 시 오류가 발생하였습니다.";
    }

    $resJSON["success"] = $result;
    $resJSON["msg"] = $message;

    echo json_encode($resJSON, JSON_UNESCAPED_UNICODE);
    exit;    


?>