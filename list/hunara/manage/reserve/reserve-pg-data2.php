<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$hidx           = trim(sqlfilter($_REQUEST['hidx']));
$cidx           = trim(sqlfilter($_REQUEST['cidx']));
$useday         = trim(sqlfilter($_REQUEST['useday']));

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


$SQL = "SELECT ";
$SQL .= "   a.ridx, date_format(a.udate,'%Y.%m.%d') as udate, b.cname, c.hname, a.pgubun,  ";
$SQL .= "   a.name, a.sano, ifnull(a.hp, a.tel) as hp, d.applDate, d.applNum, d.TotPrice, d.payMethod, ";
$SQL .= "    ifnull(a.payflag, '-') as payflag ";
$SQL .= "FROM tb_reInfo a  ";
$SQL .= "LEFT OUTER JOIN (select idx,comname as cname, hp from tb_company) b on a.cidx=b.idx ";
$SQL .= "LEFT OUTER JOIN (select idx,comname as hname from tb_hu) c on a.hidx=c.idx ";
$SQL .= "LEFT OUTER JOIN (select ridx, TotPrice, tid, applNum, applDate, payMethod, resultCode from tb_pay) d on a.ridx = d.ridx  ";
$SQL .= "WHERE 1=1 ";
$SQL .= "  AND a.regflag = '5' ";
$SQL .= $WHERE;
$SQL .= " ORDER BY a.ridx desc ";


$result = mysqli_query($gconnet, $SQL);
$totalCnt = mysqli_num_rows($result);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);

    $responce->rows[$i]['id'] = $row['ridx'];
	$responce->rows[$i]['cell']= array( ($totalCnt-$i), $row['udate'], $row['cname'], $row['pgubun'], $row['hname'],
                                         $row['name'], $row['sano'], $row['hp'], $row['applDate'], $row['applNum'], 
                                         $row['TotPrice'], $row['payMethod'], $row['payflag']
                                );
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>