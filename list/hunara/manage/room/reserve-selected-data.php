<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$flag       = trim(sqlfilter($_REQUEST['flag']));
$cidx       = trim(sqlfilter($_REQUEST['cidx']));
$hidx       = trim(sqlfilter($_REQUEST['hidx']));
$chasu      = trim(sqlfilter($_REQUEST['chasu']));
$com_amount1 = trim(sqlfilter($_REQUEST['com_amount1']));
$com_amount2 = trim(sqlfilter($_REQUEST['com_amount2']));
$per_amount1 = trim(sqlfilter($_REQUEST['per_amount1']));
$per_amount2 = trim(sqlfilter($_REQUEST['per_amount2']));

/*

SELECT
	x.midx, x.hidx, x.cidx, x.seq, x.wdate, b.cname, c.hname, x.flag, 
    x.udate1, x.udate2, b.hp, x.com_amount, x.per_amount, x.rev_cnt, x.win_cnt,
    ifnull(y1.rCnt,0) as useday1_cnt , ifnull(y2.rCnt,0) as useday2_cnt, 
    ifnull(y3.rCnt,0) as useday3_cnt, ifnull(y4.rCnt,0) as useday4_cnt
FROM (
    SELECT a.midx, a.hidx, a.cidx, b.seq, a.wdate, a.flag, a.udate1, a.udate2, a.com_amount, a.per_amount,
    		count(b.ridx) as rev_cnt, sum(case when b.regflag = '5' then 1 else 0 end) as win_cnt
    FROM tb_comhuM a, tb_reInfo b
    WHERE a.midx = b.midx
      AND a.cidx = b.cidx
      AND a.hidx = b.hidx
      AND a.flag = '상시' AND a.cidx = 105  AND a.hidx= 206  AND b.chasu  AND a.com_amount  AND a.per_amount
    GROUP BY a.midx, a.hidx, a.cidx, b.seq, a.wdate, a.flag, a.udate1, a.udate2, a.com_amount, a.per_amount
)x
LEFT OUTER JOIN (select idx,comname as cname, hp from tb_company) b on x.cidx=b.idx
LEFT OUTER JOIN (select idx,comname as hname from tb_hu) c on x.hidx=c.idx
LEFT OUTER JOIN (select midx, seq, useday, rCnt from tb_comhuMtype) y1 on x.midx = y1.midx and x.seq = y1.seq and y1.useday = 1
LEFT OUTER JOIN (select midx, seq, useday, rCnt from tb_comhuMtype) y2 on x.midx = y2.midx and x.seq = y2.seq and y2.useday = 2
LEFT OUTER JOIN (select midx, seq, useday, rCnt from tb_comhuMtype) y3 on x.midx = y3.midx and x.seq = y3.seq and y3.useday = 3
LEFT OUTER JOIN (select midx, seq, useday, rCnt from tb_comhuMtype) y4 on x.midx = y4.midx and x.seq = y4.seq and y4.useday = 4
*/
$WHERE = "";
if(isset($flag)){
    $WHERE .= " AND a.flag = '{$flag}' ";
}

if(isset($cidx)){
    $WHERE .= " AND a.cidx = '{$cidx}' ";
}

if(isset($hidx)){
    $WHERE .= " AND a.hidx = '{$hidx}' ";
}

if(isset($com_amount1)){
    $WHERE .= " AND a.com_amount >= $com_amount1  ";
}

if(isset($com_amount2)){
    $WHERE .= " AND a.com_amount <= $com_amount2  ";
}

if(isset($per_amount1)){
    $WHERE .= " AND a.per_amount >= $com_amount1  ";
}

if(isset($per_amount2)){
    $WHERE .= " AND a.per_amount <= $com_amount2  ";
}

if(isset($chasu)){
    $WHERE .= " AND b.chasu = $chasu  ";
}



