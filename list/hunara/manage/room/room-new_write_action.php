<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login_frame.php"; // 관리자 로그인여부 확인?>

<?
/*if(!$_AUTH_WRITE){
	error_frame("본문작성 권한이 없습니다.");
	exit;
}*/

$comname = trim(sqlfilter($_REQUEST['comname']));
$pwd = trim(sqlfilter($_REQUEST['pwd']));
$total_param = trim(sqlfilter($_REQUEST['total_param']));

$post = trim(sqlfilter($_REQUEST['post']));
$addr1 = trim(sqlfilter($_REQUEST['addr1']));
$addr2 = sqlfilter($_REQUEST['addr2']);	

$tel1 = sqlfilter($_REQUEST['tel1']);	
$tel2 = sqlfilter($_REQUEST['tel2']);	
$tel3 = sqlfilter($_REQUEST['tel3']);	
$tel = $tel1.'-'.$tel2.'-'.$tel3;	

$homepage = trim(sqlfilter($_REQUEST['homepage']));
$rarea = trim(sqlfilter($_REQUEST['rarea']));

$rtype = trim(sqlfilter($_REQUEST['rtype']));
$rcnt =  trim(sqlfilter($_REQUEST['rcnt']));
$ravg = trim(sqlfilter($_REQUEST['ravg']));	
$rmax = trim(sqlfilter($_REQUEST['rmax']));	
$rinfra = trim(sqlfilter($_REQUEST['rinfra']));


$con1 = trim(sqlfilter($_REQUEST['ir']));
$con2 = trim(sqlfilter($_REQUEST['ir2']));
$con3 = trim(sqlfilter($_REQUEST['ir3']));
$con4 = trim(sqlfilter($_REQUEST['ir4']));

$rarea = $_REQUEST['rarea'];
$rtype = $_REQUEST['rtype'];
$rcnt = $_REQUEST['rcnt'];
$ravg = $_REQUEST['ravg'];
$rmax = $_REQUEST['rmax'];
$rinfra = $_REQUEST['rinfra'];

$intro_file = $_REQUEST['intro_file'];
$unit_file = $_REQUEST['unit_file'];
$tour_file = $_REQUEST['tour_file'];


