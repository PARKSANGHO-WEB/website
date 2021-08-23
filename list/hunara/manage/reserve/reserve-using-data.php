<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$hidx           = trim(sqlfilter($_REQUEST['hidx']));
$cidx           = trim(sqlfilter($_REQUEST['cidx']));
$flag           = trim(sqlfilter($_REQUEST['flag']));
$searchDate     = trim(sqlfilter($_REQUEST['searchDate']));
$startDate      = trim(sqlfilter($_REQUEST['startDate']));
$endDate        = trim(sqlfilter($_REQUEST['endDate']));

$WHERE = "";
if(!empty($hidx)){
    $WHERE .= " AND a.hidx = '{$hidx}' ";
}

if(!empty($cidx)){
    $WHERE .= " AND a.cidx = '{$cidx}' ";
}

if(!empty($flag)){
    $WHERE .= " AND a.flag = '{$flag}' ";
}

if(!empty($startDate)){

    if($searchDate == "wdate"){
        $WHERE .= " AND a.wdate >=  str_to_date('{$startDate}', '%Y-%m-%d') "; 

    }else if($searchDate == "udate"){
        $WHERE .= " AND a.udate1 >=  str_to_date('{$startDate}', '%Y-%m-%d') "; 
        $WHERE .= " AND a.udate2 < DATE_ADD(str_to_date('{$endDate}', '%Y-%m-%d'), INTERVAL 1 DAY) "; 
    }
}

if(!empty($endDate)){

    if($searchDate == "wdate"){
        $WHERE .= " AND a.wdate < DATE_ADD(str_to_date('{$endDate}', '%Y-%m-%d'), INTERVAL 1 DAY) ";  

    }else if($searchDate == "udate"){
        $WHERE .= " AND a.udate1 >=  str_to_date('{$endDate}', '%Y-%m-%d') "; 
        $WHERE .= " AND a.udate2 < DATE_ADD(str_to_date('{$endDate}', '%Y-%m-%d'), INTERVAL 1 DAY) ";
    }
}


$SQL = "SELECT t.*,  ";
$SQL .= "   ifnull((select sum(rc_cnt) from tb_room_custom where midx = t.midx and cidx = t.cidx and hidx = t.hidx and seq = t.seq and rc_date between t.udate1 and t.udate2 ),0) as sumCnt, ";
$SQL .= "   ifnull((select sum(useday) from tb_reInfo where midx = t.midx and seq = t.seq  and regflag = '5'),0) as revCnt ";
$SQL .= "FROM ( ";
$SQL .= "   SELECT  ";
$SQL .= "       date_format(a.wdate,'%Y.%m.%d') as wdate , b.comname as cname, c.comname as hname, d.rArea, d.rType, a.flag, a.type , ";
$SQL .= "       a.udate1, a.udate2, a.midx, a.hidx, h.seq, a.cidx ";
$SQL .= "   FROM tb_comhuM a, tb_company b, tb_hu c, tb_huType d, tb_comhuMtype h ";
$SQL .= "   WHERE a.midx = h.midx ";
$SQL .= "     AND a.cidx = b.idx  ";
$SQL .= "     AND a.hidx = c.idx  ";
$SQL .= "     AND a.hidx = d.idx  ";
$SQL .= "     AND h.seq = d.seq   ";
$SQL .= "     AND a.del_yn = 'N'  ";
$SQL .= $WHERE;
$SQL .= ")t  ";
$SQL .= "ORDER BY t.midx desc, t.seq ";


$result = mysqli_query($gconnet, $SQL);
$totalCnt = mysqli_num_rows($result);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);

    $sql2 = " SELECT a.useday, ";
    $sql2 .= "   ifnull((select sum(rc_cnt) from tb_room_custom where midx = {$row['midx']} and cidx = {$row['cidx']} and hidx = {$row['hidx']} and seq = {$row['seq']} and useday = a.useday ),0) as sumCnt, ";
    $sql2 .= "   ifnull((select sum(useday) from tb_reInfo where midx = {$row['midx']} and seq = {$row['seq']}  and regflag = '5' and useday = a.useday ),0) as revCnt ";
    $sql2 .= " FROM tb_comhuM_useday a ";
    $sql2 .= " WHERE a.midx = {$row['midx']}   AND a.seq = {$row['seq']}   ";
    $result2 = mysqli_query($gconnet, $sql2);

    $useday = "";
    $sumCnt = "";
    $revCnt = "";
    for($j=0; $j<mysqli_num_rows($result2); $j++ ){
        $row2 = mysqli_fetch_array($result2);
        if($j > 0) {
            $useday .= "\n";
            $sumCnt .= "\n";
            $revCnt .= "\n";
        }
        $useday .= $usedayArray[$row2['useday']];
        $sumCnt .= $row2['sumCnt'];
        
        if($row2['sumCnt'] < $row2['revCnt']){
            $revCnt .= "0";
        }else{
            $revCnt .= ($row2['sumCnt'] - $row2['revCnt']);
        }


    }

    $responce->rows[$i]['id'] = $row['midx'];
	$responce->rows[$i]['cell']= array( ($totalCnt-$i), $row['wdate'], $row['cname'],  $row['hname'], $row['rArea'], 
                                        $row['rType'], $row['flag'], $assignArray[$row['type']],  $useday, $sumCnt, $revCnt
                                );
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>