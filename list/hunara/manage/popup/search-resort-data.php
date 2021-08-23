<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$SQL = "SELECT a.idx, date_format(a.wdate,'%Y.%m.%d') as wdate, a.comname, a.tel, a.homepage ";
$SQL .= " FROM tb_hu a   ORDER BY comname ";

$result = mysqli_query($gconnet, $SQL);
$totalCnt = mysqli_num_rows($result);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);
    
    $responce->rows[$i]['id'] = $row['idx'];
	$responce->rows[$i]['cell']=array($row['idx'], ($totalCnt-$i), $row['wdate'], $row['comname'],  $row['tel'], $row['homepage'] );
	
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>