<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login_frame.php"; // 관리자 로그인여부 확인?>
<?php
$idx = $_POST['idx'];

$imageKind = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png', 'image/gif', 'image/GIF');
//$dir = "./imgs/";
$dir = $_SERVER["DOCUMENT_ROOT"].'/upload_file/hu/';  // 업로드 할 위치 

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

for($i=0; $i<$_POST['image_count']; $i++) {
    $j = $i +1;
    
	
	$image_id = "image_".$i;
	$fname = explode('.',$_FILES[$image_id]['name']);

    $image_file = $uploaddir.$fname[0].'_'.$string.GenerateString(3).time().'.'.$fname[1];

    $lo = "/upload_file/hu/".$image_file;

	if(isset($_FILES[$image_id]) && !$_FILES[$image_id]['error']) {
		if(in_array($_FILES[$image_id]['type'], $imageKind)) {
			if(move_uploaded_file($_FILES[$image_id]['tmp_name'], $dir.$image_file)) {
				echo "Success Upload Image <br/>";

                $query_file = " insert into tb_huFile set "; 
                $query_file .= " idx = '".$idx."', ";
                $query_file .= " flag = 'intro', ";
                $query_file .= " seq = '".$j."', ";
                $query_file .= " file = '".$lo."' ";

                $result_file = mysqli_query($gconnet,$query_file);

			} else {
				echo "Error Upload Image <br/>";
			}
		} else {
			echo "Not Image Type <br/>";
		}
	} else {
		echo "Image Upload Fail <br/>";
	}

}


?>