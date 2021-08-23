<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$cidx 	= trim(sqlfilter($_REQUEST['cidx']));
$res = array("dname"=>"", "tel"=>"", "hp" => "", "email" => "");

/* 휴양소 정보 조회 */
$sql = "SELECT a.dname, a.tel, a.hp, a.email  ";
$sql .= " FROM tb_company a ";
$sql .= " WHERE a.idx = ".$cidx;

$rs = mysqli_query($gconnet, $sql);
$row = mysqli_fetch_array($rs);

$res["dname"] = $row["dname"];
$res["tel"] = $row["tel"];
$res["hp"] = $row["hp"];
$res["email"] = $row["email"];

echo json_encode($res, JSON_UNESCAPED_UNICODE);

?>