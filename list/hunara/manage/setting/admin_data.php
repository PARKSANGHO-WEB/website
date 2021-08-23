<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$field = trim(sqlfilter($_REQUEST['field']));
$keyword = sqlfilter($_REQUEST['keyword']);

if ($field && $keyword){
	if($field == "all"){
		$where .= "and (a.title like '%".$keyword."%' or a.content like '%".$keyword."%' or a.name like '%".$keyword."%')";
	} else {
		$where .= "and ".$field." like '%".$keyword."%'";
	}
}

$order_by = " ORDER BY a.idx desc ";

$query = "select a.idx, a.mem_idx, a.mem_pwd, a.mem_name ,date_format(a.nows,'%Y.%m.%d') as nows, mem_tel, email, flag, nows from tb_adminuser a where flag = 'Y' ".$where.$order_by;


$result = mysqli_query($gconnet, $query);
$totalCnt = mysqli_num_rows($result);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);

    if($row[flag] == 'N'){
        $flag = '사용불가';
    }else{
        $flag = '사용가능';
    }
    
    $responce->rows[$i]['id'] = $row['idx'];
	$responce->rows[$i]['cell']= array( $row['idx'], ($totalCnt-$i), $row['mem_idx'], $row['mem_name'], $row['mem_tel'], $row['email'], $row['nows'], $flag); 
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>