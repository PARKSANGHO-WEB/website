<?
/***************************************************************************
 * 여러번 호출시 에러 발생 금지
 **************************************************************************/
if($_user_function_php_excuted) return;
$_user_function_php_excuted = true;

//function print_title_image($cfg) {
//   $img_title = $form."_".$cfg.".gif";
//   echo("<center><img src=\"$img_title\" border=0></center><p>");
//}

function uploadFile($HTTP_POST_FILES, $el_name, $el, $_P_DIR_FILE, $filename_org=""){

	if ($_FILES[$el_name]['name']){
		//echo "11"; exit;
		//$file_name = rawurlencode($_FILES[$el_name][name]);
		$file_name = $_FILES[$el_name][name];
		//echo $file_name; exit;
		$full_filename = explode(".", "$file_name");
		$extension = $full_filename[sizeof($full_filename)-1];
		//echo $extension; exit;
		########## 등록한 파일이 업로드가 허용되지 않는 확장자를 갖는 파일인지를 검사한다. ##########
		if(!strcmp($extension,"html") || !strcmp($extension,"htm") || !strcmp($extension,"cgi") ||
			!strcmp($extension,"php") || !strcmp($extension,"php3") || !strcmp($extension,"pl") ||
			!strcmp($extension,"php4") || !strcmp($extension, "inc")|| !strcmp($extension, "php5")){
			error_frame("HTML 파일은 보안상 업로드하실 수 없습니다. ");
			exit;
		}

		$imsi_filename = str_replace($file_name,randomChar(5),$file_name).".".$extension; // 한글명일때를 대비하여 파일명을 교체한다.
		$file_name = time()."-".$imsi_filename;

		if(!is_dir($_P_DIR_FILE)){
		mkdir($_P_DIR_FILE, 0777); 
		chmod($_P_DIR_FILE, 0777);
		}

		$toName = $_P_DIR_FILE.$file_name;
		$fromName = $_FILES[$el_name]['tmp_name'];
		if(!move_uploaded_file($fromName,$toName)) {
		error_frame("UPLOAD_COPY_FAILURE");
		exit;
		}
		
		########## 신규파일 업로드시 기존 파일은 삭제... ##########
		if($file_name && $filename_org){
			unlink($_P_DIR_FILE.$filename_org);
		}
		return $file_name;
	}
	return "";
	
}


function uploadFileThumb_1($HTTP_POST_FILES, $el_name, $el, $_P_DIR_FILE, $i_width="", $i_height="", $i_width2="", $i_height2="",$i_width3="", $i_height3="",$watermark_sect=""){

	//return uploadFile($HTTP_POST_FILES, $el_name, $el, $_P_DIR_FILE);
	
	if ($_FILES[$el_name]['size']>0){
		//echo "11"; exit;
		//$file_name = rawurlencode($_FILES[$el_name][name]);
		$file_name = $_FILES[$el_name][name];
		//echo $file_name; exit;
		$full_filename = explode(".", "$file_name");
		$extension = $full_filename[sizeof($full_filename)-1];
		//echo $extension; exit;
		########## 등록한 파일이 업로드가 허용되지 않는 확장자를 갖는 파일인지를 검사한다. ##########
		if(!strcmp($extension,"html") || !strcmp($extension,"htm") || !strcmp($extension,"cgi") ||
			!strcmp($extension,"php") || !strcmp($extension,"php3") || !strcmp($extension,"pl") ||
			!strcmp($extension,"php4") || !strcmp($extension, "inc")|| !strcmp($extension, "php5")){
			error_frame("HTML 파일은 보안상 업로드하실 수 없습니다. ");
			exit;
		}

		$imsi_filename = str_replace($file_name,randomChar(5),$file_name).".".$extension; // 한글명일때를 대비하여 파일명을 교체한다.
		$file_name = time()."-".$imsi_filename;
		
		if(!is_dir($_P_DIR_FILE)){
		mkdir($_P_DIR_FILE, 0777); 
		chmod($_P_DIR_FILE, 0777);
		}

		if($i_width){
		$_P_DIR_FILE_thm1 = $_P_DIR_FILE."img_thumb"."/";
			if(!is_dir($_P_DIR_FILE_thm1)){
			mkdir($_P_DIR_FILE_thm1, 0777); 
			chmod($_P_DIR_FILE_thm1, 0777);
			}
		}

		if($i_width2){
		$_P_DIR_FILE_thm2 = $_P_DIR_FILE."img_thumb2"."/";
			if(!is_dir($_P_DIR_FILE_thm2)){
			mkdir($_P_DIR_FILE_thm2, 0777); 
			chmod($_P_DIR_FILE_thm2, 0777);
			}
		}

		if($i_width3){
		$_P_DIR_FILE_thm3 = $_P_DIR_FILE."img_thumb3"."/";
			if(!is_dir($_P_DIR_FILE_thm3)){
			mkdir($_P_DIR_FILE_thm3, 0777); 
			chmod($_P_DIR_FILE_thm3, 0777);
			}
		}

		$toName = $_P_DIR_FILE.$file_name;
		$fromName = $_FILES[$el_name]['tmp_name'];
		if(!move_uploaded_file($fromName,$toName)) {
		error("UPLOAD_COPY_FAILURE");
		exit;
	}

		##########  썸내일 만드는소스 ##########
		// 이미지타입 구분(gif, jpg, png 만 가능)
		$thumbS_width = $i_width; $thumbS_height = $i_height; // 스몰섬네일 크기
		$thumbS_width2 = $i_width2; $thumbS_height2 = $i_height2; // 스몰섬네일 크기
		$thumbS_width3 = $i_width3; $thumbS_height3 = $i_height3; // 스몰섬네일 크기
		$dest_file = $_P_DIR_FILE.$file_name;
		$upfile_path = $_P_DIR_FILE;
/*
echo $dest_file;
echo "<br>";
echo $upfile_path;
echo "<br>";
exit;
*/

		if(!$i_height){
			$w = 1024; 
			$h = 900; 

			$w_rate = round(($w/$i_width),2); 
			$i_height = round(($h/$w_rate),0); 

		}
		
		if(img_type($dest_file)) {
			$srcimg = $file_name;
			$dstimg = $file_name;

			// 워터마크 이미지 생성시작 
			if($watermark_sect == "text"){ // 텍스트형 워터마크 
				
				$font_size = 18; // 글자 크기 
				$opacity = 70; // 투명도 높을수록 불투명 
				$font_path = $_SERVER["DOCUMENT_ROOT"]."/pro_inc/H2HDRM.TTF";  //폰트 패스 
				$string = "PoleStar";  // 찍을 워터마크 

				$image = $dest_file; // 업로드된, 워터마크가 없는 파일.
				$image_f_name = $file_name;
				$image_name = explode(".",$image_f_name); 
				
				$image_targ1 = explode("-",$image_name[0]);

				$image_targ = $_P_DIR_FILE.$image_targ1[1]."_marke_".$image_targ1[0].".".$image_name[1];  // 워터마크가 찍혀 저장될 이미지 

				$image_org = $image; // 원본 이미지를 다른 이름으로 저장 
				
				//$image = imagecreatefromjpeg($image); // JPG 이미지를 읽고 

				if($image_name[1] == "gif" || $image_name[1] == "GIF")  $image = imagecreatefromgif($image);  
				if($image_name[1] == "jpg" || $image_name[1] == "jpeg" || $image_name[1] == "JPG" || $image_name[1] == "JPEG")  $image = imagecreatefromjpeg($image);  
				if($image_name[1] == "png" || $image_name[1] == "PNG")  $image = imagecreatefrompng($image);  
				
				$w = imagesx($image); 
				$h = imagesy($image);  

				$text_color = imagecolorallocate($image,255,255,255); // 텍스트 컬러 지정 

				// 적당히 워터마크가 붙을 위치를 지정 
				$text_pos_x = $font_size; 
				$text_pos_y = $h - $font_size; 

				imagettftext($image, $font_size, 0, $text_pos_x, $text_pos_y, $text_color, $font_path, $string);  // 읽은 이미지에 워터마크를 찍고 

				$image_org = imagecreatefromjpeg($image_org); // 원본 이미지를 다시한번 읽고 
  
				imagecopymerge($image,$image_org,0,0,0,0,$w,$h,$opacity); // 원본과 워터마크를 찍은 이미지를 적당한 투명도로 겹치기 
				imagejpeg($image, $image_targ, 90); // 이미지 저장. 해상도는 90 정도 

				//echo "<img src='$image'><br><br>";
				//echo "<img src='$image_targ'><br><br>";
  
				imagedestroy($image); 
				imagedestroy($image_org); 

			} elseif($watermark_sect == "imgw"){ // 이미지합성 워터마크

				if (isset($_GET['transparency'])) {
					if ($_GET['transparency'] >= 0 && $_GET['transparency'] <= 100) {
						$transparency = (int) $_GET['transparency'];
					}
				} else {
					$transparency = 40;
				}
				
				$source_photo = $dest_file;   // 업로드된, 워터마크가 없는 파일.
				//$source_photo = "/www/upload_file/pro_pic/".$file_name; 

				$image_f_name = $file_name;
				$image_name = explode(".",$image_f_name); 
				$image_targ1 = explode("-",$image_name[0]);
				
				//echo "<br><br>".$image_targ1[0]." : ".$image_targ1[1]."<br><br>";

				$image_targ = $_P_DIR_FILE.$image_targ1[1]."_marke_".$image_targ1[0].".".$image_name[1];  // 워터마크가 찍혀 저장될 이미지 
				//$image_targ = $image_targ1[1]."_marke_".$image_targ1[0].".jpg";  // 워터마크가 찍혀 저장될 이미지 
				$image_targ_name = $image_targ1[1]."_marke_".$image_targ1[0].".".$image_name[1];

				$filetype = substr($source_photo,strlen($source_photo)-4,4); 
				$filetype = strtolower($filetype);


				if($filetype == ".gif" || $filetype == ".GIF")  $photo = imagecreatefromgif($source_photo);  
				if($filetype == ".jpg" || $filetype == ".jpeg" || $filetype == ".JPG" || $filetype == ".JPEG")  $photo = imagecreatefromjpeg($source_photo);  
				if($filetype == ".png" || $filetype == ".PNG")  $photo = imagecreatefrompng($source_photo);  

				if (!$photo) echo "원본파일 없음."; 
				$watermark = imagecreatefrompng($_SERVER["DOCUMENT_ROOT"].'/pro_inc/watermark.png');
				$watermark_width = imagesx($watermark);
				$watermark_height = imagesy($watermark);

				//location of the watermark on the source image
				$size = getimagesize($source_photo);
				$dest_x = ($size[0] - $watermark_width) / 2;
				$dest_y = ($size[1] - $watermark_height) / 2;

				//make the image (merge source image with watermark)
				imagecopymerge($photo, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, $transparency);
				//output the image
				//imagejpeg($photo);
				imagejpeg($photo, $image_targ, 90); // 이미지 저장. 해상도는 90 정도 
				
				/*echo "<img src='/upload_file/pro_pic/$file_name'><br><br>";
				echo "<img src='/pro_inc/watermark.png'><br><br>";
				echo "<img src='/upload_file/pro_pic/$image_targ_name'><br><br>";*/

				//free memory
				imagedestroy($photo);

			}
			//워터마크 이미지 생성 종료 

			// 이미지 썸내일 생성
			
				img_resize($srcimg, $dstimg, $upfile_path, $i_width,$i_height,$watermark_sect); // 크기에 맞춰 비율대로 사이즈를 줄인다

				/*$img_size = array($i_width,$i_height,$i_width,$i_height,$i_width);
				$img_size2 = array($i_width2,$i_height2,$i_width2,$i_height2,$i_width2);
				$outlinecolor = "ffffff";
				thumbnail3($srcimg, $dstimg, $upfile_path, $img_size, $outlinecolor,$watermark_sect); // 크기에 맞춰 이미지를 자른다*/
			
			if($i_width2){	
				
				//thumbnail3_1($srcimg, $dstimg, $upfile_path, $img_size2, $outlinecolor,$watermark_sect);  // 크기에 맞춰 이미지를 자른다

				img_resize_1($srcimg, $dstimg, $upfile_path, $i_width2,$i_height2,"img_thumb2",$watermark_sect);  // 크기에 맞춰 비율대로 사이즈를 줄인다 
			}

			if($i_width3){	
				
				//thumbnail3_1($srcimg, $dstimg, $upfile_path, $img_size2, $outlinecolor,$watermark_sect);  // 크기에 맞춰 이미지를 자른다

				img_resize_1($srcimg, $dstimg, $upfile_path, $i_width3,$i_height3,"img_thumb3",$watermark_sect);  // 크기에 맞춰 비율대로 사이즈를 줄인다 
			}
		} else {
			//echo "<script>alert('이미지가등록되지 않았습니다.')</script>";
			unlink($dest_file);
			return "";
		}
		return $file_name;
	}
	return "";
	
}


function uploadFileThumb_2($HTTP_POST_FILES, $el_name, $el, $_P_DIR_FILE,$i_width1,$i_height1,$i_width2,$i_height2){

	//return uploadFile($HTTP_POST_FILES, $el_name, $el, $_P_DIR_FILE);

	if ($_FILES[$el_name]['size']>0){
		//echo "11"; exit;
		//$file_name = rawurlencode($_FILES[$el_name][name]);
		$file_name = $_FILES[$el_name][name];
		//echo $file_name; exit;
		$full_filename = explode(".", "$file_name");
		$extension = $full_filename[sizeof($full_filename)-1];
		//echo $extension; exit;
		########## 등록한 파일이 업로드가 허용되지 않는 확장자를 갖는 파일인지를 검사한다. ##########
		if(!strcmp($extension,"html") || !strcmp($extension,"htm") || !strcmp($extension,"cgi") ||
			!strcmp($extension,"php") || !strcmp($extension,"php3") || !strcmp($extension,"pl") ||
			!strcmp($extension,"php4") || !strcmp($extension, "inc")|| !strcmp($extension, "php5")){
			error_frame("HTML 파일은 보안상 업로드하실 수 없습니다. ");
			exit;
		}

		$imsi_filename = str_replace($file_name,randomChar(5),$file_name).".".$extension; // 한글명일때를 대비하여 파일명을 교체한다.
		$file_name = time()."-".$imsi_filename;
		
		if(!is_dir($_P_DIR_FILE)) mkdir($_P_DIR_FILE, 0777); 
		chmod($_P_DIR_FILE, 0777);

		$toName = $_P_DIR_FILE.$file_name;
		$fromName = $_FILES[$el_name]['tmp_name'];
		if(!move_uploaded_file($fromName,$toName)) {
		error("UPLOAD_COPY_FAILURE");
		exit;
	}

		##########  썸내일 만드는소스 ##########
		// 이미지타입 구분(gif, jpg, png 만 가능)
		$thumbS_width = $i_width1; $thumbS_height = $i_height1; // 스몰섬네일 크기
		$dest_file = $_P_DIR_FILE.$file_name;
		$upfile_path = $_P_DIR_FILE;

//echo $dest_file;
//echo "<br>";
//echo $upfile_path;
//echo "<br>";

		if(img_type($dest_file)) {
			$srcimg = $file_name;
			$dstimg = $i_width1."_".$file_name;
			// 이미지 썸내일 생성
			img_resize($srcimg, $dstimg, $upfile_path, $thumbS_width, $thumbS_height);
		} else {
			//echo "<script>alert('이미지가등록되지 않았습니다.')</script>";
			unlink($dest_file);
			return "";
		}

		##########  썸내일 만드는소스 ##########
		// 이미지타입 구분(gif, jpg, png 만 가능)
		$thumbS_width = $i_width2; $thumbS_height = $i_height2; // 미들섬네일 크기
		$dest_file = $_P_DIR_FILE.$file_name;
		$upfile_path = $_P_DIR_FILE;

//echo $dest_file;
//echo "<br>";
//echo $upfile_path;
//echo "<br>";

		if(img_type($dest_file)) {
			$srcimg = $file_name;
			$dstimg = $i_width2."_".$file_name;
			// 이미지 썸내일 생성
			img_resize($srcimg, $dstimg, $upfile_path, $thumbS_width, $thumbS_height);
		} else {
			//echo "<script>alert('이미지가등록되지 않았습니다.')</script>";
			unlink($dest_file);
			return "";
		}

		return $file_name;
	}
	return "";
	
}

/* ============================================================================
Return :
Comment: 썸내일 대상파일이 이미지인지 체크
Usage :
------------------------------------------------------------------------------*/
function img_type( $srcimg ) {

	//echo "<br>";
	//echo "srcimg : ".$srcimg;
	//echo "<br>";
	//$image_info = @getimagesize($srcimg);
	//echo "<br>";
	//echo "mine1 : ".$image_info['mime'];

	if(is_file($srcimg)) {
		$image_info = @getimagesize($srcimg);

		switch ($image_info['mime']) {
			case 'image/gif': return true; break;
			case 'image/jpeg': return true; break;
			case 'image/png': return true; break;
			//case 'image/bmp': return true; break;
			default : return false; break;
		}
	} else {
		return false;
	}
}
 
/* ============================================================================
Return :
Comment: 비율대비 이미지 섬네일
Usage :
------------------------------------------------------------------------------*/
function img_resize( $srcimg, $dstimg, $imgpath, $rewidth, $reheight,$watermark_sect ) {

	$src_info = getimagesize("$imgpath$srcimg");

    if($_SERVER['REMOTE_ADDR'] == "121.167.147.150" || $_SERVER['REMOTE_ADDR'] == "211.36.159.149"){
        /*echo $imgpath."<br>";
        echo $srcimg."<br>";
        echo "가로 = ".$src_info[0]."<br>";
        echo "세로 = ".$src_info[1]."<br>";
        echo $imgpath."img_thumb/"; 
        exit;*/
    }

	if($rewidth < $src_info[0] || $reheight < $src_info[1]) {
		if(($src_info[0] - $rewidth) > ($src_info[1] - $reheight)) {
			$reheight = round(($src_info[1]*$rewidth)/$src_info[0]);
		} else {
			$rewidth = round(($src_info[0]*$reheight)/$src_info[1]);
		}
	} else {
		//exec("cp $imgpath/$srcimg $imgpath/$dstimg");
		//copy($imgpath/$srcimg, $imgpath/$dstimg);
        if (!copy($imgpath.$srcimg, $imgpath."/img_thumb/".$dstimg)) {
			echo "failed to copy $imgpath$srcimg...\n";
		}
		return;
	}

	$dst = imageCreatetrueColor($rewidth, $reheight);

	if($src_info[2] == 1) {
		$src = ImageCreateFromGIF("$imgpath$srcimg");

		imagecopyResampled($dst, $src,0,0,0,0,$rewidth,$reheight,ImageSX($src),ImageSY($src));
		Imagejpeg($dst,"$imgpath/img_thumb/$dstimg",100);
	} elseif($src_info[2] == 2) {
		$src = ImageCreateFromJPEG("$imgpath$srcimg");

		imagecopyResampled($dst, $src,0,0,0,0,$rewidth,$reheight,ImageSX($src),ImageSY($src));
		Imagejpeg($dst,"$imgpath/img_thumb/$dstimg",100);
	} elseif($src_info[2] == 3) {
		$src = ImageCreateFromPNG("$imgpath$srcimg");

		imagecopyResampled($dst, $src,0,0,0,0,$rewidth,$reheight,ImageSX($src),ImageSY($src));
		Imagepng($dst,"$imgpath/img_thumb/$dstimg",9);
	}

	// 워터마크 이미지 생성시작 
			if($watermark_sect == "text"){ // 텍스트형 워터마크 
				
				$font_size = 18; // 글자 크기 
				$opacity = 70; // 투명도 높을수록 불투명 
				$font_path = $_SERVER["DOCUMENT_ROOT"]."/pro_inc/H2HDRM.TTF";  //폰트 패스 
				$string = "PoleStar";  // 찍을 워터마크 

				$image = $imgpath."/img_thumb/".$dstimg; // 업로드된, 워터마크가 없는 파일.

				$image_f_name = $dstimg;
				$image_name = explode(".",$image_f_name); 
				$image_targ1 = explode("-",$image_name[0]);

				$image_targ = $imgpath."/img_thumb/".$image_targ1[1]."_marke_".$image_targ1[0].".".$image_name[1];  // 워터마크가 찍혀 저장될 이미지 

				$image_org = $image; // 원본 이미지를 다른 이름으로 저장 
				
				//$image = imagecreatefromjpeg($image); // JPG 이미지를 읽고 

				if($image_name[1] == "gif" || $image_name[1] == "GIF")  $image = imagecreatefromgif($image);  
				if($image_name[1] == "jpg" || $image_name[1] == "jpeg" || $image_name[1] == "JPG" || $image_name[1] == "JPEG")  $image = imagecreatefromjpeg($image);  
				if($image_name[1] == "png" || $image_name[1] == "PNG")  $image = imagecreatefrompng($image);  
				
				$w = imagesx($image); 
				$h = imagesy($image);  

				$text_color = imagecolorallocate($image,255,255,255); // 텍스트 컬러 지정 

				// 적당히 워터마크가 붙을 위치를 지정 
				$text_pos_x = $font_size; 
				$text_pos_y = $h - $font_size; 

				imagettftext($image, $font_size, 0, $text_pos_x, $text_pos_y, $text_color, $font_path, $string);  // 읽은 이미지에 워터마크를 찍고 

				$image_org = imagecreatefromjpeg($image_org); // 원본 이미지를 다시한번 읽고 
  
				imagecopymerge($image,$image_org,0,0,0,0,$w,$h,$opacity); // 원본과 워터마크를 찍은 이미지를 적당한 투명도로 겹치기 
				imagejpeg($image, $image_targ, 90); // 이미지 저장. 해상도는 90 정도 
  
				imagedestroy($image); 
				imagedestroy($image_org); 

			} elseif($watermark_sect == "imgw"){ // 이미지합성 워터마크

				if (isset($_GET['transparency'])) {
					if ($_GET['transparency'] >= 0 && $_GET['transparency'] <= 100) {
						$transparency = (int) $_GET['transparency'];
					}
				} else {
					$transparency = 40;
				}
				
				$source_photo = $imgpath."/img_thumb/".$dstimg;   // 업로드된, 워터마크가 없는 파일.

				$image_f_name = $dstimg;
				$image_name = explode(".",$image_f_name); 
				$image_targ1 = explode("-",$image_name[0]);

				$image_targ = $imgpath."/img_thumb/".$image_targ1[1]."_marke_".$image_targ1[0].".".$image_name[1];  // 워터마크가 찍혀 저장될 이미지 
				$image_targ_name = $image_targ1[1]."_marke_".$image_targ1[0].".".$image_name[1];
				$filetype = substr($source_photo,strlen($source_photo)-4,4); 
				$filetype = strtolower($filetype);


				if($filetype == ".gif" || $filetype == ".GIF")  $photo = imagecreatefromgif($source_photo);  
				if($filetype == ".jpg" || $filetype == ".jpeg" || $filetype == ".JPG" || $filetype == ".JPEG")  $photo = imagecreatefromjpeg($source_photo);  
				if($filetype == ".png" || $filetype == ".PNG")  $photo = imagecreatefrompng($source_photo);  

				//if (!$photo) die(); 
				$watermark = imagecreatefrompng($_SERVER["DOCUMENT_ROOT"].'/pro_inc/watermark.png');
				$watermark_width = imagesx($watermark);
				$watermark_height = imagesy($watermark);

				//location of the watermark on the source image
				$size = getimagesize($source_photo);
				$dest_x = ($size[0] - $watermark_width) / 2;
				$dest_y = ($size[1] - $watermark_height) / 2;

				//make the image (merge source image with watermark)
				imagecopymerge($photo, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, $transparency);

				//output the image
				//imagejpeg($photo);
				imagejpeg($photo, $image_targ, 90); // 이미지 저장. 해상도는 90 정도 
				
				/*echo "<img src='/upload_file/pro_pic/img_thumb/$save_file'><br><br>";
				echo "<img src='/pro_inc/watermark.png'><br><br>";
				echo "<img src='/upload_file/pro_pic/img_thumb/$image_targ_name'><br><br>";*/

				//free memory
				imagedestroy($photo);

			}
			//워터마크 이미지 생성 종료 

	imageDestroy($src);
	imageDestroy($dst);
}

/* ============================================================================
Return :
Comment: 비율대비 이미지 섬네일
Usage :
------------------------------------------------------------------------------*/
function img_resize_1( $srcimg, $dstimg, $imgpath, $rewidth, $reheight,$thumbp="",$watermark_sect ) {

	$src_info = getimagesize("$imgpath$srcimg");

	if(!$thumbp){
		$thumbp = "img_thumb2";
	}

	if($rewidth < $src_info[0] || $reheight < $src_info[1]) {
		if(($src_info[0] - $rewidth) > ($src_info[1] - $reheight)) {
			$reheight = round(($src_info[1]*$rewidth)/$src_info[0]);
		} else {
			$rewidth = round(($src_info[0]*$reheight)/$src_info[1]);
		}
	} else {
		//exec("cp $imgpath/$srcimg $imgpath/$dstimg");
		//copy($imgpath/$srcimg, $imgpath/$dstimg);
		if (!copy($imgpath.$srcimg, $imgpath."/".$thumbp."/".$dstimg)) {
			echo "failed to copy $imgpath$srcimg...\n";
		}
		return;
	}

	$dst = imageCreatetrueColor($rewidth, $reheight);

	if($src_info[2] == 1) {
		$src = ImageCreateFromGIF("$imgpath$srcimg");

		imagecopyResampled($dst, $src,0,0,0,0,$rewidth,$reheight,ImageSX($src),ImageSY($src));
		Imagejpeg($dst,"$imgpath/$thumbp/$dstimg",100);
	} elseif($src_info[2] == 2) {
		$src = ImageCreateFromJPEG("$imgpath$srcimg");

		imagecopyResampled($dst, $src,0,0,0,0,$rewidth,$reheight,ImageSX($src),ImageSY($src));
		Imagejpeg($dst,"$imgpath/$thumbp/$dstimg",100);
	} elseif($src_info[2] == 3) {
		$src = ImageCreateFromPNG("$imgpath$srcimg");

		imagecopyResampled($dst, $src,0,0,0,0,$rewidth,$reheight,ImageSX($src),ImageSY($src));
		Imagepng($dst,"$imgpath/$thumbp/$dstimg",9);
	}

	// 워터마크 이미지 생성시작 
			if($watermark_sect == "text"){ // 텍스트형 워터마크 
				
				$font_size = 18; // 글자 크기 
				$opacity = 70; // 투명도 높을수록 불투명 
				$font_path = $_SERVER["DOCUMENT_ROOT"]."/pro_inc/H2HDRM.TTF";  //폰트 패스 
				$string = "PoleStar";  // 찍을 워터마크 

				$image = $imgpath."/".$thumbp."/".$dstimg; // 업로드된, 워터마크가 없는 파일.

				$image_f_name = $dstimg;
				$image_name = explode(".",$image_f_name); 
				$image_targ1 = explode("-",$image_name[0]);

				$image_targ = $imgpath."/".$thumbp."/".$image_targ1[1]."_marke_".$image_targ1[0].".".$image_name[1];  // 워터마크가 찍혀 저장될 이미지 

				$image_org = $image; // 원본 이미지를 다른 이름으로 저장 
				
				//$image = imagecreatefromjpeg($image); // JPG 이미지를 읽고 

				if($image_name[1] == "gif" || $image_name[1] == "GIF")  $image = imagecreatefromgif($image);  
				if($image_name[1] == "jpg" || $image_name[1] == "jpeg" || $image_name[1] == "JPG" || $image_name[1] == "JPEG")  $image = imagecreatefromjpeg($image);  
				if($image_name[1] == "png" || $image_name[1] == "PNG")  $image = imagecreatefrompng($image);  
				
				$w = imagesx($image); 
				$h = imagesy($image);  

				$text_color = imagecolorallocate($image,255,255,255); // 텍스트 컬러 지정 

				// 적당히 워터마크가 붙을 위치를 지정 
				$text_pos_x = $font_size; 
				$text_pos_y = $h - $font_size; 

				imagettftext($image, $font_size, 0, $text_pos_x, $text_pos_y, $text_color, $font_path, $string);  // 읽은 이미지에 워터마크를 찍고 

				$image_org = imagecreatefromjpeg($image_org); // 원본 이미지를 다시한번 읽고 
  
				imagecopymerge($image,$image_org,0,0,0,0,$w,$h,$opacity); // 원본과 워터마크를 찍은 이미지를 적당한 투명도로 겹치기 
				imagejpeg($image, $image_targ, 90); // 이미지 저장. 해상도는 90 정도 
  
				imagedestroy($image); 
				imagedestroy($image_org); 

			} elseif($watermark_sect == "imgw"){ // 이미지합성 워터마크

				if (isset($_GET['transparency'])) {
					if ($_GET['transparency'] >= 0 && $_GET['transparency'] <= 100) {
						$transparency = (int) $_GET['transparency'];
					}
				} else {
					$transparency = 40;
				}
				
				$source_photo = $imgpath."/".$thumbp."/".$dstimg;   // 업로드된, 워터마크가 없는 파일.

				$image_f_name = $dstimg;
				$image_name = explode(".",$image_f_name); 
				$image_targ1 = explode("-",$image_name[0]);

				$image_targ = $imgpath."/".$thumbp."/".$image_targ1[1]."_marke_".$image_targ1[0].".".$image_name[1];  // 워터마크가 찍혀 저장될 이미지 
				$image_targ_name = $image_targ1[1]."_marke_".$image_targ1[0].".".$image_name[1];
				$filetype = substr($source_photo,strlen($source_photo)-4,4); 
				$filetype = strtolower($filetype);


				if($filetype == ".gif" || $filetype == ".GIF")  $photo = imagecreatefromgif($source_photo);  
				if($filetype == ".jpg" || $filetype == ".jpeg" || $filetype == ".JPG" || $filetype == ".JPEG")  $photo = imagecreatefromjpeg($source_photo);  
				if($filetype == ".png" || $filetype == ".PNG")  $photo = imagecreatefrompng($source_photo);  

				//if (!$photo) die(); 
				$watermark = imagecreatefrompng($_SERVER["DOCUMENT_ROOT"].'/pro_inc/watermark.png');
				$watermark_width = imagesx($watermark);
				$watermark_height = imagesy($watermark);

				//location of the watermark on the source image
				$size = getimagesize($source_photo);
				$dest_x = ($size[0] - $watermark_width) / 2;
				$dest_y = ($size[1] - $watermark_height) / 2;

				//make the image (merge source image with watermark)
				imagecopymerge($photo, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, $transparency);

				//output the image
				//imagejpeg($photo);
				imagejpeg($photo, $image_targ, 90); // 이미지 저장. 해상도는 90 정도 
				
				/*echo "<img src='/upload_file/pro_pic/img_thumb2/$save_file'><br><br>";
				echo "<img src='/pro_inc/watermark.png'><br><br>";
				echo "<img src='/upload_file/pro_pic/img_thumb2/$image_targ_name'><br><br>";*/

				//free memory
				imagedestroy($photo);

			}
			//워터마크 이미지 생성 종료 

	imageDestroy($src);
	imageDestroy($dst);
}

