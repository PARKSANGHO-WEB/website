<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?


$searchType     = trim(sqlfilter($_REQUEST['searchType']));
$searchValue    = trim(sqlfilter($_REQUEST['searchValue']));
$startDate      = trim(sqlfilter($_REQUEST['startDate']));
$endDate        = trim(sqlfilter($_REQUEST['endDate']));

$level        = trim(sqlfilter($_REQUEST['level']));


if(!empty($searchValue)){

    if($searchType == "comname"){
        $where .= " AND a.comname like '%{$searchValue}%' ";    
    }

    if($searchType == "tel"){
        $where .= " AND a.tel like '%{$searchValue}%' ";    
    }
}

if(!empty($startDate)){
    $where .= " AND a.wdate >=  str_to_date('{$startDate}', '%Y-%m-%d') ";   
}
if(!empty($endDate)){
    $where .= " AND a.wdate <   DATE_ADD(str_to_date('{$endDate}', '%Y-%m-%d'), INTERVAL 1 DAY) ";      
}


$order_by = " ORDER BY a.idx desc ";

if($level == '10'){
    $sql = "SELECT group_concat(distinct(hidx)) as hu FROM tb_comhuM WHERE cidx = '".$_SESSION['ADMIN_IDX']."'";
    $finish = mysqli_query($gconnet, $sql);
    $a = mysqli_fetch_array($finish);

    $where .= " AND idx in ( ".$a['hu']." )";
}

$query = "select a.idx, a.tel, a.comname, a.homepage ,date_format(a.wdate,'%Y.%m.%d') as wdate,(select sum(rCnt) from tb_huType b where 1=1 and b.idx=a.idx) as rcnt from tb_hu a where 1=1 ".$where.$order_by;
$query_cnt = "select idx from tb_hu a where 1=1 ".$where;


$result = mysqli_query($gconnet, $query);
$result_cnt = mysqli_query($gconnet,$query_cnt);
$totalCnt = mysqli_num_rows($result_cnt);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);
    
    $responce->rows[$i]['id'] = $row['idx'];
	$responce->rows[$i]['cell']= array( $row['idx'], ($totalCnt-$i), $row['wdate'], $row['comname'], $row['tel'], $row['homepage'], $row['rcnt']); 
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>