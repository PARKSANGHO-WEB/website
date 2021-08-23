<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/check_login.php"; // 로그인 여부 체크 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/PHPExcel-1.8/Classes/PHPExcel.php";  ?>
<?

$mode   = trim(sqlfilter($_REQUEST['mode']));
$midx   = trim(sqlfilter($_REQUEST['midx']));
$seq   = trim(sqlfilter($_REQUEST['seq']));

$resJSON = array("success"=>"false", "msg"=>"", "dataList" => "");
$message = "";
$result  = "false";


/*탈락자 업로드, 예약자 업로드 */
if($mode == "EXCEL_DROPOUT" || $mode == "EXCEL_WINNER"){

    $full_filename = explode(".", $_FILES['file']['name'] );
	$extension = $full_filename[sizeof($full_filename)-1];

    if ($extension == "xls" ||  $extension == "xlsx"){

        if($_FILES['file']['size'] > 0){

            $objPHPExcel = new PHPExcel();

            $file_name = "";
            $upload_dir = $_P_DIR_FILE.'excel_upload/';

            $fileResult = uploadFileUniq( 'file', $upload_dir);
            if($fileResult["success"] == "false"){
                $message = $fileResult["msg"];
            }else{
                $file_name = $fileResult["file_name"];
            }

            $uploadfile = $upload_dir.$file_name; // 읽어들일 엑셀 파일의 경로와 파일명

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
                $dataList = [];

                if($mode == "EXCEL_DROPOUT"){
                    $rowData = array("idx" =>"", "sano" =>"", "chasu" =>"");
                    for ($i = 2 ; $i <= $maxRow ; $i++) {
                        $rowData["idx"] = $i-1;
                        $rowData["sano"] = $objWorksheet->getCell('A' . $i)->getValue(); // A열
                        $rowData["chasu"] = $objWorksheet->getCell('B' . $i)->getValue(); // B열

                        array_push($dataList, $rowData);
                    }
                } else if( $mode == "EXCEL_WINNER" ){

                    $rowData = array("idx" =>"", "sano" =>"", "digit7" =>"", "chasu" =>"");
                    for ($i = 2 ; $i <= $maxRow ; $i++) {
                        $rowData["idx"] = $i-1;
                        $rowData["sano"] = $objWorksheet->getCell('A' . $i)->getValue(); // A열
                        $rowData["digit7"] = $objWorksheet->getCell('B' . $i)->getValue(); // B열
                        $rowData["chasu"] = $objWorksheet->getCell('C' . $i)->getValue(); // B열

                        array_push($dataList, $rowData);
                    }
                }

                $result = "true";
                $resJSON["dataList"] = $dataList;

            }
            catch (exception $e) {

                $message = '엑셀파일을 읽는도중 오류가 발생하였습니다.'.$e;

            }
        }else {
            $message = "업로드 한 파일 내용이 없습니다.";    
        }

    }else{
        $message = "엑셀(xls, xlsx)파일을 업로드 하십시오.";
    }
  
    
}else if($mode == "DROPOUT" || $mode == "WINNER" ){
/* 선택 탈락, 선택 당첨 처리 */

    $sano = trim(sqlfilter($_REQUEST['sano']));
    $sanoList = explode(",", $sano);

    $ridx = trim(sqlfilter($_REQUEST['ridx']));
    $ridxList = explode(",", $ridx);

    $regflag = "";
    if($mode == "DROPOUT" ){
        $regflag = "9";
    }else if($mode == "WINNER" ){
        $regflag = "5";
    }

    $resultCnt = 0;
    if($ridx != "" ){

        for($i=0; $i< count($ridxList); $i++){

            $query = " UPDATE tb_reInfo SET regflag = '{$regflag}', udate = now() WHERE ridx = '{$ridxList[$i]}' ";
            

            $resultQuery = mysqli_query($gconnet,$query);
            $resultCnt += $resultQuery;
        }

    }else if($sano != ""){

        for($i=0; $i< count($sanoList); $i++){

            $query = " UPDATE tb_reInfo SET regflag = '{$regflag}', udate = now() WHERE midx = $midx AND seq = $seq AND sano = '{$sanoList[$i]}' ";

            $resultQuery = mysqli_query($gconnet,$query);
            $resultCnt += $resultQuery;
        }
    }

    if($resultCnt > 0){
        $result = "true";
        $message = "처리 되었습니다.";
    }


}else if($mode == "DIGIT7" ){

    $sano = trim(sqlfilter($_REQUEST['sano']));
    $sanoList = explode(",", $sano);


    for($i=0; $i< count($sanoList); $i++){

        $data = explode(":",$sanoList[$i] );

        $chasu = $data[2];

        if($chasu == '선착순'){
            $chasu = '0';
        }

        $query = " UPDATE tb_reInfo SET regflag = '5', digit7= '{$data[1]}' , udate = now() WHERE midx = $midx AND seq = $seq AND sano = '{$data[0]}' AND chasu = '{$chasu}' AND regflag = '5' ";

        $resultQuery = mysqli_query($gconnet,$query);
        $resultCnt += $resultQuery;
    }    

    if($resultCnt > 0){
        $result = "true";
        $message = "처리 되었습니다.";
    }    

}else if($mode == "DIGIT8" ){

    $sano = trim(sqlfilter($_REQUEST['sano']));
    $sanoList = explode(",", $sano);


    for($i=0; $i< count($sanoList); $i++){

        $data = explode(":",$sanoList[$i] );

        $chasu = $data[1];

        if($chasu == '선착순'){
            $chasu = '0';
        }

        $query = " UPDATE tb_reInfo SET regflag = '9' , udate = now() WHERE midx = $midx AND seq = $seq AND sano = '{$data[0]}' AND chasu = '{$chasu}' ";

        $resultQuery = mysqli_query($gconnet,$query);
        $resultCnt += $resultQuery;
    }    

    if($resultCnt > 0){
        $result = "true";
        $message = "처리 되었습니다.";
    }    

}

$resJSON["success"] = $result;
$resJSON["msg"] = $message;

echo json_encode($resJSON, JSON_UNESCAPED_UNICODE);
exit;


?>