$SQL = "SELECT ";
$SQL .= "   x.midx, x.hidx, x.cidx, date_format(x.wdate,'%Y.%m.%d') as wdate, x.seq, b.cname, c.hname, x.flag,  ";
$SQL .= "   x.udate1, x.udate2, b.hp, x.com_amount, x.per_amount, x.rev_cnt, x.win_cnt, ";
$SQL .= "   case when date_format(now(), '%Y%m%d') between x.udate1 and x.udate2 then 'Y' else 'N' end as rev_yn, ";
$SQL .= "   ifnull(y1.rCnt,0) as useday1_cnt , ifnull(y2.rCnt,0) as useday2_cnt, ";
$SQL .= "   ifnull(y3.rCnt,0) as useday3_cnt, ifnull(y4.rCnt,0) as useday4_cnt ";
$SQL .= "FROM ( ";
$SQL .= "   SELECT a.midx, a.hidx, a.cidx, b.seq, a.wdate, a.flag, a.udate1, a.udate2, a.com_amount, a.per_amount,   ";
$SQL .= "       count(b.ridx) as rev_cnt, sum(case when b.regflag = '5' then 1 else 0 end) as win_cnt  ";
$SQL .= "   FROM tb_comhuM a, tb_reInfo b ";
$SQL .= "     AND a.cidx = b.cidx ";
$SQL .= "     AND a.hidx = b.hidx ";
$SQL .= $WHERE
$SQL .= "   GROUP BY a.midx, a.hidx, a.cidx, b.seq, a.wdate, a.flag, a.udate1, a.udate2, a.com_amount, a.per_amount ";
$SQL .= ")x  ";
$SQL .= "LEFT OUTER JOIN (select idx,comname as cname, hp from tb_company) b on x.cidx=b.idx ";
$SQL .= "LEFT OUTER JOIN (select idx,comname as hname from tb_hu) c on x.hidx=c.idx ";
$SQL .= "LEFT OUTER JOIN (select midx, seq, useday, rCnt from tb_comhuMtype) y1 on x.midx = y1.midx and x.seq = y1.seq and y1.useday = 1 ";
$SQL .= "LEFT OUTER JOIN (select midx, seq, useday, rCnt from tb_comhuMtype) y2 on x.midx = y2.midx and x.seq = y2.seq and y2.useday = 2 ";
$SQL .= "LEFT OUTER JOIN (select midx, seq, useday, rCnt from tb_comhuMtype) y3 on x.midx = y3.midx and x.seq = y3.seq and y3.useday = 3 ";
$SQL .= "LEFT OUTER JOIN (select midx, seq, useday, rCnt from tb_comhuMtype) y4 on x.midx = y4.midx and x.seq = y4.seq and y4.useday = 4 ";


$result = mysqli_query($gconnet, $SQL);

for ($i=0; $i<mysqli_num_rows($result); $i++){
    $row = mysqli_fetch_array($result);

    $useday = "";
    if($row['useday1_cnt'] > 0){
        $useday .= "<br>1박 2일({$row['useday1_cnt']})";
    }
    
    if($row['useday2_cnt'] > 0){
        $useday .= "<br>2박 3일({$row['useday2_cnt']})";
    }

    if($row['useday3_cnt'] > 0){
        $useday .= "<br>3박 4일({$row['useday3_cnt']})";
    }

    if($row['useday4_cnt'] > 0){
        $useday .= "<br>4박 5일({$row['useday4_cnt']})";
    }

    $amount = "";
    if($row['com_amount'] > 0){
        $amount .= "<br>기업 {$row['com_amount']} 원";
    }
    if($row['per_amount'] > 0){
        $amount .= "<br>개인 {$row['per_amount']} 원";
    }



    $responce->rows[$i]['midx'] = $row['midx'];
    $responce->rows[$i]['hidx'] = $row['hidx'];
    $responce->rows[$i]['cidx'] = $row['cidx'];
    $responce->rows[$i]['seq'] = $row['seq'];
	$responce->rows[$i]['cell']= array( $row['midx'], ($i+1), $row['wdate'], $row['cname'], $row['hname'], $row['flag'], 
                                        $row['rev_yn'], $row['udate1'].'~'.$row['udate2'], $useday, $row['hp'], $amount, 
                                        $row['rev_cnt'], $row['win_cnt'], $row['rev_cnt']- $row['win_cnt']);
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>