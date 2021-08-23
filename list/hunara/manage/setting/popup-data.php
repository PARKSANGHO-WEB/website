<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$field = trim(sqlfilter($_REQUEST['field']));
$keyword = sqlfilter($_REQUEST['keyword']);
$id = sqlfilter($_REQUEST['id']);

$searchType     = trim(sqlfilter($_REQUEST['searchType']));
$searchValue    = trim(sqlfilter($_REQUEST['searchValue']));
$startDate      = trim(sqlfilter($_REQUEST['startDate']));
$endDate        = trim(sqlfilter($_REQUEST['endDate']));

if(!empty($searchValue)){

    if($searchType == "comname"){
        $where .= " AND (select comname from tb_company where a.cidx = idx) like '%{$searchValue}%' ";    
    }

    if($searchType == "dname"){
        $where .= " AND a.dname like '%{$searchValue}%' ";    
    }
}

if(!empty($startDate)){
    $where .= " AND a.wdate >=  str_to_date('{$startDate}', '%Y-%m-%d') ";   
}
if(!empty($endDate)){
    $where .= " AND a.wdate <   DATE_ADD(str_to_date('{$endDate}', '%Y-%m-%d'), INTERVAL 1 DAY) ";   
}


$order_by = " ORDER BY a.idx desc ";

$query = "select a.idx, a.cidx, a.subject, a.content ,date_format(a.startdt,'%Y.%m.%d') as startdt ,date_format(a.enddt,'%Y.%m.%d') as enddt,date_format(a.wdate,'%Y.%m.%d') as wdate, is_use,(select comname from tb_company where a.cidx = idx) as comname  from popup_div a where 1=1 ".$where.$order_by;
$query_cnt = "select idx from popup_div a where 1=1 ".$where;


$result = mysqli_query($gconnet, $query);
$result_cnt = mysqli_query($gconnet,$query_cnt);
$totalCnt = mysqli_num_rows($result_cnt);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);
    if($row[is_use] == 'Y'){
        $use = '사용중';
    }else{
        $use = '사용안함';
    }
    
    $responce->rows[$i]['id'] = $row['idx'];
	$responce->rows[$i]['cell']= array( $row['idx'], ($totalCnt-$i), $use, $row['comname'], $row['subject'], $row['startdt'], $row['enddt'], $row['wdate']); 
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>