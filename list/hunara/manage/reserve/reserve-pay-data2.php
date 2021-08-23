<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$hidx           = trim(sqlfilter($_REQUEST['hidx'])); 
$cidx           = trim(sqlfilter($_REQUEST['cidx']));
$useday         = trim(sqlfilter($_REQUEST['useday']));
$searchType     = trim(sqlfilter($_REQUEST['searchType']));
$searchValue    = trim(sqlfilter($_REQUEST['searchValue']));
$regflag        = trim(sqlfilter($_REQUEST['regflag']));
$pgubun         = trim(sqlfilter($_REQUEST['pgubun']));
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

if(!empty($useday)){
    $WHERE .= " AND a.useday in ( {$useday} )";
}

if(!empty($searchValue)){

    if($searchType == "name"){
        $WHERE .= " AND a.name LIKE '%{$searchValue}%' ";
    }else if($searchType == "sano"){
        $WHERE .= " AND a.sano LIKE '%{$searchValue}%' ";
    }else if($searchType == "hp"){
        $WHERE .= " AND (a.hp LIKE '%{$searchValue}%' OR a.tel LIKE '%{$searchValue}%' ) ";
    }

}

if(!empty($regflag)){

    if($regflag == "F"){ 
        $WHERE .= " AND a.chasu = 0 ";
    }else if($regflag == "8") {
        $WHERE .= " AND a.regflag in ('7','8') ";
    }else {
        $WHERE .= " AND a.regflag = $regflag  ";
    }
}

if(!empty($pgubun)){
    $WHERE .= " AND a.pgubun = '{$pgubun}'  ";
}

if(!empty($startDate)){

    if($searchDate == "cymd"){
        $WHERE .= " AND a.cymd >= date_format('$startDate', '%Y%m%d' )  ";
    }else if($searchDate == "wdate"){
        $WHERE .= " AND a.wdate >= date_format('$startDate', '%Y-%m-%d' )  ";

    }else if($searchDate == "cancel"){
        $WHERE .= " AND  a.cancel_date >= date_format('$startDate', '%Y-%m-%d' )  ";
    }
}

if(!empty($endDate)){

    if($searchDate == "cymd"){
        $WHERE .= " AND a.cymd <= date_format('$endDate', '%Y%m%d' )  ";
    }else if($searchDate == "wdate"){
        $WHERE .= " AND a.wdate <= DATE_ADD(str_to_date('{$endDate}', '%Y-%m-%d'), INTERVAL 1 DAY)  ";

    }else if($searchDate == "cancel"){
        $WHERE .= " AND a.cancel_date <= DATE_ADD(str_to_date('{$endDate}', '%Y-%m-%d'), INTERVAL 1 DAY)  ";
    }
}

$SQL = "SELECT ";
$SQL .= "   a.ridx, date_format(a.udate,'%Y.%m.%d') as udate, a.cymd, a.useday, b.cname, c.hname, a.pgubun, d.rArea, d.rCnt, ";
$SQL .= "   a.name, a.sano, ifnull(a.hp, a.tel) as hp, a.regflag, a.midx, a.hidx, a.cidx, a.seq, date_format(a.udate,'%Y.%m.%d') as udate, ";
$SQL .= "   case when a.chasu = 0 then '선착순' else concat(a.chasu,'지망') end as chasu, ifnull(a.payflag, '-') as  payflag ";
$SQL .= "FROM tb_reInfo a  ";
$SQL .= "LEFT OUTER JOIN (select idx,comname as cname, hp from tb_company) b on a.cidx=b.idx ";
$SQL .= "LEFT OUTER JOIN (select idx,comname as hname from tb_hu) c on a.hidx=c.idx ";
$SQL .= "LEFT OUTER JOIN (select idx,seq,rArea, rCnt  from tb_huType) d on a.hidx=d.idx and a.seq = d.seq ";
$SQL .= "WHERE 1=1 ";
$SQL .= $WHERE;
$SQL .= " ORDER BY a.ridx desc ";


$result = mysqli_query($gconnet, $SQL);
$totalCnt = mysqli_num_rows($result);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);

    
    $useday = $usedayArray[$row['useday']]."(".get_days($row['cymd'], $row['useday']).")";
    
    $regflag = "";

    $responce->rows[$i]['id'] = $row['ridx'];
	$responce->rows[$i]['cell']= array( $row['ridx'], ($totalCnt-$i), $row['chasu'], $row['udate'], $useday, $row['cname'], $row['pgubun'], 
                                        $row['hname'], $row['rArea'], $row['name'], $row['sano'], $row['hp'], $row['payflag'], $row['ridx']
                                );
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>