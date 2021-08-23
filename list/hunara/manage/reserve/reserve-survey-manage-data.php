<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$searchType     = trim(sqlfilter($_REQUEST['searchType']));
$searchValue    = trim(sqlfilter($_REQUEST['searchValue']));
$startDate      = trim(sqlfilter($_REQUEST['startDate']));
$endDate        = trim(sqlfilter($_REQUEST['endDate']));
$where = " ";


if(!empty($searchValue)){

    if($searchType == "comname"){
        $where .= " AND b.comname like '%{$searchValue}%' ";    
    }

}

if(!empty($startDate)){
    $where .= " AND a.wdate >=  str_to_date('{$startDate}', '%Y-%m-%d') ";   
}
if(!empty($endDate)){
    $where .= " AND a.wdate <   DATE_ADD(str_to_date('{$endDate}', '%Y-%m-%d'), INTERVAL 1 DAY) ";   
}

$SQL = " select a.cidx, a.sidx, b.comname, a.title, date_format(a.wdate, '%Y.%m.%d') as wdate ,   ";
$SQL .= " (select count(distinct ridx) from tb_survey_answer where cidx = a.cidx and sidx = a.sidx) as answer ";
$SQL .= " from tb_survey a, tb_company b  ";
$SQL .= " where a.del_yn = 'N'  ";
$SQL .= " and a.cidx = b.idx ";
$SQL .= $where;


$result = mysqli_query($gconnet, $SQL);
$totalCnt = mysqli_num_rows($result);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);

    if($row['answer']){
        $answer = $row['answer'];
    }else{
        $answer = 'N';
    }

    $responce->rows[$i]['id'] = $row['sidx'];
	$responce->rows[$i]['cell']= array( $row['sidx'], $row['cidx'], ($totalCnt-$i), $row['wdate'], $row['comname'], $row['title'], $answer );

}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>