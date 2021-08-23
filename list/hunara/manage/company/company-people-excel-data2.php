<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$id        = trim(sqlfilter($_REQUEST['id']));
$cdx        = trim(sqlfilter($_REQUEST['cdx']));
$dupl        = trim(sqlfilter($_REQUEST['dupl']));


$SQL = " SELECT a.seq, a.name, a.sano,duplicate";
$SQL .= " FROM tb_employee_excel a WHERE 1=1";



$SQL .= " AND a.max = ".$id." ";    


if($cdx){
    $SQL .= " AND a.cdx = ".$cdx." ";    
}

if($dupl){
    $SQL .= " AND a.duplicate = '".$dupl."' ";    
}


$SQL .= " ORDER BY a.seq desc ";


$result = mysqli_query($gconnet, $SQL);
$totalCnt = mysqli_num_rows($result);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);
    
    $responce->rows[$i]['id'] = $row['seq'];
	$responce->rows[$i]['cell']= array( $row['seq'], ($totalCnt-$i), $row['name'], $row['sano'], $row['duplicate']);
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>