//에디터 사용 안할때
if($is_html != "Y"){
	$content = strip_tags($content);
	$content = addslashes($content);
}

    $thum_img = "";
    if($_FILES['thum_img']['size'] > 0){
        $upload_dir = $_P_DIR_FILE.'huCon/thum_img/';

        $fileResult = uploadFileUniq( 'thum_img', $upload_dir);
        if($fileResult["success"] == "false"){
            $message = $fileResult["msg"];
        }else{
            $thum_img = $_P_DIR_WEB_FILE.'huCon/thum_img/'.$fileResult["file_name"];
        }

    }

    $contact_file = "";
    if($_FILES['contact_file']['size'] > 0){
        $upload_dir = $_P_DIR_FILE.'huCon/contact/';

        $fileResult = uploadFileUniq( 'contact_file', $upload_dir);
        if($fileResult["success"] == "false"){
            $message = $fileResult["msg"];
        }else{
            $contact_file = $_P_DIR_WEB_FILE.'huCon/contact/'.$fileResult["file_name"];
        }

    }    

    $addr = $addr1.$addr2;
    $xml_url ="https://maps.googleapis.com/maps/api/geocode/xml?address=".urlencode($addr)."&key=AIzaSyAW_TeBhoUnzqIy-WBKLc_71qGAZUPh_T0";
	//echo "xml url test = ".$xml_url."<br>";

	include_once $_SERVER["DOCUMENT_ROOT"].""."/pro_inc/snoopy/Snoopy.class.php"; 
	$snoopy = new snoopy;
	$snoopy->fetch($xml_url);
	$xml = simplexml_load_string($snoopy->results) or die ("Error: Cannot create object 3"); 

	$map_x = $xml->result->geometry->location->lat;
	$map_y = $xml->result->geometry->location->lng;


	$query = " insert into tb_hu set "; 
	$query .= " comname = '".$comname."', ";
    $query .= " pwd = '".$pwd."', ";
	$query .= " post = '".$post."', ";
	$query .= " addr1 = '".$addr1."', ";
	$query .= " addr2 = '".$addr2."', ";
    $query .= " map_x = '".$map_x."', ";
	$query .= " map_y = '".$map_y."', ";
	$query .= " tel = '".$tel."', ";
	$query .= " homepage = '".$homepage."', ";
	$query .= " con1 = '".$con1."', ";
	$query .= " con2 = '".$con2."', ";
	$query .= " con3 = '".$con3."', ";
	$query .= " con4 = '".$con4."', ";
    $query .= " thum_img = '".$thum_img."', ";
    $query .= " contact_file = '".$contact_file."', ";
	$query .= " wdate = now() ";
	
	//echo $query; exit;
	
	$result = mysqli_query($gconnet,$query);


	/*

	################# 첨부파일 업로드 시작 #######################
	
	$_P_DIR_FILE = $_P_DIR_FILE.$bbs_code."/";
	$_P_DIR_WEB_FILE = $_P_DIR_WEB_FILE.$bbs_code."/";

	$board_tbname = "board_content";
	$board_code = $bbs_code;

	for($file_i=0; $file_i<$_include_board_file_cnt; $file_i++){ // 설정된 갯수만큼 루프 시작

		if ($_FILES['file_'.$file_i]['size']>0){ // 파일이 있다면 업로드한다 시작

			$file_o = $_FILES['file_'.$file_i]['name']; 
			$file_c = uploadFile($_FILES, "file_".$file_i, $_FILES['file_'.$file_i], $_P_DIR_FILE); // 파일 업로드후 변형된 파일이름 리턴.

			$query_file = " insert into board_file set "; 
			$query_file .= " board_tbname = '".$board_tbname."', ";
			$query_file .= " board_code = '".$board_code."', ";
			$query_file .= " board_idx = '".$board_idx."', ";
			$query_file .= " file_org = '".$file_o."', ";
			$query_file .= " file_chg = '".$file_c."' ";

			$result_file = mysqli_query($gconnet,$query_file);
		
		} // 파일이 있다면 업로드한다 종료 

	} // 설정된 갯수만큼 루프 종료

	################# 첨부파일 업로드 종료 #######################
	*/

	if($result){
        $sql_pre2 = " select idx from tb_hu where 1=1 order by idx desc limit 0,1"; 
        $result_pre2  = mysqli_query($gconnet,$sql_pre2);
        $mem_row2 = mysqli_fetch_array($result_pre2);
        $board_idx = $mem_row2[idx]; 


        for($k=0; $k<sizeof($rarea); $k++){
            $query_file = "insert into tb_huType set ";
            $query_file .= " idx = '".$board_idx."', ";
            $query_file .= " rArea = '".$rarea[$k]."', ";
            $query_file .= " rType = '".$rtype[$k]."', ";
            $query_file .= " rCnt = '".$rcnt[$k]."', ";
            $query_file .= " rAvg = '".$ravg[$k]."', ";
            $query_file .= " rMax = '".$rmax[$k]."', ";
            $query_file .= " rInfra = '".$rinfra[$k]."' ";
            $query_1 = mysqli_query($gconnet,$query_file);
        }
        
        for($k=0; $k<sizeof($intro_file); $k++){
            $query_file = "insert into tb_huFile set ";
            $query_file .= " idx = '".$board_idx."', ";
            $query_file .= " flag = 'intro', ";
            $query_file .= " seq = '".($k+1)."', ";
            $query_file .= " file = '".$intro_file[$k]."' ";
            $query_1 = mysqli_query($gconnet,$query_file);
        }

        for($k=0; $k<sizeof($unit_file); $k++){
            $query_file = "insert into tb_huFile set ";
            $query_file .= " idx = '".$board_idx."', ";
            $query_file .= " flag = 'unit', ";
            $query_file .= " seq = '".($k+1)."', ";
            $query_file .= " file = '".$unit_file[$k]."' ";
            $query_1 = mysqli_query($gconnet,$query_file);
        }

        for($k=0; $k<sizeof($tour_file); $k++){
            $query_file = "insert into tb_huFile set ";
            $query_file .= " idx = '".$board_idx."', ";
            $query_file .= " flag = 'tour', ";
            $query_file .= " seq = '".($k+1)."', ";
            $query_file .= " file = '".$tour_file[$k]."' ";
            $query_1 = mysqli_query($gconnet,$query_file);
        }    

	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
		$('#test',parent.document).val(<?=$board_idx?>);
		$('#test2',parent.document).val('Y');
		alert('게시물 등록이 정상적으로 완료 되었습니다.');
		//parent.location.href =  "room-new.php?<?=$total_param?>";
	//-->
	</SCRIPT>
	<?}else{
		echo $query; //exit;
		?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('게시물 등록중 오류가 발생했습니다.');
	//-->
	</SCRIPT>
	<?}?>