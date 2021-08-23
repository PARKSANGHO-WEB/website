<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$field = trim(sqlfilter($_REQUEST['field']));
$keyword = sqlfilter($_REQUEST['keyword']);
$id = sqlfilter($_REQUEST['id']);

if ($field && $keyword){
	if($field == "all"){
		$where .= "and (a.title like '%".$keyword."%' or a.content like '%".$keyword."%' or a.name like '%".$keyword."%')";
	} else {
		$where .= "and ".$field." like '%".$keyword."%'";
	}
}

if ($id){
	$where .= "and a.bkind = '".$id."'";
}

$order_by = " ORDER BY a.idx desc ";

$query = "select a.idx, a.title, a.name, a.hit ,date_format(a.nows,'%Y.%m.%d') as nows from tb_rv a where 1=1 ".$where.$order_by;
$query_cnt = "select idx from tb_rv a where 1=1 ".$where;


$result = mysqli_query($gconnet, $query);
$result_cnt = mysqli_query($gconnet,$query_cnt);
$totalCnt = mysqli_num_rows($result_cnt);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);
    
    $responce->rows[$i]['id'] = $row['idx'];
	$responce->rows[$i]['cell']= array( $row['idx'], ($totalCnt-$i), $row['title'], $row['name'], $row['nows'], $row['hit']); 
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>