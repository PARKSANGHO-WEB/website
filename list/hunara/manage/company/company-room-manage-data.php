<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$flag       = trim(sqlfilter($_REQUEST['flag']));
$cidx       = trim(sqlfilter($_REQUEST['cidx']));
$hidx       = trim(sqlfilter($_REQUEST['hidx']));
$type       = trim(sqlfilter($_REQUEST['type']));
$com_amount1 = trim(sqlfilter($_REQUEST['com_amount1']));
$com_amount2 = trim(sqlfilter($_REQUEST['com_amount2']));
$per_amount1 = trim(sqlfilter($_REQUEST['per_amount1']));
$per_amount2 = trim(sqlfilter($_REQUEST['per_amount2']));

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

if(!empty($type)){
    $WHERE .= " AND a.type = '$type'  ";
}


$SQL = "SELECT a.midx, date_format(a.wdate,'%Y.%m.%d') as wdate, c.comname, b.comname as huname, a.flag, b.tel, ";
$SQL .= " concat(date_format(a.udate1,'%Y.%m.%d'), '~' ,date_format(a.udate2,'%Y.%m.%d') ) as period, a.type, ";
$SQL .= " a.com_amount,  a.per_amount  ";
$SQL .= " FROM tb_comhuM a, tb_hu b, tb_company c ";
$SQL .= " WHERE a.hidx = b.idx ";
$SQL .= "   AND a.cidx = c.idx ";
$SQL .= "   AND a.del_yn = 'N' ";
$SQL .= $WHERE;
$SQL .= " ORDER BY a.midx desc ";

$result = mysqli_query($gconnet, $SQL);
$totalCnt = mysqli_num_rows($result);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);

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
    
    $responce->rows[$i]['id'] = $row['midx'];
	$responce->rows[$i]['cell']=array($row['midx'], ($totalCnt-$i), $row['wdate'], $row['comname'], 
                                        $row['huname'], $row['flag'], $assignArray[$row['type']], $row['period'], $row['tel'], $amount
                                ); 
	
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);



?>