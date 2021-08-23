<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$id        = trim(sqlfilter($_REQUEST['id']));
$cdx        = trim(sqlfilter($_REQUEST['cdx']));
$sano        = trim(sqlfilter($_REQUEST['sano']));
$name        = trim(sqlfilter($_REQUEST['name']));
$exclude        = trim(sqlfilter($_REQUEST['exclude']));


$SQL = " SELECT a.seq, date_format(a.wdate,'%Y.%m.%d') as wdate, a.team, a.class, a.name, a.digit7, a.sano, a.weight, a.pwd, a.exclude,  ";
$SQL .= " ifnull(b.apply,0) as apply, ifnull(b.winning, 0) as winning, ifnull(b.cancel,0) as cancel, c.comname ";
$SQL .= " FROM tb_employee a ";
$SQL .= " LEFT OUTER JOIN (select cidx, sano, count(ridx) as apply, sum(case when regflag in (5,6) then 1  end) as winning, sum(case when regflag in (7,8) then 1 end) as cancel  from tb_reInfo group by cidx, sano) b on a.cdx = b.cidx and a.sano = b.sano ";
$SQL .= " LEFT OUTER JOIN (select idx, comname from tb_company )c on a.cdx = c.idx ";
$SQL .= " WHERE 1=1 ";

if($id){
    $SQL .= " AND a.cdx = ".$id." ";    
}

if($cdx){
    $SQL .= " AND a.cdx = ".$cdx." ";    
}

if($sano){
    $SQL .= " AND a.sano like '%".$sano."%' ";    
}

if($name){
    $SQL .= " AND a.name like '%".$name."%' ";    
}

if($exclude){
    $SQL .= " AND a.exclude = '".$exclude."' ";    
}


$SQL .= " ORDER BY a.wdate desc, a.cdx desc, a.seq desc ";


$result = mysqli_query($gconnet, $SQL); 
$totalCnt = mysqli_num_rows($result);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);
    
    $responce->rows[$i]['id'] = $row['seq'];
	$responce->rows[$i]['cell']= array( $row['seq'], ($totalCnt-$i), $row['comname'] , $row['class'], $row['name'], 
                                        $row['digit7'], $row['sano'], $row['weight'], $row['apply'], $row['winning'], $row['cancel'], $row['pwd'], $row['exclude']);
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>