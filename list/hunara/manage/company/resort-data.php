<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$comname 	= trim(sqlfilter($_REQUEST['hidx']));
$sql3 = 'SELECT idx ';
$sql3 .= " FROM tb_hu ";
$sql3 .= " where comname = '".$comname."' ";
$rs3 = mysqli_query($gconnet, $sql3);
$row3 = mysqli_fetch_array($rs3);

$hidx = $row3[idx];

$res = array("addr"=>"", "tel"=>"", "homepage" => "", "con5" => "", "roomList" => "");

/* 휴양소 정보 조회 */
$sql = "SELECT concat('(',a.post,')', a.addr1, ' ', a.addr2) as addr, a.tel, a.homepage, a.con5  ";
$sql .= " FROM tb_hu a ";
$sql .= " WHERE a.idx = ".$hidx;

$rs = mysqli_query($gconnet, $sql);
$row = mysqli_fetch_array($rs);

$res["addr"] = $row["addr"];
$res["tel"] = $row["tel"];
$res["homepage"] = $row["homepage"];
$res["hidx"] = $hidx;
$res["con5"] = $row["con5"];


/* 휴양소 객실 정보 조회 */
$roomList = [];
$sql2 = "SELECT seq, rArea , rType, rCnt, rAvg, rMax, rInfra  ";
$sql2 .= " FROM tb_huType ";
$sql2 .= " WHERE idx = ".$hidx;

$rs2 = mysqli_query($gconnet, $sql2);
for($i=0; $i< mysqli_num_rows($rs2); $i++ ){
    $row2 = mysqli_fetch_array($rs2);
    $roomInfo = array("seq"=>"", "rArea"=>"", "rType" =>"", "rCnt" =>"", "rAvg" => "", "rMax" =>"", "rInfra" =>"" );

    $roomInfo["seq"] = $row2["seq"];
    $roomInfo["rArea"] = $row2["rArea"];
    $roomInfo["rType"] = $row2["rType"];
    $roomInfo["rCnt"] = $row2["rCnt"];
    $roomInfo["rAvg"] = $row2["rAvg"];
    $roomInfo["rMax"] = $row2["rMax"];
    $roomInfo["rInfra"] = $row2["rInfra"];

    array_push($roomList, $roomInfo);
}

$res["roomList"] = $roomList;

echo json_encode($res, JSON_UNESCAPED_UNICODE);

?>