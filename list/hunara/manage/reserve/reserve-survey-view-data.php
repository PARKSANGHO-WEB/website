<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$sidx     = trim(sqlfilter($_REQUEST['idx']));
$hidx     = trim(sqlfilter($_REQUEST['hidx']));
$cidx     = trim(sqlfilter($_REQUEST['cidx']));


$SQL = " SELECT ";
$SQL .= "   b.ridx, date_format(max(b.wdate),'%Y.%m.%d')  as wdate,  ";
$SQL .= "   max(case when a.rnum =1 then b.answer end) as answer1,  ";
$SQL .= "   max(case when a.rnum =2 then b.answer end) as answer2,  ";
$SQL .= "   max(case when a.rnum =3 then b.answer end) as answer3,  ";
$SQL .= "   max(case when a.rnum =4 then b.answer end) as answer4,  ";
$SQL .= "   max(case when a.rnum =5 then b.answer end) as answer5,  ";
$SQL .= "   max(case when a.rnum =6 then b.answer end) as answer6,  ";
$SQL .= "   max(case when a.rnum =7 then b.answer end) as answer7,  ";
$SQL .= "   max(case when a.rnum =8 then b.answer end) as answer8,  ";
$SQL .= "   max(case when a.rnum =9 then b.answer end) as answer9,  ";
$SQL .= "   max(case when a.rnum =10 then b.answer end) as answer10,  ";
$SQL .= "   max(case when a.rnum =11 then b.answer end) as answer11,  ";
$SQL .= "   max(case when a.rnum =12 then b.answer end) as answer12,  ";
$SQL .= "   max(case when a.rnum =13 then b.answer end) as answer13,  ";
$SQL .= "   max(case when a.rnum =14 then b.answer end) as answer14,  ";
$SQL .= "   max(case when a.rnum =15 then b.answer end) as answer15,  ";
$SQL .= "   max(case when a.rnum =16 then b.answer end) as answer16,  ";
$SQL .= "   max(case when a.rnum =17 then b.answer end) as answer17  ";
$SQL .= "FROM(   ";
$SQL .= "   SELECT @ROWNUM := @ROWNUM +1 AS rnum , cidx, sidx, qidx, flag, question     "; 
$SQL .= "   FROM tb_survey_question t, (SELECT @ROWNUM := 0) tmp   ";
$SQL .= "   WHERE cidx = '{$cidx}' AND sidx = '{$sidx}'   ";
$SQL .= ")a, tb_survey_answer b  ";
$SQL .= "WHERE a.cidx = b.cidx and a.sidx = b.sidx and a.qidx = b.qidx  ";
$SQL .= "and b.cidx = '{$cidx}' and b.sidx = '{$sidx}'  and b.hidx = '{$hidx}'  ";
$SQL .= "GROUP By b.ridx  ";

$result = mysqli_query($gconnet, $SQL);
$totalCnt = mysqli_num_rows($result);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);


    $responce->rows[$i]['id'] = $row['ridx'];
	$responce->rows[$i]['cell']= array( ($totalCnt-$i), $row['wdate'], $row['answer1'], $row['answer2'], $row['answer3'], $row['answer4'],$row['answer5'],
                                        $row['answer6'],$row['answer7'],$row['answer8'], $row['answer9'],$row['answer10'],$row['answer11'],
                                        $row['answer12'],$row['answer13'],$row['answer14'],$row['answer15'],$row['answer16'],$row['answer17']
                                        );
}
									
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>