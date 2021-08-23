<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login_frame.php"; // 관리자 로그인여부 확인?>

<?php
$bkind = trim(sqlfilter($_REQUEST['id2']));
if($bkind == ''){
    error_frame_go('기업을 선택 해주세요.','company-people.php');
}

$string = preg_replace("/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", "", date("Y-m-d H:i:s"));

$sql_pre2 = " select max from tb_employee_excel where 1=1 order by seq desc limit 0,1"; 
$result_pre2  = mysqli_query($gconnet,$sql_pre2);
$mem_row2 = mysqli_fetch_array($result_pre2);
$max = $mem_row2[max]; 

if($max){
    $max = $max +1;
}else{
    $max = 1;
}

function GenerateString($length)  
{  
    $characters  = "0123456789";  
    $characters .= "abcdefghijklmnopqrstuvwxyz";  
    $characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";  
    $characters .= "_";  
      
    $string_generated = "";  
      
    $nmr_loops = $length;  
    while ($nmr_loops--)  
    {  
        $string_generated .= $characters[mt_rand(0, strlen($characters) - 1)];  
    }  
      
    return $string_generated;  
}  


include "../../PHPExcel-1.8/Classes/PHPExcel.php";

$objPHPExcel = new PHPExcel();

require_once "../../PHPExcel-1.8/Classes/PHPExcel.php"; // IOFactory.php을 불러와야 하며, 경로는 사용자의 설정에 맞게 수정해야 한다.

$uploaddir = $_SERVER["DOCUMENT_ROOT"].'/upload_file/data/';  // 업로드 할 위치 

$fname = explode('.',$_FILES['excelFile']['name']);

$uploadfile = $uploaddir.$fname[0].'_'.$string.GenerateString(3).time().'.'.$fname[1];



echo '<pre>';

echo 'output:'.basename($_FILES['excelFile']['tmp_name']);

if(move_uploaded_file($_FILES['excelFile']['tmp_name'], $uploadfile)) {

  echo '<br>good file<br>';

}else{

  print '<br>avoid attack!<br>';

}

echo 'detail debug :';

print_r($_FILES);

print "</pre>";

// $filename = './testA.xlsx'; // 읽어들일 엑셀 파일의 경로와 파일명을 지정한다.

$filename = $_FILES['excelFile']['tmp_name']; // 읽어들일 엑셀 파일의 경로와 파일명을 지정한다.

try {

  // 업로드 된 엑셀 형식에 맞는 Reader객체를 만든다.

    $objReader = PHPExcel_IOFactory::createReaderForFile($uploadfile);
    
    // 읽기전용으로 설정

    $objReader->setReadDataOnly(true);

    // 엑셀파일을 읽는다

    $objExcel = $objReader->load($uploadfile);

    // 첫번째 시트를 선택

    $objExcel->setActiveSheetIndex(0);

    $objWorksheet = $objExcel->getActiveSheet();

    $rowIterator = $objWorksheet->getRowIterator();
    
    
    foreach ($rowIterator as $row) { // 모든 행에 대해서

               $cellIterator = $row->getCellIterator();

               $cellIterator->setIterateOnlyExistingCells(false);

    }

    $maxRow = $objWorksheet->getHighestRow();
	$arr = [];


    for ($i = 2 ; $i <= $maxRow ; $i++) {

               $name = $objWorksheet->getCell('A' . $i)->getValue(); // A열

               $addr1 = $objWorksheet->getCell('B' . $i)->getValue(); // B열

               $addr2 = $objWorksheet->getCell('C' . $i)->getValue(); // C열

               $addr3 = $objWorksheet->getCell('D' . $i)->getValue(); // D열

               $addr4 = $objWorksheet->getCell('E' . $i)->getValue(); // E열

/*			   $addr5 = $objWorksheet->getCell('F' . $i)->getValue(); // E열

			   $addr6 = $objWorksheet->getCell('G' . $i)->getValue(); // E열

			   $addr7 = $objWorksheet->getCell('H' . $i)->getValue(); // E열

			   $addr8 = $objWorksheet->getCell('I' . $i)->getValue(); // E열

               $reg_date = $objWorksheet->getCell('J' . $i)->getValue(); // F열

               $reg_date = PHPExcel_Style_NumberFormat::toFormattedString($reg_date, 'YYYY-MM-DD'); // 날짜 형태의 셀을 읽을때는 toFormattedString를 사용한다.

			   $addr9 = $objWorksheet->getCell('K' . $i)->getValue(); // E열*/

			   $arr = array($name,$addr1,$addr2,$addr3,$addr4);

			   //$arr = array(addslashes($name));

		  echo "<pre>";
		  var_dump($arr);
		  echo "</pre>";

		  if(!empty($name)){
			  $qry = "insert into tb_employee(name,team,class,digit7,sano,wdate,cdx) values ('".$name."','".$addr1."','".$addr2."','".$addr3."','".$addr4."',now(),'".$bkind."')";
				$res = $gconnet->query($qry);
		  }

      }

      error_frame_go('업로드 되었습니다.','company-people.php');

}

 catch (exception $e) {

    echo '엑셀파일을 읽는도중 오류가 발생하였습니다.';

}
?>