/* ============================================================================
Return :
Comment: 사이즈조정 섬네일
Usage :
------------------------------------------------------------------------------*/

function thumbnail3($file, $save_file, $upfile_path, $img_size, $outlinecolor,$watermark_sect){ 
     
    $img_info = getImageSize($upfile_path.$file); 
    if($img_info[2] == 1){ $src_img = ImageCreateFromGif($upfile_path.$file); 
    }elseif($img_info[2] == 2){ $src_img = ImageCreateFromJPEG($upfile_path.$file); 
    }elseif($img_info[2] == 3){ $src_img = ImageCreateFromPNG($upfile_path.$file); 
    }else{ return 0; } 
    $img_width = $img_info[0]; 
    $img_height = $img_info[1]; 
	
	/*echo $upfile_path.$file."<br>";
	echo $img_width."<br>";
	echo $img_height."<br>";
	echo $img_size."<br>";
	echo $img_size[0]."<br>";
	echo $img_size[1]."<br>";
	echo $img_size[2]."<br>";
	echo $img_size[3]."<br>";
	echo $img_size[4]."<br>";*/

	//echo $img_size[0]; exit;
    if($img_width > $img_height){ #가로가 큰 이미지 
        $max_width=$img_size[0]; $max_height=$img_size[1]; 
        $zoom=$img_height/$max_height; 
        $xpos=($img_width-($zoom*$max_width))/2; 
        $ypos=0; 
    } elseif($img_width < $img_height) { # 세로가 큰 이미지 
        $max_width=$img_size[2]; $max_height=$img_size[3]; 
        $zoom=$img_width/$max_width; 
        $xpos=0; 
        $ypos=($img_height-($zoom*$max_height))/2;         
    } else { # 정사각형 이미지 
        $max_width=$img_size[4]; $max_height=$img_size[4]; 
        $zoom=$img_width/$max_width; 
        $xpos=0; 
        $ypos=($img_height-($zoom*$max_height))/2; 
    } 

	//echo "가로 = ".$max_width."<br>";
	//echo "세로 = ".$max_height."<br>";
     
    $src_width=ceil($zoom*$max_width); 
    $src_height=ceil($zoom*$max_height); 
     
    if($src_width>$img_width){ 
        $src_width=$img_width; 
        $xpos=0; 
    } 
    if($src_height>$img_height){ 
        $src_height=$img_height; 
        $ypos=0; 
    } 


    if($img_info[2] == 1){ $dst_img = imagecreate($max_width, $max_height); 
    }else{ $dst_img = imagecreatetruecolor($max_width, $max_height); } 
	
    # 입력한 색상으로 전체 이미지를 칠한다. 
    $bgc = ImageColorAllocate($dst_img, $outlinecolor[0], $outlinecolor[1], $outlinecolor[2]); 
    ImageFilledRectangle($dst_img, 0, 0, $max_width, $max_height, $bgc); 
    # 백색으로 외관 1픽셀을 제외하고 칠한다. 
    $bgc = ImageColorAllocate($dst_img, 255, 255, 255); 
    //ImageFilledRectangle($dst_img, 1, 1, $max_width-2, $max_height-2, $bgc); 
	ImageFilledRectangle($dst_img, 0, 0, $max_width-1, $max_height-1, $bgc); 
	
    //ImageCopyResampled($dst_img, $src_img, 2, 2, $xpos, $ypos, $max_width-4, $max_height-4, $src_width,$src_height); 
	ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $max_width, $max_height, $src_width,$src_height);
	
    if($img_info[2] == 1) 
    { 
        ImageInterlace($dst_img); 
        ImageGIF($dst_img, $upfile_path."img_thumb/".$save_file); 
    }elseif($img_info[2] == 2){ 
        ImageInterlace($dst_img); 
        ImageJPEG($dst_img, $upfile_path."img_thumb/".$save_file,85); 
    }elseif($img_info[2] == 3){ 
        ImagePNG($dst_img, $upfile_path."img_thumb/".$save_file); 
    } 

	//echo "워터마크 = $watermark_sect<br><br>";

	// 워터마크 이미지 생성시작 
			if($watermark_sect == "text"){ // 텍스트형 워터마크 
				
				$font_size = 18; // 글자 크기 
				$opacity = 70; // 투명도 높을수록 불투명 
				$font_path = $_SERVER["DOCUMENT_ROOT"]."/pro_inc/H2HDRM.TTF";  //폰트 패스 
				$string = "SI-PHARM.CO.KR";  // 찍을 워터마크 

				$image = $upfile_path."img_thumb/".$save_file; // 업로드된, 워터마크가 없는 파일.

				$image_f_name = $save_file;
				$image_name = explode(".",$image_f_name); 
				$image_targ1 = explode("-",$image_name[0]);

				$image_targ = $upfile_path."img_thumb/".$image_targ1[1]."_marke_".$image_targ1[0].".".$image_name[1];  // 워터마크가 찍혀 저장될 이미지 

				$image_org = $image; // 원본 이미지를 다른 이름으로 저장 
				
				//$image = imagecreatefromjpeg($image); // JPG 이미지를 읽고 

				if($image_name[1] == "gif" || $image_name[1] == "GIF")  $image = imagecreatefromgif($image);  
				if($image_name[1] == "jpg" || $image_name[1] == "jpeg" || $image_name[1] == "JPG" || $image_name[1] == "JPEG")  $image = imagecreatefromjpeg($image);  
				if($image_name[1] == "png" || $image_name[1] == "PNG")  $image = imagecreatefrompng($image);  
				
				$w = imagesx($image); 
				$h = imagesy($image);  

				$text_color = imagecolorallocate($image,255,255,255); // 텍스트 컬러 지정 

				// 적당히 워터마크가 붙을 위치를 지정 
				$text_pos_x = $font_size; 
				$text_pos_y = $h - $font_size; 

				imagettftext($image, $font_size, 0, $text_pos_x, $text_pos_y, $text_color, $font_path, $string);  // 읽은 이미지에 워터마크를 찍고 

				$image_org = imagecreatefromjpeg($image_org); // 원본 이미지를 다시한번 읽고 
  
				imagecopymerge($image,$image_org,0,0,0,0,$w,$h,$opacity); // 원본과 워터마크를 찍은 이미지를 적당한 투명도로 겹치기 
				imagejpeg($image, $image_targ, 90); // 이미지 저장. 해상도는 90 정도 
  
				imagedestroy($image); 
				imagedestroy($image_org); 

			} elseif($watermark_sect == "imgw"){ // 이미지합성 워터마크

				if (isset($_GET['transparency'])) {
					if ($_GET['transparency'] >= 0 && $_GET['transparency'] <= 100) {
						$transparency = (int) $_GET['transparency'];
					}
				} else {
					$transparency = 40;
				}
				
				$source_photo = $upfile_path."img_thumb/".$save_file;   // 업로드된, 워터마크가 없는 파일.

				$image_f_name = $save_file;
				$image_name = explode(".",$image_f_name); 
				$image_targ1 = explode("-",$image_name[0]);

				$image_targ = $upfile_path."img_thumb/".$image_targ1[1]."_marke_".$image_targ1[0].".".$image_name[1];  // 워터마크가 찍혀 저장될 이미지 
				$image_targ_name = $image_targ1[1]."_marke_".$image_targ1[0].".".$image_name[1];
				$filetype = substr($source_photo,strlen($source_photo)-4,4); 
				$filetype = strtolower($filetype);


				if($filetype == ".gif" || $filetype == ".GIF")  $photo = imagecreatefromgif($source_photo);  
				if($filetype == ".jpg" || $filetype == ".jpeg" || $filetype == ".JPG" || $filetype == ".JPEG")  $photo = imagecreatefromjpeg($source_photo);  
				if($filetype == ".png" || $filetype == ".PNG")  $photo = imagecreatefrompng($source_photo);  

				//if (!$photo) die(); 
				$watermark = imagecreatefrompng($_SERVER["DOCUMENT_ROOT"].'/pro_inc/watermark.png');
				$watermark_width = imagesx($watermark);
				$watermark_height = imagesy($watermark);

				//location of the watermark on the source image
				$size = getimagesize($source_photo);
				$dest_x = ($size[0] - $watermark_width) / 2;
				$dest_y = ($size[1] - $watermark_height) / 2;

				//make the image (merge source image with watermark)
				imagecopymerge($photo, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, $transparency);

				//output the image
				//imagejpeg($photo);
				imagejpeg($photo, $image_targ, 90); // 이미지 저장. 해상도는 90 정도 
				
				/*echo "<img src='/upload_file/pro_pic/img_thumb/$save_file'><br><br>";
				echo "<img src='/pro_inc/watermark.png'><br><br>";
				echo "<img src='/upload_file/pro_pic/img_thumb/$image_targ_name'><br><br>";*/

				//free memory
				imagedestroy($photo);

			}
			//워터마크 이미지 생성 종료 

    ImageDestroy($dst_img); 
    ImageDestroy($src_img); 
} 

 function thumbnail3_1($file, $save_file, $upfile_path, $img_size, $outlinecolor,$watermark_sect){ 
     
    $img_info = getImageSize($upfile_path.$file); 
    if($img_info[2] == 1){ $src_img = ImageCreateFromGif($upfile_path.$file); 
    }elseif($img_info[2] == 2){ $src_img = ImageCreateFromJPEG($upfile_path.$file); 
    }elseif($img_info[2] == 3){ $src_img = ImageCreateFromPNG($upfile_path.$file); 
    }else{ return 0; } 
    $img_width = $img_info[0]; 
    $img_height = $img_info[1]; 
	
	//echo $img_size[0]; exit;

    if($img_width > $img_height){ #가로가 큰 이미지 
        $max_width=$img_size[0]; $max_height=$img_size[1]; 
        $zoom=$img_height/$max_height; 
        $xpos=($img_width-($zoom*$max_width))/2; 
        $ypos=0; 
    } elseif($img_width < $img_height) { # 세로가 큰 이미지 
        $max_width=$img_size[2]; $max_height=$img_size[3]; 
        $zoom=$img_width/$max_width; 
        $xpos=0; 
        $ypos=($img_height-($zoom*$max_height))/2;         
    } else { # 정사각형 이미지 
        $max_width=$img_size[4]; $max_height=$img_size[4]; 
        $zoom=$img_width/$max_width; 
        $xpos=0; 
        $ypos=($img_height-($zoom*$max_height))/2; 
    } 
     
    $src_width=ceil($zoom*$max_width); 
    $src_height=ceil($zoom*$max_height); 
     
    if($src_width>$img_width){ 
        $src_width=$img_width; 
        $xpos=0; 
    } 
    if($src_height>$img_height){ 
        $src_height=$img_height; 
        $ypos=0; 
    } 

	//echo "??"; exit;

    if($img_info[2] == 1){ $dst_img = imagecreate($max_width, $max_height); 
    }else{ $dst_img = imagecreatetruecolor($max_width, $max_height); } 

   # 입력한 색상으로 전체 이미지를 칠한다. 
   
    $bgc = ImageColorAllocate($dst_img, $outlinecolor[0], $outlinecolor[1], $outlinecolor[2]); 
    ImageFilledRectangle($dst_img, 0, 0, $max_width, $max_height, $bgc); 
    # 백색으로 외관 1픽셀을 제외하고 칠한다. 
    $bgc = ImageColorAllocate($dst_img, 255, 255, 255); 
   // ImageFilledRectangle($dst_img, 1, 1, $max_width-2, $max_height-2, $bgc); 
    ImageFilledRectangle($dst_img, 0, 0, $max_width-1, $max_height-1, $bgc); 
	
    ImageCopyResampled($dst_img, $src_img, 2, 2, $xpos, $ypos, $max_width, $max_height, $src_width,$src_height); 
	//ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $max_width, $max_height, $src_width,$src_height); 

    if($img_info[2] == 1) 
    { 
        ImageInterlace($dst_img); 
        ImageGIF($dst_img, $upfile_path."img_thumb2/".$save_file); 
    }elseif($img_info[2] == 2){ 
        ImageInterlace($dst_img); 
        ImageJPEG($dst_img, $upfile_path."img_thumb2/".$save_file,85); 
    }elseif($img_info[2] == 3){ 
        ImagePNG($dst_img, $upfile_path."img_thumb2/".$save_file); 
    } 

	// 워터마크 이미지 생성시작 
			if($watermark_sect == "text"){ // 텍스트형 워터마크 
				
				$font_size = 18; // 글자 크기 
				$opacity = 70; // 투명도 높을수록 불투명 
				$font_path = $_SERVER["DOCUMENT_ROOT"]."/pro_inc/H2HDRM.TTF";  //폰트 패스 
				$string = "SI-PHARM.CO.KR";  // 찍을 워터마크 

				$image = $upfile_path."img_thumb2/".$save_file; // 업로드된, 워터마크가 없는 파일.

				$image_f_name = $save_file;
				$image_name = explode(".",$image_f_name); 
				$image_targ1 = explode("-",$image_name[0]);

				$image_targ = $upfile_path."img_thumb2/".$image_targ1[1]."_marke_".$image_targ1[0].".".$image_name[1];  // 워터마크가 찍혀 저장될 이미지 

				$image_org = $image; // 원본 이미지를 다른 이름으로 저장 
				
				//$image = imagecreatefromjpeg($image); // JPG 이미지를 읽고 

				if($image_name[1] == "gif" || $image_name[1] == "GIF")  $image = imagecreatefromgif($image);  
				if($image_name[1] == "jpg" || $image_name[1] == "jpeg" || $image_name[1] == "JPG" || $image_name[1] == "JPEG")  $image = imagecreatefromjpeg($image);  
				if($image_name[1] == "png" || $image_name[1] == "PNG")  $image = imagecreatefrompng($image);  
				
				$w = imagesx($image); 
				$h = imagesy($image);  

				$text_color = imagecolorallocate($image,255,255,255); // 텍스트 컬러 지정 

				// 적당히 워터마크가 붙을 위치를 지정 
				$text_pos_x = $font_size; 
				$text_pos_y = $h - $font_size; 

				imagettftext($image, $font_size, 0, $text_pos_x, $text_pos_y, $text_color, $font_path, $string);  // 읽은 이미지에 워터마크를 찍고 

				$image_org = imagecreatefromjpeg($image_org); // 원본 이미지를 다시한번 읽고 
  
				imagecopymerge($image,$image_org,0,0,0,0,$w,$h,$opacity); // 원본과 워터마크를 찍은 이미지를 적당한 투명도로 겹치기 
				imagejpeg($image, $image_targ, 90); // 이미지 저장. 해상도는 90 정도 
  
				imagedestroy($image); 
				imagedestroy($image_org); 

			} elseif($watermark_sect == "imgw"){ // 이미지합성 워터마크

				if (isset($_GET['transparency'])) {
					if ($_GET['transparency'] >= 0 && $_GET['transparency'] <= 100) {
						$transparency = (int) $_GET['transparency'];
					}
				} else {
					$transparency = 40;
				}
				
				$source_photo = $upfile_path."img_thumb2/".$save_file;   // 업로드된, 워터마크가 없는 파일.

				$image_f_name = $save_file;
				$image_name = explode(".",$image_f_name); 
				$image_targ1 = explode("-",$image_name[0]);

				$image_targ = $upfile_path."img_thumb2/".$image_targ1[1]."_marke_".$image_targ1[0].".".$image_name[1];  // 워터마크가 찍혀 저장될 이미지 
				$filetype = substr($source_photo,strlen($source_photo)-4,4); 
				$filetype = strtolower($filetype);


				if($filetype == ".gif" || $filetype == ".GIF")  $photo = imagecreatefromgif($source_photo);  
				if($filetype == ".jpg" || $filetype == ".jpeg" || $filetype == ".JPG" || $filetype == ".JPEG")  $photo = imagecreatefromjpeg($source_photo);  
				if($filetype == ".png" || $filetype == ".PNG")  $photo = imagecreatefrompng($source_photo);  

				//if (!$photo) die(); 
				$watermark = imagecreatefrompng($_SERVER["DOCUMENT_ROOT"].'/pro_inc/watermark.png');
				$watermark_width = imagesx($watermark);
				$watermark_height = imagesy($watermark);

				//location of the watermark on the source image
				$size = getimagesize($source_photo);
				$dest_x = ($size[0] - $watermark_width) / 2;
				$dest_y = ($size[1] - $watermark_height) / 2;

				//make the image (merge source image with watermark)
				imagecopymerge($photo, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, $transparency);

				//output the image
				//imagejpeg($photo);
				imagejpeg($photo, $image_targ, 90); // 이미지 저장. 해상도는 90 정도 

				//free memory
				imagedestroy($photo);

			}
			//워터마크 이미지 생성 종료 

    ImageDestroy($dst_img); 
    ImageDestroy($src_img); 
} 
// 사이즈 조정 섬네일함수 종료 
function print_url($txt){
	$url_patt =" http://([0-9a-zA-Z./@~?&=_]+)" ;//-----(1) 
	$url_patt1 ="\nhttp://([0-9a-zA-Z./@~?&=_]+)" ;//----(2) 
	$email_patt=" ([_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*)@([0-9a-zA-Z-]+(\.[0-9a-zA-Z-]+)*)" ; //-----(3) 

	$txt = eregi_replace($url_patt," <a href=http://\\1 target='_blank'>http://\\1</a>",$txt); 
	$txt = eregi_replace($url_patt1,"\n<a href=http://\\1 target='_blank'>http://\\1</a>",$txt); 
	$txt = eregi_replace($email_patt,"<a href=mailto:\\1@\\3>\\1@\\3</a>",$txt); 
	return $txt;
}

function print_htmltag_yesno($allow_html) {
   if($allow_html) {
      echo("<font size=2>(태그사용 <b>가능</b>)</font>");
   } else {
      echo("<font size=2>(태그사용 <b>불가</b>)</font>");
   }
}   

