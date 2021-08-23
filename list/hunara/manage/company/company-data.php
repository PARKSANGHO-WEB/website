<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$searchType     = trim(sqlfilter($_REQUEST['searchType']));
$searchValue    = trim(sqlfilter($_REQUEST['searchValue']));
$startDate      = trim(sqlfilter($_REQUEST['startDate']));
$endDate        = trim(sqlfilter($_REQUEST['endDate']));


$SQL = " SELECT a.idx, date_format(a.wdate,'%Y.%m.%d') as wdate, a.comname, a.cdomain, a.dname, a.tel, a.hp, a.email, a.comimg,";
$SQL .= " (select count(*) from tb_employee where cdx = a.idx) employeeCnt, ";
$SQL .= " (select count(*) from tb_comhuM where cidx = a.idx) resortCnt ";
$SQL .= " FROM tb_company a  WHERE 1=1 ";

if(!empty($searchValue)){

    if($searchType == "comname"){
        $SQL .= " AND a.comname like '%{$searchValue}%' ";    
    }

    if($searchType == "dname"){
        $SQL .= " AND a.dname like '%{$searchValue}%' ";    
    }
}

if(!empty($startDate)){
    $SQL .= " AND a.wdate >=  str_to_date('{$startDate}', '%Y-%m-%d') ";   
}
if(!empty($endDate)){
    $SQL .= " AND a.wdate <   DATE_ADD(str_to_date('{$endDate}', '%Y-%m-%d'), INTERVAL 1 DAY) ";   
}

$SQL .= " ORDER BY a.idx desc ";


$result = mysqli_query($gconnet, $SQL);
$totalCnt = mysqli_num_rows($result);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);

    $responce->rows[$i]['id'] = $row['idx'];
	$responce->rows[$i]['cell']= array( $row['idx'], ($totalCnt-$i), $row['wdate'], $row['comname'], $row['cdomain'], $row['dname'], 
                                        $row['tel'], $row['hp'], $row['email'], $row['employeeCnt'], $row['resortCnt'] );
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>