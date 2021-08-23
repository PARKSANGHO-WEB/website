<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?php

$flag = trim(sqlfilter($_REQUEST['flag']));

$storeFolder = $_P_DIR_FILE.'huCon/'.$flag.'/';

if(!file_exists($storeFolder) && !is_dir($storeFolder)) {
    mkdir($storeFolder);
}
  
$output = '';  
// upload files to $storeFolder
if (!empty($_FILES)) {
    
    try{
        $tempFile = $_FILES['file']['tmp_name'];
        $targetFile =  $storeFolder.date("YmdHis").'_'.$_FILES['file']['name'];
        move_uploaded_file($tempFile,$targetFile);

        
    }catch(Exception $e){
        $output .= "err=".$e;
    }
        
    $output .= str_replace("/home/ubuntu/webapp","",$targetFile);

}

echo $output;
?>
