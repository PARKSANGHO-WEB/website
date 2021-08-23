<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$flag       = trim(sqlfilter($_REQUEST['flag']));
$cidx       = trim(sqlfilter($_REQUEST['cidx']));
$hidx       = trim(sqlfilter($_REQUEST['hidx']));
$chDate      = trim(sqlfilter($_REQUEST['chDate']));
$com_amount1 = trim(sqlfilter($_REQUEST['com_amount1']));
$com_amount2 = trim(sqlfilter($_REQUEST['com_amount2']));
$per_amount1 = trim(sqlfilter($_REQUEST['per_amount1']));
$per_amount2 = trim(sqlfilter($_REQUEST['per_amount2']));
$name        = trim(sqlfilter($_REQUEST['name']));

$WHERE = "";
if(!empty($flag)){
    $WHERE .= " AND a.flag = '{$flag}' ";
}

if(!empty($cidx)){
    $WHERE .= " AND a.cidx = '{$cidx}' ";
}

if(!empty($hidx)){
    $WHERE .= " AND a.hidx = '{$hidx}' ";
}

if(!empty($com_amount1)){
    $WHERE .= " AND a.com_amount >= $com_amount1  ";
}

if(!empty($com_amount2)){
    $WHERE .= " AND a.com_amount <= $com_amount2  ";
}

if(!empty($per_amount1)){
    $WHERE .= " AND a.per_amount >= $per_amount1  ";
}

if(!empty($per_amount2)){
    $WHERE .= " AND a.per_amount <= $per_amount2  ";
}


if(!empty($chDate)){
    if($chDate == "N"){ //마감제외 
        $WHERE .= " AND c.endDate is null  ";
    }else if($chDate == "E"){ //마감
        $WHERE .= " AND c.endDate is not null  ";
    }else if($chDate == "1" || $chDate == "2" || $chDate == "3" ) {
        $WHERE .= " AND c.chDate".$chDate." is not null AND c.chDate".($chDate+1)." is null AND c.endDate is null ";
    }else if($chDate == "4"){
        $WHERE .= " AND c.chDate".$chDate." is not null AND c.endDate is null ";
    }
}

if(!empty($name)){
    $WHERE .= " AND b.name Like '%".$name."%' ";
}

$SQL = "SELECT ";
$SQL .= "   x.midx, x.hidx, x.cidx, date_format(x.wdate,'%Y.%m.%d') as wdate, x.seq, b.cname, c.hname, x.flag,  ";
$SQL .= "   date_format(x.udate1,'%Y.%m.%d') as udate1, date_format(x.udate2,'%Y.%m.%d') as udate2, b.hp, ";
$SQL .= "   x.com_amount, x.per_amount, x.rev_cnt, x.win_cnt, x.etc_cnt, ";
$SQL .= "   case when date_format(now(), '%Y%m%d') between x.udate1 and x.udate2 then 'Y' else 'N' end as rev_yn, ";
$SQL .= "   ifnull(y1.rCnt,0) as useday1_cnt , ifnull(y2.rCnt,0) as useday2_cnt, ";
$SQL .= "   ifnull(y3.rCnt,0) as useday3_cnt, ifnull(y4.rCnt,0) as useday4_cnt ";
$SQL .= "FROM ( ";
$SQL .= "   SELECT a.midx, a.hidx, a.cidx, b.seq, a.wdate, a.flag, a.udate1, a.udate2, a.com_amount, a.per_amount,   ";
$SQL .= "           count(b.ridx) as rev_cnt, sum(case when trim(b.digit7) <> '' or b.digit7 is not null then 1 end) as win_cnt,  ";
$SQL .= "           sum(case when b.regflag <> '5' then 1 end) as etc_cnt  ";
$SQL .= "   FROM tb_comhuM a, tb_reInfo b, tb_comhuMtype c  ";
$SQL .= "     WHERE a.midx = b.midx ";
$SQL .= "     AND a.cidx = b.cidx ";
$SQL .= "     AND a.hidx = b.hidx ";
$SQL .= "     AND a.midx = c.midx ";
$SQL .= "     AND b.seq = c.seq ";
$SQL .= "     AND a.del_yn = 'N' ";
$SQL .= $WHERE;
$SQL .= "   GROUP BY a.midx, a.hidx, a.cidx, b.seq, a.wdate, a.flag, a.udate1, a.udate2, a.com_amount, a.per_amount ";
$SQL .= ")x  ";
$SQL .= "LEFT OUTER JOIN (select idx,comname as cname, hp from tb_company) b on x.cidx=b.idx ";
$SQL .= "LEFT OUTER JOIN (select idx,comname as hname from tb_hu) c on x.hidx=c.idx ";
$SQL .= "LEFT OUTER JOIN (select midx, seq, useday, 1 as rCnt from tb_comhuM_useday) y1 on x.midx = y1.midx and x.seq = y1.seq and y1.useday = 1 ";
$SQL .= "LEFT OUTER JOIN (select midx, seq, useday, 1 as rCnt from tb_comhuM_useday) y2 on x.midx = y2.midx and x.seq = y2.seq and y2.useday = 2 ";
$SQL .= "LEFT OUTER JOIN (select midx, seq, useday, 1 as rCnt from tb_comhuM_useday) y3 on x.midx = y3.midx and x.seq = y3.seq and y3.useday = 3 ";
$SQL .= "LEFT OUTER JOIN (select midx, seq, useday, 1 as rCnt from tb_comhuM_useday) y4 on x.midx = y4.midx and x.seq = y4.seq and y4.useday = 4 ";
$SQL .= "ORDER BY  x.wdate desc ";

$result = mysqli_query($gconnet, $SQL);
$totalCnt = mysqli_num_rows($result);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);

    $useday = "";
    if($row['useday1_cnt'] > 0){
        $useday .= "\n1박 2일";
    }
    
    if($row['useday2_cnt'] > 0){
        $useday .= "\n2박 3일";
    }

    if($row['useday3_cnt'] > 0){
        $useday .= "\n3박 4일";
    }

    if($row['useday4_cnt'] > 0){
        $useday .= "\n4박 5일";
    }

    if(!empty($useday)){
        $useday = substr($useday,1,strlen($useday));
    }

    $amount = "";
    if($row['com_amount'] >= 0){
        //$amount .= "\n기업 ".number_format($row['com_amount'])." 원";
    }
    if($row['per_amount'] >= 0){
        $amount .= "\n개인 ".number_format($row['per_amount'])." 원";
    }

    if(!empty($amount)){
        $amount = substr($amount,1,strlen($amount));
    }


    $responce->rows[$i]['midx'] = $row['midx'];
    $responce->rows[$i]['hidx'] = $row['hidx'];
    $responce->rows[$i]['cidx'] = $row['cidx'];
    $responce->rows[$i]['seq'] = $row['seq'];
	$responce->rows[$i]['cell']= array( $row['midx'], ($totalCnt-$i), $row['wdate'], $row['cname'], $row['hname'], $row['flag'], 
                                        $row['rev_yn'], $row['udate1']." ~\n".$row['udate2'], $useday,  $amount, 
                                        $row['rev_cnt'], $row['win_cnt'], $row['etc_cnt'],
                                        $row['midx'], $row['hidx'], $row['cidx'], $row['seq']
                                );
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>