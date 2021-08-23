<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction

if(!$sidx) $sidx =1;


$SQL = 'SELECT COUNT(*) AS count FROM tb_hu ';
$result = mysqli_query($gconnet, $SQL);
$row = mysqli_fetch_array($result);
$count = $row['count'];

if( $count >0 ) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 0;
}
if ($page > $total_pages) $page=$total_pages;
$start = $limit*$page - $limit; // do not put $limit*($page - 1)


$SQL = 'SELECT idx, date_format(wdate, "%Y/%m/%d") as wdate, comname, tel, homepage, room FROM tb_hu ';
$result = mysqli_query($gconnet, $SQL) or die("Couldn't execute query.".mysqli_error($gconnet));


$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;

$i=0;
while ($row = mysqli_fetch_array($result)) {

    $responce->rows[$i]['id'] = $row['idx'];
	$responce->rows[$i]['cell']=array($row['idx'], $i, $row['wdate'], $row['comname'], $row['tel'], $row['homepage'], $row['room']);
	$i++;
}
										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
?>