<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?

$types = $_REQUEST['types'];
$search = $_REQUEST['search'];
$start = $_REQUEST['start'];
$end = $_REQUEST['end'];
/*
echo "##=".$types."<br>";
echo "##=".$search."<br>";
echo "##=".$start."<br>";
echo "##=".$end."<br>";
*/

if (!$types == null) {
  if(!$start == '') {
    $SQL = 'SELECT idx, date_format(wdate, "%Y/%m/%d") as wdate, comname, tel, homepage, room FROM tb_hu WHERE ' .$types. ' LIKE "%' .$search. '%" AND wdate BETWEEN "' .$start. '" AND "' .$end. '" ORDER BY comname';
    // echo $SQL."1";
    // exit();
    $result = mysqli_query($gconnet, $SQL) or die("Couldn't execute query.".mysqli_error($gconnet));
    $i=0;
    while($row = mysqli_fetch_array($result)){
      
      $responce->rows[$i]['id'] = $row['idx'];
      $responce->rows[$i]['cell']=array($row['idx'], $i, $row['wdate'], $row['comname'], $row['tel'], $row['homepage'], $row['room']);
      $i++;
    }
  } else {
    $SQL = 'SELECT idx, date_format(wdate, "%Y/%m/%d") as wdate, comname, tel, homepage, room FROM tb_hu WHERE ' .$types. ' LIKE "%' .$search. '%" ORDER BY comname';
    // echo $SQL."2";
    // exit();
    $result = mysqli_query($gconnet, $SQL) or die("Couldn't execute query.".mysqli_error($gconnet));
    $i=0;
    while($row = mysqli_fetch_array($result)){
        
      $responce->rows[$i]['id'] = $row['idx'];
      $responce->rows[$i]['cell']=array($row['idx'], $i, $row['wdate'], $row['comname'], $row['tel'], $row['homepage'], $row['room']);
      $i++;
    }
  }
  $SQL = 'SELECT idx, date_format(wdate, "%Y/%m/%d") as wdate, comname, tel, homepage, room FROM tb_hu WHERE ' .$types. ' LIKE "%' .$search. '%" AND wdate BETWEEN "' .$start. '" AND "' .$end. '" ORDER BY comname';
  // echo $SQL."3";
  // exit();
  $result = mysqli_query($gconnet, $SQL) or die("Couldn't execute query.".mysqli_error($gconnet));
  $i=0;
  while($row = mysqli_fetch_array($result)){
      
    $responce->rows[$i]['id'] = $row['idx'];
    $responce->rows[$i]['cell']=array($row['idx'], $i, $row['wdate'], $row['comname'], $row['tel'], $row['homepage'], $row['room']);
    $i++;
  }

} else {
  
  $SQL = 'SELECT idx, date_format(wdate, "%Y/%m/%d") as wdate, comname, tel, homepage, room FROM tb_hu ORDER BY comname';
  // echo $SQL."4";
  // exit();
  $result = mysqli_query($gconnet, $SQL) or die("Couldn't execute query.".mysqli_error($gconnet));
  $i=0;
  while($row = mysqli_fetch_array($result)){
      
    $responce->rows[$i]['id'] = $row['idx'];
    $responce->rows[$i]['cell']=array($row['idx'], $i, $row['wdate'], $row['comname'], $row['tel'], $row['homepage'], $row['room']);
    $i++;
  }
}


										
echo json_encode($responce, JSON_UNESCAPED_UNICODE);
// header('Location: room-sample.php/start='$start'&end='$end'&types='$types'&search='$search'');
?>