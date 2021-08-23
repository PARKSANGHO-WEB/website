<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$cidx     = trim(sqlfilter($_REQUEST['cidx']));
$hidx    = trim(sqlfilter($_REQUEST['hidx']));
$startDate      = trim(sqlfilter($_REQUEST['startDate']));
$endDate        = trim(sqlfilter($_REQUEST['endDate']));
$where = " ";

if(!empty($cidx)){

    $where .= " AND a.cidx = {$cidx} ";    
}

if(!empty($hidx)){

    $where .= " AND b.hidx = {$hidx} ";    
}

if(!empty($startDate)){
    $where .= " AND a.wdate >=  str_to_date('{$startDate}', '%Y-%m-%d') ";   
}
if(!empty($endDate)){
    $where .= " AND a.wdate <   DATE_ADD(str_to_date('{$endDate}', '%Y-%m-%d'), INTERVAL 1 DAY) ";   
}

$SQL = " select  t.sidx, t.cidx, t.hidx, c.comname as huname, t.cnt, date_format(t.wdate,'%Y.%m.%d') as wdate, s.title, t.answer, d.comname   ";
$SQL .= " from ( ";
$SQL .= " SELECT a.cidx, a.sidx, b.hidx , count(distinct(a.qidx)) as cnt, count(distinct(b.ridx)) as answer, max(wdate) as wdate   ";
$SQL .= " FROM tb_survey_question a ";
$SQL .= " left outer join (select cidx, sidx, hidx, ridx from tb_survey_answer) b on a.cidx = b.cidx and a.sidx = b.sidx ";
$SQL .= " where 1=1 AND a.del_yn = 'N' ";
$SQL .=  $where;
$SQL .= " group by a.cidx, a.sidx, b.hidx   ";
$SQL .= " )t, tb_survey s, tb_hu c , tb_company d   ";
$SQL .= "  where t.cidx = s.cidx and t.sidx = s.sidx and t.hidx = c.idx and t.cidx = d.idx ";
$SQL .= "  order by t.sidx desc";


$result = mysqli_query($gconnet, $SQL);
$totalCnt = mysqli_num_rows($result);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);

    if($row[answer]){
        $answer = $row[answer];
    }else{
        $answer = 'N';
    }

    $responce->rows[$i]['id'] = $row['sidx'].":".$row['hidx'];
	$responce->rows[$i]['cell']= array( $row['sidx'].":".$row['hidx'], ($totalCnt-$i), $row['wdate'], $row['comname'], $row['huname'], 
                                        $row['title'], $answer, $row['cnt'], $row['sidx'], $row['hidx']);

}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>