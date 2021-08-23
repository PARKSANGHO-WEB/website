<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
</head>
<body>
<?
    $filedate = date("Ymd");
    header( "Content-type: application/vnd.ms-excel; charset=utf-8" );
    header( "Content-Disposition: attachment; filename=excelData_$filedate.xls" );

    try {   
  
        $docName  = "";
        $data = trim(sqlfilter($_REQUEST['csvBuffer']));
        $fileName = trim(sqlfilter($_REQUEST['fileName']))."_".$filedate;

        echo $_REQUEST['csvBuffer'];
    } catch (Exception $e ) {

    }    

?>
</body>
</html>