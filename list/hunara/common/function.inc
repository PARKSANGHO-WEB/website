<?php

/* ┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
	┃ 데이터베이스 관련 함수																														   ┃
	┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛*/
    //DB 연결
    
    $db = mysqli_connect($db_host, $db_id, $db_pw, $db_name);
    
	//데이터 자동 인서트
	function db_insert($table, $data){
		global $conn;

		if(!$table or !is_array($data)) return false;
		$columns = implode(', ',array_keys($data));
		$values = implode("', '",array_values($data));
		
		db_query("insert into $table ($columns) values ('$values')");
		//echo "insert into $table ($columns) values ('$values')";
	}

	//데이터 자동 업데이트
	function db_update($table, $data, $where=""){
		global $conn;

		if(!$table or !is_array($data)) return false;
		foreach($data as $key=>$val){
			$str[] = $key."='".$val."'";
		}
		if($where) $where=" where $where";

		db_query("update $table set ".implode(", ",$str)." $where");
	}

/* ┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
	┃ 개발자 정의 함수																																	   ┃
	┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛*/

	//인젝션 공격 방지
	function  anti_injection($string){
		if ($string){
			$str =  trim($string);
			$str =  str_replace("'","&#039;",$str);
			$str =  str_replace("<xmp","<x-xmp",$str);
			$str =  str_replace("javascript","x-javascript",$str);
			$str =  str_replace("script","x-script",$str);
			$str =  str_replace("iframe","x-iframe",$str);
			$str =  str_replace("document","x-document",$str);
			$str =  str_replace("vbscript","x-vbscript",$str);
			$str =  str_replace("applet","x-applet",$str);
			$str =  str_replace("embed","x-embed",$str);
			$str =  str_replace("object","x-object",$str);
			$str =  str_replace("frame","x-frame",$str);
			$str =  str_replace("frameset","x-frameset",$str);
			$str =  str_replace("layer","x-layer",$str);
			$str =  str_replace("bgsound","x-bgsound",$str);
			$str =  str_replace("alert","x-alert",$str);

			$str =  str_replace("onblur","x-onblur",$str);
			$str =  str_replace("onchange","x-onchange",$str);
			$str =  str_replace("onclick","x-onclick",$str);
			$str =  str_replace("ondblclick","x-ondblclick",$str);
			$str =  str_replace("onerror","x-onerror",$str);
			$str =  str_replace("onfocus","x-onfocus",$str);
			$str =  str_replace("onload","x-onload",$str);
			$str =  str_replace("onmouse","x-onmouse",$str);
			$str =  str_replace("onscroll","x-onscrol",$str);
			$str =  str_replace("onsubmit'","x-onsubmit",$str);
			$str =  str_replace("onunload","x-onunload",$str);

			return $str;

		}else{
			return $string;
		}
	}

	//페이지 이동 스크립트
	function move_page($url, $second="0"){
		echo"<meta http-equiv=\"refresh\" content=\"$second; url=$url\">";
		exit;
	}

	//메세지 팝업 후 이동
	function msg_page($msg, $url=""){
		if($url==""){
			$url="history.go(-1)";
		}else if($url=="close"){
			$url="self.close()";
		}else if($url=="refresh"){
			$url="opener.location.reload();self.close();";
		}else{
			$url="document.location.href='$url'";
		}

		echo "<script type='text/javascript'>alert('$msg');$url;</script>";
		exit;
	}

	//페이지 닫고 본창 이동
	function close_page($url){
		echo "<script type='text/javascript'>opener.location.href='$url';window.close();</script>";
	}

	//페이지 닫고 본창 이동
	function msg_close_page($msg, $url){
		echo "<script type='text/javascript'>alert('$msg');opener.location.href='$url';window.close();</script>";
	}

	//파일 업로드 (tmp 파일, 파일명, 저장할 디렉토리, 파일명 변경 여부->2:변경)
	function file_upload($file, $file_name, $path, $change="2",$org=""){

		$file_check = explode(".", $file_name);
		$ext = strtolower($file_check[count($file_check)-1]);					// 파일 확장자 구하기

		if($org==""){
			$org_name = str_replace(".".$ext, "", $file_name);
			$org_name = str_replace(" ", "_", $org_name);
		}else{
			$org_name = $org;
		}

		$file_list = array ('html','htm','php','phtml','php3','php4','php5','asp','jsp', 'exe', 'js','cgi','inc','pl'); // 금지 파일 항목

		// 금지 파일인지 아닌지 확인 시작
		if(in_array($ext, $file_list)){
			echo "<script>alert('등록 가능한 파일이 아닙니다.');history.go(-1);</script>";
			exit;
		}

		if(!is_dir($path)){
			mkdir($path, 0777);
			chmod("$path", 0777);
		}

		$tmp_filename = ($change==1 ? $org_name.".".$ext : time().".".$ext);

		$i = 1;
		while(file_exists($path."/".$tmp_filename)){
			$tmp_filename = ($change==1 ? $org_name."_".$i.".".$ext : time().".".$ext);
			$i++;
		}

		if(!move_uploaded_file($file, "$path/$tmp_filename")){
			echo "파일 업로드 Error!! 시스템 관리자에게 문의해주세요";
			exit;
		}
		return $tmp_filename;
	}

	//파일 삭제
	function file_delete($file_name, $path){
		if(is_file($path."/".$file_name)){
			@unlink($path."/".$file_name);
		}
	}

	//배열값 확인하기
	function print_array($arr){
		echo "<pre>"; print_r($arr); echo "</pre>";
		exit;
	}

	// 페이징 처리 함수
	function page_list($page="1", $count, $list_num="15", $page_num="10", $url="", $first_page="", $post_start="", $next_start="", $last_page="", $link_color="#6EB3DB") {
		global $page_first_page;
		global $page_post_start;
		global $page_next_start;
		global $page_last_page;

		$link=$_SERVER['PHP_SELF'];
		if(!$first_page) $first_page= $page_first_page;
		if(!$post_start) $post_start=$page_post_start;
		if(!$next_start) $next_start=$page_next_start;
		if(!$last_page) $last_page=$page_last_page;

		// 1. 전체 페이지 계산
		$total_page  = ceil($count / $list_num);

		$start_page = @(((int)(($page-1)/$page_num))*$page_num)+1;
		$temp_pnum = $page_num - 1 ;
		$end_page = $start_page + $temp_pnum;

		if ($end_page >= $total_page) $end_page = $total_page;
		if ($page > 1) {
			$link_str .= " <a href='".$link."?".$url.($url?"&":"")."page=1' class='arrow'>".$first_page."</a> ";
		}

		if ($start_page > 1) {
			$link_str .= " <a href='".$link."?".$url.($url?"&":"")."page=".($start_page-1)."' class='arrow'>".$post_start."</a> ";
		}

		if ($total_page > 1) {
			for ($i=$start_page;$i<=$end_page;$i++) {
				if ($page != $i) {
					$link_str .= " <a href='".$link."?".$url.($url?"&":"")."page=".$i."'>$i</a> ";
				} else {
					$link_str .= " <a class='on'>$i</a> ";
				}
			}
		}else{
			$link_str .= "<a class='on'>1</a>";
		}

		if ($total_page > $end_page) {
			$link_str .= " <a href='".$link."?".$url.($url?"&":"")."page=".($end_page+1)."' class='arrow'>".$next_start."</a> ";
		}

		if ($page < $total_page) $link_str .= " <a href='".$link."?".$url.($url?"&":"")."page=".$total_page."' class='arrow'>".$last_page."</a> ";

		if($total_page>1) echo $link_str;
	}

	// 페이징 처리 함수
	function page_list_new($page="1", $count, $list_num="15", $page_num="10", $url="", $first_page="", $post_start="", $next_start="", $last_page="", $link_color="#6EB3DB") {
		global $page_first_page;
		global $page_post_start;
		global $page_next_start;
		global $page_last_page;

		$link=$_SERVER['PHP_SELF'];
		if(!$first_page) $first_page= $page_first_page;
		if(!$post_start) $post_start=$page_post_start;
		if(!$next_start) $next_start=$page_next_start;
		if(!$last_page) $last_page=$page_last_page;

		// 1. 전체 페이지 계산
		$total_page  = ceil($count / $list_num);

		if($page <= ceil($page_num/2)) $start_page = 1;
		else{
			$start_page = $page - floor($page_num/2);
		}

		//$start_page = @(((int)(($page-1)/$page_num))*$page_num)+1;
		$temp_pnum = $page_num - 1 ;
		$end_page = $start_page + $temp_pnum;

		if ($end_page >= $total_page) $end_page = $total_page;
		if ($page > 1) {
			$link_str .= "<li class=\"pageArr first\"><a href='".$link."?".$url.($url?"&":"")."page=1' class=\"ir\">처음</a></li>";
		}

		if ($start_page > 1) {
			$link_str .= "<li class=\"pageArr prev\"><a href='".$link."?".$url.($url?"&":"")."page=".($page-1)."' class=\"ir\">이전</a></li>";
		}

		if ($total_page > 1) {
			for ($i=$start_page;$i<=$end_page;$i++) {
				if ($page != $i) {
					$link_str .= "<li><a href='".$link."?".$url.($url?"&":"")."page=".$i."'>$i</a></li>";
				} else {
					$link_str .= "<li class=\"active\"><a href='".$link."?".$url.($url?"&":"")."page=".$i."'>$i</a></li>";
				}
			}
		}else{
			$link_str .= "<li class=\"active\"><a href='".$link."?".$url.($url?"&":"")."page=".$i."'>1</a>";
		}

		if ($total_page > $end_page) {
			$link_str .= "<li class=\"pageArr next\"><a href='".$link."?".$url.($url?"&":"")."page=".($page+1)."' class=\"ir\">다음</a></li>";
		}

		if ($page < $total_page) $link_str .= "<li class=\"pageArr last\"><a href='".$link."?".$url.($url?"&":"")."page=".$total_page."' class=\"ir\">끝</a></li>";

		if($total_page>1) echo $link_str;
	}



	//값이 없을 시 기본값 설정
	function default_set($val, $default){
		if($val){
			return $val;
		}else{
			return $default;
		}
	}

	# 사용법 : hangul("자를 문자열", 원하는 문자열 길이);
	function is_han($text) {
		$text = ord($text);
		if($text >= 0xa1 && $text <= 0xfe)
		return 1;
	}
	function is_alpha($char) {
		$char = ord($char);
		if($char >= 0x61 && $char <= 0x7a)		return 1;
		if($char >= 0x41 && $char <= 0x5a)		return 2;
	}

	# 함수명 : 문자열 자르기 함수 3개 함수로 구성
	function cutstr($str, $len, $checkmb=true, $tail='...') {

		//$checkmb : 이 값을 true로 하면 한글을 영문2자와 같이 취급한다. false 는 한글 한글자는 한글자.
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
		return join('', $ret).$tail;
	}

	//첨부파일 다운로드 (파일경로, 파일명, 다운시표시파일명)
	function file_down($Path,$File,$Org=""){

		$Org=($Org ? $Org : $File);
		$DownFile =$Path."/".$File;
		$Org=iconv("UTF-8","EUC-KR",$Org);

		Header("Cache-Control: cache, must-revalidate, post-check=0, pre-check=0");
		Header("Content-type: application/x-msdownload");
		Header("Content-Length: ".(string)(filesize($DownFile)));
		Header("Content-Disposition: attachment; filename=".$Org."");
		Header("Content-Description: PHP5 Generated Data");
		Header("Content-Transfer-incoding: euc_kr");
		Header("Content-Transfer-Encoding: binary");
		Header("Pragma: no-cache");
		Header("Expires: 0");
		Header("Content-Description: File Transfer");

		if (is_file($DownFile)) {
			$fp = fopen($DownFile, "rb");

			if (!fpassthru($fp)) fclose($fp);
			clearstatcache();
		} else {
			ErrorMessage("해당파일이나 경로가 존재하지 않습니다.");
			exit();
		}
	}

	//파일 사이즈를 GB,MB,KB 에 맞추어서 변환해서 리턴
	function get_filesize($size) {
		if(!$size) return "0 Byte";

		if($size >= 1073741824) {
			$size = sprintf("%0.3fGB",$size / 1073741824);
		} elseif($size >= 1048576) {
			$size = sprintf("%0.2fMB",$size / 1048576);
		} elseif($size >= 1024)  {
			$size = sprintf("%0.1fKB",$size / 1024);
		} else {
			$size = $size."Byte";
		}

		return $size;
	}

	//메일발송
	function sendMail($subject,$body,$fromEmail, $toEmail ){

		global $success ;

		$subject = stripslashes($subject);
		$body = stripslashes($body);

		//스크립트 종료할때까지
		set_time_limit(0);

		//메일의 헤더와 내용
		$additional_headers="from:".$fromEmail."\n";
		$additional_headers.="reply-to : " . $fromEmail . "\n";
		$additional_headers.="content-type:text/html;";
		$mail_from = "webmaster@trenbyme.co.kr";

		if(mail($toEmail, encode_2047($subject), $body, $additional_headers, '-f'.$mail_from)) $success ++;
	}

	//메일
	function sendMail2($NAME, $mailto, $SUBJECT, $CONTENT, $mailForm = ""){
	  //$NAME : 보낸이
	  //$mailto : 보낼 메일주소
	  //$SUBJECT : 메일 제목
	  //$CONTENT : 메일 내용
	  //$mailForm : 답장받을 주소
	  $admin_email = ($mailForm == "")? SEND_MAIL_ADMIN : $mailForm; //답장받을 주소
	  $admin_name = $NAME;

	  $header = "Return-Path: ".$admin_email."\n";
	  //$header .= "From: =?UTF-8?B?".base64_encode($admin_name)."?= <".$admin_email.">\n";
	  $header .= "From: =?UTF-8?B?".$admin_name."?= <".$admin_email.">\n";
	  $header .= "MIME-Version: 1.0\n";
	  $header .= "X-Priority: 3\n";
	  $header .= "X-MSMail-Priority: Normal\n";
	  $header .= "X-Mailer: FormMailer\n";
	  $header .= "Content-Transfer-Encoding: base64\n";
	  $header .= "Content-Type: text/html;\n \tcharset=utf-8\n";

	  $subject = "=?UTF-8?B?".base64_encode($SUBJECT)."?=\n";
	  $contents = $CONTENT;
		
	  if($mailto == ""){
		$mailto = SEND_MAIL_ADMIN;
	  }


	  $message = base64_encode($contents);
	  flush();
	  return mail($mailto, $subject, $message, $header);
	}

	//제목에 2047인코딩하기
	function encode_2047($subject) {
			return '=?utf-8?b?'.base64_encode($subject).'?=';
	}

	//썸네일로 만드는 함수
	function thumbnail($file, $save_filename, $max_width=100, $max_height=100, $sizeChg=1){

		$img_info=@getimagesize($file);//이미지 사이즈를 확인합니다.

		//이미지 타입을 이용해 변수를 재지정해줍니다.
		//------------------------------------------------------
		// Imagetype Constants
		//------------------------------------------------------
		// 1 IMAGETYPE_GIF
		// 2 IMAGETYPE_JPEG
		// 3 IMAGETYPE_PNG
		// 4 IMAGETYPE_SWF
		// 5 IMAGETYPE_PSD
		// 6 IMAGETYPE_BMP
		// 7 IMAGETYPE_TIFF_II (intel byte order)
		// 8 IMAGETYPE_TIFF_MM (motorola byte order)
		// 9 IMAGETYPE_JPC
		// 10 IMAGETYPE_JP2
		// 11 IMAGETYPE_JPX
		// 12 IMAGETYPE_JB2
		// 13 IMAGETYPE_SWC
		// 14 IMAGETYPE_IFF
		// 15 IMAGETYPE_WBMP
		// 16 IMAGETYPE_XBM
		//------------------------------------------------------


		if($img_info[2]==1) $src_img=ImageCreateFromGIF($file);
		elseif($img_info[2]==2) $src_img=ImageCreateFromJPEG($file);
		elseif($img_info[2]==3) $src_img=ImageCreateFromPNG($file);
		elseif($img_info[2]==4) $src_img=ImageCreateFromWBMP($file);
		else return false;

		$img_info = getImageSize($file);//원본이미지의 정보를 얻어옵니다
		$img_width = $img_info[0];
		$img_height = $img_info[1];

		$crt_width=$max_width;  //생성되면 이미지 사이즈
		$crt_height=$max_height;

		//1.가로 세로 원본비율을 맞추고, 남은 영역에 색채워서 정해진 크기로 생성
		if($sizeChg==1){

			if(($img_width/$max_width) == ($img_height/$max_height)){ //원본과 썸네일의 가로세로비율이 같은경우
				$dst_x = 0;
				$dst_y = 0;
				$dst_width=$max_width;
				$dst_height=$max_height;
			}
			elseif(($img_width/$max_width) < ($img_height/$max_height)){ //세로에 기준을 둔경우
				$dst_x= ($max_width - $img_width*($max_height/$img_height) ) / 2;
				$dst_y = 0;

				$dst_width=$max_height*($img_width/$img_height);
				$dst_height=$max_height;
			}
			else{ //가로에 기준을 둔경우
				$dst_x= 0;
				$dst_y = ($max_height - $img_height*($max_width/$img_width) ) / 2;

				$dst_width=$max_width;
				$dst_height=$max_width*($img_height/$img_width);
			}


		//2.가로 세로 원본비율을 맞추고, 남은 영역없이 이미지만 컷 생성
		}else if($sizeChg==2){

			if(($img_width/$max_width) == ($img_height/$max_height)){ //원본과 썸네일의 가로세로비율이 같은경우
				$dst_width=$max_width;
				$dst_height=$max_height;
			}
			elseif(($img_width/$max_width) < ($img_height/$max_height)){ //세로에 기준을 둔경우
				$dst_width=$max_height*($img_width/$img_height);
				$dst_height=$max_height;
			}
			else{//가로에 기준을 둔경우
				$dst_width=$max_width;
				$dst_height=$max_width*($img_height/$img_width);
			}

			$dst_x= 0;
			$dst_y = 0;

			$crt_width=$dst_width;
			$crt_height=$dst_height;


		//3.가로 세로 원본비율을 맞추지 않고, 정해진 크기대로 생성
		}else{

			$dst_width=$max_width;
			$dst_height=$max_height;

			$dst_x= 0;
			$dst_y = 0;
		}

		$dst_img = imagecreatetruecolor($crt_width, $crt_height); //타겟이미지를 생성합니다

		$white = imagecolorallocate($dst_img,255,255,255);
		imagefill($dst_img, 0, 0, $white);

		ImageCopyResized($dst_img, $src_img, $dst_x, $dst_y, 0, 0, $dst_width, $dst_height, $img_width, $img_height); //타겟이미지에 원하는 사이즈의 이미지를 저장합니다
		ImageInterlace($dst_img);

		switch ($img_info[2]){
			case "1" : ImageGIF($dst_img,  $save_filename); break;
			case "2" : ImageJPEG($dst_img,  $save_filename); break;
			case "3" :
				imagealphablending($dst_img, false);
				imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, 0, 0, $dst_width, $dst_height, $img_width, $img_height); //(생성이미지,원소스이미지,시작점X,시작점Y,원본소스상 시작점X,원본소스상 시작점Y,생성이미지너비, 생성이미지높이,원이미지너비,원이미지높이)
				imagesavealpha($dst_img, true);
				ImagePNG($dst_img,  $save_filename,0);
				break;

			case "4" : ImageWBMP($dst_img,  $save_filename); break;
		}

		ImageDestroy($dst_img);
		ImageDestroy($src_img);
	}

	//기본값 설정
	function setDefault($val,$default){
		return ($val ? $val : $default);
	}

	//회원 로그인 여부 체크
	function loginAuth(){
		if(!$_SESSION['LOGIN_ID']){
			msg_page("회원만 이용 가능합니다. 로그인 후 이용하세요.","/");
		}
	}

	//쿠폰생성코드
	function coupon_generator($len="16")
	{
		$chars1 = "123456789";
		$chars2 = "0123456789";

		srand((double)microtime()*1000000);

		$i = 0;
		$str ="";

		while ($i < $len) {
			$chars = $i==0 ? $chars1 : $chars2;
			$num = rand() % strlen($chars);
			$tmp = substr($chars, $num, 1);
			$str .= $tmp;
			$i++;
		}

		return $str;
	}

	//회원 로그인 여부 체크
	function loginReAuth(){
		if(!$_SESSION['LOGIN_ID']){
			msg_page("회원만 이용 가능합니다. 로그인 후 이용하세요.","../member/login.php?reurl=".urlencode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']));
		}
	}

	//회원정보
	function infoMem($userid,$column=""){
		if($column==""){
			$meminfo=db_select("select * from tbl_member where userid='".$userid."'");
			return $meminfo;
		}else{
			$meminfo=db_result("select $column from tbl_member where userid='".$userid."'");
			return $meminfo;
		}
	}

	//셀렉트 박스(숫자범위)
	function selectNum($name,$start,$end,$val,$class="",$title="",$digit=1){ //폼요소명, 시작숫자, 끝숫자, 현재선택값, 클래스명, 타이틀, 표현자릿수

		echo "<select name=\"".$name."\" id=\"".$name."\" class=\"select $class\" title=\"$title\">\n";
		echo "<option value=''>선택</option>\n";
		for($i=$start; $i<=$end; $i++){
			$sel=($val==$i ? "selected" : "");
			echo "<option value=\"".sprintf("%0".$digit."d", $i)."\" $sel>".sprintf("%0".$digit."d", $i)."</option>\n";
		}
		echo "</select>";
	}

	//셀렉트 박스
	function selectArray($name,$arr,$val,$class="",$title=""){ //폼요소명, 배열명, 현재선택값

		global ${$arr};

		echo "<select name=\"".$name."\" id=\"".$name."\" class=\"select $class\" title=\"$title\">\n";
		echo "<option value=''>선택</option>\n";
		foreach(${$arr} as $xkey=>$xval){
			$sel=($val==$xkey ? "selected" : "");
			echo "<option value=\"".$xkey."\" $sel>".$xval."</option>\n";
		}
		reset(${$arr});
		echo "</select>";
	}

	//셀렉트 박스
	function selectArray2($name,$arr,$val,$class="",$title="",$default="선택"){ //폼요소명, 배열명, 현재선택값

		global ${$arr};

		echo "<select name=\"".$name."\" id=\"".$name."\" class=\"$class\" title=\"$title\">\n";
		echo "<option value=''>".$default."</option>\n";
		foreach(${$arr} as $xval){
			echo $xval;
			$sel=($val==$xval) ? "selected" : "";
			echo "<option value=\"".$xval."\" $sel>".$xval."</option>\n";
		}
		reset(${$arr});
		echo "</select>";
	}

	//품절표시
	function SOLDOUT($pcode){
		$soldList=db_select("select qty_type, qty from tbl_product where pcode='".$pcode."'");
		if($soldList['qty_type']==2 || ($soldList['qty_type']==3 && $soldList['qty']<1)){
			return "<img src=\"../images/common/icon_soldout.gif\" /> ";
		}
	}

	//아이콘 노출
	function ICON_CONFIG($icon=""){
		global $mainIconArray; $iconArr=array(); $ICON_ITEM="";
		if($icon) $iconArr=explode("/",$icon);
		foreach($iconArr as $xkey){
			$ICON_ITEM.="<i class=\"icon ".$mainIconArray[$xkey]."\">".$mainIconArray[$xkey]."</i>";
		}
		return $ICON_ITEM;
	}

	function ICON_CONFIG2($icon=""){
		global $mainIconArray2; $iconArr=array(); $ICON_ITEM2="";
		if($icon) $iconArr=explode("/",$icon);
		foreach($iconArr as $xkey){
			$ICON_ITEM2.="<i class=\"badgeIcon ".$mainIconArray2[$xkey]."\">";
			$ICON_ITEM2.=$mainIconArray2[$xkey];
			$ICON_ITEM2.="</i>";
		}
		return $ICON_ITEM2;
	}

	//쿠폰다운로드
	function COUPON_DISPLAY($brand,$code,$pcode){
		$useCpList1=db_select("select * from tbl_coupon_online where state=1 and cp_type=2 and use_type=1 and (cp_date_type=1 or cp_date_type=3 or (start_date<='".date('Y-m-d')."' and end_date>='".date('Y-m-d')."')) order by regdate desc"); //모든 상품 구매시 사용가능
		$useCpList2=db_select("select * from tbl_coupon_online where state=1 and cp_type=2 and use_type=2 and (cp_date_type=1 or cp_date_type=3 or (start_date<='".date('Y-m-d')."' and end_date>='".date('Y-m-d')."')) and (use_code='".substr($code,0,2)."' or use_code='".substr($code,0,4)."' or use_code='".substr($code,0,6)."') order by regdate desc"); //특정 카테고리
		$useCpList3=db_select("select * from tbl_coupon_online where state=1 and cp_type=2 and use_type=4 and (cp_date_type=1 or cp_date_type=3 or (start_date<='".date('Y-m-d')."' and end_date>='".date('Y-m-d')."')) and use_brand='".$brand."' order by regdate desc"); //특정 브랜드
		$useCpList4=db_select("select * from tbl_coupon_online where state=1 and cp_type=2 and use_type=3 and (cp_date_type=1 or cp_date_type=3 or (start_date<='".date('Y-m-d')."' and end_date>='".date('Y-m-d')."')) and use_pcode like '%".$pcode."%' order by regdate desc"); //특정 제품
		if($useCpList4['idx']) {
			$useCpList=$useCpList4;
		}else if($useCpList3['idx']) {
			$useCpList=$useCpList3;
		}else if($useCpList2['idx']){
			$useCpList=$useCpList2;
		}else if($useCpList1['idx']){
			$useCpList=$useCpList1;
		}

		return $useCpList;
	}

	//상품옵션
	function OPT_DISPLAY($pcode,$opt=""){

		global $karatOptArray;
		$pList=db_select("select * from tbl_product where pcode='".$pcode."'");

		//함량
		if($opt=="karat"){
			if($pList['opt_karat']=="NO" || $pList['opt_karat']==""){
				$KARAT_OPT="";
			}else if($pList['opt_karat']=="14K"){
				$KARAT_OPT="<select name=\"opt_karat\" id=\"opt_karat\" class=\"select\" style=\"width:120px;\" onchange=\"changeKarat();\">\n";
				$KARAT_OPT.="<option value=\"\">함량선택</option>\n";
				$KARAT_OPT.="<option value=\"14K\" price=\"".$pList['price']."\" selected>14K</option>\n";
				$KARAT_OPT.="<option value=\"18K\" price=\"".$pList['label_price']."\" >18K</option>\n";
				$KARAT_OPT.="</select>";
			}else if($pList['opt_karat']=="18K"){
				$KARAT_OPT="<select name=\"opt_karat\" class=\"select\" style=\"width:120px;\">\n";
				$KARAT_OPT.="<option value=\"\">옵션선택</option>\n";
				$KARAT_OPT.="<option value=\"14K\">14K</option>\n";
				$KARAT_OPT.="<option value=\"18K\" selected>18K</option>\n";
				$KARAT_OPT.="</select>";
			}else{
				$KARAT_OPT="<input type='text' name=\"opt_karat\" style=\"border:0\" value=\"".$karatOptArray[$pList['opt_karat']]."\" readonly />";
			}
			return $KARAT_OPT;
		}

		//색상
		if($opt=="color"){
			global $colorOptArray; // 임시
			if($pList['opt_coloryn']=="Y"){
				$opt_color_arr=explode("|",$pList['opt_color']);
				if(count($opt_color_arr)>0){
					$COLOR_OPT="<select name=\"opt_color\" class=\"select\" style=\"width:120px;\">\n";
					$COLOR_OPT.="<option value=\"\">색상선택</option>\n";
					foreach($opt_color_arr as $xkey){
						$COLOR_OPT.= "<option value=\"$xkey\">".$colorOptArray[$xkey]."</option>\n";
					}
					reset($opt_color_arr);
					$COLOR_OPT.="</select>";
				}
			}else{
				$COLOR_OPT="";
			}
			return $COLOR_OPT;
		}

		//사이즈
		if($opt=="size"){
			if($pList['opt_sizeyn']=="Y"){
				if($pList['opt_size_min']!="" && $pList['opt_size_max']!=""){
					$SIZE_OPT="<select name=\"opt_size\" class=\"select\" style=\"width:120px;\">\n";
					$SIZE_OPT.="<option value=\"\">사이즈선택</option>\n";
					for($size=$pList['opt_size_min'];$size<=$pList['opt_size_max'];$size=$size+0.5){
						$sel=$pList['opt_size']==$size ? "selected":"";
						$SIZE_OPT.= "<option value=\"$size\" $sel>".$size."</option>\n";
					}
					$SIZE_OPT.="</select>";
				}
			}else{
				$SIZE_OPT="";
			}
			return $SIZE_OPT;
		}

	}

    function make_selbox($val, $data, $sel_name, $opt_text){
        $arr = explode("|",$data);
        $opt="<select name=\"$sel_name\" class=\"select\"  style=\"width:180px;\">\n";
        $opt.="<option value=\"\">$opt_text</option>\n";
        foreach($arr as $val){
            $product = db_select('select price,qty_type,qty from tbl_product where pcode="'.$val.'";');
            $opt.= "<option value=\"$val\" data-price='".$product['price']."'>".$val." (+".number_format($product['price'])."원)</option>\n";
        }
        $opt.="</select></br>";
        return $opt;
    }


	//관리자등록 상품옵션
	function OPT_ADMIN_DISPLAY($pcode,$opt=""){

		$pList=db_select("select * from tbl_product where pcode='".$pcode."'");

		//공통
		if($opt=="common"){
            $COMMON_OPT = '';
			if($pList['admin_option_idx']){
                $opt_common_arr = explode("|",$pList['admin_option_idx']);
                if(count($opt_common_arr)>0){
                    $COMMON_OPT = array();
                    // 옵션에 연관된 상품 가져오기
                    foreach($opt_common_arr as $val){
                        $option = db_select('select * from tbl_product_option where idx='.$val);
                        if ($option['use_pcode']) {
                            $COMMON_OPT[] = make_selbox($val, $option['use_pcode'], 'admin_opt_common[]', $option['opt_name']);
                        }
                    }
                }
			}
			return $COMMON_OPT;
		}

		// 색상
		if($opt=="color"){
			global $colorOptArray; // 임시
            $COLOR_OPT="";
			if($pList['admin_opt_color']){
				$opt_color_arr=explode("|",$pList['admin_opt_color']);
				if(count($opt_color_arr)>0){
					$COLOR_OPT="<select name=\"admin_opt_color\"  id=\"admin_opt_color\" class=\"select\" style=\"width:120px;\">\n";
					$COLOR_OPT.="<option value=\"\">색상선택</option>\n";
					foreach($opt_color_arr as $xkey){
						$COLOR_OPT.= "<option value=\"$xkey\">".$colorOptArray[$xkey]."</option>\n";
					}
					reset($opt_color_arr);
					$COLOR_OPT.="</select>";
				}
			}
			return $COLOR_OPT;
		}

		// 사이즈
		if($opt=="size"){
            $SIZE_OPT="";
			if($pList['admin_opt_size']){
				$opt_size_arr=explode("|",$pList['admin_opt_size']);
				if(count($opt_size_arr)>0){
					$SIZE_OPT="<select name=\"admin_opt_size\" id=\"admin_opt_size\" class=\"select\" style=\"width:120px;\">\n";
                    $SIZE_OPT.="<option value=\"\">사이즈선택</option>\n";
					foreach($opt_size_arr as $val){
                        $SIZE_OPT.= "<option value=\"$val\">".$val."</option>\n";
					}
					reset($opt_size_arr);
                    $SIZE_OPT.="</select>";
				}
			}
			return $SIZE_OPT;
		}

	}


	//상품옵션-임직원몰
	function OPT_DISPLAY2($pcode,$opt=""){

		global $karatOptArray;
		global $SHOP_SALE_RATE;

		$pList=db_select("select * from tbl_product where pcode='".$pcode."'");

		$SALE_RATE = $pList['sale_type']==1 ? $SHOP_SALE_RATE : $pList['sale_rate'];

		//함량
		if($opt=="karat"){
			if($pList['opt_karat']=="NO" || $pList['opt_karat']==""){
				$KARAT_OPT="";
			}else if($pList['opt_karat']=="14K"){
				$KARAT_OPT="<select name=\"opt_karat\" id=\"opt_karat\" class=\"select\" style=\"width:120px;\" onchange=\"changeKarat();\">\n";
				$KARAT_OPT.="<option value=\"\">함량선택</option>\n";
				$KARAT_OPT.="<option value=\"14K\" price=\"".SALE_COUNT($pList['price'],$SALE_RATE)."\" selected>14K</option>\n";
				$KARAT_OPT.="<option value=\"18K\" price=\"".SALE_COUNT($pList['label_price'],$SALE_RATE)."\" >18K</option>\n";
				$KARAT_OPT.="</select>";
			}else if($pList['opt_karat']=="18K"){
				$KARAT_OPT="<select name=\"opt_karat\" class=\"select\" style=\"width:120px;\">\n";
				$KARAT_OPT.="<option value=\"\">옵션선택</option>\n";
				$KARAT_OPT.="<option value=\"14K\">14K</option>\n";
				$KARAT_OPT.="<option value=\"18K\" selected>18K</option>\n";
				$KARAT_OPT.="</select>";
			}else{
				$KARAT_OPT="<input type='text' name=\"opt_karat\" style=\"border:0\" value=\"".$karatOptArray[$pList['opt_karat']]."\" readonly />";
			}
			return $KARAT_OPT;
		}

		//색상
		if($opt=="color"){
			global $colorOptArray; // 임시
			if($pList['opt_coloryn']=="Y"){
				$opt_color_arr=explode("|",$pList['opt_color']);
				if(count($opt_color_arr)>0){
					$COLOR_OPT="<select name=\"opt_color\" class=\"select\" style=\"width:120px;\">\n";
					$COLOR_OPT.="<option value=\"\">색상선택</option>\n";
					foreach($opt_color_arr as $xkey){
						$COLOR_OPT.= "<option value=\"$xkey\">".$colorOptArray[$xkey]."</option>\n";
					}
					reset($opt_color_arr);
					$COLOR_OPT.="</select>";
				}
			}else{
				$COLOR_OPT="";
			}
			return $COLOR_OPT;
		}

		//사이즈
		if($opt=="size"){
			if($pList['opt_sizeyn']=="Y"){
				if($pList['opt_size_min']!="" && $pList['opt_size_max']!=""){
					$SIZE_OPT="<select name=\"opt_size\" class=\"select\" style=\"width:120px;\">\n";
					$SIZE_OPT.="<option value=\"\">사이즈선택</option>\n";
					for($size=$pList['opt_size_min'];$size<=$pList['opt_size_max'];$size=$size+0.5){
						$sel=$pList['opt_size']==$size ? "selected":"";
						$SIZE_OPT.= "<option value=\"$size\" $sel>".$size."</option>\n";
					}
					$SIZE_OPT.="</select>";
				}
			}else{
				$SIZE_OPT="";
			}
			return $SIZE_OPT;
		}

	}

	//마일리지 적립
	function MILEAGE_CONFIG($userid,$type="",$title="",$mileage=0){
		$field['userid']=$userid?$userid:$_SESSION['LOGIN_ID'];
		$field['type']=$type;
		$field['title']=$title;
		$field['mileage']=$mileage;
		$field['regdate']=time();
		db_insert("tbl_member_mileage",$field);

		db_query("update tbl_member set mileage=mileage+$mileage where userid='".$field['userid']."'");
	}

	//포인트 적립
	function POINT_CONFIG($userid,$type="",$title="",$point=0){
		$field['userid']=$userid?$userid:$_SESSION['LOGIN_ID'];
		$field['type']=$type;
		$field['title']=$title;
		$field['point']=$point;
		$field['regdate']=time();
		db_insert("tbl_member_point",$field);

		db_query("update tbl_member set point=point+$point where userid='".$field['userid']."'");
	}

	//기간세일 할인 적용시 가격 계산 (할인전가격, 할인, 할인타입)
	function SALE_COUNT($price, $sale, $type='%'){
	    if ($type == '%' and $sale < 90) {
            return $price * (100 - $sale) * 0.01;
        }
        if ($type == '원') {
            return $price - $sale;
        }
        return $price;
	}
	/*
	function SHA_CONFIG($str,$solt){
		$result = hash("SHA512",md5($str)."minigold7".$solt);
		return $result;
	}
	*/
	function SHA_CONFIG($str,$solt){
		$result = db_select("select password('".$str."') as pwd");
		return $result['pwd'];
	}
	function isMobile(){
			$arr_browser = array ("iphone", "android", "ipod", "iemobile", "mobile", "lgtelecom", "ppc", "symbianos", "blackberry", "ipad");
			$httpUserAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
			// 기본값으로 모바일 브라우저가 아닌것으로 간주함
			$mobile_browser = false;
			// 모바일브라우저에 해당하는 문자열이 있는 경우 $mobile_browser 를 true로 설정
			for($indexi = 0 ; $indexi < count($arr_browser) ; $indexi++){
				if(strpos($httpUserAgent, $arr_browser[$indexi]) == true){
					$mobile_browser = true;
					break;
				}
			}
			return $mobile_browser;
			echo "ok";
	}

	function Mall_USE_AUTH($type){
		$MALL_TOTAL_PRICE = db_result("select sale_price from tbl_member_level where level_code='".$_SESSION['LOGIN_LEVEL']."'");

		if($type=="price"){
			return $MALL_TOTAL_PRICE;
		}else if($type=="auth"){
			$auth="N";
			if($_SESSION['LOGIN_ID'] && ($_SESSION['LOGIN_LEVEL']>500 && $_SESSION['LOGIN_LEVEL']<600)){
				if(infoMem($_SESSION['LOGIN_ID'],"mall_order_price")<$MALL_TOTAL_PRICE){
					$auth="Y";
				}
			}
			return $auth;
		}
	}


	// 장바구니 담기횟수 변경
    function add_to_cart_product($product_code){
        db_query("update tbl_product set cart_cnt = cart_cnt+1 where pcode='$product_code'");
    }

    /* 관리자등록옵션(공통옵션) 추가옵션 상세내용 출력
    입력 : admin_opt_text ('ECUM0014|NRIM0002|ECUM0014')
    출력 : ECUM0014(+69800), NRIM0002(+89800), ECUM0014(+69800) */
    function admin_opt_text($admin_opt_pcode){
        if (!$admin_opt_pcode) { return ""; }
        $opt_arr = explode("|", $admin_opt_pcode);
        $text = array();
        foreach ($opt_arr as $val) {
            $price = db_select("select price from tbl_product where pcode='$val';");
            if ($price['price']>0 && $val) {
                $text[] = $val . "(+" . $price['price'] . ")";
            }
        }
        return implode(', ', $text);
     }

    /* 관리자등록옵션(공통옵션) 추가옵션 총 가격 출력
    입력 : admin_opt_text ('ECUM0014|NRIM0002|ECUM0014')
    출력 : 229400 */
    function admin_opt_total_price($admin_opt_pcode){
        if (!$admin_opt_pcode) { return ""; }
        $opt_arr = explode("|", $admin_opt_pcode);
        $total_price = 0;
        foreach ($opt_arr as $val) {
            $price = db_select("select price from tbl_product where pcode='$val';");
            if ($price['price']>0 && $val) {
                $total_price += $price['price'];
            }
        }
        return $total_price;
    }

    /* 재고수량 체크
    입력 : qty_check(ECUM0014, 3)
    출력 : true
    */
    function qty_check($pcode){

    }

  /*특정문자열 치환*/	
    function strRePlace($input_str){
	
	$input_str = str_replace("'","&apos;",$input_str);

	return $input_str;
    }

  /*콤마제거 ereg_replace -> preg_replace 에 변형 (5.3 이후 사라짐)*/
	function numberRePlace($num){
		return preg_replace("/[^0-9]/","",$num);
	}


   /*로그인시 TBL_MEMBER 없고 CUSTOMER 에 있을시 INSERT&SELECT */
	function memberCUSTOMER($id, $passwd){
		
		$inputSql = "
			INSERT INTO TBL_MEMBER (IDX, USERID, PASSWD, NAME, EMAIL, MEMBER_LEVEL, MEMBER_GRADE, GRADE_CODE, REGDATE, JOIN_PATH) 
			SELECT  
			    tbl_member_seq.nextval, C.USER_ID, C.USER_PW, DBSEC.DEC@LINK_MOMSTOUCH(C.CUSTOMER_NM), C.E_MAIL, 500, 5, 5, ROUND((to_date(TO_CHAR(SYSDATE, 'YYYYMMDDHH24MISS'),'yyyymmddhh24miss')-TO_DATE('19700101','YYYYMMDD'))*86400-32400), 'etc' 
			FROM  
			    CUSTOMER@LINK_MOMSTOUCH C LEFT OUTER JOIN TBL_MEMBER M 
			ON 
			    C.USER_ID=M.USERID 
			WHERE 
			    C.USE_YN='Y' AND C.USER_ID IS NOT NULL AND M.USERID IS NULL and C.USER_ID ='".$id."' and C.USER_PW = '".$passwd."'
		
		";

		db_query($inputSql);
	}


        /*회원가입 알림톡*/
	function joinTock($hp,$name){
	
		$url = "https://api.surem.com/alimtalk/v2/json";
		$json = array(
		"usercode" => "momstouchmal",
		"deptcode" => "NY--JO-HY",
		"yellowid_key"=>"3e6d4fdda1247204975923bf7bbee7933afad513",
		"messages" => array	(
							array	(
									"to" => $hp,
									"text" => "[맘스터치몰]\n$name 고객님 \n맘스터치몰 회원가입을 진심으로 감사드립니다.\n\n맘스터치몰과 함께 건강한 하루 되세요.",
									"template_code" => "mtm_join_comp_001",
									"buttons" => array	(
														array(
															"button_type" => "WL",
															"button_name" => "맘스터치몰 바로가기",
															"button_url" => "http://momstouchmall.co.kr/m",
															"button_url2" => "http://momstouchmall.co.kr",
															)
														)
									)
							)
				);

					$json_data = json_encode($json);

					$ch = curl_init($url);

					curl_setopt($ch, CURLOPT_HTTPHEADER, array(
								  'Content-Type: application/json',
								  'Content-Length: ' . strlen($json_data),
											  'cache-control: no-cache'
											  ));

					curl_setopt($ch, CURLOPT_URL, $url);

					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

					curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

					curl_setopt($ch, CURLOPT_POST, 1);

					$response = curl_exec($ch);

					curl_close($ch);

					$json_result = json_decode($response, true);
					//echo $json_result['message']
					//echo $response;
	
	}


	/*무통장 알림톡*/
	function bankTock($hp,$name,$pname,$price,$bankinfo){
	
		$url = "https://api.surem.com/alimtalk/v2/json";
		$json = array(
		"usercode" => "momstouchmal",
		"deptcode" => "NY--JO-HY",
		"yellowid_key"=>"3e6d4fdda1247204975923bf7bbee7933afad513",
		"messages" => array	(
							array	(
									"to" => $hp,
									"text" => "[맘스터치몰]\n$name 고객님\n주문하신 $pname\n주문이 완료 되었습니다.\n\n[주문 및 계좌정보]\n상품명 : $pname\n주문금액 : $price\n계좌정보 : $bankinfo\n\n맘스터치몰과 함께 건강한 하루 되세요.\n감사합니다.",
									"template_code" => "mtm_order_comp_002",
									"buttons" => array	(
														array(
															"button_type" => "WL",
															"button_name" => "주문내역 바로가기",
															"button_url" => "http://momstouchmall.co.kr/m/member/login.php",
															"button_url2" => "http://momstouchmall.co.kr/member/login.php",
															)
														)
									)
							)
				);

					$json_data = json_encode($json);

					$ch = curl_init($url);

					curl_setopt($ch, CURLOPT_HTTPHEADER, array(
								  'Content-Type: application/json',
								  'Content-Length: ' . strlen($json_data),
											  'cache-control: no-cache'
											  ));

					curl_setopt($ch, CURLOPT_URL, $url);

					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

					curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

					curl_setopt($ch, CURLOPT_POST, 1);

					$response = curl_exec($ch);

					curl_close($ch);

					$json_result = json_decode($response, true);
					//echo $json_result['message']
					//echo $response;
	
	}
	

	/*결제완료 알림톡*/
	function payTock($hp,$name,$pname,$price){
	
		$url = "https://api.surem.com/alimtalk/v2/json";
		$json = array(
		"usercode" => "momstouchmal",
		"deptcode" => "NY--JO-HY",
		"yellowid_key"=>"3e6d4fdda1247204975923bf7bbee7933afad513",
		"messages" => array	(
							array	(
									"to" => $hp,
									"text" => "[맘스터치몰]\n$name 고객님\n주문하신 $pname\n결제가 완료 되었습니다.\n\n[주문정보]\n상품명 : $pname\n결제금액 : $price\n\n맘스터치몰과 함께 건강한 하루 되세요.\n감사합니다.",
									"template_code" => "mtm_order_comp_001",
									"buttons" => array	(
														array(
															"button_type" => "WL",
															"button_name" => "주문내역 바로가기",
															"button_url" => "http://momstouchmall.co.kr/m/member/login.php",
															"button_url2" => "http://momstouchmall.co.kr/member/login.php",
															)
														)
									)
							)
				);

					$json_data = json_encode($json);

					$ch = curl_init($url);

					curl_setopt($ch, CURLOPT_HTTPHEADER, array(
								  'Content-Type: application/json',
								  'Content-Length: ' . strlen($json_data),
											  'cache-control: no-cache'
											  ));

					curl_setopt($ch, CURLOPT_URL, $url);

					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

					curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

					curl_setopt($ch, CURLOPT_POST, 1);

					$response = curl_exec($ch);

					curl_close($ch);

					$json_result = json_decode($response, true);
					//echo $json_result['message']
					//echo $response;
	
	}


	/*배송 알림톡*/
	function shipTock($hp,$name,$pname,$price,$addr1,$addr2,$tax,$tax_num){
	
		$url = "https://api.surem.com/alimtalk/v2/json";
		$json = array(
		"usercode" => "momstouchmal",
		"deptcode" => "NY--JO-HY",
		"yellowid_key"=>"3e6d4fdda1247204975923bf7bbee7933afad513",
		"messages" => array	(
							array	(
									"to" => $hp,
									"text" => "[맘스터치몰]\n$name 고객님께서 주문하신\n$pname\n\n배송이 시작되었습니다.\n\n[주문정보]\n상품명 : $pname\n결제금액 : $price\n\n배송지 : $addr1\n$addr2\n\n배송업체 : $tax ($tax_num)",
									"template_code" => "mtm_ship_001",
									"buttons" => array	(
														array(
															"button_type" => "DS",
															"button_name" => "배송조회"
															),
														array(
															"button_type" => "WL",
															"button_name" => "주문내역 바로가기",
															"button_url" => "http://momstouchmall.co.kr/m/member/login.php",
															"button_url2" => "http://momstouchmall.co.kr/member/login.php",
															)
														)
									)
							)
				);

					$json_data = json_encode($json);

					$ch = curl_init($url);

					curl_setopt($ch, CURLOPT_HTTPHEADER, array(
								  'Content-Type: application/json',
								  'Content-Length: ' . strlen($json_data),
											  'cache-control: no-cache'
											  ));

					curl_setopt($ch, CURLOPT_URL, $url);

					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

					curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

					curl_setopt($ch, CURLOPT_POST, 1);

					$response = curl_exec($ch);

					curl_close($ch);

					$json_result = json_decode($response, true);
					//echo $json_result['message']
					//echo $response;
	
	}


function generateRandomString($length = 2) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>