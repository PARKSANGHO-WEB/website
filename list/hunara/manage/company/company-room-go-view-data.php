<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$midx           = trim(sqlfilter($_REQUEST['midx']));
$seq            = trim(sqlfilter($_REQUEST['seq']));
$regflag        = trim(sqlfilter($_REQUEST['regflag']));
$name           = trim(sqlfilter($_REQUEST['name']));


if(!empty($regflag)){
    $WHERE .= " AND a.regflag = $regflag  ";
}

if(!empty($name)){
    $WHERE .= " AND a.name like '%$name%'  ";
}



$SQL = "SELECT ";
$SQL .= "   a.ridx, a.chasu, date_format(a.wdate,'%Y.%m.%d') as wdate, a.name, a.sano, ifnull(a.hp, a.tel) as hp,   ";
$SQL .= "   a.regflag, a.cymd, a.useday, date_format(a.udate,'%Y.%m.%d') as udate, ";
$SQL .= "   ifnull(date_format(b.chDate1,'%Y.%m.%d'),'-') as chDate1, ifnull(date_format(b.chDate2,'%Y.%m.%d'),'-') as chDate2, ";
$SQL .= "   ifnull(date_format(b.chDate3,'%Y.%m.%d'),'-') as chDate3, ifnull(date_format(b.chDate4,'%Y.%m.%d'),'-') as chDate4  ";
$SQL .= "FROM tb_reInfo a, tb_comhuMtype b  ";
$SQL .= "WHERE a.midx = b.midx AND a.seq = b.seq ";
$SQL .= "  AND a.midx = {$midx}  AND  a.seq = {$seq} AND a.regflag in ('5','9') ";
$SQL .= $WHERE;
$SQL .= " ORDER BY a.ridx desc ";


$result = mysqli_query($gconnet, $SQL);
$totalCnt = mysqli_num_rows($result);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);

    
    $useday = $usedayArray[$row['useday']]."(".get_days($row['cymd'], $row['useday']).")";
    
    $regflag = $regFlagArray[$row['regflag']];

    $responce->rows[$i]['id'] = $row['ridx'];
	$responce->rows[$i]['cell']= array( ($totalCnt-$i), $row['chasu']."지망", $row['wdate'], $useday, $row['name'], $row['sano'], $row['hp'], $row['udate'],
                                        $row['chDate1'], $row['chDate2'], $row['chDate3'], $row['chDate4'], $regflag 
                                );
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>