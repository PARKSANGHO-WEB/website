<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$id        = trim(sqlfilter($_REQUEST['id']));
$cdx       = trim(sqlfilter($_REQUEST['cdx']));

$SQL = " SELECT b.midx, date_format(b.wdate,'%Y.%m.%d') as wdate, c.comname as comname, b.flag, b.type, ";
$SQL .= "  date_format(b.udate1,'%Y.%m.%d') as udate1, date_format(b.udate2,'%Y.%m.%d') as udate2, ";
$SQL .= "  case when date_format(now(), '%Y%m%d') between b.udate1 and b.udate2 then 'Y' else 'N' end as rev_yn, ";
$SQL .= "   c.tel as tel, b.com_amount, b.per_amount  ";
$SQL .= " FROM tb_comhuM b, tb_hu c  ";
$SQL .= " WHERE 1=1 and c.idx = b.hidx and b.del_yn = 'N' ";

if($id){
    $SQL .= " AND b.cidx = ".$id." ";     
}

if($cdx){
    $SQL .= " AND b.cidx = ".$cdx." ";     
}

$SQL .= " ORDER BY b.midx desc ";


$result = mysqli_query($gconnet, $SQL);
$totalCnt = mysqli_num_rows($result);

for ($i=0; $i<$totalCnt; $i++){
    $row = mysqli_fetch_array($result);
    $udate = $row['udate1'].'~'.$row['udate2'];


    $responce->rows[$i]['id'] = $row['midx'];
	$responce->rows[$i]['cell']= array( $row['midx'], ($totalCnt-$i), $row['wdate'], $row['comname'], $row['flag'], $assignArray[$row['type']], $row['rev_yn'], 
                                        $udate, $row['tel'], number_format($row['com_amount'])."원 ", number_format($row['per_amount'])."원 "  );
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>