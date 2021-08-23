<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$midx           = trim(sqlfilter($_REQUEST['midx']));
$seq            = trim(sqlfilter($_REQUEST['seq']));
$regflag        = trim(sqlfilter($_REQUEST['regflag']));
$ridxArr        = trim(sqlfilter($_REQUEST['ridxArr']));


if(!empty($regflag)){
    if($regflag == "8"){
        $WHERE .= " AND a.regflag  in ('7','8') ";
    }else{
        $WHERE .= " AND a.regflag = $regflag  ";
    }
}

if(!empty($ridxArr)){
    $WHERE .= " AND a.ridx in ( $ridxArr  ) ";
}

$SQL = "SELECT ";
$SQL .= "   a.ridx, date_format(a.wdate,'%Y.%m.%d') as wdate, a.cymd, a.useday, b.cname, c.hname, a.pgubun, d.rArea, d.rCnt, a.digit7, ";
$SQL .= "   a.name, a.sano, ifnull(a.hp, a.tel) as hp, a.regflag, a.regflag_two, a.midx, a.hidx, a.cidx, a.seq, date_format(a.udate,'%Y.%m.%d') as udate, ";
$SQL .= "   case when a.chasu = 0 then '선착순' else concat(a.chasu,'지망') end as chasu,  date_format(a.udate,'%Y.%m.%d') as udate, ";
$SQL .= "   date_format(a.cancel_date,'%Y.%m.%d') as cancel_date ";
$SQL .= "FROM tb_reInfo a  ";
$SQL .= "LEFT OUTER JOIN (select idx,comname as cname, hp from tb_company) b on a.cidx=b.idx ";
$SQL .= "LEFT OUTER JOIN (select idx,comname as hname from tb_hu) c on a.hidx=c.idx ";
$SQL .= "LEFT OUTER JOIN (select idx,seq,rArea, rCnt  from tb_huType) d on a.hidx=d.idx and a.seq = d.seq ";
$SQL .= "WHERE a.midx = {$midx}  AND  a.seq = {$seq} ";
$SQL .= $WHERE;
$SQL .= " ORDER BY a.ridx desc ";


$result = mysqli_query($gconnet, $SQL);
$totalCnt = mysqli_num_rows($result);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);

    
    $useday = $usedayArray[$row['useday']]."(".get_days($row['cymd'], $row['useday']).")";
    
    $regflag = $regFlagArray[$row['regflag']]; 

    if($row['regflag_two'] == "2"){
        $regflag = $cancelFlagArray[$row['regflag_two']]."\n".$row['cancel_date'];
    }else if($row['regflag'] == "7"){
        $regflag = $regFlagArray[$row['regflag']]."\n".$row['cancel_date'];
    }else{
        $regflag = $regFlagArray[$row['regflag']];
    }

    $responce->rows[$i]['id'] = $row['ridx'];
	$responce->rows[$i]['cell']= array( $row['ridx'], ($totalCnt-$i), $row['name'], $row['chasu'], $row['wdate'], $useday, $row['cname'], $row['pgubun'], 
                                        $row['hname'], $row['rArea'],  $row['sano'], $row['hp'], $row['udate'],
                                        $row['digit7'], $regflag, $row['midx'], $row['hidx'], $row['cidx'], $row['seq']
                                );
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>