<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$cymd = trim(sqlfilter($_REQUEST['cymd']));

$SQL = "SELECT ";
$SQL .= "   a.ridx, date_format(a.wdate,'%Y.%m.%d') as wdate, a.cymd, a.useday, b.cname, c.hname,  ";
$SQL .= "   a.name, a.sano, ifnull(a.hp, a.tel) as hp, a.regflag, date_format(a.udate,'%Y.%m.%d') as udate, ";
$SQL .= "   case when a.chasu = 0 then '선착순' else concat(a.chasu,'지망') end as chasu ";
$SQL .= "FROM tb_reInfo a  ";
$SQL .= "LEFT OUTER JOIN (select idx,comname as cname, hp from tb_company) b on a.cidx=b.idx ";
$SQL .= "LEFT OUTER JOIN (select idx,comname as hname from tb_hu) c on a.hidx=c.idx ";
$SQL .= "LEFT OUTER JOIN (select idx,seq,rArea, rCnt  from tb_huType) d on a.hidx=d.idx and a.seq = d.seq ";
$SQL .= "WHERE a.regflag = '5' ";
$SQL .= "  AND a.cymd <= date_format('{$cymd}','%Y%m%d') ";
$SQL .= "  AND a.cymd2 >= date_format('{$cymd}','%Y%m%d') ";
$SQL .= " ORDER BY a.ridx desc ";

$result = mysqli_query($gconnet, $SQL);
$totalCnt = mysqli_num_rows($result);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);

    
    $useday = get_days($row['cymd'], $row['useday']);
    
    $regflag = $regFlagArray[$row['regflag']];

    $responce->rows[$i]['id'] = $row['ridx'];
	$responce->rows[$i]['cell']= array( $row['ridx'],  $row['chasu'], $row['wdate'], $usedayArray[$row['useday']], $useday, $row['cname'], 
                                        $row['hname'], $row['name'], $row['sano'], $row['hp'], $regflag
                                );
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>