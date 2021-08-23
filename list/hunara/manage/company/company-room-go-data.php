<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$cidx           = trim(sqlfilter($_REQUEST['cidx']));
$chDate         = trim(sqlfilter($_REQUEST['chDate']));

$WHERE = "";
if(!empty($cidx)){
    $WHERE .= " AND a.cidx = '{$cidx}' ";
}

if(!empty($chDate)){
    if($chDate == "N"){ //마감제외
        $WHERE .= " AND h.endDate is null  ";
    }else if($chDate == "E"){ //마감
        $WHERE .= " AND h.endDate is not null  ";
    }else if($chDate == "1" || $chDate == "2" || $chDate == "3" ) {
        $WHERE .= " AND h.chDate".$chDate." is not null AND h.chDate".($chDate+1)." is null AND h.endDate is null ";
    }else if($chDate == "4"){
        $WHERE .= " AND h.chDate".$chDate." is not null AND h.endDate is null ";
    }
}


$SQL = "SELECT date_format(t.wdate,'%Y.%m.%d') as wdate, date_format(t.udate1,'%Y.%m.%d') as udate1, date_format(t.udate2,'%Y.%m.%d') as udate2,";
$SQL .= "   t.cname, t.hname, t.rArea, t.flag, t.hide_yn, t.midx, t.hidx, t.seq, t.cidx, date_format(t.chDate1,'%Y.%m.%d') as chDate1,";
$SQL .= "   date_format(t.chDate2,'%Y.%m.%d') as chDate2, date_format(t.chDate3,'%Y.%m.%d') as chDate3, date_format(t.chDate4,'%Y.%m.%d') as chDate4, t.endDate ";
$SQL .= "FROM ( ";
$SQL .= "   SELECT  ";
$SQL .= "       a.wdate, a.udate1, a.udate2, b.comname as cname, c.comname as hname, d.rArea, a.flag, a.hide_yn,  ";
$SQL .= "       a.midx, a.hidx, h.seq, a.cidx, h.chDate1, h.chDate2, h.chDate3, h.chDate4, h.endDate ";
$SQL .= "   FROM tb_comhuM a, tb_company b, tb_hu c, tb_huType d, tb_comhuMtype h ";
$SQL .= "   WHERE a.midx = h.midx ";
$SQL .= "     AND a.cidx = b.idx  ";
$SQL .= "     AND a.hidx = c.idx  ";
$SQL .= "     AND a.hidx = d.idx  ";
$SQL .= "     AND h.seq = d.seq   ";
$SQL .= "     AND a.type = 'S'    ";
$SQL .= "     AND a.del_yn = 'N'  ";
$SQL .= $WHERE;
$SQL .= ")t  ";
$SQL .= "ORDER BY t.midx desc, t.seq ";

$result = mysqli_query($gconnet, $SQL);
$totalCnt = mysqli_num_rows($result);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);

    //화면에 보여지는 페이지에서만 숙박일, 총개수 잔여개수 조회
    $sql2 = " SELECT a.useday, ";
    $sql2 .= "   ifnull((select sum(rc_cnt) from tb_room_custom where cidx = {$row['cidx']} and hidx = {$row['hidx']} and seq = {$row['seq']} and useday = a.useday ),0) as sumCnt, ";
    $sql2 .= "   ifnull((select count(ridx) from tb_reInfo where midx = {$row['midx']} and seq = {$row['seq']}  and regflag = '5' and useday = a.useday ),0) as revCnt ";
    $sql2 .= " FROM tb_comhuM_useday a " ;
    $sql2 .= " WHERE a.midx = {$row['midx']}   AND a.seq = {$row['seq']}   " ;
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

    $chDate1 = $row['chDate1'];
    $chDate2 = $row['chDate2'];
    $chDate3 = $row['chDate3'];
    $chDate4 = $row['chDate4'];

    if(!empty($row['endDate'])){
        if(empty($chDate1)) $chDate1 = "마감";
        if(empty($chDate2)) $chDate2 = "마감";
        if(empty($chDate3)) $chDate3 = "마감";
        if(empty($chDate4)) $chDate4 = "마감";
    }

    $responce->rows[$i]['id'] = $row['midx']."_".$row['seq'];
	$responce->rows[$i]['cell']= array( $row['midx']."_".$row['seq'], ($totalCnt-$i), $row['wdate'], $row['cname'],  $row['hname'], $row['rArea'], 
                                        $row['flag'], $row['udate1']."~\n".$row['udate2'],  $useday, $sumCnt, $revCnt,
                                        $chDate1, $chDate2, $chDate3, $chDate4 , $row['hide_yn'] , $row['midx'], $row['hidx'], $row['seq'], $row['cidx'], $row['endDate']
                                );
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>