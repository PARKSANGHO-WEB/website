<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_board_config.php"; // 게시판 설정파일 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login_frame.php"; // 관리자 로그인여부 확인?>

<?
/*if(!$_AUTH_WRITE){
	error_frame("본문작성 권한이 없습니다.");
	exit;
}*/

$total_param = trim(sqlfilter($_REQUEST['total_param']));
$cidx = trim(sqlfilter($_REQUEST['cidx']));
$question = $_REQUEST['question'];
$title = $_REQUEST['title'];
$manjok = $_REQUEST['manjok'];
$jugwan = $_REQUEST['jugwan'];
$surveytitle = $_REQUEST['surveytitle'];

if(!$cidx){
    error_frame('기업명을 선택해주세요.');
}


$query1 = " SELECT sidx FROM `tb_survey` WHERE cidx = '".$cidx."' AND del_yn = 'N' "; 
$rs  = mysqli_query($gconnet,$query1);

if (mysqli_num_rows($rs) > 0){
    error_frame('이미 등록된 설문지가 있습니다.');
}


//설문지 
$query3 = " insert into tb_survey set "; 
$query3 .= " cidx = '".$cidx."', ";
$query3 .= " title = '".$surveytitle."', ";
$query3 .= " wdate = now() ";

$result3 = mysqli_query($gconnet,$query3);

$sql_sidx = " select sidx from tb_survey where 1=1 order by sidx desc limit 0,1"; 
$result_sidx  = mysqli_query($gconnet,$sql_sidx);
$row_sidx = mysqli_fetch_array($result_sidx);

$sidx = $row_sidx['sidx']; //설문지 순번

    //만족도 
    for($k=0; $k<sizeof($question); $k++){
        
        $query_file = "insert into tb_survey_question set ";
        $query_file .= " cidx = '".$cidx."', ";
        $query_file .= " sidx = '".$sidx."', ";
        $query_file .= " qidx = '".($k+10)."', ";
        $query_file .= " flag = '10', ";
        $query_file .= " wdate = now(), ";
        $query_file .= " question = '".$question[$k]."' ";
        $query_1 = mysqli_query($gconnet,$query_file);


        //echo $query_file;
    }


    //객관식
    for($k=0; $k<sizeof($title); $k++){

        $query_file2 = "insert into tb_survey_question set ";
        $query_file2 .= " cidx = '".$cidx."', ";
        $query_file2 .= " sidx = '".$sidx."', ";
        $query_file2 .= " qidx = '".($k+20)."', ";
        $query_file2 .= " flag = '20', ";
        $query_file2 .= " wdate = now(), ";
        $query_file2 .= " question = '".$title[$k]."' ";
        
        $query_2 = mysqli_query($gconnet,$query_file2);

        //echo $query_file2;
        if($query_2){

            for($i=1; $i<7; $i++){
                $content = $_REQUEST['content'.($k*6+$i)];
                //echo "##".$content."<br>";
                if($content){
                    $query_file3 = "insert into tb_survey_choice set ";
                    $query_file3 .= " cidx = '".$cidx."', ";
                    $query_file3 .= " sidx = '".$sidx."', ";
                    $query_file3 .= " qidx = '".($k+20)."', ";
                    $query_file3 .= " oidx = '".$i."', ";
                    $query_file3 .= " item = '".$content."' ";
                    $query_3 = mysqli_query($gconnet,$query_file3);

                    //echo $query_file3."<br>";
                }
            }

        }
    }
   
    //echo $query_2;


    //전체만족도
	$query = " insert into tb_survey_question set "; 
	$query .= " cidx = '".$cidx."', ";
    $query .= " sidx = '".$sidx."', ";
    $query .= " qidx = '30', ";
    $query .= " flag = '30', ";
    $query .= " wdate = now(), ";
	$query .= " question = '".$manjok."' ";
	
	//echo $query; 
	
	$result = mysqli_query($gconnet,$query);

    //주관식
    $query2 = " insert into tb_survey_question set "; 
	$query2 .= " cidx = '".$cidx."', ";
    $query2 .= " sidx = '".$sidx."', ";
    $query2 .= " qidx = '40', ";
    $query2 .= " flag = '40', ";
    $query2 .= " wdate = now(), ";
	$query2 .= " question = '".$jugwan."' ";
	
	//echo $query2; 
	
	$result2 = mysqli_query($gconnet,$query2);


    if($result && $result2 && $query_1 && $query_2){

	//?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
		alert('설문 등록이 정상적으로 완료 되었습니다.');
		parent.location.href =  "reserve-survey.php?<?=$total_param?>";
	//-->
	</SCRIPT>
	<?}else{
		//echo $query; //exit;
		?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	alert('설문 등록중 오류가 발생했습니다.');
	//-->
	</SCRIPT>
	<?}?>