<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$flag       = trim(sqlfilter($_REQUEST['flag']));
$cidx       = trim(sqlfilter($_REQUEST['cidx']));
$hidx       = trim(sqlfilter($_REQUEST['hidx']));
$regflag_two = trim(sqlfilter($_REQUEST['regflag_two']));
$com_amount1 = trim(sqlfilter($_REQUEST['com_amount1']));
$com_amount2 = trim(sqlfilter($_REQUEST['com_amount2']));
$per_amount1 = trim(sqlfilter($_REQUEST['per_amount1']));
$per_amount2 = trim(sqlfilter($_REQUEST['per_amount2']));


$WHERE = "";
if(!empty($flag)){
    $WHERE .= " AND a.pgubun = '{$flag}' ";
}

if(!empty($cidx)){
    $WHERE .= " AND a.cidx = '{$cidx}' ";
}

if(!empty($hidx)){
    $WHERE .= " AND a.hidx = '{$hidx}' ";
}

if(!empty($regflag_two)){
    if($regflag_two == "8"){ //당첨 전 취소
        $WHERE .= " AND a.regflag = '{$regflag_two}' ";
    }else{
        $WHERE .= " AND a.regflag_two = '{$regflag_two}' ";
    }
}


if(!empty($com_amount1)){
    $WHERE .= " AND e.com_amount >= $com_amount1  ";
}

if(!empty($com_amount2) ){
    $WHERE .= " AND e.com_amount <= $com_amount2  ";
}

if(!empty($per_amount1)){
    $WHERE .= " AND e.per_amount >= $per_amount1  ";
}

if(!empty($per_amount2) ){
    $WHERE .= " AND e.per_amount <= $per_amount2  ";
}



$SQL = "SELECT ";
$SQL .= "   a.ridx, date_format(a.wdate,'%Y.%m.%d') as wdate, a.cymd, a.useday, b.cname, c.hname, a.pgubun, d.rArea, d.rCnt, ";
$SQL .= "   a.name, a.sano, ifnull(a.hp, a.tel) as hp, a.regflag, a.midx, a.hidx, a.cidx, a.seq, date_format(a.cancel_date,'%Y.%m.%d') as cancel_date, ";
$SQL .= "   case when a.chasu = 0 then '선착순' else concat(a.chasu,'지망') end as chasu, a.regflag_two ";
$SQL .= "FROM tb_reInfo a  ";
$SQL .= "LEFT OUTER JOIN (select idx,comname as cname, hp from tb_company) b on a.cidx=b.idx ";
$SQL .= "LEFT OUTER JOIN (select idx,comname as hname from tb_hu) c on a.hidx=c.idx ";
$SQL .= "LEFT OUTER JOIN (select idx,seq,rArea, rCnt  from tb_huType) d on a.hidx=d.idx and a.seq = d.seq ";
$SQL .= "LEFT OUTER JOIN (select midx, com_amount, per_amount  from tb_comhuM) e on a.midx=e.midx ";
$SQL .= "WHERE (a.regflag in ('7','8') OR a.regflag_two in ('2','3','4') ) ";
$SQL .= $WHERE;
$SQL .= " ORDER BY a.ridx desc ";


$result = mysqli_query($gconnet, $SQL);
$totalCnt = mysqli_num_rows($result);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);

    
    $useday = $usedayArray[$row['useday']]."(".get_days($row['cymd'], $row['useday']).")";
    
    if( $row['regflag'] == "8"){
        $regflag = $regFlagArray[$row['regflag']]."\n".$row['cancel_date'];
    }else{
        $regflag = $cancelFlagArray[$row['regflag_two']]."\n".$row['cancel_date'];
    }



    $responce->rows[$i]['id'] = $row['ridx'];
	$responce->rows[$i]['cell']= array( $row['ridx'], ($totalCnt-$i), $row['chasu'], $row['wdate'], $useday, $row['cname'], $row['pgubun'], 
                                        $row['hname'], $row['rArea'], $row['rCnt'],  $row['name'], $row['sano'], $row['hp'], $regflag,
                                        $row['midx'], $row['hidx'], $row['cidx'], $row['seq']
                                );
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>