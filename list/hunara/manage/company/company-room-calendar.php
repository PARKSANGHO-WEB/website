<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
	$midx	= trim(sqlfilter($_REQUEST['midx']));
	$seq	= trim(sqlfilter($_REQUEST['seq']));    
    $useday	= trim(sqlfilter($_REQUEST['useday']));
    $startDate = trim(sqlfilter($_REQUEST['startDate']));
    $endDate = trim(sqlfilter($_REQUEST['endDate']));

    $revList = [];
    $rev = array("date" => "", "cnt" => "", "sum_cnt" => "") ;
    

    // 휴양소 객실 기본 정보 조회
	$sql = " SELECT hidx, cidx, udate1, udate2  ";
    $sql .= " FROM tb_comhuM  WHERE midx = {$midx}     ";
 	
    $rs = mysqli_query($gconnet, $sql);    
    $row = mysqli_fetch_array($rs);

    $hidx = $row['hidx']; 	
    $cidx = $row['cidx'];
    $udate1 = $row['udate1'];
    $udate2 = $row['udate2'];

    // 휴양소 이용기간만 입력하도록 처리
    if($startDate < $udate1){
        $startDate = $udate1;
    }

    if($endDate > $udate2){
        $endDate = $udate2;
    }

    $sql = " SELECT T.rc_date, ifnull(S.rc_cnt, '') as rc_cnt, ifnull(S.sum_cnt,'') as sum_cnt ";
    $sql .= "FROM ( ";
    $sql .= "       SELECT  date_format(b.date, '%Y%m%d') as rc_date, a.rCnt as rc_cnt ";
    $sql .= "       FROM tb_comhuMtype a, ";
    $sql .= "           (select a.Date from ( ";
    $sql .= "               select date_format('{$endDate}', '%Y-%m-%d') - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY as Date ";
    $sql .= "               from (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as a ";
    $sql .= "               cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as b ";
    $sql .= "               cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as c ";
    $sql .= "           ) a where a.Date between date_format('{$startDate}', '%Y-%m-%d') and date_format('{$endDate}', '%Y-%m-%d') ) b ";
    $sql .= "       WHERE a.midx = '{$midx}' and a.seq = '{$seq}' ";
    $sql .= ") AS T ";
    $sql .= "LEFT JOIN (";
    $sql .= "   SELECT  date_format(rc_date, '%Y%m%d') as rc_date , rc_cnt, sum_cnt ";
    $sql .= "   FROM tb_room_custom a ";
    $sql .= "   WHERE a.midx = '{$midx}' and  a.cidx = '{$cidx}' AND a.hidx = '{$hidx}' AND a.seq = '{$seq}' AND a.useday = '{$useday}' AND a.rc_date >= '{$startDate}' AND a.rc_date <= '{$endDate}' ";
    $sql .= ") AS S ";
    $sql .= "ON T.rc_date = S.rc_date ";
    $sql .= "ORDER BY T.rc_date ";


    $rs = mysqli_query($gconnet, $sql);  


    for($i=0; $i < mysqli_num_rows($rs); $i++){
        $row2 = mysqli_fetch_array($rs);
        
        
        $rev["date"] = $row2['rc_date'];
        $rev["cnt"] = $row2['rc_cnt'];
        $rev["sum_cnt"] = $row2['sum_cnt'];


        array_push($revList, $rev);
    }
    
    echo json_encode($revList, JSON_UNESCAPED_UNICODE);
    exit;



?>