function popup_msg($msg) {
   echo("<script type=\"text/javascript\"> 
   <!--
   alert('$msg');
   history.back();
   //-->   
   </script>");
}

function error_define($errcode) {
   switch ($errcode) {
      case ("INVALID_NAME") :
         popup_msg("입력하신 이름은 허용되지 않는 문자열입니다.\\n\\n올바른 이름을 입력하여 주십시오.");
         break;
      case ("INVALID_ID") :
         popup_msg("입력하신 아이디는 허용되지 않는 문자열입니다.\\n\\n아이디는 5 ~ 10자의 영문소문자나 숫자 또는 조합된 문자열이어야 합니다.");
         break;         
      case ("INVALID_BIRTHDAY") :
         popup_msg("선택하신 생년월일이 잘못되었습니다.\\n\\n올바른 생년월일을 선택하여 주십시오.");
         break;   
      case ("INVALID_SUBJECT") :
         popup_msg("입력하신 제목은 허용되지 않는 문자열입니다. \\n\\n올바른 제목을 입력하여 주십시오.");
         break;
      
      case ("INVALID_EMAIL") :
         popup_msg("입력하신 주소는 올바른 전자우편주소가 아닙니다. \\n\\n다시 입력하여 주십시오.");
         break;        
         
      case ("INVALID_HOMEPAGE") :
         popup_msg("입력하신 주소는 올바른 홈페이지주소가 아닙니다. \\n\\n다시 입력하여 주십시오.");
         break;                 
         
      case ("INVALID_PASSWD") :
         popup_msg("암호는 최소 4자이상의 영문자 또는 숫자여야 합니다. \\n\\n다시입력하여 주십시오.");
         break;
         
      case ("INVALID_COMMENT") :
         popup_msg("본문을 입력하지 않으셨습니다. \\n\\n다시입력하여 주십시오.");   
         break;
      case ("INVALID_JOB") :
         popup_msg("직업을 입력하지 않으셨습니다. \\n\\n다시입력하여 주십시오.");   
         break;
      case ("ID_EXISTS") :
         popup_msg("신청하신 아이디(ID)는 이미 등록되어 있습니다. \\n\\n다른 아이디로 신청하여 주십시오.");
         break;
      case ("LOGIN_ID_NOT_FOUND") :
         popup_msg("입력하신 아이디(ID)는 등록되어 있지 않습니다. \\n\\n다시한번 확인하시고 입력하여 주십시오.");
         break;                  

      case ("LOGIN_INVALID_PW") :
         popup_msg("회원님이 입력하신 비밀번호가 맞지 않습니다. \\n\\n다시한번 확인하시고 입력하여 주십시오.");
         break;  
      case ("INVALID_FILE") :
         popup_msg("등록할 파일을 선택하지 않으셨습니다. \\n\\n다시 입력하여 주십시오.");
         break;          

      case ("UPDATE_MEMBER_INVALID_MODE") :
         popup_msg("부적절한 실행옵션으로 인해 회원정보를 수정할 수 없습니다. \\n\\n관리자에게 문의하여 주십시오.");
         break;         
      
      case ("QUERY_ERROR") :      
         $err_no = mysqli_errno();
         $err_msg = mysqli_error();         
         $error_msg = "ERROR CODE " . $err_no . " : $err_msg";                           
         $error_msg = addslashes($error_msg);         
         popup_msg($error_msg);  
         break;

      case ("DB_ERROR") :      
         $err_no = mysqli_errno();
         $err_msg = mysqli_error();         
         $error_msg = "ERROR CODE " . $err_no . " : $err_msg";                           
         echo("$error_msg");
         break;
      
      case ("NO_ACCESS_MODIFY") :   
         popup_msg("입력하신 암호와 일치하지 않으므로 수정할 수 없습니다. \\n\\n다시 입력하여 주십시오.");
         break;

      case ("NO_ACCESS_DELETE") :   
         popup_msg("입력하신 암호와 일치하지 않으므로 삭제할 수 없습니다. \\n\\n다시 입력하여 주십시오.");
         break;

      case ("NO_ACCESS_DELETE_THREAD") :   
         popup_msg("답변이 있는 글은 삭제하실 수 없습니다. \\n\\n답변글을 모두 삭제하신 후 삭제하십시오.");
         break;
      case ("NO_ACCESS_UPLOAD") :   
         popup_msg("해당파일은 자료실 운영지침에 따라 업로드가 허용되지 않는 파일입니다. \\n\\n가능하면 압축파일의 형태로 등록하여 주십시오.");
         break;         
         
      case ("SAME_FILE_EXIST") :   
         popup_msg("동일한 이름의 파일이 이미 등록되어 있습니다. \\n\\n다른 이름으로 업로드하여 주십시오.");
         break;                           
      
      case ("UPLOAD_COPY_FAILURE") :   
         popup_msg("업로드 과정중 오류가 발생하였습니다. \\n\\n파일이 저장될 디렉토리가 없거나 디렉토리의 퍼미션 제한으로 인한 오류일 가능성이 있습니다.");
         break;                           

      case ("UPLOAD_DELETE_FAILURE") :   
         popup_msg("업로드 과정중 오류가 발생하였습니다. \\n\\n관리자에게 문의하여 주십시오.");
         break;
         
      case ("FILE_DELETE_FAILURE") :   
         popup_msg("파일이 삭제되지 않았습니다. \\n\\n관리자에게 문의하여 주십시오.");
         break;         
      default :
   }
}

######## 에러메시지 출력후 back
function error_back($msg) {
				echo ("
				<script type='text/javascript'>
				<!--
					alert ('$msg');
					history.back();
				//-->
				</script>
				");
				exit;
}

######## 프로세스 창에서 에러메시지 출력만
function error_frame($msg) {
				echo ("
				<script type='text/javascript'>
				<!--
					alert ('$msg');
				//-->
				</script>
				");
				exit;
}

######## 프로세스 창에서 에러메시지 출력 후 페이지이동
function error_frame_go($msg,$url) {
				echo ("
				<script type='text/javascript'>
				<!--
					alert ('$msg');
					parent.location.href='".$url."';
				//-->
				</script>
				");
				exit;
}

######## 프로세스 창에서 에러메시지 출력 후 최상위 페이지이동
function error_frame_top_go($msg,$url) {
				echo ("
				<script type='text/javascript'>
				<!--
					alert ('$msg');
					top.location.href='".$url."';
				//-->
				</script>
				");
				exit;
}

######## 팝업 프로세스 창에서 에러메시지 출력 후 부모창 페이지이동
function error_frame_opener_go($msg,$url) {
				echo ("
				<script type='text/javascript'>
				<!--
					alert ('$msg');
					parent.opener.location.href='".$url."';
					parent.close();
				//-->
				</script>
				");
				exit;
}

######## 프로세스 창에서 에러메시지 출력 없이 페이지이동
function frame_go($url) {
				echo ("
				<script type='text/javascript'>
				<!--
					parent.location.href='".$url."';
				//-->
				</script>
				");
				exit;
}

######## 팝업창에서 에러메시지 출력후 창닫기
function error_popup($msg) {
				echo ("
				<script type='text/javascript'>
				<!--
					alert ('$msg');
					self.close();
				//-->
				</script>
				");
				exit;
}

######## 팝업창에서 에러메시지 출력후 본페이지 이동하며 창닫기
function error_popup_go($msg,$url) {
				echo ("
				<script type='text/javascript'>
				<!--
					alert ('$msg');
					opener.location.href='".$url."';
					self.close();
				//-->
				</script>
				");
				exit;
}

function no_error_popup_go($url) {
				echo ("
				<script type='text/javascript'>
				<!--
					opener.location.href='".$url."';
					self.close();
				//-->
				</script>
				");
				exit;
}

######## 에러메시지 출력후 페이지이동
function error_go($msg,$url) {
				echo "
				<script type='text/javascript'>
				<!--
					alert ('$msg');
					location.href='".$url."';
				//-->
				</script>
				";
				exit;
}

######## 에러메시지 출력 없이 페이지이동
function no_error_go($url) {
				echo "
				<script type='text/javascript'>
				<!--
					location.href='".$url."';
				//-->
				</script>
				";
				exit;
}

######## 정수형으로 변환 후, 값을 가지게 되는 지 확인
function validate_number($number, $error, $err_msg) 
	{
	$number = intval($number);
	if(!($number))
		{
		$error($err_msg);
		exit;
		}
	}	

function validate_year($number, $error, $err_msg) 
######## 정수형으로 변환 후, 현재부터 100년 전후 데이타만 입력가능
	{
	$number = intval($number);
	if ($number<(date("Y")-100) || $number>(date("Y")+100))
		{
		$error($err_msg);
		exit;
		}
	}		
	
function validate_month($number, $error, $err_msg) 
######## 정수형으로 변환 후, 현재부터 1-12값을 가지는지 확인
	{
	$number = intval($number);
	if ($number<1 || $number>12)
		{
		$error($err_msg);
		exit;
		}
	}			

function validate_array($array, $validate_function, $error, $err_msg) 
	{
	for ($i=0;$i<sizeof($array);$i++)
		{
		if ($array[$i])
			{
			$validate_function($array[$i],$error,($i+1)."번째로 입력하신 ".$err_msg);
			}
		}
	}

function validate_email ($email, $error, $err_msg) 
	{
	if(ereg("([^[:space:]]+)", $email) && (!ereg("(^[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*@[0-9a-zA-Z-]+(\.[0-9a-zA-Z-]+)*$)", $email))  ) 
		{
		$error($err_msg);
		exit;
		}
	}

function validate_homepage ($homepage, $error, $err_msg)
	{
	if(ereg("([^[:space:]]+)", $homepage) && (!ereg("http://([0-9a-zA-Z./@~?&=_]+)", $homepage)))
		{
   		$error($err_msg);   
   		exit;
   		}
   	}

function validate_character($character, $error, $err_msg)
	{
	if(!ereg("([^[:space:]]+)", $character)) 
		{
		$error($err_msg);
		exit;
		}
	}

function validate_passwd($passwd, $error, $err_msg) 
	{
	if(!ereg("(^[0-9a-zA-Z]{4,}$)", $passwd)) 
		{
		$error($err_msg);
		exit;
		}
	}	

function text_cut($str, $len, $tail="...") {
	//mb_internal_encoding("utf-8");
	//return mb_strimwidth($string, 0, $length, "...");
	
			if(strlen($str)>$len){
				for($i=0; $i<$len; $i++){
					if(ord($str[$i])>127) $i++;
				}
				$strs=substr($str,0,$i); 
				return $strs.$tail;
			}
			return $str;
	
}

function cleanupstippedtag($data) {
// 일정하지 않은 공백의 처리 후 배열화
$data = eregi_replace("\n","",$data);
$data = eregi_replace("[[:space:]]+", " ", $data);
return $data;
}

function gethtml($url) {

  $fd = fopen($url, "r") or die("Error: Unable to open file $html_file");
  // Loop until we're at EOF of $fd
  while (!feof($fd))
        {
        $fgetcharacter=fgets($fd,1024);
        $body = $body.$fgetcharacter;
        }
  return $body;
}

function betweenstartandend($body, $start, $end) {
$body=addslashes($body);
$trim_before = substr(strstr($body,$start),strlen($start));
$tail_length = strlen(strstr($trim_before, $end));
$body_length = strlen($trim_before) - $tail_length;
$body_core = substr($trim_before, 0, $body_length);
$body_core = stripslashes ($body_core);
return $body_core;
}

function trim_before($body, $start) {
$body=addslashes($body);
$trim_before = substr(strstr($body,$start),strlen($start));
$trim_before = stripslashes($trim_before);
return $trim_before;
}

// 날짜형태변경
function to_date($date) {
	return substr($date, 0, 4)."-".substr($date,4,2)."-".substr($date,6,2);
}

// 에러메시지 

function getCalendar($name, $date_default, $id=""){
	if(!$id){
		$id = $name;
	}
	$s = "
	<input name=\"".$name."\" id=\"".$id."\" value=\"".$date_default."\" type=\"text\" size=\"8\"  maxlength=\"8\" readonly onClick=\"new CalendarFrame.Calendar(this)\" class=\"readonly_calendar\"/>
	  <image src=\"/img/btn_cal.gif\" border=\"0\" onClick=\"new CalendarFrame.Calendar(getObject('$id'))\" align=\"absmiddle\" alt=\"달력선택\">";
	  //      <input name=\"달력2\" type=\"button\" id=\"달력2\" value=\"달력\" onClick=\"new CalendarFrame.Calendar(getObject('$id'))\">
	return $s;
}

function now_date($c_time){ // 등록일이 하루전인지 추출하기 위한 펑션

	$nowdate = time()-86400*1; // 하루전 리눅스타임	

	if ($c_time >= $nowdate){
	$new_icon = "<img src='/img/icon/icon_new.png' border='0' align='absmiddle'>";
	} else {
	$new_icon = "";	
	}

	return $new_icon;
}

function now_date_submain($c_time){ // 등록일이 하루전인지 추출하기 위한 펑션

	$nowdate = time()-86400*1; // 하루전 리눅스타임	

	if ($c_time >= $nowdate){
	$new_icon = "<img src='/img/icon/icon_new.png' border='0' align='absmiddle'>";
	} else {
	$new_icon = "";	
	}

	return $new_icon;
}	

function sqlfilter($str) {
	//1단계 ? ',",NULL 문자 필터링. 각 문자들에 백슬래쉬(\) 삽입됨. 필수 항목
	//출력시 stripslashes()함수를 이용하여 백슬래쉬(\)를 제거
	$str = urldecode($str);
	if (!get_magic_quotes_gpc()) $str = addslashes($str);
	//3단계 ? 특수 문자 및 문자열 필터링
	//WHERE 구문에서 쓰여지는 데이터만 사용하는 것이 바람직하다.
	$search = array("--","#",";","+");
	$replace = array("\--","\#","\;","\+");
	$str = str_replace($search, $replace, $str);
	return $str;
}

function clearxss($str) {
	$avatag = "p,br"; //XSS에서 허용할 태그 리스트
	$str=str_replace("<","&lt;", $str);
	$str=str_replace(">","&gt;", $str);
	$str=str_replace("'","''", $str);
	$str=str_replace("\"","'", $str);
	$str=str_replace("\0","", $str);

	//허용할 태그를 지정할 경우
	$avatag=str_replace(" ", "", $avatag);
	if ($avatag != "") {
		$otag = explode (",", $avatag);		
		//허용할 태그를 존재 여부를 검사하여 원상태로 변환
		for ($i = 0;$i < count($otag);$i++) {
			$str = ereg_replace("&lt;".$otag[$i]." ", "<".$otag[$i]." ", $str);
			$str = ereg_replace("&lt;".$otag[$i].">", "<".$otag[$i].">", $str);
			$str = ereg_replace("&lt;/".$otag[$i], "</".$otag[$i], $str);			
		}
	}
	return $str;
}

function to_time($date_str,$niddle='-'){//날짜를 timestamp값으로 바꿔줌.
	//echo "받은날짜 = ".$date_str;
	$date_arr=explode($niddle,$date_str);
	return mktime(0,0,0,$date_arr[1],$date_arr[2],$date_arr[0]);
}//mk_time()------------

function randomChar($rsltea){
		srand((double)microtime() * 1000000);
		$patternA = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";  //26
			for($i=1;$i<=$rsltea;$i++){
			$pick2 = rand(0,25);
			$rsltea = $rsltea.substr($patternA,$pick2,1);
			//echo $rsltea."<br>";
			}
		$rsltea = substr($rsltea,1,$rsltea);
		return $rsltea;
}

function mt_rand_n($min,$max,$disallowed,$check_cnt=0) { // 특정숫자 제외 랜점값 출력함수. 로또동반자에 맞도록 제작함.
	
	$rand = mt_rand($min,$max);
	
	//echo "<br><br>허용하지 않는 수의 배열 = ".$disallowed."<br><br>";

	$disallowed_arr = explode(",",$disallowed);

	//echo "<br><br>허용하지 않는 값의 갯수 = ".sizeof($disallowed_arr)."<br><br>";

	for($k=0; $k<sizeof($disallowed_arr); $k++){ // 제외해야할 숫자의 갯수만큼 루프 시작

		//echo "<br><br>허용하지 않는 수 = ".$disallowed_arr[$k]."<br><br>";
		
		if(trim($rand) == trim($disallowed_arr[$k])){ // 만들어진 랜덤수가 제외해야할 숫자와 같다면 시작
			
			//echo "<br><br>만들어진 랜덤 = ".trim($rand)." : 허용하지 않는 값 = ".trim($disallowed_arr[$k])."<br><br>";

			$check_cnt = $check_cnt+1;
			if($check_cnt >= 9){ // 무한루프 차단
				error_frame("이월수 또는 고정수, 혹은 제외수에 1궁도 값이 너무 많아서 자동으로 번호를 배당할수가 없습니다.");
				exit;	
			}
					
			 $rand = mt_rand_n($min,$max,$disallowed,$check_cnt);

		} // 만들어진 랜덤수가 제외해야할 숫자와 같다면 종료

	} // 제외해야할 숫자의 갯수만큼 루프 종료

	return $rand;

}

function LIB_removeAllData( $URL ) 
{ 
    if( is_dir( $URL ) ) 
    { 
        if( $dh = opendir( $URL ) ) 
        { 
            while( ( $file = readdir( $dh ) ) !== false ) 
            { 
                if( $file == '.' || $file == ".." )        continue; 

                if( filetype( $URL.$file ) == "dir" )    LIB_removeAllData( $URL.$file.'/' ); 
                else                                    @unlink( $URL.$file );                    // 파일 삭제 
            } 

            @rmdir( $URL );        // 폴더 삭제 
            closedir( $dh ); 
        } 
    } 
} 

function LIB_removeAllData_2( $URL ) 
{ 
    if( is_dir( $URL ) ) 
    { 
        if( $dh = opendir( $URL ) ) 
        { 
            while( ( $file = readdir( $dh ) ) !== false ) 
            { 
                if( $file == '.' || $file == ".." )        continue; 

                if( filetype( $URL.$file ) == "dir" )    LIB_removeAllData_2( $URL.$file.'/' ); 
              } 
			closedir( $dh ); 
        } 
    } 
} 

Function string_cut2($str, $len, $checkmb=false, $tail='...') { 
	$len = $len + 14;
	$title = stripslashes($str);
	$title = htmlspecialchars_decode($title, ENT_QUOTES);
	$tsize = strlen($title);
	return ($tsize <= $len)? $title : mb_strcut($title, 0, $len-2, 'UTF-8').$tail;
}

Function string_cut3($str, $len, $checkmb=false, $tail='...') { 
	$len = $len;
	$title = stripslashes($str);
	$title = htmlspecialchars_decode($title, ENT_QUOTES);
	$tsize = strlen($title);
	return ($tsize <= $len)? $title : mb_strcut($title, 0, $len-2, 'UTF-8');
} 

Function string_cut4($str, $len, $checkmb=true, $tail='..') { 
  preg_match_all('/[\xEA-\xED][\x80-\xFF]{2}|./', $str, $match); 
  $m    = $match[0]; 
  $slen = strlen($str);  // length of source string 
  $tlen = strlen($tail); // length of tail string 
  $mlen = count($m);    // length of matched characters 

  if ($slen <= $len) return $str; 
  if (!$checkmb && $mlen <= $len) return $str; 
  
  $ret  = array(); 
  $count = 0; 
  
  for ($i=0; $i < $len; $i++) { 
    $count += ($checkmb && strlen($m[$i]) > 1)?2:1; 
    if ($count + $tlen > $len) break; 
    $ret[] = $m[$i]; 
  } 

  return join('',$ret).$tail;
  
}

/*function string_cut3($msg,$cut_size) {
  if($cut_size<=0) return $msg;
  if(ereg("\[re\]",$msg)) $cut_size=$cut_size+4;
    $max_size = $cut_size;
  $i=0;
  while(1) {
   if (ord($msg[$i])>127)
    $i+=3;
   else
    $i++;

   if (strlen($msg) < $i)
    return $msg;

   if ($max_size == 0)
    return substr($msg,0,$i)."..";
   else
    $max_size--;
  }

}*/


/*********************************************************
//utf-8 HTML을 utf-8 로 변환해서 보내기
*********************************************************/
function encode_2047($subject) {
    return '=?utf-8?b?'.base64_encode($subject).'?=';
}

function mail_utf_kr($email_str, $subject, $message,$from_name,$from_email)
{
    mb_internal_encoding('utf-8'); 
   
    $from_name = encode_2047(iconv("utf-8","utf-8",$from_name));

    $subject = iconv("utf-8","utf-8",$subject);
    $message = iconv("utf-8","utf-8",$message);

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-Type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n"; //
    $headers .= 'Content-Disposition: inline' . "\r\n";  //
    $headers .= 'X-Mailer: PHP' . "\r\n";
    $headers .= 'From: '.$from_name.' < '.$from_email.' >'. "\r\n";

    // 메일 보내기
    $result = mb_send_mail($email_str, $subject, $message, $headers) ;

    return $result; 
}

function mail_utf($from_email,$from_name,$to_email,$subject,$body,$file=""){ 
    if (strlen($to_email)==0) return 0; 
	$body = stripslashes($body);
	//$subject = iconv("utf-8","euc-kr",$subject);
	$subject = stripslashes($subject);
	$subject='=?UTF-8?B?'.base64_encode($subject).'?=';
 	$from_name = iconv("utf-8","euc-kr",$from_name);
    
	$mailheaders .= "From: $from_name<$from_email> \r\n"; 
    $mailheaders .= "Reply-To: $from_name<$from_email>\r\n"; 
    $mailheaders .= "Return-Path: $from_name<$from_email>\r\n"; 
	//echo "파일사이즈 = ".$file[size]."<br>";
    if ($file[size]>0) { 
		$file['data'] = file_get_contents($file['tmp_name']); // 파일 내용 읽기 4.3 이상 
        $boundary = uniqid("part"); 
        if (strlen($file[type])==0) $file[type] = "application/octet-stream"; 

        $mailheaders .= "MIME-Version: 1.0\r\n"; 
        $mailheaders .= "Content-Type: Multipart/mixed; boundary = \"".$boundary."\""; 

        $bodytext = "This is a multi-part message in MIME format.\r\n\r\n"; 
        $bodytext .= "--".$boundary."\r\n"; 
        $bodytext .= "Content-Type: text/html; charset=\"utf-8\"\r\n"; 
        $bodytext .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
        $bodytext .= ereg_replace("(.{80})","\\1\r\n",base64_encode(stripslashes($body))) . "\r\n\r\n";

        $bodytext .= "--".$boundary."\r\n"; 
        $bodytext .= "Content-Type: ".$file[type]."; name=\"".$file[name]."\"\r\n"; 
        $bodytext .= "Content-Transfer-Encoding: base64\r\n"; 
        $bodytext .= "Content-Disposition: attachment; filename=\"".$file[name]."\"\r\n\r\n"; 
        $bodytext .= chunk_split(base64_encode($file[data]))."\r\n\r\n"; 

        $bodytext .= "--".$boundary."--"; 
    } else { 
        $mailheaders .= "Content-Type: text/html; charset=\"utf-8\"\r\n";  
        $bodytext = stripslashes($body) . "\r\n\r\n"; 
    } 
	/*echo "to_email = ".$to_email."<br>";
	echo "subject = ".$subject."<br>";
	echo "bodytext = ".$bodytext."<br>";
	echo "mailheaders = ".$mailheaders."<br>";
	echo "from_email = ".$from_email."<br>";*/
    if(!mail($to_email,$subject,$bodytext,$mailheaders,'-f'.$from_email)) {return 0;} 
    return 1; 
} 

//날짜형태 바꾸기
function tranStrDate($dates, $type=""){
	//날짜가 없을 경우 추가 2014.3.26 남병천
	if(empty($dates)){
		return "";
	}

		$date = explode(" ",$dates); 			
		$Ymd  = explode("-",$date[0]);	$time = explode(":",$date[1]);	
		$year = $Ymd[0];	$month = $Ymd[1];	$day = $Ymd[2];
		$year_2 = substr($Ymd[0],2,3);	$month = $Ymd[1];	$day = $Ymd[2];
		$hour = $time[0];	$minute	= $time[1];	$second	= $time[2];

		switch($type){
			case 'ymdS':
			return $year_2."/".$month."/".$day;
			break;
			case 'YmdKo2':
			return $year.".".$month.".".$day;
			break;
			case 'YmdKo3':
			return $year_2.".".$month.".".$day;
			break;
			case 'mdhi':
			return $month.".".$day." ".$hour.":".$minute;
			break;
			case 'YmdHis.':
			return $year.".".$month.".".$day." ".$hour.":".$minute.":".$second;
			break;
			case 'kordis.':
			return $year."년 ".$month."월 ".$day."일";
			break;
			case 'korweek.':
			return $month."월 ".$day."일(".$this->get_weekday_str($dates).")";
			break;
			case 'korweek2':
			return $year.".".$month.".".$day." (".$this->get_weekday_str($dates).")";
			break;
			//2014.3.25추가 남병천 (보고목록에서 사용하기 위해)
			case 'YmdHi':
			return $year.".".$month.".".$day." ".$hour.":".$minute;
			break;
			//2014.4.15추가 김대윤 (회원사목록)
			case 'Ymd':			
			return $year."-".$month."-".$day;
			break;
		}
	
		return "type 지정이 잘못 되었습니다.";
}

function popup_back($msg)
{
	echo("
		<script language='javascript'>
			alert('$msg');
			history.back();
		</script>
	");
	
}

function popup_go($msg,$go_link)
{
	echo("
		<script language='javascript'>
			alert('$msg');
			location.href='$go_link';
		</script>
	");
	exit;
}

function redirect($locate,$sec)
{
	echo("<meta http-equiv='refresh' content='$sec ; url=$locate'>");
}

function tran_encode_euckr($str) {
	$str = iconv("euc-kr", "utf-8", $str);
	return $str;
}

function fnzero($str) {
	$sren = strlen($str);

		if($sren == 1){
		$str = "0".$str;
		}

	return $str;
}

function encrypt_md5_base64($plain_text, $password="password", $iv_len = 16)
    {
        $plain_text .= "\x13";
        $n = strlen($plain_text);
        if ($n % 16) $plain_text .= str_repeat("\0", 16 - ($n % 16));
        $i = 0;
        while ($iv_len-- >0)
        {
            $enc_text .= chr(mt_rand() & 0xff);
        }
        
        $iv = substr($password ^ $enc_text, 0, 512);
        while($i <$n)
        {
            $block = substr($plain_text, $i, 16) ^ pack('H*', md5($iv));
            $enc_text .= $block;
            $iv = substr($block . $iv, 0, 512) ^ $password;
            $i += 16;
        }
        return base64_encode($enc_text);
}

 function decrypt_md5_base64($enc_text, $password="password", $iv_len = 16)
    {
        $enc_text = base64_decode($enc_text);
        $n = strlen($enc_text);
        $i = $iv_len;
        $plain_text = '';
        $iv = substr($password ^ substr($enc_text, 0, $iv_len), 0, 512);
        while($i <$n)
        {
            $block = substr($enc_text, $i, 16);
            $plain_text .= $block ^ pack('H*', md5($iv));
            $iv = substr($block . $iv, 0, 512) ^ $password;
            $i += 16;
        }
        return preg_replace('/\x13\x00*$/', '', $plain_text);
 }

/* ============================================================================
Return :
Comment: 업로드한 파일이 이미지인지 체크
Usage :
------------------------------------------------------------------------------*/
function upload_img_type($srcimg) {

	/*echo "<br>";
	echo "srcimg : ".$srcimg;
	echo "<br>";
	$image_info = @getimagesize($srcimg);
	echo "<br>";
	echo "mine1 : ".$image_info['mime'];*/

	if(is_file($srcimg)) {
		$image_info = @getimagesize($srcimg);

		switch ($image_info['mime']) {
			case 'image/gif': return true; break;
			case 'image/jpeg': return true; break;
			case 'image/png': return true; break;
			case 'image/bmp': return true; break;
			default : return false; break;
		}
	} else {
		return false;
	}
}

// 업로드 파일 확장자 구하기
function getExt($file) { 
	$needle = strrpos($file, ".") + 1; // 파일 마지막의 "." 문자의 위치를 반환한다. 
	$slice = substr($file, $needle); // 확장자 문자를 반환한다. 
	$ext = strtolower($slice); // 반환된 확장자를 소문자로 바꾼다. 
	return $ext; 
} 

// 몇분전 등록인가
function get_minustime($strtime) { 
	if(strtotime($strtime) >= time()){
		$calculate_time = strtotime($strtime) - time(); 
	} else {
		$calculate_time = time() - strtotime($strtime); 
	}

	$min = round($calculate_time/60)."분"; //분
    if($min >60){
		 $min = round($calculate_time/3600)."시간"; //시간
		 if($min > 24){
			$min = round($calculate_time/86400)."일"; //일
		}
   }
   return $min; 
} 

// 접수-요청시간 
function get_minustime_req($reqtime,$strtime) { 
	if(strtotime($reqtime) <= strtotime($strtime)){
		$min = "즉시"; 
	} else {
		$calculate_time = strtotime($reqtime) - strtotime($strtime); 
		$min = round($calculate_time/60)."분 후"; //분
		if($min >60){
			 $min = round($calculate_time/3600)."시간 후"; //시간
			if($min > 24){
				$min = round($calculate_time/86400)."일 후"; //일
			}
		}
	}
	
   return $min; 
}
// 이달의 마지막날 
function get_totaldays($year,$month) {
$date = 1;
  while(checkdate($month,$date,$year)) {
      $date++;
  }
   $date--;
   return $date;
}

function level_icon($level){ 
	
	if($level){
		switch ($level) {
			case "001" : 
			$level_icon = "l_new";
			break;
			case "002" : 
			$level_icon = "l_bronze";
			break;
			case "003" : 
			$level_icon = "l_silver";
			break;
			case "004" : 
			$level_icon = "l_gold";
			break;
			case "005" : 
			$level_icon = "l_sapphire";
			break;
			case "006" : 
			$level_icon = "l_diamond";
			break;
		}
	} else {
		$level_icon = "";	
	}

	return $level_icon;
}

// 외부 xml 파일 오픈

function getUrlData($url,$path) {	
		$socket = fsockopen($url, 80);	
		if($socket) {		
				$header = "GET /".$path." HTTP/1.0\n\n";		
				fwrite($socket, $header); 		
				$data = '';		
				while(!feof($socket)) { 
						$data .= fgets($socket); 
				}		
				fclose($socket); 		
				$data = explode("\r\n\r\n", $data, 2);		
				return $data[1];	
		} else {
			return false;
		}
}

// 두 좌표간의 거리를 구하기(WGS84 기준)
function get_distance($lat1, $lon1, $lat2, $lon2) {
  /* WGS84 stuff */
  $a = 6378137;
  $b = 6356752.3142;
  $f = 1/298.257223563;
  /* end of WGS84 stuff */

  $L = deg2rad($lon2-$lon1);
  $U1 = atan((1-$f) * tan(deg2rad($lat1)));
  $U2 = atan((1-$f) * tan(deg2rad($lat2)));
  $sinU1 = sin($U1);
  $cosU1 = cos($U1);
  $sinU2 = sin($U2);
  $cosU2 = cos($U2);

  $lambda = $L;
  $lambdaP = 2*pi();
  $iterLimit = 20;
  while ((abs($lambda-$lambdaP) > pow(10, -12)) && ($iterLimit-- > 0)) {
    $sinLambda = sin($lambda);
    $cosLambda = cos($lambda);
    $sinSigma = sqrt(($cosU2*$sinLambda) * ($cosU2*$sinLambda) + ($cosU1*$sinU2-$sinU1*$cosU2*$cosLambda) * ($cosU1*$sinU2-$sinU1*$cosU2*$cosLambda));

    if ($sinSigma == 0) {
      return 0;
    }

    $cosSigma   = $sinU1*$sinU2 + $cosU1*$cosU2*$cosLambda;
    $sigma      = atan2($sinSigma, $cosSigma);
    $sinAlpha   = $cosU1 * $cosU2 * $sinLambda / $sinSigma;
    $cosSqAlpha = 1 - $sinAlpha*$sinAlpha;
    $cos2SigmaM = $cosSigma - 2*$sinU1*$sinU2/$cosSqAlpha;

    if (is_nan($cos2SigmaM)) {
      $cos2SigmaM = 0;
    }

    $C = $f/16*$cosSqAlpha*(4+$f*(4-3*$cosSqAlpha));
    $lambdaP = $lambda;
    $lambda = $L + (1-$C) * $f * $sinAlpha *($sigma + $C*$sinSigma*($cos2SigmaM+$C*$cosSigma*(-1+2*$cos2SigmaM*$cos2SigmaM)));
  }

  if ($iterLimit == 0) {
    // formula failed to converge
    return NaN;
  }

  $uSq = $cosSqAlpha * ($a*$a - $b*$b) / ($b*$b);
  $A = 1 + $uSq/16384*(4096+$uSq*(-768+$uSq*(320-175*$uSq)));
  $B = $uSq/1024 * (256+$uSq*(-128+$uSq*(74-47*$uSq)));
  $deltaSigma = $B*$sinSigma*($cos2SigmaM+$B/4*($cosSigma*(-1+2*$cos2SigmaM*$cos2SigmaM)- $B/6*$cos2SigmaM*(-3+4*$sinSigma*$sinSigma)*(-3+4*$cos2SigmaM*$cos2SigmaM)));

  return round($b*$A*($sigma-$deltaSigma) / 1000,1);


/* sphere way */
  $distance = rad2deg(acos(sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($lon1 - $lon2))));

  $distance *= 111.18957696; // Convert to km

  return $distance;
}

// 푸시발송 

function gcm_push($title, $body, $regids, $app_id="", $sender_idx="",$url = "") {

		$headers = array(
				"Content-Type:application/json",
				"Authorization:key=AIzaSyDVBgxsv_a-L-F86KNl6hfRNQZKBKIk1NY",
		);
		$arr = array(
				"time_to_live" => 60,
				"content_available" => true,
				"priority" => "high",
				"notification" => array(
					"body" => str_replace(array("\n", "\r", "&nbsp;"), array(" ", "", " "), strip_tags($body)),
					"title" => str_replace(array("\n", "\r", "&nbsp;"), array(" ", "", " "), strip_tags($title)),
					"sound" => "default",
				),
				"data" => array(
						"message" => array(
							"title" => str_replace(array("\n", "\r", "&nbsp;"), array(" ", "", " "), strip_tags($title)),
							"memo" => str_replace(array("\n", "\r", "&nbsp;"), array(" ", "", " "), strip_tags($body)),
						),
						"kapp" => $app_id,
						"regid" => $sender_idx,
				),
				"registration_ids" => array($regids),
		);
		if (!empty($url)) {
			$arr["data"]["url"] = $url;
		}

		/*echo "제목 = ".$title."<br>";
		echo "내용 = ".$body."<br>";
		echo "푸쉬키 = ".$regids."<br>";
		echo "링크 = ".$url."<br>";
		echo "배열값 = ".json_encode($arr)."<br>";*/
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://gcm-http.googleapis.com/gcm/send");
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arr));
		$response = curl_exec($ch);
		if ($response === false) {
			$info = curl_getinfo($ch);
			echo "CURL ERROR: " . var_export($info, true);
		}
		curl_close($ch);
		$fp = @fopen($_SERVER["DOCUMENT_ROOT"] . "/ionemom/m/push/log/" . date("Y-m-d") . ".log", "a");
		if ($fp) {
			@fwrite($fp, date("Y-m-d H:i:s") . " GCM: " . $response . "\n");
			@fclose($fp);
		}
		$obj = json_decode($response);
		
		if (empty($obj)) {
			$cnt = 0;
		} else {
			$cnt = $obj->{"success"};
		}
		
		//echo "발송여부 = ".$cnt."<br><br>";

		return $cnt;
}

function get_star_avg($bbs_code,$target_idx,$bbs_sect){
	$query_star_sub = "select sum(after_point) as after_point from board_content where 1 and bbs_code='".$bbs_code."' and is_del='N'";
	if($target_idx){
		$query_star_sub .= " and product_idx = '".$target_idx."'";
	}
	if($bbs_sect){
		$query_star_sub .= " and bbs_sect='".$bbs_sect."'";
	}
	$result_star_sub = mysqli_query($GLOBALS['gconnet'],$query_star_sub);
	$row_star_sub = mysqli_fetch_array($result_star_sub);

	$query_star_cnt = "select idx from board_content where 1 and bbs_code='".$bbs_code."' and is_del='N'";
	if($target_idx){
		$query_star_cnt .= " and product_idx = '".$target_idx."'";
	}
	if($bbs_sect){
		$query_star_cnt .= " and bbs_sect='".$bbs_sect."'";
	}
	$result_star_cnt = mysqli_query($GLOBALS['gconnet'],$query_star_cnt);
	$num_sub = mysqli_num_rows($result_star_cnt);

	//echo $row_star_sub[after_point]." / ".$num_sub."<br>";

	if($num_sub == 0){
		$avg_star = 0;
	} else {
		$avg_star = round($row_star_sub[after_point]/$num_sub,1);	
	}

	return $avg_star;
}

function get_star_per($bbs_code,$target_idx,$bbs_sect){
	$query_star_sub = "select sum(after_point) as after_point from board_content where 1 and bbs_code='".$bbs_code."' and product_idx = '".$target_idx."' and is_del='N'";
	if($bbs_sect){
		$query_star_sub .= " and bbs_sect='".$bbs_sect."'";
	}
	$result_star_sub = mysqli_query($GLOBALS['gconnet'],$query_star_sub);
	$row_star_sub = mysqli_fetch_array($result_star_sub);

	$query_star_cnt = "select idx from board_content where 1 and bbs_code='".$bbs_code."' and product_idx = '".$target_idx."' and is_del='N'";
	if($bbs_sect){
		$query_star_cnt .= " and bbs_sect='".$bbs_sect."'";
	}
	$result_star_cnt = mysqli_query($GLOBALS['gconnet'],$query_star_cnt);
	$num_sub = mysqli_num_rows($result_star_cnt);

	if($num_sub == 0){
		$avg_star = 0;
	} else {
		$avg_star = round($row_star_sub[after_point]/$num_sub,1);	
	}

	$avg_star = $avg_star*20;
	//echo $avg_star."<br>";
	return $avg_star;
}

function get_star_per_part($bbs_code,$target_idx,$tpart,$tpartcon,$bbs_sect){
	$query_star_sub = "select sum(after_point) as after_point from board_content where 1 and bbs_code='".$bbs_code."' and product_idx = '".$target_idx."' and is_del='N'";
	if($tpart && $tpartcon){
		$query_star_sub .= " and ".$tpart."='".$tpartcon."'";
	}
	if($bbs_sect){
		$query_star_sub .= " and bbs_sect='".$bbs_sect."'";
	}
	$result_star_sub = mysqli_query($GLOBALS['gconnet'],$query_star_sub);
	$row_star_sub = mysqli_fetch_array($result_star_sub);
	
	//echo $query_star_sub."<br>";
	if(mysqli_num_rows($result_star_sub) == 0){
		$num_sub = 0;
	} else {
		if(!$row_star_sub['after_point']){
			$num_sub = 0;
		} else {
			$num_sub = $row_star_sub['after_point'];
		}
	}

	$query_star_cnt = "select sum(after_point) as after_point from board_content where 1 and bbs_code='".$bbs_code."' and product_idx = '".$target_idx."' and is_del='N'";
	if($bbs_sect){
		$query_star_cnt .= " and bbs_sect='".$bbs_sect."'";
	}
	$result_star_cnt = mysqli_query($GLOBALS['gconnet'],$query_star_cnt);
	$row_star_sub_cnt = mysqli_fetch_array($result_star_cnt);

	if(mysqli_num_rows($result_star_cnt) == 0){
		$num_cnt = 0;
	} else {
		if(!$row_star_sub_cnt['after_point']){
			$num_cnt = 0;
		} else {
			$num_cnt = $row_star_sub_cnt['after_point'];
		}
	}

	//echo "분모 = ".$num_cnt."<br>";
	//echo "분자 = ".$num_sub."<br>";

	if($num_cnt == 0){
		$avg_star = 0;
	} else {
		$avg_star = round($num_sub/$num_cnt,1);	
	}
	
	if($tpart == "age"){
		if($avg_star > 0.5){
			$avg_star = 0.5;
		}
	}
	
	if($tpart == "age"){
		$avg_star = $avg_star*50;
	} else {
		$avg_star = $avg_star*100;
	}
	return $avg_star;
}

function get_curl_json_post($url, $data){
    $url = str_replace('}]"}','}]}',$url);
    $data = json_encode($data);
	if($_SERVER['REMOTE_ADDR'] == "121.167.147.150"){
       //echo "url = ".$url."<br>";
       /*echo "data = ".$data."<br>";
       echo "<div style='display:block;'>req: ";
	        print_r($url);
	    echo "</div>";*/
    }
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$ret = curl_exec($ch);
    /*if($_SERVER['REMOTE_ADDR'] == "121.167.147.150"){   
	    echo "<div style='display:block;'>res: ";
	        print_r($ret);
	    echo "</div>";
    }*/
	curl_close($curl);

	return $ret;
}

function get_curl_xml_post($url, $data){
    if($_SERVER['REMOTE_ADDR'] == "121.167.147.150"){
         echo "data = ".$data['q']."<br>";  
    }
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec ($ch);
	curl_close ($curl);
	return $response;
}

function is_mobile(){
	$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
	return true;
else
	return false;
}

//send_fcm("title","message","http://www.naver.com","em7LJgnbK6g:APA91bGVmFkO5ZVSB8hpsz4WzdAQ9EWmFVHVOU-0z5lG6lFkawCcmvqvMTITzNn3BgbrBpW4Y0spwh4eubiKHVcKH9cFmDKp1VdEf4-NF2RExw7-DqNdkHi31YpdhAqqtUc8Y70rwI_N");
//send_fcm(푸시 제목, 푸시 메세지, URL, 푸시받는 회원 푸시키)
function send_fcm($title,$message,$directURL, $id) {
	/*echo "타이틀 = ".$title."<br>";
	echo "메시지 = ".$message."<br>";
	echo "링크 = ".$directURL."<br>";
	echo "수신키 = ".$id."<br>";*/

    $url = 'https://fcm.googleapis.com/fcm/send';

	$headers = array (
        'Authorization: key='.$inc_GOOGLE_SERVER_KEY,
        'Content-Type: application/json'
    );


    $fields = array (
        'data' => array ("url" => $directURL),
        'notification' => array ("title" =>$title,
                                "body" => $message,
                                "sound" => "true")
    );

    if(is_array($id)) {
        $fields['registration_ids'] = $id;
    } else {
        $fields['to'] = $id;
    }

    $fields['priority'] = "high";

    $fields = json_encode ($fields);
    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_POST, true );
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

    $result = curl_exec ( $ch );

    if ($result === FALSE) {
		die('FCM Send Error: ' . curl_error($ch));
    } else {
		echo $result;
	}
    curl_close ( $ch );
    return $result;
}

// 회원사진 이미지 
function get_member_photo($member_idx,$member_type){ 
	$point_sql = "select file_chg from member_info where 1 and idx='".$member_idx."'"; 
	//echo $point_sql."<br>";
	$point_query = mysqli_query($GLOBALS['gconnet'],$point_sql);
	if(mysqli_num_rows($point_query) == 0){
		if($member_type == "PAT"){
			//$default_mem_photo = "/images/80_35.png";
			$default_mem_photo = "/images/icn-user-60.png";
		} elseif($member_type == "GEN"){
			$default_mem_photo = "/images/icn-user-60.png";
		} 
	} else {
		$point_row = mysqli_fetch_array($point_query);
		if(!$point_row['file_chg']){
			if($member_type == "PAT"){
				//$default_mem_photo = "/images/80_35.png";
				$default_mem_photo = "/images/icn-user-60.png";
			} elseif($member_type == "GEN"){
				$default_mem_photo = "/images/icn-user-60.png";
			} 
		} else {
			$default_mem_photo = "/upload_file/member/img_thumb/".$point_row['file_chg'];
		}
	}
	
	return $default_mem_photo;
}

// 광고 이미지 
function get_ad_image($idx,$stype=""){ 
	if($stype == ""){
		//$thumb_f = "img_thumb";	
		$thumb_f = "";	
	} elseif($stype == "2"){
		$thumb_f = "img_thumb2";	
	} elseif($stype == "3"){
		$thumb_f = "img_thumb3";	
	}
		
	$point_sql = "select file_chg from board_file where 1 and board_tbname='ad_info' and board_code='photo' and board_idx='".$idx."' order by idx asc limit 0,1"; 
	$point_query = mysqli_query($GLOBALS['gconnet'],$point_sql);
	if(mysqli_num_rows($point_query) == 0){
		$default_mem_photo = "";
	} else {
		$point_row = mysqli_fetch_array($point_query);
		if(!$point_row['file_chg']){
			$default_mem_photo = "";
		} else {
			if($stype == ""){
				$default_mem_photo = "/upload_file/ad_info/".$point_row['file_chg'];
			} else {
				$default_mem_photo = "/upload_file/ad_info/".$thumb_f."/".$point_row['file_chg'];
			}
		}
	}
	
	return $default_mem_photo;
}

// 체험 이미지 
function get_exp_image($idx,$column="",$stype=""){ 
	if($stype == ""){
		$thumb_f = "img_thumb";	
	} elseif($stype == "2"){
		$thumb_f = "img_thumb2";	
	} elseif($stype == "3"){
		$thumb_f = "img_thumb3";	
	}

	if($column == ""){
		$column = "file_chg";
	}

	$point_sql = "select ".$column." from exp_info where 1 and idx='".$idx."'"; 
	$point_query = mysqli_query($GLOBALS['gconnet'],$point_sql);
	if(mysqli_num_rows($point_query) == 0){
		$default_mem_photo = "";
	} else {
		$point_row = mysqli_fetch_array($point_query);
		if(!$point_row[$column]){
			$default_mem_photo = "";
		} else {
			$default_mem_photo = "/upload_file/expinfo/".$thumb_f."/".$point_row[$column];
		}
	}
	
	return $default_mem_photo;
}

// 상품 이미지 
function get_shp_image($idx,$column="",$stype=""){ 
	if($stype == ""){
		$thumb_f = "img_thumb";	
	} elseif($stype == "2"){
		$thumb_f = "img_thumb2";	
	} elseif($stype == "3"){
		$thumb_f = "img_thumb3";	
	}

	if($column == ""){
		$column = "file_c";
	}

	$point_sql = "select ".$column.",member_idx from product_info where 1 and idx='".$idx."'"; 
	$point_query = mysqli_query($GLOBALS['gconnet'],$point_sql);
	if(mysqli_num_rows($point_query) == 0){
		$default_mem_photo = "";
	} else {
		$point_row = mysqli_fetch_array($point_query);

		if(member_type($point_row[member_idx]) == "AD"){
			$mem_path = "coinc";
		} else {
			$mem_path = member_id($point_row[member_idx]);
		}

		if(!$point_row[$column]){
			$default_mem_photo = "";
		} else {
			$default_mem_photo = "/upload_file/product/".$mem_path."/".$thumb_f."/".$point_row[$column];
		}
	}
	
	return $default_mem_photo;
}

function get_new_product_code(){
	$code = "";
	$query = "select pro_code from product_info order by pro_code desc limit 0, 1";
	if($result = mysqli_query($GLOBALS['gconnet'],$query)){
		if($row = mysqli_fetch_assoc($result)){
			$pro_code = $row["pro_code"];
			$num = substr($pro_code, 1, 5);
			$num = (int)$num + 1;
			$code = "P".sprintf("%05d", $num);
		}
	}

	return $code;
}

function member_type($member_idx) { 
	$sql = "select member_type from member_info where 1 and idx='".$member_idx."'";
	$query = mysqli_query($GLOBALS['gconnet'],$sql);
	$row = mysqli_fetch_array($query);
	$goodcd = $row[member_type];
	return $goodcd;
} 

function member_email($member_idx) { 
	$sql = "select email from member_info where 1 and idx='".$member_idx."'";
	$query = mysqli_query($GLOBALS['gconnet'],$sql);
	$row = mysqli_fetch_array($query);
	$goodcd = $row[email];
	return $goodcd;
} 

function member_id($member_idx) { 
	$sql = "select user_id from member_info where 1 and idx='".$member_idx."'";
	//echo $sql."<br>";
	$query = mysqli_query($GLOBALS['gconnet'],$sql);
	$row = mysqli_fetch_array($query);
	$goodcd = $row[user_id];
	return $goodcd;
}

function member_idx($member_id) { 
	$sql = "select idx from member_info where 1 and user_id='".$member_id."'";
	$query = mysqli_query($GLOBALS['gconnet'],$sql);
	$row = mysqli_fetch_array($query);
	$goodcd = $row[idx];
	return $goodcd;
} 

function member_idx_code($member_code) { 
	$sql = "select idx from member_info where 1 and member_code='".$member_code."'";
	$query = mysqli_query($GLOBALS['gconnet'],$sql);
	$row = mysqli_fetch_array($query);
	$goodcd = $row[idx];
	return $goodcd;
} 

function product_idx_code($product_code) { 
	$sql = "select idx from product_info where 1 and pro_code='".$product_code."' and is_del='N'";
	$query = mysqli_query($GLOBALS['gconnet'],$sql);
	$row = mysqli_fetch_array($query);
	$goodcd = $row[idx];
	return $goodcd;
} 

function package_idx_code($package_code) { 
	$sql = "select idx from package_info where 1 and pro_code='".$package_code."' and is_del='N'";
	$query = mysqli_query($GLOBALS['gconnet'],$sql);
	$row = mysqli_fetch_array($query);
	$goodcd = $row[idx];
	return $goodcd;
} 

function get_member_data($member_idx,$col) { 
	$sql = "select ".$col." as m_data from member_info where 1 and idx='".$member_idx."'";
	$query = mysqli_query($GLOBALS['gconnet'],$sql);
	$row = mysqli_fetch_array($query);
	$goodcd = $row['m_data'];
	return $goodcd;
} 
############### 중복클릭 혹은 새로고침시 조회수 증가방지 ###################
function set_vcnt_up($tbname,$code="",$idx,$wmidx,$lmidx,$targettb,$targetclm){
	//if($lmidx && ($lmidx != $wmidx)){ // 작성자 본인이 열람하는것이 아닐때 시작
		
		$sql_prev = "select idx from board_view_cnt where 1 and board_tbname='".$tbname."'";
		if($code){
			$sql_prev .= " and board_code = '".$code."'";
		}
		$sql_prev .= " and board_idx='".$idx."' and member_idx = '".$lmidx."' ";
		$query_prev = mysqli_query($GLOBALS['gconnet'],$sql_prev);
		$cnt_prev = mysqli_num_rows($query_prev);

		//if($cnt_prev == 0){ // 현 게시물을 처음 볼때 한해서 조회수를 증가시킨다 시작 
			
			$query_view_cnt = " insert into board_view_cnt set "; 
			$query_view_cnt .= " board_tbname = '".$tbname."', ";
			$query_view_cnt .= " board_code = '".$code."', ";
			$query_view_cnt .= " board_idx = '".$idx."', ";
			$query_view_cnt .= " member_idx = '".$lmidx."', ";
			$query_view_cnt .= " cnt = '1', ";
			$query_view_cnt .= " wdate = now() ";
			$result_view_cnt = mysqli_query($GLOBALS['gconnet'],$query_view_cnt);

			$sql_cnt = "update ".$targettb." set ".$targetclm."=".$targetclm."+1 where 1 and idx = '".$idx."'";
			$query_cnt = mysqli_query($GLOBALS['gconnet'],$sql_cnt);
	
		//} // 현 게시물을 처음 볼때 한해서 조회수를 증가시킨다 종료 

	//}  // 작성자 본인이 열람하는것이 아닐때 종료
}

############### 조회수 가져오기 ###################
function get_vcnt($tbname,$code="",$idx){
	$current_cnt_query = "select sum(cnt) as current_cnt from board_view_cnt where 1 and board_tbname='".$tbname."'";
	if($code){
		$current_cnt_query .= " and board_code = '".$code."'";
	}
	$current_cnt_query .= " and board_idx='".$idx."'";
	$current_cnt_result = mysqli_query($GLOBALS['gconnet'],$current_cnt_query);
	$current_cnt_row = mysqli_fetch_array($current_cnt_result);

	if ($current_cnt_row['current_cnt']){
		$current_cnt = $current_cnt_row['current_cnt'];
	} else{
		$current_cnt = 0;
	}
	
	return $current_cnt;
}
########## 회원의 현재 코인 추출하기 ###########
function mem_current_point($member_idx){
	$point_sect = "refund"; // 적립금 

	$sql_sub1 = "select cur_mile from member_point where member_idx='".$member_idx."' and point_sect='".$point_sect."' and mile_sect != 'P' order by idx desc limit 0,1 "; 
	$query_sub1 = mysqli_query($GLOBALS['gconnet'],$sql_sub1);
					
	if(mysqli_num_rows($query_sub1)==0) {
		$mile_pre = 0; 
	} else {
		$row_sub1 = mysqli_fetch_array($query_sub1); 
		$mile_pre = $row_sub1[cur_mile];
	}

	return $mile_pre;
}
########## 회원의 현재 코인순위 추출하기 ###########
function mem_point_ranking($member_idx){

	$mem_current_point = mem_current_point($member_idx);

	$sql_sub1 = "select idx,(select cast(cur_mile as unsigned) from member_point where member_idx=member_info.idx and point_sect='refund' and mile_sect != 'P' order by idx desc limit 0,1) as cur_coin from member_info where 1 and member_type = 'GEN' and memout_yn != 'Y' and memout_yn != 'S' and (select cast(cur_mile as unsigned) as cur_coin from member_point where member_idx=member_info.idx and point_sect='refund' and mile_sect != 'P' order by idx desc limit 0,1) >= '".$mem_current_point."' and idx != '".$member_idx."'"; 
	$query_sub1 = mysqli_query($GLOBALS['gconnet'],$sql_sub1);
					
	$mile_pre = mysqli_num_rows($query_sub1)+1; 
	return $mile_pre;
}
############### 코인 적립/차감하기 ###################
function coin_plus_minus($point_sect,$member_idx,$mile_sect,$chg_mile,$mile_title,$order_num="",$pay_price="",$ad_sect=""){
	
	//echo "변동되는 값 = ".$chg_mile."<br>";

	if($chg_mile > 0 ){

		$mile_pre = mem_current_point($member_idx); // 현재 적립금 금액
		
		if($mile_sect == "A"){
			$cur_mile = $mile_pre+$chg_mile;
		} elseif($mile_sect == "M"){
			$cur_mile = $mile_pre-$chg_mile;
		}

		if($cur_mile < 0){
			$cur_mile = 0;
		}
	
		$query_mile = " insert into member_point set "; 
		$query_mile .= " order_num = '".$order_num."', ";
		$query_mile .= " member_idx = '".$member_idx."', ";
		$query_mile .= " pay_price = '".$pay_price."', ";
		$query_mile .= " mile_title = '".$mile_title."', ";
		$query_mile .= " mile_sect = '".$mile_sect."', ";
		$query_mile .= " mile_pre = '".$mile_pre."', ";
		$query_mile .= " chg_mile = '".$chg_mile."', ";
		$query_mile .= " cur_mile = '".$cur_mile."', ";
		$query_mile .= " point_sect = '".$point_sect."', ";
		$query_mile .= " ad_sect = '".$ad_sect."', ";
		$query_mile .= " wdate = now() ";
		//echo $query_mile."<br>";
		$result_mile = mysqli_query($GLOBALS['gconnet'],$query_mile);

	}
}

############### 좋아요 클릭 수 가져오기 ###################
function get_cnt_zzim($tbname,$tcode="",$tidx,$member_idx="",$abs=""){
	$current_cnt_query = "select idx from board_reco_cnt where 1 and board_tbname='".$tbname."' and board_idx='".$tidx."'";
	if($tcode){
		$current_cnt_query .= " and board_code='".$tcode."'";
	}
	if($abs == "Y"){
		$current_cnt_query .= " and member_idx = '".$member_idx."'";
	} else {
		if($member_idx){
			$current_cnt_query .= " and member_idx = '".$member_idx."'";
		}
	}
	//echo $current_cnt_query."<br>";
	$current_cnt_result = mysqli_query($GLOBALS['gconnet'],$current_cnt_query);
	$current_cnt = mysqli_num_rows($current_cnt_result);
	
	return $current_cnt;
}

############### 댓글 수 가져오기 ###################
function get_cnt_comment($tbname,$tcode="",$tidx,$member_idx=""){
	$current_cnt_query = "select idx from board_comment where 1 and board_tbname='".$tbname."' and board_idx='".$tidx."'";
	if($tcode){
		$current_cnt_query .= " and board_code='".$tcode."'";
	}
	if($member_idx){
		$current_cnt_query .= " and member_idx = '".$member_idx."'";
	}
	//echo $current_cnt_query."<br>";
	$current_cnt_result = mysqli_query($GLOBALS['gconnet'],$current_cnt_query);
	$current_cnt = mysqli_num_rows($current_cnt_result);
	
	return $current_cnt;
}

############### 공유하기 횟수 가져오기 ###################
function get_cnt_share($tbname,$tcode="",$tidx,$member_idx=""){
	$current_cnt_query = "select idx from share_history where 1 and share_sect='".$tbname."' and share_idx='".$tidx."'";
	if($tcode){
		$current_cnt_query .= " and share_type = '".$tcode."'";
	}
	if($member_idx){
		$current_cnt_query .= " and member_idx = '".$member_idx."'";
	}
	$current_cnt_result = mysqli_query($GLOBALS['gconnet'],$current_cnt_query);
	$current_cnt = mysqli_num_rows($current_cnt_result);
	
	return $current_cnt;
}

############### 광고영상 플레시 횟수 가져오기 ###################
function get_cnt_conf($tbname,$tcode="",$tidx,$member_idx=""){
	$current_cnt_query = "select idx from board_view_conf where 1 and board_tbname='".$tbname."' and board_idx='".$tidx."'";
	if($tcode){
		$current_cnt_query .= " and board_code='".$tcode."'";
	}
	if($member_idx){
		$current_cnt_query .= " and member_idx = '".$member_idx."'";
	}
	//echo $current_cnt_query;
	$current_cnt_result = mysqli_query($GLOBALS['gconnet'],$current_cnt_query);
	$current_cnt = mysqli_num_rows($current_cnt_result);
	
	return $current_cnt;
}

########### 주문번호 만들기 
function make_order_num($order_gift_yn=""){
	$next_order_num = "";
    $today =  date("Y-m-d");
    $today2 =  date("Ymd");

	if(!$order_gift_yn){
		$tb_name = "order_member";
	} else {
		$tb_name = $order_gift_yn;
	}
	
    $query = "select order_num from ".$tb_name." where 1 and substring(order_num,1,8) = '".$today2."' order by idx desc limit 0, 1";
	
	//echo $query."<br>"; //exit;
    
	if($result = mysqli_query($GLOBALS['gconnet'],$query)){
		if(mysqli_num_rows($result)){
			if($row = mysqli_fetch_assoc($result)){
				$order_num = $row["order_num"];
                $order_num = str_replace("coinc","",$order_num);
				$order_num = str_replace("-","",$order_num);
				$date = substr($order_num, 0, 8);
				$seq = (int)substr($order_num, 8, 4);
				$seq++;
                $next_order_num = $date.sprintf("%04d", $seq);
			}
		}else{
			$next_order_num = $today2."0001";
		}
	}
   
    return $next_order_num;
}

############### 체험 참여여부 확인 ###################
function get_expregi_yn($exp_info_idx,$member_idx){
	$current_cnt_query = "select idx from exp_info_regist where 1 and exp_info_idx = '".$exp_info_idx."' and member_idx = '".$member_idx."' and order_stat in ('com')";
	//echo $current_cnt_query."<br>";
	$current_cnt_result = mysqli_query($GLOBALS['gconnet'],$current_cnt_query);
	$current_cnt = mysqli_num_rows($current_cnt_result);
	
	return $current_cnt;
}

############# 쇼핑몰 배송비 추출하기 #################
function get_delivery_cost2($product_price){
	$query = "select * from delivery_set where 1";
	if($result = mysqli_query($GLOBALS['gconnet'],$query)){
		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);
			$set_price1 = (int)$row["set_price1"]; //무료배송 기준가격
		}else{
			return false;
		}
	}else{
		return false;
	}

	if($product_price >= $set_price1){
		$bprice = 0;
	} else {
		$bprice = (int)$row["set_price4"];
	}

	return $bprice;
}

function get_extra_delivery_cost($send_addr1){
	$addition = 0;
	if($send_addr1){
		$query = "select * from delivery_charge";
		if($result = mysqli_query($GLOBALS['gconnet'],$query)){
			while($row = mysqli_fetch_array($result)){
				if(strpos($send_addr1, $row["address"]) !== false){
					$addition = (int)$row["charge"];
					break;
				}
			}
		}else{
			return false;
		}
	}

	return $addition;
}

function get_default_delivery_cost(){
	$cost = false;

	$query = "select * from delivery_set where idx = 1";
	if($result = mysqli_query($GLOBALS['gconnet'],$query)){
		if($row = mysqli_fetch_assoc($result)){
			$cost = (int)$row["set_price4"];
		}
	}

	return $cost;
}

function get_default_max_delivery_cost(){
	$cost = false;

	$query = "select * from delivery_set where idx = 1";
	if($result = mysqli_query($GLOBALS['gconnet'],$query)){
		if($row = mysqli_fetch_assoc($result)){
			$cost = (int)$row["set_price1"];
		}
	}

	return $cost;
}

function get_delivery_cost_txt($delivery_cost){
	if($delivery_cost > 0){
		$cost = number_format($delivery_cost);
	} else {
		$cost = "무료배송";
	}
	return $cost;
}

############### 배송 교환 반품안내 가져오기 ###################
function get_delv_guide($member_idx,$cate_code1){
	$current_cnt_query = "select content from delv_guide where 1";
	if($member_idx){
		$current_cnt_query .= " and member_idx = '".$member_idx."'";
	}
	if($member_idx){
		$current_cnt_query .= " and cate_code1 = '".$cate_code1."'";
	}
	$current_cnt_query .= " order by idx desc limit 0,1";
	//echo $current_cnt_query."<br>";
	$current_cnt_result = mysqli_query($GLOBALS['gconnet'],$current_cnt_query);
	$row = mysqli_fetch_array($current_cnt_result);
	$current_cnt = $row[content];
	
	return $current_cnt;
}

function get_exp_tcolor($tcode){
	switch ($tcode) {
		case "1" : 
		$text_color = "#FFFFFF";
		break;
		case "2" : 
		$text_color = "#000000";
		break;
		case "3" : 
		$text_color = "#848484";
		break;
		case "4" : 
		$text_color = "#FF0000";
		break;
	}
	
	return $text_color;
}

######### 상품가격 가져오기 ######################## 
function product_price($product_idx,$member_idx) {
	//echo "회원등급 = ".$member_idx."<br>";
	$pro_sql = "select pro_price1,orgin,total_price from product_info where 1 and idx='".$product_idx."' ";
	$pro_query = mysqli_query($GLOBALS['gconnet'],$pro_sql);
	$pro_row = mysqli_fetch_array($pro_query);
	
    if($member_idx){
	   if($pro_row[orgin]){
		    $product_price = 0;
	    } else {
            $product_price = $pro_row[pro_price1];
        }
    } else {
        $product_price = "";
    }
	return $product_price;
}

function product_price_txt($product_idx,$member_idx) {
    //echo "회원등급 = ".$member_idx."<br>";
	$pro_sql = "select pro_price1,orgin,total_price from product_info where 1 and idx='".$product_idx."' ";
	//echo $pro_sql;
	$pro_query = mysqli_query($GLOBALS['gconnet'],$pro_sql);
	$pro_row = mysqli_fetch_array($pro_query);
	
    if($member_idx){
	    if($pro_row[orgin]){
		    $product_price = $pro_row[orgin];
	    } else {
            $product_price = number_format($pro_row[pro_price1],0);
	    }
    } else {
      $product_price = "";
    }
	return $product_price;
}

function mem_pro_buy($member_idx,$product_idx) {
	$orderd_sql = "select max(p_cnt) as p_cnt_t from order_product where 1 and product_idx='".$product_idx."' and member_idx='".$member_idx."' and orderstat in ('com','pre')";
	$orderd_query = mysqli_query($GLOBALS['gconnet'],$orderd_sql);
	$orderd_row = mysqli_fetch_array($orderd_query);
	if(!$orderd_row['p_cnt_t']){
		$orderd_num = 0;
	} else {
		$orderd_num = $orderd_row['p_cnt_t'];
	}
	return $orderd_num;
}

function get_amount_error($product_idx, $amount){
	$product_idx = (int)$product_idx;
	$amount = (int)$amount;

	$query = "select pro_cnt, buy_min_cnt, buy_max_cnt from product_info where idx = ".$product_idx." and use_ok = 'Y'";
	if($result = mysqli_query($GLOBALS['gconnet'],$query)){
		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			$pro_cnt = (int)$row["pro_cnt"];
			$buy_min_cnt = (int)$row["buy_min_cnt"];
			$buy_max_cnt = (int)$row["buy_max_cnt"];

			if($pro_cnt == 0 || $pro_cnt < $buy_min_cnt){
				return "선택하신 상품은 현재 재고가 없어 주문하실수 없습니다.";
			}

			if($amount > $pro_cnt){
				return "주문수량이 재고수량보다 많습니다.";
			}

			/*if($amount < $buy_min_cnt){
				return "선택하신 상품은 최소 ".$buy_min_cnt." 개 이상 주문하셔야 합니다.";
			}

			if($amount > $buy_max_cnt){
				return "선택하신 상품은 최대 ".$buy_max_cnt." 개 까지만 주문하실수 있습니다.";
			}*/
		}else{
			return "데이터가 존재하지 않습니다.";
		}
	}else{
		return "데이터를 불러올 수 없습니다.";
	}
}

function clean_ordering(){
	//$query = "select idx, order_num from order_member where orderstat = 'ordering' and order_date < '".date("Y-m-d H:i:s", time()-12*60*60)."'";
    $query = "select idx, order_num from order_member where orderstat = 'ordering' and order_date < '".date("Y-m-d H:i:s", time()-60*60)."'";
	if($result = mysqli_query($GLOBALS['gconnet'],$query)){
		while($row = mysqli_fetch_array($result)){
			increase_cancelled_product_stock($row["order_num"]);

			$query2 = "delete from order_product where order_num = '".$row["order_num"]."'";
			@mysqli_query($GLOBALS['gconnet'],$query2);

			$query2 = "delete from order_member where idx = ".$row["idx"];
			@mysqli_query($GLOBALS['gconnet'],$query2);
		}
	}
}

function increase_cancelled_product_stock($order_num){
	$ret = false;
	$i = 0;

	$query = "select p_cnt, product_idx from order_product where order_num = '".$order_num."'";
	if($result = mysqli_query($GLOBALS['gconnet'],$query)){
		$cnt = mysqli_num_rows($result);
		while($row = mysqli_fetch_assoc($result)){
			//echo $row["product_idx"].", ".$row["p_cnt"]."<br />";
			if(increase_product_stock($row["product_idx"], $row["p_cnt"])){
				$i++;
			}
		}
		if($cnt == $i){
			$ret = true;
		}
	}

	return $ret;
}

function increase_product_stock($idx, $cnt){
	$ret = false;
	$query = "update product_info set pro_cnt = pro_cnt + ".$cnt." where idx = ".$idx;
    //echo $query."<br>";
	if($result = mysqli_query($GLOBALS['gconnet'],$query)){
		//if(mysqli_affected_rows()){
			$ret = true;
		//}
	}

	return $ret;
}

function decrease_product_stock($idx, $cnt){
	$ret = false;

	$query = "select pro_cnt from product_info where idx = ".$idx;
	if($result = mysqli_query($GLOBALS['gconnet'],$query)){
		if($row = mysqli_fetch_assoc($result)){
			if((int)$row["pro_cnt"] >= (int)$cnt){
				$query = "update product_info set pro_cnt = pro_cnt - ".$cnt." where idx = ".$idx;
				if($result = mysqli_query($GLOBALS['gconnet'],$query)){
					//if(mysqli_affected_rows()){
						$ret = true;
					//}
				}
			}
		}
	}

	return $ret;
}

/* 주문 */
function get_payment_method($option){
	$name = "";

	if ($option == "card_isp"){
		$name = "신용카드";
	} elseif ($option == "bank_iche"){
		$name = "계좌이체";
	} elseif ($option == "pay_virt"){
		$name = "가상계좌";
	} elseif ($option == "handphone"){
		$name = "휴대폰결제";
	} elseif ($option == "refund"){
		$name = "적립금결제";
	}

	return $name;
}

function get_card_name($code){
	switch($code){
		case "01": $name = "외환"; break;
		case "03": $name = "롯데"; break;
		case "04": $name = "현대"; break;
		case "06": $name = "국민"; break;
		case "11": $name = "BC"; break;
		case "12": $name = "삼성"; break;
		case "13": $name = "LG"; break;
		case "14": $name = "신한"; break;
		case "15": $name = "한미"; break;
		case "16": $name = "NH"; break;
		case "17": $name = "하나 SK"; break;
		case "21": $name = "해외비자"; break;
		case "22": $name = "해외마스터"; break;
		case "23": $name = "JCB"; break;
		case "24": $name = "해외아멕스"; break;
		case "25": $name = "해외다이너스"; break;
		default: $name = "";
	}

	return $name;
}

function get_bank_name_code($code){
	switch($code){
		case "03": $name = "기업은행"; break;
		case "04": $name = "국민은행"; break;
		case "05": $name = "하나은행(구 외환)"; break;
		case "07": $name = "수협중앙회"; break;
		case "11": $name = "농협중앙회"; break;
		case "20": $name = "우리은행"; break;
		case "23": $name = "SC제일은행"; break;
		case "31": $name = "대구은행"; break;
		case "32": $name = "부산은행"; break;
		case "34": $name = "광주은행"; break;
		case "37": $name = "전북은행"; break;
		case "39": $name = "경남은행"; break;
		case "53": $name = "한국씨티은행"; break;
		case "71": $name = "우체국"; break;
		case "81": $name = "하나은행"; break;
		case "88": $name = "통합신항은행(신한, 조흥은행)"; break;
		case "D1": $name = "유안타증권(구 동양증권)"; break;
		case "D2": $name = "현대증권"; break;
		case "D3": $name = "미래에셋증권"; break;
		case "D4": $name = "한국투자증권"; break;
		case "D5": $name = "우리투자증권"; break;
		case "D6": $name = "하이투자증권"; break;
		case "D7": $name = "HMC투자증권"; break;
		case "D8": $name = "SK증권"; break;
		case "D9": $name = "대신증권"; break;
		case "DA": $name = "하나대투증권"; break;
		case "DB": $name = "굿모닝신한증권"; break;
		case "DC": $name = "동부증권"; break;
		case "DD": $name = "유진투자증권"; break;
		case "DE": $name = "메리츠증권"; break;
		case "DF": $name = "신영증권"; break;
		case "27": $name = "한국씨티은행(한미은행)"; break;
		default: $name = "";
	}

	return $name;
    //return $code;
}

function get_order_status($status){
	$name = "";

	switch ($status) {
		case "pre" : 
		$name = "입금대기";
		break;

		case "com" : 
		$name = "입금완료";
		break;

		case "can" : 
		$name = "취소완료";
		break;

		case "reing" : 
		$name = "취소신청";
		break;
	}

	return $name;
}

function get_member_price_name($user_grade){
	/*switch($user_grade){
		//서포터즈
		case "700002":
			$name = "pro_price2";
			break;
		//가맹점
		case "700003":
			$name = "pro_price3";
			break;
		//딜러
		case "700004":
			$name = "pro_price4";
			break;
		//일반
		case "700001":
		//비회원
		default:
			$name = "pro_price1";
	}*/
	$name = "pro_price1";
	return $name;
}

function get_member_salepoint_name($user_grade){
	/*switch($user_grade){
		//일반회원
		case "10":
			$name = "pro_salepoint1";
			break;
		//미콘통회원
		case "20":
			//$name = "pro_salepoint2";
			$name = "pro_salepoint1";
			break;
	}*/

	if($user_grade == "10"){ // 일반회원
		$name = "pro_salepoint1";
	} elseif($user_grade >= "20"){ // 미콘통 회원
		//$name = "pro_salepoint2";
		$name = "pro_salepoint1";
	}
	//echo "name = ".$name;

	return $name;
}

function is_fdelv_product($pro_idx){ 
	$sql = "select idx FROM product_display_set where 1 and banner_type='nodev' and pro_idx = '".$pro_idx."'";
	$query = mysqli_query($GLOBALS['gconnet'],$sql);
	$cnt = mysqli_num_rows($query);
	return $cnt;
}

function fetch_promotion($product_idx){
	/*$row = false;

	$query = "select * from promotion_product where product_idx = '".$product_idx."'";
	if($result = mysqli_query($GLOBALS['gconnet'],$query)){
		$row = mysqli_fetch_assoc($result);
	}

	return $row;*/
}

function belong_cate1($product_idx, $cate_code1){
	/*$ret = false;

	$query = "select count(idx) from product_category_set where product_idx = '".$product_idx."' and cate_code1 = '".$cate_code1."'";
	if($result = mysqli_query($GLOBALS['gconnet'],$query)){
		if($row = mysqli_fetch_row($result)){
			if($row[0] > 0){
				$ret = true;
			}
		}
	}

	return $ret;*/
}


/* 문자처리 */
function addslashes_array($arr, $gpc=true){
	if($gpc){
		if(get_magic_quotes_gpc()){
			return $arr;
		}
	}

	if(is_array($arr)){
		foreach($arr as &$val1){
			if(is_array($val1)){
				foreach($val1 as &$val2){
					$val2 = addslashes($val2);
				}
			}else{
				$val1 = addslashes($val1);
			}
		}
	}else{
		$arr = addslashes($arr);
	}

	return $arr;
}

function trim_array($arr){
	if(is_array($arr)){
		foreach($arr as &$val1){
			if(is_array($val1)){
				foreach($val1 as &$val2){
					$val2 = trim($val2);
				}
			}else{
				$val1 = trim($val1);
			}
		}
	}else{
		$arr = trim($arr);
	}

	return $arr;
}

function htmlspecialchars_array($arr){
	if(is_array($arr)){
		foreach($arr as &$val1){
			if(is_array($val1)){
				foreach($val1 as &$val2){
					$val2 = htmlspecialchars($val2);
				}
			}else{
				$val1 = htmlspecialchars($val1);
			}
		}
	}else{
		$arr = htmlspecialchars($arr);
	}

	return $arr;
}

function randomize_characters($digit){
	$str = "";

	if(is_numeric($digit)){
		for($i=0; $i<$digit; $i++){
			$rand1 = rand(0, 1);
			if($rand1 == 0){
				$rand2 = rand(0, 9);
				$str .= $rand2;
			}else if($rand1 == 1){
				$rand2 = rand(97, 122);
				$str .= chr($rand2);
			}
		}
	}

	return $str;
}

function stripslashes_array($arr){
	if(is_array($arr)){
		foreach($arr as &$val1){
			if(is_array($val1)){
				foreach($val1 as &$val2){
					$val2 = stripslashes($val2);
				}
			}else{
				$val1 = stripslashes($val1);
			}
		}
	}else{
		$arr = stripslashes($arr);
	}

	return $arr;
}

/* 상품 */
function fetch_product($column, $where, $groupby, $orderby, $limit){
	$idx = (int)$idx;

	$query = "select ".$column." from product_info";
	if($where){
		$query .= " where ".$where;
	}

     //$query .= " and (case when category2 = 'C0511' then total_price <=  30000 else idx > 0 end) and (case when category2 = 'C0511' then end_date >= '".date("Ymd")."' else period_end > '".date("Ymd")."' end) ";

	 $query .= " and (case when cate_code2 = 'C0511' then total_price <=  30000 else idx > 0 end) ";

	if($groupby){
		$query .= " group by ".$groupby;
	}
    if($orderby){
		$query .= " order by ".$orderby;
	}
	if($limit){
		$query .= " limit ".$limit;
	}

    if($_SERVER['REMOTE_ADDR'] == "121.167.147.150"){
	    //echo $query;
    }

	if($result = mysqli_query($GLOBALS['gconnet'],$query)){
		$row = mysqli_fetch_array($result);
		return $row;
	}

	//echo $query."<br><br>";

    return false;
}

function fetch_products($column, $where, $groupby="", $orderby="", $limit=""){
	//$rows = array();

	$query = "select ".$column." from product_info where 1 ";
	if($where){
		$query .= $where;
	}
	if($groupby){
		$query .= " group by ".$groupby;
	}
	if($orderby){
		$query .= " order by ".$orderby;
	}
	if($limit){
		$query .= " limit ".$limit;
	}
	//debugging_html($query);
	
	/*if($result = mysqli_query($GLOBALS['gconnet'],$query)){
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
	}
	return $rows;*/

	$result = mysqli_query($GLOBALS['gconnet'],$query);
	$row = mysqli_fetch_array($result);
	return $row[''.$column.''];
}

function get_local_datetime($datetime, $format){
	/*$arr = explode(" ", $datetime);
	$date = explode("-", $arr[0]);
	$time = explode(":", $arr[1]);
	$t = mktime($time[0], $time[1], $time[2], $date[1], $date[2], $date[0]) + (9 * 60 * 60);
	return date($format, $t);*/
    return $datetime;
}

function get_gtc_datetime($datetime, $format){
	/*$arr = explode(" ", $datetime);
	$date = explode("-", $arr[0]);
	$time = explode(":", $arr[1]);
	$t = mktime($time[0], $time[1], $time[2], $date[1], $date[2], $date[0]) - (9 * 60 * 60);
	return date($format, $t);*/
    return $datetime;
}

function get_yakkwan($cate_code1){
	$current_cnt_query = "select content from delv_guide where 1";
	if($cate_code1){
		$current_cnt_query .= " and cate_code1 = '".$cate_code1."'";
	}
	$current_cnt_query .= " order by idx desc limit 0,1";
	$current_cnt_result = mysqli_query($GLOBALS['gconnet'],$current_cnt_query);
	$row = mysqli_fetch_array($current_cnt_result);
	$current_cnt = $row[content];
	
	return $current_cnt;
}

function get_yakkwan_img($cate_code1){
	$current_cnt_query = "select idx from delv_guide where 1";
	if($cate_code1){
		$current_cnt_query .= " and cate_code1 = '".$cate_code1."'";
	}
	$current_cnt_query .= " order by idx desc limit 0,1";
	$current_cnt_result = mysqli_query($GLOBALS['gconnet'],$current_cnt_query);
	$row = mysqli_fetch_array($current_cnt_result);
	$current_cnt = $row[idx];

	$sql_file = "select file_chg from board_file where 1=1 and board_tbname='delv_guide' and board_code = '".$cate_code1."' and board_idx='".$current_cnt."' order by idx desc limit 0,1";
	$query_file = mysqli_query($GLOBALS['gconnet'],$sql_file);
	$row_file = mysqli_fetch_array($query_file);
	
	return $row_file['file_chg'];
}

function get_member_level($member_idx) { 
	$sql = "select user_level from member_info where 1 and idx='".$member_idx."'";
	$query = mysqli_query($GLOBALS['gconnet'],$sql);
	$row = mysqli_fetch_array($query);
	$goodcd = $row[user_level];
	return $goodcd;
}

function get_star_myavg($bbs_code,$target_idx,$bbs_sect){
	$query_star_sub = "select sum(after_point) as after_point from board_content where 1 and bbs_code='".$bbs_code."' and is_del='N'";
	if($target_idx){
		$query_star_sub .= " and product_idx in (select idx from ad_info where 1 and member_idx = '".$target_idx."' and is_del = 'N' and view_ok = 'Y')";
	}
	if($bbs_sect){
		$query_star_sub .= " and bbs_sect='".$bbs_sect."'";
	}
	$result_star_sub = mysqli_query($GLOBALS['gconnet'],$query_star_sub);
	$row_star_sub = mysqli_fetch_array($result_star_sub);

	$avg_star = $row_star_sub[after_point];	

	return $avg_star;
}


function get_auth_yn($member_idx){
	$sql = "select auth_type from member_info where 1 and idx = '".$member_idx."'";
	$query = mysqli_query($GLOBALS['gconnet'],$sql);
	$row = mysqli_fetch_array($query);
	
	if($row['auth_type'] == "cell"){
		return "Y";
	} else {
		return "N";
	}
}

function get_after_cnt($ad_idx){ 
	$sql = "select idx from board_content where 1 and bbs_code = 'adreview' and product_idx='".$ad_idx."' and is_del='N'";
	$query = mysqli_query($GLOBALS['gconnet'],$sql);
	return mysqli_num_rows($query);
}

function get_mobile_content($content){
	$p_memo = preg_replace("/ style=(\"|\')?([^\"\']+)(\"|\')?/","",$content);
	$p_memo = preg_replace("/ style=([^\"\']+) /"," ",$p_memo); 
	$p_memo = str_replace("<img","<img style='max-width:90%;'",$p_memo);
	$p_memo = str_replace("<p>","<p class='txt'>",$p_memo);

	return $p_memo;
}

//퍼센트 함수
function fnPercent($range, $total, $slice)
{
	if($total == 0)$total = 1; //Division by zero 에러방지

	$result;

	if($range == "totalPer" || $range == "total"){
		//n = 전체값 * 퍼센트 / 100;
		$result = ($total * $slice) / 100;
		return round($result);
	}else{
		//n% = 일부값 / 전체값 * 100;
		$result = ($slice / $total) * 100;
		return number_format($result, 2, '.', '');
	}
}

function get_payed_tcnt($ticket_idx){
	$sql = "select sum(pay_cnt) as saled_cnt from ticket_payment_info where 1 and is_del = 'N' and order_num in (select order_num from order_member where 1 and orderstat in ('com','pre') and order_num=ticket_payment_info.order_num) and ticket_idx='".$ticket_idx."'";
	$query = mysqli_query($GLOBALS['gconnet'],$sql);
	$row = mysqli_fetch_array($query);

	return $row['saled_cnt'];
}

############### 옵션선택 - 드롭다운 방식 ###################
function get_code_list_select($where,$ctype1,$ctype2,$tgparam=""){
	$sql = "select idx,".$ctype1." as opt_code,".$ctype2." as opt_name from common_code where 1 and is_del='N' and del_ok = 'N' ";
	if($where){
		$sql .= $where;
	}
	$sql .= " order by cate_align desc";
	//echo $sql."<br>";
	$query = mysqli_query($GLOBALS['gconnet'],$sql);
	$cnt = mysqli_num_rows($query);
	
	$row_val = "";
	for($i=0; $i<$cnt; $i++){
		$row = mysqli_fetch_array($query);
		
		if(trim($tgparam) == trim($row['opt_code'])){
			$row_val .= "<option value='".$row['opt_code']."' selected>".$row['opt_name']."</option>";
		} else {
			$row_val .= "<option value='".$row['opt_code']."'>".$row['opt_name']."</option>";
		}
	}
	
	echo $row_val;
	//return $row_val;
}

############### 옵션선택 - 라디오버튼 방식 ###################
function get_code_list_radio($where,$ctype1,$ctype2,$colname,$inputok,$inputname,$tgparam=""){
	$sql = "select idx,".$ctype1." as opt_code,".$ctype2." as opt_name from common_code where 1 and is_del='N' and del_ok = 'N' ";
	if($where){
		$sql .= $where;
	}
	$sql .= " order by cate_align desc";
	//echo $sql."<br>";
	$query = mysqli_query($GLOBALS['gconnet'],$sql);
	$cnt = mysqli_num_rows($query);
	
	$row_val = "";
	for($i=0; $i<$cnt; $i++){
		$row = mysqli_fetch_array($query);
		
		if(is_compet_info_opt($tgparam,$row['opt_code']) == "Y"){
		//if(trim($tgparam) == trim($row['opt_code'])){
			$row_val .= "<input type='radio' name='".$colname."' value='".$row['opt_code']."' checked required='".$inputok."'  message='".$inputname."' id='".$colname."_".$i."'> <label for='".$colname."_".$i."'>".$row['opt_name']."</label> &nbsp; ";
		} else {
			$row_val .= "<input type='radio' name='".$colname."' value='".$row['opt_code']."' required='".$inputok."'  message='".$inputname."' id='".$colname."_".$i."'> <label for='".$colname."_".$i."'>".$row['opt_name']."</label> &nbsp; ";
		}
	}
	
	echo $row_val;
	//return $row_val;
}

############### 옵션선택 - 체크박스 방식 ###################
function get_code_list_checkb($where,$ctype1,$ctype2,$colname,$inputok,$inputname,$tgparam=""){
	$sql = "select idx,".$ctype1." as opt_code,".$ctype2." as opt_name from common_code where 1 and is_del='N' and del_ok = 'N' ";
	if($where){
		$sql .= $where;
	}
	$sql .= " order by cate_align desc";
	//echo $sql."<br>";
	$query = mysqli_query($GLOBALS['gconnet'],$sql);
	$cnt = mysqli_num_rows($query);
	
	$row_val = "";
	for($i=0; $i<$cnt; $i++){
		$row = mysqli_fetch_array($query);

		$opt_name_arr = explode("(",$row['opt_name']);
		
		//if(trim($tgparam) == trim($row['opt_code'])){
		if(is_compet_info_opt($tgparam,$row['opt_code']) == "Y"){
			$row_val .= "<input type='checkbox' name='".$colname."[]' value='".$row['opt_code']."' checked required='".$inputok."' message='".$inputname."' id='".$colname."_".$i."'> <label for='".$colname."_".$i."'>".$opt_name_arr[0]."</label> &nbsp; ";
		} else {
			$row_val .= "<input type='checkbox' name='".$colname."[]' value='".$row['opt_code']."' required='".$inputok."' message='".$inputname."' id='".$colname."_".$i."'> <label for='".$colname."_".$i."'>".$opt_name_arr[0]."</label> &nbsp; ";
		}
	}
	
	echo $row_val;
	//return $row_val;
}

############### 옵션값 추출 ###################
function get_code_value($ctype1,$column1,$column2){
	$sql = "select ".$ctype1." as opt_val from common_code where 1 and is_del='N' and del_ok = 'N' and ".$column1."='".$column2."'";
	$query = mysqli_query($GLOBALS['gconnet'],$sql);
	$row = mysqli_fetch_array($query);
	
	$row_val = $row['opt_val'];

	//echo $row_val;
	return $row_val;
}

############### 옵션명칭 가져오기 ###################
function get_common_coden($nametype,$where){
	$current_cnt_query = "select ".$nametype." as opt_name from common_code where 1";
	if($where){
		$current_cnt_query .= $where;
	}
	//echo $current_cnt_query."<br>";
	$current_cnt_result = mysqli_query($GLOBALS['gconnet'],$current_cnt_query);
	$current_cnt_row = mysqli_fetch_array($current_cnt_result);
	
	return $current_cnt_row['opt_name'];
}

########## 패키지 옵션 가격 #######
function get_compet_package_price($tcode){
	switch ($tcode) {
		case "premium" : 
		$package = "5000000";
		break;
		case "gold" : 
		$package = "3000000";
		break;
		case "silver" : 
		$package = "1000000";
		break;
		case "bronze" : 
		$package = "500000";
		break;
	}
	
	return $package;
}

########## 패키지 옵션 이미지 #######
function get_compet_package_img($tcode){
	switch ($tcode) {
		case "premium" : 
		$package = "/images/img-premium.png";
		break;
		case "gold" : 
		$package = "/images/img-gold.png";
		break;
		case "silver" : 
		$package = "/images/img-silver.png";
		break;
		case "bronze" : 
		$package = "/images/img-bronze.png";
		break;
	}
	
	return $package;
}

######### 남은 날자 계산 ########
function get_remain_date($tgdate){
	$nDate = date("Y-m-d"); // 오늘날자
	$valDate = Trim($tgdate); // 종료일
	if($valDate < $nDate){
		$leftDate = 0;
	} else {
		$leftDate = intval((strtotime($valDate)-strtotime($nDate)) / 86400); // 나머지 날짜값이 나옵니다.
	}
	return $leftDate;
}

######### DB 원칼럼 추출 ########
function get_data_colname($tbname,$tbcal,$tbkey,$column,$where=""){
	$sql = "select ".$column." as receivem_idx from ".$tbname." where 1 and ".$tbcal."='".$tbkey."'";
	if($where){
		$sql .= $where;
	}
	//echo "get_data_colname = ".$sql."<br>";
	//exit;
	$query = mysqli_query($GLOBALS['gconnet'],$sql);
	$row = mysqli_fetch_array($query);
	return $row['receivem_idx'];
}

function get_alarm_msg($tcode){
	switch ($tcode) {
		case "fav1" : 
		$text_color = "귀하의 공모전을 즐겨찾기로 등록하였습니다.";
		break;
		case "fav2" : 
		$text_color = "귀하의 작품을 좋아합니다.";
		break;
		case "reply1" : 
		$text_color = "귀하의 공모전에 문의사항을 남겼습니다.";
		break;
		case "reply2" : 
		$text_color = "귀하의 문의사항에 답글을 남겼습니다.";
		break;
		case "self" : 
		$text_color = "의 1차 통과작에 선정되셨습니다!";
		break;
		case "selc" : 
		$text_color = "의 최종 우승작에 선정되셨습니다!";
		break;
	}
	
	return $text_color;
}

function get_minus_datet($cdate){
	$current = strtotime(date('Y-m-d H:i:s'));
	$timestamp = strtotime($cdate);
	  if ($timestamp <= $current - 86400 * 365) { 
		 $str = (int)(($current - $timestamp) / (86400 * 365)) . "년전"; 
	  } else if ($timestamp <= $current - 86400 * 31) { 
		 $str = (int)(($current - $timestamp) / (86400 * 31)) . "개월전"; 
	  } else if ($timestamp <= $current - 86400 * 1) { 
		 $str = (int)(($current - $timestamp) / 86400) . "일전"; 
	  } else if ($timestamp <= $current - 3600 * 1) { 
		 $str = (int)(($current - $timestamp) / 3600) . "시간전"; 
	  } else if ($timestamp <= $current - 60 * 1) { 
		 $str = (int)(($current - $timestamp) / 60) . "분전"; 
	  } else { 
		 $str = (int)($current - $timestamp) . "초전"; 
	  } 
	  
	  return $str;
}

function remain($d) {
    $day = strtotime($d);
    return intval((time() - $day)/86400);
}

function d_day($d) {
    if(date("Y-m-d") == $d){
		$cal_day = 0;
	} else {
		$d_day = $timestamp = strtotime($d);
		$cal_day = intval(($d_day-time())/86400);
		$cal_day = $cal_day+1;
	}
	return $cal_day;
}

function get_faq_type_cnt($type=""){ 
	$sql = "select idx from board_content where 1 and p_no = 0 and bbs_code = 'faq'";
	if($type){
		$sql .= " and bbs_sect='".$type."'";
	}
	$query = mysqli_query($GLOBALS['gconnet'],$sql);
	return mysqli_num_rows($query);
}

	function get_money_won($k) {
       $len = strlen ($k);
       $len_ahr = ceil($len/4);
       $len_skanwj = $len%4;
       $a=0;
       for ($i=1;$i<=$len_ahr;$i++) {
		   $sub = array("원", "만", "억","조");
           $a=$a-4;
			if ($i < $len_ahr) {
                if (substr($k, $a, 4) !="0000") {
                    $str=substr($k, $a, 4)+0;
                    $k2 = $str.$sub[$i-1].$k2;
                }
            }else {
               if ($len_skanwj==0) {
                  $len_skanwj=4;
               }
               $k2 = substr($k, $a,$len_skanwj).$sub[$i-1].$k2;
            }
       }
      $ch = strpos($k2,"원");
      if ($ch == 0) {
         $k2=$k2."원";
      }
       return $k2;
	}

function set_product_status($idx,$status){
	$sql = "update product_info set code_ingst='".$status."' where 1 and idx='".$idx."'";
	$query = mysqli_query($GLOBALS['gconnet'],$sql);
}

function get_calcurate_point($satisfaction_option_idx,$orgscore){
	$memid = $_SESSION['wiz_session']['id'];
	$subid = $_SESSION['wiz_session']['subid'];

	$compet_info_sql = "select analysis_report_satisfaction_option_score,analysis_report_satisfaction_option_percent,analysis_report_satisfaction_option_scorepoint,analysis_report_satisfaction_option_scorepoint2 from wise_analysis_report_satisfaction_option where 1 and idx='".$satisfaction_option_idx."'";
	if($memid){
		$compet_info_sql .= " and memid='".$memid."'";
	}
	if($subid){
		$compet_info_sql .= " and subid='".$subid."'";
	}
	//echo "compet_info_sql = ".$compet_info_sql."<br>";
	$compet_info_query = mysqli_query($GLOBALS['gconnet'],$compet_info_sql);
	$row = mysqli_fetch_array($compet_info_query);

	$satisfaction_option_score = $row['analysis_report_satisfaction_option_score'];	
	$satisfaction_option_percent = $row['analysis_report_satisfaction_option_percent'];	
	$satisfaction_option_scorepoint = trim($row['analysis_report_satisfaction_option_scorepoint']);
	$satisfaction_option_scorepoint2 = trim($row['analysis_report_satisfaction_option_scorepoint2']);
	
	//echo "원점수여부 = ".$satisfaction_option_percent."<br>";

	if($satisfaction_option_percent=="1"){ // 원점수 그대로 
		$calcurate_point = $orgscore;
	} else { // 100 점 변환 
		$calcurate_point_1 = $satisfaction_option_score-1; // 만점 -1 
		if(($orgscore-1) <= 0){
			$calcurate_point_2 = $orgscore/$calcurate_point_1;
		} else {
			$calcurate_point_2 = ($orgscore-1)/$calcurate_point_1;
		}
		$calcurate_point = $calcurate_point_2*100;
		$calcurate_point = round($calcurate_point,$satisfaction_option_scorepoint);
	} // 구분 종료 

	return $calcurate_point;
}

function get_calcurate_point_service($service_option_idx,$orgscore){
	$memid = $_SESSION['wiz_session']['id'];
	$subid = $_SESSION['wiz_session']['subid'];

	$compet_info_sql = "select analysis_report_service_option_score,analysis_report_service_option_percent,analysis_report_service_option_scorepoint,analysis_report_service_option_scorepoint2 from wise_analysis_report_service_option where 1 and idx='".$service_option_idx."'";
	//echo $compet_info_sql."<br>";
	if($memid){
		$compet_info_sql .= " and memid='".$memid."'";
	}
	if($subid){
		$compet_info_sql .= " and subid='".$subid."'";
	}
	$compet_info_query = mysqli_query($GLOBALS['gconnet'],$compet_info_sql);
	$row = mysqli_fetch_array($compet_info_query);

	$service_option_score = $row['analysis_report_service_option_score'];	
	$service_option_percent = $row['analysis_report_service_option_percent'];	
	$service_option_scorepoint = trim($row['analysis_report_service_option_scorepoint']);
	$service_option_scorepoint2 = trim($row['analysis_report_service_option_scorepoint2']);

	if($service_option_percent=="1"){ // 원점수 그대로 
		$calcurate_point = $orgscore;
	} else { // 100 점 변환 
		$calcurate_point_1 = $service_option_score-1; // 만점 -1 
		if(($orgscore-1) <= 0){
			$calcurate_point_2 = $orgscore/$calcurate_point_1;
		} else {
			$calcurate_point_2 = ($orgscore-1)/$calcurate_point_1;
		}
		$calcurate_point = $calcurate_point_2*100;
		$calcurate_point = round($calcurate_point,$service_option_scorepoint);
	} // 구분 종료 

	return $calcurate_point;
}

function get_service_totrate($tot_point){
	if($tot_point < 70){
		$tot_rate = "불량";
	} elseif($tot_point >= 70 && $tot_point < 80){
		$tot_rate = "미흡";
	} elseif($tot_point >= 80 && $tot_point < 90){
		$tot_rate = "보통";
	} elseif($tot_point >= 90 && $tot_point < 95){
		$tot_rate = "우수";
	} elseif($tot_point >= 95){
		$tot_rate = "탁월";
	}
		
	return $tot_rate;
}

function get_satisf_option_model_quiz_avg($satisfaction_option_100data_idx,$data_no,$satisfaction_option_idx,$option_model_idx){
	$memid = $_SESSION['wiz_session']['id'];
	$subid = $_SESSION['wiz_session']['subid'];

	$compet_info_sql = "select analysis_report_satisfaction_option_score,analysis_report_satisfaction_option_percent,analysis_report_satisfaction_option_scorepoint,analysis_report_satisfaction_option_scorepoint2 from wise_analysis_report_satisfaction_option where 1 and idx='".$satisfaction_option_idx."'";
	//echo $compet_info_sql."<br>";
	if($memid){
		$compet_info_sql .= " and memid='".$memid."'";
	}
	if($subid){
		$compet_info_sql .= " and subid='".$subid."'";
	}
	$compet_info_query = mysqli_query($GLOBALS['gconnet'],$compet_info_sql);
	$row = mysqli_fetch_array($compet_info_query);

	$satisfaction_option_score = $row['analysis_report_satisfaction_option_score'];	
	$satisfaction_option_percent = $row['analysis_report_satisfaction_option_percent'];	
	$satisfaction_option_scorepoint = trim($row['analysis_report_satisfaction_option_scorepoint']);
	$satisfaction_option_scorepoint2 = trim($row['analysis_report_satisfaction_option_scorepoint2']);

	//echo "소수점 자리 = ".$satisfaction_option_scorepoint."<br>";

	//$opt_sql = "select idx,analysis_report_satisfaction_option_factor_no,(select quiz_no from wise_analysis_quiz where 1 and idx=a.analysis_report_satisfaction_option_factor_no) as quiz_no from wise_analysis_report_satisfaction_option_model_quiz a where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and satisfaction_option_model_idx='".$option_model_idx."' and  analysis_report_satisfaction_option_factor_type='P' order by idx asc";

	$opt_sql = "select idx,analysis_report_satisfaction_option_factor_no,(select quiz_no from wise_analysis_quiz where 1 and idx=a.analysis_report_satisfaction_option_factor_no) as quiz_no from wise_analysis_report_satisfaction_option_model_quiz a where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and satisfaction_option_model_idx='".$option_model_idx."' and  analysis_report_satisfaction_option_factor_type='P' order by idx asc";
	//echo $opt_sql."<br>"; //exit;
	$opt_query = mysqli_query($GLOBALS['gconnet'],$opt_sql);
	$opt_cnt = mysqli_num_rows($opt_query);
	
	if($opt_cnt == 0){
		$avg_point = 0;
	} else {
		$total_point = 0;
		for($opt_i2=0; $opt_i2<$opt_cnt; $opt_i2++){ // 각 변수별 문항루프 시작 
			$opt_row = mysqli_fetch_array($opt_query);
			$quiz_no = $opt_row['quiz_no'];
		
			$sql_data_2 = "select analysis_report_satisfaction_100data_quiz_val from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and satisfaction_option_100data_idx='".$satisfaction_option_100data_idx."' and analysis_report_satisfaction_100data_no='".$data_no."' and analysis_report_satisfaction_100data_quiz_no='".$quiz_no."'";
			//echo $sql_data_2."<br><br>"; //exit;
			$query_data_2 = mysqli_query($GLOBALS['gconnet'],$sql_data_2);
			$row_data_2 = mysqli_fetch_array($query_data_2);
			$total_point = $total_point + $row_data_2['analysis_report_satisfaction_100data_quiz_val'];
			//echo "개별 데이터 = ".$row_data_2['analysis_report_satisfaction_100data_quiz_val']."<br>";
			//echo "합계 데이터 = ".$total_point."<br>";
		} // 각 변수별 문항루프 종료 
	
		$avg_point = round($total_point/$opt_cnt,$satisfaction_option_scorepoint);
		//echo "평균값 = ".$avg_point."<br>";
	}

	return $avg_point;

}

function get_satisf_csi_avg($satisfaction_option_idx,$satisfaction_option_100data_idx,$data_no){

	$compet_info_sql = "select analysis_report_satisfaction_option_scorepoint,analysis_report_satisfaction_option_scorepoint2 from wise_analysis_report_satisfaction_option where 1 and idx='".$satisfaction_option_idx."'";
	$compet_info_query = mysqli_query($GLOBALS['gconnet'],$compet_info_sql);
	$row = mysqli_fetch_array($compet_info_query);
	$satisfaction_option_scorepoint = trim($row['analysis_report_satisfaction_option_scorepoint']);
	$satisfaction_option_scorepoint2 = trim($row['analysis_report_satisfaction_option_scorepoint2']);

	if(!$satisfaction_option_scorepoint){
		$satisfaction_option_scorepoint = 1;
	}
	if(!$satisfaction_option_scorepoint2){
		$satisfaction_option_scorepoint2 = 1;
	}
	
	$data_cnt_1 = 0;

	$sql_data_1 = "select analysis_report_satisfaction_100data_quiz_val from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_100data_idx='".$satisfaction_option_100data_idx."' and analysis_report_satisfaction_100data_no='".$data_no."' and analysis_report_satisfaction_100data_quiz_no in ('1','2','3','4') order by CONVERT(analysis_report_satisfaction_100data_quiz_no, UNSIGNED) desc limit 0,1"; // 영화품질 
	$query_data_1 = mysqli_query($GLOBALS['gconnet'],$sql_data_1);
	if(mysqli_num_rows($query_data_1) > 0){
		$data_cnt_1 = $data_cnt_1+1;
	}
	$row_data_1 = mysqli_fetch_array($query_data_1); 
	//echo "data_1 = ".$row_data_1['analysis_report_satisfaction_100data_quiz_val']."<br>";

	$sql_data_2 = "select analysis_report_satisfaction_100data_quiz_val from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_100data_idx='".$satisfaction_option_100data_idx."' and analysis_report_satisfaction_100data_no='".$data_no."' and analysis_report_satisfaction_100data_quiz_no in ('5','6','7','8') order by CONVERT(analysis_report_satisfaction_100data_quiz_no, UNSIGNED) desc limit 0,1"; // 영화관 만족 
	$query_data_2 = mysqli_query($GLOBALS['gconnet'],$sql_data_2);
	if(mysqli_num_rows($query_data_2) > 0){
		$data_cnt_1 = $data_cnt_1+1;
	}
	$row_data_2 = mysqli_fetch_array($query_data_2);
	//echo "data_2 = ".$row_data_2['analysis_report_satisfaction_100data_quiz_val']."<br>";

	$sql_data_3 = "select analysis_report_satisfaction_100data_quiz_val from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_100data_idx='".$satisfaction_option_100data_idx."' and analysis_report_satisfaction_100data_no='".$data_no."' and analysis_report_satisfaction_100data_quiz_no in ('9','10','11','12','13','14','15') order by CONVERT(analysis_report_satisfaction_100data_quiz_no, UNSIGNED) desc limit 0,1"; // 직원친절  
	$query_data_3 = mysqli_query($GLOBALS['gconnet'],$sql_data_3);
	if(mysqli_num_rows($query_data_3) > 0){
		$data_cnt_1 = $data_cnt_1+1;
	}
	$row_data_3 = mysqli_fetch_array($query_data_3); 
	//echo "data_3 = ".$row_data_3['analysis_report_satisfaction_100data_quiz_val']."<br>";

	$sql_data_4 = "select analysis_report_satisfaction_100data_quiz_val from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_100data_idx='".$satisfaction_option_100data_idx."' and analysis_report_satisfaction_100data_no='".$data_no."' and analysis_report_satisfaction_100data_quiz_no in ('16','17','18','19') order by CONVERT(analysis_report_satisfaction_100data_quiz_no, UNSIGNED) desc limit 0,1"; // 직원응대
	$query_data_4 = mysqli_query($GLOBALS['gconnet'],$sql_data_4);
	if(mysqli_num_rows($query_data_4) > 0){
		$data_cnt_1 = $data_cnt_1+1;
	}
	$row_data_4 = mysqli_fetch_array($query_data_4); 
	//echo "data_4 = ".$row_data_4['analysis_report_satisfaction_100data_quiz_val']."<br>";

	$sql_data_5 = "select analysis_report_satisfaction_100data_quiz_val from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_100data_idx='".$satisfaction_option_100data_idx."' and analysis_report_satisfaction_100data_no='".$data_no."' and analysis_report_satisfaction_100data_quiz_no in ('20','21','22') order by CONVERT(analysis_report_satisfaction_100data_quiz_no, UNSIGNED) desc limit 0,1"; // 서비스 만족
	$query_data_5 = mysqli_query($GLOBALS['gconnet'],$sql_data_5);
	if(mysqli_num_rows($query_data_5) > 0){
		$data_cnt_1 = $data_cnt_1+1;
	}
	$row_data_5 = mysqli_fetch_array($query_data_5); 
	//echo "data_5 = ".$row_data_5['analysis_report_satisfaction_100data_quiz_val']."<br>";

	$sql_data_6 = "select analysis_report_satisfaction_100data_quiz_val from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_100data_idx='".$satisfaction_option_100data_idx."' and analysis_report_satisfaction_100data_no='".$data_no."' and analysis_report_satisfaction_100data_quiz_no in ('23','24','25') order by CONVERT(analysis_report_satisfaction_100data_quiz_no, UNSIGNED) desc limit 0,1"; // 요금제도 
	$query_data_6 = mysqli_query($GLOBALS['gconnet'],$sql_data_6);
	if(mysqli_num_rows($query_data_6) > 0){
		$data_cnt_1 = $data_cnt_1+1;
	}
	$row_data_6 = mysqli_fetch_array($query_data_6); 
	//echo "data_6 = ".$row_data_6['analysis_report_satisfaction_100data_quiz_val']."<br>";
	
	if($data_cnt_1 > 0){
		$csi_data_1 = $row_data_1['analysis_report_satisfaction_100data_quiz_val']+$row_data_2['analysis_report_satisfaction_100data_quiz_val']+$row_data_3['analysis_report_satisfaction_100data_quiz_val']+$row_data_4['analysis_report_satisfaction_100data_quiz_val']+$row_data_5['analysis_report_satisfaction_100data_quiz_val']+$row_data_6['analysis_report_satisfaction_100data_quiz_val'];
		$csi_data_1 = $csi_data_1/$data_cnt_1;
		$csi_data_1 = $csi_data_1 * 0.3;
		$csi_data_1 = round($csi_data_1,$satisfaction_option_scorepoint);
	} else {
		$csi_data_1 = 0;
	}
	//echo "csi_data_1 = ".$csi_data_1."<br>";

	$sql_file_1 = "select idx,(select quiz_no from wise_analysis_quiz where 1 and idx=a.analysis_report_satisfaction_option_factor_no) as quiz_no from wise_analysis_report_satisfaction_option_model_quiz a where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' order by idx asc"; // 분석모델 전체 
	$query_file_1 = mysqli_query($GLOBALS['gconnet'],$sql_file_1);
	$query_file_1_cnt = mysqli_num_rows($query_file_1);
	
	$csi_data_2_tot = 0;
	for($opt_i=0; $opt_i<$query_file_1_cnt; $opt_i++){ 
		$row_file_1 = mysqli_fetch_array($query_file_1);

		$sql_data = "select analysis_report_satisfaction_100data_quiz_val from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_100data_idx='".$satisfaction_option_100data_idx."' and analysis_report_satisfaction_100data_no='".$data_no."' and analysis_report_satisfaction_100data_quiz_no = '".$row_file_1['quiz_no']."'";  
		$query_data = mysqli_query($GLOBALS['gconnet'],$sql_data);
		$row_data = mysqli_fetch_array($query_data); 
		$csi_data_2_tot = $csi_data_2_tot+$row_data['analysis_report_satisfaction_100data_quiz_val'];
	}
	
	if($query_file_1_cnt > 0){
		$csi_data_2 = $csi_data_2_tot/$query_file_1_cnt;
		$csi_data_2 = $csi_data_2 * 0.2;
		$csi_data_2 = round($csi_data_2,$satisfaction_option_scorepoint);
	} else {
		$csi_data_2 = 0;
	}
	//echo "csi_data_2 = ".$csi_data_2."<br>";

	$sql_file_2 = "select idx,(select quiz_no from wise_analysis_quiz where 1 and idx=a.analysis_report_satisfaction_option_factor_no) as quiz_no from wise_analysis_report_satisfaction_option_model_quiz a where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and satisfaction_option_model_idx in (select idx from wise_analysis_report_satisfaction_option_model where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_option_variable_type='M') order by idx asc"; // 분석모델 중 중간변수 
	//echo "sql_file_2 = ".$sql_file_2."<br>";
	$query_file_2 = mysqli_query($GLOBALS['gconnet'],$sql_file_2);
	$query_file_2_cnt = mysqli_num_rows($query_file_2);
	
	$csi_data_3_tot = 0;
	for($opt_i=0; $opt_i<$query_file_2_cnt; $opt_i++){ 
		$row_file_2 = mysqli_fetch_array($query_file_2);

		$sql_data = "select analysis_report_satisfaction_100data_quiz_val from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_100data_idx='".$satisfaction_option_100data_idx."' and analysis_report_satisfaction_100data_no='".$data_no."' and analysis_report_satisfaction_100data_quiz_no = '".$row_file_2['quiz_no']."'"; 
		$query_data = mysqli_query($GLOBALS['gconnet'],$sql_data);
		$row_data = mysqli_fetch_array($query_data); 
		$csi_data_3_tot = $csi_data_3_tot+$row_data['analysis_report_satisfaction_100data_quiz_val'];

	}
	
	if($query_file_2_cnt > 0){
		$csi_data_3 = $csi_data_3_tot/$query_file_2_cnt;
		$csi_data_3 = $csi_data_3 * 0.5;
		$csi_data_3 = round($csi_data_3,$satisfaction_option_scorepoint);
	} else {
		$csi_data_3 = 0;
	}
	//echo "csi_data_3 = ".$csi_data_3."<br>";

	$csi_data = round($csi_data_1+$csi_data_2+$csi_data_3,$satisfaction_option_scorepoint);
	//echo "csi_data = ".$csi_data."<br>";
	//exit;

	return $csi_data;

}

function get_satisf_data_group_detail_avg($satisfaction_option_idx,$analysis_report_idx,$quiz_no,$quiz_val,$quiz_no_tg){
	
	$memid = $_SESSION['wiz_session']['id'];
	$subid = $_SESSION['wiz_session']['subid'];

	$compet_info_sql = "select analysis_report_satisfaction_option_scorepoint from wise_analysis_report_satisfaction_option where 1 and idx='".$satisfaction_option_idx."'";
	//echo $compet_info_sql."<br>";
	if($memid){
		$compet_info_sql .= " and memid='".$memid."'";
	}
	if($subid){
		$compet_info_sql .= " and subid='".$subid."'";
	}
	$compet_info_query = mysqli_query($GLOBALS['gconnet'],$compet_info_sql);
	$row = mysqli_fetch_array($compet_info_query);

	$satisfaction_option_scorepoint = trim($row['analysis_report_satisfaction_option_scorepoint']);

	$sql_prev_2 = "select idx from wise_analysis_report_satisfaction_option_point_case where 1 and satisfaction_option_idx='".$satisfaction_option_idx."'"; // 케이스 설정한값이 있는가
	$query_prev_2 = mysqli_query($GLOBALS['gconnet'],$sql_prev_2);
	$query_prev_2_cnt = mysqli_num_rows($query_prev_2);
	
	if($query_prev_2_cnt > 0){
		$opt_sql = "select analysis_report_satisfaction_100data_no from wise_analysis_report_satisfaction_100data_detail where satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_quiz_no='".$quiz_no."' and analysis_report_satisfaction_100data_quiz_val = '".$quiz_val."' and analysis_report_satisfaction_100data_no in (select analysis_report_satisfaction_100data_no from wise_analysis_report_satisfaction_100data_detail where 1 and analysis_report_satisfaction_100data_quiz_no in (select quiz_no from wise_analysis_quiz where 1 and analysis_idx='".$analysis_report_idx."' and idx in (select analysis_report_satisfaction_option_case_no from wise_analysis_report_satisfaction_option_point_case where 1 and satisfaction_option_idx='".$satisfaction_option_idx."')) and analysis_report_satisfaction_100data_quiz_val = (select analysis_report_satisfaction_option_case_answer from wise_analysis_report_satisfaction_option_point_case where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_option_case_no=(select idx from wise_analysis_quiz where 1 and analysis_idx='".$analysis_report_idx."' and quiz_no=wise_analysis_report_satisfaction_100data_detail.analysis_report_satisfaction_100data_quiz_no)))";
	} else {
		$opt_sql = "select analysis_report_satisfaction_100data_no from wise_analysis_report_satisfaction_100data_detail where satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_quiz_no='".$quiz_no."' and analysis_report_satisfaction_100data_quiz_val = '".$quiz_val."' and analysis_report_satisfaction_100data_no in (select analysis_report_satisfaction_100data_no from wise_analysis_report_satisfaction_100data_detail where 1 and analysis_report_satisfaction_100data_quiz_no in (select quiz_no from wise_analysis_quiz where 1 and analysis_idx='".$analysis_report_idx."'))";
	}

	//echo $opt_sql."<br>"; //exit;
	$opt_query = mysqli_query($GLOBALS['gconnet'],$opt_sql);
	$opt_cnt = mysqli_num_rows($opt_query);
	
	$total_point = 0;
	for($opt_i2=0; $opt_i2<$opt_cnt; $opt_i2++){ // 각 변수별 문항루프 시작 
		$opt_row = mysqli_fetch_array($opt_query);

		$data_no = $opt_row['analysis_report_satisfaction_100data_no'];
		//$quiz_no_tg = $opt_row['analysis_report_satisfaction_100data_quiz_no'];
		
		$sql_data_2 = "select analysis_report_satisfaction_100data_quiz_val from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_no='".$data_no."' and analysis_report_satisfaction_100data_quiz_no='".$quiz_no_tg."'";
		
		//echo $sql_data_2."<br>"; //exit;
		$query_data_2 = mysqli_query($GLOBALS['gconnet'],$sql_data_2);
		$row_data_2 = mysqli_fetch_array($query_data_2);
		$total_point = $total_point + $row_data_2['analysis_report_satisfaction_100data_quiz_val'];
		
		//echo "개별 데이터 = ".$row_data_2['data_val']."<br>";
		//echo "합계 데이터 = ".$total_point."<br>";
	} // 각 변수별 문항루프 종료 
	
	$avg_point = round($total_point/$opt_cnt,$satisfaction_option_scorepoint);
	return $avg_point;

}

function get_satisf_data_group_detail_avg2($satisfaction_option_idx,$analysis_report_idx,$quiz_no,$quiz_val,$quiz_title=""){
	
	$memid = $_SESSION['wiz_session']['id'];
	$subid = $_SESSION['wiz_session']['subid'];

	$compet_info_sql = "select analysis_report_satisfaction_option_scorepoint from wise_analysis_report_satisfaction_option where 1 and idx='".$satisfaction_option_idx."'";
	//echo $compet_info_sql."<br>";
	if($memid){
		$compet_info_sql .= " and memid='".$memid."'";
	}
	if($subid){
		$compet_info_sql .= " and subid='".$subid."'";
	}
	$compet_info_query = mysqli_query($GLOBALS['gconnet'],$compet_info_sql);
	$row = mysqli_fetch_array($compet_info_query);

	$satisfaction_option_scorepoint = trim($row['analysis_report_satisfaction_option_scorepoint']);

	$sql_prev_2 = "select idx from wise_analysis_report_satisfaction_option_point_case where 1 and satisfaction_option_idx='".$satisfaction_option_idx."'"; // 케이스 설정한값이 있는가
	$query_prev_2 = mysqli_query($GLOBALS['gconnet'],$sql_prev_2);
	$query_prev_2_cnt = mysqli_num_rows($query_prev_2);
	
	if($query_prev_2_cnt > 0){
		$opt_sql = "select analysis_report_satisfaction_100data_no from wise_analysis_report_satisfaction_100data_detail where satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_quiz_no='".$quiz_no."' and analysis_report_satisfaction_100data_quiz_val = '".$quiz_val."' and analysis_report_satisfaction_100data_no in (select analysis_report_satisfaction_100data_no from wise_analysis_report_satisfaction_100data_detail where 1 and analysis_report_satisfaction_100data_quiz_no in (select quiz_no from wise_analysis_quiz where 1 and analysis_idx='".$analysis_report_idx."' and idx in (select analysis_report_satisfaction_option_case_no from wise_analysis_report_satisfaction_option_point_case where 1 and satisfaction_option_idx='".$satisfaction_option_idx."')) and analysis_report_satisfaction_100data_quiz_val = (select analysis_report_satisfaction_option_case_answer from wise_analysis_report_satisfaction_option_point_case where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_option_case_no=(select idx from wise_analysis_quiz where 1 and analysis_idx='".$analysis_report_idx."' and quiz_no=wise_analysis_report_satisfaction_100data_detail.analysis_report_satisfaction_100data_quiz_no)))";
	} else {
		$opt_sql = "select analysis_report_satisfaction_100data_no from wise_analysis_report_satisfaction_100data_detail where satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_quiz_no='".$quiz_no."' and analysis_report_satisfaction_100data_quiz_val = '".$quiz_val."' and analysis_report_satisfaction_100data_no in (select analysis_report_satisfaction_100data_no from wise_analysis_report_satisfaction_100data_detail where 1 and analysis_report_satisfaction_100data_quiz_no in (select quiz_no from wise_analysis_quiz where 1 and analysis_idx='".$analysis_report_idx."'))";
	}

	//echo $opt_sql."<br>"; //exit;
	$opt_query = mysqli_query($GLOBALS['gconnet'],$opt_sql);
	$opt_cnt = mysqli_num_rows($opt_query);
	
	$total_point = 0;
	for($opt_i2=0; $opt_i2<$opt_cnt; $opt_i2++){ // 각 변수별 문항루프 시작 
		$opt_row = mysqli_fetch_array($opt_query);

		$data_no = $opt_row['analysis_report_satisfaction_100data_no'];
		/*if(!$quiz_title){
			$quiz_title = $opt_row['analysis_report_satisfaction_100data_quiz_title'];
		}*/
		//$quiz_title = $opt_row['analysis_report_satisfaction_100data_quiz_title'];
		
		$sql_data_2 = "select analysis_report_satisfaction_100data_quiz_val from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_no='".$data_no."' and analysis_report_satisfaction_100data_quiz_title='".$quiz_title."'";
		//echo $sql_data_2."<br>"; //exit;
		$query_data_2 = mysqli_query($GLOBALS['gconnet'],$sql_data_2);
		$row_data_2 = mysqli_fetch_array($query_data_2);
		$total_point = $total_point + $row_data_2['analysis_report_satisfaction_100data_quiz_val'];
		
		//echo "개별 데이터 = ".$row_data_2['data_val']."<br>";
		//echo "합계 데이터 = ".$total_point."<br>";
	} // 각 변수별 문항루프 종료 
	
	$avg_point = round($total_point/$opt_cnt,$satisfaction_option_scorepoint);
	return $avg_point;

}

function get_satisfaction_100data_no_val($satisfaction_option_idx,$data_no,$file_1_idx2="",$file_1_title2){
	$sql_data_2 = "select analysis_report_satisfaction_100data_quiz_val from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_no='".$data_no."'";
	//echo $sql_data_2."<br>";
	if($file_1_idx2){
		$sql_data_2 .= " and analysis_report_satisfaction_100data_quiz_no='".$file_1_idx2."'"; 
	}
	if($file_1_title2){
		$sql_data_2 .= " and analysis_report_satisfaction_100data_quiz_title='".$file_1_title2."'"; 
	}
	$query_data_2 = mysqli_query($GLOBALS['gconnet'],$sql_data_2);
	$row_data_2 = mysqli_fetch_array($query_data_2);

	return $row_data_2['analysis_report_satisfaction_100data_quiz_val'];
}

function get_satisf_100data_satisfval($satisfaction_option_idx,$data_no,$quiz_no_where){

	$memid = $_SESSION['wiz_session']['id'];
	$subid = $_SESSION['wiz_session']['subid'];

	$compet_info_sql = "select analysis_report_satisfaction_option_scorepoint from wise_analysis_report_satisfaction_option where 1 and idx='".$satisfaction_option_idx."'";
	//echo $compet_info_sql."<br>";
	if($memid){
		$compet_info_sql .= " and memid='".$memid."'";
	}
	if($subid){
		$compet_info_sql .= " and subid='".$subid."'";
	}
	$compet_info_query = mysqli_query($GLOBALS['gconnet'],$compet_info_sql);
	$row = mysqli_fetch_array($compet_info_query);

	$satisfaction_option_scorepoint = trim($row['analysis_report_satisfaction_option_scorepoint']);
		
	$opt_sql = "select analysis_report_satisfaction_100data_quiz_val from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_no='".$data_no."' and analysis_report_satisfaction_100data_quiz_no in (".$quiz_no_where.")";
	//echo $opt_sql."<br>"; //exit;
	$opt_query = mysqli_query($GLOBALS['gconnet'],$opt_sql);
	$opt_cnt = mysqli_num_rows($opt_query);
	
	$total_point = 0;
	for($opt_i2=0; $opt_i2<$opt_cnt; $opt_i2++){ // 각 변수별 문항루프 시작 
		$opt_row = mysqli_fetch_array($opt_query);
		
		$total_point = $total_point + $opt_row['analysis_report_satisfaction_100data_quiz_val'];
		
		//echo "개별 데이터 = ".$row_data_2['data_val']."<br>";
		//echo "합계 데이터 = ".$total_point."<br>";
	} // 각 변수별 문항루프 종료 
	
	$avg_point = round($total_point/$opt_cnt,$satisfaction_option_scorepoint);
	return $avg_point;

}

function get_service_100data_no_val($service_option_idx,$data_no,$file_1_idx2="",$file_1_group2="",$file_1_title2){
	$sql_data_2 = "select analysis_report_service_100data_quiz_val from wise_analysis_report_service_100data_detail where 1 and service_option_idx='".$service_option_idx."' and analysis_report_service_100data_no='".$data_no."'";
	
	if($file_1_group2){
		$sql_data_2 .= " and analysis_report_service_100data_group_no='".$file_1_group2."'"; 
	} elseif($file_1_idx2){
		$sql_data_2 .= " and analysis_report_service_100data_quiz_no='".$file_1_idx2."'"; 
	}
	/*if($file_1_title2){
		$sql_data_2 .= " and analysis_report_service_100data_quiz_title='".$file_1_title2."'"; 
		//echo $sql_data_2."<br>";
	}*/
	$query_data_2 = mysqli_query($GLOBALS['gconnet'],$sql_data_2);
	$row_data_2 = mysqli_fetch_array($query_data_2);

	return $row_data_2['analysis_report_service_100data_quiz_val'];
}

function get_service_100data_tlc_val($service_option_idx,$data_no,$col_name){
	$sql_data_2 = "select ".$col_name." as colval from wise_analysis_report_service_100data_tlc where 1 and service_option_idx='".$service_option_idx."' and analysis_report_service_100data_no='".$data_no."'";
	$query_data_2 = mysqli_query($GLOBALS['gconnet'],$sql_data_2);
	$row_data_2 = mysqli_fetch_array($query_data_2);

	return $row_data_2['colval'];
}

function get_satisfaction_data_group_detail($satisfaction_option_idx,$data_no,$data_no2,$file_1_idx2="",$file_1_title2){
	$sql_data_2 = "select analysis_report_satisfaction_data_quiz_val from wise_analysis_report_satisfaction_data_group_detail where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and satisfaction_data_group_idx='".$data_no."' and analysis_report_satisfaction_data_group2_no='".$data_no2."'";
	if($file_1_idx2){
		$sql_data_2 .= " and analysis_report_satisfaction_data_quiz_no='".$file_1_idx2."'"; 
	}
	if($file_1_title2){
		$sql_data_2 .= " and analysis_report_satisfaction_data_quiz_title='".$file_1_title2."'"; 
	}
	$query_data_2 = mysqli_query($GLOBALS['gconnet'],$sql_data_2);
	$row_data_2 = mysqli_fetch_array($query_data_2);

	return $row_data_2['analysis_report_satisfaction_data_quiz_val'];
}

function get_ipa_x_val($satisfaction_option_idx,$analysis_report_idx){
	$sql_prev_1 = "select idx,analysis_report_satisfaction_option_variable_title from wise_analysis_report_satisfaction_option_model where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_option_variable_type='X' order by idx asc"; // 독립변수 
	//echo "sql_prev_1 = ".$sql_prev_1."<br>";
	$query_prev_1 = mysqli_query($GLOBALS['gconnet'],$sql_prev_1);
	$query_prev_1_cnt = mysqli_num_rows($query_prev_1);
	$search_prev_1 = "";
	for($opt_prev_1=0; $opt_prev_1<$query_prev_1_cnt; $opt_prev_1++){
		$row_prev_1 = mysqli_fetch_array($query_prev_1);
		if($opt_prev_1 == $query_prev_1_cnt-1){
			//$search_prev_1 .= "'".trim($row_prev_1['analysis_report_satisfaction_option_variable_title'])."'";
			$search_prev_1 .= "'".trim($row_prev_1['idx'])."'";	
		} else {
			//$search_prev_1 .= "'".trim($row_prev_1['analysis_report_satisfaction_option_variable_title'])."',";
			$search_prev_1 .= "'".trim($row_prev_1['idx'])."',";	
		}
	}

	$sql_prev_2 = "select idx from wise_analysis_report_satisfaction_option_point_case where 1 and satisfaction_option_idx='".$satisfaction_option_idx."'"; // 케이스 설정한값이 있는가
	$query_prev_2 = mysqli_query($GLOBALS['gconnet'],$sql_prev_2);
	$query_prev_2_cnt = mysqli_num_rows($query_prev_2);
		
	$data_ipa_x_val = array();
	if(!$search_prev_1){ // 독립변수 없음 
	} else { // 독립변수 있음
				
		if($query_prev_2_cnt > 0){ // 케이스 지정한 값이 있을때 
			$sql_file_1 = "select distinct(analysis_report_satisfaction_100data_no) from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_no in (select analysis_report_satisfaction_100data_no from wise_analysis_report_satisfaction_100data_detail where 1 and analysis_report_satisfaction_100data_quiz_no in (select quiz_no from wise_analysis_quiz where 1 and analysis_idx='".$analysis_report_idx."' and idx in (select analysis_report_satisfaction_option_case_no from wise_analysis_report_satisfaction_option_point_case where 1 and satisfaction_option_idx='".$satisfaction_option_idx."')) and analysis_report_satisfaction_100data_quiz_val = (select analysis_report_satisfaction_option_case_answer from wise_analysis_report_satisfaction_option_point_case where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_option_case_no=(select idx from wise_analysis_quiz where 1 and analysis_idx='".$analysis_report_idx."' and quiz_no=wise_analysis_report_satisfaction_100data_detail.analysis_report_satisfaction_100data_quiz_no))) order by CONVERT(analysis_report_satisfaction_100data_no, UNSIGNED) asc";
		} else { // 케이스 지정한 값이 없을때 
			$sql_file_1 = "select distinct(analysis_report_satisfaction_100data_no) from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_no in (select analysis_report_satisfaction_100data_no from wise_analysis_report_satisfaction_100data_detail where 1 and analysis_report_satisfaction_100data_quiz_no in (select quiz_no from wise_analysis_quiz where 1 and analysis_idx='".$analysis_report_idx."')) order by CONVERT(analysis_report_satisfaction_100data_no, UNSIGNED) asc";
		}
		
		//echo "sql_file_1 = ".$sql_file_1."<br>";

		$query_file_1 = mysqli_query($GLOBALS['gconnet'],$sql_file_1);
		$query_file_1_cnt = mysqli_num_rows($query_file_1);
		
		for($opt_i=0; $opt_i<$query_file_1_cnt; $opt_i++){
			$row_file_1 = mysqli_fetch_array($query_file_1);
					
			$opt_sql = "select analysis_report_satisfaction_100data_quiz_no,analysis_report_satisfaction_100data_quiz_title,analysis_report_satisfaction_100data_quiz_val from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_model_no in (".$search_prev_1.") and analysis_report_satisfaction_100data_no='".$row_file_1['analysis_report_satisfaction_100data_no']."' order by analysis_report_satisfaction_100data_model_no asc";
			
			//echo "opt_sql = ".$opt_sql."<br>";
			
			$opt_query = mysqli_query($GLOBALS['gconnet'],$opt_sql);
			$opt_cnt = mysqli_num_rows($opt_query);
			//echo $opt_cnt."<br>";
			for($opt_i2=0; $opt_i2<$opt_cnt; $opt_i2++){
				$opt_row = mysqli_fetch_array($opt_query);
				$quiz_val = $opt_row['analysis_report_satisfaction_100data_quiz_val'];
				if(!$quiz_val){
					$quiz_val = "0.0";
				}
				$data_ipa_x_val[$opt_i][$opt_i2] = $quiz_val;
			}
			
		}
	} // 독립변수 있음 종료
	
	return $data_ipa_x_val;
}

function get_ipa_y_val($satisfaction_option_idx,$analysis_report_idx){

	$sql_prev_1 = "select idx,analysis_report_satisfaction_option_variable_title from wise_analysis_report_satisfaction_option_model where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_option_variable_type='Y' order by idx asc"; // 종속변수
	//echo "sql_prev_1 = ".$sql_prev_1."<br>";
	$query_prev_1 = mysqli_query($GLOBALS['gconnet'],$sql_prev_1);
	$query_prev_1_cnt = mysqli_num_rows($query_prev_1);
	$search_prev_1 = "";
	for($opt_prev_1=0; $opt_prev_1<$query_prev_1_cnt; $opt_prev_1++){
		$row_prev_1 = mysqli_fetch_array($query_prev_1);
		if($opt_prev_1 == $query_prev_1_cnt-1){
			//$search_prev_1 .= "'".trim($row_prev_1['analysis_report_satisfaction_option_variable_title'])."'";
			$search_prev_1 .= "'".trim($row_prev_1['idx'])."'";	
		} else {
			//$search_prev_1 .= "'".trim($row_prev_1['analysis_report_satisfaction_option_variable_title'])."',";
			$search_prev_1 .= "'".trim($row_prev_1['idx'])."',";	
		}
	}

	$sql_prev_2 = "select idx from wise_analysis_report_satisfaction_option_point_case where 1 and satisfaction_option_idx='".$satisfaction_option_idx."'"; // 케이스 설정한값이 있는가
	$query_prev_2 = mysqli_query($GLOBALS['gconnet'],$sql_prev_2);
	$query_prev_2_cnt = mysqli_num_rows($query_prev_2);
	
	$data_ipa_y_val = array();
	if(!$search_prev_1){ // 종속변수 없음 
	} else { // 종속변수 있음
				
		if($query_prev_2_cnt > 0){
			$sql_file_1 = "select distinct(analysis_report_satisfaction_100data_no) from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_no in (select analysis_report_satisfaction_100data_no from wise_analysis_report_satisfaction_100data_detail where 1 and analysis_report_satisfaction_100data_quiz_no in (select quiz_no from wise_analysis_quiz where 1 and analysis_idx='".$analysis_report_idx."' and idx in (select analysis_report_satisfaction_option_case_no from wise_analysis_report_satisfaction_option_point_case where 1 and satisfaction_option_idx='".$satisfaction_option_idx."')) and analysis_report_satisfaction_100data_quiz_val = (select analysis_report_satisfaction_option_case_answer from wise_analysis_report_satisfaction_option_point_case where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_option_case_no=(select idx from wise_analysis_quiz where 1 and analysis_idx='".$analysis_report_idx."' and quiz_no=wise_analysis_report_satisfaction_100data_detail.analysis_report_satisfaction_100data_quiz_no))) order by CONVERT(analysis_report_satisfaction_100data_no, UNSIGNED) asc";
		} else {
			$sql_file_1 = "select distinct(analysis_report_satisfaction_100data_no) from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_no in (select analysis_report_satisfaction_100data_no from wise_analysis_report_satisfaction_100data_detail where 1 and analysis_report_satisfaction_100data_quiz_no in (select quiz_no from wise_analysis_quiz where 1 and analysis_idx='".$analysis_report_idx."')) order by CONVERT(analysis_report_satisfaction_100data_no, UNSIGNED) asc";
		}

		$query_file_1 = mysqli_query($GLOBALS['gconnet'],$sql_file_1);
		$query_file_1_cnt = mysqli_num_rows($query_file_1);
		
		for($opt_i=0; $opt_i<$query_file_1_cnt; $opt_i++){
			$row_file_1 = mysqli_fetch_array($query_file_1);
					
			$opt_sql = "select analysis_report_satisfaction_100data_quiz_no,analysis_report_satisfaction_100data_quiz_title,analysis_report_satisfaction_100data_quiz_val from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_model_no in (".$search_prev_1.") and analysis_report_satisfaction_100data_no='".$row_file_1['analysis_report_satisfaction_100data_no']."' order by analysis_report_satisfaction_100data_model_no asc";
			
			//echo "opt_sql = ".$opt_sql."<br>";
			
			$opt_query = mysqli_query($GLOBALS['gconnet'],$opt_sql);
			$opt_cnt = mysqli_num_rows($opt_query);
			//echo $opt_cnt."<br>";
			for($opt_i2=0; $opt_i2<$opt_cnt; $opt_i2++){
				$opt_row = mysqli_fetch_array($opt_query);
				$quiz_val = $opt_row['analysis_report_satisfaction_100data_quiz_val'];
				if(!$quiz_val){
					$quiz_val = "0.0";
				}
				$data_ipa_y_val[$opt_i][$opt_i2] = $quiz_val;
			}
			
		}
	} // 종속변수 있음 종료
	
	return $data_ipa_y_val;
}

function get_perq_ipa_avg($satisfaction_option_idx,$model_no,$quiz_title){

	$memid = $_SESSION['wiz_session']['id'];
	$subid = $_SESSION['wiz_session']['subid'];

	$compet_info_sql = "select analysis_report_satisfaction_option_scorepoint from wise_analysis_report_satisfaction_option where 1 and idx='".$satisfaction_option_idx."'";
	//echo $compet_info_sql."<br>";
	if($memid){
		$compet_info_sql .= " and memid='".$memid."'";
	}
	if($subid){
		$compet_info_sql .= " and subid='".$subid."'";
	}
	$compet_info_query = mysqli_query($GLOBALS['gconnet'],$compet_info_sql);
	$row = mysqli_fetch_array($compet_info_query);

	$satisfaction_option_scorepoint = trim($row['analysis_report_satisfaction_option_scorepoint']);
	
	$opt_sql = "select analysis_report_satisfaction_100data_quiz_val from wise_analysis_report_satisfaction_100data_detail where satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_model_no='".$model_no."'";
	$opt_query = mysqli_query($GLOBALS['gconnet'],$opt_sql);
	$opt_cnt = mysqli_num_rows($opt_query);
	
	$total_point = 0;
	for($opt_i2=0; $opt_i2<$opt_cnt; $opt_i2++){  
		$opt_row = mysqli_fetch_array($opt_query);
		
		$total_point = $total_point + $opt_row['analysis_report_satisfaction_100data_quiz_val'];
		
	}
	
	$avg_point = round($total_point/$opt_cnt,$satisfaction_option_scorepoint);
	return $avg_point;

}

function get_service_gquiz_val($data_no,$analysis_idx,$quiz_no){
	$opt_sql = "select data_val from wise_analysis_data where 1 and analysis_idx='".$analysis_idx."' and data_no='".$data_no."' and quiz_no='".$quiz_no."'";
	//echo "service_gquiz_val = ".$opt_sql."<br>";
	$opt_query = mysqli_query($GLOBALS['gconnet'],$opt_sql);
	$opt_row = mysqli_fetch_array($opt_query);
	return $opt_row['data_val'];
}

function set_rst_service_tlc($service_option_idx,$service_option_100data_idx,$service_100data_no,$analysis_report_idx){
	$sql_file_1 = "select analysis_report_service_100data_quiz_no,analysis_report_service_100data_quiz_val from wise_analysis_report_service_100data_detail where 1 and service_option_idx='".$service_option_idx."' and service_option_100data_idx='".$service_option_100data_idx."' and analysis_report_service_100data_no='".$service_100data_no."' and analysis_report_service_100data_quiz_no != '' and analysis_report_service_100data_quiz_no is not null order by analysis_report_service_100data_quiz_no asc";
	//echo "sql_file_1 = ".$sql_file_1."<br>"; exit;
	$query_file_1 = mysqli_query($GLOBALS['gconnet'],$sql_file_1);
	$query_file_1_cnt = mysqli_num_rows($query_file_1);
	
	$tot_score = 0; // 응답자 총점 
	for($opt_i=0; $opt_i<$query_file_1_cnt; $opt_i++){ // 응답자의 참여데이터 루프 시작 
		$row_file_1 = mysqli_fetch_array($query_file_1);

		//$sql_file_2 = "select analysis_report_service_option_samescyn_quiz_score from wise_analysis_report_service_option_samescyn_quiz where 1 and service_option_idx='".$service_option_idx."' and analysis_report_service_option_samescyn_quiz_no=(select idx from wise_analysis_quiz where 1 and quiz_no='".$row_file_1['analysis_report_service_100data_quiz_no']."' and analysis_idx='".$analysis_report_idx."') and analysis_report_service_option_samescyn_quiz_tscyn = 'Y'";

		$sql_file_2 = "select analysis_report_service_option_samescyn_quiz_score from wise_analysis_report_service_option_samescyn_quiz where 1 and service_option_idx='".$service_option_idx."' and analysis_report_service_option_samescyn_quiz_no=(select idx from wise_analysis_quiz where 1 and quiz_no='".$row_file_1['analysis_report_service_100data_quiz_no']."' and analysis_idx='".$analysis_report_idx."')";

		//echo "sql_file_2 = ".$sql_file_2."<br>"; 
		$query_file_2 = mysqli_query($GLOBALS['gconnet'],$sql_file_2);
		$query_file_2_cnt = mysqli_num_rows($query_file_2);
		
		$tot_sub_score = 0; // 문항당 배점적용 총점 
		for($opt2_i=0; $opt2_i<$query_file_2_cnt; $opt2_i++){ // 문항 배점배당 루프 시작 
			$row_file_2 = mysqli_fetch_array($query_file_2);

			$bdscore = $row_file_2['analysis_report_service_option_samescyn_quiz_score']/100; // 배당 % 화 
			//echo "bdscore = ".$bdscore."<br>";
			//echo "100data_quiz_val = ".$row_file_1['analysis_report_service_100data_quiz_val']."<br>";
			//echo "dan totsc = ".$row_file_1['analysis_report_service_100data_quiz_val']*$bdscore."<br>";
			$tot_sub_score = $tot_sub_score+($row_file_1['analysis_report_service_100data_quiz_val']*$bdscore); // 각 문항당 배점적용 계산값
			//echo "sub_score = ".$tot_sub_score."<br>";

		} // 문항 배점배당 루프 종료 
				
		$tot_score = $tot_score+$tot_sub_score;
		//echo ($opt_i+1)." : tot_score = ".$tot_score."<br>";

		//exit;
		
	} // 응답자의 참여데이터 루프 종료
	
	//exit;
	$tot_score = round($tot_score,1);

	$sql_file_3 = "select idx,analysis_report_service_option_levelyn_title from wise_analysis_report_service_option_levelyn where 1 and service_option_idx='".$service_option_idx."' and CONVERT(analysis_report_service_option_levelyn_spoint, UNSIGNED) <= '".$tot_score."' and CONVERT(analysis_report_service_option_levelyn_epoint, UNSIGNED) >= '".$tot_score."'"; // 등급기준
	$query_file_3 = mysqli_query($GLOBALS['gconnet'],$sql_file_3);

	if(mysqli_num_rows($query_file_3) == 0){
		$query_in = "insert into wise_analysis_report_service_100data_tlc set"; 
		$query_in .= " service_option_idx = '".$service_option_idx."', ";
		$query_in .= " service_option_100data_idx = '".$service_option_100data_idx."', ";
		$query_in .= " analysis_report_service_100data_no = '".$service_100data_no."', ";
		$query_in .= " analysis_report_service_100data_total = '".$tot_score."', ";
		$query_in .= " wdate = now() ";
	} else {
		$row_file_3 = mysqli_fetch_array($query_file_3);
		$query_in = "insert into wise_analysis_report_service_100data_tlc set"; 
		$query_in .= " service_option_idx = '".$service_option_idx."', ";
		$query_in .= " service_option_100data_idx = '".$service_option_100data_idx."', ";
		$query_in .= " analysis_report_service_100data_no = '".$service_100data_no."', ";
		$query_in .= " analysis_report_service_100data_total = '".$tot_score."', ";
		$query_in .= " analysis_report_service_option_level_no = '".$row_file_3['idx']."', ";
		$query_in .= " analysis_report_service_option_level_title = '".$row_file_3['analysis_report_service_option_levelyn_title']."', ";
		$query_in .= " wdate = now() ";
	}

	//echo $query_in."<br>";
	//exit;
	$result_in = mysqli_query($GLOBALS['gconnet'],$query_in);
}

function set_rst_service_tlc_align($service_option_idx,$service_option_100data_idx){
	$sql_file_1 = "select idx from wise_analysis_report_service_100data_tlc where 1 and service_option_idx='".$service_option_idx."' and service_option_100data_idx='".$service_option_100data_idx."' order by CONVERT(analysis_report_service_100data_total, UNSIGNED) desc";
	$query_file_1 = mysqli_query($GLOBALS['gconnet'],$sql_file_1);
	$query_file_1_cnt = mysqli_num_rows($query_file_1);
	
	for($opt_i=0; $opt_i<$query_file_1_cnt; $opt_i++){ // 총점 데이터 루프 시작 
		$row_file_1 = mysqli_fetch_array($query_file_1);

		$query_in = "update wise_analysis_report_service_100data_tlc set"; 
		$query_in .= " analysis_report_service_100data_count = '".($opt_i+1)."' ";
		$query_in .= " where 1 and idx='".$row_file_1['idx']."'";
		$result_in = mysqli_query($GLOBALS['gconnet'],$query_in);

	} // 총점 데이터 루프 종료
}

function get_ipa_x_val_service($service_option_idx){
	$sql_prev_1 = "select analysis_report_service_option_group_title from wise_analysis_report_service_option_group where 1 and service_option_idx='".$service_option_idx."' order by idx asc"; // 집단구분항목 
	
	//$sql_prev_1 = "select analysis_report_service_option_samescyn_quiz_title from wise_analysis_report_service_option_samescyn_quiz where 1 and service_option_idx='".$service_option_idx."' and service_option_samescyn_idx in (select idx from wise_analysis_report_service_option_samescyn where 1 and service_option_idx='".$service_option_idx."') order by idx asc"; // 전체 분석모델  

	$query_prev_1 = mysqli_query($GLOBALS['gconnet'],$sql_prev_1);
	$query_prev_1_cnt = mysqli_num_rows($query_prev_1);
	$search_prev_1 = "";

	if($query_prev_1_cnt > 0){ // 집단구분항목 있을때 시작  
		for($opt_prev_1=0; $opt_prev_1<$query_prev_1_cnt; $opt_prev_1++){
			$row_prev_1 = mysqli_fetch_array($query_prev_1);
			if($opt_prev_1 == $query_prev_1_cnt-1){
				$search_prev_1 .= "'".trim($row_prev_1['analysis_report_service_option_group_title'])."'";
				//$search_prev_1 .= "'".trim($row_prev_1['analysis_report_service_option_samescyn_quiz_title'])."'";
			} else {
				$search_prev_1 .= "'".trim($row_prev_1['analysis_report_service_option_group_title'])."',";
				//$search_prev_1 .= "'".trim($row_prev_1['analysis_report_service_option_samescyn_quiz_title'])."',";	
			}
		}

		$group_yn = "Y";
	} else { // 집단구분항목 있을때 종료, 없을때 시작 
		$sql_prev_1 = "select analysis_report_service_option_samescyn_quiz_title from wise_analysis_report_service_option_samescyn_quiz where 1 and service_option_idx='".$service_option_idx."' and service_option_samescyn_idx in (select idx from wise_analysis_report_service_option_samescyn where 1 and service_option_idx='".$service_option_idx."' and analysis_report_service_option_samescyn_jongs='N') order by idx asc"; // 전체 분석모델  
		$query_prev_1 = mysqli_query($GLOBALS['gconnet'],$sql_prev_1);
		$query_prev_1_cnt = mysqli_num_rows($query_prev_1);
		for($opt_prev_1=0; $opt_prev_1<$query_prev_1_cnt; $opt_prev_1++){
			$row_prev_1 = mysqli_fetch_array($query_prev_1);
			if($opt_prev_1 == $query_prev_1_cnt-1){
				//$search_prev_1 .= "'".trim($row_prev_1['analysis_report_service_option_group_title'])."'";
				$search_prev_1 .= "'".trim($row_prev_1['analysis_report_service_option_samescyn_quiz_title'])."'";
			} else {
				//$search_prev_1 .= "'".trim($row_prev_1['analysis_report_service_option_group_title'])."',";
				$search_prev_1 .= "'".trim($row_prev_1['analysis_report_service_option_samescyn_quiz_title'])."',";	
			}
		}

		$group_yn = "N";
	} // 집단구분항목 없을때 종료 

	//echo "sql_prev_1 = ".$sql_prev_1."<br>";

	$sql_prev_2 = "select idx from wise_analysis_report_service_option_point_case where 1 and service_option_idx='".$service_option_idx."'"; 
	$query_prev_2 = mysqli_query($GLOBALS['gconnet'],$sql_prev_2);
	$query_prev_2_cnt = mysqli_num_rows($query_prev_2);
	if($query_prev_2_cnt > 0){
		$detail_tb_name = "wise_analysis_report_service_100data_detail_case";
	} else {
		$detail_tb_name = "wise_analysis_report_service_100data_detail";
	}

	//echo " xval search_prev_1 = ".$search_prev_1."<br>";
	
	$data_ipa_x_val = array();
	if(!$search_prev_1){ // 집단구분항목 없음 
	} else { // 집단구분항목 
		$sql_file_1 = "select distinct(analysis_report_service_100data_no) from ".$detail_tb_name." where 1 and service_option_idx='".$service_option_idx."' order by CONVERT(analysis_report_service_100data_no, UNSIGNED) asc";
		//echo $sql_file_1."<br>";
		$query_file_1 = mysqli_query($GLOBALS['gconnet'],$sql_file_1);
		$query_file_1_cnt = mysqli_num_rows($query_file_1);
		
		$ipa_x_val = "";
		for($opt_i=0; $opt_i<$query_file_1_cnt; $opt_i++){
			$row_file_1 = mysqli_fetch_array($query_file_1);
			
			if($group_yn == "Y"){
				$opt_sql = "select analysis_report_service_100data_group_no,analysis_report_service_100data_quiz_title,analysis_report_service_100data_quiz_val from ".$detail_tb_name." where 1 and service_option_idx='".$service_option_idx."' and analysis_report_service_100data_quiz_title in (".$search_prev_1.") and analysis_report_service_100data_no='".$row_file_1['analysis_report_service_100data_no']."' and analysis_report_service_100data_quiz_val != '' and analysis_report_service_100data_group_no is not null order by analysis_report_service_100data_model_no asc";
			} else {
				$opt_sql = "select analysis_report_service_100data_group_no,analysis_report_service_100data_quiz_title,analysis_report_service_100data_quiz_val from ".$detail_tb_name." where 1 and service_option_idx='".$service_option_idx."' and analysis_report_service_100data_quiz_title in (".$search_prev_1.") and analysis_report_service_100data_no='".$row_file_1['analysis_report_service_100data_no']."' and analysis_report_service_100data_quiz_val != '' order by analysis_report_service_100data_model_no asc";
			}

			//echo "opt_sql = ".$opt_sql."<br>";
			$opt_query = mysqli_query($GLOBALS['gconnet'],$opt_sql);
			$opt_cnt = mysqli_num_rows($opt_query);
			//echo $opt_cnt."<br>";
			for($opt_i2=0; $opt_i2<$opt_cnt; $opt_i2++){
				$opt_row = mysqli_fetch_array($opt_query);
				$quiz_val = $opt_row['analysis_report_service_100data_quiz_val'];
				if(!$quiz_val){
					$quiz_val = "1";
				}
				$data_ipa_x_val[$opt_i][$opt_i2] = $quiz_val;
				$ipa_x_val .= $quiz_val.",";
			}
			
		}
	} // 독립변수 있음 종료
	
	//echo "x_val = ".$ipa_x_val."<br><br>";
	//echo "x cnt = ".$query_file_1_cnt."<br>";
	return $data_ipa_x_val;
}

function get_ipa_y_val_service($service_option_idx){

	$sql_prev_1 = "select analysis_report_service_option_samescyn_quiz_title from wise_analysis_report_service_option_samescyn_quiz where 1 and service_option_idx='".$service_option_idx."' and service_option_samescyn_idx in (select idx from wise_analysis_report_service_option_samescyn where 1 and service_option_idx='".$service_option_idx."' and analysis_report_service_option_samescyn_jongs='Y') order by idx asc"; // 종속변수 
	//echo "y_data_base = ".$sql_prev_1."<br>";
	$query_prev_1 = mysqli_query($GLOBALS['gconnet'],$sql_prev_1);
	$query_prev_1_cnt = mysqli_num_rows($query_prev_1);
	$search_prev_1 = "";
	for($opt_prev_1=0; $opt_prev_1<$query_prev_1_cnt; $opt_prev_1++){
		$row_prev_1 = mysqli_fetch_array($query_prev_1);
		if($opt_prev_1 == $query_prev_1_cnt-1){
			$search_prev_1 .= "'".trim($row_prev_1['analysis_report_service_option_samescyn_quiz_title'])."'";
		} else {
			$search_prev_1 .= "'".trim($row_prev_1['analysis_report_service_option_samescyn_quiz_title'])."',";	
		}
	}

	//echo " yval search_prev_1 = ".$search_prev_1."<br>";

	$sql_prev_2 = "select idx from wise_analysis_report_service_option_point_case where 1 and service_option_idx='".$service_option_idx."'"; 
	$query_prev_2 = mysqli_query($GLOBALS['gconnet'],$sql_prev_2);
	$query_prev_2_cnt = mysqli_num_rows($query_prev_2);
	if($query_prev_2_cnt > 0){
		$detail_tb_name = "wise_analysis_report_service_100data_detail_case";
	} else {
		$detail_tb_name = "wise_analysis_report_service_100data_detail";
	}
	
	$data_ipa_y_val = array();
	if(!$search_prev_1){ // 종속변수 없음 
	} else { // 종속변수 있음
		$sql_file_1 = "select distinct(analysis_report_service_100data_no) from ".$detail_tb_name." where 1 and service_option_idx='".$service_option_idx."' order by CONVERT(analysis_report_service_100data_no, UNSIGNED) asc";
		//echo "yval sql_file_1 = ".$sql_file_1."<br>";
		$query_file_1 = mysqli_query($GLOBALS['gconnet'],$sql_file_1);
		$query_file_1_cnt = mysqli_num_rows($query_file_1);
		
		$ipa_y_val = "";
		for($opt_i=0; $opt_i<$query_file_1_cnt; $opt_i++){
			$row_file_1 = mysqli_fetch_array($query_file_1);
					
			$opt_sql = "select analysis_report_service_100data_quiz_no,analysis_report_service_100data_quiz_title,analysis_report_service_100data_quiz_val from ".$detail_tb_name." where 1 and service_option_idx='".$service_option_idx."' and analysis_report_service_100data_quiz_title in (".$search_prev_1.") and analysis_report_service_100data_no='".$row_file_1['analysis_report_service_100data_no']."' order by analysis_report_service_100data_model_no asc";
			//echo "y_val opt_sql = ".$opt_sql."<br>";
			$opt_query = mysqli_query($GLOBALS['gconnet'],$opt_sql);
			$opt_cnt = mysqli_num_rows($opt_query);
			//echo "y_val cnt = ".$opt_cnt."<br>";
			for($opt_i2=0; $opt_i2<$opt_cnt; $opt_i2++){
				$opt_row = mysqli_fetch_array($opt_query);
				$quiz_val = $opt_row['analysis_report_service_100data_quiz_val'];
				if(!$quiz_val){
					$quiz_val = "1";
				}
				$data_ipa_y_val[$opt_i][$opt_i2] = $quiz_val;
				$ipa_y_val .= $quiz_val.",";
			}
			
		}
	} // 종속변수 있음 종료
	
	//echo "y_val = ".$ipa_y_val."<br>";
	//echo "y cnt = ".$query_file_1_cnt."<br>";
	return $data_ipa_y_val;
}

function get_perq_ipa_avg_service($service_option_idx,$model_no="",$quiz_title=""){

	$sql_prev_2 = "select idx from wise_analysis_report_service_option_point_case where 1 and service_option_idx='".$service_option_idx."'"; 
	$query_prev_2 = mysqli_query($GLOBALS['gconnet'],$sql_prev_2);
	$query_prev_2_cnt = mysqli_num_rows($query_prev_2);
	if($query_prev_2_cnt > 0){
		$detail_tb_name = "wise_analysis_report_service_100data_detail_case";
	} else {
		$detail_tb_name = "wise_analysis_report_service_100data_detail";
	}
	
	$opt_sql = "select analysis_report_service_100data_quiz_val from ".$detail_tb_name." where service_option_idx='".$service_option_idx."'";
	if($model_no){
		$opt_sql .= " and analysis_report_service_100data_group_no='".$model_no."'";
	}
	//echo "ipa_stf sql = ".$opt_sql."<br>";
	$opt_query = mysqli_query($GLOBALS['gconnet'],$opt_sql);
	$opt_cnt = mysqli_num_rows($opt_query);
	
	$total_point = 0;
	for($opt_i2=0; $opt_i2<$opt_cnt; $opt_i2++){  
		$opt_row = mysqli_fetch_array($opt_query);
		
		$total_point = $total_point + $opt_row['analysis_report_service_100data_quiz_val'];
		//echo "one = ".$opt_row['analysis_report_service_100data_quiz_val']."<br>";
		//echo "total = ".$total_point."<br>";
		
	}
	
	$avg_point = round($total_point/$opt_cnt,1);
	//echo "avg = ".$avg_point."<br>";
	return $avg_point;

}

function get_service_data_val_avg($service_option_idx,$analysis_report_idx,$quiz_no,$tquiz_no,$tanswer){
	
	$compet_info_sql = "select analysis_report_service_option_scorepoint from wise_analysis_report_service_option where 1 and idx='".$service_option_idx."'";
	$compet_info_query = mysqli_query($GLOBALS['gconnet'],$compet_info_sql);
	$compet_info_row = mysqli_fetch_array($compet_info_query);
	$service_option_scorepoint = trim($compet_info_row['analysis_report_service_option_scorepoint']);

	//$opt_sql .= "select data_val from wise_analysis_data where 1 and analysis_idx='".$analysis_report_idx."' and data_val='".$answer."' and quiz_no='".$quiz_no."'";

	$sql_prev_2 = "select idx from wise_analysis_report_service_option_point_case where 1 and service_option_idx='".$service_option_idx."'"; 
	$query_prev_2 = mysqli_query($GLOBALS['gconnet'],$sql_prev_2);
	$query_prev_2_cnt = mysqli_num_rows($query_prev_2);
	if($query_prev_2_cnt > 0){
		$detail_tb_name = "wise_analysis_report_service_100data_detail_case";
	} else {
		$detail_tb_name = "wise_analysis_report_service_100data_detail";
	}

	$opt_sql .= "select analysis_report_service_100data_quiz_val from ".$detail_tb_name." where 1 and service_option_idx='".$service_option_idx."' and analysis_report_service_100data_quiz_no='".$quiz_no."' and analysis_report_service_100data_no in (select data_no from wise_analysis_data where 1 and analysis_idx='".$analysis_report_idx."' and quiz_no='".$tquiz_no."' and data_val='".$tanswer."')";

	//echo $opt_sql."<br>";
	$opt_query = mysqli_query($GLOBALS['gconnet'],$opt_sql);
	$opt_cnt = mysqli_num_rows($opt_query);
	
	if($opt_cnt == 0){
		$avg_point = 0;
	} else {
		$total_point = 0;
		for($opt_i2=0; $opt_i2<$opt_cnt; $opt_i2++){  
			$opt_row = mysqli_fetch_array($opt_query);

			$service_100data_quiz_val = $opt_row['analysis_report_service_100data_quiz_val'];		
			$total_point = $total_point + $service_100data_quiz_val;
			//echo "per = ".$service_100data_quiz_val."<br>";
			//echo "total = ".$total_point."<br>";
		}
	
		$avg_point = round($total_point/$opt_cnt,$service_option_scorepoint);
	
	}
	return $avg_point;

}

function get_service_data_val_avg2($service_option_idx,$analysis_report_idx,$quiz_no){
	
	$compet_info_sql = "select analysis_report_service_option_scorepoint from wise_analysis_report_service_option where 1 and idx='".$service_option_idx."'";
	$compet_info_query = mysqli_query($GLOBALS['gconnet'],$compet_info_sql);
	$compet_info_row = mysqli_fetch_array($compet_info_query);
	$service_option_scorepoint = trim($compet_info_row['analysis_report_service_option_scorepoint']);

	$sql_prev_2 = "select idx from wise_analysis_report_service_option_point_case where 1 and service_option_idx='".$service_option_idx."'"; 
	$query_prev_2 = mysqli_query($GLOBALS['gconnet'],$sql_prev_2);
	$query_prev_2_cnt = mysqli_num_rows($query_prev_2);
	if($query_prev_2_cnt > 0){
		$detail_tb_name = "wise_analysis_report_service_100data_detail_case";
	} else {
		$detail_tb_name = "wise_analysis_report_service_100data_detail";
	}

	$opt_sql .= "select analysis_report_service_100data_quiz_val from ".$detail_tb_name." where 1 and service_option_idx='".$service_option_idx."' and analysis_report_service_100data_quiz_no='".$quiz_no."'";
	$opt_query = mysqli_query($GLOBALS['gconnet'],$opt_sql);
	$opt_cnt = mysqli_num_rows($opt_query);
	
	if($opt_cnt == 0){
		$avg_point = 0;
	} else {
		$total_point = 0;
		for($opt_i2=0; $opt_i2<$opt_cnt; $opt_i2++){  
			$opt_row = mysqli_fetch_array($opt_query);
		
			$service_100data_quiz_val = $opt_row['analysis_report_service_100data_quiz_val'];			
			$total_point = $total_point + $service_100data_quiz_val;
		}
		$avg_point = round($total_point/$opt_cnt,$service_option_scorepoint);
	
	}

	return $avg_point;

}

function get_service_data_val_avg_tot1($service_option_idx,$quiz_no){
	
	$opt_sql .= "select analysis_report_service_data_quiz_val from wise_analysis_report_service_data_quiz where 1 and service_option_idx = '".$service_option_idx."' and analysis_report_service_data_quiz_no = '".$quiz_no."' and analysis_report_service_data_quiz_title='전체'";
	$opt_query = mysqli_query($GLOBALS['gconnet'],$opt_sql);
	$opt_cnt = mysqli_num_rows($opt_query);
	
	$total_point = 0;
	for($opt_i2=0; $opt_i2<$opt_cnt; $opt_i2++){  
		$opt_row = mysqli_fetch_array($opt_query);
		$total_point = $total_point + $opt_row['analysis_report_service_data_quiz_val'];
	}
	
	$avg_point = round($total_point/$opt_cnt,1);
	return $avg_point;
}

function get_service_data_val_avg_tot2($service_option_idx,$quiz_no,$ans_i){
	
	$opt_sql .= "select analysis_report_service_data_quiz_val from wise_analysis_report_service_data_quiz where 1 and service_option_idx = '".$service_option_idx."' and analysis_report_service_data_quiz_no = '".$quiz_no."' and analysis_report_service_data_quiz_title='".$ans_i." 의 평균'";
	$opt_query = mysqli_query($GLOBALS['gconnet'],$opt_sql);
	$opt_cnt = mysqli_num_rows($opt_query);
	
	$total_point = 0;
	for($opt_i2=0; $opt_i2<$opt_cnt; $opt_i2++){  
		$opt_row = mysqli_fetch_array($opt_query);
		$total_point = $total_point + $opt_row['analysis_report_service_data_quiz_val'];
	}
	
	$avg_point = round($total_point/$opt_cnt,1);
	return $avg_point;
}

function set_rst_service_data_quiz_align($service_option_idx,$service_option_100data_idx){
	$sql_file_1 = "select idx from wise_analysis_report_service_100data_tlc where 1 and service_option_idx='".$service_option_idx."' and service_option_100data_idx='".$service_option_100data_idx."' order by CONVERT(analysis_report_service_100data_total, UNSIGNED) desc";
	$query_file_1 = mysqli_query($GLOBALS['gconnet'],$sql_file_1);
	$query_file_1_cnt = mysqli_num_rows($query_file_1);
	
	for($opt_i=0; $opt_i<$query_file_1_cnt; $opt_i++){ // 총점 데이터 루프 시작 
		$row_file_1 = mysqli_fetch_array($query_file_1);

		$query_in = "update wise_analysis_report_service_100data_tlc set"; 
		$query_in .= " analysis_report_service_100data_count = '".($opt_i+1)."' ";
		$query_in .= " where 1 and idx='".$row_file_1['idx']."'";
		$result_in = mysqli_query($GLOBALS['gconnet'],$query_in);

	} // 총점 데이터 루프 종료
}

function get_satisf_loyalty_val($satisfaction_option_idx,$analysis_report_idx,$data_quiz_no="",$data_quiz_ans="",$loyalty){
	
	$sql_prev_2 = "select idx from wise_analysis_report_satisfaction_option_point_case where 1 and satisfaction_option_idx='".$satisfaction_option_idx."'"; // 케이스 설정한값이 있는가
	$query_prev_2 = mysqli_query($GLOBALS['gconnet'],$sql_prev_2);
	$query_prev_2_cnt = mysqli_num_rows($query_prev_2);

	if($data_quiz_no && $data_quiz_ans){ // 문항별 시작  

		if($query_prev_2_cnt > 0){
			$sql_file_1 = "select analysis_report_satisfaction_100data_no from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_quiz_no='".$data_quiz_no."' and analysis_report_satisfaction_100data_quiz_val='".$data_quiz_ans."' and analysis_report_satisfaction_100data_no in (select analysis_report_satisfaction_100data_no from wise_analysis_report_satisfaction_100data_detail where 1 and analysis_report_satisfaction_100data_quiz_no in (select quiz_no from wise_analysis_quiz where 1 and analysis_idx='".$analysis_report_idx."' and idx in (select analysis_report_satisfaction_option_case_no from wise_analysis_report_satisfaction_option_point_case where 1 and satisfaction_option_idx='".$satisfaction_option_idx."')) and analysis_report_satisfaction_100data_quiz_val = (select analysis_report_satisfaction_option_case_answer from wise_analysis_report_satisfaction_option_point_case where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_option_case_no=(select idx from wise_analysis_quiz where 1 and analysis_idx='".$analysis_report_idx."' and quiz_no=wise_analysis_report_satisfaction_100data_detail.analysis_report_satisfaction_100data_quiz_no)))"; 
		} else {
			$sql_file_1 = "select analysis_report_satisfaction_100data_no from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_quiz_no='".$data_quiz_no."' and analysis_report_satisfaction_100data_quiz_val='".$data_quiz_ans."' and analysis_report_satisfaction_100data_no in (select analysis_report_satisfaction_100data_no from wise_analysis_report_satisfaction_100data_detail where 1 and analysis_report_satisfaction_100data_quiz_no in (select quiz_no from wise_analysis_quiz where 1 and analysis_idx='".$analysis_report_idx."'))"; 
		}

		$query_file_1 = mysqli_query($GLOBALS['gconnet'],$sql_file_1);
		$query_file_1_cnt = mysqli_num_rows($query_file_1);
		
		$total_point = 0;
		for($opt_i=0; $opt_i<$query_file_1_cnt; $opt_i++){ // 문항조건 루프시작  
			$row_file_1 = mysqli_fetch_array($query_file_1);

			$sql_file_2 = "select idx from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_no='".$row_file_1['analysis_report_satisfaction_100data_no']."' and analysis_report_satisfaction_100data_quiz_title='고객충성집단' and analysis_report_satisfaction_100data_quiz_val='".$loyalty."'"; 
			$query_file_2 = mysqli_query($GLOBALS['gconnet'],$sql_file_2);
			if(mysqli_num_rows($query_file_2) > 0){
				$total_point = $total_point+1;
			}
		} // 문항조건 루프종료 
	} else { // 문항별 종료, 전체값 
		
		if($query_prev_2_cnt > 0){
			$sql_file_2 = "select idx from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_quiz_title='고객충성집단' and analysis_report_satisfaction_100data_quiz_val='".$loyalty."' and analysis_report_satisfaction_100data_no in (select analysis_report_satisfaction_100data_no from wise_analysis_report_satisfaction_100data_detail where 1 and analysis_report_satisfaction_100data_quiz_no in (select quiz_no from wise_analysis_quiz where 1 and analysis_idx='".$analysis_report_idx."' and idx in (select analysis_report_satisfaction_option_case_no from wise_analysis_report_satisfaction_option_point_case where 1 and satisfaction_option_idx='".$satisfaction_option_idx."')) and analysis_report_satisfaction_100data_quiz_val = (select analysis_report_satisfaction_option_case_answer from wise_analysis_report_satisfaction_option_point_case where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_option_case_no=(select idx from wise_analysis_quiz where 1 and analysis_idx='".$analysis_report_idx."' and quiz_no=wise_analysis_report_satisfaction_100data_detail.analysis_report_satisfaction_100data_quiz_no)))"; 
		} else {
			$sql_file_2 = "select idx from wise_analysis_report_satisfaction_100data_detail where 1 and satisfaction_option_idx='".$satisfaction_option_idx."' and analysis_report_satisfaction_100data_quiz_title='고객충성집단' and analysis_report_satisfaction_100data_quiz_val='".$loyalty."' and analysis_report_satisfaction_100data_no in (select analysis_report_satisfaction_100data_no from wise_analysis_report_satisfaction_100data_detail where 1 and analysis_report_satisfaction_100data_quiz_no in (select quiz_no from wise_analysis_quiz where 1 and analysis_idx='".$analysis_report_idx."'))"; 
		}

		$query_file_2 = mysqli_query($GLOBALS['gconnet'],$sql_file_2);
		$total_point = mysqli_num_rows($query_file_2);

	} // 전체값 종료 

	return $total_point;
}

function get_report_service_data_quiz_val($service_option_idx,$service_data_idx,$where=""){
	
	$opt_sql = "select analysis_report_service_data_quiz_val from wise_analysis_report_service_data_quiz where service_option_idx='".$service_option_idx."' and  service_data_idx='".$service_data_idx."'";
	if($where){
		$opt_sql .= $where;		
	}
	
	//echo "opt_sql = ".$opt_sql."<br>";
	$opt_query = mysqli_query($GLOBALS['gconnet'],$opt_sql);
	$opt_row = mysqli_fetch_array($opt_query);
	
	return $opt_row['analysis_report_service_data_quiz_val'];
}

function set_report_service_data_quiz_val($service_option_idx,$file_1_quizno2,$title,$val){

	//$opt_sql = "select idx from wise_analysis_report_service_data_quiz where 1 and service_option_idx = '".$service_option_idx."' and analysis_report_service_data_quiz_no = '".$file_1_quizno2."' and service_data_idx is null";
	$opt_sql = "select idx from wise_analysis_report_service_data_quiz where 1 and service_option_idx = '".$service_option_idx."' and analysis_report_service_data_quiz_no = '".$file_1_quizno2."' and analysis_report_service_data_quiz_title = '".$title."' and service_data_idx is null";
	$opt_query = mysqli_query($GLOBALS['gconnet'],$opt_sql);
	
	if(mysqli_num_rows($opt_query) == 0){
		$query_in3 = "insert into wise_analysis_report_service_data_quiz set"; 
		$query_in3 .= " service_option_idx = '".$service_option_idx."', ";
		$query_in3 .= " analysis_report_service_data_quiz_no = '".$file_1_quizno2."', ";
		$query_in3 .= " analysis_report_service_data_quiz_title = '".$title."', ";
		$query_in3 .= " analysis_report_service_data_quiz_val = '".$val."', ";
		$query_in3 .= " wdate = now() ";
		$result_in3 = mysqli_query($GLOBALS['gconnet'],$query_in3);

		$sql_file_1 = "select idx from wise_analysis_report_service_data_quiz where 1 and service_option_idx = '".$service_option_idx."' and analysis_report_service_data_quiz_no = '".$file_1_quizno2."' and service_data_idx is null order by analysis_report_service_data_quiz_val desc";
		$query_file_1 = mysqli_query($GLOBALS['gconnet'],$sql_file_1);
		$query_file_1_cnt = mysqli_num_rows($query_file_1);
	
		for($opt_i=0; $opt_i<$query_file_1_cnt; $opt_i++){ 
			$row_file_1 = mysqli_fetch_array($query_file_1);

			$query_in = "update wise_analysis_report_service_data_quiz set"; 
			$query_in .= " analysis_report_service_data_quiz_align = '".($opt_i+1)."' ";
			$query_in .= " where 1 and idx='".$row_file_1['idx']."'";
			$result_in = mysqli_query($GLOBALS['gconnet'],$query_in);
		} 

	} else {
		$query_in3 = "update wise_analysis_report_service_data_quiz set"; 
		$query_in3 .= " analysis_report_service_data_quiz_val = '".$val."'";
		$query_in3 .= " where 1 and service_option_idx = '".$service_option_idx."' and analysis_report_service_data_quiz_no = '".$file_1_quizno2."' and service_data_idx is null";
		//$result_in3 = mysqli_query($GLOBALS['gconnet'],$query_in3);
	}
	
}

function set_report_service_data_total_align($service_option_idx,$analysis_report_idx){
	$sql_file_1 = "select idx,analysis_report_service_option_percent,analysis_report_service_option_data_no,analysis_report_service_option_data_title from wise_analysis_report_service_data where 1 and service_option_idx='".$service_option_idx."' and analysis_report_service_option_data_title not like '%집단구분%'"; // 일반문항 
	$query_file_1 = mysqli_query($GLOBALS['gconnet'],$sql_file_1);
	$query_file_1_cnt = mysqli_num_rows($query_file_1);

	for($opt_i=0; $opt_i<$query_file_1_cnt; $opt_i++){
		$row_file_1 = mysqli_fetch_array($query_file_1);
	
		if($opt_i == $query_file_1_cnt-1){
			//$file_1_idx .= $row_file_1['analysis_report_service_option_data_no'];
			$file_1_idx .= $row_file_1['idx'];
			$file_1_title .= $row_file_1['analysis_report_service_option_data_title'];
		} else {
			//$file_1_idx .= $row_file_1['analysis_report_service_option_data_no'].",";
			$file_1_idx .= $row_file_1['idx'].",";
			$file_1_title .= $row_file_1['analysis_report_service_option_data_title'].",";
		}
	}

	$file_1_idx_arr = explode(",",$file_1_idx);
	$file_1_title_arr = explode(",",$file_1_title);

	$sql_prev_2 = "select idx from wise_analysis_report_service_option_point_case where 1 and service_option_idx='".$service_option_idx."'"; 
	$query_prev_2 = mysqli_query($GLOBALS['gconnet'],$sql_prev_2);
	$query_prev_2_cnt = mysqli_num_rows($query_prev_2);
	if($query_prev_2_cnt > 0){
		$detail_tb_name = "wise_analysis_report_service_100data_detail_case";
	} else {
		$detail_tb_name = "wise_analysis_report_service_100data_detail";
	}

	$sql_file_2 = "select idx,analysis_report_service_option_percent,analysis_report_service_option_data_no,analysis_report_service_option_data_title from wise_analysis_report_service_data where 1 and service_option_idx='".$service_option_idx."' and analysis_report_service_option_data_title like '%집단구분%'"; // 집단문항 
	$query_file_2 = mysqli_query($GLOBALS['gconnet'],$sql_file_2);
	$query_file_2_cnt = mysqli_num_rows($query_file_2);

	for($opt_i=0; $opt_i<$query_file_2_cnt; $opt_i++){
		$row_file_2 = mysqli_fetch_array($query_file_2);
	
		if($opt_i == $query_file_2_cnt-1){
			//$file_2_idx .= $row_file_2['analysis_report_service_option_data_no'];
			$file_2_idx .= $row_file_2['idx'];
			$file_2_quizno .= $row_file_2['analysis_report_service_option_data_no'];
			$file_2_title .= $row_file_2['analysis_report_service_option_data_title'];
		} else {
			//$file_2_idx .= $row_file_2['analysis_report_service_option_data_no'].",";
			$file_2_idx .= $row_file_2['idx'].",";
			$file_2_quizno .= $row_file_2['analysis_report_service_option_data_no'].",";
			$file_2_title .= $row_file_2['analysis_report_service_option_data_title'].",";
		}
	}

	$file_2_idx_arr = explode(",",$file_2_idx);
	$file_2_quizno_arr = explode(",",$file_2_quizno);
	$file_2_title_arr = explode(",",$file_2_title);

	$compet_info_sql = "select analysis_report_service_option_scorepoint from wise_analysis_report_service_option where 1 and idx='".$service_option_idx."'";
	$compet_info_query = mysqli_query($GLOBALS['gconnet'],$compet_info_sql);
	$compet_info_row = mysqli_fetch_array($compet_info_query);
	$service_option_scorepoint = trim($compet_info_row['analysis_report_service_option_scorepoint']);

	$sql_file_4 = "select analysis_report_service_data_quiz_no,analysis_report_service_data_quiz_title as analysis_report_service_data_quiz_title from wise_analysis_report_service_data_quiz where 1 and service_option_idx='".$service_option_idx."' and analysis_report_service_data_quiz_title != '전체' and service_data_idx='".$file_1_idx_arr[0]."'";
	$query_file_4 = mysqli_query($GLOBALS['gconnet'],$sql_file_4);
	$query_file_4_cnt = mysqli_num_rows($query_file_4);
	for($opt4_i=0; $opt4_i<$query_file_4_cnt; $opt4_i++){ // 집단구분 보기 시작 
		$row_file_4 = mysqli_fetch_array($query_file_4);

		$data_tot_1 = 0;
		for($opt_i=0; $opt_i<sizeof($file_1_title_arr); $opt_i++){ // 문항타이틀 루프 시작 
			$file_1_idx = trim($file_1_idx_arr[$opt_i]);
			$data_1 = get_report_service_data_quiz_val($service_option_idx,$file_1_idx,$where=" and analysis_report_service_data_quiz_no='".$row_file_4['analysis_report_service_data_quiz_no']."' and analysis_report_service_data_quiz_title='".$row_file_4['analysis_report_service_data_quiz_title']."'");

			$data_tot_1 = $data_tot_1+$data_1;
		} // 문항타이틀 루프 종료 

		$row_tot_avg = round($data_tot_1/sizeof($file_1_title_arr),$service_option_scorepoint);	
		set_report_service_data_quiz_val($service_option_idx,$row_file_4['analysis_report_service_data_quiz_no'],$row_file_4['analysis_report_service_data_quiz_title']."총점",$row_tot_avg); // 총점입력 및 순위조정 

	} // 집단구분 보기 종료
}

function set_rst_service_tlc_case($service_option_idx,$service_option_100data_idx,$service_100data_no,$analysis_report_idx){
	$sql_file_1 = "select analysis_report_service_100data_quiz_no,analysis_report_service_100data_quiz_val from wise_analysis_report_service_100data_detail_case where 1 and service_option_idx='".$service_option_idx."' and service_option_100data_idx='".$service_option_100data_idx."' and analysis_report_service_100data_no='".$service_100data_no."' and analysis_report_service_100data_quiz_no != '' and analysis_report_service_100data_quiz_no is not null order by analysis_report_service_100data_quiz_no asc";
	//echo "sql_file_1 = ".$sql_file_1."<br>"; exit;
	$query_file_1 = mysqli_query($GLOBALS['gconnet'],$sql_file_1);
	$query_file_1_cnt = mysqli_num_rows($query_file_1);
	
	$tot_score = 0; // 응답자 총점 
	for($opt_i=0; $opt_i<$query_file_1_cnt; $opt_i++){ // 응답자의 참여데이터 루프 시작 
		$row_file_1 = mysqli_fetch_array($query_file_1);

		$sql_file_2 = "select analysis_report_service_option_samescyn_quiz_score from wise_analysis_report_service_option_samescyn_quiz where 1 and service_option_idx='".$service_option_idx."' and analysis_report_service_option_samescyn_quiz_no=(select idx from wise_analysis_quiz where 1 and quiz_no='".$row_file_1['analysis_report_service_100data_quiz_no']."' and analysis_idx='".$analysis_report_idx."')";

		//echo "sql_file_2 = ".$sql_file_2."<br>"; 
		$query_file_2 = mysqli_query($GLOBALS['gconnet'],$sql_file_2);
		$query_file_2_cnt = mysqli_num_rows($query_file_2);
		
		$tot_sub_score = 0; // 문항당 배점적용 총점 
		for($opt2_i=0; $opt2_i<$query_file_2_cnt; $opt2_i++){ // 문항 배점배당 루프 시작 
			$row_file_2 = mysqli_fetch_array($query_file_2);

			$bdscore = $row_file_2['analysis_report_service_option_samescyn_quiz_score']/100; // 배당 % 화 
			$tot_sub_score = $tot_sub_score+($row_file_1['analysis_report_service_100data_quiz_val']*$bdscore); // 각 문항당 배점적용 계산값
		
		} // 문항 배점배당 루프 종료 
				
		$tot_score = $tot_score+$tot_sub_score;
		
	} // 응답자의 참여데이터 루프 종료
	
	//exit;
	$tot_score = round($tot_score,1);

	$sql_file_3 = "select idx,analysis_report_service_option_levelyn_title from wise_analysis_report_service_option_levelyn where 1 and service_option_idx='".$service_option_idx."' and CONVERT(analysis_report_service_option_levelyn_spoint, UNSIGNED) <= '".$tot_score."' and CONVERT(analysis_report_service_option_levelyn_epoint, UNSIGNED) >= '".$tot_score."'"; // 등급기준
	$query_file_3 = mysqli_query($GLOBALS['gconnet'],$sql_file_3);

	if(mysqli_num_rows($query_file_3) == 0){
		$query_in = "insert into wise_analysis_report_service_100data_tlc_case set"; 
		$query_in .= " service_option_idx = '".$service_option_idx."', ";
		$query_in .= " service_option_100data_idx = '".$service_option_100data_idx."', ";
		$query_in .= " analysis_report_service_100data_no = '".$service_100data_no."', ";
		$query_in .= " analysis_report_service_100data_total = '".$tot_score."', ";
		$query_in .= " wdate = now() ";
	} else {
		$row_file_3 = mysqli_fetch_array($query_file_3);
		$query_in = "insert into wise_analysis_report_service_100data_tlc_case set"; 
		$query_in .= " service_option_idx = '".$service_option_idx."', ";
		$query_in .= " service_option_100data_idx = '".$service_option_100data_idx."', ";
		$query_in .= " analysis_report_service_100data_no = '".$service_100data_no."', ";
		$query_in .= " analysis_report_service_100data_total = '".$tot_score."', ";
		$query_in .= " analysis_report_service_option_level_no = '".$row_file_3['idx']."', ";
		$query_in .= " analysis_report_service_option_level_title = '".$row_file_3['analysis_report_service_option_levelyn_title']."', ";
		$query_in .= " wdate = now() ";
	}
	
	$result_in = mysqli_query($GLOBALS['gconnet'],$query_in);
}

function get_frequency_val_service($service_option_idx,$analysis_report_idx,$quiz_no="",$ans_no="",$level_idx=""){
	$sql_prev_2 = "select idx from wise_analysis_report_service_option_point_case where 1 and service_option_idx='".$service_option_idx."'"; 
	$query_prev_2 = mysqli_query($GLOBALS['gconnet'],$sql_prev_2);
	$query_prev_2_cnt = mysqli_num_rows($query_prev_2);
	if($query_prev_2_cnt > 0){
		$detail_tb_name = "wise_analysis_report_service_100data_detail_case";
		$detail_tb2_name = "wise_analysis_report_service_100data_tlc_case";
	} else {
		$detail_tb_name = "wise_analysis_report_service_100data_detail";
		$detail_tb2_name = "wise_analysis_report_service_100data_tlc";
	}
	
	if($quiz_no && $ans_no){
		$opt_sql = "select distinct(analysis_report_service_100data_no) from ".$detail_tb_name." where 1 and service_option_idx='".$service_option_idx."' and analysis_report_service_100data_no in (select data_no from wise_analysis_data where 1 and analysis_idx='".$analysis_report_idx."' and quiz_no='".$quiz_no."' and data_val='".$ans_no."')";
	} else {
		$opt_sql = "select distinct(analysis_report_service_100data_no) from ".$detail_tb_name." where 1 and service_option_idx='".$service_option_idx."' and analysis_report_service_100data_no in (select data_no from wise_analysis_data where 1 and analysis_idx='".$analysis_report_idx."')";
	}

	if($level_idx){
		$opt_sql .= " and analysis_report_service_100data_no in (select analysis_report_service_100data_no from ".$detail_tb2_name." where 1 and analysis_report_service_option_level_no='".$level_idx."')";
	}

	//echo "opt_sql = ".$opt_sql."<br>";
	$opt_query = mysqli_query($GLOBALS['gconnet'],$opt_sql);
	$opt_cnt = mysqli_num_rows($opt_query);
	
	return $opt_cnt;
}

function get_ratio_val_service($service_option_idx,$analysis_report_idx,$quiz_no,$ans_no,$level_idx=""){
	$compet_info_sql = "select analysis_report_service_option_scorepoint from wise_analysis_report_service_option where 1 and idx='".$service_option_idx."'";
	$compet_info_query = mysqli_query($GLOBALS['gconnet'],$compet_info_sql);
	$compet_info_row = mysqli_fetch_array($compet_info_query);
	$service_option_scorepoint = trim($compet_info_row['analysis_report_service_option_scorepoint']);
	
	$sql_prev_2 = "select idx from wise_analysis_report_service_option_point_case where 1 and service_option_idx='".$service_option_idx."'"; 
	$query_prev_2 = mysqli_query($GLOBALS['gconnet'],$sql_prev_2);
	$query_prev_2_cnt = mysqli_num_rows($query_prev_2);
	if($query_prev_2_cnt > 0){
		$detail_tb_name = "wise_analysis_report_service_100data_detail_case";
		$detail_tb2_name = "wise_analysis_report_service_100data_tlc_case";
	} else {
		$detail_tb_name = "wise_analysis_report_service_100data_detail";
		$detail_tb2_name = "wise_analysis_report_service_100data_tlc";
	}

	$opt_tot_sql = "select distinct(analysis_report_service_100data_no) from ".$detail_tb_name." where 1 and service_option_idx='".$service_option_idx."'";
	if($level_idx){
		$opt_tot_sql .= " and analysis_report_service_100data_no in (select analysis_report_service_100data_no from ".$detail_tb2_name." where 1 and analysis_report_service_option_level_no='".$level_idx."')";
	}
	$opt_tot_query = mysqli_query($GLOBALS['gconnet'],$opt_tot_sql);
	$opt_tot_cnt = mysqli_num_rows($opt_tot_query);
	
	if($quiz_no && $ans_no){
		$opt_sql = "select distinct(analysis_report_service_100data_no) from ".$detail_tb_name." where 1 and service_option_idx='".$service_option_idx."' and analysis_report_service_100data_no in (select data_no from wise_analysis_data where 1 and analysis_idx='".$analysis_report_idx."' and quiz_no='".$quiz_no."' and data_val='".$ans_no."')";
	} else {
		$opt_sql = "select distinct(analysis_report_service_100data_no) from ".$detail_tb_name." where 1 and service_option_idx='".$service_option_idx."' and analysis_report_service_100data_no in (select data_no from wise_analysis_data where 1 and analysis_idx='".$analysis_report_idx."')";
	}

	if($level_idx){
		$opt_sql .= " and analysis_report_service_100data_no in (select analysis_report_service_100data_no from ".$detail_tb2_name." where 1 and analysis_report_service_option_level_no='".$level_idx."')";
	}
	$opt_query = mysqli_query($GLOBALS['gconnet'],$opt_sql);
	$opt_cnt = mysqli_num_rows($opt_query);
	
	if($opt_tot_cnt == 0){
		$avg_point = 0;
	} else {
		$avg_point = round($opt_cnt/$opt_tot_cnt,$service_option_scorepoint);
		$avg_point = $avg_point*100;
	}

	return $avg_point;
}

?>
